@extends('layouts.default')


@section('title')学習ガイド | <?php echo Config::get('app.sitename');?>@endsection
@section('description'){{ Config::get('app.description')}}@endsection
@section('keywords'){{ Config::get('app.keywords')}}@endsection

@section('content')
        <div class="container subpage guide">

            
            <div>
               <h1>学習ガイド</h1>
    
                <div>
                    <ol class="breadcrumb">
                      <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
                      <li class="active">学習ガイド</li>
                    </ol>
                </div>
                <div class="row">
                    <div class="col-sm-6">	
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h2>気になるレッスンからやってみよう</h2>
                                <p>現在、ラプレッスンでは<strong class="accent">{{ $categories }}</strong>レッスン、<strong class="accent">{{ $posts }}</strong>動画をご用意しています。まずは気になる動画を選んで気軽に始めてみましょう。</p>
                            </div><!--panel-body-->
                         </div><!--panel-->
                     </div>
                    <div class="col-sm-6">	
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h2>学習の進み具合を管理しよう</h2>
                                <p>動画学習ページの『学習完了』ボタンをクリックして、完了したレッスンと未学習のレッスンを把握しよう。マイページでは、あなたの学習状況を把握できます。</p>             
                            </div><!--panel-body-->
                         </div><!--panel-->
                     </div>
                    <div class="col-sm-6">	
                        <div class="panel panel-default">
                            <div class="panel-body">
                            <h2>繰り返し動画を見よう</h2>
                            <p>1回で理解できなかった場合は、何度も繰り返し動画を見て自分のものにしましょう。</p>             
                            </div><!--panel-body-->
                         </div><!--panel-->
                     </div>
                    <div class="col-sm-6">	
                        <div class="panel panel-default">
                            <div class="panel-body">
                            <h2>実践してみよう</h2>
                            <p>ラプレッスンで学んだことを模型を使って練習したり、衛生士同士で手技の確認をしたり、最終的には臨床に活かせるように実践してみよう。気に入ったレッスンを院内でシェアしてみよう。</p>
                            </div><!--panel-body-->
                         </div><!--panel-->
                     </div>
                    <div class="col-sm-6">	
                        <div class="panel panel-default">
                            <div class="panel-body">
                            <h2>レッスンリクエストしてみよう</h2>
                            <p>こんな手技がみたい、あんな知識がほしい、などラプレッスンにリクエストしてみよう。希望が多いリクエストはチーム内で検討して、新しく提供できるようにがんばります。</p>
                            </div><!--panel-body-->
                         </div><!--panel-->
                     </div>
                     
                    <div class="col-sm-6">	
                        <div class="panel panel-default">
                            <div class="panel-body">
                            <h2>褒められエピソードをください</h2>
                            <p>ラプレッスンをつかってみて、実際の臨床で起きた変化や、嬉しかったことを教えてください。それが私たちのモチベーションになるんです。</p>
                            </div><!--panel-body-->
                         </div><!--panel-->
                     </div>                     
                </div><!--row-->
                <div class="row content">
                   <div class="col-sm-6 col-md-4 col-md-offset-2"> <a href="/lesson" class="btn btn-primary btn-block btn-big">レッスン一覧をみる</a> </div>
                   <div class="space20 mobileonly"></div>
                   @if (Auth::guest())
                       <div class="col-sm-6 col-md-4"> <a href="/auth/register" class="btn btn-info btn-block btn-big">今すぐ始める</a> </div>
                   @else
                       <div class="col-sm-6 col-md-4"> <a href="/mypage" class="btn btn-info btn-block btn-big">学習を始める</a> </div>
                   @endif           
                   <!--col--> 
                </div>
            </div>
            

         </div><!--container-->

<div id="footer-top">
	<div class="container">
        <div class="pull-left">
            <ol class="breadcrumb">
              <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
              <li class="active">学習ガイド</li>
            </ol>

        </div>
        
        @if (!strstr(Request::url(), '/lesson/category/'))
	        <div id="snsbox-footer" class="pull-right"></div>
        @endif
    </div>
</div>

@endsection