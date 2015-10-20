<?php

class CompanyController extends AppController {
	public $uses = ['Calendar', 'Kubun', 'KubunRelation', 'Post', 'Category', 'Company'];
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

	public function index() {

	}

	/* Add new Company Info */
	public function add() {

		if($this->request->is('post')) {
			if($this->Company->save($this->request->data)) {
				$company_id = $this->Company->getLastInsertId();
				$kubunList = $this->request->data['Company']['Kubun'];

				if($kubunList) {
					$calendarKubunList = [];
					foreach($kubunList as $kubun) {
							$calendarKubun['type'] = 'company';
							$calendarKubun['relation_id'] = $company_id;
							$calendarKubun['kubun_id'] = $kubun;
							$calendarKubunList[] = $calendarKubun;
						
					}
					$this->KubunRelation->saveMany($calendarKubunList);
				}

			}
		} 
	}

	public function modify() {}

	public function delete() {}

	public function lists() {}

	public function blackhole () {
		$this->Session->setFlash('重复提交表单', 'flash_failure');
		$this->redirect('/company');
	}
}