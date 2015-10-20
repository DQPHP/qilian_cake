<!-- Blog Sidebar Widgets Column -->

<div class="col-md-4 widget-col-md-4">
  <div class="col-md-12 sidebar-layouts">
      <h4 class="sidebar-section-title"><i class="fa fa-tags"></i> 分类浏览</h4>
          <?php foreach($category_list as $id => $category_count):?>
                  <a class="btn btn-default sidebar-tags" href="/news/category/<?php echo $id;?>" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $category_count[key($category_count)];?>">
                      <?php echo key($category_count); ?>
                  </a>
          <?php endforeach;?>
  </div>
  <div class="col-md-12 sidebar-layouts"><!-- 5 Top Picks Articles -->
    <h4 class="sidebar-section-title"><i class="fa fa-thumb-tack"></i>人气推荐</h4>
    <?php foreach($favor_news as $news):?>
    <div class="sidebar-topPick-block">
      <h4>
        <?php
          echo $this->Html->link(
              '<i class="fa fa-star"></i> '.$news['Post']['title'],
              'http://qilian.jp/news/detail/'.$news['Post']['id'],
              array('escape' => false)
          );
        ?>
      </h4>
      <p class="side-bar-topPick-description">
        <?php echo $news['Post']['description'];?>
      </p>
    </div>
    <?php endforeach;?>
  </div>

  <!-- Side Widget Well -->
  <div class="col-md-12">
      <div class="fb-page" data-href="https://www.facebook.com/qilian" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/qilian"><a href="https://www.facebook.com/qilian">七聯</a></blockquote></div></div>
  </div>
  <div class="col-md-12 sidebar-layouts">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- response_ads -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-4542123257727700"
         data-ad-slot="8975991275"
         data-ad-format="auto"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
  </divUF>
</div>