<?php

class CourseController extends AppController {

	public $uses = array('Course', 'Teacher', 'Schedule', 'Member');
	public $layout = "bootstrap-admin";

	function beforeFilter(){
	    parent::beforeFilter();
	    $this->Auth->allow('detail');
	}

	public function detail() {
		$this->layout = "bootstrap";
		
		$id = $this->params->pass;
		$course = $this->Course->findById($id);
		$this->set('course', $course);

		$teacher_id = $course['Course']['teacher_id'];
		$teacher = $this->Teacher->findById($teacher_id);
		$this->set('teacher', $teacher);

		// breadcrumbs 设置
		$this->breadcrumbs['/appointment/list/course'] = '课程一览';
		$this->breadcrumbs[''] = $course['Course']['name'];
		$this->set('breadcrumbs', $this->breadcrumbs);
	}

/*******************************
	以下信息仅限管理员身份
********************************/

	/* 课程信息一览 */
	public function index() {
		$courses = $this->Course->find('all');
		$this->set('courses', $courses);
	}

	/* 添加课程信息 */
	public function add() {
		if($this->request->data) {
			// 授课老师信息
			$this->request->data['Course']['teacher_id'] = implode(',', $this->request->data['Course']['teacher']);
			if($this->Course->save($this->request->data)) {
				$course_id = $this->Course->getLastInsertId();
				if(isset($this->request->data['Schedule'])) {
					foreach($this->request->data['Schedule'] as $schedule) {
						$schedule['course_id'] = $course_id;
						$schedules[] = $schedule;
					}
					$this->Schedule->saveMany($schedules);
				}
				$this->Session->setFlash('课程信息保存成功', 'flash_success');
				$this->redirect('/course');
			}
		}

		// 七联讲师
		$teachers = $this->Member->find(
			'list', 
			[
				'fields' => ['id', 'name'],
				'conditions' => ['role' => ['teacher']]

			]
		);
		$this->set('teachers', $teachers);

	}

	/* 课程信息修改 */
	public function modify( $id = null ) {
		$id = $this->params->pass[0];

		if($this->request->data) {
			// 提交更改
			$this->request->data['Course']['teacher_id'] = implode(',', $this->request->data['Course']['teacher']);
			
			if($this->Course->save($this->request->data)) {
				if($this->request->data['Schedule']) {
					foreach($this->request->data['Schedule'] as $schedule) {
						$this->Schedule->create();
						$this->Schedule->save($schedule);
						
					}
				}
				$course = $this->Course->findById($id);
				$this->request->data = $course;
				$this->Session->setFlash($this->request->data['Course']['name'].'课程信息修改成功！', 'flash_success');
			} else {
				$this->Session->setFlash($this->request->data['Course']['name'].'课程信息修改失败！', 'flash_error');
			}
		} else {
			// 加载页面
			$course = $this->Course->findById($id);

			$teacher_checked = explode(',', $course['Course']['teacher_id']);
			$this->set('teacher_checked', $teacher_checked);
			$this->request->data = $course;
		}

		// 七联讲师
		$teachers = $this->Member->find(
			'list', 
			[
				'fields' => ['id', 'name'],
				'conditions' => ['role' => ['teacher']]

			]
		);
		$this->set('teachers', $teachers);

	}

	/* 删除课程信息 */
	public function delete($id = null) {
		$this->autoRender = false;
		$id = $this->params->pass;

		if( $this->Schedule->deleteAll(array('course_id' => $id)) &&  $this->Course->deleteAll(array('id' => $id))) {
			$this->Session->setFlash('删除成功！', 'flash_success');
        	return $this->redirect('/course');
		}
	}

}
