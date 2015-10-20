<div class="well">
    <?php echo $this->Form->create('Category', array('url' => array( 'controller' => 'category', 'action' => 'modify' ), 'class' => 'form-horizontal' ));?>
    <fieldset>
      <legend>资讯分类修改</legend>
      
      <div class="form-group">
        <label for="CategoryName" class="col-lg-2 control-label">名称</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('name', array(
              'type' => 'text',
              'div' => false,
              'label' => false,
              'class' => 'form-control'
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="CategorySlug" class="col-lg-2 control-label">英语简略</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('slug', array(
              'type' => 'text',
              'div' => false,
              'label' => false,
              'class' => 'form-control'
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="CategoryBoderLeftColor" class="col-lg-2 control-label">颜色设置</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('border_left_color', array(
              'type' => 'text',
              'div' => false,
              'label' => false,
              'class' => 'form-control'
          ));?>
        </div>
      </div>

      <div class="form-group">
        <label for="CategoryDescription" class="col-lg-2 control-label">描述</label>
        <div class="col-lg-10">
          <?php echo $this->Form->input('description', array(
              'type'  => 'textarea',
              'label' => false,
              'class' => 'form-control',
              'rows'  => 4
          ));?>
        </div>
      </div>
      <?php echo $this->Form->hidden('id');?>
      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <button type="submit" class="btn btn-primary">确认添加</button>
        </div>
      </div>
    </fieldset>
  <?php echo $this->Form->end();?>
</div>