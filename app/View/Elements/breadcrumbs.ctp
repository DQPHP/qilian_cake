<?php if(isset($breadcrumbs)):?>
<ol class="breadcrumb">
  <?php foreach($breadcrumbs as $key => $val):?>
    <?php if ($val === end($breadcrumbs)):?>
    <li class="active">
      <?php echo $val;?>
    </li>
    <?php else: ?>
    <li>
      <a href="<?php echo $key;?>">
        <?php echo $val;?>
      </a>
    </li>
    <?php endif;?>              
  <?php endforeach;?>
</ol>
<?php endif;?>