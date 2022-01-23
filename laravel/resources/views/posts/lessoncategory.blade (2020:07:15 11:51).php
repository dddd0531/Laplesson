@extends('layouts.default')


@section('title'){{ $categorycount->category }} | <?php echo Config::get('app.sitename');?>@endsection
@section('description'){{ $categorycount->category}}のレッスン　{{ $categorycount->description }}@endsection
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

<div class="row">

<!--メイン ############################################################-->
@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
	<div class="col-sm-8">
@else
	<div class="col-sm-12">	
@endif
		@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
        <div>
            <ol class="breadcrumb">
              <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
              @if(Auth::check())
              <li><a href="/mypage">マイページ</a></li>
              @endif
              <li><a href="/lesson">レッスン一覧</a></li>
              <li class="active">{{ $categorycount->category }}</li>
            </ol>
        </div> 
       	@endif
	
        <h1> <img class="lessonicon lessoniconh1 lessonicon{{ $categorycount->category_id }}" src="/image/lesson{{ $categorycount->category_id }}.png" alt="{{ $categorycount->category }}">		{{ $categorycount->category }}</a> 全{{ $categorycount->count }}回</h1>
        <div class="lessonheader cleafix">
        	<img class="pull-left" src="/image/image{{ $categorycount->category_id }}.jpg" alt="{{ $categorycount->category }}" width="50%">
              <p>{{ $categorycount->description }}</p>  
        </div> 
        <div class="space20"></div>
        <div class="clearfix">  
            <table class="table lessontable"><tbody>
                @forelse ($posts as $post)
                  <tr><td class="lessontitle <?php if($post->usersonly == 2){ echo "comingsoon"; } ?>">
					@if ($post->usersonly != 2)				  
						<a class="alink" href="{{ action('PostsController@lessonshow', $post->id) }}">  
					@endif
                    <div class="pull-right">
                        @if ($post->usersonly != 2)<!--0:一般公開　1:会員限定　2:準備中 /////////////////-->
                        	<small class="text-muted font08"><i class="fa fa-clock-o pconly2" aria-hidden="true"></i> {!! $post->playtime !!}</small>　
                        @endif
                        
                        @if (Auth::guest())
                        {{-- ログインしていない時 --}}
                            <input class="btn btn-default btn-xs pull-right" type="submit" disabled value="未学習">
                        @else
                        {{-- ログインしている時 --}} 
                            @if (in_array($post->id, $studies)) 
                                <span class="label label-default pull-rigth">学習済み</span>
                            @else
                               @if ($post->usersonly != 2)
                                <span class="label label-info pull-rigth">未学習</span>
                               @endif
                            @endif
                        @endif
                     </div>                    
                  
                  
					  
					
                    @if (Auth::guest())
                    {{-- ログインしていない時 --}}
                    	@if ($post->usersonly == 0)<!--0:一般公開　1:会員限定　2:準備中 /////////////////-->
                        	<i class="fa fa-youtube-play"></i>　{{ $post->title }}　<label class="label label-info">一般公開中</label>
                        @elseif ($post->usersonly == 2)<!--0:一般公開　1:会員限定　2:準備中 /////////////////-->
							  <i class="fa fa-exclamation-triangle gray" aria-hidden="true"></i>　<span class="gray">{{ $post->title }}</span>　<label class="label label-gray">準備中</label>
                        @else
                        	<i class="fa fa-lock gray" aria-hidden="true"></i>　{{ $post->title }}　<label class="label label-primary">会員専用</label>
                        @endif
                    @else
                    {{-- ログインしている時 --}} 
                       	@if ($post->usersonly == 0 || $post->usersonly == 1 )
                        	<i class="fa fa-youtube-play"></i>　{{ $post->title }}
                        @else
					  <i class="fa fa-exclamation-triangle gray" aria-hidden="true"></i>　<span class="gray">{{ $post->title }}</span>　<label class="label label-gray">準備中</label>
                        @endif
                    @endif
                    
                    <div class="media lessonbody">
                      <div class="media-left">
                        @if ($post->imageflag == 1)
                            <img class="postimage media-object" src="/image/bui{{ $post->id }}.png" alt="部位{{ $post->id }}">
                        @endif
                      </div>
                      <div class="media-body">
                        {!! nl2br(e($post->body)) !!}
                      </div>
                    </div>  
					
							
					@if ($post->usersonly != 2)				  
						</a><!-- END A ////////////-->
					@endif	
                  </td>
                @empty
                    <tr><td>No Posts</td></tr>
                @endforelse              
            </tbody></table>    
        </div>
		@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-commenting-o" aria-hidden="true"></i> いいと思ったらポチっとお願いします!</div>
				<div class="panel-body">
					<div id="snsbox-article"></div>
				</div>
			</div>
		@endif
        <div class="space50 pconly"></div>
		@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
	        @include('layouts.baner')
		@endif
