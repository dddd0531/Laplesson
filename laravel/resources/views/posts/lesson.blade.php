@extends('layouts.default')


@section('title')レッスン一覧 | <?php echo Config::get('app.sitename');?>@endsection
@section('description')レッスン一覧。ポジショニング、ミラーテクニック、基本検査の基礎～実践編、スケーリングの基礎～実践編、PMTC、精密検査まで幅広い歯科衛生士のスキルを学べます。@endsection
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




<div class="container subpage lessonpage <?php echo $appclass;?>">
<div>

<!--メイン ############################################################-->    
<div>  
	@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
       <div>
            <ol class="breadcrumb">
              <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
              @if(Auth::check())
              <li><a href="/mypage">マイページ</a></li>
              @endif
              <li class="active">レッスン一覧</li>
            </ol>
        </div>
	@endif
	
	@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
       <h1 class="subpage-h1">レッスン一覧</h1>
    @else
		<img src="/image/logo5.gif" class="img-responsive img-responsive-overwrite" alt="ラプレッスン" width="100px">
		<div class="space30"></div>
	@endif
	<p class="text-center lead"><strong class="accent">{{ count($categories) }}</strong>レッスン <strong class="accent">{{ count($posts) }}</strong>動画

</p>
	<div class="space20"></div>
	<div class="row">
    	@if(Auth::check())
    	<?php $i = 0;?>
        @endif
        @foreach ($catecount as $category)
                    <!--<div class="col-sm-6">-->
                    <div class="col-xs-4 col-sm-6">	
                        <div class="panel panel-default lessonbox">
                            <div class="panel-body">
                                <div class="lessonheader row">
                                	<div class="col-sm-3">
                                        <a class="alink" href="/lesson/category/{{ $category->category_id }}"><img class="lessonicon lessonicon{{ $category->category_id }}" src="/image/lesson{{ $category->category_id }}.png" alt="{{ $category->category }}"></a>
										<span class="badge">全<strong>{{ $category->count }}</strong>回</span>
                                    </div>
                                    <div class="col-sm-9">		
                                        <h3><a href="/lesson/category/{{ $category->category_id }}">{{ $category->category }}</a></h3>
                                        @if(Auth::check() && $appflag == 0)
											<?php $num = round($studies[$i]/$postcount[$i]*100); ?>
                                            	<div class="progress pconly">
                                                  <div class="progress-bar lessonicon{{ $category->category_id }}" role="progressbar" aria-valuenow="<?php echo $num;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $num;?>%;"></div>
                                                 </div>
										@endif
                                          <p class="pconly"><a href="/lesson/category/{{ $category->category_id }}">{{ $category->description }}</a></p>
                                    </div>                                
                                </div>
                                <!--
                                <table class="table font08"><tbody>
                                    @forelse ($posts as $post)
                                        @if($post->category_id == $category->category_id)
                                            <tr>
                                            <td><i class="fa fa-youtube-play"></i>　{{ $post->title }}<td>
    
                                            </tr>
                                        @endif
                                    @empty 
                                        <tr><td>レッスンはありません</li>
                                    @endforelse
                                </tbody></table>
                                -->
                                @if(Auth::check())
                                	<a href="/lesson/category/{{ $category->category_id }}" class="btn btn-default pull-right pconly2">動画一覧 <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                @else
                                	<a href="/lesson/category/{{ $category->category_id }}" class="btn btn-info pull-right pconly2">動画一覧 <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                @endif    
                                    
                            </div><!--panel-body-->
                         </div><!--panel-->
                     </div>
                     @if(Auth::check())
                     	<?php $i++;?>
                     @endif
        @endforeach
    </div><!--row-->
</div><!--メイン ############################################################-->    
    
<!--サイドバー ############################################################-->
<div class="col-sm-4" id="sidebar">
</div><!--END　サイドバー############################################################ -->        
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
              <li class="active">レッスン一覧</li>
            </ol>        
        
        </div>
		
        @if (!strstr(Request::url(), '/lesson/category/'))
	        <div id="snsbox-footer" class="pull-right"></div>
        @endif
    </div>
</div>
@endif


@endsection