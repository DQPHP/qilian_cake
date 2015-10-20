<div class="pull-right">
    <?php echo $this->Html->link('<i class="fa fa-plus-square"></i>添加课程', array('action'=>'add'),array('escape' => false,'class' => 'btn btn-blue', 'target' => '_blank') );?>
</div>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th class="col-md-5">课程情况</th>
      <th class="col-md-2">报名情况</th>
      <th>创建时间</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($courses as $course):?>
    <tr>
      <td><?php echo $course['Course']['id'];?></td>
      <td>
        <h5><strong><?php echo $course['Course']['name'];?></strong></h5>
        <?php echo mb_substr($course['Course']['description'], 0, 50); ?>...
      </td>
      <td><?php echo $course['Course']['curr_attendee']?>／<?php echo $course['Course']['tota_attendee']?></td>
      <td><?php echo $course['Course']['modified'];?></td>
      <td>
        <ul class="list-inline">
          <li>
            <?php 
            echo $this->Html->link('<i class="fa fa-pencil"></i>修改', array('action' => 'modify', $course['Course']['id']), array( 'escape' => false, 'target' => '_blank', 'class' => "btn btn-blue"));
            ?>
          </li>
          <li>
            <?php
            echo $this->Html->link('<i class="fa fa-remove"></i>删除', array('action' => 'delete', $course['Course']['id']), array( 'escape' => false, 'class' => "btn btn-red" ), "确认删除【".$course['Course']['name']."】课程信息？");
            ?>
          </li>
        </ul>
        
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table> 

