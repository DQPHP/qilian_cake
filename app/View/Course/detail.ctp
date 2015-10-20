<div id="course-detail" class="container">
  <div class="course-header">
      <div class="row outer-box">
        <div class="col-md-4">
          <?php 
          echo $this->Html->image("original/".$course['Course']['image'], array(
            "alt" => $course['Course']['name'],
            "class" => "left-block"
        ));
          ?>
        </div>
        <div class="col-md-2">
          <span>课程价格</span> 
          <em><?php echo $course['Course']['price'];?></em>
        </div>
        <div class="col-md-2">
          <span>已报名人数</span>
          <em><?php echo $course['Course']['curr_attendee']?></em>
        </div>
        <div class="col-md-2 second-last">
          <span>课程时长</span>
          <em>2小时</em>
        </div>
        <div class="col-md-2 last">
          <?php
          echo $this->Html->link(
              '报名',
              array('controller' => 'entry', 'action' => 'course', $course['Course']['id'])
          );
          ?>
        </div>
      </div>
    </div>

    <div class="col-md-12 course-body">
      <div class="row">
        <div class="col-md-8">
          <div class="inner-box">
            <nav id="navbar-qilian" class="navbar navbar-default navbar-static">
              <div class="container-fluid">
                <div class="navbar-header">
                  <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-qilian-js-navbar-scrollspy">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#"></a>
                </div>
                <div class="collapse navbar-collapse bs-qilian-js-navbar-scrollspy">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="#description">课程简介</a></li>
                    <li class=""><a href="#content">课程大纲</a></li>
                    <li class=""><a href="#price_detail">费用介绍</a></li>
                    <li class=""><a href="#address">上课地址</a></li>
                  </ul>
                </div>
              </div>
            </nav>
            <div data-spy="scroll" data-target="#navbar-qilian" data-offset="0" class="scrollspy-qilian">
              <h3 id="description">课程简介</h3>
              <p><?php echo nl2br($course['Course']['description']);?></p>
              
              <h3 id="content">课程大纲</h3>
              <p><?php echo nl2br($course['Course']['content']);?></p>
              
              <h3 id="price_detail">费用介绍</h3>
              <p><?php echo nl2br($course['Course']['price_detail']);?></p>
              <h3 id="address">上课地址</h3>
              <p><?php echo nl2br($course['Course']['address']);?></p>
            </div> 
          </div>         
      </div>
        
        <div class="col-md-4">
          <div class="inner-box">
            <a href="#" >
              <img class="center-block" src="/appointment/img/<?php echo $teacher['Teacher']['avatar']?>" alt="<?php echo $teacher['Teacher']['name'];?>">
            </a>
            <div class="box-body">
              <h3 class="text-center"><?php echo $teacher['Teacher']['name'];?></h3>
              <p><?php echo $teacher['Teacher']['description'];?></p>
            </div>
            <div class="box-footer text-center">
              <?php
                echo $this->Html->link(
                    '联系老师',
                    array('controller' => 'entry', 'action' => 'teacher', $teacher['Teacher']['id']),
                    array('class' => 'btn btn-blue')
                );
              ?>
            </div>
          </div>
        </div>

        </div>
      </div>
  </div>


