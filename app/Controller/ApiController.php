<?php
/*
 * qilian mobile api
 */
App::uses('CakeEmail','Network/Email');
class ApiController extends AppController {

	public $uses = array( 'User', 'Course', 'Entry', 'Teacher', 'Post', 'Category' );

  public $components = array( 'Paginator' );

	function beforeFilter(){
	    parent::beforeFilter();
	    // 所有方法均可访问
	    $this->Auth->allow();
	}

	/* 
	 * API Register
	 */
	public function register() {

		$Email = new CakeEmail();

		if($this->request->data) {
                        $data["User"]["email"] = $this->request->data['mail'];
                        $data["User"]["passwd"] = "giveusmoney";
                        $data["User"]["realname"] = "mobile";
                        $data["User"]["uniqid"] = $this->request->data["uuid"];
			if( $this->request->data['uuid'] && $this->request->data['mail'] && $this->User->save($data) ) {
				// 注册成功，用户邮箱验证
				$email = $this->request->data['mail'];
                                /* 向学生发送邮件 */
                                $Email->template('welcome_regist');
                                 
                                $Email->from('pr@qilian.jp','七联就职社');
                                $Email->to($email);
                                $Email->transport('Mail');
                                $Email->subject('欢迎使用【七联就职】客户端');
                                $Email->send();

                                /* 向后台管理员发送邮件 */
                                $Email->reset();
                                // 送信模板設定
                                $Email->template('regist_admin');
                                // text送信設定
                                $Email->emailFormat('text');
                                $Email->viewVars(array(
                                  'uniqid' => $this->request->data['uuid'], 
                                  'email' => $this->request->data['mail'],
                                ));

                                $Email->from(array('pr@qilian.jp' => '七联就职'));
                                $Email->to('clongbupt@gmail.com');
                                // タイトル
                                $Email->subject('新用户使用[七联就职]客户端');
                                // 送信する
                                $Email->send();

                                // 刷新此页面
                                echo json_encode("ok");
                                exit;
		        } else {
                            $data["User"]["email"] = "";
                            $this->User->save($data);

                            $Email->reset();
                            $Email->template('mobile_reset_email');
                            $Email->emailFormat('text');
                            $Email->viewVars(array(
                                'uniqid' => $this->request->data['uuid'], 
                                'email' => $this->request->data['mail'],
                            ));

                            $Email->from(array('pr@qilian.jp' => '七联就职'));
                            $Email->to('clongbupt@gmail.com');
                            $Email->subject('新用户重置[七联就职]客户端的密码');
                            $Email->send();

			    echo json_encode("error");
                            exit;
                        }
                        
		}
                else {
                  echo json_encode("error");
                  exit;
                }
	}


	/* 
	 * API login 
	 */
	public function login() {

	    if($this->Auth->user('id')){
                $this->redirect('/');
            }

            if($this->request->is('post')){
                if($this->Auth->login()){
                    return $this->redirect($this->Auth->redirect());
                }else{
                    $this->Session->setFlash('确认用户名密码是否正确。', 'flash_error');
                }
            }
	}

	/* 
	 * Reset email
	 */
	public function reset($uniqid = null) {
            $uniqid = @$this->request->query['uuid'];
            $user = $this->User->findByUniqid($uniqid);

            if(isset($user['User']['email'])){     // 如果该用户的邮箱存在
                  $this->User->saveField('email', '');
                  $this->User->id = $user['User']['id'];
                  $this->Session->setFlash("您的邮箱已经重置，请在手机端重新注册。", "flash_success");
                  $this->redirect('/');
            } else {                            
                  $this->Session->setFlash('用户不存在，请在手机端重新注册.', 'flash_error');
                  $this->redirect('/');
            }
	}

  /*
   * API courses
   */
  public function courses(){

      if ($this->request->query) {

          $courses = array();
          $starttime = "2015-01-01 00:00:00";
          $course_id = 0;
          if (@$this->request->query['course_id']) {
            $course_id = $this->request->query['course_id'];
          } 
          if ($course_id) {
              $course = $this->Course->find('first', array(
                  'conditions' => array('id' => $course_id)
              ));
              $starttime = $course['Course']['starttime'];
          }

          $courses = $this->Course->find("all", array(
            'conditions' => array('starttime >' => $starttime),
            'joins' => array(
                array(
                    'table' => 'teachers',
                    'type'  => 'INNER',
                    'conditions' => array (
                        'Course.teacher_id = teachers.id'
                    )
                )
            ),
            'fields' => array('Course.*', 'teachers.*')
          ));

          $uuid = 0;
          if (@$this->request->query['uuid']) {
            $uuid = $this->request->query['uuid'];
          } 
          if ($uuid) {
              $user = $this->User->find('first', array(
                  'conditions' => array("uniqid" => $uuid)
              ));
              $my_courses = $this->Course->find("all", array(
                  "joins" => array(
                      array(
                          'table' => 'entries',
                          'type'  => 'INNER',
                          'conditions' => array(
                              array('entries.course_id = Course.id'),
                              array('entries.student_id = ' => $user['User']['id'])
                          )
                      )
                  ),
                  "fields" => array('Course.*', 'entries.*')
              ));

              foreach($courses as $i => $course) {
                  $courses[$i]['Course']['sign'] = 0;  
                  foreach ($my_courses as $my_course) {
                      if ($my_course['Course']['id'] == $course['Course']['id']) {
                          if ($my_course['entries']['student_id'] == $user['User']['id']) {
                              $courses[$i]['Course']['sign'] = 1; 
                          }   
                      } 
                  }
              }

          }

          if (isset($courses)) {
              echo json_encode($courses);
              exit;
          } else {
              echo json_encode("error");
              exit;
          }
        
      } else {
          $courses = $this->Course->find('all', array(
              'joins' => array(
                  array(
                      'table' => 'teachers',
                      'type'  => 'INNER',
                      'conditions' => array (
                          'Course.teacher_id = teachers.id'
                      )
                  )
              ),
              'fields' => array('Course.*', 'teachers.*')
          )); 
          echo json_encode($courses);
          exit;
      }
  }

