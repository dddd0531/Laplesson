@extends('layouts.default')
@section('title')マイページ@endsection
@section('content')
<?php //アプリ判定////////////////////////
$appclass = "";
$appflag = 0;
if (Util::ua_app() == true) {
	$appclass = Config::get('app.appclass');
	$appflag = 1;
}
//アプリ判定////////////////////////?> 

<div class="container subpage mypage <?php echo $appclass;?>">
    <div class="row">
        <div class="col-sm-8"><!--メイン ######################################################-->
		  @if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
        	@if(!empty($pickup_news))
                <div class="alert alert-success font09" role="alert" style="margin-bottom:10px;padding:10px;">
                  <div>
                @foreach ($pickup_news as $pickup_new)
                      <i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo date_format(date_create($pickup_new->created_at), "Y.m.d");?>　<a href="{{ action('NewsController@newsshow', $pickup_new->id) }}">{{ $pickup_new->title }}</a>　未読
                      @if($pickup_new !== end($pickup_news))
                      	<div class="sepa"></div>
                      @endif
                @endforeach   
                  </div>
                </div>
                <div class="space30"></div>
            @endif    
          @endif
			
			@if($studied != 0)
			  @include('layouts.topbaner')
			@endif
              
            <h1>{{ Auth::user()->name }}さんの学習状況</h1>
			
			@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
            <ol class="breadcrumb">
              <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
              <li class="active">マイページ</li>
            </ol>
            @endif

            <div class="contents">	
                        <?php $i = 0; ?>
                        @if($studied != 0)
								<div class="space20 mobileonly"></div>
								<div class="panel panel-default mobileonly">
									<div class="panel-heading">@if (Auth::user()->avater) <img class="avater" src="/media/{{ Auth::user()->avater }}" alt="{{ Auth::user()->name }}さん"> @else <img class="avater" src="/media/avater.jpg" alt="{{ Auth::user()->name }}さん"> @endif 
										  ようこそ！{{ Auth::user()->name }}さん</div>
									<div class="panel-body">
										  <div class="row studyprogress">
											<div class="col-sm-6 col-md-4">
												<span class="font08">総学習時間</span><Br class="pconly">
												<strong class="font12">{{ $times }}</strong>
											</div>
											<div class="col-sm-6 col-md-4">
												<span class="font08">学習日数</span><Br class="pconly">
												<strong class="font12">{{ $days->date }}</strong>
											</div>
											<div class="col-sm-12 col-md-4">
												<span class="font08">完了レッスン</span><Br class="pconly">
												<strong class="font12">{{ $studied }}</strong>
											</div>
										 </div>
									</div><!--panel-body -->
								 </div><!-- panel -->
								<div class="space30 mobileonly"></div>
				
				
							@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
								<h3>学習中のレッスン</h3>
							@endif
                               @forelse ($studyedcategory as $category)
                                   <?php if($category["studies"] != 0){ $num = round($category["studies"]/$category["postcount"]*100); ?>
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <a href="{{ route('lessoncategory.show', $category["id"]) }}"><img class="lessonicon lessonicon{{ $category["id"] }}" src="/image/lesson{{ $category["id"] }}.png" alt="{{ $category["category"] }}"></a>
                                        </div>
                                        <div class="col-sm-7 col-xs-10">
                                            <h4><a href="{{ route('lessoncategory.show', $category["id"]) }}">{{ $category["category"] }}</a>　<br class="mobileonly2">全{{ $category["postcount"] }}回</h4>
                                            <div class="progress">
                                            	<?php if($num == 100){?>
                                                  <div class="progress-bar progress-bar-striped lessonicon{{ $category["id"] }}" role="progressbar" aria-valuenow="<?php echo $num;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $num;?>%;">
                                                    <?php echo $num;?>%
                                                  </div>
                                                <?php }else{?>
                                                  <div class="progress-bar progress-bar-striped active lessonicon{{ $category["id"] }}" role="progressbar" aria-valuenow="<?php echo $num;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $num;?>%;">
                                                    <?php echo $num;?>%
                                                  </div>
                                              	<?php } ?>
                                            </div>                                        
                                             <span class="font09 text-muted"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 残り<?php echo $category["postcount"] - $category["studies"];?>/<?php echo $category["postcount"];?>
											　最終更新日：<?php echo date("Y.n.j",strtotime($category["created_at"]));?></span>											 
                                        </div>
                                        <div class="col-xs-3 pconly">
											<?php if($num == 100){?>
                                                    <a href="{{ route('lessoncategory.show', $category["id"]) }}" class="btn btn-default pull-right">もう一度 <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                                <?php }else{?>
                                                    <a href="{{ route('lessoncategory.show', $category["id"]) }}" class="btn btn-warning pull-right">つづき <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                              	<?php } ?>
                                        </div>
                                    </div>
                                    <div class="sepalator"></div>
                                        
                                        <?php }?>
                                        <?php $i++; ?>
                                @empty 
                                @endforelse
				
								@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
									<div class="space20"></div>                            
									<a href="/lesson" class="btn btn-primary btn-lg">他のレッスンを見る <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
									<div class="space20"></div>
								@endif
                        @else
                            <div class="space20"></div>
                            <h2>気になったレッスンから始めてみましょう</h2>
                            <div class="space10"></div>
                            <div class="panel panel-default">
                              <div class="panel-body">
                            	<h3>はじめまして!! <span class="accent">{{ Auth::user()->name }}</span>さん</h3>
                            	<p>ラプレッスンにご登録いただきありがとうございます。このご縁に感謝です。<br>動画でお伝えすることはほんの少しかもしれません。
