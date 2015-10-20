<?php
/*
 * 七联资讯
 * http://qilian.jp/news/
 */
class NewsController extends AppController {

	public $uses = array('Post', 'Category', 'PostsCategory', 'SlideImage');	// 加载Model数据库表
	public $helpers = array( 'Markdown.Markdown' );								// View Markdown解析
	public $components = array( 'Paginator' );									// 分页
	
	public $category_list;
	public $categories;
	public $categories_color;
	public $adsense;

	/* Controller所有方法执行前加载 初始化公用部分 */
	function beforeFilter(){
		
	    parent::beforeFilter();
	    $this->Auth->allow('detail', 'index', 'category', 'search', 'bookmark');

	    // Category 父节点
	    $this->category_list = $this->Category->find(
	    	'list', 
	    	array(
	    		'fields' => array('name', 'count', 'id'),
	    		'conditions' => array('count >' => '1' ),
	    		'order' => array('count' => 'DESC')
    		)
    	);
	    $this->set('category_list', $this->category_list);

	    // Category List 子节点
	    $this->categories = $this->Category->find('list', array('fields' => array('id', 'name')));
	    $this->set('categories', $this->categories);

	    // Category List color 2015-08-01页面设计修改停用
	    $this->categories_color = $this->Category->find('list', array('fields' => array('id', 'border_left_color')));
	    $this->set('categories_color', $this->categories_color);

	    // 人气资讯
    	$favor_news = $this->Post->find(
    		'all',
    		array(
				'fields'     => array('id', 'title', 'description', 'image', 'page_views', 'created'),
				'order'      => array('page_views' => 'DESC'),
				'limit'      => 5
			)
		);
		$this->set('favor_news', $favor_news);

		// 广告图片取得
        $this->adsense = $this->SlideImage->find(
        	'all',
        	array(
        		'fields' => array('title', 'description', 'path', 'url'),
        		'conditions' => array('type' => 'blog_page', 'status' => '1'),
        		'order' => 'rand()',
        		'limit' => 1
    		)
    	);
    	$this->set('adsense', $this->adsense);
	    
	}

	/* 单一资讯信息详情 */
	public function detail($id = null) {
		$this->css[] = "markdown";			// MarkdownCss加载
		$this->css[] = "blog-list";			// 博客相关Css加载
 		$id = $this->params->pass[0];
		if ($post = $this->Post->findById($id)) {
			$this->set('post', $post);
			// 取得该文章前后相邻文章
			$neighbor_posts = $this->Post->find(
				'neighbors', 
				array(
					'field' => 'id',
					'value' => $id,
					'fields' => array('id', 'title')
				)
			);
			$this->set('neighbor_posts', $neighbor_posts);
		} else {
			$this->redirect('/news/');
		}

		// 文章阅读次数更新+1
		$this->Post->id = $id;
		$page_views = $this->Post->field('page_views') + 1;
		$update_views['id'] = $id;
		$update_views['page_views'] = $page_views;
		$this->Post->save($update_views, false);

		// breadcrumbs 设置
		$this->breadcrumbs['/news/'] = '资讯';
		$this->breadcrumbs[''] = $post['Post']['title'];
		$this->set('breadcrumbs', $this->breadcrumbs);

		// SEO meta
		$this->meta_title = $post['Post']['title']."|".$this->meta_title;
		$this->meta_description = $post['Post']['description'];
	}

	/* 资讯信息一览 */
	public function index() {
		// 当前页面css加载
		$this->css[] = "blog-list";
		// 分页
		$this->Paginator->settings = array( 'limit' => 10, 'order' => array('Post.created' => 'DESC') );
		$posts = $this->Paginator->paginate('Post');
        $this->set('posts', $posts);

		// breadcrumbs 设置
		$this->breadcrumbs[''] = '资讯';
		$this->set('breadcrumbs', $this->breadcrumbs);

		// SEO meta
		$this->meta_title = "七联资讯一览|".$this->meta_title;
		$this->meta_description = '面试、ES、Group Discussion、自我分析、企业研究，网罗在日就职过程中的所有问题。';
	}

	/* 资讯分类一览 */
	public function category() {
		// 当前页面css加载
		$this->css[] = "blog-list";

		$category_id = $this->params->pass[0];
		$category_name = $this->categories[$category_id];
		$this->set('category_name', $category_name);

		$this->Paginator->settings = array( 
			'conditions' => array(
				'PostsCategory.category_id' => $category_id
			),
			'joins' => array(
				array(
					'table' => 'posts_categories',
					'alias' => 'PostsCategory',
					'type'  => 'LEFT',
					'conditions' => array(
						'PostsCategory.post_id = Post.id'
					)	
				)
			),
			'order' => array('Post.created' => 'DESC'),
			'limit' => 10, 
		);
		$posts = $this->Paginator->paginate('Post');
        $this->set('posts', $posts);

        // breadcrumbs 设置
		$this->breadcrumbs['/news/'] = '资讯';
		$this->breadcrumbs[] = $category_name;
		$this->set('breadcrumbs', $this->breadcrumbs);

        // SEO meta
		$this->meta_title = "七联资讯之" . $category_name . "资讯一览|" . $this->meta_title;
		$this->meta_description = '面试、ES、Group Discussion、自我分析、企业研究，网络在日就职过程中的所有问题。';

	}

