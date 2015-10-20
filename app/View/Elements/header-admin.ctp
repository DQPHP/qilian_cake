<div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" rel="home" href="#" title="Brand" style="padding-top: 10px; padding-bottom: 10px">
            <img style="height: 30px;" src="/appointment/logo.png">
          </a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="/appointment/course" id="themes">课程管理 <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="/appointment/course">查看课程</a></li>
                <li class="divider"></li>
                <li><a href="/appointment/course/add">添加课程</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="/appointment/image" id="themes">图片管理 <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="/appointment/image">查看图片</a></li>
                <li class="divider"></li>
                <li><a href="/appointment/image/add">添加图片</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="/appointment/post/lists" id="themes">资讯管理 <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="/appointment/news/lists">资讯一览</a></li>
                <li><a href="/appointment/news/add">添加资讯</a></li>
                <li class="divider"></li>
                <li><a href="/appointment/category">资讯分类标签</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="/appointment/post/lists" id="themes">团队成员 <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="/appointment/member">成员一览</a></li>
                <li><a href="/appointment/member/add">添加资讯</a></li>
              </ul>
            </li>

          </ul>

          <ul id="nav-right" class="nav navbar-nav navbar-right">
            <?php if($this->Session->read('Auth.User')):?>
              <li><span class="admin-user"><?php echo $this->Session->read('Auth.User')['realname'];?>，你好。</span></li>
              <li><a class="btn btn-green" href="/appointment/logout">退出</a></li>
            <?php else :?>
              <li><a class="btn btn-blue" href="/appointment/login">登录</a></li>
              <li><a class="btn btn-green" href="/appointment/regist">注册</a></li>
            <?php endif;?>
          </ul>

        </div>
      </div>
    </div>
