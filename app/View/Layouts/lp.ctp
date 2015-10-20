
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>七联 - 在日最大就职支援平台</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Course-tab CSS -->
    <link href="css/qilian-tab.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- LandingPage CSS -->
    <link href='css/landingPage.css' rel='stylesheet' />

    <!-- Calendar CSS & JS -->
    <link href='css/calendarCSS/fullcalendar.css' rel='stylesheet' />
    <link href='css/calendarCSS/fullcalendar.print.css' rel='stylesheet' media='print' />

    <!-- FlexSlider CSS-->
    <link href='css/flexslider.css' rel='stylesheet'/>

    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php echo $this->fetch('content'); ?>
<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Calendar JS -->
<script src='js/calendarJS/moment.min.js'></script>
<script src='js/calendarJS/jquery.min.js'></script>
<script src='js/calendarJS/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            defaultDate: '2015-10-01',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [
              {
                id: 1,
                title: '七联恳亲会',
                url: 'http://qilian.jp/party',
                start: '2015-10-10T18:00:00',
                end: '2015-10-10T22:00:00'
              },
              {
                id: 2,
                title: 'ヤフービジネスコースインターン',
                url: 'http://qilian.jp/calendar/detail/31',
                start: '2015-10-14',
                end: '2015-10-14'
              },
              {
                id: 3,
                title: '外资就职宣讲会',
                url: 'http://qilian.jp/news/detail/220/',
                start: '2015-10-17T10:00:00',
                end: '2015-10-17T12:00:00'
              }
            ]
        });
    });
</script>

<!-- FLexSlider -->
<script src="js/jquery.flexslider-min.js"></script>
<script type="text/javascript" charset="utf-8">
    $(window).load(function() {
    $('.flexslider').flexslider();
    });
</script>

<!-- jQuery.jsの読み込み -->

<!-- スムーズスクロール部分の記述 -->
<script>
$(function(){
   // #で始まるアンカーをクリックした場合に処理
     $('a[href^=#]').click(function() {
        // スクロールの速度
        var speed = 600; // ミリ秒
        // アンカーの値取得
        var href= $(this).attr("href");

        if (href=="#service-industryInfo" || href=="#service-selflearning" || href=="#service-interview" || href=="#service-exercise") {
            // 为了去掉这几个tab时候使用的anchor
        }
        else{
        // 移動先を取得
        var target = $(href == "#" || href == "" ? 'html' : href);
        // 移動先を数値で取得
        var position = target.offset().top;
        // スムーススクロール
        $('body,html').animate({scrollTop:position}, speed, 'swing');
        return false;}
     });
});
</script>

</body>
</html>
