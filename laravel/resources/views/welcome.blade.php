@extends('layouts.default')

@section('title'){{ Config::get('app.sitename')}}@endsection
@section('description'){{ Config::get('app.description')}}@endsection
@section('keywords'){{ Config::get('app.keywords')}}@endsection
@section('canonical')<link rel="canonical" href="https://laplesson.jp">@endsection
@section('content')
<?php //アプリ判定////////////////////////
$appclass = "";
$appflag = 0;
if (Util::ua_app() == true) {
	$appclass = Config::get('app.appclass');
	$appflag = 1;
}
//アプリ判定////////////////////////?>


<div>
    <div id="mainvisual">
        <div class="container">
            <div class="topmain text-center"> <img id="mainlogo" src="/image/logo5.gif" class="img-responsive img-responsive-overwrite" alt="<?php echo Config::get('app.sitename');?>">
              <h1><img src="/image/title2.png" class="img-responsive img-responsive-overwrite" alt="<?php echo Config::get('app.sitename');?>"></h1>
              <div class="space20"></div>
              <img src="/image/logo4.png" class="img-responsive img-responsive-overwrite" alt="ラプレッスン" width="480px">
              <div class="space10"></div>
              <!--<div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                  <p>ラプレッスンは、歯科衛生士スキルを無料で学べるビギナーDH向けの動画学習サイトです。歯周病検査からSRPテクニックまで幅広く新人衛生士から、復習につかって頂けます。</p>
                </div>
                <!--col-->
              <!--</div>-->
              <!--row-->
              <div class="row text-center">
                <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
                    <img src="/image/bg03.png" class="img-responsive img-responsive-overwrite" alt="スケーラー">
                    <div class="space10"></div>
                    @if (Auth::guest())
                    <a href="/auth/register" class="btn btn-primary btn-block btn-big pconly">ユーザー登録（無料）</a>

                    <div class="row mobileonly topmobile">
                    	<div class="col-xs-6 col-sm-12">
                            <a href="/auth/register" class="btn btn-primary btn-block">ユーザー登録（無料）</a>
                        </div>
                        <div class="col-xs-6 col-sm-12">
                            <a href="/auth/login" class="mobileonly btn btn-info btn-block">ログイン</a>
                        </div>
                    </div>
                    <div class="space10 mobileonly"></div>
                    @else
                	<a href="/mypage" class="btn btn-primary btn-block btn-big">学習を始める</a>
                    <div class="space10"></div>

                    @endif
                	<a href="/lesson" class="btn btn-gray btn-block btn-lg"><i class="fa fa-youtube-play" aria-hidden="true"></i> すべてのレッスンをみる</a>
                </div>
                <!--col-->
              </div>
            </div>
            <!--topmain-->

			@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
				<dl id="newsarea" class="dl-horizontal">
				@forelse ($news as $new)
					<?php $date = date_format($new->created_at , 'Y.m.d');?>
					<dt><span class="text-muted"><?php echo $date;?></span></dt>
					<dd><a href="{{ action('NewsController@newsshow', $new->id) }}">{{ $new->title }} <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></dd>
				@empty
					<dt></dt>
					<dd>お知らせはありません。</dd>
				@endforelse

				</dl>
			@endif

        </div><!--container-->
        <a href="#" class="js-modal-btn" data-video-id="QRGr8SAGejg"><img id="playcm" src="/image/playcm.png" class="img-responsive img-responsive-overwrite" alt="１分半でわかるラプレッスン"></a>
    </div><!--mainvisual-->


	@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
    <div class="block2 bg-gray device">
        <div class="container">
        	<div class="row">
            	<div class="col-sm-6 col-md-7">
                    <img src="/image/device.png" class="img-responsive img-responsive-overwrite" alt="スマホ">
                </div>
            	<div class="col-sm-6 col-md-5">
                  <div class="space50 pconly2"></div>
                  <div class="space50 pconly2"></div>
                  <h2>歯科衛生士のスキルを<br><span class="accent">動画</span>で学ぼう</h2>
                  <p>ラプレッスンは、<strong>歯科衛生士のスキル</strong>を無料で学べる<strong>会員制動画学習サイト</strong>です。基礎から実践まで幅広く、スキルの確認・復習に使ってみましょう。</p>
                </div>
            </div>
        </div><!--container-->
    </div>
    <!--block-->
    @endif

    <div class="block text-center bordertop">
        <div class="container">
        	<div class="row">
            	<div class="col-md-6 col-md-offset-3">
					@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
					  <h2>提供中のレッスン</h2>
					  <p>現在、ラプレッスンでは<strong class="accent">{{ $categories }}</strong>レッスン、<strong class="accent">{{ $posts }}</strong>動画をご用意しています。まずは気になる動画を選んで気軽に初めてみましょう。</p>
					@elseif($appflag == 1)
					  <h2><strong class="accent">{{ $categories }}</strong>レッスン <strong class="accent">{{ $posts }}</strong>動画</h2>
					@endif
                </div>
            </div>
            <div class="space50"></div>
          <div class="row">
          	<!-- 表示させたいレッスンカテゴリーのcategory_id -->
            <?php $array_lesson = array(20,18,19,23,25,28,29,21,26); ?>
            @foreach ($catecount as $category)
            	 @if (in_array($category->category_id, $array_lesson))
                    <div class="col-sm-4 toplessonbox"> <a href="/lesson/category/{{ $category->category_id }}"><img class="lessonicon lessonicon{{ $category->category_id }} img-responsive img-responsive-overwrite" src="/image/lesson{{ $category->category_id }}.png" alt="{{ $category->category }}"></a>
                      <h3><a href="/lesson/category/{{ $category->category_id }}">{{ $category->category }}<br>全{{ $category->count }}回</a></h3>
                    </div>
                    <!--col-->
                 @endif
            @endforeach
          </div>
          <!--row-->

          <div class="row content">
            <div class="col-md-4 col-md-offset-4"><a href="/lesson" class="btn btn-primary btn-big btn-block">すべてのレッスンを見る</a> </div>
            <!--col-->
          </div>
          <!--row-->
        </div><!--container-->
    </div>
    <!--block-->
</div><!--container-fluid-->




	@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
	<div id="footer-top">
		<div class="container">
			<div class="pull-left">
				<ol class="breadcrumb">
				  <li class="active"><span class="glyphicon glyphicon-home"></span></li>
				</ol>

			</div>

			@if (!strstr(Request::url(), '/lesson/category/'))
				<div id="snsbox-footer" class="pull-right"></div>
			@endif
		</div>
	</div>
	@endif
@endsection
@section('script')
// ビデオ
$(".js-modal-btn").modalVideo();
@stop
