@extends('layouts.default')
@section('title')【動画】{{ $post->categories->category }} {{ $post->title }} | <?php echo Config::get('app.sitename');?>@endsection
@section('description')<?php echo Config::get('app.sitename');?> | {{ $post->body }}@endsection
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
<div class="lessonshow">


<div class="row">
<!--メインコンテンツ ############################################################-->
<div class="col-sm-8">
@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
	@if(Auth::check())
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


	<div>
		<ol class="breadcrumb">
		  <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
		  @if(Auth::check())
		  <li><a href="/mypage">マイページ</a></li>
		  @endif
		  <li><a href="/lesson">レッスン一覧</a></li>
		  <li><a href="/lesson/category/{{ $post->categories->id }}">{{ $post->categories->category }}</a></li>
		  <li class="active">{{ $post->title }}</li>
		</ol>
	</div>
@endif

@include('layouts.topbaner')
<h1><small>{{ $post->categories->category }}</small><br>{{ $post->title }}</h1>


@if($post->squareflag == 1)
	<div id="videowrapper" class="videowrappersquare">
@else
	<div id="videowrapper">
@endif
    @if (Auth::guest())
    {{-- ログインしていない時 --}}
    	@if ($post->usersonly == 0)
		    <iframe id="videocontent" src="https://player.vimeo.com/video/{{ $post->movie }}" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

		@elseif ($post->usersonly == 2)
            <div id="videocontent" class="rockvideo">
            	<div id="videocontentinner">
                    <img src="/image/wait.png" alt="準備中" width="100%">
                </div>
            </div>
    	@else
            <div id="videocontent" class="rockvideo">
            	<div id="videocontentinner">
                    <img src="/image/lessonshow{{ $post->id }}.png" alt="{{ $post->categories->category }} {{ $post->title }}" width="100%">
                    <div id="videoinfo">
                        <a class="btn btn-lg btn-info" href="/auth/login">ログインして動画を再生する　<i class="fa fa-play-circle" aria-hidden="true"></i></a><br>
                        <div class="space10"></div>
                        <a href="/auth/register" class="btn btn-xs btn-primary">ユーザー登録がお済みでない方はこちら（無料）</a>
                    </div>
                </div>
            </div>
        @endif


    @else
    {{-- ログインしている時 --}}
		@if ($post->usersonly == 2)
            <div id="videocontent" class="rockvideo">
            	<div id="videocontentinner">
                    <img src="/image/wait.png" alt="準備中" width="100%">
                </div>
            </div>
    	@else
	    	<iframe id="videocontent" src="https://player.vimeo.com/video/{{ $post->movie }}" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	   	@endif
    @endif
</div>
<?php
        $post_id = $post->id;
        $category_id = $post->categories->id;
?>
@if (Auth::guest())
{{-- ログインしていない時 --}}
    <div class="btn-group btn-group-justified" role="group" aria-label="...">
    	<div class="btn-group" role="group">
			<?php if($prev != 'first'){?>
                <button type="button" onclick="location.href='{{ route('lesson.show', $prev) }}'" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left font20"></span><br><span class="pconly3">前へ</span></button>
			<?php }else{?>
                <button type="button" class="btn btn-default" disabled="disabled"><span class="glyphicon glyphicon-chevron-left font20"></span><br><span class="pconly3">前へ</span></button>
			<?php }?>
        </div>
    	<div class="btn-group btn-group-center" role="group">
            	<a href="/auth/register" class="btn btn-primary"><span class="glyphicon glyphicon-user font20"></span><br>ユーザー登録が必要です</a>
        </div>
    	<div class="btn-group" role="group">
			<?php if($next != 'last'){?>
                <button type="button" onclick="location.href='{{ route('lesson.show', $next) }}'" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right font20"></span><br><span class="pconly3">次へ</span></button>

			<?php }else{?>
                <button style="color:#eee;" type="button" data-container="body" data-toggle="popover" data-html="true" data-placement="top" title="このレッスンの最後の動画です" data-content='他のレッスン動画を見るにはレッスン一覧に戻ってください。<br><a href="/lesson" class="btn btn-primary">レッスン一覧 <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>' class="btn btn-default"><span class="glyphicon glyphicon-chevron-right font20"></span><br><span class="pconly3">次へ</span></button>
			<?php }?>

        </div>

    </div>

