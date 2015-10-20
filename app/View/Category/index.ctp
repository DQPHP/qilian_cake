<div class="pull-right">
    <?php echo $this->Html->link('<i class="fa fa-plus-square"></i>添加新分类', array('action'=>'add'),array('escape' => false,'class' => 'btn btn-blue', 'target' => '_blank') );?>
</div>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th class="col-md-5">分类名称</th>
      <th class="col-md-2">所属父类</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($categories as $category):?>
    <tr>
      <td><?php echo $category['Category']['id'];?></td>
      <td>
        <h5><strong><?php echo $category['Category']['name'];?></strong></h5>
      </td>
      <td><?php echo $category_list[$category['Category']['parent_id']];?></td>
      <td>
        <ul class="list-inline">
          <li>
            <?php 
            echo $this->Html->link('<i class="fa fa-pencil"></i>修改', array('action' => 'modify', $category['Category']['id']), array( 'escape' => false, 'target' => '_blank', 'class' => "btn btn-blue"));
            ?>
          </li>
          <li>
            <?php
            echo $this->Html->link('<i class="fa fa-remove"></i>删除', array('action' => 'delete', $category['Category']['id']), array( 'escape' => false, 'class' => "btn btn-red" ), "确认删除【".$category['Category']['name']."】课程信息？");
            ?>
          </li>
        </ul>
        
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table> 

