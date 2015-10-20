<?php

class MemberController extends AppController {
	public $layout = "bootstrap-admin";

	function beforeFilter(){
	    parent::beforeFilter();
	}

/*******************************
	以下信息仅限管理员身份
********************************/

	/* 团队成员一览 */
	public function index() {
		$members = $this->Member->find('all');
		$this->set('members', $members);
	}

	/* 添加新成员 */
	public function add() {
		if($this->request->data) {
			if($this->Member->save($this->request->data)) {
				$this->Session->setFlash('新成员信息保存成功', 'flash_success');
				$this->redirect('/member');
			} else {
				$this->Session->setFlash('新成员信息保存失败', 'flash_error');
			}
		}
	}

	/* 成员信息修改 */
	public function modify( $id = null ) {
		$id = $this->params->pass[0];
		if($this->request->data) {
			if($this->Member->save($this->request->data)) {
				$member = $this->Member->findById($id);
				$this->request->data = $member;
				$this->Session->setFlash($this->request->data['Member']['name'].' 信息修改成功！', 'flash_success');
			} else {
				$this->Session->setFlash($this->request->data['Member']['name'].' 信息修改失败！', 'flash_error');
			}
		} else {
			$member = $this->Member->findById($id);
			$this->request->data = $member;
		}
	}

	/* 成员信息删除 */
	public function delete($id = null) {
		$this->autoRender = false;
		$id = $this->params->pass;

		if( $this->Member->deleteAll(array('id' => $id))) {
			$this->Session->setFlash('删除成功！', 'flash_success');
        	return $this->redirect('/member');
		}
	}

}
