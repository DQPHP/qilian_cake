
<!-- Page Content -->
<div class="container" id="news-detail">
  <!-- Page Heading/Breadcrumbs -->
  <div class="row">
      <div class="col-lg-12">
          <h2 class="page-header">
              最新企业说明会信息一览
          </h2>
          <?php echo $this->element('breadcrumbs');?>
      </div>
  </div>
  <!-- /.row -->

  <!-- Content Row -->
  <div class="row">
    <!-- calendar List -->
    <div class="col-lg-8">
      <div class="panel panel-default">
        <div class="panel-heading">分类检索</div>
        <div class="panel-body">
          <?php echo $this->Form->create(null, array( 'url' => 'http://qilian.jp/appointment/calendar/', 'id' => 'Form',  'name' => 'frm' ));?>
          <div class="form-group">
            <label class="control-label">卒業年度</label>  
            <?php echo $this->Form->input(
                'kubun.grad_year', 
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

          <div class="form-group">
            <label class="control-label">カテゴリー</label>  
            <?php echo $this->Form->input(
                'kubun.genre', 
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
            <label class="control-label">業界</label>  
            <?php echo $this->Form->input(
                'kubun.industry', 
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
          <?php echo $this->Form->end();?>
        </div>
      </div>
      
    	<?php foreach($calendars as $calendar):?>
    		<div class="well well-sm">
    			<h4>
    			<?php echo $this->Html->link(mb_substr($calendar['Calendar']['title'], 0, 30).'...', array('action' => 'detail', $calendar['Calendar']['id']));?>
    				<span class="label label-danger pull-right">締切: <?php echo $calendar['Calendar']['date'];?></span>
    			</h4>
    			<?php foreach($calendar['KubunRelation'] as $calendarKubun):?>
		             <span class="label label-success">
		                <i class="fa fa-tag"></i>
		                <?php echo $kubuns[$calendarKubun['kubun_id']];?>
		             </span>
		             &nbsp;
		          <?php endforeach;?>
    		</div>
    	<?php endforeach; ?>
    </div>

    <!-- main-right sidebar -->
    <?php echo $this->element('sidebar-post');?>
    <!-- /main-right sidebar -->

  </div>
  <!-- /.Row -->
  <script>
  // this will handle click events on any checkbox on the page
  $(document).on("click", "input[type='checkbox']", function(){
      // or AJAX post here
      this.form.submit();
  });
  $(document).on("click", "input[type='radio']", function(){
      // or AJAX post here
      this.form.submit();
  });
  </script>