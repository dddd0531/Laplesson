@extends('layouts.default')


@section('title')確認　お申し込み | <?php echo Config::get('app.sitename');?>@endsection
@section('description'){{ Config::get('app.description')}}@endsection

@section('content')


        <div class="container subpage">
               <h1 class="subpage-h1">確認</h1>
         </div><!--container-->
        <div class="subpage block bg-gray bordertop">
         <div class="container">

			<div class="row">
            	<div class="col-sm-8 col-sm-offset-2">
                   <div class="panel panel-default">
                        <div class="panel-body">
                            <form method="post" action="{{ url('/newscontact/complete') }}">      
                                {{-- CSRF対策--}}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                
                                <div class="form-group">
                                    <label class="control-label" for="title">参加イベント</label>
                                    <p class="form-control-static">{{ $data['title'] }}</p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name2">ニックネーム</label>
                                    <p class="form-control-static">{{ $data['name2'] }}さん</p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="email">メールアドレス</label>
                                    <p class="form-control-static">{{ $data['email'] }}</p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="tell">電話番号</label>
                                    <p class="form-control-static">{{ $data['tell'] }}</p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="years">歯科衛生士 経験年数</label>
                                    <p class="form-control-static">{{ $data['years'] }}</p>
                                </div>                                                                                                
                                
                                <div class="form-group required {{ $errors->has('content') ? 'has-error' : '' }}">
                                    <label class="control-label" for="content">質問など</label>
                                    <p class="form-control-static">{{ $data['content'] }}</p>
                                </div>
                                <div class="form-group text-center">
                                        <button type="submit" name="action" value="post" class="btn btn-primary btn-lg">送信</button>
                                        <a href="javascript:history.back();" class="btn btn-default btn-lg">戻る</a>
                                </div>
                            </form>
                        </div>
                    </div>
                  </div>
                </div><!--row-->
            
         </div><!--container-->
        </div> 

<div id="footer-top">
	<div class="container">
        <div class="pull-left">
            <ol class="breadcrumb">
              <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
              <li class="active">確認　お問い合わせ</li>
            </ol>

        </div>
        
        @if (!strstr(Request::url(), '/lesson/category/'))
	        <div id="snsbox-footer" class="pull-right"></div>
        @endif
    </div>
</div>


@endsection