 <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
 <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/appointment/plugin/mdeditor/mdeditor.css" media="screen">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="/appointment/plugin/mdeditor/mdeditor.min.js"></script>
<!-- Page Content -->
<div class="container">
  <!-- Page Heading/Breadcrumbs -->
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">
              修改文章
          </h1>
          <?php echo $this->element('breadcrumbs');?>
      </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <?php echo $this->Form->create('Post', array('url' => array( 'controller' => 'news', 'action' => 'modify' ),  'name' => 'frm' ));?>
      <div class="form-group">
        <label>标题</label>
        <?php echo $this->Form->input('title', array('class' => 'form-control', 'label' => false));?>
      </div>
      <div class="form-group">
        <label>简介</label>
        <?php echo $this->Form->input('description', array( 'rows' => '4', 'class' => 'form-control', 'label' => false));?>
      </div>
      <div class="form-group">
        <label>文章内容</label>
        <textarea name="data[Post][content]" id="mdeditor" cols="30" rows="10" class="form-control"><?php echo $this->request->data['Post']['content'];?></textarea>
      </div>

      <div class="form-group">
          <label for="TeacherImage">特色图片</label>
            <input type="file" name="file" id="eyecatch_upload"><br />
            <img id="eyecatch_url" style="width: 140px; height: 140px;" src="<?php echo $this->request->data['Post']['image'];?>" class="img-rounded"/>
            <?php echo $this->Form->input('image', array('type' => 'hidden', 'id' => "eyecatch_image")); ?>
      </div>

      <div class="form-group">
        <label>发布时间</label>
        <?php echo $this->Form->input('created',array(
              'type' => 'text',
              'div' => false,
              'class' => 'form-control datetimepicker',
              'label' => false,
              'readonly' => true
          ));?>
      </div>

      <div class="form-group">
        <label class="control-label">大分类</label>  
        <?php echo $this->Form->input(
            'Category.ids', 
            array(
                    'multiple' => 'checkbox', 
                    'options' => $categories, 
                    'selected' => $post_category_selected,
                    'div' => 'form-group',
                    'label' => false,
                    'class' => 'checkbox-inline'
                )
            );
        ?>
      </div>
      <?php echo $this->Form->hidden('id');?>
      <button type="submit" class="btn btn-primary">Submit</button>
      <?php echo $this->Form->end();?>
    </div>
  </div>
  <script>
  var md = new MdEditor('#mdeditor', {
    uploader: '/appointment/img/upload.php',
    preview: true,
    images: [
      {id: '1.jpg', url: 'http://lorempicsum.com/futurama/200/200/1'}
    ]
  });
</script>

<!-- Include jquery.uplaod-1.0.2.min.js For Realtime Image Display -->
<script src="/appointment/js/jquery.upload-1.0.2.min.js"></script>
<script>
    $(function() {
        $('#eyecatch_upload').change(function() {
            var fn="/appointment/course/eyecatch_save";
            fn=encodeURI(fn); 
            $(this).upload(fn, function(res) {
                $("#eyecatch_url").attr("src",'/appointment/img/original/' + res);
                $("#eyecatch_image").attr("value", 'http://qilian.jp/appointment/img/original/' + res);
            }, 'html');
        });
    });
</script>
<!-- include timepicker css/js-->
<link rel="stylesheet" href="/appointment/plugin/datetimepicker/jquery.datetimepicker.css" />
<script type="text/javascript" src="/appointment/plugin/datetimepicker/jquery.datetimepicker.js"></script>
<script>
    $('.datetimepicker').datetimepicker({
        step: 30
    });
</script>