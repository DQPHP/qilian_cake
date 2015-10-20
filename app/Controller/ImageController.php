<?php
/*
 * 预约系统首页Slide图片管理
 */
class ImageController extends AppController {
	public $layout = "bootstrap-admin";
	public $uses = array('SlideImage');
	
	/* 图片一览页面 */
	public function index() {
		$images = $this->SlideImage->find('all');
		$this->set('images', $images);
	}

	/* 添加图片 */
	public function add() {
		// 状态栏设置
		$status_list = array(
			'0' => '草稿',
			'1' => '显示'
		);
		$this->set('status_list', $status_list);

		// 图片类型定义 1.首页top_slide 2.博客一览以及其他页面广告图像
		$type_list = array(
			'top_page' => '首页图像',
			'blog_page' => '博客列表页面广告'	
		);
		$this->set('type_list', $type_list);

		if($this->request->data) {
			if($this->SlideImage->save($this->request->data)) {
				$this->Session->setFlash('图片信息添加成功！', 'flash_success');
				$this->redirect('/image');
			} else {
				$this->Session->setFlash('图片信息添加失败！', 'flash_error');
			}
		}
	}

	/* 修改图片 */
	public function modify() {
		$id = $this->params->pass;
		// 状态栏设置
		$status_list = array(
			'0' => '草稿',
			'1' => '显示'
		);
		$this->set('status_list', $status_list);
		
		// 图片类型定义 1.首页top_slide 2.博客一览以及其他页面广告图像
		$type_list = array(
			'top_page' => '首页图像',
			'blog_page' => '博客列表页面广告'	
		);
		$this->set('type_list', $type_list);

		if($this->request->data) {
			if($this->SlideImage->save($this->request->data)) {
				$this->Session->setFlash('图片信息修改成功', 'flash_success');
			} else {
				$this->Session->setFlash('图片信息修改出现问题，请重试。', 'flash_error');
			}
		} else {
			$image = $this->SlideImage->findById($id);
			$this->request->data = $image;
		}
	}

	/* 删除图片 */
	public function delete() {
		$this->autoRender = false;
		$id = $this->params->pass;

		if($this->SlideImage->deleteAll(array('id' => $id))) {
			$this->Session->setFlash('图片数据删除成功！', 'flash_success');
        	return $this->redirect('/image');
		}
	}
}