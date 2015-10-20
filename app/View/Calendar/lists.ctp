<div class="row pull-right">
    <?php echo $this->Html->link('<i class="fa fa-plus-square"></i>添加新资讯', array('action'=>'add'),array('escape' => false,'class' => 'btn btn-blue', 'target' => '_blank') );?>
</div>

<nav>
  <ul class="pagination">
    <li class="previous">
      <?php echo $this->Paginator->prev(__('«'), array('tag' => false));?>
    </li>
    <?php echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => false, 'currentClass' => 'active', 'currentTag' => 'a'));?>
    <li class="next">
      <?php echo $this->Paginator->next(__('»'), array('tag' => false));?>
    </li>
  </ul>
</nav>

<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th class="col-md-5">标题</th>
      <th>创建时间</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($calendars as $calendar):?>
    <tr>
      <td><?php echo $calendar['Calendar']['id'];?></td>
      <td>
        <h5>
          <a href="/calendar/detail/<?php echo $calendar['Calendar']['id'];?>">
            <?php echo $calendar['Calendar']['title'];?>
          </a>
        </h5>
      </td>
      <td><?php echo $calendar['Calendar']['created'];?></td>
      <td>
        <ul class="list-inline">
          <li>
            <?php 
            echo $this->Html->link('<i class="fa fa-pencil"></i>修改', array('action' => 'modify', $calendar['Calendar']['id']), array( 'escape' => false, 'target' => '_blank', 'class' => "btn btn-blue"));
            ?>
          </li>
          <li>
            <?php
            echo $this->Html->link('<i class="fa fa-remove"></i>删除', array('action' => 'delete', $calendar['Calendar']['id']), array( 'escape' => false, 'class' => "btn btn-red" ), "确认删除【".$calendar['Calendar']['title']."】课程信息？");
            ?>
          </li>
        </ul>
        
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table> 
<!-- Pager -->
<nav>
  <ul class="pagination">
    <li class="previous">
      <?php echo $this->Paginator->prev(__('«'), array('tag' => false));?>
    </li>
    <?php echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => false, 'currentClass' => 'active', 'currentTag' => 'a'));?>
    <li class="next">
      <?php echo $this->Paginator->next(__('»'), array('tag' => false));?>
    </li>
  </ul>
</nav>

