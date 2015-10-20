<!-- Page Content -->
<div class="container">
  <!-- Page Heading/Breadcrumbs -->
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><?php echo $course['Course']['name']?>
              <small>课程预约</small>
          </h1>
          <?php echo $this->element('breadcrumbs');?>
      </div>
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-md-7">
      <?php echo $this->Session->flash(); ?>
      <?php 
        echo $this->Html->image("original/".$course['Course']['image'], array(
            "alt" => $course['Course']['name'],
            "class" => "inbox",
            "url" => array('controller' => 'entry', 'action' => 'course', $course['Course']['id'])
        ));
      ?>
    </div> 

    <div class="col-md-5">
      <div class="media">
          <div class="pull-left">
              <span class="fa-stack fa-2x">
                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                    <i class="fa fa-calendar fa-stack-1x fa-inverse"></i>
              </span> 
          </div>
          <div class="media-body">
              <h4 class="media-heading">上课时间</h4>
              <?php foreach($course['Schedule'] as $schedule): ?>
              <p>
                <i class="fa fa-clock-o"></i> <?php echo $this->DateFormat->makeDateFormat($schedule['datetime_from']);?> ~ 
                <?php echo date("H:i", strtotime($schedule['datetime_to']));?>
              </p>
              <?php endforeach;?>
          </div>
      </div>
      <div class="media">
          <div class="pull-left">
              <span class="fa-stack fa-2x">
                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                    <i class="fa fa-jpy fa-stack-1x fa-inverse"></i>
              </span> 
          </div>
          <div class="media-body">
              <h4 class="media-heading">课程价格</h4>
              <p><?php echo $course['Course']['price'];?></p>
          </div>
      </div>
      <div class="media">
          <div class="pull-left">
              <span class="fa-stack fa-2x">
                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                    <i class="fa fa-users fa-stack-1x fa-inverse"></i>
              </span> 
          </div>
          <div class="media-body">
              <h4 class="media-heading">报名人数</h4>
              <p><?php echo $course['Course']['curr_attendee'];?>/<?php echo $course['Course']['tota_attendee'];?></p>
          </div>
      </div> 
      <div class="media">
          <div class="pull-left">
              <span class="fa-stack fa-2x">
                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                    <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
              </span> 
          </div>
          <div class="media-body">
              <h4 class="media-heading">上课地址</h4>
              <p><?php echo $course['Course']['address'];?></p>
          </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <h3 class="page-header">课程详情</h3>
      <div class="thumbnail">
        <div class="caption">
          <nav id="navbar-qilian" class="navbar navbar-default navbar-static">
            <div class="container-fluid">
              <div class="collapse navbar-collapse bs-qilian-js-navbar-scrollspy">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#description">课程简介</a></li>
                  <li class=""><a href="#content">课程大纲</a></li>
                  <li class=""><a href="#price_detail">费用介绍</a></li>
                </ul>
              </div>
            </div>
          </nav>
          <div data-spy="scroll" data-target="#navbar-qilian" data-offset="0" class="scrollspy-qilian">
            <h3 id="description">课程简介</h3>
            <p><?php echo nl2br($course['Course']['description']);?></p>
            
            <h3 id="content">课程大纲</h3>
            <p><?php echo nl2br($course['Course']['content']);?></p>
            
            <h3 id="price_detail">费用介绍</h3>
            <p><?php echo nl2br($course['Course']['price_detail']);?></p>
          </div>
        </div>
      </div>
      <?php if(isset($entry_successful) && $entry_successful):?>
      <h2>课程报名成功 <small><?php echo $course['Course']['name'];?></small></h2>

      <?php else :?>
      <h2 class="page-header">我要报名<small><?php echo $course['Course']['name']; ?></small></h2>
      <!-- 报名表单 -->
      <?php echo $this->Form->create(null, array('url' => array( 'controller' => 'entry', 'action' => 'course', $course['Course']['id'] ), 'id' => 'EntryUserForm' ));?>
      <fieldset>
        <?php if($course['Schedule']):?>
          <div id="schedule_id"></div>
          <table class="table table-striped table-hover">
            <tr class="info">
              <th class="w005"></th>
              <th class="w050">日程 / 地点</th>
              <th>预约状态</th>
            </tr>
            <?php foreach($course['Schedule'] as $schedule):?>
            <tr>
              <td>
                <input type="checkbox" name="data[EntryUser][schedule_id][]" id="schedule<?php echo $schedule['id']?>" value="<?php echo $schedule['id'];?>">
              </td>
              <td>
                  <label for="schedule<?php echo $schedule['id']?>">
                    <p class="text-primary"><?php echo $schedule['name'];?></p>
                    <i class="fa fa-clock-o"></i> <?php echo $this->DateFormat->makeDateFormat($schedule['datetime_from']);?> ~ 
                    <?php echo date("H:i", strtotime($schedule['datetime_to']));?>
                    <br />
                    <i class="fa fa-building"></i> <?php echo $schedule['address'];?> 
                  </label>
              </td>
              <td>
                  <label for="schedule<?php echo $schedule['id']?>">可以预约</label>
              </td>
            </tr>
            <?php endforeach;?>
        </table>
      <?php endif;?>
        <div class="form-group">
          <label for="EntryUserRealname" class="control-label">
            姓名 <span class="label label-danger">必须</span>
          </label>
            <?php echo $this->Form->input('EntryUser.realname', array(
                'type' => 'text',
                'div' => false,
                'label' => false,
                'class' => 'form-control'
            ));?>
        </div>

        <div class="form-group">
          <label for="EntryUserEmail" class="control-label">
            邮箱 <span class="label label-danger">必须</span>
          </label>
          
            <?php echo $this->Form->input('EntryUser.email', array(
                'type' => 'email',
                'div' => false,
                'label' => false,
                'class' => 'form-control'
            ));?>
        </div>

        <div class="form-group">
          <label for="EntryUserTel" class="control-label">
            手机 <span class="label label-danger">必须</span>
          </label>
          
            <?php echo $this->Form->input('EntryUser.tel', array(
                'type' => 'text',
                'div' => false,
                'label' => false,
                'class' => 'form-control'
            ));?>
        </div>

        <div class="form-group">
          <label for="EntryUserUniversity" class="control-label">
            大学 <span class="label label-danger">必须</span>
          </label>
            <?php echo $this->Form->input('EntryUser.university', array(
                'type' => 'text',
                'div' => false,
                'label' => false,
                'class' => 'form-control'
            ));?>
        </div>

        <div class="form-group">
          <label for="EntryUserGradYear" class="control-label">
            毕业年月 <span class="label label-danger">必须</span>
          </label>
          <div class="row">
            <div class="col-xs-3">
              <?php
                  echo $this->Form->input(
                    'EntryUser.grad_year',
                    array(
                      'options' => $grad_year_list,
                      'selected' => $grad_year_selected,
                      'class' => 'form-control',
                      'label' => false,
                      'div' => false
                    )
                  );
              ?>
            </div>
            <div class="col-xs-3">
              <?php
                  echo $this->Form->input(
                    'EntryUser.grad_month',
                    array(
                      'options' => $grad_month_list,
                      'selected' => $grad_month_selected,
                      'class' => 'form-control',
                      'label' => false,
                      'div' => false
                    )
                  );
              ?>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="EntryUserGrade" class="control-label">
            学年 <span class="label label-danger">必须</span>
          </label>
            <div class="row">
              <div class="col-xs-3">
                <?php
                    echo $this->Form->input(
                      'EntryUser.grade',
                      array(
                        'options' => $grade_list,
                        'selected' => $grade_selected,
                        'class' => 'form-control',
                        'label' => false,
                        'div' => false
                      )
                    );
                ?>
              </div>
            </div>
        </div>

        <div class="form-group">
          <label for="EntryUserMajor" class="control-label">
            学部专业 <span class="label label-danger">必须</span>
          </label>
            <?php echo $this->Form->input('EntryUser.major', array(
                'type' => 'text',
                'div' => false,
                'label' => false,
                'class' => 'form-control'
            ));?>
        </div>

        <div class="form-group">
          <label for="EntryUserCompName" class="control-label">
            就职公司 <span class="label label-info">任意</span> <span class="gray">社会人或已获内定请填所属公司</span>
          </label>
          
            <?php echo $this->Form->input('EntryUser.comp_name', array(
                'type' => 'text',
                'div' => false,
                'label' => false,
                'class' => 'form-control'
            ));?>
        </div>

        <div class="form-group">
          <label for="EntryUserWechat" class="control-label">
            微信 <span class="label label-info">任意</span>
          </label>
            <?php echo $this->Form->input('EntryUser.wechat', array(
                'type' => 'text',
                'div' => false,
                'label' => false,
                'class' => 'form-control',
                'placeholder' => '微信ID'
            ));?>
        </div>

        <div class="form-group">
          <label for="EntryUserLine" class="control-label">
            Line <span class="label label-info">任意</span>
          </label>
             <?php echo $this->Form->input('EntryUser.line', array(
                'type' => 'text',
                'div' => false,
                'label' => false,
                'class' => 'form-control',
                'placeholder' => 'LineID'
            ));?>
        </div>

        <div class="form-group">
          <label for="EntryUserNote" class="control-label">
            备注 <span class="label label-info">任意</span>
          </label>
          
            <?php echo $this->Form->input('EntryUser.note',array(
                'type' => 'textarea',
                'class' => 'form-control',
                'label' => false
            ));?>
        </div>
        <?php echo $this->Form->input('EntryUser.type', array('type' => 'hidden', 'value' => 'course'));?>
        <?php echo $this->Form->input('EntryUser.course_id', array('type' => 'hidden', 'value' => $course['Course']['id']));?>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">马上报名</button>
        </div>
      </fieldset>
    <?php echo $this->Form->end();?>
    <?php endif;?>
    </div>
    <!-- /.col-md-8 -->

    <!-- <div class="col-md-4">
      <h3 class="page-header">导师介绍</h3>
      <div class="text-center">
          <div class="thumbnail">
              <?php 
                echo $this->Html->image(
                  $teacher['Teacher']['avatar'], 
                  array(
                    "alt" => $teacher['Teacher']['name'],
                    "class" => "inbox"
                  )
                );
              ?>
              <div class="caption">
                  <h3><?php echo $teacher['Teacher']['name']?><br>
                      <small>Job Title</small>
                  </h3>
                  <p><?php echo $teacher['Teacher']['description'];?></p>
                  <ul class="list-inline">
                      <li>
                        <a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                      </li>
                      <li>
                        <a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                      </li>
                      <li>
                        <a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
    </div> -->
    <!-- /.col-md-4 -->
  </div>
  <!-- /.row -->
  <script src="/appointment/js/jquery.validate.js"></script>
  <script type="text/javascript">

  $.validator.addMethod('customphone', function (value, element) {
                return this.optional(element) || /^\d{3}-\d{4}-\d{4}$/.test(value) || /^\d{11}$/.test(value)|| /^\d{10}$/.test(value)|| /^\d{2}-\d{4}-\d{4}$/.test(value);
        }, "请确认手机号码格式是否正确");

  $.validator.addMethod('select3ShukatsuDifficulty',function(v, e) {
     return $('[name="data[EntryUser][schedule_id][]"]:checked').length > 0;
  }, '请选择报名日程');

    $("#EntryUserForm").validate({
      rules:{
        "data[EntryUser][tel]": 'customphone',
        "data[EntryUser][schedule_id][]": 'select3ShukatsuDifficulty'
      },
      messages:{
        "data[EntryUser][realname]": {required:"请输入您的中文姓名"},
        "data[EntryUser][email]": {required:"请输入您的常用邮箱"},
        "data[EntryUser][tel]": {required:"请输入手机号码"},
        "data[EntryUser][university]": {required:"请输入您大学"},
        "data[EntryUser][major]": {required:"请输入您的学部专业"}
      },
      errorPlacement: function(error, element) {
        if (element.attr("name") == "data[EntryUser][schedule_id][]" ) {
          error.insertAfter("#schedule_id");
        } else {
          error.insertAfter(element);
        }
      }
    });
</script>