@else
{{-- ログインしている時 --}}
    <?php
        $user_id = Auth::user()->id;
        $migakusyu2 = $migakusyu-$studies;//未学習ステータスの総数
    ?>

    <!--
    <form id="statusbt" class="form-horizontal pull-left" method="post" action="{{ action('StudiesController@store', [$user_id,$post_id]) }}">
     {{ csrf_field() }}
     @if(isset($study) && $study->status == 1)
      <input type="hidden" name="status" value="0">
      <?php $status = 0;?>
      @else
      <input type="hidden" name="status" value="1">
      <?php $status = 1;?>
      @endif
    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
			<?php if($prev != 'first'){?>
            	<a href="{{ action('PostsController@lessonshow', $prev) }}" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span> 前へ</a>
			<?php }else{?>
                <button type="button" class="btn btn-default" disabled="disabled"><span class="glyphicon glyphicon-chevron-left"></span> 前へ</button>
			<?php }?>        </div>
    	<div class="btn-group" role="group">
              @if(isset($study) && $study->status == 1)
              	<button type="submit" class="btn btn-default btn-complete"><span class="glyphicon glyphicon-save"></span> 学習済み</button>
              @else
              	<button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-save"></span> 学習完了</button>
              @endif
        </div>
    	<div class="btn-group" role="group">
			<?php if($next != 'last'){?><a href="{{ action('PostsController@lessonshow', $next) }}" class="btn btn-default">次へ <span class="glyphicon glyphicon-chevron-right"></span></a>
			<?php }else{?>
                <button type="button" class="btn btn-default" disabled="disabled">次へ <span class="glyphicon glyphicon-chevron-right"></span></button>
			<?php }?>
        </div>
    </div>
    </form>
    	-->

      @if(isset($study) && $study->status == 1)
		  <?php $status = 0;?>
      @else
		  <?php $status = 1;?>
      @endif
    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
			<?php if($prev != 'first'){?>
            	<!--<a href="{{ action('PostsController@lessonshow', $prev) }}" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left font20"></span><br><span class="pconly3">前へ</span></a>-->
                <button type="button" onclick="location.href='{{ action('PostsController@lessonshow', $prev) }}'" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left font20"></span><br><span class="pconly3">前へ</span></button>
			<?php }else{?>
                <button type="button" class="btn btn-default" disabled="disabled"><span class="glyphicon glyphicon-chevron-left font20"></span><br><span class="pconly3">前へ</span></button>
			<?php }?>        </div>
    	<div class="btn-group btn-group-center" role="group">
              @if(isset($study) && $study->status == 1)
              	<button id="status-btn" class="btn btn-default btn-complete"><span class="glyphicon glyphicon-ok font20"></span><br>学習済み</button>
              @else
              	@if ($post->usersonly == 2)
              		<a href="#" class="btn btn-primary" disabled><span class="font16"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span><br>準備中</a>
              	@else
              		<button id="status-btn" class="btn btn-info"><span class="glyphicon glyphicon-save font20"></span><br>学習完了にする</button>
              	@endif
              @endif
        </div>
    	<div class="btn-group" role="group">
			<?php if($next != 'last'){?>
            	<!--<a href="{{ action('PostsController@lessonshow', $next) }}" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right font20"></span><br><span class="pconly3">次へ</span></a>-->
                <button type="button" onclick="location.href='{{ action('PostsController@lessonshow', $next) }}'" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right font20"></span><br><span class="pconly3">次へ</span></button>
			<?php }else{?>
                <!--<button type="button" class="btn btn-default" disabled="disabled"><span class="glyphicon glyphicon-chevron-right font20"></span><br><span class="pconly3">次へ</span></button>-->
                <button style="color:#eee;" type="button" data-container="body" data-toggle="popover" data-html="true" data-placement="top" title="このレッスンの最後の動画です" data-content='他のレッスン動画を見るにはレッスン一覧に戻ってください。<br><a href="/lesson" class="btn btn-primary">レッスン一覧 <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>' class="btn btn-default"><span class="glyphicon glyphicon-chevron-right font20"></span><br><span class="pconly3">次へ</span></button>
			<?php }?>
        </div>
    </div>



@endif


<div class="clearfix"></div>