	/* 资讯搜索页面 */
	public function search() {
		// 当前页面css加载
		$this->css[] = "blog-list";

		if($this->request->query) {
			$q = $this->request->query['q'];
			$this->set('q', $q);
		} else {
			$this->rediect('/news/');
		}
		$this->Paginator->settings = array( 
			'conditions' => array(
				'OR' => array(
					'Post.title LIKE' => "%".$q."%",
					'Post.content LIKE' => "%".$q."%"
				)
			),
			'order' => array('Post.id' => 'DESC'),
			'limit' => 10
		);
		$posts = $this->Paginator->paginate('Post');
        $this->set('posts', $posts);

        // breadcrumbs 设置
		$this->breadcrumbs['/news/'] = '资讯';
		$this->breadcrumbs[] = '搜索内容:'.$q;
		$this->set('breadcrumbs', $this->breadcrumbs);

        // SEO meta
		$this->meta_title = "七联资讯之" . $q . "资讯一览|" . $this->meta_title;
		$this->meta_description = '面试、ES、Group Discussion、自我分析、企业研究，网络在日就职过程中的所有问题。';
	}

	/* 会员bookmark功能，暂未实现 */
	public function bookmark(){
		$this->autoRender = false;
		$id = $this->params->pass[0];
		echo $id;
	}


/*******************************
	以下信息仅限管理员身份
********************************/
	
	/* 资讯一览 */
	public function lists() {
		$this->layout = 'bootstrap-admin';
		$this->Paginator->settings = array( 'limit' => 10, 'order' => array('Post.created' => 'DESC') );
		$posts = $this->Paginator->paginate('Post');
        $this->set('posts', $posts);
	}

	/* 添加资讯信息 */
	public function add() {
		$this->layout = 'bootstrap-admin';
		if($this->request->data) {
			// 数据库保存
			if ( $this->Post->save($this->request->data) ) {
				// 分类保存
				$post_id = $this->Post->getLastInsertId();
				if(isset($this->request->data['Category']) && $this->request->data['Category']['ids']){
					foreach($this->request->data['Category']['ids'] as $category_id){
						$post_category['post_id'] = $post_id;
						$post_category['category_id'] = $category_id;
						$post_categories[] = $post_category;
					}
					$this->PostsCategory->saveMany($post_categories);
				}
				// 文章分类数量统计
				$this->update_post_category_count();
				$this->Session->setFlash($this->request->data['Post']['title'].'添加成功', 'flash_success');
				$this->redirect('/news/lists');

			} else {
				$this->Session->setFlash($this->request->data['Post']['title'].'保存失败。', 'flash_error');
			}
		}

		$this->set('demo_text', "在此编辑......");
	}


	/* 资讯信息修改 */
	public function modify( $id = null ) {
		$id = $this->params->pass[0];
		if($this->request->data) {
			if($this->Post->save($this->request->data)) {
				if(isset($this->request->data['Category'])){
					$this->set('post_category_selected', $this->request->data['Category']['ids']);
					foreach($this->request->data['Category']['ids'] as $category_id){
						$post_category['post_id'] = $id;
						$post_category['category_id'] = $category_id;
						$post_categories[] = $post_category;
					}
					$this->PostsCategory->deleteAll(array('post_id' => $id));
					$this->PostsCategory->saveMany($post_categories);
				}
				// 文章分类数量统计
				$this->update_post_category_count();
				$this->Session->setFlash($this->request->data['Post']['title'].'修改成功', 'flash_success');
			} else {
				$this->Session->setFlash($this->request->data['Post']['title'].'修改失败！', 'flash_error');
			}
		} else {
			$post = $this->Post->findById($id);
			$this->request->data = $post;
			$post_category_selected = $this->PostsCategory->find('all', array('fields' => array('category_id'), 'conditions' => array('post_id' => $id)));
			$post_category_selected = Set::extract('/PostsCategory/.', $post_category_selected);
			$post_category_selected = Set::extract('/category_id/.', $post_category_selected);
			
			$this->set('post_category_selected', $post_category_selected);
		}
	}

	/* 删除资讯信息 */
	public function delete($id = null) {
		$this->autoRender = false;
		$id = $this->params->pass;

		if($this->Post->deleteAll(array('id' => $id))) {
			// 文章分类数量统计
			$this->update_post_category_count();
			$this->Session->setFlash('删除成功！', 'flash_success');
        	return $this->redirect('/news/lists');
		}
	}

	/* 
	 * 更新category文章数量 
	 * add, modify, update 方法执行之后都需要调用该方法
	 * 对文章分类进行重新统计
	 */
	function update_post_category_count(){
		$this->PostsCategory->virtualFields['count'] = 0;
		$category_count = $this->PostsCategory->find(
			'all', 
			array(
				'fields' => array('category_id as id', 'count(category_id) as PostsCategory__count'),
				'group' => array('category_id')
			)
		);
		$category_count = Set::extract('/PostsCategory/.', $category_count);
		$this->Category->saveMany($category_count);
	}

}
