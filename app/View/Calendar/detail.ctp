<!-- Page Content -->
<div class="container" id="news-detail">
  <!-- Page Heading/Breadcrumbs -->
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">
              <?php echo $calendar['Calendar']['title']; ?>
          </h1>
          <?php echo $this->element('breadcrumbs');?>
      </div>
  </div>
  <!-- /.row -->

  <!-- Content Row -->
  <div class="row">
    <!-- calendar Content Column -->
    <div class="col-lg-8">
      <!-- calendar -->
      
      <div class="row">
        <div class="col-lg-3">
          <p class="mt5 gray">　
              <!-- 发布日期 -->
              <i class="fa fa-clock-o"></i> <?php echo $this->DateFormat->makeDateFormat($calendar['Calendar']['created']);?>
          </p>
        </div>
        <div class="col-lg-9 mt5">
          <?php foreach($calendar['KubunRelation'] as $kubun):?>
             <span class="label label-success">
              <a href="http://qilian.jp/calendar/category/<?php echo $kubun['kubun_id'];?>">
                <i class="fa fa-tag"></i>
                <?php echo $kubuns[$kubun['kubun_id']];?>
              </a>
             </span>
             &nbsp;
          <?php endforeach;?>
          <?php if($this->Session->read('Auth.User')['role'] == 'admin'):?>
            <?php 
            echo $this->Html->link('<i class="fa fa-pencil"></i>修改', array('action' => 'modify', $calendar['Calendar']['id']), array( 'escape' => false, 'target' => '_blank', 'class' => "btn btn-blue pull-right"));
            ?>
          <?php endif;?>
        </div>
      </div>
      
      <!-- calendar Content Markdown Editor -->
      <div class="calendar-content">
        <div class="alert alert-danger" role="alert">
          締切: <?php echo date('Y年m月d日', strtotime($calendar['Calendar']['date']));?>
        </div>

        <?php echo $this->Markdown->transform($calendar['Calendar']['content']); ?>
      </div>
      
      <?php if($id != 25):?> 
      <h3>実施要項</h3>
      <table class="table table-hover table-striped table-bordered table-bgd-color">
        <tr>
          <th>会社名</th>
          <td><?php echo $calendar['Calendar']['comp_name']; ?></td>
        </tr>

        <tr>
          <th class="col-md-3">募集種別</th>
          <td><?php echo nl2br($calendar['Calendar']['position']); ?></td>
        </tr>

        <tr>
          <th>実施内容</th>
          <td><?php echo nl2br($calendar['Calendar']['detail']); ?></td>
        </tr>

        <tr>
          <th>時期・日程</th>
          <td>
            <?php echo nl2br($calendar['Calendar']['schedule']); ?>
          </td>
        </tr>

        <tr>
          <th>実施場所</th>
          <td><?php echo nl2br($calendar['Calendar']['location']); ?></td>
        </tr>

        <tr>
          <th>選考フロー</th>
          <td><?php echo nl2br($calendar['Calendar']['step']); ?></td>
        </tr>

        <tr>
          <th>選募集人数</th>
          <td><?php echo nl2br($calendar['Calendar']['num']); ?></td>
        </tr>

        <tr>
          <th>参加資格</th>
          <td><?php echo nl2br($calendar['Calendar']['target']); ?></td>
        </tr>
        
        <tr>
          <th>報応募締切</th>
          <td><?php echo nl2br($calendar['Calendar']['date']); ?></td>
        </tr>

        <tr>
          <th>七联推荐指数</th>
          <td>
            <span><i class="fa fa-star"></i></span>
            <span><i class="fa fa-star"></i></span>
            <span><i class="fa fa-star"></i></span>
            <span><i class="fa fa-star"></i></span>
            <span><i class="fa fa-star"></i></span>
          </td>
        </tr>

      </table>
      <!-- 
                <h3>会社情報</h3>

                <table class="table table-hover table-striped table-bordered table-bgd-color">
                  <tr>
                    <td class="col-md-3">会社名</td>
                    <td>アビーム コンサルティングは</td>
                  </tr>
                  <tr>
                    <td>ホームページ</td>
                    <td>
                      <a href="http://jp.abeam.com/">http://jp.abeam.com/</a>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>設立日</td>
                    <td>
                      1981年4月1日
                    </td>
                  </tr>
                  <tr>
                    <td>事業内容</td>
                    <td>
                      総合コンサルティングサービス：
