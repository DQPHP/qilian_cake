<?php
/*
 * 日历相关
 */
class CalendarController extends AppController {
	public $uses = ['Calendar', 'Kubun', 'KubunRelation', 'Post', 'Category'];
	public $helpers = ['Markdown.Markdown'];								
	public $components = [
				'Paginator',
				'Security' => ['csrfExpires' => '+1 hour']
			];
	public $kubunList = [];
	public $kubuns = [];

	/* Controller所有方法执行前加载 初始化公用部分 */
	function beforeFilter(){
	    parent::beforeFilter();
	    $this->Auth->allow('index', 'detail', 'blackhole', 'category');

	    // 区分(投稿用)
	    $this->kubunList = $this->Kubun->find('list', ['fields' => ['id', 'name', 'type']]);
	    $this->set('kubunList', $this->kubunList);

	    // 区分(表示用)
	    foreach($this->kubunList as $kubun) {
	    	$this->kubuns = $this->kubuns + $kubun;
	    }
	    $this->set('kubuns', $this->kubuns);

	    // CSRF
	    $this->Security->blackHoleCallback = 'blackhole';

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

	}

	/* 日历列表页面 */
	public function index() {
		$this->css[] = "blog-list";			// 博客相关Css加载
		$today = date('Y-m-d');
		$paginate_options['fields'] = ['Calendar.id', 'Calendar.title', 'Calendar.date'];
		$paginate_options['limit'] = 20;
		$paginate_options['order'] = ['Calendar.created' => 'DESC'];

		if($this->request->data) {
			if($this->request->data['kubun']) {
				$calendar_selected_ids = [];
				foreach($this->request->data['kubun'] as $kubun){
					if($kubun) {
						$calendar_ids = $this->KubunRelation->find(
								'all', 
								[	
									'fields' => ['DISTINCT relation_id'],
									'conditions' => 
										[
											'KubunRelation.kubun_id' => $kubun,
										]
								]
							);
						$calendar_ids = Set::extract('/KubunRelation/.', $calendar_ids);
						$calendar_ids = Set::extract('/relation_id/.', $calendar_ids);
						if($calendar_ids) {
							if(empty($calendar_selected_ids)) {
								$calendar_selected_ids = $calendar_ids;
							} else {
								$calendar_selected_ids = array_intersect($calendar_selected_ids, $calendar_ids);
							}
						} else {
							$calendar_selected_ids = [];
							break;
						}
					}
				}
			}
		} 
		
		if(isset($calendar_selected_ids) && $calendar_selected_ids) {
			$paginate_options['conditions'] = ['Calendar.id' => $calendar_selected_ids, 'Calendar.date > ' => $today];
		} else {
			$paginate_options['conditions'] = ['Calendar.date > ' => $today];
		}
		
		$this->Paginator->settings = $paginate_options;
		$calendars = $this->Paginator->paginate('Calendar');
		
		$this->set('calendars', $calendars);
	}

	/* 分类 */
	public function category($cagetory_id = null) {
		$this->css[] = "blog-list";			// 博客相关Css加载
		$today = date('Y-m-d');

		$paginate_options['fields'] = ['Calendar.id', 'Calendar.title', 'Calendar.date'];
		$paginate_options['limit'] = 20;
		$paginate_options['order'] = ['Calendar.created' => 'DESC'];

		$category_id = $this->params->pass[0];
		$this->set('category_selected_id', $category_id);

		$calendar_ids = $this->KubunRelation->find(
				'all', 
				[	
					'fields' => ['DISTINCT relation_id'],
					'conditions' => 
						[
							'KubunRelation.kubun_id' => $category_id,
						]
				]
			);
		$calendar_ids = Set::extract('/KubunRelation/.', $calendar_ids);
		$calendar_ids = Set::extract('/relation_id/.', $calendar_ids);
		if(!empty($calendar_ids)) {
			$paginate_options['conditions'] = ['Calendar.id' => $calendar_ids, 'Calendar.date > ' => $today];
		}
		$paginate_options['conditions'] = ['Calendar.date > ' => $today];
		$this->Paginator->settings = $paginate_options;
		$calendars = $this->Paginator->paginate('Calendar');
		
		$this->set('calendars', $calendars);
	}

	/* 日历搜索 */
	public function search() {

	}	

