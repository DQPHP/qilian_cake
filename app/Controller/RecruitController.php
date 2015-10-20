<?php

/*
 * 七联恳亲会
 */
class RecruitController extends AppController {
  public $uses = ['Calendar', 'Kubun', 'KubunRelation', 'Post', 'Category'];
  public $helpers = ['Markdown.Markdown'];                
  public $components = [
        'Paginator',
        'Security' => ['csrfExpires' => '+1 hour']
      ];

	function beforeFilter(){
	    parent::beforeFilter();
	    // 所有方法均可访问
	    $this->Auth->allow();
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

	/* 
	 * 恳亲会主页
	 */
	public function index() {

	}

  public function detail($id = null) {
    $this->css[] = "blog-list";     // 博客相关Css加载
    $this->css[] = "calendar-detail";     // 博客相关Css加载
    // breadcrumbs 设置
    $this->breadcrumbs['/calendar/'] = '求人一览';
    $this->breadcrumbs[''] = 'システム基盤 ※英語：ビジネスレベル';
    $this->set('breadcrumbs', $this->breadcrumbs);
  }

}