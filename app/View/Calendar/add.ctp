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
              新增企业招聘信息
          </h1>
          <?php echo $this->element('breadcrumbs');?>
      </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <?php echo $this->Form->create('Calendar', array('url' => array( 'controller' => 'calendar', 'action' => 'add' ),  'name' => 'frm' ));?>
      <div class="form-group">
        <label>标题</label>
        <?php echo $this->Form->input('title', array('class' => 'form-control', 'label' => false));?>
      </div>

      <div class="form-group">
        <label>企业名称</label>
        <?php echo $this->Form->input('comp_name', array('class' => 'form-control', 'label' => false));?>
      </div>

      <div class="form-group">
        <label>公司概要</label>
        <?php echo $this->Form->input('content', array( 'id' => 'mdeditor', 'rows' => "10", 'class' => 'form-control', 'label' => false));?>
      </div>

      <div class="form-group">
        <label>募集種別・ポジション</label>
        <?php echo $this->Form->input('position', array( 'type' => 'text',  'class' =>'form-control', 'label' =>false)); ?>
      </div>

      <div class="form-group">
        <label>応募締切・スケジュール</label>
        <?php echo $this->Form->input('schedule', array( 'type' => 'text', 'rows' => '5', 'class' =>'form-control', 'label' =>false)); ?>
      </div>

      <div class="form-group">
        <label>実施内容</label>
        <?php echo $this->Form->input('detail', array( 'type' => 'text', 'rows' => '5', 'class' =>'form-control', 'label' =>false)); ?>
      </div>

      <div class="form-group">
        <label>実施場所</label>
        <?php echo $this->Form->input('location', array( 'type' => 'text', 'rows' => '5', 'class' =>'form-control', 'label' =>false)); ?>
      </div>

      <div class="form-group">
        <label>選考フロー</label>
        <?php echo $this->Form->input('step', array( 'type' => 'text', 'rows' => '5', 'class' =>'form-control', 'label' =>false)); ?>
      </div>

      <div class="form-group">
        <label>参加資格</label>
        <?php echo $this->Form->input('target', array( 'type' => 'text', 'rows' => '5', 'class' =>'form-control', 'label' =>false)); ?>
      </div>

      <div class="form-group">
        <label>募集人数</label>
        <?php echo $this->Form->input('num', array( 'type' => 'text', 'rows' => '5', 'class' =>'form-control', 'label' =>false)); ?>
      </div>

      <div class="form-group">
        <label>信息来源网址</label>
        <?php echo $this->Form->input('source_url', array( 'type' => 'url', 'class' =>'form-control', 'label' =>false)); ?>
      </div>

      <div class="form-group">
        <label>截止时间</label>
        <?php echo $this->Form->input('date',array(
              'type' => 'text',
              'div' => false,
              'class' => 'form-control datetimepicker',
              'label' => false,
              'readonly' => true
          ));?>
      </div>

      <div class="form-group">
        <label class="control-label">业界</label>  
        <?php echo $this->Form->input(
            'Kubun.industryIds', 
            array(
                    'multiple' => 'checkbox', 
                    'options' => $kubunList['industry'], 
                    'div' => 'form-group',
                    'label' => false,
                    'class' => 'checkbox-inline'
                )
            );
        ?>
      </div>

      <div class="form-group">
        <label class="control-label">类型</label>  
        <?php echo $this->Form->input(
            'Kubun.Genreids', 
            array(
                    'multiple' => 'checkbox', 
                    'options' => $kubunList['genre'], 
                    'div' => 'form-group',
                    'label' => false,
                    'class' => 'checkbox-inline'
                )
            );
        ?>
      </div>

      <div class="form-group">
        <label class="control-label">对象毕业年份</label>  
        <?php echo $this->Form->input(
            'Kubun.GradYearids', 
            array(
                    'multiple' => 'checkbox', 
                    'options' => $kubunList['gradyear'], 
                    'div' => 'form-group',
                    'label' => false,
                    'class' => 'checkbox-inline'
                )
            );
        ?>
      </div>

      <?php echo $this->Form->hidden('created', array( 'value'=> date('Y-m-d H:i:s')));?>
      <button type="submit" class="btn btn-primary">保存</button>
      <?php echo $this->Form->end();?>
    </div>
  </div>
  <hr />
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
            var fn="/appointment/news/eyecatch_save";
            fn=encodeURI(fn); 
            $(this).upload(fn, function(res) {
                $("#eyecatch_url").attr("src",'/appointment/img/original/' + res);
                $("#eyecatch_image").attr("value",'http://qilian.jp/appointment/img/original/' + res);
            }, 'html');
        });
    });
</script>

<!-- include timepicker css/js-->
<link rel="stylesheet" href="/appointment/plugin/datetimepicker/jquery.datetimepicker.css" />
<script type="text/javascript" src="/appointment/plugin/datetimepicker/jquery.datetimepicker.js"></script>
<script>
    $('.datetimepicker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        minDate: '<?php echo date('Y-m-d');?>'
    });
</script>