<div class="space20"></div>
  <div class="panel panel-default" id="collapseChart">
    <div class="panel-heading">{{ $post->categories->category }}</div>
    <div class="panel-body chart font08">
    @if (Auth::guest())
    {{-- ログインしていない時 --}}
		<a href="/auth/register"><i class="fa fa-exclamation-circle"></i> ユーザー登録をすると学習状況を管理できます。</a>
    @else
    {{-- ログインしている時 --}}
        	<canvas id="chart2" class="pull-left" height="150" width="150"></canvas>

                <div class="count">
                    <em><?php echo round($studies/$migakusyu*100);?><span class="caption">%</span></em>
                </div>
				<div class="chartinfo">
                	<table><tbody>
              			<tr><td width="75%">完了レッスン</td><td><strong class="font20 accent2"><span class="completelesson"><?php echo $studies;?></span></strong>/<?php echo $migakusyu;?></td></tr>
                        <tr><td>完了率</td><td><strong class="font20 accent2"><span class="completeper"><?php echo round($studies/$migakusyu*100);?></span></strong>%</td></tr>
                	</tbody></table>
                </div>
    @endif
    </div><!-- .panel-body -->
  </div><!-- .panel -->

@include('layouts.baner2')

  <!-- Nav tabs -->
  <ul id="postinfo" class="nav nav-tabs nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">この動画について</a></li>
    <li role="presentation"><a href="#osarai" aria-controls="osarai" role="tab" data-toggle="tab">おさらい</a></li>
   </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    	<div class="space20"></div>
    	<div>
        	<span class="text-muted pull-right"><i class="fa fa-clock-o" aria-hidden="true"></i> {!! $post->playtime !!}</span>
	    	<p class="font09">{!! nl2br(e($post->body)) !!}</p>
            <div class="space10"></div>
            <!--関連動画-->
                @if ( !empty($refer1))
                <div class="space10"></div>
                <div class="list-group font08">
                        <a href="#" class="list-group-item active"><span class="label label-info">関連動画</span> つぎの動画も参考にしてください</a>
                    @if(!empty($refer1))
                        <a href="/lesson/{!! $post->refer1 !!}" class="list-group-item">{!! $refer1->categories->category !!}　{!! $refer1->title !!}</a>
                    @endif
                    @if(!empty($refer2))
                        <a href="/lesson/{!! $post->refer2 !!}" class="list-group-item">{!! $refer2->categories->category !!}　{!! $refer2->title !!}</a>
                    @endif
                    @if(!empty($refer3))
                        <a href="/lesson/{!! $post->refer3 !!}" class="list-group-item">{!! $refer3->categories->category !!}　{!! $refer3->title !!}</a>
                    @endif
                    @if(!empty($refer4))
                        <a href="/lesson/{!! $post->refer4 !!}" class="list-group-item">{!! $refer4->categories->category !!}　{!! $refer4->title !!}</a>
                    @endif
                </div>
                @endif
		</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="osarai">
    	<div class="space20"></div>

        <!--補足情報-->
          <p class="well font08 text-muted">※考え方や方法は様々あります。この動画でお伝えする内容はラプレッスンで推奨する方法です。</p>
          <p class="font08 text-muted">{!! nl2br($post->hosoku) !!}</p>
            @if($post->hosoku1 != "")
            <div class="space10"></div>
            <div class="panel panel-hosoku font08">
                <div class="panel-heading"><span class="label label-info">補足情報</span>　<strong>{!! $post->hosokutitle1 !!}</strong></div>
                <div class="panel-body text-muted">{!! nl2br($post->hosoku1) !!}</div>
            </div>
            @endif
            @if($post->hosoku2 != "")
            <div class="panel panel-hosoku font08">
                <div class="panel-heading"><span class="label label-info">補足情報</span>　<strong>{!! $post->hosokutitle2 !!}</strong></div>
                <div class="panel-body text-muted">{!! nl2br($post->hosoku2) !!}</div>
            </div>
            @endif
            @if($post->hosoku3 != "")
            <div class="panel panel-hosoku font08">
                <div class="panel-heading"><span class="label label-info">補足情報</span>　<strong>{!! $post->hosokutitle3 !!}</strong></div>
                <div class="panel-body text-muted">{!! nl2br($post->hosoku3) !!}</div>
            </div>
            @endif
            @if($post->hosoku4 != "")
            <div class="panel panel-hosoku font08">
                <div class="panel-heading"><span class="label label-info">補足情報</span>　<strong>{!! $post->hosokutitle4 !!}</strong></div>
                <div class="panel-body text-muted">{!! nl2br($post->hosoku4) !!}</div>
            </div>
            @endif
    </div>
</div>

