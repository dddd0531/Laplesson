<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="/css/style.css">
	<!-- Bootstrap -->
	 <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	 <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	 <!--[if lt IE 9]>
	 <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	 <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	 <![endif]-->

</head>
<body>

<div class="container block">

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">ラプレッスン管理ページ</div>
            <div class="panel-body">
              @if (count($errors) > 0)
                <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
     
              <form class="form-horizontal" role="form" method="POST" action="/admin/login">
                {{-- CSRF対策--}}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
     
                <div class="form-group">
                  <label class="col-md-4 control-label">E-Mail Address</label>
                  <div class="col-md-6">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                  </div>
                </div>
     
                <div class="form-group">
                  <label class="col-md-4 control-label">Password</label>
                  <div class="col-md-6">
                    <input type="password" class="form-control" name="password">
                  </div>
                </div>
     
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="remember"> Remember Me
                      </label>
                    </div>
                  </div>
                </div>
     
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                      Login
                    </button>
     
                    <a href="/password/email">Forgot Your Password?</a>
                  </div>
                </div>
              </form>
            </div><!-- .panel-body -->
          </div><!-- .panel -->
        </div><!-- .col -->
      </div><!-- .row -->
    </div><!-- .container-fluid -->
	</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 <!-- Include all compiled plugins (below), or include individual files as needed -->
 <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</body>
</html>