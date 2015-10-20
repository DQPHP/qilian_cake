<div class="pull-right">
    <?php echo $this->Html->link('<i class="fa fa-plus-square"></i>添加老师', array('action'=>'add'),array('escape' => false,'class' => 'btn btn-blue', 'target' => '_blank') );?>
</div>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>教师姓名</th>
      <th class="col-md-5">教师简介</th>
      <th>创建时间</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($teachers as $teacher):?>
    <tr>
      <td><?php echo $teacher['Teacher']['id'];?></td>
      <td><?php echo $teacher['Teacher']['name'];?></td>
      <td><?php echo mb_substr($teacher['Teacher']['description'], 0, 50);?>...</td>
      <td><?php echo $teacher['Teacher']['modified'];?></td>
      <td>
        <ul class="list-inline">
          <li>
            <?php 
            echo $this->Html->link('<i class="fa fa-pencil"></i>修改', array('action' => 'modify', $teacher['Teacher']['id']), array( 'escape' => false, 'target' => '_blank', 'class' => "btn btn-blue"));
            ?>
          </li>
          <li>
            <?php
            echo $this->Html->link('<i class="fa fa-remove"></i>删除', array('action' => 'delete', $teacher['Teacher']['id']), array( 'escape' => false, 'class' => "btn btn-red" ), "确认删除".$teacher['Teacher']['name']."老师信息？");
            ?>
          </li>
        </ul>
        
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table> 
<div class="pull-right">
    <?php echo $this->Html->link('<i class="fa fa-plus-square"></i>新規追加', array('action'=>'add'),array('escape' => false,'class' => 'btn btn-link', 'target' => '_blank') );?>
</div>
