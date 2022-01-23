{{-- resources/views/auth/reset.blade.php --}}
 
@extends('layouts.default')
@section('title')パスワード再設定 | <?php echo Config::get('app.sitename');?>@endsection
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
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">パスワード再設定</div>
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
 
          <form class="form-horizontal" role="form" method="POST" action="/password/reset">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="token" value="{{ $token }}">
 
            <div class="form-group">
              <label class="col-md-4 control-label">メールアドレス</label>
              <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
              </div>
            </div>
 
            <div class="form-group">
              <label class="col-md-4 control-label">新しいパスワード</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password">
              </div>
            </div>
 
            <div class="form-group">
              <label class="col-md-4 control-label">確認</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password_confirmation">
              </div>
            </div>
 
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  再設定
                </button>
              </div>
            </div>
          </form>
        </div><!-- panel-body -->
      </div><!-- .panel -->
    </div><!-- .col -->
  </div><!-- .row -->
</div><!-- .container-fluid -->
</div><!--container--> 
@endsection