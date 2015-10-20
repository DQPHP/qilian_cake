<?php

class TeacherController extends AppController {

	public $layout = "bootstrap-admin";

	function beforeFilter(){
	    parent::beforeFilter();
	    $this->Auth->allow('detail');
	}
	
	/* 学生侧可浏览教师信息 */
	public function detail() {
		$id = $this->params->pass;
		$teacher = $this->Teacher->findById($id);
		$this->set('teacher', $teacher);
	}

/*******************************
	以下信息仅限管理员身份
********************************/

	/*　教师一览 */
	public function index() {
		$teachers = $this->Teacher->find('all');
		$this->set('teachers', $teachers);

	}

	/* 教师新增 */
	public function add() {
		if($this->request->data) {
			if($this->Teacher->save($this->request->data)) {
				$this->Session->setFlash($this->request->data['Teacher']['name'].'老师信息已添加！', 'flash_success');
				$this->redirect('/teacher');
			} else {
				$this->Session->setFlash($this->request->data['Teacher']['name'].'老师信息添加失败！', 'flash_error');
			}
		}
	}

	/* 教师信息修改 */
	public function modify($id = null) {
		$id = $this->params->pass;

		if($this->request->data) {
			if($this->Teacher->save($this->request->data)) {
				$this->Session->setFlash($this->request->data['Teacher']['name'].'老师信息修改成功！', 'flash_success');
			} else {
				$this->Session->setFlash($this->request->data['Teacher']['name'].'老师信息修改失败！', 'flash_error');
			}
		} else {
			$teacher = $this->Teacher->findById($id);
			$this->request->data = $teacher;
		}
	}

	/* 删除教师信息 */
	public function delete($id = null) {
		// $this->request->onlyAllow('post');
		$this->autoRender = false;
		$id = $this->params->pass;
		$this->Teacher->id = $id;
		$name = $this->Teacher->field('name');

		if($this->Teacher->deleteAll(array('id' => $id))) {
			$this->Session->setFlash($name.'老师数据删除成功！', 'flash_success');
        	return $this->redirect('/teacher');
		}
	}

}
