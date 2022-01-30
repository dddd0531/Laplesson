@extends('layouts.default')
@section('title'){{ $new1->title }}| <?php echo Config::get('app.sitename');?>@endsection
@section('description'){{ $new1->description }}@endsection
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


@section('content')
<div class="container subpage post-single news-single <?php echo $appclass;?>">
<div class="container-fluid">
<div class="row">
<!--メインコンテンツ ############################################################-->
<div class="col-sm-8">

<h1>{{ $new1->title }}</h1>
@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
	<div class="pconly">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
		  @if(Auth::check())
		  <li><a href="/mypage">マイページ</a></li>
		  @endif
		  <li class="active">お知らせ</li>
		  <li class="active">{{ $new1->title }}</li>
		</ol>
	</div>  
@endif


<div class="post clearfix">
	@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
	<?php $date = date_format($new1->created_at , 'Y.m.d');?>
    <p class="thumb pull-right font08"><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo $date;?></p>
    <div class="sepalator"></div>
		@include('layouts.topbaner')
		<div class="space20"></div>
		  @if (count($errors) > 0)
			<div class="alert alert-danger">
			  <ul>
				@foreach ($errors->all() as $error)
				  <li>{{ $error }}</li>
				@endforeach
			  </ul>
			</div>
		  @endif       
	   @endif
    <div class="contents clearfix">
		<p>
        {!! nl2br($new1->body) !!}
		</p>
    </div>
    
    <div class="contents clearfix">
    	{!! $new1->code !!}
		@if($new1->newsurl != "")
			@if($appflag == 1)<!--アプリ判定 1:アプリ 0:ブラウザ-->
				<button class="btn btn-info btn-lg" onclick="NativeBridge.send('sendMessage', '{{ $new1->newsurl }}')">動画を見る</button>
			@else
				<a class="btn btn-info btn-lg" href="{{ $new1->newsurl }}">動画を見る</a>
				<!--<a class="btn btn-info btn-lg" href="{{ $new1->newsurl }}">動画を見る</a>-->
			@endif
		@endif
	</div>
    
    @if($new1->form == 1)
    <div id="newscontactarea" class="news-contact">
    	
		<h4>【お申し込み】</h4>
	   <div id="newscontact" class="panel panel-default">
			<div class="panel-body">
				  @if (count($errors) > 0)
					<div class="alert alert-danger">
					  <ul>
						@foreach ($errors->all() as $error)
						  <li>{{ $error }}</li>
						@endforeach
					  </ul>
					</div>
				  @endif                        
				<form class="form-horizontal" method="post" action="{{ url('/newscontact') }}"> 
					{{-- CSRF対策--}}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					@if(Auth::check())
						<input type="hidden" class="form-control" name="name2" value="{{ Auth::user()->name }}">
						<div class="form-group">
							<label class="control-label" for="name2">ニックネーム</label>
							<p class="form-control-static">{{ Auth::user()->name }}さん</p>
						</div>
						<div class="form-group">
							<label class="control-label" for="email">メールアドレス</label>
							<input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}">
						</div>						
					@else
						<div class="form-group">
							<label class="control-label" for="name2">ニックネーム</label>
							<input type="text" class="form-control" placeholder="会員登録時のニックネーム" name="name2" value="{{ old('name2') }}">
						</div>
						<div class="form-group">
							<label class="control-label" for="email">メールアドレス</label>
							<input type="text" class="form-control" placeholder="aaa@aaa.ne.jp" name="email" value="{{ old('email') }}">
						</div>					
					@endif
					<div class="form-group">
						<label class="control-label" for="tell">電話番号</label>
						<input type="text" class="form-control" placeholder="09011112222" name="tell" value="{{ old('tell') }}">
					</div>	
					<div class="form-group">
						<label class="control-label" for="years">歯科衛生士 経験年数</label>
						<input type="text" size="10" placeholder="5年" class="form-control" name="years" value="{{ old('years') }}">
					</div>				
					<div class="form-group">
						<label class="control-label" for="content">質問などあれば</label>
						<textarea type="text" class="form-control" name="content" rows="10">{{ old('content') }}</textarea>
					</div>
					<div class="form-group">
						<div class="space20"></div>
						<input type="hidden" name="title" value="{{ $new1->title }}">
						<button type="submit" class="btn btn-primary btn-lg">確認</button>
					</div>
				</form>
			</div>
		</div>
	</div>
    @endif
	@if($appflag == 1)<!--アプリ判定 1:アプリ 0:ブラウザ-->
		<div class="space50"></div>
		<div class="space50"></div>
	@endif
	@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
		<div class="space50"></div>
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-commenting-o" aria-hidden="true"></i> いいと思ったらポチっとお願いします!</div>
			<div class="panel-body">
				<div id="snsbox-article"></div>
			</div>
		</div> 
		<div class="space50"></div>
		<div class="space50"></div>

	   @if (Auth::guest())
		   <a href="/lesson" class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> レッスン一覧</a>
	   @else
		   <a href="/mypage" class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> マイページに戻る</a>
	   @endif           
	

		<div class="space50"></div>
		@include('layouts.baner')
	@endif
