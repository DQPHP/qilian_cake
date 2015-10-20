<?php
/*
 * 课程以及老师一览页面
 */
class ListController extends AppController {
	public $uses = array('Teacher', 'Course');

	function beforeFilter(){
	    parent::beforeFilter();
	    // 所有方法均可访问
	    $this->Auth->allow();
	}

	public function teacher() {
		$this->breadcrumbs['/appointment/list/teacher'] = '老师一览';
		$this->set('breadcrumbs', $this->breadcrumbs);
	}

	public function course() {
		$this->breadcrumbs['/appointment/list/course'] = '课程列表';
		$this->set('breadcrumbs', $this->breadcrumbs);
	}
}