<div class="well">
  <?php echo $this->Form->create('Member', array('url' => array( 'controller' => 'member', 'action' => 'modify' ), 'class' => 'form-horizontal', 'name' => 'frm' ));?>
    <fieldset>
      <legend>成员信息修改</legend>
      
      <div class="form-group">
        <label for="MemberName" class="col-lg-2 control-label">姓名/昵称 <span class="label label-danger">必须</span></label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('name', array(
              'type' => 'text',
              'div' => false,
              'label' => false,
              'class' => 'form-control'
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="MemberRole" class="col-lg-2 control-label">角色 <span class="label label-danger">必须</span></label>
        <div class="col-lg-10">
          <?php $role_arr = array('manager' => 'Top Class', 'employee' => 'Employee', 'teacher' => 'Teacher');?>
          <?php echo $this->Form->input('role', array(
              'div' => false,
              'label' => false,
              'class' => 'form-control',
              'options' => $role_arr
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="MemberPosition" class="col-lg-2 control-label">Position <span class="label label-danger">必须</span></label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('position', array(
              'type' => 'text',
              'div' => false,
              'label' => false,
              'class' => 'form-control'
          ));?>
          <span class="help-block">老师角色请用半角,分隔,例如: 金融,商社,IT</span>
        </div>
      </div>

      <div class="form-group">
        <label for="MemberBrief" class="col-lg-2 control-label">一句话简介 <span class="label label-danger">必须</span></label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('brief',array(
              'type' => 'text',
              'class' => 'form-control',
              'label' => false,
              'div' => false
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="MemberDescription" class="col-lg-2 control-label">详细介绍 <span class="label label-danger">必须</span></label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('description',array(
              'type' => 'textarea',
              'class' => 'form-control',
              'label' => false,
              'div' => false
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="MemberFb" class="col-lg-2 control-label">Facebook</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('fb',array(
              'type' => 'text',
              'class' => 'form-control',
              'label' => false,
              'div' => false
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="MemberWeibo" class="col-lg-2 control-label">Weibo</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('weibo',array(
              'type' => 'text',
              'class' => 'form-control',
              'label' => false,
              'div' => false
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="MemberWeixin" class="col-lg-2 control-label">Weixin</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('weixin',array(
              'type' => 'text',
              'class' => 'form-control',
              'label' => false,
              'div' => false
          ));?>
        </div>
      </div>

      <div class="form-group">
          <label for="MemberImage" class="control-label col-lg-2">头像</label>
          <div class="col-lg-10">
            <input type="file" name="file" id="eyecatch_upload"><br />
            <img id="eyecatch_url" src="/appointment/img/original/<?php echo $this->request->data['Member']['image']?>" style="width: 140px; height: 140px;"/>
            <?php echo $this->Form->input('image', array('type' => 'hidden', 'id' => "eyecatch_image")); ?>
          </div>
      </div>
      <hr>
      <div class="form-group">
          <label for="MemberImage4x3" class="control-label col-lg-2">头像4:3比例</label>
          <div class="col-lg-10">
            <input type="file" name="file" id="eyecatch_upload_4x3"><br />
            <img id="eyecatch_url_4x3" src="/appointment/img/original/<?php echo $this->request->data['Member']['image_4x3']?>" style="width: 120px; height: 160px;"/>
            <?php echo $this->Form->input('image_4x3', array('type' => 'hidden', 'id' => "eyecatch_image_4x3")); ?>
          </div>
      </div>

      <?php echo $this->Form->hidden('id');?>
      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <button type="submit" class="btn btn-primary">提交修改内容</button>
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
            var fn="/appointment/member/eyecatch_save";
            fn=encodeURI(fn); 
            $(this).upload(fn, function(res) {
                $("#eyecatch_url").attr("src",'/appointment/img/original/'+ res);
                $("#eyecatch_image").attr("value",res);
            }, 'html');
        });

        $('#eyecatch_upload_4x3').change(function() {
            var fn="/appointment/member/eyecatch_save";
            fn=encodeURI(fn); 
            $(this).upload(fn, function(res) {
                $("#eyecatch_url_4x3").attr("src",'/appointment/img/original/'+ res);
                $("#eyecatch_image_4x3").attr("value",res);
            }, 'html');
        });
    });
</script>

