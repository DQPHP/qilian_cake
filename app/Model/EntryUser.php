<?php


class EntryUser Extends AppModel {
	public $name = 'EntryUser';

	public $validate = array(

		// 姓名不能为空
		'realname' => array(
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
		),
		// 手机号码必须
		'tel' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => '手机号码不能为空'
			)
		),
		// 学校必须
		'university' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => '学校不能为空'
			)
		),
		// 专业必须
		'major' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => '学部专业不能为空'
			)
		)
		
	); // !validate
}