@extends('layouts.admin')


@section('title')
Add New
@endsection

@section('content')
<h1>
<a href="{{ url('/admin/help') }}" class="pull-right fs12">back</a>
Add New</h1>

<form method="post" action="{{ url('/admin/help') }}">
 {{ csrf_field() }}
 <p>
  <input class="form-control" type="text" name="question" placeholder="question" value="{{ old('question') }}">
  @if ($errors->has('question'))
  <span class="error">{{ $errors->first('question') }}</span>
  @endif
 </p>
 <p>
  <textarea class="form-control" name="answer" placeholder="answer">{{ old('answer') }}</textarea>
  @if ($errors->has('answer'))
  <span class="error">{{ $errors->first('answer') }}</span>
  @endif 
 </p>
  <p>
 <select name="open" class="form-control">
  	<option value="0">下書き</option>
  	<option value="1">公開</option>
</select>
@if ($errors->has('open'))
    <span class="help-block">
         {{ $errors->first('open') }}
    </span>
@endif
 </p>
   <p>
 <select name="category" class="form-control">
  	<option value="0">ユーザー登録について</option>
  	<option value="1">ログインできない場合について</option>
  	<option value="2">退会について</option>
</select>
@if ($errors->has('category'))
    <span class="help-block">
         {{ $errors->first('category') }}
    </span>
@endif
 </p>
        
  <input type="submit" value="Add New">
 </p>
</form>

@endsection