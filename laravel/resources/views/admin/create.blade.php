@extends('layouts.admin')


@section('title')
Add New
@endsection

@section('content')
<h1>
<a href="{{ url('/admin/lesson') }}" class="pull-right fs12">back</a>
Add New</h1>

<form method="post" action="{{ url('/admin/lesson') }}" enctype="multipart/form-data">
 {{ csrf_field() }}
 <p>
<select name="released" class="form-control">
        <option value="0">未公開</option>
        <option value="1">公開する</option>
</select>
</p>
<p>
<select name="usersonly" class="form-control">
        <option value="2">準備中</option>
        <option value="1">会員専用</option>
        <option value="0">公開用</option>
</select>
</p>
 <p>
  <input class="form-control" type="file" name="lessonimage" placeholder="lessonimage" value="{{ old('lessonimage') }}">
  <span class="error">{{ $errors->first('lessonimage') }}</span>
 </p>
 <p>
  <input type="text" class="form-control" name="title" placeholder="title" value="{{ old('title') }}">
  @if ($errors->has('title'))
  <span class="error">{{ $errors->first('title') }}</span>
  @endif
 </p>
 <p>
  <textarea name="body" class="form-control" rows="5" placeholder="body">{{ old('body') }}</textarea>
  @if ($errors->has('body'))
  <span class="error">{{ $errors->first('body') }}</span>
  @endif 
 </p>
 <p>
  <input type="text" class="form-control" name="movie" placeholder="動画のURL" value="{{ old('movie') }}">
  @if ($errors->has('movie'))
  <span class="error">{{ $errors->first('movie') }}</span>
  @endif
 </p>
  <p>
  <input type="text" class="form-control" name="playtime" placeholder="再生時間" value="{{ old('playtime') }}">
  @if ($errors->has('playtime'))
  <span class="error">{{ $errors->first('playtime') }}</span>
  @endif
 </p>
  <p>
 <select name="category_id" class="form-control">
  <option>選択してください</option>
@foreach ($categories as $category)
  	<option value="{{ $category->id}}">{{ $category->category}}</option>
@endforeach
</select>
@if ($errors->has('category_id'))
    <span class="help-block">
         {{ $errors->first('category_id') }}
    </span>
@endif
 </p>
 <p>
<select name="imageflag" class="form-control">
        <option value="0">画像なし</option>
        <option value="1">画像あり</option>
</select>
</p>
 <p>
<select name="squareflag" class="form-control">
        <option value="1">動画：正方形</option>
        <option value="0">動画：長方形（従来）</option>
</select>
</p>
 <p>
  <textarea name="hosoku" class="form-control" rows="10" placeholder="ポイントまとめ">{{ old('hosoku') }}</textarea>
</p>
 <p>
  <input type="text" class="form-control" name="hosokutitle1" placeholder="注意点１のタイトル" size="100" value="{{ old('hosokutitle1') }}"><br>
  <textarea name="hosoku1" class="form-control" rows="3" placeholder="注意点１の内容">{{ old('hosoku1') }}</textarea>
</p>

 <p>
  <input type="text" class="form-control" name="hosokutitle2" placeholder="注意点２のタイトル" size="100" value="{{ old('hosokutitle2') }}"><br>
  <textarea name="hosoku2" class="form-control" rows="3" placeholder="注意点２の内容">{{ old('hosoku2') }}</textarea>
</p>
 <p>
  <input type="text" class="form-control" name="hosokutitle3" placeholder="注意点３のタイトル" size="100" value="{{ old('hosokutitle3') }}"><br>
  <textarea name="hosoku3" class="form-control" rows="3" placeholder="注意点３の内容">{{ old('hosoku3') }}</textarea>
</p>
 <p>
  <input type="text" class="form-control" name="hosokutitle4" placeholder="注意点４のタイトル" size="100" value="{{ old('hosokutitle4') }}"><br>
  <textarea name="hosoku4" class="form-control" rows="3" placeholder="注意点４の内容">{{ old('hosoku4') }}</textarea>
</p>

<p>
  <input type="text" class="form-control" name="refer1" placeholder="関連動画のID１　半角数字" value="{{ old('refer1') }}">
</p>
<p>
  <input type="text" class="form-control" name="refer2" placeholder="関連動画のID２　半角数字" value="{{ old('refer2') }}">
</p>
<p>
  <input type="text" class="form-control" name="refer3" placeholder="関連動画のID３　半角数字" value="{{ old('refer3') }}">
</p>
<p>
  <input type="text" class="form-control" name="refer4" placeholder="関連動画のID４　半角数字" value="{{ old('refer4') }}">
</p>


  <p>
  <textarea name="contents" class="form-control" placeholder="contents">{{ old('contents') }}</textarea>
  @if ($errors->has('contents'))
  <span class="error">{{ $errors->first('contents') }}</span>
  @endif 
 </p>
        
  <input type="submit" value="Add New">
 </p>
</form>

@endsection