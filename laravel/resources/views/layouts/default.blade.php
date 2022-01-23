<?php //アプリ判定////////////////////////
$appflag = 0;
if (Util::ua_app() == true) {
	//echo 'アプリです！<br>'.$_SERVER['HTTP_USER_AGENT'].'<br>';//スマホの場合の処理
	$appflag = 1;
} else {
	//echo 'アプリじゃない<br>！'.$_SERVER['HTTP_USER_AGENT'];;//それ以外の場合の処理
}
//アプリ判定////////////////////////?>

<!DOCTYPE html>
<html lang="ja">
<head prefix="og: https://ogp.me/ns# fb: https://ogp.me/ns/fb# article: https://ogp.me/ns/article#">

	<meta charset="utf-8">
    <!--laravelでajaxを使うために必要-->
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')" />

    <meta property="og:title"  content="@yield('title')" />
    <meta property="og:site_name" content="<?php echo Config::get('app.sitename');?>" >
    <meta property="og:description" content="@yield('description')">
    <meta property="og:type"   content="website" />
    <meta property="og:url"    content="<?php echo Request::url(); ?>" />
    <meta property="fb:app_id" content="1682412288692021" />
    <?php if (Request::is('lesson/category/*')) {?>
        <meta property="og:image" content="https://laplesson.jp/image/image{{ $categorycount->number }}.jpg" />
    <?php }elseif (Request::is('lesson/*')) {?>
        <meta property="og:image" content="https://laplesson.jp/image/lessonshow{{ Request::segment(2) }}.png" />
    <?php }elseif (Request::is('news/*')) {?>

   		<?php
		$filecontent = $new1->body.$new1->code;
		preg_match_all('/<img.*src\s*=\s*[\"|\'](.*?)[\"|\'].*>/i', $filecontent, $img_path_list);
     	?>
        @if(isset($img_path_list[1][0]))
			<meta property="og:image" content="https://laplesson.jp<?php echo $img_path_list[1][0];?>" />
		@else
			<meta property="og:image" content="https://laplesson.jp/image/ogp.jpg" />
   		@endif
    <?php }else{ ?>
        <meta property="og:image" content="https://laplesson.jp/image/ogp.jpg" />
	<?php }?>



    <!--<link rel="shortcut icon" href="/image/favicon.ico">-->
    <link rel="shortcut icon" href="{{ asset('/image/favicon.ico') }}">

    <!-- iOS Safari and Chrome -->
    <meta name="apple-mobile-web-app-title" content="ラプレッスン">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ asset('/image/apple-touch-icon.png') }}">
<script src="{{ asset('/boost/js/bootstrap.min.js') }}"></script>
    
    <link rel="stylesheet" href="{{ asset('/boost/css/bootstrap.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('/css/style.css?v1.0') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('/css/modal-video.min.css') }}" type="text/css" >
    
    <!--
    <link rel="stylesheet" href="/boost/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="/css/style.css?v1.0">

	<link rel="stylesheet" href="/css/modal-video.min.css" type="text/css" >

-->

    @yield('canonical')

	 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	 <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	 <!--[if lt IE 9]>
	 <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	 <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	 <![endif]-->

</head>
<body>
<!-- LOADER ////////////////////////////////////////////////////////////////-->
<div id="loader-bg">
  <div id="loader">
	<div class="spinner">
	  <div class="bounce1"></div>
	  <div class="bounce2"></div>
	  <div class="bounce3"></div>
	</div>
  </div>
</div>
<div id="wrap">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.7&appId=1682412288692021";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<!--アプリ///////////////////////////////////////////////////////////-->
	@if($appflag == 0)
		@include('layouts.navbar')
	@endif
	<!--アプリ///////////////////////////////////////////////////////////-->

    @if (session('flash_message'))
        <div class="alert alert-success alert-dismissible flash_message" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong><i class="fa fa-info-circle" aria-hidden="true"></i></strong> {{ session('flash_message') }}
        </div>

    @endif
    @if (session('flash_error'))
        <div class="alert alert-danger flash_message" onclick="this.classList.add('hidden')">
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><i class="fa fa-info-circle" aria-hidden="true"></i></strong> {{ session('flash_error') }}
        </div>
    @endif
    @yield('content')


	<!--アプリ///////////////////////////////////////////////////////////-->
	@if($appflag == 0)
		@include('layouts.footer')
	@endif
	<!--アプリ///////////////////////////////////////////////////////////-->
</div><!-- END wrap ///////////////////-->
</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('/boost/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/jquery.scrolltrigger.js') }}"></script>
<script src="{{ asset('/js/works.js') }}"></script>
<script src="{{ asset('/js/modal-video.js') }}"></script>

    
<script type="text/javascript">
  //google analytics
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50574030-3', 'auto');
  ga('send', 'pageview');


@yield('script')



  window.fbAsyncInit = function() {
	FB.init({
	  appId      : '868204383255760',
	  xfbml      : true,
	  version    : 'v2.4'
	});
  };


  (function(d, s, id){
	 var js, fjs = d.getElementsByTagName(s)[0];
	 if (d.getElementById(id)) {return;}
	 js = d.createElement(s); js.id = id;
	 js.src = "//connect.facebook.net/ja_JP/sdk.js";
	 fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


// ソーシャルボタン
// 最初に変数をまとめて定義
var facebook_btn, twitter_btn, google_btn, facebook_art;

// facebook like
facebook_btn =
  '<div class="fbbtn pull-left"><iframe src="//www.facebook.com/plugins/like.php?href=<?php echo Config::get('app.homeurl');?>&send=false&layout=button_count&width=100&show_faces=true&action=like&colorscheme=light&font=arial&height=35&appId=1682412288692021" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px;" allowTransparency="true"></iframe></div>';

facebook_art =
  '<div class="fbbtn btn"><iframe src="//www.facebook.com/plugins/like.php?href=<?php echo Request::url(); ?>&send=false&layout=button_count&width=100&show_faces=true&action=like&colorscheme=light&font=arial&height=35&appId=1682412288692021" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px;" allowTransparency="true"></iframe></div>';




	// Footer Social 遅延load
	jQuery(function() {
    	jQuery('div').scrolltrigger({
        	trigger: '#footer-top',
        	callback: 'bar4'
    	});
	});
	var bar4 = function(){
    	jQuery('#snsbox-footer').append(facebook_btn)
	};

	// Post Social 遅延load
	/*
  	jQuery(function() {
    	jQuery('div').scrolltrigger({
        	trigger: '.lessonheader',
        	callback: 'bar5'
    	});
	});
	var bar5 = function(){
    	jQuery('#snsbox-article').append(facebook_art + twitter_art)
	};
	*/

	jQuery(function(){
		setTimeout(function(){
			jQuery('#snsbox-article').append(facebook_art)
		},1000);
	});


	//投稿Likebox遅延ロード ////////////////////////////////////////////////////////////////
	/*
	jQuery(function() {
		jQuery('div').scrolltrigger({
			trigger: '#footer',
			callback: 'bar1'
		});
	});
	var bar1 = function(){
		jQuery('#pageplugin').append('<div class="fb-page" data-href="https://www.facebook.com/laplesson.forDH/" data-tabs="timeline" data-width="500" data-height="350" data-small-header="true" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/laplesson.forDH/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/laplesson.forDH/">ラプレッスン</a></blockquote></div>')
	};
	*/



if(!jQuery.support.opacity){
    if(window.confirm("お使いのブラウザが古いため本サイトをご利用頂くことができません。新しいブラウザをインストールしてください。")) {
                location.href = "https://browsehappy.com/";
    }
}
</script>

</html>
