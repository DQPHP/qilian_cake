<div class="well">
    <?php echo $this->Form->create(null, array('url' => array( 'controller' => 'course', 'action' => 'modify' ), 'id' => 'Course',  'class' => 'form-horizontal', 'name' => 'frm' ));?>
    <fieldset>
      <legend>课程信息修改</legend>
      
      <div class="form-group">
        <label for="CourseName" class="col-lg-2 control-label">名称</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('Course.name', array(
              'type' => 'text',
              'div' => false,
              'label' => false,
              'class' => 'form-control'
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="CourseAddress" class="col-lg-2 control-label">地点</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('Course.address', array(
              'type' => 'text',
              'div' => false,
              'label' => false,
              'class' => 'form-control'
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="CourseTotaAttendee" class="col-lg-2 control-label">上限人数</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('Course.tota_attendee', array(
              'type' => 'text',
              'div' => false,
              'label' => false,
              'class' => 'form-control'
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="CourseCurrAttendee" class="col-lg-2 control-label">已报名人数</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('Course.curr_attendee', array(
              'type' => 'text',
              'div' => false,
              'label' => false,
              'class' => 'form-control',
              'disabled' => true
          ));?>
        </div>
      </div>

      <div class="form-group form-inline">
        <label for="CourseStarttime" class="col-lg-2 control-label">课程时间</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('Course.starttime',array(
              'type' => 'text',
              'div' => false,
              'class' => 'form-control datetimepicker',
              'label' => false
          ));?>
          〜
          <?php echo $this->Form->input('Course.endtime',array(
              'type' => 'text',
              'div' => false,
              'class' => 'form-control datetimepicker',
              'label' => false
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="CourseName" class="col-lg-2 control-label">每课时价钱</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('Course.price', array(
              'type' => 'text',
              'div' => false,
              'label' => false,
              'class' => 'form-control'
          ));?>
        </div>
      </div>


      <div class="form-group">
        <label for="CourseDescription" class="col-lg-2 control-label">费用介绍</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('Course.price_detail',array(
              'type' => 'textarea',
              'class' => 'form-control',
              'label' => false,
              'rows' => '8'
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="CourseDescription" class="col-lg-2 control-label">简介</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('Course.description',array(
              'type' => 'textarea',
              'class' => 'form-control',
              'label' => false,
              'rows' => '8'
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="CourseDescription" class="col-lg-2 control-label">课程大纲</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('Course.content',array(
              'type' => 'textarea',
              'class' => 'form-control',
              'label' => false,
              'rows' => '8'
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-lg-2">授课教师</label>  
        <div class="col-lg-10">
        <?php echo $this->Form->input(
            'Course.teacher', 
            array(
                    'multiple' => 'checkbox', 
                    'options' => $teachers, 
                    'selected' => $teacher_checked,
                    'div' => 'form-group',
                    'label' => false,
                    'class' => 'checkbox-inline'
                )
            );
        ?>
        </div>
      </div>

      <div class="form-group">
          <label for="TeacherImage" class="control-label col-lg-2">课程图片</label>
          <div class="col-lg-10">
            <input type="file" name="file" id="eyecatch_upload"><br />
            <img id="eyecatch_url" style="width: 140px; height: 140px;" src="/appointment/img/original/<?php echo $this->request->data['Course']['image'];?>" class="img-rounded"/>
            <?php echo $this->Form->input('Course.image', array('type' => 'hidden', 'id' => "eyecatch_image")); ?>
          </div>
      </div>

      <?php echo $this->Form->input('Course.id', array('type' => 'hidden'));?>
      <legend>课程日程修改添加</legend>
      <!-- 日程表 -->
      <div id="schedule">
          <?php foreach($this->request->data['Schedule'] as $key => $schedule): ?>
            <div class="schedule">
              <hr>
              <div class="row">
                <div class="col-lg-2 pull-right">
                  <a href="http://qilian.jp/appointment/schedule/delete/<?php echo $schedule['id'];?>" class="remove_field" id="remove_field"><i class="fa fa-trash"></i>削除该日程信息</a>
                </div>
              </div>
              <input type="hidden" name="data[Schedule][<?php echo $key; ?>][id]" value="<?php echo $schedule['id']?>" />
              <input type="hidden" name="data[Schedule][<?php echo $key; ?>][course_id]" value="<?php echo $schedule['course_id']?>" />

              <div class="form-group">
                <label class="col-lg-2 control-label">课程名称</label>
                <div class="col-lg-10">
                  <input name="data[Schedule][<?php echo $key; ?>][name]" value="<?php echo $schedule['name'];?>" placeholder="例:XX课程第一期" class="form-control" type="text"/>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-2 control-label">地点</label>
                <div class="col-lg-10">
                  <input name="data[Schedule][<?php echo $key; ?>][address]" value="<?php echo $schedule['address'];?>" class="form-control" type="text"/>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-2 control-label">上限人数</label>
                <div class="col-lg-10">
                  <input name="data[Schedule][<?php echo $key; ?>][limit]" value="<?php echo $schedule['limit'];?>" class="form-control" type="text"/>
                </div>
              </div>

              <div class="form-group form-inline">
                <label for="CourseStarttime" class="col-lg-2 control-label">课程时间</label>
                <div class="col-lg-10">
                  <input name="data[Schedule][<?php echo $key; ?>][datetime_from]" value="<?php echo $schedule['datetime_from'];?>" class="form-control datetimepicker" readonly="readonly" type="text"/>
                  〜
                  <input name="data[Schedule][<?php echo $key; ?>][datetime_to]" value="<?php echo $schedule['datetime_to'];?>" class="form-control datetimepicker" readonly="readonly" type="text"/>
                </div>
              </div>
            </div>
          <?php endforeach;?>
      </div>
      <a id="addRow" class="btn btn-warning pull-right"><i class="fa fa-calendar"></i> 继续添加新日程</a>
      <!-- /日程表 -->

      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <button type="submit" class="btn btn-primary">提交修改</button>
        </div>
      </div>
    </fieldset>
  <?php echo $this->Form->end();?>
</div>
<!-- Templete for Schedule -->
<div class="schedule-templete hidden">
  <hr>
  <div class="row">
  <div class="col-lg-2 pull-right">
    <a href="#" class="remove_field" id="remove_field"><i class="fa fa-trash"></i>削除该日程信息</a>
  </div>
  </div>
  <input type="hidden" name="course_id" value="<?php echo $this->data['Course']['id']?>">
  <div class="form-group">
    <label for="CourseAddress" class="col-lg-2 control-label">课程名称</label>
    <div class="col-lg-10">
      <input name="name" class="form-control" type="text" placeholder="例:XXX课程第X期"/>    </div>
  </div>

  <div class="form-group">
    <label for="CourseAddress" class="col-lg-2 control-label">地点</label>
    <div class="col-lg-10">
      <input name="address" class="form-control" type="text" value="〒101-0024 東京都千代田区神田和泉1-11-17 プラントビル2階"/>    </div>
  </div>

  <div class="form-group">
    <label for="CourseTotaAttendee" class="col-lg-2 control-label">上限人数</label>
    <div class="col-lg-10">
      <input name="limit" class="form-control" type="text"/>    </div>
  </div>

  <div class="form-group form-inline">
    <label for="CourseStarttime" class="col-lg-2 control-label">课程时间</label>
    <div class="col-lg-10">
      <input name="starttime" class="form-control datetimepicker" readonly="readonly" type="text"/>      〜
      <input name="endtime" class="form-control datetimepicker" readonly="readonly" type="text"/>    </div>
  </div>
</div>

<!-- include timepicker css/js-->
<link rel="stylesheet" href="/appointment/plugin/datetimepicker/jquery.datetimepicker.css" />
<script type="text/javascript" src="/appointment/plugin/datetimepicker/jquery.datetimepicker.js"></script>
<script>
    $('.datetimepicker').datetimepicker({
        step: 30,
        allowTimes: ["10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", 
          "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", 
          "19:00", "19:30", "20:00", "20:30", "21:00", "21:30", "22:00", "22:30", "23:00"]
 
    });
    $('#addRow').click(function () {
           $('<div/>', {
               'class' : 'schedule', html: GetHtml()
            }).hide().appendTo('#schedule').slideDown('slow');
            $('.datetimepicker').datetimepicker({
               step:30,
               allowTimes: ["10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", 
                "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", 
                "19:00", "19:30", "20:00", "20:30", "21:00", "21:30", "22:00", "22:30", "23:00"]
            });
     });

    $('#schedule').on('click', '.remove_field', function(){
        alert('确认删除该日程吗？');
        $.get(event.target);
        $(this).parent().parent().parent().css( 'background-color', '#01AC91' );
        $(this).parent().parent().parent().fadeOut("slow", function() {
            $(this).remove();
            
        });
        return false;
    });

    function GetHtml() {
        var len = $('.schedule').length;
        var $html = $('.schedule-templete').clone();
        $html.find('[name=name]')[0].name = "data[Schedule][" + len + "][name]";
        $html.find('[name=course_id]')[0].name = "data[Schedule][" + len + "][course_id]";
        $html.find('[name=address]')[0].name = "data[Schedule][" + len + "][address]";
        $html.find('[name=limit]')[0].name = "data[Schedule][" + len + "][limit]";
        $html.find('[name=starttime]')[0].name = "data[Schedule][" + len + "][datetime_from]";
        $html.find('[name=endtime]')[0].name = "data[Schedule][" + len + "][datetime_to]";
        return $html.html();    
    }
</script>
<!-- Include jquery.uplaod-1.0.2.min.js For Realtime Image Display -->
<script src="/appointment/js/jquery.upload-1.0.2.min.js"></script>
<script>
    $(function() {
        $('#eyecatch_upload').change(function() {
            var fn="/appointment/course/eyecatch_save";
            fn=encodeURI(fn); 
            $(this).upload(fn, function(res) {
                $("#eyecatch_url").attr("src",'/appointment/img/original/'+ res);
                $("#eyecatch_image").attr("value",res);
            }, 'html');
        });
    });
</script>
