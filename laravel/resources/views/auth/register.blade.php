{{-- resources/views/auth/register.blade.php --}}
 
@extends('layouts.default')
@section('title')ユーザー登録 | <?php echo Config::get('app.sitename');?>@endsection
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
<div>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
    	<h1>ようこそラプレッスンへ</h1>
        <img src="/image/welcom.png" class="img-responsive img-responsive-overwrite" alt="<?php echo Config::get('app.sitename');?>">
        <p>初めての方はまずは会員登録をしてください。<BR>すでに登録されている方は<a href="/auth/login">こちら</a>からログインしてください。</p>
        <div class="space30 mobileonly"></div>
      <div class="panel panel-default">
        <div class="panel-heading">会員登録</div>
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
 
          <form class="form-horizontal" role="form" method="POST" action="/auth/register">
            {{-- CSRF対策--}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
 
            <div class="form-group">
              <label class="col-md-4 control-label">ニックネーム</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
              </div>
            </div>
 
            <div class="form-group">
              <label class="col-md-4 control-label">メールアドレス</label>
              <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-md-4 control-label">お住まいの都道府県</label>
              <div class="col-md-6">
                 <select name="todofu" class="form-control">
                  	<option value="">選択してください</option>
                    <option value="北海道" {{ (old("todofu") == '北海道') ? "selected":"" }}>北海道</option>
                    <option value="青森県" {{ (old("todofu") == '青森県') ? "selected":"" }}>青森県</option>
                    <option value="岩手県" {{ (old("todofu") == '岩手県') ? "selected":"" }}>岩手県</option>
                    <option value="宮城県" {{ (old("todofu") == '宮城県') ? "selected":"" }}>宮城県</option>
                    <option value="秋田県" {{ (old("todofu") == '秋田県') ? "selected":"" }}>秋田県</option>
                    <option value="山形県" {{ (old("todofu") == '山形県') ? "selected":"" }}>山形県</option>
                    <option value="福島県" {{ (old("todofu") == '福島県') ? "selected":"" }}>福島県</option>
                    <option value="茨城県" {{ (old("todofu") == '茨城県') ? "selected":"" }}>茨城県</option>
                    <option value="栃木県" {{ (old("todofu") == '栃木県') ? "selected":"" }}>栃木県</option>
                    <option value="群馬県" {{ (old("todofu") == '群馬県') ? "selected":"" }}>群馬県</option>
                    <option value="埼玉県" {{ (old("todofu") == '埼玉県') ? "selected":"" }}>埼玉県</option>
                    <option value="千葉県" {{ (old("todofu") == '千葉県') ? "selected":"" }}>千葉県</option>
                    <option value="東京都" {{ (old("todofu") == '東京都') ? "selected":"" }}>東京都</option>
                    <option value="神奈川県" {{ (old("todofu") == '神奈川県') ? "selected":"" }}>神奈川県</option>
                    <option value="新潟県" {{ (old("todofu") == '新潟県') ? "selected":"" }}>新潟県</option>
                    <option value="富山県" {{ (old("todofu") == '富山県') ? "selected":"" }}>富山県</option>
                    <option value="石川県" {{ (old("todofu") == '石川県') ? "selected":"" }}>石川県</option>
                    <option value="福井県" {{ (old("todofu") == '福井県') ? "selected":"" }}>福井県</option>
                    <option value="山梨県" {{ (old("todofu") == '山梨県') ? "selected":"" }}>山梨県</option>
                    <option value="長野県" {{ (old("todofu") == '長野県') ? "selected":"" }}>長野県</option>
                    <option value="岐阜県" {{ (old("todofu") == '岐阜県') ? "selected":"" }}>岐阜県</option>
                    <option value="静岡県" {{ (old("todofu") == '静岡県') ? "selected":"" }}>静岡県</option>
                    <option value="愛知県" {{ (old("todofu") == '愛知県') ? "selected":"" }}>愛知県</option>
                    <option value="三重県" {{ (old("todofu") == '三重県') ? "selected":"" }}>三重県</option>
                    <option value="滋賀県" {{ (old("todofu") == '滋賀県') ? "selected":"" }}>滋賀県</option>
                    <option value="京都府" {{ (old("todofu") == '京都府') ? "selected":"" }}>京都府</option>
                    <option value="大阪府" {{ (old("todofu") == '大阪府') ? "selected":"" }}>大阪府</option>
                    <option value="兵庫県" {{ (old("todofu") == '兵庫県') ? "selected":"" }}>兵庫県</option>
                    <option value="奈良県" {{ (old("todofu") == '奈良県') ? "selected":"" }}>奈良県</option>
                    <option value="和歌山県" {{ (old("todofu") == '和歌山県') ? "selected":"" }}>和歌山県</option>
                    <option value="鳥取県" {{ (old("todofu") == '鳥取県') ? "selected":"" }}>鳥取県</option>
                    <option value="島根県" {{ (old("todofu") == '島根県') ? "selected":"" }}>島根県</option>
                    <option value="岡山県" {{ (old("todofu") == '岡山県') ? "selected":"" }}>岡山県</option>
                    <option value="広島県" {{ (old("todofu") == '広島県') ? "selected":"" }}>広島県</option>
                    <option value="山口県" {{ (old("todofu") == '山口県') ? "selected":"" }}>山口県</option>
                    <option value="徳島県" {{ (old("todofu") == '徳島県') ? "selected":"" }}>徳島県</option>
                    <option value="香川県" {{ (old("todofu") == '香川県') ? "selected":"" }}>香川県</option>
                    <option value="愛媛県" {{ (old("todofu") == '愛媛県') ? "selected":"" }}>愛媛県</option>
                    <option value="高知県" {{ (old("todofu") == '高知県') ? "selected":"" }}>高知県</option>
                    <option value="福岡県" {{ (old("todofu") == '福岡県') ? "selected":"" }}>福岡県</option>
                    <option value="佐賀県" {{ (old("todofu") == '佐賀県') ? "selected":"" }}>佐賀県</option>
                    <option value="長崎県" {{ (old("todofu") == '長崎県') ? "selected":"" }}>長崎県</option>
                    <option value="熊本県" {{ (old("todofu") == '熊本県') ? "selected":"" }}>熊本県</option>
                    <option value="大分県" {{ (old("todofu") == '大分県') ? "selected":"" }}>大分県</option>
                    <option value="宮崎県" {{ (old("todofu") == '宮崎県') ? "selected":"" }}>宮崎県</option>
                    <option value="鹿児島県" {{ (old("todofu") == '鹿児島県') ? "selected":"" }}>鹿児島県</option>
                    <option value="沖縄県" {{ (old("todofu") == '沖縄県') ? "selected":"" }}>沖縄県</option>                  
   
                </select>
              </div>
            </div>            
 
            <div class="form-group">
              <label class="col-md-4 control-label">パスワード</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password">
              </div>
            </div>
 
            <div class="form-group">
              <label class="col-md-4 control-label">パスワード確認</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password_confirmation">
              </div>
            </div>
 
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-info btn-lg btn-block">
                  登録する
                </button>
                <div class="space50"></div>
                <p class="font08"><a href="/rule">利用規約</a>と<a href="/policy">プライバシーポリシー</a>に同意した上で登録してしてください。<br><br>
                {{-- 確認メール再送画面へのリンクを追加 --}}
                <a href="{{ url('/auth/resend') }}">- ユーザー登録メールを再送する</a><Br>
                <a href="/help/1">- メールが届かない</a>
                </p>
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
              <li class="active">ユーザー登録</li>
            </ol>

        </div>
        
        @if (!strstr(Request::url(), '/lesson/category/'))
	        <div id="snsbox-footer" class="pull-right"></div>
        @endif
    </div>
</div>
@endif

@endsection