<?php
/* マイページ */
class MypageController extends AppController {
	public $uses = array('User', 'Course', 'EntryUser', 'SlideImage', 'Post');

	function beforeFilter(){
	    parent::beforeFilter();
	    // 所有方法均可访问
	    //$this->Auth->allow();
	}

    public function isAuthorized($user) {
        if (isset($user['role'])) {
            return true;
        }
        return parent::isAuthorized($user);
    }
	
	public function index() {
		$user_id = $this->Auth->User('id');

		// 个人信息
		$user_info = $this->User->findById($user_id);
		$this->set('user_info', $user_info);

		// 最新活动广告
        $adsense = $this->SlideImage->find(
        	'all',
        	array(
        		'fields' => array('title', 'description', 'path', 'url'),
        		'conditions' => array('type' => 'blog_page', 'status' => '1'),
        		'order' => 'rand()',
        		'limit' => 1
    		)
    	);
    	if ($adsense) {
    		$this->set('adsense', $adsense[0]['SlideImage']);
    	}

    	// 人气资讯
    	$favor_news = $this->Post->find(
    		'all',
    		array(
				'fields'     => array('id', 'title', 'description', 'image', 'page_views', 'created'),
				'order'      => array('page_views' => 'DESC'),
				'limit'      => 5
			)
		);
		$this->set('favor_news', $favor_news);

		// 最新资讯
    	$new_news = $this->Post->find(
    		'all',
    		array(
				'fields'     => array('id', 'title', 'description', 'image', 'page_views', 'created'),
				'order'      => array('created' => 'DESC'),
				'limit'      => 5
			)
		);
		$this->set('new_news', $new_news);

		// 课程推荐列表
		$rcmd_course_list = $this->Course->find('all', array('limit' => 3));
		$this->set('rcmd_course_list', $rcmd_course_list);

		// breadcrumbs 设置
		$this->breadcrumbs[''] = '个人主页';
		$this->set('breadcrumbs', $this->breadcrumbs);
	}

	public function profile() {

	}
}
