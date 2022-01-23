@extends('layouts.admin')


@section('title')
Edit New
@endsection

@section('content')
<h1>
<a href="{{ url('/admin/lesson') }}" class="pull-right fs12">back</a>
Edit New</h1>

<form method="post" action="{{ url('/admin/lesson', $post->id) }}" enctype="multipart/form-data">
 {{ csrf_field() }}
 {{ method_field('patch') }}
<p>
<select name="released" class="form-control">
        <option value="1" <?php if($post->released == "1"){echo "selected";}?>>公開済み</option>
        <option value="0" <?php if($post->released == "0"){echo "selected";}?>>未公開</option>
</select>
</p>
<p>
<select name="usersonly" class="form-control">
        <option value="2" <?php if($post->usersonly == "2"){echo "selected";}?>>準備中</option>
        <option value="1" <?php if($post->usersonly == "1"){echo "selected";}?>>会員専用</option>
        <option value="0" <?php if($post->usersonly == "0"){echo "selected";}?>>公開用</option>
</select>
</p>
 <p>
  <?php $lessonimage = '/image/lessonshow'.$post->id.'.png';?>
  <input class="form-control" type="file" name="lessonimage" placeholder="lessonimage" value="{{ old('lessonimage',$lessonimage) }}">
  <div class="space10"></div>
  <span class="font08">現在の画像　</span>
	 <img width="300px" src="/image/lessonshow{{$post->id}}.png" alt="">
  @if ($errors->has('lessonimage')) <span class="error">{{ $errors->first('lessonimage') }}</span> @endif
  <span class="error">{{ $errors->first('lessonimage') }}</span>
 </p>
  <div class="space20"></div>

 <p>
  <input type="text" class="form-control" name="title" placeholder="title" size="100" value="{{ old('title', $post->title) }}">
  @if ($errors->has('title'))
  <span class="error">{{ $errors->first('title') }}</span>
  @endif
 </p>
 <p>
  <textarea name="body" class="form-control" rows="5" placeholder="body">{{ old('body',$post->body) }}</textarea>
  @if ($errors->has('body'))
  <span class="error">{{ $errors->first('body') }}</span>
  @endif </p>
 <p>
 
  <input type="text" class="form-control" name="movie" placeholder="vimeoの番号" value="{{ old('movie', $post->movie) }}">
  @if ($errors->has('movie'))
  <span class="error">{{ $errors->first('movie') }}</span>
  @endif
 </p>
  <p>
  <input type="text" class="form-control" name="playtime" placeholder="再生時間" value="{{ old('playtime', $post->playtime) }}">
  @if ($errors->has('playtime'))
  <span class="error">{{ $errors->first('playtime') }}</span>
  @endif
 </p>
 <p>
<select name="category_id" class="form-control">
  <option>選択してください</option>
    @foreach ($categories as $category)
      @if( isset($post->categories->category) && $category->category == $post->categories->category))
        <option value="{{ $category->id}}" selected>{{ $category->category}}</option>
      @else
        <option value="{{ $category->id}}">{{ $category->category}}</option>
      @endif
    @endforeach    
</select>
</p>
<p>
<select name="imageflag" class="form-control">
        <option value="1" <?php if($post->imageflag == "1"){echo "selected";}?>>画像あり</option>
        <option value="0" <?php if($post->imageflag == "0"){echo "selected";}?>>画像なし</option>
</select>
</p>
 <p>
<select name="squareflag" class="form-control">
        <option value="1" <?php if($post->squareflag == "1"){echo "selected";}?>>動画：正方形</option>
        <option value="0" <?php if($post->squareflag == "0" || $post->squareflag == NULL){echo "selected";}?>>動画：長方形（従来）</option>
</select>
</p>
 <p>
  <textarea name="hosoku" class="form-control" rows="10" placeholder="ポイントまとめ">{{ old('hosoku',$post->hosoku) }}</textarea>
</p>
 <p>
  <input type="text" class="form-control" name="hosokutitle1" placeholder="注意点１のタイトル" size="100" value="{{ old('hosokutitle1', $post->hosokutitle1) }}"><br>
  <textarea name="hosoku1" class="form-control" rows="3" placeholder="注意点１の内容">{{ old('hosoku1',$post->hosoku1) }}</textarea>
</p>

 <p>
  <input type="text" class="form-control" name="hosokutitle2" placeholder="注意点２のタイトル" size="100" value="{{ old('hosokutitle2', $post->hosokutitle2) }}"><br>
  <textarea name="hosoku2" class="form-control" rows="3" placeholder="注意点２の内容">{{ old('hosoku2',$post->hosoku2) }}</textarea>
</p>
 <p>
  <input type="text" class="form-control" name="hosokutitle3" placeholder="注意点３のタイトル" size="100" value="{{ old('hosokutitle3', $post->hosokutitle3) }}"><br>
  <textarea name="hosoku3" class="form-control" rows="3" placeholder="注意点３の内容">{{ old('hosoku3',$post->hosoku3) }}</textarea>
</p>
 <p>
  <input type="text" class="form-control" name="hosokutitle4" placeholder="注意点４のタイトル" size="100" value="{{ old('hosokutitle4', $post->hosokutitle4) }}"><br>
  <textarea name="hosoku4" class="form-control" rows="3" placeholder="注意点４の内容">{{ old('hosoku4',$post->hosoku4) }}</textarea>
</p>

<p>
  <input type="text" class="form-control" name="refer1" placeholder="関連動画のID１　半角数字" value="{{ old('refer1', $post->refer1) }}">
</p>
<p>
  <input type="text" class="form-control" name="refer2" placeholder="関連動画のID２　半角数字" value="{{ old('refer2', $post->refer2) }}">
</p>
<p>
  <input type="text" class="form-control" name="refer3" placeholder="関連動画のID３　半角数字" value="{{ old('refer3', $post->refer3) }}">
</p>
<p>
  <input type="text" class="form-control" name="refer4" placeholder="関連動画のID４　半角数字" value="{{ old('refer4', $post->refer4) }}">
</p>

  <p>
  <textarea name="contents" class="form-control" placeholder="contents">{{ old('contents', $post->contents) }}</textarea>
  @if ($errors->has('contents'))
  <span class="error">{{ $errors->first('contents') }}</span>
  @endif 
 </p>

  @if ($errors->has('category'))
  <span class="error">{{ $errors->first('category') }}</span>
  @endif
 </p>
 <p>
  <input type="submit" value="Update" class="btn btn-primary">
 </p>
</form>

@endsection