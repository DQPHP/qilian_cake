<?php

class Course extends AppModel {

	public $hasMany = array(
        'Schedule' => array(
            'className' => 'Schedule',
            'order' => array('Schedule.datetime_from' => 'ASC')
        )
    );

	public $validate = array(
		// 课程名称不能为空
		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => '课程名称不能为空'
			)
		),

		// 课程简介不能为空
		'description' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => '课程简介不能为空'
			)
		)
		
	); // !validate
}