</div>



  
</div><!--END　メインコンテンツ ############################################################-->


	@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
        <!--サイドバー ############################################################-->
        
        <div class="col-sm-4" id="sidebar">
           
           
		@if (Auth::guest())
		{{-- ログインしていない時 --}}
			<div class="panel panel-default">
				<div class="panel-body">
					<a href="/auth/register"><i class="fa fa-exclamation-circle"></i> ユーザー登録をすると学習状況を管理できます。</a>     
                </div><!--panel-body -->
             </div><!-- panel -->
				
		@else
		{{-- ログインしている時 --}}    
           
            <div class="panel panel-default">
                <div class="panel-heading">ようこそ<strong>{{ Auth::user()->name }}さん</strong></div>
                <div class="panel-body">
                      @if (Auth::user()->avater) <img class="avater" src="/media/{{ Auth::user()->avater }}" alt="{{ Auth::user()->name }}さん"> @else <img class="avater" src="/media/avater.jpg" alt="{{ Auth::user()->name }}さん"> @endif 
                      {{ Auth::user()->name }}さん
                      <div class="sepa"></div>
                      <div class="row text-center">
                      	<div class="col-xs-4">
                        	<span class="font08">総学習時間</span><Br>
                            <strong class="font12">{{ $times }}</strong>
                        </div>
                      	<div class="col-xs-4">
                        	<span class="font08">学習日数</span><Br>
                            <strong class="font12">{{ $days->date }}</strong><span class="font08">日</span>
                        </div>
                      	<div class="col-xs-4">
                        	<span class="font08">完了レッスン</span><Br>
                            <strong class="font12">{{ $studied }}</strong>
                        </div>
                     </div>
                </div><!--panel-body -->
             </div><!-- panel -->
         @endif
             
            <div class="panel panel-default">
                <div class="panel-heading">お知らせ</div>
                <div class="panel-body font08">
                	<ul>
                    @forelse ($news as $new)
                    	<?php $date = date_format($new->created_at , 'Y.m.d');?>
                		<li><?php echo $date;?>　<a href="{{ route('news.show', $new->id) }}">{{ $new->title }} <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></li>
                    @empty 
                    	<li>お知らせはありません。</li>
                    @endforelse                        
                
                    </ul>
                </div><!--panel-body -->
             </div><!-- panel --> 
            @include('layouts.followme')
            @include('layouts.sidebarbaner')
        </div><!--サイドバー ############################################################-->
	@endif
					
</div><!--END　row-->
</div><!-- .container-fluid -->
</div><!--END container -->
	
@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
<div id="footer-top">
	<div class="container">
        <div class="pull-left">
            <ol class="breadcrumb">
              <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
              <li><a href="/mypage">マイページ</a></li>
              <li class="active">お知らせ</li>
              <li class="active">{{ $new1->title }}</li>
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
    var NativeBridge = {
      send: function(methodName, args) {
        if (this.isIOS()) {
            window.webkit.messageHandlers[methodName].postMessage(args);
        } else if (this.isAndroid()) {
            MyApp[methodName](args);
        } else {
            console.log('browser access.');
        }
      },
      isIOS: function() {
        return window.navigator.userAgent.indexOf('IosApp') !== -1;
      },
      isAndroid: function() {
        return window.navigator.userAgent.indexOf('AndroidApp') !== -1;
      }
    };
	
@stop