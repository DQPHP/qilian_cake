<?php

class UserParty Extends AppModel {
	public $name = 'UserParty';

	public $validate = array(

		// 姓名不能为空
		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => '姓名不能为空'
				)
		),

		// 邮箱格式以及邮箱重复注册验证
		'email' => array(
			'isEmail' => array(
				'rule' => 'email',
				'message' => '请输入有效的邮箱地址'
			)
		)
		
	); // !validate
}