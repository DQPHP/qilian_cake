<?php
/**
 * 学生课程申请
 */
App::uses('CakeEmail','Network/Email');
class EntryController extends AppController {
	public $uses = array( 'Course', 'User', 'EntryUser', 'EntryCourse', 'Schedule');

	function beforeFilter(){
	    parent::beforeFilter();
	    // 所有方法均可访问
	    $this->Auth->allow();
	}

	/* 个别老师辅导申请 */
	public function teacher($id = null) {
		if (!$id) {
			$this->redirect('/appointment');
		}
		$teacher = $this->Teacher->findById($id);
		$this->set('teacher', $teacher);

		// breadcrumbs 设置
		$this->breadcrumbs['/appointment/list/teacher'] = '老师预约';
		$this->breadcrumbs[''] = $teacher['Teacher']['name'];
		$this->set('breadcrumbs', $this->breadcrumbs);
	}

	/* 公共课程预约 */
	public function course($id = null) {
		
		if ($this->request->data) {
			// 用户提交预约内容处理
			$entry_user = $this->request->data;
			$entry_user['EntryUser']['schedule_id'] = implode(',',$entry_user['EntryUser']['schedule_id']);
			// 是否是已经注册用户
			if ($user = $this->User->findByEmail($entry_user['EntryUser']['email'])) {
				// 已经注册用户，获取用户的ID
				$user_id = $user['User']['id'];
			} else {
				// 非注册用户，将用户信息保存至用户表，
				// save_user_info_for_register and send regist email to the user.
				// A. save_user
				$user_new['User']['realname']   = $entry_user['EntryUser']['realname'];
				$user_new['User']['email']      = $entry_user['EntryUser']['email'];
				$user_new['User']['tel']        = $entry_user['EntryUser']['tel'];
				$user_new['User']['university'] = $entry_user['EntryUser']['university'];
				$user_new['User']['grad_year']  = $entry_user['EntryUser']['grad_year'];
				$user_new['User']['grad_month'] = $entry_user['EntryUser']['grad_month'];
				$user_new['User']['grade']      = $entry_user['EntryUser']['grade'];
				$user_new['User']['major']      = $entry_user['EntryUser']['major'];
				$user_new['User']['comp_name']  = $entry_user['EntryUser']['comp_name'];
				$user_new['User']['wechat']     = $entry_user['EntryUser']['wechat'];
				$user_new['User']['line']       = $entry_user['EntryUser']['line'];
				$user_new['User']['uniqid']     = $this->randomString();
				$user_new['User']['passwd']     = strstr($entry_user['EntryUser']['email'], '@', true);
				$user_new['User']['affiliate']  = 'appointment_system';

				if ($this->User->save($user_new)) {
					$user_id = $this->User->getLastInsertID();
				} else {
					// do nothing 
				}
			} 
			// 用户表-用户预约情况表关联，用户可以在mypage确认预约课程的情况
			$entry_user['EntryUser']['user_id'] = $user_id;

			// 保存用户预约课程信息
			if ($this->EntryUser->save($entry_user)) {
				// 向用户发送课程预约成功提示邮件
				$user_email       = $entry_user['EntryUser']['email'];
				
				$user_name        = $entry_user['EntryUser']['realname'];
				$this->set('user_name', $user_name);

				$note             = $entry_user['EntryUser']['note'];
				$this->set('note', $note);

				$this->Course->id = $entry_user['EntryUser']['course_id'];
				$course_name      = $this->Course->field('name');
				$schedule         = $this->Schedule->find(
					'all', 
					array(
						'fields' => array('name', 'datetime_from', 'datetime_to', 'address'),
						'conditions' => array(
							'id' => $this->request->data['EntryUser']['schedule_id']
						)
					)
				);
				// 用户预约课程时间显示
				$this->set('schedule', $schedule);

				$mail_title = '[七联就职]_'.$course_name.'_课程预约成功通知';
				// 邮件通知
		        $Email = new CakeEmail();
		        // text发信类型
		        $Email->emailFormat('text');
		        $mail_entry_link = $this->basic_url_qilian.'entry/course/'.$this->request->data['EntryUser']['course_id'];
						$mail_note       = $this->request->data['EntryUser']['note'];
		        // 邮件模板页传值设定
		        $viewVars = array(
							'title'      => $mail_title,
							'entry_link' => $mail_entry_link,
							'user_name'  => $user_name,
							'note'       => $mail_note,
							'schedule'   => $schedule,
							'type'			 => 'course'
						);

		      	$Email->template('entry_confirm_student');
		        $Email->viewVars($viewVars);
		        $Email->from('pr@qilian.jp','七联就职社');
		        $Email->to($user_email);
		        $Email->subject($mail_title);
		        $Email->send();
			}
			// 用户提交预约内容处理结束
			$this->set('entry_successful', TRUE);
			$this->Session->setFlash('课程预约成功', 'flash_success');

		} else {
			// 用户进入预约课程页面，加载相关课程信息
			if (!$id) {
				$this->redirect('/');
			}

			// 毕业年
			$grad_year_list = [];
			for ($year = 1990; $year < date('Y') + 4; $year++) {
				$grad_year_list[$year] = $year.'年';
			}
			$this->set('grad_year_list', $grad_year_list);
			// 自定义毕业年
			$grad_year_selected = ( date('m') > 3 ) ? date('Y') + 1 : date('Y');
			$this->set('grad_year_selected', $grad_year_selected);
			
			// 毕业月
			$grad_month_list = [];
			for ($month = 1; $month < 13; $month++) {
				$grad_month_list[$month] = $month.'月';
			}
			$this->set('grad_month_list', $grad_month_list);
			// 自定义毕业月份
			$grad_month_selected = 3;
			$this->set('grad_month_selected', $grad_month_selected);

			// 学年信息
			$grade_list = ['1' => '学部一年生', '2' => '学部二年生', '3' => '学部三年生', '4' => '学部四年生', 'M1' => '院一年生', 'M2' => '院二年生', 'D1' => '博士一年生', 'D2' => '博士二年生', 'D3' => '博士三年生'];
			$this->set('grade_list', $grade_list);
			$grade_selected = '3';
			$this->set('grade_selected', $grade_selected);

			// 如果已经登录用户，则用户部分信息自动填写
			if ( $this->Auth->User('id') ) {
				$user = $this->User->findById($this->Auth->User('id'));

				$user_info['EntryUser']['realname']   = $user['User']['realname'];
				$user_info['EntryUser']['email']      = $user['User']['email'];
				$user_info['EntryUser']['tel']        = $user['User']['tel'];
				$user_info['EntryUser']['university'] = $user['User']['university'];
				$user_info['EntryUser']['major']      = $user['User']['major'];
				$user_info['EntryUser']['grad_year']  = $user['User']['grad_year'];
				$user_info['EntryUser']['grad_month'] = $user['User']['grad_month'];
				$user_info['EntryUser']['grade']      = $user['User']['grade'];
				$user_info['EntryUser']['comp_name']  = $user['User']['comp_name'];
				$user_info['EntryUser']['wechat']     = $user['User']['wechat'];
				$user_info['EntryUser']['line']       = $user['User']['line'];

				// 毕业年月，学年修改
				$this->set('grad_year_selected', $user['User']['grad_year']);
				$this->set('grad_month_selected', $user['User']['grad_month']);
				$this->set('grade_selected', $user['User']['grade']);

				$this->request->data = $user_info;
			} 
		} 

		// 课程信息
		$course = $this->Course->findById($id);
		$this->set('course', $course);
		// 授课老师信息
		// $teacher_id = $course['Course']['teacher_id'];
		// $teacher = $this->Teacher->findById($teacher_id);
		// $this->set('teacher', $teacher);

		// breadcrumbs 设置
		$this->breadcrumbs['/appointment/list/course'] = '课程预约';
		$this->breadcrumbs[''] = $course['Course']['name'];
		$this->set('breadcrumbs', $this->breadcrumbs);
	}


