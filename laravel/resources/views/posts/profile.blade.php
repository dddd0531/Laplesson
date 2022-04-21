@extends('layouts.default')


@section('title'){{$user->name}}さんのプロフィール@endsection

@section('content')
<?php //アプリ判定////////////////////////
$appclass = "";
$appflag = 0;
if (Util::ua_app() == true) {
	$appclass = Config::get('app.appclass');
	$appflag = 1;
}
//アプリ判定////////////////////////?>

<div class="container subpage profilepage <?php echo $appclass;?>">
<div class="row">
<!--メインコンテンツ ############################################################-->
<div class="col-sm-8">


        <h1>{{$user->name}}さんのプロフィール</h1>

		 @if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
			<ol class="breadcrumb">
			  <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
			  <li><a href="/mypage">マイページ</a></li>
			  <li class="active">プロフィール</li>
			</ol>
		@endif

        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified" role="tablist">
          <li role="presentation" class="active"><a href="#namepage" aria-controls="name" role="tab" data-toggle="tab">ニックネーム</a></li>
          <li role="presentation"><a href="#avaterpage" aria-controls="avater" role="tab" data-toggle="tab">プロフィール画像</a></li>
          <li role="presentation"><a href="#emailpage" aria-controls="email" role="tab" data-toggle="tab">メールアドレス</a></li>
          <li role="presentation"><a href="#passwordpage" aria-controls="password" role="tab" data-toggle="tab">パスワード</a></li>
        </ul>

    <!-- Tab panes -->
    <div class="space30"></div>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="namepage">
        <form class="form-horizontal" method="post" action="/mypage/profile/name">
          @csrf
          {{ method_field('patch') }}
          <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
              <input class="form-control" type="text" name="name" placeholder="ラプ子" value="{{ old('name', $user->name) }}">
              @if ($errors->has('name')) <span class="error">{{ $errors->first('name') }}</span> @endif </div>
          </div>
          <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
              <input id="name-btn" class="btn btn-primary" type="submit" value="変更する">
            </div>
          </div>
        </form>
      </div>
        <div role="tabpanel" class="tab-pane" id="avaterpage">
        <form class="form-horizontal" method="post" action="/mypage/profile/avater" enctype="multipart/form-data">
          @csrf
          {{ method_field('patch') }}
          <p>プロフィール画像を変更するには、以下からアップロードしてください。</p>
          <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
              <input class="form-control" type="file" name="avater" placeholder="avater" value="{{ old('avater', $user->avater) }}">
              <div class="space20"></div>
              <span class="font08">現在のプロフィール画像　</span>@if ($user->avater) <img class="avater2" src="/media/{{ $user->avater }}" alt="{{ $user->name }}さん"> @else <img class="avater2" src="/media/avater.jpg" alt="{{ $user->name }}さん"> @endif
              @if ($errors->has('avater')) <span class="error">{{ $errors->first('avater') }}</span> @endif </div>
          </div>
          <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
              <input id="avater-btn" class="btn btn-primary" type="submit" value="変更する">
            </div>
          </div>
        </form>
      </div>

      <div role="tabpanel" class="tab-pane" id="emailpage">
        <!-- <form class="form-horizontal" method="post" action="{{ url('/mypage/profile/', $user->id) }}"> -->
        <form class="form-horizontal" method="post" action="/mypage/profile/email">
          @csrf
          {{ method_field('patch') }}
          <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
              <input class="form-control" type="text" name="email" placeholder="aaaaa@aaa.com" value="{{ old('email', $user->email) }}">
              @if ($errors->has('email')) <span class="error">{{ $errors->first('email') }}</span> @endif </div>
          </div>
          <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
              <p>
              【メールアドレス変更手順】<br>
               <ol>
               	<li><small>新しいメールアドレスを入力して変更確認メールを送信する</small></li>
               <li><small>変更確認メールに記載されているリンクをクリックして有効化する</small></li>
							 <li><small>新しいメールアドレスでログインする</small></li>            
              </ol>
              </p>
              <p class="font09"><a href="/help/1">　- メールが届かない場合はこちら</a></p>
              <input id="email-btn" class="btn btn-primary" type="submit" value="変更確認メールを送信する">
            </div>
          </div>
        </form>
      </div>
      <div role="tabpanel" class="tab-pane" id="passwordpage">
        <form class="form-horizontal" method="post" action="{{ url('/mypage/profile/passwordSetting') }}">
        パスワードを変更するには、必要な項目を記入して変更してください。
        <div class="space20"></div>
          @csrf
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label class="col-md-4 control-label">現在のパスワード</label>
            <div class="col-md-6">
              <input type="password" class="form-control" name="password">
            </div>
            <div class="space20"></div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">新しいパスワード</label>
            <div class="col-md-6">
            <span class="font08">（6文字以上、英数記号のみ）</span>
              <input type="password" class="form-control" name="passwordnew">
               </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">パスワード　確認</label>
            <div class="col-md-6">
              <input type="password" class="form-control" name="passwordconfirm">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button id="password-btn" type="submit" class="btn btn-primary"> 変更する </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="space50 mobileonly"></div>
    <div class="space50 mobileonly"></div>
    </div><!--END　メインコンテンツ ############################################################-->


	 @if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
    <!--サイドバー ############################################################-->
    <div class="col-sm-4" id="sidebar">
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

        <div class="panel panel-default">
            <div class="panel-heading">お知らせ</div>
            <div class="panel-body font08">
                <ul>
                @forelse ($news as $new)
                    <?php $date = date_format($new->created_at , 'Y.m.d');?>
                    <li><?php echo $date;?>　<a href="{{ route('news.show', $new->id) }}">{{ $new->title }}</a></li>
                @empty
                    <li>お知らせはありません。</li>
                @endforelse

                </ul>
            </div><!--panel-body -->
         </div><!-- panel -->
    </div><!--サイドバー ############################################################-->
	@endif

</div><!--END　row-->


</div>
<!--container-->



@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
<div id="footer-top">
	<div class="container">
        <div class="pull-left">
            <ol class="breadcrumb">
              <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
              <li class="active">プロフィール</li>
            </ol>

        </div>

        @if (!strstr(Request::url(), '/lesson/category/'))
	        <div id="snsbox-footer" class="pull-right"></div>
        @endif
    </div>
</div>
@endif

@endsection

@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
@section('script')
$(function(){
    $("input#name-btn").click(function(){
        if(confirm("ニックネームを変更しますか？")){
            //そのままsubmit（削除）
        }else{
            //cancel
            return false;
        }
    });
     $("#avater-btn").click(function(){
        if(confirm("プロフィール画像を変更しますか？")){
            //そのままsubmit（削除）
        }else{
            //cancel
            return false;
        }
    });

    $("#email-btn").click(function(){
        if(confirm("メールアドレスを変更しますか？")){
            //そのままsubmit（削除）
        }else{
            //cancel
            return false;
        }
    });

     $("#password-btn").click(function(){
		console.log('cleck');
        if(confirm("パスワードを変更しますか？")){
            //そのままsubmit（削除）
        }else{
            //cancel
            return false;
        }
    });

});
@stop
@endif
