<!-- Page Content -->
<div class="container">
  <!-- Page Heading/Breadcrumbs -->
  <div class="row">
      <div class="col-lg-6 col-lg-offset-3 text-center">
          <h1 class="page-header">会员登录</h1>
      </div>
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-6 col-lg-offset-3" id="main-center">
      <div class="well">
        <?php echo $this->Form->create('User', array('url' => array( 'controller' => 'regist', 'action' => 'login' ), 'class' => 'form-horizontal', 'name' => 'frm' ));?>
          <fieldset>
            <legend>登录页面</legend>
            <?php echo $this->Session->flash(); ?>
            <div class="form-group">
              <label for="StudentEmail" class="col-lg-2 control-label">邮箱</label>
              <div class="col-lg-10">
                <?php echo $this->Form->input('email', array( 'label'=>false,'class'=>'form-control', 'placeholder'=>'great@qilian.jp'));?>
              </div>
            </div>
            <div class="form-group">
              <label for="StudentPasswd" class="col-lg-2 control-label">密码</label>
              <div class="col-lg-10">
                <?php echo $this->Form->input('passwd', array('type' => 'password', 'label'=>false,'class'=>'form-control', 'placeholder'=>'Password'));?>
                <!-- <div class="checkbox">
                  <label>
                    <input type="checkbox"> 记住密码
                  </label>
                </div> -->
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary btn-blue">登录</button>
              </div>
            </div>
          </fieldset>
        <?php echo $this->Form->end();?>
      </div>
    </div>
  </div>
