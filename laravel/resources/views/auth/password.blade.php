{{-- resources/views/auth/password.blade.php --}}
 
@extends('layouts.default')
@section('title')パスワード再設定メール送信 | <?php echo Config::get('app.sitename');?>@endsection
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
<div class="container subpage <?php echo $appclass;?>">
<div class="container-fluid">
   <h1>パスワード再設定メール送信</h1>
	@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
    <div>
        <ol class="breadcrumb">
          <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
          <li class="active">パスワード再設定</li>
        </ol>
    </div>
  <div class="space20"></div>
  @endif
	
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
    登録時のメールアドレスを入力して送信してください。手続きの手順を説明したメールを送らせていただきます。
    <div class="space20"></div>
      <div class="panel panel-default">
        <div class="panel-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
 
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
 			
          <form class="form-horizontal" role="form" method="POST" action="/password/email">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
 
            <div class="form-group">
              <label class="col-md-4 control-label">登録メールアドレス</label>
              <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
              </div>
            </div>
 
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  送信する
                </button>
                <div class="space10"></div>
                <p class="font09"><a href="/help/1">- メールが届かない場合はこちら</a></p>
                
              </div>
            </div>
          </form>
        </div><!-- .panel-body -->
      </div><!-- .panel -->
    </div><!-- .col -->
  </div><!-- .row -->
</div><!-- .container-fluid -->
</div><!--container--> 
@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
<div id="footer-top">
	<div class="container">
        <div class="pull-left">
            <ol class="breadcrumb">
              <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
              <li class="active">パスワード再設定</li>
            </ol>

        </div>
        
        @if (!strstr(Request::url(), '/lesson/category/'))
	        <div id="snsbox-footer" class="pull-right"></div>
        @endif
    </div>
</div>
@endif
@endsection
