<!-- Page Content -->
<div class="container">
  <!-- Page Heading/Breadcrumbs -->
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">
              预约成功
          </h1>
          <?php echo $this->element('breadcrumbs');?>
      </div>
	</div>
	<!-- /.row -->

	<div class="row">
		<div class="col-lg-9">
			<div class="panel panel-default">
			<?php if($type == 'course'): // 课程预约成功 ?>
				<div class="panel-heading">[预约成功]<?php echo $viewVars['title']?></div>
				<div class="panel-body">
					<?php echo $viewVars['user_name'];?>同学<br />
					感谢您预约<b><?php echo $this->Html->link($viewVars['title'], $viewVars['entry_link']);?></b><br />
					<hr />
					<p><b>预约详情:</b></p>
					课程名称: <?php echo $viewVars['title'];?> <br />
					课程网址: <?php echo $this->Html->link($viewVars['entry_link'], $viewVars['entry_link']);?><br />
					上课地址: <?php echo $viewVars['address'];?> <br />
					课程时间: <?php echo $this->DateFormat->makeDateFormat($viewVars['starttime']);?> ~ <?php echo $this->DateFormat->makeDateFormat($viewVars['endtime']);?>  <br />

				</div>
			<?php elseif($type == 'teacher'):?>
				<div class="panel-heading">[预约成功]<?php echo $viewVars['title']?></div>
				<div class="panel-body">
					<?php echo $viewVars['user_name'];?>同学<br />
					感谢您预约<b><?php echo $this->Html->link($viewVars['title'], $viewVars['entry_link']);?></b>。<br />
					<hr />
					<p>预约详情:</p>
					预约老师: <?php echo $viewVars['title'];?> <br />
					老师网址: <?php echo $this->Html->link($viewVars['entry_link'], $viewVars['entry_link']);?><br />
					预约时间: <?php echo $this->DateFormat->makeDateFormat($viewVars['starttime']);?> ~ <?php echo $this->DateFormat->makeDateFormat($viewVars['endtime']);?>  <br />

				</div>
			<?php endif;?>
			</div><!-- /panel panel-default -->

			<div class="panel panel-default">
				<div class="panel-heading">七联导师推荐</div>
				<div class="panel-body">
					<div class="row">
						<?php foreach($teacher_list as $teacher):?>
			            <div class="col-md-4 text-center">
			                <div class="thumbnail">
			                    
			                    <?php 
			                      echo $this->Html->image($teacher['Teacher']['avatar'], array(
			                          "alt" => $teacher['Teacher']['name'],
			                          "class" => "inbox",
			                          "url" => array('controller' => 'entry', 'action' => 'teacher', $teacher['Teacher']['id'])
			                      ));
			                    ?>
			                    <div class="caption">
			                        <h3><?php echo $teacher['Teacher']['name'];?><br>
			                            <small>Job Title</small>
			                        </h3>
			                        <p><?php echo mb_substr($teacher['Teacher']['description'], 0,100)?>...</p>
			                        <ul class="list-inline">
			                            <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
			                            </li>
			                            <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
			                            </li>
			                            <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
			                            </li>
			                        </ul>
			                        <?php
			                          echo $this->Html->link(
			                              '了解更多',
			                              array('controller' => 'entry', 'action' => 'teacher', $teacher['Teacher']['id']),
			                              array('class' => 'btn btn-primary')
			                          );
			                        ?>
			                    </div>
			                </div>
			            </div>
			            <?php endforeach;?>
				    </div>
				</div>
			</div>
		</div><!-- /main-left -->

		<!-- main-right sidebar -->
		<div class="col-lg-3" id="main-right">
	    <h3>七联优质课</h3>
      <div class="list-group">
   		<?php foreach($course_list as $course):?>
        <a href="/appointment/entry/course/<?php echo $course['Course']['id'];?>" class="list-group-item">
		    <h4 class="list-group-item-heading"><?php echo $course['Course']['name'];?></h4>
		    <p class="list-group-item-text"><?php echo mb_substr($course['Course']['description'], 0, 20);?>......</p>
				</a>
				<?php endforeach;?>
      </div>
		</div>
		<!-- /main-right sidebar -->
	</div>
	<!-- /.row -->