戦略／組織コンサルティング、プロセスコンサルティング、IT
コンサルティング、ERP導入コンサルティング等、経営革新に
必要な全ての領域において、トータルなビジネスコンサルティング
サービスを提供します。
                      <ul>
                        <li>■マネジメント コンサルティング<br>
　　（経営診断・戦略立案・M&A・アライアンス）</li>
                        <li>■ビジネスプロセス コンサルティング<br>
　　（業務改革・組織改革・アウトソーシング）</li>
                        <li>■ITコンサルティング<br>
　　（IT 戦略・企画立案・システム開発・パッケージ導入・保守）</li>
<li>■アウトソーシング</li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>住所</td>
                    <td>100-0005　東京都千代田区丸の内1-4-1　丸の内永楽ビルディング</td>
                  </tr>
                  <tr>
                    <td>代表者</td>
                    <td>代表取締役社長 岩澤 俊典</td>
                  </tr>

                  <tr>
                    <td>従業員数</td>
                    <td>4,145名（2015年4月1日現在　連結）</td>
                  </tr>
                  <tr>
                    <td>事業所</td>
                    <td>■海外拠点数：11の国と地域21拠点（2015年4月1日現在 子会社含む）<br>
■提携パートナー拠点数：32の国と地域67拠点（2015年1月28日現在）<br><br>

■国内拠点：東京、仙台、名古屋、大阪、沖縄<br>
■海外主要拠点：<br>
　米国、中国、韓国、シンガポール、マレーシア、タイ、<br>
　インドネシア、英国、ドイツ、スイス 、ブラジル</td>
                  </tr>
                  
                  <tr>
                    <td>報応募締切</td>
                    <td>各開催日程の1営業日前　17:00まで
                      ※「営業日」とは土・日・祝祭日を除いた日です。
                    </td>
                  </tr>
                </table> -->

      <?php elseif($id == 1000000):?>
      <h3>実施要項</h3>
      <table class="table table-hover table-striped table-bordered table-bgd-color">
                  <tr>
                    <td>会社名</td>
                    <td>ヤフー株式会社 (Yahoo Japan Corporation)</td>
                  </tr>
                  <tr>
                    <td class="col-md-3">募集種別</td>
                    <td>2017年卒　ビジネスコース</td>
                  </tr>
                  <tr>
                    <td>実施内容</td>
                    <td>
                      ヤフーのビジネスはインターネット広告やeコマースなど、さまざまな事業の収益から成り立っています。 <br>また他社と連携して行うビジネスも多く、大規模かつ幅広いビジネスフィールドでチャレンジできます。 入社後の業務領域には以下のものがあります。

                      <h4>企画提案営業</h4>
                      ヤフーのビジネスサービスの売り上げを最大化するための「企画提案営業」を行います。Yahoo! JAPANユーザーはもちろんのこと、広告主やヤフオク!・Yahoo!ショッピングの出店者など、その課題解決の範囲は多岐に渡ります。

                      <h4>コーポレート</h4>
                      経理、法務、企業戦略、IR、人事など、各専門分野のスペシャリストとして、全社にかかわる業務を行います。
                      
                      <h4>編集・その他ビジネス業務</h4>

                      編集は必要な情報を最適な形でユーザーに届ける仕事です。メディアとしてのYahoo! JAPANの影響力を正しく理解し、真にユーザーの課題解決となる情報発信を担います。既存の表現にとらわれず、インターネットらしい情報の伝え方も探求していきます。ビジネスコースではその他、他社との提携を進めるアライアンス業務など、多様な業務範囲があります。
                    </td>
                  </tr>
                  <tr>
                    <td>応募締切</td>
                    <td>
                      【1次締切】10月14日（水）12：00<br>
                      締切までにエントリーシートをご提出いただき、選考を通過された方には、 <br>下記日程の座談会をご案内させていただく予定です。※任意参加 <br>
                      東京…11月2日（月）、11月4日（水） <br>
                      大阪…10月29日（木）<br>
                    </td>
                  </tr>
                  <tr>
                    <td>実施場所</td>
                    <td>東京　大阪</td>
                  </tr>
                  <tr>
                    <td>選考フロー</td>
                    <td>1：webエントリーシート提出<br>
