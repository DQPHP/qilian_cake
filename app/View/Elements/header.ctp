<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $meta_title;?></title>
    <?php
      // SEO description meta
      echo $this->Html->meta('description', $meta_description);
    ?>
    <?php
      // CSS
      echo $this->Html->css($css, array('media' => 'screen'));
      echo $this->Html->css('animate.css/animate.min.css');
    ?>
    <meta name="google-site-verification" content="EgwZ01J5o7JbFYfg1FBU4gSWscQ44JxcmhVNB3ynCrA" />
    <!-- Custom Fonts -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="/appointment/css/qilian.css"> -->
    <!-- jQuery -->
    <script src="/appointment/js/jquery-1.10.2.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--Start of Zopim Live Chat Script-->
      <script type="text/javascript">
      window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
      $.src="//v2.zopim.com/?31xGnj8gOfcfLDriswJuUK3BiWAfrLL1";z.t=+new Date;$.
        type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
      </script>
<!--End of Zopim Live Chat Script-->

</head>

<body id="qilian">

  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#naver-qilian">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" rel="home" href="/news" title="Brand" style="padding-top: 0px; padding-bottom: 0px">
                <img style="height: 50px;" alt="七联" src="/appointment/logo.png">
              </a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="naver-qilian">
              <ul class="nav navbar-nav">
                  <li>
                      <a href="/news">资讯</a>
                  </li>
                  <li>
                      <a href="/application">客户端</a>
                  </li>
                  <li>
                      <a href="/blog">博客</a>
                  </li>
                  <li>
                      <a href="/about">About</a>
                  </li>
              </ul>

              <!-- <ul class="nav navbar-nav navbar-right">
                <?php if($this->Session->read('Auth.User')):?>
                  <li><a class="btn btn-blue" href="/mypage">个人主页</a></li>
                  <li><a class="btn btn-green" href="/logout">退出登录</a></li>
                <?php else :?>
                  <li><a class="btn btn-blue" href="/login">登录</a></li>
                  <li><a class="btn btn-green" href="/regist">注册</a></li>
                <?php endif;?>
              </ul>
 -->
              <form class="navbar-form navbar-right" role="search" action="http://qilian.jp/news/search" method="get">
                  <div class="input-group">
                        <input name="q" class="form-control" type="text" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>

              </form>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
  </nav>
