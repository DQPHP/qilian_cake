  <style>
      body {
        background: none;
        overflow:hidden; /*prevent the up-down scroll*/
      }
      #qilian {
        /*背景图片全屏，responstive*/
        /*在最开头(html处)添加这个class*/
        background: url(/appointment/img/comingSoon_bgd.jpg) no-repeat center center fixed;
      }
      /*一举一动都是承诺*/
      .slogan-style{
        margin-top: 60px;
        max-height: 88px;
        width: auto;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        animation-name: bgd;
        animation-duration: 6s;
      }
      /*coming soon*/
      .title-style{
        color: #ecf0f1;
        opacity: 0.6;
        font-size: 44px;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        animation-name: bgd;
        animation-duration: 4s;
      }

      /*iPhone的定义*/
      .iphone-style{
        max-height: 800px;
        margin-top: 5%;
        z-index: 0;
        animation-name: iPhone;
        animation-duration: 3s;
      }

      /*bgd from 0 to 1 (opacity)*/
      @keyframes bgd{
        0% {opacity: 0};
        50%{opacity: 0.5};
        100%{opacity: 1};
      }
      @-webkit-keyframes bgd{
        0% {opacity: 0};
        50%{opacity: 0.5};
        100%{opacity: 1};
      }

      /*iPhone down - to - up*/
      /*Standard*/
      @keyframes iPhone{
        0% {margin-top: 35%;};
        50%{margin-top: 25%;};
        100%{margin-top: 15%;};
      }
      /*Chrome, Safari, Opera*/
      @-webkit-keyframes iPhone{
        0% {margin-top: 55%;};
        50%{margin-top: 35%;};
        100%{margin-top: 15%;};
      }

      /*ease-in-out transition*/
      /*Standard*/
      #ease-in-out{
        animation-timing-function: ease-in-out;
      }
      /*Chrome, Safari, Opera*/
      #ease-in-out{
        -webkit-animation-timing-function: ease-in-out;
      }
    </style>
<!-- Page Content -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <img src="/appointment/img/comingSoon_slogan.png" class="img-responsive center-block slogan-style" alt="Responsive image";>
        <h1 class="text-center title-style">Coming Soon ...</h1>
    </div><!-- 承诺 -->
    <div class="col-md-12">
        <img src="/appointment/img/comingSoon_iPhone_whole.png" id="ease-in-out" class="img-responsive center-block iphone-style" alt="Responsive image">
    </div><!-- iPhone客户端 -->