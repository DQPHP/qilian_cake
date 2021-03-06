<!-- 注册 & 登陆-->
<div class="container-fluid login-section-layout" id="Login">
  <!-- 标题党-->
  <div class="row login-title">
    <div class="col-md-6 col-md-offset-3">
      <h2 style="text-align:center;">现在开始，加入七联大家庭</h2>
      <p>有生之年，一起去看看这个美丽易碎的世界吧！</p>
    </div>
  </div>
    
  <!-- slide + 内容-->
  <div class="row">
    <!-- 左侧的slideshow -->
    <div class="col-md-5 col-xs-10 col-xs-offset-1">
      <!-- image here -->
        <div class="col-md-10">
          <div class="flexslider">
            <ul class="slides">
              <li>
                <img class="img-responsive" alt="Responsive image" src="http://qilian.jp/appointment/img/register_left_img.png"  style="margin-top:-40px">
              </li>
              <li>
                <img class="img-responsive" alt="Responsive image" src="http://qilian.jp/appointment/img/register_left_img_1.png" style="margin-top:-40px"/>
              </li>
              <li>
                <img class="img-responsive" alt="Responsive image" src="http://qilian.jp/appointment/img/register_left_img_2.png" style="margin-top:-40px"/>
              </li>
            </ul>
          </div>
        </div>
    </div>

    <!-- 重置密码 -->
    <div class="col-md-4 col-xs-12">
      <form action="#" method="post" role="form">
        <div class="form-group form-group-lg"><!-- Email -->
          <div class="input-group has-feedback">
            <span class="input-group-addon "><i class="fa fa-envelope"></i></span>
            <input type="text" class="form-control " placeholder="电子邮件">
          </div>
        </div>
        <div class="form-group form-group-lg"><!-- Password -->
          <div class="input-group has-feedback">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              <input type="password" class="form-control" id="#" aria-describedby="inputGroupSuccess1Status" placeholder="密码">
          </div>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox"> 保持登录
          </label>
          <span style="float:right"><a href="forgetPassword.html">忘记密码了?</a></span>
        </div>
        <button type="submit" class="btn btn-success btn-block btn-lg">让我们开始吧！</button>

        <hr>
        <h5 style="text-align:center">或者</h5>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="submit" class="btn btn-danger"><i class="fa fa-google"></i></button>
          </div>
          <div class="btn-group" role="group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-facebook"></i></button>
          </div>
        </div>
      </form><!-- end of 注册 -->
    </div>

  </div> <!-- end of slide + 内容-->
</div><!-- end of 注册 & 登陆-->

<!-- FLexSlider -->
<script src="/appointment/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" charset="utf-8">
    $(window).load(function() {
    $('.flexslider').flexslider();
    });
</script>