@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
	<div class="space50"></div>
	<div class="panel panel-default">
		<div class="panel-heading"><i class="fa fa-commenting-o" aria-hidden="true"></i> いいと思ったらポチっとお願いします!</div>
		<div class="panel-body">
			<div id="snsbox-article"></div>
		</div>
	</div>

	<div class="space50"></div>
	<a href="/lesson" class="btn btn-lg btn-primary">他のレッスンを見る <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
	<div class="space50"></div>
@endif
@include('layouts.baner')



</div><!--END　メインコンテンツ ############################################################-->



<!--サイドバー ############################################################-->
<div class="col-sm-4" id="sidebar">
  <div class="panel panel-default" id="collapseChart2">
    <div class="panel-heading">{{ $post->categories->category }}</div>
    <div class="panel-body chart font08">
    @if (Auth::guest())
    {{-- ログインしていない時 --}}
		<a href="/auth/register"><i class="fa fa-exclamation-circle"></i> ユーザー登録をすると学習状況を管理できます。</a>
    @else
    {{-- ログインしている時 --}}
        	<canvas id="chart" class="pull-left" height="150" width="150"></canvas>

                <div class="count">
                    <em><?php echo round($studies/$migakusyu*100);?><span class="caption">%</span></em>
                </div>
				<div class="chartinfo">
                	<table><tbody>
              			<tr><td width="75%">完了レッスン</td><td><strong class="font20 accent2"><span class="completelesson"><?php echo $studies;?></span></strong>/<?php echo $migakusyu;?></td></tr>
                        <tr><td>完了率</td><td><strong class="font20 accent2"><span class="completeper"><?php echo round($studies/$migakusyu*100);?></span></strong>%</td></tr>
                	</tbody></table>
                </div>
    @endif
    </div><!-- .panel-body -->
  </div><!-- .panel -->

<div class="panel panel-default font08">
<div class="panel-heading">動画一覧</div>
<div class="panel-body">
	<table class="lessonlist"><tbody>
	<?php $i =1;?>
    @foreach ($posts as $post2)
        @if ($post2->released == 1)
            @if (Auth::guest() || !in_array($post2->id, $statues))
                @if($post_id == $post2->id)

                       <tr><td style="font-size:1.5em"><strong><span class="glyphicon glyphicon-arrow-right accent"></span></strong></td><td><a href="{{ route('lesson.show', $post2->id) }}" class="accent"><strong>{{ $post2->title }}</strong></a></td></tr>
                @else
                    @if(Auth::guest())
                        @if ($post2->usersonly == 0)
                            <tr><td style="font-size:1.5em"><span class="accent"><i class="fa fa-youtube-play"></i></span></td><td><a href="{{ route('lesson.show',  $post2->id) }}">{{ $post2->title }}</a></td></tr>
                        @elseif ($post2->usersonly == 2)
							<tr><td style="font-size:1.5em"></td><td><span class="gray">{{ $post2->title }}</span></td></tr>
                        @else
                            <tr><td style="font-size:1.5em"><span class="accent"><i class="fa fa-lock gray"></i></span></td><td><a href="{{ route('lesson.show', $post2->id) }}">{{ $post2->title }}</a></td></tr>
                        @endif
                    @else
                        @if ($post2->usersonly == 2)
							<tr><td style="font-size:1.5em"></td><td><span class="gray">{{ $post2->title }}</span></td></tr>
                         @else
                            <tr><td style="font-size:1.5em"></td><td><a href="{{ route('lesson.show', $post2->id) }}">{{ $post2->title }}</a></td></tr>
                         @endif
                    @endif
                @endif
            @else
                @if($post_id == $post2->id)
                    <tr><td style="font-size:1.5em"><strong><span class="glyphicon glyphicon-arrow-right accent"></span></strong></td><td><a href="{{ route('lesson.show', $post2->id) }}" class="lessonstudied"><strong>{{ $post2->title }}</strong></a></td></tr>
                @else
                    <tr><td style="font-size:1.5em"><span class="glyphicon glyphicon-ok gray"></span></td><td><a href="{{ route('lesson.show', $post2->id) }}" class="lessonstudied">{{ $post2->title }}</a></td></tr>
                @endif
            @endif
          <?php $i++;?>
        @endif
   @endforeach
	</tbody></table>
</div><!-- .panel-body -->
</div><!-- .panel -->

