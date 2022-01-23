@extends('layouts.admin')


@section('title')
Add New
@endsection

@section('content')
<h1>
<a href="{{ url('/admin/news') }}" class="pull-right fs12">back</a>
Add New</h1>

<form method="post" action="{{ url('/admin/news') }}" enctype="multipart/form-data">
 {{ csrf_field() }}
 <p>
  <input class="form-control" type="text" name="title" placeholder="title" value="{{ old('title') }}">
  @if ($errors->has('title'))
  <span class="error">{{ $errors->first('title') }}</span>
  @endif
 </p>
 <p>
  <textarea class="form-control" name="body" placeholder="body">{{ old('body') }}</textarea>
  @if ($errors->has('body'))
  <span class="error">{{ $errors->first('body') }}</span>
  @endif
 </p>

 <p>
  <input class="form-control" type="text" name="newsurl" placeholder="/lesson/xxxx  ※トップドメイン不要" value="{{ old('newsurl') }}">
  @if ($errors->has('newsurl'))
  <span class="error">{{ $errors->first('newsurl') }}</span>
  @endif
 </p>

 <p>
  <input class="form-control" type="file" name="newsimg1" value="{{ old('newsimg1') }}">
  <span class="error">{{ $errors->first('newsimg1') }}</span>
 </p>
 <p>
  <input class="form-control" type="file" name="newsimg2" value="{{ old('newsimg2') }}">
  <span class="error">{{ $errors->first('newsimg2') }}</span>
 </p>
 <p>
  <input class="form-control" type="file" name="newsimg3" value="{{ old('newsimg3') }}">
  <span class="error">{{ $errors->first('newsimg3') }}</span>
 </p>
 <p>
  <input class="form-control" type="file" name="newsimg4" value="{{ old('newsimg4') }}">
  <span class="error">{{ $errors->first('newsimg4') }}</span>
 </p>
 <p>
  <input class="form-control" type="file" name="newsimg5" value="{{ old('newsimg5') }}">
  <span class="error">{{ $errors->first('newsimg5') }}</span>
 </p>
  <p>
  <textarea class="form-control" name="code" placeholder="code">{{ old('code') }}</textarea>
  @if ($errors->has('code'))
  <span class="error">{{ $errors->first('code') }}</span>
  @endif
 </p>

  <p>
  <textarea class="form-control" name="description" placeholder="description">{{ old('description') }}</textarea>
  @if ($errors->has('description'))
  <span class="error">{{ $errors->first('description') }}</span>
  @endif
 </p>

  <p>
<select name="form" class="form-control">
  	<option value="0">フォーム無し</option>
  	<option value="1">フォーム有り</option>
</select>
@if ($errors->has('form'))
    <span class="help-block">
         {{ $errors->first('form') }}
    </span>
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
 <select name="pickup" class="form-control">
  	<option value="0">通常</option>
  	<option value="1">ピックアップ</option>
</select>
@if ($errors->has('pickup'))
    <span class="help-block">
         {{ $errors->first('pickup') }}
    </span>
@endif
 </p>

  <input type="submit" value="Add New">
 </p>
</form>

@endsection
