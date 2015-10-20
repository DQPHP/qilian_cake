<?php

class CategoryController extends AppController {

	public $uses = array('Category');
	public $layout = "bootstrap-admin";

	function beforeFilter(){
	    parent::beforeFilter();
	}

/*******************************
	以下信息仅限管理员身份
********************************/

	/* 标签一览 */
	public function index() {
		$categories = $this->Category->find('all', array('order' => array('parent_id' => 'ASC')));
		$this->set('categories', $categories);

		$category_list = $this->Category->find('list', 
			array(
				'fields' => array('id', 'name'),
        		//'conditions' => array('parent_id !=' => 0)
    		)
		);
		$category_list[0] = '无父类';
		$this->set('category_list', $category_list);
	}

	/* 添加课程信息 */
	public function add() {
		if($this->request->data) {
			if($this->Category->save($this->request->data)) {
				$this->Session->setFlash('类别保存成功', 'flash_success');
				$this->redirect('/Category');
			}
		}
	}

	/* 课程信息修改 */
	public function modify( $id = null ) {
		$id = $this->params->pass;

		if($this->request->data) {
			if($this->Category->save($this->request->data)) {
				$this->Session->setFlash($this->request->data['Category']['name'].'修改成功！', 'flash_success');
			} else {
				$this->Session->setFlash($this->request->data['Category']['name'].'修改失败！', 'flash_error');
			}
		} else {
			$Category = $this->Category->findById($id);
			$this->request->data = $Category;
		}
	}

	/* 删除课程信息 */
	public function delete($id = null) {
		$this->autoRender = false;
		$id = $this->params->pass;

		if($this->Category->deleteAll(array('id' => $id))) {
			$this->Session->setFlash('删除成功！', 'flash_success');
        	return $this->redirect('/category');
		}
	}

}
