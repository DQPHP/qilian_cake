<?php

class Post extends AppModel {
	public $hasMany = array(
        'PostsCategory' => array(
            'className'     => 'PostsCategory',
            'foreignKey'    => 'post_id',
            'order'         => 'PostsCategory.category_id ASC',
            'dependent'     => true
        )
    );
}