@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
	@include('layouts.followme')

	@if (Auth::check())
	<div class="panel panel-default font08">
		<div class="panel-heading">お知らせ</div>
		<div class="panel-body">
			<ul>
			@forelse ($news as $new)
				<?php $date = date_format($new->created_at , 'Y.m.d');?>
				<li><span class="text-muted"><?php echo $date;?></span><br><a href="{{ action('NewsController@newsshow', $new->id) }}">{{ $new->title }} <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></li>
			@empty
				<li>お知らせはありません。</li>
			@endforelse

			</ul>
		</div><!--panel-body -->
	 </div><!-- panel -->
	@endif
@endif


@include('layouts.sidebarbaner')

</div><!--END　サイドバー############################################################ -->
</div><!--END　row-->
</div><!-- .container-fluid -->
</div><!--END container -->

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
			  <li><a href="/lesson/category/{{ $post->categories->id }}">{{ $post->categories->category }}</a></li>
			  <li class="active">{{ $post->title }}</li>
			</ol>

			</div>

			@if (!strstr(Request::url(), '/lesson/category/'))
				<!--<div id="snsbox-footer" class="pull-right"></div>-->
			@endif
		</div>
	</div>
@endif

@if (Auth::check())
    {{-- ログインしている時 グラフ生成--}}
		<script src="/js/Chart.js"></script>
@endif

@endsection

