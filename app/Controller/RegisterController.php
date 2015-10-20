<?php
/*
 * 会员注册，登录
 */
App::uses('CakeEmail','Network/Email');
class RegisterController extends AppController {

	public $uses = array( 'User' );

	function beforeFilter(){
	    parent::beforeFilter();
	    // 所有方法均可访问
	    $this->Auth->allow();
	}

	/* 
	 * 会员注册页
	 */
	public function index() {
    $this->css[] = ['register', 'flexslider'];

		if($this->request->data) {
			if( $this->request->data['User']['uniqid'] == $this->Session->read('uniqid') && $this->User->save($this->request->data) ) {
				// 注册成功，用户邮箱验证
				$email = $this->request->data['User']['email'];
				$Email = new CakeEmail();
                /* 向学生发送邮件 */
                $Email->template('regist_confirm');
                $Email->viewVars(array(
                      'realname' => $this->request->data['User']['realname'], 
                      'uniqid' => $this->request->data['User']['uniqid'], 
                      'email' => $this->request->data['User']['email'],
                      'passwd' => $this->request->data['User']['passwd']
                      ));
                $Email->from('pr@qilian.jp','七联就职社');
                $Email->to($email);
                $Email->transport('Mail');
                $Email->subject('【七联就职】用户注册验证');
                $Email->send();

                /* 向后台管理员发送邮件 */
                $Email->reset();
                // 送信模板設定
                $Email->template('regist_admin');
                // text送信設定
                $Email->emailFormat('text');
                // 送信内容設定
                $contentArr = $this->request->data['User'];
                $Email->viewVars($contentArr);
                $Email->from(array('pr@qilian.jp' => '七联就职'));
                $Email->to('dongqiang.v@gmail.com');
                // タイトル
                $Email->subject('会员注册通知[七联就职]');
                // 送信する
                $Email->send();

				        $this->Session->setFlash(
                      '注册成功，我们向您的邮箱 <b>'.$email.'</b> 发送一封验证邮件，请登录邮箱完成验证。',
                      'default',
                      array('class' => 'well well-lg')
                );
                $this->set('status', 'regist_success');

                $this->Session->delete('uniqid');
			}
		} else {
			$this->Session->write('uniqid', md5(uniqid()));
		}

	}


	/* 
	 * 会员登录页 
	 * Router::connect('/login', array('controller' => 'regist', 'action' => 'login'));
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
	 * 邮箱验证
	 */
  public function confirm($uniqid = null) {
    $this->autoRender = false;
    //$uniqid = $this->request->query['uniqid'];
    $user = $this->User->findByUniqid($uniqid);

    if(isset($user['User']['confirmed'])){     // 如果该用户存在

          if($user['User']['confirmed']){      // 验证完毕,跳转至登录页面
                $this->Session->setFlash('您的邮箱已验证完毕，请登录。', 'flash_success');
                $this->redirect('/login');
          }else{                                    // 未验证，验证结束后跳转至登录页面
                $this->User->id = $user['User']['id'];
                $this->User->saveField('confirmed', '1');
                $this->Session->setFlash('您的邮箱已验证完毕，请登录。', 'flash_success');
                $this->redirect('/login');
          }
    }else{                                          // 该用户不存在，跳转至错误页面
          $this->Session->setFlash('用户不存在，请重新注册.', 'flash_error');
          $this->redirect('/regist');
    }
	}

    /*
     * 退出登录
     */
    public function logout(){
        $this->redirect($this->Auth->logout());
    }

}