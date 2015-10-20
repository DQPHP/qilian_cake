<?php echo $this->element('header');?>

    <?php echo $this->fetch('content'); ?>
    <hr>
    <!-- Footer -->
    </div>
    </div>
    <!-- /.container -->
    <!-- Footer -->
    <footer class="footer-layout">
        <div class="container footer-container-layout">
            <div class="row">
                <div class="col-md-7">
                    <div class="footer-links">
                        <ul class="footer-group">
                            <!-- <li><a href="#"  class="footer-sitemap">课程平台</a></li>
                            <li><a href="#"  class="footer-sitemap">求人情报</a></li> -->
                            <li><a href="http://qilian.jp/news" class="footer-sitemap">七联视界</a></li>
                            <li><a href="http://qilian.jp/about" class="footer-sitemap">关于我们</a></li>
                            <li><a href="http://qilian.jp/blog" class="footer-sitemap">博客</a></li>
                        </ul>
                        <p style="color:white">Copyright © 2012-2015 七联 All Rights Reserved.
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-1">
                    <p style="color:white">关注七联，和我们一起震撼世界</p>
                    <a href="https://www.facebook.com/qilian" class="social facebook-share"><i class="fa fa-facebook"></i></a>
                    <a href="http://weibo.com/naanren" class="social weibo-share"><i class="fa fa-weibo"></i></a>
                    <a href="http://qilian.jp/news/" class="social weixin-share"><i class="fa fa-weixin"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- end of footer -->
<!-- Bootstrap Core JavaScript -->
<script src="/appointment/js/bootstrap.min.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.3&appId=309387822549159";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

 ga('create', 'UA-63468000-1', 'auto');
 ga('send', 'pageview');

</script>
</body>
</html>