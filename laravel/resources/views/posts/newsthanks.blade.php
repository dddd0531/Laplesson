@extends('layouts.default')


@section('title')お申し込み | <?php echo Config::get('app.sitename');?>@endsection
@section('description'){{ Config::get('app.description')}}@endsection

@section('content')


        <div class="container subpage">
         </div><!--container-->
        <div class="subpage block bg-gray bordertop">
         <div class="container text-center">

            <div class="panel panel-default">

                <div class="panel-body text-center">
                    <p>
                        @if (session('flash_thanks'))
                              <i class="fa fa-info-circle" aria-hidden="true"></i> {{ session('flash_thanks') }}
                        @endif                     
                    </p>
                </div>
            </div>
           @if (Auth::guest())
               <a href="/" class="btn btn-primary">トップへ戻る</a>
           @else
               <a href="/mypage" class="btn btn-primary">マイページに戻る</a>
           @endif 
         </div><!--container-->
        </div> 

<div id="footer-top">
	<div class="container">
        <div class="pull-left">
            <ol class="breadcrumb">
              <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
              <li class="active">お申し込み</li>
            </ol>

        </div>
        
        @if (!strstr(Request::url(), '/lesson/category/'))
	        <div id="snsbox-footer" class="pull-right"></div>
        @endif
    </div>
</div>


@endsection