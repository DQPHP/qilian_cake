<?php

App::uses('CakeEmail','Network/Email');

class EmailController extends AppController {
  public $uses = ['UserParty'];
	
	function beforeFilter(){
	    parent::beforeFilter();
	    // 所有方法均可访问
	    $this->Auth->allow();
	}

	public function index() {
		$this->autoRender = false;

    $users = $this->UserParty->find(
            'all', 
            array(
              'fields' => array('id', 'name', 'email'),
              'conditions' => array('alert_mail' => 0),
              'limit' => 20,
              )
            );
    
    $users = Set::extract('/UserParty/.', $users);

    foreach($users as $user) {
      $id    = $user['id'];
      $email = $user['email'];
      $name  = $user['name'];
      $team = ($id % 2 == 0)?'红队':'白队'; // 偶数红队，奇数白队
      
      $Email = new CakeEmail('gmail');

      /* 向学生发送邮件 */
      $Email->template('party_alert');
      // text送信設定
      $Email->emailFormat('html');
      $Email->viewVars(array(
          'name' => $name,
          'number' => $id,
          'team' => $team
          ));
      $Email->from('info@qilian.jp','七联就职');
      $Email->to($email);
      $Email->bcc('dongqiang.v@gmail.com');
      $Email->subject('七联2015年度华人恳亲会一周倒计时');
      $Email->send();

      $update_data = array('id' => $id, 'alert_mail' => 1);
      $this->UserParty->save($update_data);
    }
		

	} 


}