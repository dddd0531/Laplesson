@extends('layouts.admin')


@section('title')
Help Edit
@endsection

@section('content')
<h1>
<a href="{{ url('/admin/help') }}" class="pull-right fs12">back</a>
Help Edit</h1>

<form method="post" action="{{ url('/admin/help', $helps->id) }}">
 {{ csrf_field() }}
 {{ method_field('patch') }}
 <p>
  <input class="form-control" type="text" name="question" placeholder="question" value="{{ old('question', $helps->question) }}">
  @if ($errors->has('question'))
  <span class="error">{{ $errors->first('question') }}</span>
  @endif
 </p>
 <p>
  <textarea class="form-control" name="answer" placeholder="answer">{{ old('answer',$helps->answer) }}</textarea>
  @if ($errors->has('answer'))
  <span class="error">{{ $errors->first('answer') }}</span>
  @endif </p>
<p>
<select class="form-control" name="open" class="form-control">
      @if( $helps->open == 0))
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
 <select class="form-control" name="category" class="form-control">
        <option value="0" <?php if($helps->category == 0){echo 'selected';}?>>ユーザー登録について</option>
        <option value="1" <?php if($helps->category == 1){echo 'selected';}?>>ログインできない場合について</option>
        <option value="2" <?php if($helps->category == 2){echo 'selected';}?>>退会について</option>
</select>
  @if ($errors->has('category'))
  <span class="error">{{ $errors->first('category') }}</span>
  @endif
 </p>
 <p>
  <input class="btn btn-primary" type="submit" value="Update">
 </p>
</form>

@endsection