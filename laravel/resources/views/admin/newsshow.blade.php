

@extends('layouts.admin')


@section('title')
News Detal
@endsection

@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-sm-8"><!--メインコンテンツ -->

<h1>
<a href="{{ url('/admin/news') }}" class="pull-right fs12">back</a>
{{ $news->title }}
</h1>
<p>{!! nl2br($news->body) !!}</p>


@endsection