


<!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <?php foreach($slide_images as $slide_image):?>
            <div class="item<?php if($slide_image === reset($slide_images)):?> active<?php endif;?>">
              <?php echo $this->Html->image(
                "original/".$slide_image['SlideImage']['path'], 
                array(
                  "alt" => $slide_image['SlideImage']['title'],
                  "url" => $slide_image['SlideImage']['url']
                )
              );?>
              <div class="carousel-caption">
                    <h2><?php echo $slide_image['SlideImage']['title'];?></h2>
              </div>
            </div>
          <?php endforeach;?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
              <h2 class="page-header">七联公共课</h2>
        </div>
      </div>
        <?php foreach($courses as $course):?>
        <!-- Project One -->
          <div class="row">
            <div class="col-md-4">
                <?php 
                  echo $this->Html->image("original/".$course['Course']['image'], array(
                      "alt" => $course['Course']['name'],
                      "class" => "inbox",
                      "url" => array('controller' => 'entry', 'action' => 'course', $course['Course']['id'])
                  ));
                ?>
            </div>
            <div class="col-md-8">
                <h3><?php echo $course['Course']['name'];?></h3>
                <h4>Subheading</h4>
                <p><?php echo mb_substr($course['Course']['description'],0,180);?>......</p>
                <?php
                  echo $this->Html->link(
                      '了解更多',
                      array('controller' => 'entry', 'action' => 'course', $course['Course']['id']),
                      array('class' => 'btn btn-primary')
                  );
                ?>
            </div>
            </div>
            <!-- /.row -->
        <hr>
        <?php endforeach;?>

        <!-- Team Members -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">七联讲师</h2>
            </div>
            <?php foreach($teachers as $teacher):?>
            <div class="col-md-4 text-center">
                <div class="thumbnail">
                    
                    <?php 
                      echo $this->Html->image($teacher['Teacher']['avatar'], array(
                          "alt" => $teacher['Teacher']['name'],
                          "class" => "inbox",
                          "url" => array('controller' => 'entry', 'action' => 'teacher', $teacher['Teacher']['id'])
                      ));
                    ?>
                    <div class="caption">
                        <h3><?php echo $teacher['Teacher']['name'];?><br>
                            <small>Job Title</small>
                        </h3>
                        <p><?php echo mb_substr($teacher['Teacher']['description'], 0,100)?>...</p>
                        <!-- <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                            </li>
                        </ul> -->
                        <?php
                          echo $this->Html->link(
                              '了解更多',
                              array('controller' => 'entry', 'action' => 'teacher', $teacher['Teacher']['id']),
                              array('class' => 'btn btn-primary')
                          );
                        ?>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <!-- /.row -->