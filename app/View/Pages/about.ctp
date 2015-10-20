<!-- Page Content -->
<div class="container">
  <!-- Page Heading/Breadcrumbs -->
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">
              关于七联 
              <small>About Us</small>
          </h1>
          <?php echo $this->element('breadcrumbs');?>
      </div>
  </div>
  <!-- /.row -->

  <div class="row">
      <div class="col-md-6">
          <img class="img-responsive" src="http://qilian.jp/appointment/img/original/ff8c8d69ec44786822b042ba3cb8d299.jpg" alt="七联团队合影">
      </div>
      <div class="col-md-6">
          <h2>About US</h2>
          <p>【七联】是一个大家庭，各种各样的兄弟姐妹们组成了这个团体。我们一起经历挫折，我们一同努力成长，我们彼此分享快乐，我们也学着坚守梦想。不管你现在是在图书馆里背着怎么也看不进去的英语单词，还是你现在迷茫地看不清未来的方向不知道要往哪走。 不管你现在是在努力着去实现梦想却没能拉近与梦想的距离，还是你已经慢慢地找不到自己的梦想了。 你都要去相信，没有到不了的明天。 正如乔布斯说的：“你的时间有限，所以不要为别人而活。不要被教条所限，不要活在别人的观念里。不要让别人的意见左右自己内心的声音。最重要的是，勇敢的去追随自己的心灵和直觉，只有自己的心灵和直觉才知道你自己的真实想法，其他一切都是次要。”</p>
      </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">First Class</h2>
    </div>

    <?php foreach($members as $member):?>
      <?php if($member['Member']['role'] == 'manager'):?>
      <div class="col-md-3 text-center">
        <div class="col-md-3-style">
            <img class="img-responsive center-block" src="/appointment/img/original/<?php echo $member['Member']['image'];?>">
            <div class="caption-Name">
                <h3>
                  <?php echo $member['Member']['name'];?>
                  <br>
                  <small><?php echo $member['Member']['position'];?></small>
                </h3>
                <blockquote class="quote-style"><?php echo $member['Member']['brief'];?></blockquote>
            </div>
        </div>
      </div>
    <?php endif;?>
    <?php endforeach;?>
</div>

<!-- Employee -->
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Team Member</h2>
    </div>
    <?php foreach($members as $member):?>
      <?php if($member['Member']['role'] == 'employee'):?>
      <div class="col-md-3 text-center">
        <div class="col-md-3-style">
            <img class="img-responsive center-block" src="/appointment/img/original/<?php echo $member['Member']['image'];?>">
            <div class="caption-Name">
                <h3>
                  <?php echo $member['Member']['name'];?>
                  <br>
                  <small><?php echo $member['Member']['position'];?></small>
                </h3>
                <blockquote class="quote-style"><?php echo $member['Member']['brief'];?></blockquote>
            </div>
        </div>
      </div>
      <?php endif;?>
    <?php endforeach;?>
</div>
<!-- /Employee -->


<!-- Teacher -->
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Teachers Team</h2>
    </div>
    <?php foreach($members as $member):?>
      <?php if($member['Member']['role'] == 'teacher'):?>
      <div class="col-md-3 text-center">
        <div class="col-md-3-style">
          <?php if($member['Member']['description']):?>
          <span class="expand-style"><i class="fa fa-expand" data-toggle="modal" data-target="#Intro<?php echo $member['Member']['name'];?>"></i></span>
          <?php endif;?>
            <img class="img-responsive center-block" src="/appointment/img/original/<?php echo $member['Member']['image'];?>">
            <div class="caption-Name">
                <h3>
                  <?php echo $member['Member']['name'];?>
                  <br>
                  <small><?php echo $member['Member']['position'];?></small>
                </h3>
                <blockquote class="quote-style"><?php echo $member['Member']['brief'];?></blockquote>
            </div>
        </div>
      </div>
      <!-- Modal for the member -->
      <div class="modal fade" id="Intro<?php echo $member['Member']['name'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content modal-content-style"> <!-- make the modal view rectangle-->
            <div class="modal-header modal-header-style">
              <h3 class="modal-title modal-title-style" id="myModalLabel">About <?php echo $member['Member']['name'];?></h3>
            </div><!-- end of header -->

            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <!--左边图片框 -->
                  <div class="col-md-4">
                      <img class="img-responsive thumbnail" src="/appointment/img/original/<?php echo $member['Member']['image_4x3'];?>"> <!-- keep in ratio of 4:3 -->
                  </div>
                  <div class="col-md-8">
                    <h2 class="modal-body-name-style"><?php echo $member['Member']['name'];?></h2>
                    <div class="btn-group btn-group-sm modal-body-name-tag-style" role="group" >
                      <?php foreach(explode(',',$member['Member']['position']) as $position):?>
                      <span class="label label-info"><?php echo $position;?></span>
                      <?php endforeach;?>
                    </div>
                    <p class="modal-body-passage-style">
                      <?php echo $member['Member']['description'];?>
                    </p>
                </div><!-- end of detail introduction-->
              </div><!-- end of row-->
            </div><!-- end of fluid -->
          </div><!-- end of modal-body-->

          <div class="modal-footer">
            <a href="#" class="btn modal-footer-btn-style-left" data-dismiss="modal">Back to top</a>
            <?php if($member['Member']['role'] == 'teacher'):?>
            <!-- <a href="#" class="btn modal-footer-btn-style-right">Send message</a> -->
            <?php endif;?>
          </div>
          </div>
        </div>
      </div><!-- end of modal -->
      <?php endif;?>
    <?php endforeach;?>
</div>