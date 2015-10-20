<?php

// Hash加密
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User Extends AppModel {
	public $name = 'User';

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
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => '该邮箱已经注册'
			)
		),

		// 密码长度大于6位
		'passwd' => array(
			'alphaNumeric' => array('rule' => array('custom', '/^[a-zA-Z0-9]+$/'), 'message' => '密码格式支持半角英文以及数字'),
			'between' => array(
                'rule'    => array('between', 6, 20),
                'message' => '密码长度6位~20位'
            )
		)
		
	); // !validate

	// 用户名加密处理
	public function beforeSave($options = array()){
		if(isset($this->data['User']['passwd'])){
			$passwordHasher = new SimplePasswordHasher();
			$this->data['User']['passwd'] = $passwordHasher->hash($this->data['User']['passwd']);
		}
		return true;
	}
}