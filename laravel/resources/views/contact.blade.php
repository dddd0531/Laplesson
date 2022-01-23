@extends('layouts.default')


@section('title')お問い合わせ | <?php echo Config::get('app.sitename');?>@endsection
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

        <div class="container subpage">
               <h1 class="subpage-h1">お問い合わせ </h1>

         </div><!--container-->
        <div class="subpage block bg-gray bordertop">
         <div class="container text-center">

           <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">お問い合わせ</h1>
                </div>
                <div class="panel-body">
                   </form>
                </div>
            </div>
            
         </div><!--container-->
        </div> 
@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
<div id="footer-top">
	<div class="container">
        <div class="pull-left">
            <ol class="breadcrumb">
              <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
              <li class="active">お問い合わせ</li>
            </ol>

        </div>
        
        @if (!strstr(Request::url(), '/lesson/category/'))
	        <div id="snsbox-footer" class="pull-right"></div>
        @endif
    </div>
</div>
@endif

@endsection