	/* 提交申请*/
	public function submit(){
		
		if ( isset ($this->request->data['User']['email']) && $this->request->data['User']['email'] ) {
			// 邮箱
			$email = $this->request->data['User']['email'];
			$user_name = $this->request->data['User']['realname'];

			if ($student = $this->User->findByEmail($email)) {
				// 该同学已经申请过课程
				$student_id = $student['User']['id'];
				// 将最新信息更新至该同学数据库
			} else {
				// 该同学第一次申请课程
				$passwd = 'qilian'.date('MD');
				$this->request->data['User']['passwd'] = $passwd;
				if ($this->User->save($this->request->data)) {
					$student_id = $this->User->getLastInsertID();
				}
			}
			// 学生数据保存成功
			if (isset($student_id)) {
				// 课程申请情况保存
				if (isset($this->request->data['Course']['id'])) {

					$type = 'course';	//  邮件内容类型判断
					$entry_info = array(
						'course_id' => $this->request->data['Course']['id'],
						'student_id' => $student_id,
						'note' => $this->request->data['EntryCourse']['note']
					);
					$this->EntryCourse->save($entry_info);

					// 课程信息
					$this->Course->id = $this->request->data['Course']['id'];
					$course_name      = $this->Course->field('name');
					$course_address   = $this->Course->field('address');
					$course_starttime = $this->Course->field('starttime');
					$course_endtime   = $this->Course->field('endtime');

					// 邮件标题
					$mail_subject    = '[七联就职]_'.$course_name.'_课程预约成功通知';
					$mail_title      = $course_name;
					$mail_entry_link = $this->basic_url_qilian.'entry/course/'.$this->request->data['Course']['id'];
					$mail_note       = $this->request->data['EntryCourse']['note'];

					// 面包屑
					$this->breadcrumbs['/appointment/list/course'] = '课程预约';
					$this->breadcrumbs[$mail_entry_link] = $course_name;
					$this->breadcrumbs[''] = '预约成功';

				}

				// 老师申请情况保存
				if (isset($this->request->data['Teacher']['id'])) {

					$type = 'teacher';	//  邮件内容类型判断
					
					$entry_teacher_info = $this->request->data['EntryTeacher'];
					$entry_teacher_info['teacher_id'] = $this->request->data['Teacher']['id'];
					$entry_teacher_info['student_id'] = $student_id;
					$this->EntryTeacher->save($entry_teacher_info);

					// 教师姓名
					$this->Teacher->id = $this->request->data['Teacher']['id'];
					$teacher_name = $this->Teacher->field('name');

					// 邮件标题
					$mail_subject    = '【七联就职】_'.$teacher_name.'老师1V1课程辅导预约成功通知';
					$mail_title      = $teacher_name.'老师1V1辅导预约';
					$mail_entry_link = $this->basic_url_qilian.'entry/teacher/'.$this->request->data['Teacher']['id'];
					$mail_note       = $this->request->data['EntryTeacher']['note'];

					// 面包屑
					$this->breadcrumbs['/appointment/list/teacher'] = '老师1V1预约';
					$this->breadcrumbs[$mail_entry_link] = $teacher_name;
					$this->breadcrumbs[''] = '预约成功';
				}

				// 邮件通知
		        $Email = new CakeEmail();
		        // text发信类型
		        $Email->emailFormat('text');

		        // 邮件模板页传值设定
		        $viewVars = array(
		        		'type' => $type,
	 	        		'title' => $mail_title,
		        		'entry_link' => $mail_entry_link,
		        		'user_name' => $user_name,
		        		'note' => $mail_note
	        	);

	        	if ($type == 'teacher') {
	        		$viewVars['starttime'] = $this->request->data['EntryTeacher']['starttime'];
	        		$viewVars['endtime']   = $this->request->data['EntryTeacher']['endtime'];
	        	}

	        	if ($type == 'course') {
	        		$viewVars['starttime'] = $course_starttime;
	        		$viewVars['endtime']   = $course_endtime;
	        		$viewVars['address']   = $course_address;
	        	}

	        	$Email->template('entry_confirm_student');
		        $Email->viewVars($viewVars);
		        $Email->from('pr@qilian.jp','七联就职社');
		        $Email->to($email);
		        $Email->subject($mail_subject);
		        $Email->send();

		        /* 向后台管理员发送邮件 */
		        $Email->reset();

		        // 送信模板設定
		        $Email->template('entry_confirm_admin');
		        // 送信内容設定
		        $Email->viewVars($viewVars);
		        $Email->from(array('pr@qilian.jp' => '七联就职[Alert]'));
		        $Email->to('dongqiang.v@gmail.com');
		        // 邮件主题
		        $Email->subject($mail_subject);
		        // 发送邮件
		        $Email->send();
		        // 网页提示用户注册成功并且向用户推荐其他就职信息以及内容
		        $this->set('type', $type);
		        $this->set('viewVars', $viewVars);

		        // breadcrumbs 设置
				$this->set('breadcrumbs', $this->breadcrumbs);

				// 侧边栏推荐 其他导师以及课程
				$teacher_list = $this->Teacher->find('all', array('limit' => 3));
				$course_list  = $this->Course->find('all', array('limit' => 3));
				$this->set('teacher_list', $teacher_list);
				$this->set('course_list', $course_list);
			} 
		} 
		else {
			$this->request->data = $this->request->data;
			return $this->redirect($this->referer());
		}
	}

}