  /*******************
   *    News API     *
   *******************/
  // 资讯一览
  public function news_category() {
    if($this->request->query) {
      $category_id = $this->request->query['category_id'];
      $page = isset($this->request->query['page']) ? $this->request->query['page'] : 1;
      $this->Paginator->settings = array( 
      'fields' => array( 
        'title', 
        'author', 
        'created', 
        'page_views',
        'page_likes',
        'id',
        'image',
        'content'
      ),
      'conditions' => array(
        'PostsCategory.category_id' => $category_id
      ),
      'joins' => array(
        array(
          'table' => 'posts_categories',
          'alias' => 'PostsCategory',
          'type'  => 'LEFT',
          'conditions' => array(
            'PostsCategory.post_id = Post.id'
          ) 
        )
      ),
      'order' => array('Post.created' => 'DESC'),
      'limit' => 10,
      'page'  => $page
    );

    $posts = $this->Paginator->paginate('Post');
    $NewsList = array();
    foreach($posts as $post){
      $categories = array();
      $new_post = $post['Post'];
      $new_post['url'] = 'http://qilian.jp/news/detail/'.$new_post['id'];
      unset($new_post['id']);
      if($post['PostsCategory']) {
        foreach ($post['PostsCategory'] as $value) {
          $this->Category->id = $value['category_id'];
          $categories[] = $this->Category->field('name');
        }
      }
      $new_post['categories'] = implode(',', $categories);
      $NewsList[] = $new_post;
    }
    $results = [
                'category_id' => $category_id,
                'sum' => $this->params['paging']['Post']['count'],
                'pageCount' => $this->params['paging']['Post']['pageCount'],
                'currentPage' => $this->params['paging']['Post']['page'],
                'currentPageSum' => $this->params['paging']['Post']['current'],
               ];

    $this->set(compact('results', 'NewsList'));
    $this->set('_serialize', array('results', 'NewsList'));
    } else {
      $results = array('error' => 'category_id is required.');
      $this->set(compact('results'));
      $this->set('_serialize', array('results'));
    }
  }

  // category一览
  public function category() {
    $categories = $this->Category->find(
      'all', 
      array(
        'fields' => array('id', 'name', 'count')
      )
    );
    $categories = Set::extract('/Category/.', $categories);
    // add url to categories
    for($i = 0; $i < count($categories); $i++) {
      $categories[$i]['url'] = 'http://qilian.jp/news/category/'.$categories[$i]['id'].'/';
    }

    $this->set(compact('categories'));
    $this->set('_serialize', array('categories'));
  }

  /* 资讯搜索 */
  public function news_search() {
    if($this->request->query) {
      $q = $this->request->query['q'];
      $page = isset($this->request->query['page']) ? $this->request->query['page'] : 1;
      $this->set('q', $q);
    } else {
      $this->set('_serialize', array('error'=>'please input keywords.'));
    }

    $this->Paginator->settings = array( 
      'fields' => array( 
        'title', 
        'author', 
        'created', 
        'page_views',
        'page_likes',
        'id',
        'image',
        'content'
      ),
      'conditions' => array(
        'OR' => array(
          'Post.title LIKE' => "%".$q."%",
          'Post.content LIKE' => "%".$q."%"
        )
      ),
      'order' => array('Post.id' => 'DESC'),
      'limit' => 10,
      'page'  => $page
    );

    $posts = $this->Paginator->paginate('Post');
    $NewsList = array();
    foreach($posts as $post){
      $categories = array();
      $new_post = $post['Post'];
      $new_post['url'] = 'http://qilian.jp/news/detail/'.$new_post['id'];
      unset($new_post['id']);
      if($post['PostsCategory']) {
        foreach ($post['PostsCategory'] as $value) {
          $this->Category->id = $value['category_id'];
          $categories[] = $this->Category->field('name');
        }
      }
      $new_post['categories'] = implode(',', $categories);
      $NewsList[] = $new_post;
    }
    $results = [
                'q' => $q,
                'sum' => $this->params['paging']['Post']['count'],
                'pageCount' => $this->params['paging']['Post']['pageCount'],
                'currentPage' => $this->params['paging']['Post']['page'],
                'currentPageSum' => $this->params['paging']['Post']['current'],
               ];

    $this->set(compact('results', 'NewsList'));
    $this->set('_serialize', array('results', 'NewsList'));
  }

  // 资讯详情
  public function news_detail() {
    if(!@$this->request->query['id']) {
      $this->set('_serialize', array('null'));
    } else {
      $post = $this->Post->findById($this->request->query['id']);
      $this->set(compact('post'));
      $this->set('_serialize', array('post'));
    }
  }


}
