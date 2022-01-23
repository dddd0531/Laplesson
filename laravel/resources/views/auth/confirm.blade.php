{{-- resources/views/auth/confirm.blade.php --}}
 
@extends('layouts.default')
@section('title')ユーザー登録確認メールの再送信 | <?php echo Config::get('app.sitename');?>@endsection
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
        <div class="panel-heading">ユーザー登録確認メールの再送信</div>
        <div class="panel-body">
        <div class="space30"></div>
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <form role="form" method="POST" action="{{ url('/auth/resend') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
 				
            <div class="form-group">
              <label class="control-label">メールアドレスを入力して再送信してください。</label>
              <div>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
              </div>
            </div>
 
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                  再送信
                </button>
                <div class="space10"></div>
                <p class="font09"><a href="/help/1">- メールが届かない</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div><!--container--> 
@endsection