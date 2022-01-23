@extends('layouts.default')


@section('title')ラプレッスンとは？ | <?php echo Config::get('app.sitename');?>@endsection
@section('description'){{ Config::get('app.description')}}@endsection
@section('keywords'){{ Config::get('app.keywords')}}@endsection
@section('content')
<?php //アプリ判定////////////////////////
$appclass = "";
$appflag = 0;
if (Util::ua_app() == true) {
	$appclass = Config::get('app.appclass');
	$appflag = 1;
}
//アプリ判定////////////////////////?>


        <div class="container subpage about">
               <h1 class="subpage-h1">ラプレッスンとは？</h1>
               <div class="text-center">
                    <img src="/image/about2.png" class="img-responsive img-responsive-overwrite" alt="歯科衛生士のための無料動画学習サイト">
                    <div class="space20"></div>
                    <div class="row">
                    	<div class="col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">
                          <p class="text-left">ラプレッスンは、歯科衛生士のスキルを無料で学べる会員制動画学習サイトです。基礎から実践まで幅広く、スキルの確認・復習に使ってみましょう。</p>
                        </div>
                    </div>
                    <div class="space50"></div>
                </div>
         </div><!--container-->
        <div class="block bg-gray bordertop">
        	<div class="container text-center aboutcontent">
                <h2>ラプレッスンの特徴</h2>
                <div class="row">
                	<div class="col-sm-6 col-lg-4 col-lg-offset-2">
                    	<i class="fa fa-youtube-play iconbig" aria-hidden="true"></i>
                    	<h3>短い動画で学習</h3>
                        <p class="text-left">短い動画2～5分なので気楽に始めることができます。分からないところ、気になるところだけをレッスン一覧から選んで学習できます。移動中の空き時間にも。</p>
                	</div>
                	<div class="col-sm-6 col-lg-4">
                    	<i class="fa fa-graduation-cap iconbig" aria-hidden="true"></i>
                    	<h3>基礎スキルをマスター</h3>
                        <p class="text-left">ポジション、ミラーの持ち方などの基本から学べます。新人衛生士、復職に不安のある方、自分のやり方に不安のある方、日々のスキルの見直しに使ってみよう。</p>
                	</div>
                </div>
                <div class="space50 pconly"></div>
                <div class="row">
                	<div class="col-sm-6 col-lg-4 col-lg-offset-2">
                    	<i class="fa fa-user iconbig" aria-hidden="true"></i>
                    	<h3>コツをつかめる</h3>
                        <p class="text-left">ラプレッスンの動画をみてコツをつかめば、足りない知識や課題が見えてくるはず。やってみようと思うことが成長の第一歩。最初は真似から始めよう。</p>
                	</div>
                	<div class="col-sm-6 col-lg-4">
                    	<i class="fa fa-heart iconbig" aria-hidden="true"></i>
                    	<h3>無料です</h3>
                        <p class="text-left">無料で学習できます。正直言いますと、運営には経費がかかります。出来るところまでは無料で続けるつもりです。もしかすると将来的には一部課金させて頂くことになるかもしれません。</p>
                	</div>
                </div>
				@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
					<div class="row content">
					   <div class="col-sm-6 col-md-4 col-md-offset-2"> <a href="/lesson" class="btn btn-primary btn-block btn-big">レッスン一覧をみる</a> </div>
					   <div class="space20 mobileonly"></div>
					   @if (Auth::guest())
						   <div class="col-sm-6 col-md-4"> <a href="/auth/register" class="btn btn-info btn-block btn-big">今すぐ始める</a> </div>
					   @else
						   <div class="col-sm-6 col-md-4"> <a href="/mypage" class="btn btn-info btn-block btn-big">学習を始める</a> </div>
					   @endif
					   <!--col-->
					</div>
				@endif
         </div><!--container-->
        </div>
        <div id="concept" class="block borderbottom">
        	<div class="container text-center">

                <h2>ごあいさつ</h2>
                <div class="row">
                	<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                        <p class="text-left" style="line-height:2;">

〜全国の悩める歯科衛生士に届きますように！〜<br><br>

一年に及ぶ制作が終了し、なんとか動画サイトをリリースすることができました。<br><br>

私は14年歯科衛生士の育成に携わっています。<br>
顔をみて、話しを聞いて、伝えて、確認してと直接的に関わることを大切にしてきました。<br><br>

それでもやろうと決めたのは、このサイトをきっかけに『私にもできるかもしれない！』と思ってほしいから。<br><br>


技術を動画でお伝えできることはわずかかもしれません。<br>
目の前の患者さん、衛生士の個人差、使用するチェアなどなどによって、少しずつポジションもレストの位置も変わります。言い切ることの難しさと向き合った一年でした。<br><br>


仕事が楽しいと思えるには、目の前のできないことを１つでも克服して、できるようになることが必要です。<br><br>

全国の衛生士のみなさんが『仕事が楽しくなってきました！』『これでよかったんだ！』と思って頂くために、少しでもお役にたてるよう今後も活動を続けていきます。<br><br>
ラプレッスンが衛生士のみなさんを応援する！<br>
そして、みなさんの声で私たちとラプレッスンは成長していきたいと思っています。<br><br>

なにぶん、少数部隊での活動ですので出来ることは限られているかもしれませんが、
みなさんの応援で、さらに私たちはがんばれます。1人でも多くの衛生士に届きますように。<br><br>

最期に大阪弁のイントネーションが混じりますが、クスッと笑っていただければ幸いです。<br><br><br>