</div><!--メイン ############################################################-->    

@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
<!--サイドバー ############################################################-->
<div class="col-sm-4" id="sidebar">
	  <div class="panel panel-default">
		<div class="panel-heading">{{ $categorycount->category }}</div>
			<div class="panel-body chart font08">
		@if (Auth::guest())
		{{-- ログインしていない時 --}}
			<a href="/auth/register"><i class="fa fa-exclamation-circle"></i> ユーザー登録をすると学習状況を管理できます。</a>     


		@else
		{{-- ログインしている時 --}}  
				 <?php $migakusyu2 = $migakusyu-$studies2;//未学習ステータスの総数	?>		

				<canvas id="chart" class="pull-left" height="150" width="150"></canvas>

					<div class="count">
						<em><?php echo round($studies2/$migakusyu*100);?><span class="caption">%</span></em>
					</div>
					<div class="chartinfo">
						<table><tbody>
							<tr><td width="75%">完了レッスン</td><td><strong class="font20 accent2"><?php echo $studies2;?></strong>/{{ $categorycount->count }}</td></tr>
							<tr><td>完了率</td><td><strong class="font20 accent2"><?php echo round($studies2/$migakusyu*100);?></strong>%</td></tr>
						</tbody></table>
					</div>

		@endif  
		</div><!-- .panel-body -->
	  </div><!-- .panel -->
	  <div id="otherlesson" class="panel panel-default">
		<div class="panel-heading">他のレッスン</div>
		<div class="panel-body">

		<ul>
		@forelse ($catecount as $cate)
				<li>
					<p class="thumb"><a href="/lesson/category/{{ $cate->category_id }}"><img width="100px" class="lessonicon lessonicon{{ $cate->category_id }}" src="/image/lesson{{ $cate->category_id }}.png" alt="{{ $cate->category }}"></a></p>		
					<h3><a href="/lesson/category/{{ $cate->category_id }}">{{ $cate->category }} 全{{ $cate->count }}回</a></h3>
					<p class="lessondescription pconly2"><a href="/lesson/category/{{ $cate->category_id }}"><?php echo mb_strimwidth($cate->description, 0, 60, "...","UTF-8");?></a></p>
				</li>
		@empty
			<li class="list-group-item">No Posts</li>
		@endforelse       
		</ul>    



		</div><!-- .panel-body -->
	  </div><!-- .panel -->
	
    @include('layouts.sidebarbaner')
</div><!--END　サイドバー############################################################ -->
@endif
</div><!--row-->
</div><!--container-->

@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
	<div id="footer-top">
		<div class="container">
			<div class="pull-left">
				<ol class="breadcrumb">
				  <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
				  @if(Auth::check())
				  <li><a href="/mypage">マイページ</a></li>
				  @endif
				  <li><a href="/lesson">レッスン一覧</a></li>
				  <li class="active">{{ $categorycount->category }}</li>
				</ol>
			</div>

			@if (!strstr(Request::url(), '/lesson/category/'))
				<div id="snsbox-footer" class="pull-right"></div>
			@endif
		</div>
	</div>
@endif



@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
    @if (Auth::guest())
    {{-- ログインしていない時 --}}
    
    @else
    {{-- ログインしている時 グラフ生成--}}  
		<script src="/js/Chart.js"></script>
        <script>
        // Comment削除 
        function deleteComment(e) {
          'use strict';
        
          if (confirm('are you sure?')) {
            document.getElementById('form_' + e.dataset.id).submit();
          }
        }
        
        
        var doughnutData = [
        　　{
        　　　value: <?php echo $studies2;?>,
        　　　color:"#ff8c7c",
              label:"学習済み"        // 凡例のラベル
			},
        　　{
        　　　value: <?php echo $migakusyu2;?>,
        　　　color: "#f5f5f5",
              label:"未学習"        // 凡例のラベル
        　　},
        
        
        ];
         
        //var myDoughnut = new Chart(document.getElementById("chart").
        //getContext("2d")).Doughnut(doughnutData);
         

        var ctx = document.getElementById("chart").getContext("2d");
        new Chart(ctx).Doughnut(doughnutData,{
            segmentShowStroke : false,
            segmentStrokeColor : "#fff",
            segmentStrokeWidth : 1,
            percentageInnerCutout : 70, // **** Border width
            animation : true,
            animationSteps : 100,
            animationEasing : "easeOutBounce",
            animateRotate : true,
            animateScale : false,
            //onAnimationComplete : null
	　　　　//tooltipTemplate: "<%if (label){%><%=label%><%}%>",
	　　　　//onAnimationComplete: function(){
	　　　　//　　this.showTooltip(this.segments, true);
	　　　　//},
	　　　　tooltipEvents: [],
	　　　　showTooltips: true			
			
        });
		
	
				
        
        </script>
    @endif
@endif


@endsection