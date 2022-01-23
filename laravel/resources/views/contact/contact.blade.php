@extends('layouts.default')


@section('title')お問い合わせ | <?php echo Config::get('app.sitename');?>@endsection
@section('description'){{ Config::get('app.description')}}@endsection

@section('content')


        <div class="container subpage">
               <h1 class="subpage-h1">{{$data}}</h1>
         </div><!--container-->
        <div class="subpage block bg-gray bordertop">
         <div class="container">

			<div class="row">
            	<div class="col-sm-8 col-sm-offset-2">
                	<p class="">
                    	{{$text}}
                    </p>
                   <div class="space30"></div>
                   <div class="panel panel-default">
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
                            <form method="post" action="{{ url('/contact') }}"> 
                            {{-- CSRF対策--}}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @if(Auth::check())
                                <input type="hidden" class="form-control" name="name2" value="{{ Auth::user()->name }}">
                            @else
                            <div class="form-group">
                                <label class="control-label" for="name2">お名前</label>
                                <input type="text" class="form-control" name="name2" value="{{ old('name2') }}">
                            </div>
                            @endif
                            @if(Auth::check())
                                <input type="hidden" class="form-control" name="email" value="{{ Auth::user()->email }}">
                            @else
                            <div class="form-group">
                                <label class="control-label" for="email">メールアドレス</label>
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="control-label" for="content">内容</label>
                                <textarea type="text" class="form-control" name="content" rows="10">{{ old('content') }}</textarea>
                            </div>
                            <div class="form-group">
                            	<div class="space20"></div>
                                <button type="submit" class="btn btn-primary btn-lg">確認</button>
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
              <li class="active">お問い合わせ</li>
            </ol>

        </div>
        
        @if (!strstr(Request::url(), '/lesson/category/'))
	        <div id="snsbox-footer" class="pull-right"></div>
        @endif
    </div>
</div>


@endsection