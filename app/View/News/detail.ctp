<!-- Page Content -->
<div class="container" id="news-detail">
  <!-- Page Heading/Breadcrumbs -->
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">
              <?php echo $post['Post']['title']; ?>
          </h1>
          <?php echo $this->element('breadcrumbs');?>
      </div>
  </div>
  <!-- /.row -->

  <!-- Content Row -->
  <div class="row">
    <!-- Post Content Column -->
    <div class="col-lg-8">
      <!-- Post -->

      <div class="row">
        <div class="col-lg-5">
          <p class="mt5 gray">
              <!-- 阅读数 -->
              <i class="fa fa-eye"></i> <?php echo $post['Post']['page_views'];?> views　　
              <!-- 发布日期 -->
              <i class="fa fa-clock-o"></i> <?php echo $this->DateFormat->makeDateFormat($post['Post']['created']);?>
          </p>
        </div>
        <div class="col-lg-7 mt5">
          <?php foreach($post['PostsCategory'] as $postCategory):?>
             <span class="label label-success">
              <a href="http://qilian.jp/news/category/<?php echo $postCategory['category_id'];?>">
                <i class="fa fa-tag"></i>
                <?php echo $categories[$postCategory['category_id']];?>
              </a>
             </span>
             &nbsp;
          <?php endforeach;?>
          <?php if($this->Session->read('Auth.User')['role'] == 'admin'):?>
            <?php
            echo $this->Html->link('<i class="fa fa-pencil"></i>修改', array('action' => 'modify', $post['Post']['id']), array( 'escape' => false, 'target' => '_blank', 'class' => "btn btn-blue pull-right"));
            ?>
          <?php endif;?>
        </div>
      </div>

      <!-- Post Content Markdown Editor -->
      <div class="post-content">
      <?php echo $this->Markdown->transform($post['Post']['content']); ?>
      </div>
      <div class="clearfix">
        <?php if($neighbor_posts['prev']):?>
          <span class="pull-left">
            <a href="/news/detail/<?php echo $neighbor_posts['prev']['Post']['id']?>">
              前一篇: <?php echo $neighbor_posts['prev']['Post']['title'];?>
            </a>
          </span>
        <?php endif;?>

        <?php if($neighbor_posts['next']):?>
         <span class="pull-right">
            <a href="/news/detail/<?php echo $neighbor_posts['next']['Post']['id']?>">
              下一篇: <?php echo $neighbor_posts['next']['Post']['title'];?>
            </a>
          </span>
        <?php endif;?>
      </div>
      <!-- Duoshuo Comments -->
      <div class="comments" id="comments">
        <div class="ds-share" data-thread-key="<?php echo $post['Post']['id']?>" data-title="<?php echo $post['Post']['title'];?>"  data-content="来自七联资讯" data-url="http://qilian.jp/news/detail/<?php echo $post['Post']['id']?>">
          <div class="ds-share-inline">
            <ul  class="ds-share-icons-16">
              <li data-toggle="ds-share-icons-more"><a class="ds-more" href="javascript:void(0);">分享到：</a></li>
              <li><a class="ds-wechat" href="javascript:void(0);" data-service="wechat">微信</a></li>
              <li><a class="ds-weibo" href="javascript:void(0);" data-service="weibo">微博</a></li>
              <li><a class="ds-facebook" href="javascript:void(0);" data-service="facebook">Facebook</a></li>
            </ul>
            <div class="ds-share-icons-more">
            </div>
          </div>
        </div>
        <div class="ds-thread" data-thread-key="<?php echo $post['Post']['id']?>"
             data-title="<?php echo $post['Post']['title'];?>" data-url="http://qilian.jp/news/detail/<?php echo $post['Post']['id']?>">
        </div>
      </div>
    </div>

    <!-- main-right sidebar -->
    <?php echo $this->element('sidebar-post');?>
    <!-- /main-right sidebar -->

  </div>
  <!-- /.Row -->

  <!-- Duoshuo Social Plugin -->
  <script type="text/javascript">
  var duoshuoQuery = {short_name:"qilian"};
  (function() {
    var ds = document.createElement('script');
    ds.type = 'text/javascript';ds.async = true;
    ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
    ds.charset = 'UTF-8';
    (document.getElementsByTagName('head')[0]
    || document.getElementsByTagName('body')[0]).appendChild(ds);
  })();
  </script>
