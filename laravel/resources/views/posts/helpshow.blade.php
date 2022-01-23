@extends('layouts.default')


@section('title'){{ $help1->question }} | <?php echo Config::get('app.sitename');?>@endsection
@section('description')よくある質問：{{ $help1->question }}　回答：{{ $help1->question }}@endsection
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
<div class="container subpage <?php echo $appclass;?>">

<div class="row">

<!--メイン ############################################################-->    
<div class="col-sm-8">
<h1>
{{ $help1->question }}
</h1>
	
@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
<div>
    <ol class="breadcrumb">
      <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
      @if(Auth::check())
      <li><a href="/mypage">マイページ</a></li>
      @endif
      <!--<li><a href="/lesson">レッスン一覧</a></li>-->
      <li class="active">{{ $help1->question }}</li>
    </ol>
</div> 
 @endif   	

<div class="post clearfix">
	<?php $date = date_format($help1->created_at , 'Y.m.d');?>
    <p class="thumb pull-right font08"><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo $date;?></p>
    <div class="sepalator"></div>
    <div class="contents clearfix">
        {!! nl2br($help1->answer) !!}
    </div>
	
	@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
    <div class="space50"></div>
    <div class="space50"></div>
   @if (Auth::guest())
       <a href="/auth/login" class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> ログイン</a>
   @else
       <a href="/mypage" class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> マイページに戻る</a>
   @endif           
    <div class="space50"></div>
	@endif
</div>



</div><!--メイン ############################################################-->    
   
@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
<!--サイドバー ############################################################-->
<div class="col-sm-4" id="sidebar">
    @include('layouts.sidebarbaner')
</div><!--END　サイドバー############################################################ -->    
@endif
    
</div><!--row-->
</div><!--container-->

@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
<div id="footer-top">
	<div class="container">
        <div class="pull-left">
            <ol class="breadcrumb">
              <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
              @if(Auth::check())
              <li><a href="/mypage">マイページ</a></li>
              @endif
              <!--<li><a href="/lesson">レッスン一覧</a></li>-->
              <li class="active">{{ $help1->question }}</li>
            </ol>
        </div>
    </div>
</div>
@endif

@endsection