2：適性検査<br>
3：会社説明会・座談会（任意）<br>
4：Interview（複数回）<br>
5：内々定</td>
                  </tr>
                  <tr>
                    <td>参加資格</td>
                    <td>2017年3月までに大学院・大学・短大・高専・専門学校を卒業または卒業見込みで、2017年4月に入社可能な方</td>
                  </tr>
                  <tr>
                    <td>七联推荐指数</td>
                    <td>
                      <span><i class="fa fa-star"></i></span>
                      <span><i class="fa fa-star"></i></span>
                      <span><i class="fa fa-star"></i></span>
                      <span><i class="fa fa-star"></i></span>
                      <span><i class="fa fa-star"></i></span>
                    </td>
                  </tr>
                  
                </table>

                <h3>会社情報</h3>

                <table class="table table-hover table-striped table-bordered table-bgd-color">
                  <tr>
                    <td class="col-md-3">会社名</td>
                    <td>ヤフー株式会社　Yahoo Japan Corporation</td>
                  </tr>
                  <tr>
                    <td>ホームページ</td>
                    <td>
                      <a href="http://http://docs.yahoo.co.jp//">http://docs.yahoo.co.jp/</a>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>設立日</td>
                    <td>
                      1996年1月31日
                    </td>
                  </tr>
                  <tr>
                    <td>事業内容</td>
                    <td>
                      ヤフーのビジネスはインターネット広告やeコマースなど、さまざまな事業の収益から成り立っています。 また他社と連携して行うビジネスも多く、大規模かつ幅広いビジネスフィールドでチャレンジできます。 入社後の業務領域には以下のものがあります。
                      <ul>
                        <li>インターネット上の広告事業</li>
                        <li>イーコマース事業</li>
                        <li>会員サービス事業</li>
                        <li>その他事業</li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>住所</td>
                    <td>〒107-6211<br>
                      東京都港区赤坂9-7-1 ミッドタウン・タワー</td>
                  </tr>
                  <tr>
                    <td>代表者</td>
                    <td>代表取締役社長 岩澤 俊典</td>
                  </tr>

                  <tr>
                    <td>従業員数</td>
                    <td>5,509人 （2015年6月30日現在）</td>
                  </tr>
                  </tr>
                </table>
      <?php endif;?>
      <div class="row">
      <?php echo $this->Html->link('点击申请', $calendar['Calendar']['source_url'], array('target' => '_blank', 'class' => 'btn btn-primary btn-lg btn-block'));?>
      </div>
      <br />
      <br />
      <div class="clearfix">
        <?php if($neighbor_calendars['prev']):?>
          <span class="pull-left">
            <a href="/calendar/detail/<?php echo $neighbor_calendars['prev']['Calendar']['id']?>">
              前一篇: <?php echo $neighbor_calendars['prev']['Calendar']['title'];?>
            </a>
          </span>
        <?php endif;?>

        <?php if($neighbor_calendars['next']):?>
         <span class="pull-right">
            <a href="/calendar/detail/<?php echo $neighbor_calendars['next']['Calendar']['id']?>">
              下一篇: <?php echo $neighbor_calendars['next']['Calendar']['title'];?>
            </a>
          </span>
        <?php endif;?>
      </div>
      <br>
    </div>

    <!-- main-right sidebar -->
    <?php  echo $this->element('sidebar-post');?>
    <!-- /main-right sidebar -->

  </div>
  <!-- /.Row -->