<span class="pull-right">運営会社ラ・プレシャス代表 <br class="mobileonly">岡村乃里恵</span>

</p>
                    </div>
                </div><!--row-->

         </div><!--container-->
        </div>
        <div class="block bg-gray">
        	<div class="container">
                <h2 class="text-center">Special Thanks</h2>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="/image/company02.jpg" class="img-responsive img-responsive-overwrite" alt="歯科衛生士をキラキラにする会社　ラ・プレシャス">
                        </div>
                        <div class="col-sm-8">
                            <h3>ほりべ歯科クリニック様</h3>
                            <p>ラプレッスンを始めるにあたって、相談相手となっていただいたり、撮影場所のご協力や
モニターとしてのご意見などなど。院長はじめスタッフの皆様にサポートしていただきました。
感謝の気持ちでいっぱいです。ありがとうございました！</p>
                            <a href="http://horibe-dental.com/" target="_blank">http://horibe-dental.com/</a>
                        </div>
                    </div>
                    <div class="sepa"></div>
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="/image/company03.jpg" class="img-responsive img-responsive-overwrite" alt="歯科衛生士をキラキラにする会社　ラ・プレシャス">
                        </div>
                        <div class="col-sm-8">
                            <h3>水沼歯科様</h3>
                            <p>撮影場所として、１年通わせていただきました。いつも快くお引き受け下さいましてありがとうございます！心より感謝申し上げます。</p>
                            <a href="http://www.mizunuma-dc.com/" target="_blank">http://www.mizunuma-dc.com/</a>
                        </div>
                    </div>
                    <div class="sepa"></div>
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="/image/company04.jpg" class="img-responsive img-responsive-overwrite" alt="歯科衛生士をキラキラにする会社　ラ・プレシャス">
                        </div>
                        <div class="col-sm-8">
                            <h3>0039ドットコム様</h3>
                            <p>動画で使っているBGMに0039ドットコム様が提供されている音楽を使わせて頂きました。感謝申し上げます。</p>
                            <a href="http://www.oo39.com/top.html" target="_blank">http://www.oo39.com/top.html</a>
                        </div>
                    </div>
                    <div class="sepa"></div>
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="/image/company05.jpg" class="img-responsive img-responsive-overwrite" alt="歯科衛生士をキラキラにする会社　ラ・プレシャス">
                        </div>
                        <div class="col-sm-8">
                            <h3>ヒトノチカラ製作所</h3>
                            <p>私たちの夢を、どんどん形にするサポートをしていただきました。１年という長い制作におつきあいいただきありがとうございます。女子力の高いデザイン。すばらしい提案力に心より感謝申し上げます。</p>
                            <a href="http://hito.works" target="_blank">http://hito.works</a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="space30"></div>
            <h2 class="text-center">運営会社</h2>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="/image/company01.jpg" class="img-responsive img-responsive-overwrite" alt="歯科衛生士をキラキラにする会社　ラ・プレシャス">
                        </div>
                        <div class="col-sm-8">
                            <h3>歯科衛生士をキラキラにする会社　ラ・プレシャス</h3>
                            <p>関西を中心に出会った歯科衛生士をキラキラにするために『仕事が大好きに、自分の医院が大好きになる』セミナーや医院研修など歯科衛生士を応援する歯科衛生士による会社です。</p>
                            <a href="http://la-precious.jp/" target="_blank">http://la-precious.jp/</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space30"></div>
						<div class="row">
							<div class="col-sm-offset-2 col-sm-8">
								<table class="table">
									<tbody>
										<tr>
	                    <th>会社名</th>
	                    <td>株式会社ラ・プレシャス</td>
	                  </tr>
	                  <tr>
	                    <th>所在地</th>
	                    <td>大阪府大阪市西区京町堀1-13-21 3F </td>
	                  </tr>
	                  <tr>
	                    <th>代表者</th>
	                    <td>代表取締役　岡村乃里恵</td>
	                  </tr>
	                  <tr>
	                    <th>設立</th>
	                    <td>2006年5月7日</td>
	                  </tr>
	                  <tr>
	                    <th>電話番号</th>
	                    <td>06-6940-7328</td>
	                  </tr>
	                  <tr>
	                    <th>FAX番号</th>
	                    <td>06-6734-6748</td>
	                  </tr>
	                  <tr>
	                    <th>MAIL</th>
	                    <td><a href="mailto:info@la-precious.jp">info@la-precious.jp</a></td>
	                  </tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="space50"></div>
			@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
				<div class="row content">
				   <div class="col-sm-6 col-md-4 col-md-offset-2"> <a href="/lesson" class="btn btn-primary btn-block btn-big">レッスン一覧をみる</a> </div>
				   <div class="space20 mobileonly"></div>
					   @if (Auth::guest())
						   <div class="col-sm-6 col-md-4"> <a href="/auth/register" class="btn btn-info btn-block btn-big">今すぐ始める</a> </div>
					   @else
						   <div class="col-sm-6 col-md-4"> <a href="/mypage" class="btn btn-info btn-block btn-big">学習を始める</a> </div>
					   @endif

				   <!--col-->
				</div>
				<!--row-->
            @endif
         </div><!--container-->
        </div>

@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
<div id="footer-top">
	<div class="container">
        <div class="pull-left">
            <ol class="breadcrumb">
              <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
              <li class="active">ラプレッスンとは？</li>
            </ol>

        </div>

        @if (!strstr(Request::url(), '/lesson/category/'))
	        <div id="snsbox-footer" class="pull-right"></div>
        @endif
    </div>
</div>
@endif

@endsection
