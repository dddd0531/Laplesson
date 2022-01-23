@extends('layouts.admin')
@section('title')
News Edit
@endsection

@section('content')
<h1>
<a href="{{ url('/admin/news') }}" class="pull-right fs12">back</a>
News Edit</h1>

<form method="post" action="{{ url('/admin/news', $news->id) }}" enctype="multipart/form-data">
 {{ csrf_field() }}
 {{ method_field('patch') }}
 <p>
  <input class="form-control" type="text" name="title" placeholder="title" value="{{ old('title', $news->title) }}">
  @if ($errors->has('title'))
  <span class="error">{{ $errors->first('title') }}</span>
  @endif
 </p>
 <p>
  <textarea class="form-control" name="body" placeholder="body">{{ old('body',$news->body) }}</textarea>
  @if ($errors->has('body'))
  <span class="error">{{ $errors->first('body') }}</span>
  @endif </p>

<p>
  <input class="form-control" type="text" name="newsurl" placeholder="/lesson/xxxx  ※トップドメイン不要" value="{{ old('newsurl', $news->newsurl) }}">
  @if ($errors->has('newsurl'))
  <span class="error">{{ $errors->first('newsurl') }}</span>
  @endif
 </p>

   <p>
    <input class="form-control" type="file" name="newsimg1"  value="">
    <?php foreach (glob("image/newsimg".$news->id."_1.*") as $filename) {?>
        <span class="font08">/<?php echo $filename;?></span><br />
        <img width="300px" src="/<?php echo $filename;?>" alt=""><br />
    <?php }?>
    @if ($errors->has('newsimg1')) <span class="error">{{ $errors->first('newsimg1') }}</span> @endif
   </p>
   <div class="space20"></div>

   <p>
    <input class="form-control" type="file" name="newsimg2"  value="">
    <?php foreach (glob("image/newsimg".$news->id."_2.*") as $filename) {?>
        <span class="font08">/<?php echo $filename;?></span><br />
        <img width="300px" src="/<?php echo $filename;?>" alt=""><br />
    <?php }?>
    @if ($errors->has('newsimg2')) <span class="error">{{ $errors->first('newsimg2') }}</span> @endif
   </p>
   <div class="space20"></div>

   <p>
    <input class="form-control" type="file" name="newsimg3"  value="">
    <?php foreach (glob("image/newsimg".$news->id."_3.*") as $filename) {?>
        <span class="font08">/<?php echo $filename;?></span><br />
        <img width="300px" src="/<?php echo $filename;?>" alt=""><br />
    <?php }?>
    @if ($errors->has('newsimg3')) <span class="error">{{ $errors->first('newsimg3') }}</span> @endif
   </p>
   <div class="space20"></div>

   <p>
    <input class="form-control" type="file" name="newsimg4"  value="">
    <?php foreach (glob("image/newsimg".$news->id."_4.*") as $filename) {?>
        <span class="font08">/<?php echo $filename;?></span><br />
        <img width="300px" src="/<?php echo $filename;?>" alt=""><br />
    <?php }?>
    @if ($errors->has('newsimg4')) <span class="error">{{ $errors->first('newsimg4') }}</span> @endif
   </p>
   <div class="space20"></div>

   <p>
    <input class="form-control" type="file" name="newsimg5"  value="">
    <?php foreach (glob("image/newsimg".$news->id."_5.*") as $filename) {?>
        <span class="font08">/<?php echo $filename;?></span><br />
        <img width="300px" src="/<?php echo $filename;?>" alt=""><br />
    <?php }?>
    @if ($errors->has('newsimg5')) <span class="error">{{ $errors->first('newsimg5') }}</span> @endif
   </p>
   <div class="space20"></div>


   <p>
  <textarea class="form-control" name="code" placeholder="code">{{ old('code',$news->code) }}</textarea>
  @if ($errors->has('code'))
  <span class="error">{{ $errors->first('code') }}</span>
  @endif </p>

   <p>
  <textarea class="form-control" name="description" placeholder="description">{{ old('description',$news->description) }}</textarea>
  @if ($errors->has('description'))
  <span class="error">{{ $errors->first('description') }}</span>
  @endif </p>

<p>
<select class="form-control" name="form" class="form-control">
      @if( $news->form == 0))
        <option value="0" selected>フォーム無し</option>
        <option value="1">フォーム有り</option>
      @else
        <option value="0">フォーム無し</option>
        <option value="1" selected>フォーム有り</option>
      @endif
</select>
  @if ($errors->has('form'))
  <span class="error">{{ $errors->first('form') }}</span>
  @endif
 </p>

 <p>
  <input class="form-control" type="text" name="created_at" value="{{ old('created_at', $news->created_at) }}">
  @if ($errors->has('created_at'))
  <span class="error">{{ $errors->first('created_at') }}</span>
  @endif
 </p>

<p>
<select class="form-control" name="open" class="form-control">
      @if( $news->open == 0))
        <option value="0" selected>下書き</option>
        <option value="1">公開</option>
      @else
        <option value="0">下書き</option>
        <option value="1" selected>公開</option>
      @endif
</select>
  @if ($errors->has('open'))
  <span class="error">{{ $errors->first('open') }}</span>
  @endif
 </p>



 <p>
 <select class="form-control" name="pickup" class="form-control">
      @if( $news->pickup == 0))
        <option value="0" selected>通常</option>
        <option value="1">ピックアップ</option>
      @else
        <option value="0">通常</option>
        <option value="1" selected>ピックアップ</option>
      @endif
</select>
  @if ($errors->has('pickup'))
  <span class="error">{{ $errors->first('pickup') }}</span>
  @endif
 </p>
 <p>
  <input class="btn btn-primary" type="submit" value="Update">
 </p>
</form>

@endsection