@section('script')

	// ポップオーバー
	$(function () {
      $('[data-toggle="popover"]').popover()
    })


    // Comment削除
    function deleteComment(e) {
      'use strict';

      if (confirm('are you sure?')) {
        document.getElementById('form_' + e.dataset.id).submit();
      }
    }


    @if (Auth::check())
        var studies = <?php echo $studies;?>;
        var migakusyu2 = <?php echo $migakusyu2;?>;

        chartmake(studies,migakusyu2);
        function chartmake(studies,migakusyu2){

            var doughnutData = [
            　　{
            　　　value: studies,
            　　　color:"#ff8c7c",
                  label:"学習済み"        // 凡例のラベル
                },
            　　{
            　　　value: migakusyu2,
            　　　color: "#f5f5f5",
                  label:"未学習"        // 凡例のラベル
            　　},


            ];
            var ctx = document.getElementById("chart").getContext("2d");


            ctx.canvas.width = 150;
            ctx.canvas.height = 150;
            new Chart(ctx).Doughnut(doughnutData,{
                segmentShowStroke : false,
                segmentStrokeColor : "#fff",
                segmentStrokeWidth : 1,
                percentageInnerCutout : 70, // **** Border width
                animation : true,
                animationSteps : 100,
                animationEasing : "easeOutQuint",
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
        }


        chartmake2(studies,migakusyu2);
        function chartmake2(studies,migakusyu2){

            var doughnutData = [
            　　{
            　　　value: studies,
            　　　color:"#ff8c7c",
                  label:"学習済み"        // 凡例のラベル
                },
            　　{
            　　　value: migakusyu2,
            　　　color: "#f5f5f5",
                  label:"未学習"        // 凡例のラベル
            　　},


            ];
            var ctx = document.getElementById("chart2").getContext("2d");


            ctx.canvas.width = 150;
            ctx.canvas.height = 150;
            new Chart(ctx).Doughnut(doughnutData,{
                segmentShowStroke : false,
                segmentStrokeColor : "#fff",
                segmentStrokeWidth : 1,
                percentageInnerCutout : 70, // **** Border width
                animation : true,
                animationSteps : 100,
                animationEasing : "easeOutQuint",
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
        }

        //ステータスボタン
        $(function(){
            var user_id = <?php echo $user_id;?>;
            var post_id = <?php echo $post_id;?>;
            var status = <?php echo $status;?>;
            var category_id = <?php echo $category_id;?>;
            $("#status-btn").click(function(){

            	//グラフ表示
                var winWidth = $(window).width();
                var limitWidth = 767;//モバイル時のみ起動する
                if (winWidth <= limitWidth) {
                    $("#collapseChart").slideDown("slow");
                    $("#collapseChart2").slideUp("slow");
                }


                $.ajax({
                    type: 'POST',
                    url: '/lesson/<?php echo $post_id;?>',
                    //dataType: 'JSON',
                    data: {
                        // _token: $('meta[name="csrf-token"]').attr('content'),
                        user_id : user_id,
                        post_id : post_id,
                        status : status,
                        category_id: category_id
                    },
                    //成功後の挙動
                    success: function(data) {
                    	//ボタンを変更する
                        if($('#status-btn').hasClass('btn-complete')) {
                            $("#status-btn").addClass('btn-info').removeClass('btn-default btn-complete').html('<span class="glyphicon glyphicon-save font20"></span><br>学習完了にする')
                        }else{
                            $("#status-btn").addClass('btn-default btn-complete').removeClass('btn-info').html('<span class="glyphicon glyphicon-ok font20"></span><br>学習済み')
                        }
                        //完了率を変更
                        $('em').html(Math.round(data.studies/(data.studies+data.migakusyu)*100)+'<span class="caption">%</span>');
                        //グラフを変更
                        chartmake(data.studies,data.migakusyu);
                        chartmake2(data.studies,data.migakusyu);
                        //完了レッスン数を変更
                        $('span.completelesson').text(data.studies);
                        //完了率を変更
                        $('span.completeper').text(Math.round(data.studies/(data.studies+data.migakusyu)*100));

                        if(data.status == 0){
                            status = 1;
                        }else{
                            status = 0;
                        }

                        console.log('studies：'+<?php echo $studies;?>+' → '+data.studies);
                        console.log('migakusyu：'+<?php echo $migakusyu2;?>+' → '+data.migakusyu);

                    },
                    error: function(){
                        console.log('更新失敗 !!!');
                        $('div.subpage').prepend('<div class="space20"></div><div class="alert alert-danger flash_message" onclick="this.classList.add("hidden")">更新失敗 !!!</div>');
                    }


                });
            });
        });
    @endif


    @if (Auth::check())
	//アクセスログ、滞在時間を取得////////////////////////////////////////////////////
    <?php
	//URLを取得
	$url = $_SERVER["REQUEST_URI"];

	//現在時刻を取得
	$now = date('Y-m-d H:i:s');
	?>

    	<?php $user_id = Auth::user()->id;?>


	$.ajaxSetup({
	   headers: {
	   'X-CSRF-Token' : $('meta[name=_token]').attr('content')
	   }
	});
    $(function() {
        //アクセスした時間を変数に格納
        var starttime = new Date;

        //モバイル判定
        var agent = navigator.userAgent;
        if(agent.search(/iPhone/) != -1 || agent.search(/iPad/) != -1 || agent.search(/iPod/) != -1 || agent.search(/Android/) != -1){
            console.log('モバイルです。');
            //画面遷移、画面を閉じたときに起動する
            window.addEventListener("pagehide", function(){
                //DB登録
                var now = '<?php echo $now; ?>';
                var user_id = '<?php echo $user_id;?>';
                var times = (new Date - starttime);
                var url = '<?php echo $url;?>';

                $.ajax({
                    type: 'POST',
                    async: false,       // ←非同期フラグにfalseをセット。画面遷移が完了してもデータを書き込むため
                    url: '/lesson/access',
                    //dataType: 'JSON',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        user_id : user_id,
                        now : now,
                        times : times,
                        url : url
                    },
                    //成功後の挙動
                    success: function(data) {
                        success: console.log('AccessLog added')
                    },
                    error: function(){
                        console.log('AccessLog failed');
                    }
                });
            });
        }else{
            console.log('パソコンです。');
            //画面遷移、画面を閉じたときに起動する
            $(window).on('beforeunload', function() {

                //DB登録
                var now = '<?php echo $now; ?>';
                var user_id = '<?php echo $user_id;?>';
                var times = (new Date - starttime);
                var url = '<?php echo $url;?>';

                $.ajax({
                    type: 'POST',
                    async: false,       // ←非同期フラグにfalseをセット。画面遷移が完了してもデータを書き込むため
                    url: '/lesson/access',
                    //dataType: 'JSON',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        user_id : user_id,
                        now : now,
                        times : times,
                        url : url
                    },
                    //成功後の挙動
                    success: function(data) {
                        success: console.log('AccessLog added')
                        //$('div.subpage').prepend('<div class="space20"></div><div class="alert alert-success flash_message" onclick="this.classList.add("hidden")">成功 !!!</div>');
                    },
                    error: function(){
                        console.log('更新失敗 !!!');
                        //$('div.subpage').prepend('<div class="space20"></div><div class="alert alert-danger flash_message" onclick="this.classList.add("hidden")">失敗 !!!</div>');
                    }
                });
            });
        }

    });
    @endif

@stop
