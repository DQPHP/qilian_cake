<!-- Page Content -->
<div class="container">
  <!-- Page Heading/Breadcrumbs -->
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">
              个人主页
              <small>(<?php echo $this->Session->read('Auth.User')['realname'];?>)</small>
          </h1>
          <?php //echo $this->element('breadcrumbs');?>
      </div>
  </div>
  <!-- /.row -->

  <div class="row">
    <!-- Menu -->
    <div class="col-lg-2">
      <div class="list-group">
        <a href="/appointment/teacher" class="list-group-item">我的简历</a>
        <a href="/appointment/course" class="list-group-item">我的课程</a>
        <a href="/appointment/image" class="list-group-item">我的喜爱</a>
        <a href="/appointment/entry" class="list-group-item">修改密码</a>
      </div>
    </div><!-- /Menu -->

    <!-- Main -->
    <div class="col-lg-7">

      <?php if(isset($adsense)): // 最新活动广告链接?>
        <div class="col-md-12">
            <?php $alt_title = $adsense['title'];?>
            <?php $url = $adsense['url'];?>
            <?php $img_url = 'http://qilian.jp/appointment/img/original/'.$adsense['path'];?>
            <?php 
              echo $this->Html->image($img_url, array(
                  "alt" => $alt_title,
                  "class" => "img-responsive img-hover event-cover-style",
                  "url" => $url
              ));
            ?>
          </div>
      <?php endif;?>

      <!-- 资讯相关 -->
      <div class="col-md-12 mt20">
        <ul class="nav nav-tabs" role="tablist">
          <li class="active">
            <a href="#new" role="tab" data-toggle="tab">最新资讯</a>
          </li>
          <li>
            <a href="#favor" role="tab" data-toggle="tab">热门资讯</a>
          </li>
        </ul>

        <div class="tab-content mt10">
          <div  class="tab-pane fade active in" id="new">
            <ul class="media-list">
              <?php foreach($new_news as $news):?>
              <li class="media">
                <?php if (isset($news['Post']['image']) && $news['Post']['image']) :?>
                  <?php $img_url = $news['Post']['image'];?>
                  <div class="media-left">
                    <?php 
                        echo $this->Html->image($img_url, array(
                            "alt" => $news['Post']['title'],
                            "class" => "img-hover img-thumbView inbox-blog-list-mypage",
                            "url" => 'http://qilian.jp/news/detail/'.$news['Post']['id']
                        ));
                      ?>
                  </div>
                <?php endif;?>
                
                <div class="media-body">
                  <h4 class="media-heading">
                    <?php
                      echo $this->Html->link(
                          $news['Post']['title'],
                          'http://qilian.jp/news/detail/'.$news['Post']['id']
                      );
                    ?>
                  </h4>
                  <?php echo $news['Post']['description'];?>
                </div>
              </li>
              <?php endforeach;?>
            </ul>
          </div>

          <div  class="tab-pane fade in" id="favor">
            <ul class="media-list">
              <?php foreach($favor_news as $news):?>
              <li class="media">
                <?php if (isset($news['Post']['image']) && $news['Post']['image']) :?>
                  <?php $img_url = $news['Post']['image'];?>
                  <div class="media-left">
                    <?php 
                        echo $this->Html->image($img_url, array(
                            "alt" => $news['Post']['title'],
                            "class" => "img-hover img-thumbView inbox-blog-list-mypage",
                            "url" => 'http://qilian.jp/news/detail/'.$news['Post']['id']
                        ));
                      ?>
                  </div>
                <?php endif;?>
                
                <div class="media-body">
                  <h4 class="media-heading">
                    <?php
                      echo $this->Html->link(
                          $news['Post']['title'],
                          'http://qilian.jp/news/detail/'.$news['Post']['id']
                      );
                    ?>
                  </h4>
                  <?php echo $news['Post']['description'];?>
                </div>
              </li>
              <?php endforeach;?>
            </ul>
          </div>

        </div>
      </div>
      <!-- /资讯相关 -->


    </div><!-- /Main -->

    <!-- Right recommend -->
    <div class="col-lg-3">
    	
    </div><!-- /Right recommend -->

	</div>
  <!-- /.Row -->