その少しが、お困りごとの解決につながるキッカケになれば嬉しいです！「気になる動画からトライしてみてください！」</p>
                              </div>
                            </div>                            
                            <a href="/lesson" class="btn btn-info btn-lg">レッスン一覧を見る <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                            <div class="space20"></div>
                        @endif
                        <div class="space50 mobileonly"></div>
             </div>
        </div><!--メイン ############################################################-->    
            
        <!--サイドバー ############################################################-->
        
		
        <div class="col-sm-4" id="sidebar">
			
			@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
            <div class="panel panel-default">
                <div class="panel-heading">ようこそ<strong>{{ Auth::user()->name }}さん</strong></div>
                <div class="panel-body">
                      @if (Auth::user()->avater) <img class="avater" src="/media/{{ Auth::user()->avater }}" alt="{{ Auth::user()->name }}さん"> @else <img class="avater" src="/media/avater.jpg" alt="{{ Auth::user()->name }}さん"> @endif 
                      {{ Auth::user()->name }}さん
                      <div class="sepa"></div>
                      <div class="row studyprogress">
                      	<div class="col-sm-6 col-md-4">
                        	<span class="font08">総学習時間</span><Br class="pconly">
                            <strong class="font12">{{ $times }}</strong>
                        </div>
                      	<div class="col-sm-6 col-md-4">
                        	<span class="font08">学習日数</span><Br class="pconly">
                            <strong class="font12">{{ $days->date }}</strong>
                        </div>
                      	<div class="col-sm-12 col-md-4">
                        	<span class="font08">完了レッスン</span><Br class="pconly">
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
							<li><span class="text-muted"><?php echo $date;?></span><br><a href="{{ route('news.show', $new->id) }}">{{ $new->title }} <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></li>
						@empty 
							<li>お知らせはありません。</li>
						@endforelse                        

						</ul>
					</div><!--panel-body -->
				 </div><!-- panel -->   
			@endif
            @include('layouts.sidebarbaner')
        </div><!--サイドバー ############################################################-->
    </div><!-- row -->
</div><!--container-->
@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
	<div id="footer-top">
		<div class="container">
			<div class="pull-left">
				<ol class="breadcrumb">
				  <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
				  <li class="active">マイページ</li>
				</ol>

			</div>

			@if (!strstr(Request::url(), '/lesson/category/'))
				<div id="snsbox-footer" class="pull-right"></div>
			@endif
		</div>
	</div>
@endif
			
@endsection