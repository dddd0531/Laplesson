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
	@include('layouts.navbaradmin')
	@if (session('flash_message'))
	<div class="flash_message" onclick="this.classList.add('hidden')">{{ session('flash_message') }}</div>
	@endif
	<div class="container">
              @yield('content')
	</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 <!-- Include all compiled plugins (below), or include individual files as needed -->
 <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</body>
</html>