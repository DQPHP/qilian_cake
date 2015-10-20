<?php

/*
 * 七联恳亲会
 */

App::uses('CakeEmail','Network/Email');

class PartyController extends AppController {

  public $layout = "bootstrap-agency";
	public $uses = array( 'UserParty' );

	function beforeFilter(){
	    parent::beforeFilter();
	    // 所有方法均可访问
	    $this->Auth->allow();
	}

	/* 
	 * 恳亲会主页
	 */
	public function index() {

    // css
    $this->css = array('bootstrap.min', 'agency', 'simplelightbox.min', 'agency-gallery');
    // script
    $this->script = array('bootstrap.min', 'http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', 'classie', 'cbpAnimatedHeader.min', 'jqBootstrapValidation', 'contact_me', 'agency', 'simple-lightbox.min');
    
    if(isset($this->params->query['success'])) {
      $this->set('status', 'success');
    }

		if($this->request->data) {
      $isApplied = $this->UserParty->findByEmail($this->request->data['email']);
      
      if(isset($isApplied['UserParty']['id'])) {
        $this->request->data['id'] = $isApplied['UserParty']['id'];
        $number = $isApplied['UserParty']['id'];
      }

			if( $this->UserParty->save($this->request->data) ) {
        // 抽奖号码
        if(!$number) $number = $this->UserParty->getLastInsertID();
        
        // 红队白队 偶数红队，奇数白队
        $team = ($number % 2 == 0)?'红队':'白队';
        
				// 注册成功，用户邮箱验证
				$email = $this->request->data['email'];
				$Email = new CakeEmail('gmail');
          /* 向学生发送邮件 */
          $Email->template('party_2015');
          // text送信設定
          $Email->emailFormat('html');
          $Email->viewVars(array(
              'name' => $this->request->data['name'],
              'number' => $number,
              'team' => $team
              ));
          $Email->from('qilianrili@gmail.com','七联就职');
          $Email->to($email);
          $Email->subject('亲，感谢报名参加2015年10月10日的七联恳亲会');
          $Email->send();

	        $this->Session->setFlash(
              '七联 - 2015年度恳亲会报名成功!<br />我们向您的邮箱 <b>'.$email.'</b> 发送一封含有抽奖号码的确认邮件（有可能被分类到垃圾邮件中），请查收。',
              'default',
              array('class' => 'alert alert-success')
          );
			}
      $this->redirect('http://qilian.jp/party/?success#contact');
		} 

	}

}