<div class="well">
  <?php echo $this->Form->create(null, array('url' => array( 'controller' => 'image', 'action' => 'add' ), 'class' => 'form-horizontal', 'name' => 'frm' ));?>
    <fieldset>
      <legend>Slide/广告图像添加</legend>
      
      <div class="form-group">
        <label for="ImageTitle" class="col-lg-2 control-label">标题</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('SlideImage.title', array(
              'type' => 'text',
              'div' => false,
              'label' => false,
              'class' => 'form-control'
          ));?>
        </div>
      </div>
      <div class="form-group">
        <label for="ImageDescription" class="col-lg-2 control-label">简介</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('SlideImage.description',array(
              'type' => 'textarea',
              'class' => 'form-control',
              'label' => false,
              'rows' => '2'
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="ImageUrl" class="col-lg-2 control-label">跳转链接</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('SlideImage.url', array(
              'type' => 'url',
              'div' => false,
              'label' => false,
              'class' => 'form-control'
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="ImageStatus" class="col-lg-2 control-label">状态</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input(
            'SlideImage.status', 
            array(
              'options' => $status_list,
              'label' => false,
              'class' => 'form-control'
            ));
          ?>
        </div>
      </div>

      <div class="form-group">
        <label for="ImageStatus" class="col-lg-2 control-label">类型</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input(
            'SlideImage.type', 
            array(
              'options' => $type_list,
              'label' => false,
              'class' => 'form-control'
            ));
          ?>
        </div>
      </div>

      <div class="form-group">
          <label for="ImageUrl" class="control-label col-lg-2">图像</label>
          <div class="col-lg-10">
            <input type="file" name="file" id="eyecatch_upload"><br />
            <img id="eyecatch_url" src="" style="width: 140px; height: 140px;"/>
            <?php echo $this->Form->input('SlideImage.path', array('type' => 'hidden', 'id' => "eyecatch_image")); ?>
          </div>
      </div>

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
            var fn="/appointment/image/eyecatch_save";
            fn=encodeURI(fn); 
            $(this).upload(fn, function(res) {
                $("#eyecatch_url").attr("src",'/appointment/img/original/'+ res);
                $("#eyecatch_image").attr("value",res);
            }, 'html');
        });
    });
</script>

