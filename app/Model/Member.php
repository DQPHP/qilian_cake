<?php
/* 团队成员 */
class Member extends AppModel {
	public $validate = array(

		// 姓名不能为空
		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => '姓名不能为空'
			)
		),

		// 职位不能为空
		'position' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => '职位不能为空'
			)
		),
		// 描述不能为空
		'role' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => '描述不能为空'
			),
			'maxLength' => array(
                'rule'    => array('maxLength',  50),
                'message' => '描述不能太长'
            )
		),

		// 描述不能为空
		'description' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => '描述不能为空'
			)
		)
		
	); // !validate
}