<?php
/*
 * 就职日历 v.01版本
 * unistyle类似
 * 业界，类型检索，日期排序
 */
class Calendar extends AppModel {
	public $hasMany = array(
        'KubunRelation' => array(
            'className'     => 'KubunRelation',
            'foreignKey'    => 'relation_id',
            'fields'        => 'kubun_id',
            'order'         => 'KubunRelation.relation_id ASC',
            'dependent'     => true
        )
    );
	public $validate = [
		'title' => [
			'required' => [
				'rule' => ['notEmpty'],
				'message' => '标题不能为空', 
			]		
		],
		'date' => [
			'required' => [
				'rule' => ['notEmpty'],
				'message' => '截止日期能为空', 
			]
		],
		'source_url' => [
			'required' => [
				'rule' => ['notEmpty'],
				'message' => '来源网址不能为空', 
			]
		],
	];

}