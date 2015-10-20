<!-- Page Content -->
<div class="container">
  <!-- Page Heading/Breadcrumbs -->
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><?php echo $teacher['Teacher']['name']?>
              <small>老师预约</small>
          </h1>
          <?php echo $this->element('breadcrumbs');?>
      </div>
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-md-8">
      <div class="well">
          <?php echo $this->Form->create(null, array('url' => array( 'controller' => 'entry', 'action' => 'submit' ), 'class' => 'form-horizontal', 'name' => 'frm' ));?>
          <fieldset>
            <legend><?php echo $teacher['Teacher']['name']?>老师课程预约</legend>
            
            <div class="form-group">
              <label for="StudentRealname" class="col-lg-2 control-label">
                姓名<span class="label label-danger">必须</span>
              </label>
              <div class="col-lg-10">
                <?php echo $this->Form->input('User.realname', array(
                    'type' => 'text',
                    'div' => false,
                    'label' => false,
                    'class' => 'form-control'
                ));?>
              </div>
            </div>
            <div class="form-group">
              <label for="StudentUniversity" class="col-lg-2 control-label">
                大学<span class="label label-info">任意</span>
              </label>
              <div class="col-lg-10">
                <?php echo $this->Form->input('User.university', array(
                    'type' => 'text',
                    'div' => false,
                    'label' => false,
                    'class' => 'form-control'
                ));?>
              </div>
            </div>

            <div class="form-group">
              <label for="StudentMajor" class="col-lg-2 control-label">
                学部专业<span class="label label-info">任意</span>
              </label>
              <div class="col-lg-10">
                <?php echo $this->Form->input('User.major', array(
                    'type' => 'text',
                    'div' => false,
                    'label' => false,
                    'class' => 'form-control'
                ));?>
              </div>
            </div>

            <div class="form-group">
              <label for="StudentEmail" class="col-lg-2 control-label">
                邮箱<span class="label label-danger">必须</span>
              </label>
              <div class="col-lg-10">
                <?php echo $this->Form->input('User.email', array(
                    'type' => 'email',
                    'div' => false,
                    'label' => false,
                    'class' => 'form-control'
                ));?>
              </div>
            </div>

            <div class="form-group form-inline">
              <label for="StudentWechat" class="col-lg-2 control-label">
                微信/Line<span class="label label-danger">必须</span>
              </label>
              <div class="col-lg-10">
                <?php echo $this->Form->input('User.wechat', array(
                    'type' => 'text',
                    'div' => false,
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => '微信ID'
                ));?>
                /
                <?php echo $this->Form->input('User.line', array(
                    'type' => 'text',
                    'div' => false,
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => 'LineID'
                ));?>
              <span class="help-block">微信或Line一项必须</span>
              </div>
            </div>

            <div class="form-group form-inline">
              <label for="EntryTeacherStarttime" class="col-lg-2 control-label">
                预约时间<span class="label label-info">任意</span>
              </label>
              <div class="col-lg-10">
                <?php echo $this->Form->input('EntryTeacher.starttime',array(
                    'type' => 'text',
                    'div' => false,
                    'class' => 'form-control datetimepicker',
                    'label' => false,
                    'readonly' => true
                ));?>
                〜
                <?php echo $this->Form->input('EntryTeacher.endtime',array(
                    'type' => 'text',
                    'div' => false,
                    'class' => 'form-control datetimepicker',
                    'label' => false,
                    'readonly' => true
                ));?>
                <span class="help-block">最终时间请与<?php echo $teacher['Teacher']['name']?>老师协商调整</span>
              </div>
            </div>

            <div class="form-group">
              <label for="AppointmentDescription" class="col-lg-2 control-label">
                备注<span class="label label-info">任意</span>
              </label>
              <div class="col-lg-10">
                <?php echo $this->Form->input('EntryTeacher.note',array(
                    'type' => 'textarea',
                    'class' => 'form-control',
                    'label' => false
                ));?>
              </div>
            </div>
            
            <?php echo $this->Form->input('Teacher.id', array('type' => 'hidden', 'value' => $teacher['Teacher']['id']));?>
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">提交预约</button>
              </div>
            </div>
          </fieldset>
        <?php echo $this->Form->end();?>
      </div>
      <!-- /.well -->
    </div>
    <!-- /.col-md-8 -->

    <div class="col-md-4">
      <div class="text-center">
          <div class="thumbnail">
              <?php 
                echo $this->Html->image($teacher['Teacher']['avatar'], array(
                    "alt" => $teacher['Teacher']['name'],
                    "class" => "inbox",
                    "url" => array('controller' => 'teacher', 'action' => 'detail', $teacher['Teacher']['id'])
                ));
              ?>
              <div class="caption">
                  <h3><?php echo $teacher['Teacher']['name']?><br>
                      <small>Job Title</small>
                  </h3>
                  <p><?php echo $teacher['Teacher']['description'];?></p>
                  <ul class="list-inline">
                      <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                      </li>
                      <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                      </li>
                      <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
    </div>
    <!-- /.col-md-4 -->
  </div>
  <!-- /.row -->



<!-- include timepicker css/js-->
<link rel="stylesheet" href="/appointment/plugin/datetimepicker/jquery.datetimepicker.css" />
<script type="text/javascript" src="/appointment/plugin/datetimepicker/jquery.datetimepicker.js"></script>
<script>
    $('.datetimepicker').datetimepicker({
        step: 15
    });
</script>