	/* 详细页面 */
	public function detail($id = null) {
		$this->css[] = "markdown";			// MarkdownCss加载
		$this->css[] = "blog-list";			// 博客相关Css加载
		$this->css[] = "calendar-detail";			// 博客相关Css加载
		$id = $this->params->pass[0];
		$this->set('id', $id);
		if($id == null) {
			$this->redirect('/calendar');
		}

		$calendar = $this->Calendar->findById($id);
		if($calendar) {
			$this->set('calendar', $calendar);
		} else {
			$this->redirect('/calendar');
		}

		// 取得该文章前后相邻日历
		$neighbor_calendars = $this->Calendar->find(
			'neighbors', 
			array(
				'field' => 'id',
				'value' => $id,
				'fields' => array('id', 'title')
			)
		);
		$this->set('neighbor_calendars', $neighbor_calendars);

		// breadcrumbs 设置
		$this->breadcrumbs['/calendar/'] = '就职日历';
		$this->breadcrumbs[''] = $calendar['Calendar']['title'];
		$this->set('breadcrumbs', $this->breadcrumbs);

		// SEO meta
		$this->meta_title = $calendar['Calendar']['title']."|".$this->meta_title;
		// $this->meta_description = $post['Post']['description'];
	}

	public function blackhole () {
		$this->Session->setFlash('重复提交表单', 'flash_failure');
		$this->redirect('/calendar');
	}

	/*****************\
	 以下方法需管理员身份
	\*****************/

	/* 添加新的日历 */
	public function add() {

		if($this->request->is('post')) {
			// 保存操作
			if($this->Calendar->save($this->request->data)) {
				// 获得新加入日历ID
				$calendar_id = $this->Calendar->getLastInsertId();
				// 保存日历所属业界
				$kubunList = $this->request->data['Kubun'];

				if($kubunList) {
					$calendarKubunList = [];
					foreach($kubunList as $kubuns) {
						foreach($kubuns as $kubun) {
							$calendarKubun['relation_id'] = $calendar_id;
							$calendarKubun['kubun_id'] = $kubun;
							$calendarKubunList[] = $calendarKubun;
						}
					}
					$this->KubunRelation->saveMany($calendarKubunList);
				}
			}
		}
	}

	/* 修改日历 */
	public function modify($id = null) {

		$id = $this->params->pass[0];
		$this->set('id', $id);
		if($id == null) {
			$this->redirect('lists');
		}
		// 提交修改
		if($this->request->is('put')) {

			$this->Calendar->save($this->request->data);

			if(isset($this->request->data['Kubun'])){

				$kubunList = $this->request->data['Kubun'];
				$calendarKubunList = [];
				$calendar_kubun_selected = [];
					foreach($kubunList as $kubuns) {
						foreach($kubuns as $kubun) {
							$calendarKubun['relation_id'] = $id;
							$calendarKubun['kubun_id'] = $kubun;
							$calendar_kubun_selected[] = $kubun;
							$calendarKubunList[] = $calendarKubun;
						}
					}
					
				$this->KubunRelation->deleteAll(array('relation_id' => $id));
				$this->KubunRelation->saveMany($calendarKubunList);
				$this->set('calendar_kubun_selected', $calendar_kubun_selected);
			}
		} else {
			// 页面初始加载
			$calendar = $this->Calendar->findById($id);
			if($calendar) {
				$this->set('Calendar', $calendar);
				$this->request->data = $calendar;

				$calendar_kubun_selected = $this->KubunRelation->find('all', array('fields' => array('kubun_id'), 'conditions' => array('relation_id' => $id)));
				$calendar_kubun_selected = Set::extract('/KubunRelation/.', $calendar_kubun_selected);
				$calendar_kubun_selected = Set::extract('/kubun_id/.', $calendar_kubun_selected);
				$this->set('calendar_kubun_selected', $calendar_kubun_selected);
			} else {
				$this->Session->setFlash('该日历不存在', 'flash_failure');
				$this->redirect('lists');
			}
		}
	}

	/* 日历一览 */
	public function lists() {
		$this->layout = 'bootstrap-admin';
		$this->Paginator->settings = array( 'limit' => 10, 'order' => array('Calendar.created' => 'DESC') );
		$calendars = $this->Paginator->paginate('Calendar');
        $this->set('calendars', $calendars);
	}

	/* 删除指定ID日历 */
	public function delete($id = null) {
		$this->autoRender = false;
		$id = $this->params->pass;

		if($this->Calendar->deleteAll(array('id' => $id), true)) {
			
			$this->Session->setFlash('删除成功！', 'flash_success');
        	return $this->redirect('/calendar/lists');
		}
	}
}