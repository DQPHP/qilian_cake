<div class="well">
    <?php echo $this->Form->create(null, array('url' => array( 'controller' => 'teacher', 'action' => 'modify' ), 'id' => 'Teacher',  'class' => 'form-horizontal', 'name' => 'frm' ));?>
    <fieldset>
      <legend>老师信息修改</legend>
      
      <div class="form-group">
        <label for="TeacherName" class="col-lg-2 control-label">姓名</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('Teacher.name', array(
              'type' => 'text',
              'div' => false,
              'label' => false,
              'class' => 'form-control'
          ));?>
        </div>
      </div>
      <div class="form-group">
        <label for="TeacherDescription" class="col-lg-2 control-label">简介</label>
        <div class="col-lg-10">
          <!-- <textarea class="form-control" rows="3" id="textArea"></textarea> -->
          <?php echo $this->Form->input('Teacher.description',array(
              'type' => 'textarea',
              'class' => 'form-control',
              'label' => false,
              'rows' => '8'
          ));?>
        </div>
      </div>
      <div class="form-group">
          <label for="TeacherImage" class="control-label col-lg-2">老师头像</label>
          <div class="col-lg-10">
            <input type="file" name="file" id="eyecatch_upload"><br />
            <img id="eyecatch_url" style="width: 140px; height: 140px;" src="/appointment/img/original/<?php echo $this->request->data['Teacher']['avatar'];?>" class="img-rounded"/>
            <?php echo $this->Form->input('Teacher.avatar', array('type' => 'hidden', 'id' => "eyecatch_image")); ?>
          </div>
      </div>
      <?php echo $this->Form->input('Teacher.id', array('type' => 'hidden'));?>
      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </fieldset>
  <?php echo $this->Form->end();?>
</div>
<!-- Include jquery.uplaod-1.0.2.min.js For Realtime Image Display -->
<script src="/appointment/js/jquery.upload-1.0.2.min.js"></script>
<script>
    $(function() {
        $('#eyecatch_upload').change(function() {
            var fn="/appointment/teacher/eyecatch_save";
            fn=encodeURI(fn); 
            $(this).upload(fn, function(res) {
                $("#eyecatch_url").attr("src",'/appointment/img/original/'+ res);
                $("#eyecatch_image").attr("value",res);
            }, 'html');
        });
    });
</script>
