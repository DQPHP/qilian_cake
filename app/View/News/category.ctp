<!-- Page Header -->
<div class="header-banner">
  <div class="container">
    <div class="row">
      <div class="col-md-12 header-message">
        <h1 id="title-fadeIn">精致阅读</h1>
        <hr>
        <h3>传递价值资讯，发现不同自己</h3>
      </div>
    </div>
  </div>
</div><!-- end of header -->
<!-- Page Content -->
<div class="container">
  <!-- Page Heading/Breadcrumbs -->
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">
              资讯一览-<?php echo $category_name;?>
              <small>(<?php echo $this->Paginator->counter('{:count}');?>)</small>
          </h1>
          <?php echo $this->element('breadcrumbs');?>
      </div>
  
    <!-- Blog Entries Column -->
      <div class="col-md-8">
        <?php $ads_loc = rand(1,8);?>
        <?php foreach($posts as $key => $post):?>
         <?php
          if(isset($post['PostsCategory'][0]) && $post['PostsCategory'][0]['category_id'] == 27) {
            
            if(date('Y-m-d') < $post['Post']['created']) {
              $title = $post['Post']['title'].'<span class="label label-danger animated infinite swing" style="display: inline-block;font-size:10px; margin-left:5px;margin-right: 5px;vertical-align: text-top;">火热报名中</span>';
            } else {
              $title = $post['Post']['title'].'<span class="label label-default">报名已截止</span>';
            }
          } else {
            $title = $post['Post']['title'];
          }
        ?>
        <!-- 资讯相关内容 -->
        <div class="col-md-11 news-1">
          <h4>
            <?php
              echo $this->Html->link(
                  $title,
                  'http://qilian.jp/news/detail/'.$post['Post']['id'],
                  array( 'escape' => false )
              );
            ?>
          </h4><!-- /title -->

          <?php if(!$isMobile):?>
            <?php if (isset($post['Post']['image']) && $post['Post']['image']) :?>
              <?php $img_url = $post['Post']['image'];?>
              <?php 
                echo $this->Html->image($img_url, array(
                    "alt" => $post['Post']['title'],
                    "class" => "img-responsive img-hover img-thumbView inbox-blog-list",
                    "url" => 'http://qilian.jp/news/detail/'.$post['Post']['id']
                ));
              ?>
            <?php endif;?>
          <?php endif;?><!-- end of imageView -->

          <h6>
            <ul class="icon-tools">
              <li class="main-list-group"><i class="fa fa-clock-o"></i> <?php echo $this->DateFormat->makeDateFormat($post['Post']['created']);?></li>
              <li class="main-list-group"><i class="fa fa-eye"></i><?php echo $post['Post']['page_views'];?> views</li>
              <?php if($post['PostsCategory']):?>
              <li class="main-list-group">
                <?php foreach($post['PostsCategory'] as $postCategory):?>
                <span class="label label-info">
                <a href="http://qilian.jp/news/category/<?php echo $postCategory['category_id'];?>"> 
                  <i class="fa fa-tag"></i>
                  <?php echo $categories[$postCategory['category_id']];?>
                </a>
                </span>
                &nbsp;
                <?php endforeach;?>　
              </li>
              <?php endif;?>
              
            </ul><!-- end of icon-->
          </h6>

          <p class="description-style">
            <?php $substr_length = $isMobile ? 65 : 220; ?>
            <?php if($post['Post']['description']):?>
                <?php echo mb_substr($post['Post']['description'], 0, $substr_length); ?>
              <?php else :?>
                <?php echo strip_tags($this->Markdown->transform(mb_substr($post['Post']['content'], 0, $substr_length))); ?>
            <?php endif;?> 
          </p>

          <h6>
            <!-- <a class="continue_Reading" href="#">继续阅读</a> -->
            <?php
              echo $this->Html->link(
                  '继续阅读',
                  'http://qilian.jp/news/detail/'.$post['Post']['id'],
                  array('class' => 'continue_Reading')
              );
            ?>
            <!-- <span class="main-bookmark"><i class="fa fa-bookmark-o main-bookmark-time"></i></span>
            <span class="main-readingTime">5 min read</span> -->
          </h6>
          <?php if($this->Session->read('Auth.User')['role'] == 'admin'):?>
            <?php 
            echo $this->Html->link('<i class="fa fa-pencil"></i>修改', array('action' => 'modify', $post['Post']['id']), array( 'escape' => false, 'target' => '_blank', 'class' => "pull-left"));
            ?>
          <?php endif;?>

        </div><!-- /资讯相关内容 -->

        <!-- 广告 -->
        <?php if($key == $ads_loc): ?>
          <div class="col-md-12">
            <?php $alt_title = $adsense[0]['SlideImage']['title'];?>
            <?php $url = $adsense[0]['SlideImage']['url'];?>
            <?php $img_url = 'http://qilian.jp/appointment/img/original/'.$adsense[0]['SlideImage']['path'];?>
            <?php 
              echo $this->Html->image($img_url, array(
                  "alt" => $alt_title,
                  "class" => "img-responsive img-hover event-cover-style",
                  "url" => $url
              ));
            ?>
          </div>
        <?php endif;?>
        <!-- /广告 -->
        
        <?php endforeach;?>
        
        <!-- PageNav -->
        <?php if($this->Paginator->counter('{:pages}') > 1 ): ?>
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
        <?php endif;?>

      </div>

      <!-- main-right sidebar -->
      <?php echo $this->element('sidebar-post');?>
      <!-- /main-right sidebar -->

    </div>
  <!-- /.Row -->