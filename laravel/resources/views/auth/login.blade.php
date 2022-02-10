{{-- resources/views/auth/login.blade.php --}}
 
@extends('layouts.default')
@section('title')ログイン | <?php echo Config::get('app.sitename');?>@endsection
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
   <h1>ログイン</h1>

	@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
    <div>
        <ol class="breadcrumb">
          <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
          <li class="active">ログイン</li>
        </ol>
    </div>
  <div class="space20"></div>
  @endif
	
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
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
          
            @if (session('flash_info'))
                <div class="alert alert-danger">
                    <strong><i class="fa fa-info-circle" aria-hidden="true"></i> {{ session('flash_info') }}</strong>
                </div>
                <p>{{ session('flash_info2') }}</p>
				<div class="space20"></div>
                <p><a href="/help/1">{{ session('flash_info3') }} <i class="fa fa-external-link" aria-hidden="true"></i></a></p>
				<div class="space10"></div>
                <div class="sepalator"></div>
				<div class="space30"></div>
            @endif                  
                
          <form class="form-horizontal" role="form" method="POST" action="{{ route('postLogin') }}">
            {{-- CSRF対策--}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group form-group-lg">
              <label class="col-md-4 control-label">メールアドレス</label>
              <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
              </div>
            </div>
 
            <div class="form-group form-group-lg">
              <label class="col-md-4 control-label">パスワード</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password">
              </div>
            </div>
 
            <div class="form-group form-group-lg">
              <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember"> ログイン状態を保持する
                  </label>
                </div>
              </div>
            </div>
 
            <div class="form-group form-group-lg">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-right: 15px;">
                  ログイン
                </button>
                <div class="space10"></div>
                <p class="font09">
					<a href="/password/email">- パスワード再発行</a><br>
					<a href="/auth/resend">- ユーザー登録メールを再送する</a><br>
					<a href="/help/1">- メールが届かない</a>
				  </p>
				  <a href="/auth/register" class="btn btn-info btn-lg btn-block">ユーザー登録（無料）</a>
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
              <li class="active">ログイン</li>
            </ol>

        </div>
        
        @if (!strstr(Request::url(), '/lesson/category/'))
	        <div id="snsbox-footer" class="pull-right"></div>
        @endif
    </div>
</div>
@endif
@endsection