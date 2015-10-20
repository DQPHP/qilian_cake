<div class="pull-right">
    <?php echo $this->Html->link('<i class="fa fa-plus-square"></i>新成员加入！', array('action'=>'add'),array('escape' => false,'class' => 'btn btn-blue', 'target' => '_blank') );?>
</div>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>成员姓名</th>
      <th class="col-md-5">简介</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($members as $member):?>
    <tr>
      <td><?php echo $member['Member']['id'];?></td>
      <td><?php echo $member['Member']['name'];?></td>
      <td>
        <?php echo $member['Member']['position'];?><br />
        <?php echo mb_substr($member['Member']['description'], 0, 50);?>...
      </td>
      <td>
        <ul class="list-inline">
          <li>
            <?php 
            echo $this->Html->link('<i class="fa fa-pencil"></i>修改', array('action' => 'modify', $member['Member']['id']), array( 'escape' => false, 'target' => '_blank', 'class' => "btn btn-blue"));
            ?>
          </li>
          <li>
            <?php
            echo $this->Html->link('<i class="fa fa-remove"></i>删除', array('action' => 'delete', $member['Member']['id']), array( 'escape' => false, 'class' => "btn btn-red" ), "确认删除".$member['Member']['name']."老师信息？");
            ?>
          </li>
        </ul>
        
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table> 
<div class="pull-right">
    <?php echo $this->Html->link('<i class="fa fa-plus-square"></i>新成员加入！', array('action'=>'add'),array('escape' => false,'class' => 'btn btn-link', 'target' => '_blank') );?>
</div>
