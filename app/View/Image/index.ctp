<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <?php foreach($images as $image):?>
        <div class="item <?php if ($image === reset($images)):?>active<?php endif;?>">
          <img src="/appointment/img/original/<?php echo $image['SlideImage']['path'];?>">
        </div>
        <?php endforeach;?>
      </div>
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
</div> 
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>图像缩略图</th>
      <th >图像标题</th>
      <th>创建时间</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($images as $image):?>
    <tr>
      <td><?php echo $image['SlideImage']['id'];?></td>
      <td>
        <img id="eyecatch_url" style="width: 64px; height: 64px;" src="/appointment/img/original/<?php echo $image['SlideImage']['path'];?>" class="img-rounded"/>
      </td>
      <td><?php echo mb_substr($image['SlideImage']['title'], 0, 10);?>...</td>
      <td><?php echo $image['SlideImage']['modified'];?></td>
      <td>
        <ul class="list-inline">
          <li>
            <?php 
            echo $this->Html->link('<i class="fa fa-pencil"></i>修改', array('action' => 'modify', $image['SlideImage']['id']), array( 'escape' => false, 'target' => '_blank', 'class' => "btn btn-blue"));
            ?>
          </li>
          <li>
            <?php
            echo $this->Html->link('<i class="fa fa-remove"></i>删除', array('action' => 'delete', $image['SlideImage']['id']), array( 'escape' => false, 'class' => "btn btn-red" ), "确认删除".$image['SlideImage']['title']."图像信息？");
            ?>
          </li>
        </ul>
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table> 
<div class="pull-right">
    <?php echo $this->Html->link('<i class="fa fa-plus-square"></i>添加图片', array('action'=>'add'),array('escape' => false,'class' => 'btn btn-blue', 'target' => '_blank') );?>
</div>

