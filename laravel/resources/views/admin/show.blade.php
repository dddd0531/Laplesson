

@extends('layouts.admin')


@section('title')
Blog Detail
@endsection

@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-sm-8"><!--メインコンテンツ -->

<h1>
<a href="{{ url('/admin/lesson') }}" class="pull-right fs12">back</a>
{{ $post->title }}
</h1>
<p>{!! nl2br(e($post->body)) !!}</p>
<p>{{ $post->categories->category }}</p>
<iframe src="https://player.vimeo.com/video/{{ $post->movie }}" width="500" height="375" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<p><a href="https://vimeo.com/{{ $post->movie }}">{{ $post->title }}</a> from <a href="https://vimeo.com/user44542516">dddd0531</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
    
    @if (Auth::guest())
    {{-- ログインしていない時 --}}
    
    @else
    {{-- ログインしている時 --}}
    	<?php
			$user_id = Auth::user()->id;
			$post_id = $post->id;
			$category_id = $post->categories->id;
			echo 'user: '.$user_id.'<br>';
			echo 'post: '.$post_id.'<br>';
			echo 'category: '.$category_id;
			$migakusyu = $migakusyu-$studies;//未学習ステータスの総数			
		?>
<h3>{{$migakusyu}}</h3>

        <form class="form-horizontal" method="post" action="{{ action('StudiesController@store', [$user_id,$post_id]) }}">
             {{ csrf_field() }}
                <input type="hidden" name="category_id" value="{{ $post->categories->id }}">
              @if(isset($study) && $study->status == 1)
                <input type="hidden" name="status" value="0">
                <input class="btn btn-default" type="submit" value="学習済み">
              @else
                <input type="hidden" name="status" value="1">
                <input class="btn btn-primary" type="submit" value="未学習">
              @endif                
        </form>
    @endif    
    
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">Comments</div>
        <div class="panel-body">
	<ul>
		@forelse ($post->comments as $comment)
		<li>
			{{ $comment->body }}
             <form action="{{ action('CommentsController@destroy', [$post->id,$comment->id]) }}" id="form_{{ $comment->id }}" method="post" style="display:inline">
			    {{ csrf_field() }}
			    {{ method_field('delete') }}
			      <a href="#" data-id="{{ $comment->id }}" onclick="deleteComment(this);">×</a>
			 </form>
		</li>
		@empty
		<li>No Comment</li>
		@endforelse
	</ul>

	<form class="form-horizontal" method="post" action="{{ action('CommentsController@store', $post->id) }}">
	 {{ csrf_field() }}

            <div class="form-group">
              <label class="col-md-4 control-label">Add New Comment</label>
              <div class="col-md-6">
		  <input class="form-control" type="text" name="body" placeholder="body" value="{{ old('body') }}">
		  @if ($errors->has('body'))
		  <span class="error">{{ $errors->first('body') }}</span>
		  @endif
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-6">
			  <input class="btn btn-primary" type="submit" value="Add Comment">
              </div>
            </div>
	</form>
        </div><!-- .panel-body -->
      </div><!-- .panel -->
    </div><!-- .col -->
  </div><!-- .row -->
  
</div><!--END　メインコンテンツ -->
<div class="col-sm-4"><!--サイドバー -->

    @if (Auth::guest())
    {{-- ログインしていない時 --}}
    
    @else
    {{-- ログインしている時 --}}    
      <div class="panel panel-default">
        <div class="panel-heading">STATUS</div>
        <div class="panel-body chart">
        	<canvas id="chart" height="200" width="200"></canvas>

                <div class="count">
                    <em>学習済み： <?php echo $studies;?></em>
                    <span class="caption">%</span>
                </div>


        </div><!-- .panel-body -->
      </div><!-- .panel -->
    @endif  
       
       
</div><!--END　サイドバー -->
</div><!--END　row-->
</div><!-- .container-fluid -->

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
        　　　value: <?php echo $studies;?>,
        　　　color:"#aaf2fb",
              label:"学習済み"        // 凡例のラベル
			},
        　　{
        　　　value: <?php echo $migakusyu;?>,
        　　　color: "#fff",
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
	　　　　tooltipTemplate: "<%if (label){%><%=label%><%}%>",
	　　　　onAnimationComplete: function(){
	　　　　　　this.showTooltip(this.segments, true);
	　　　　},
	　　　　tooltipEvents: [],
	　　　　showTooltips: true			
			
        });
		
	
				
        
        </script>
    @endif

@endsection