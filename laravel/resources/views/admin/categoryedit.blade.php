@extends('layouts.admin')


@section('title')
Edit New
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Edit New<a href="{{ url('/admin/category') }}" class="pull-right fs12">back</a></div>
        <div class="panel-body">



		<form class="form-horizontal" method="post" action="{{ url('/admin/category', $category->id) }}">
		 {{ csrf_field() }}
		 {{ method_field('patch') }}
         
	            <div class="form-group">
	              <label class="col-md-4 control-label">公開</label>
	              <div class="col-md-6">
                    <select name="released" class="form-control">
                            <option value="1" <?php if($category->released == "1"){echo "selected";}?>>公開済み</option>
                            <option value="0" <?php if($category->released == "0"){echo "selected";}?>>未公開</option>
                    </select>
	              </div>
	            </div>
         
	            <div class="form-group">
	              <label class="col-md-4 control-label">順番</label>
	              <div class="col-md-6">
                      <input class="form-control" type="number" name="number" value="{{ old('number', $category->number) }}">
                      @if ($errors->has('number'))
                      <span class="error">{{ $errors->first('number') }}</span>
                      @endif
	              </div>
	            </div>
                
	            <div class="form-group">
	              <label class="col-md-4 control-label">レッスンカテゴリー</label>
	              <div class="col-md-6">
                      <input class="form-control" type="text" name="category" placeholder="category name" value="{{ old('category', $category->category) }}">
                      @if ($errors->has('category'))
                      <span class="error">{{ $errors->first('category') }}</span>
                      @endif
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="col-md-4 control-label">説明</label>
	              <div class="col-md-6">
                  	  <textarea class="form-control" name="description" placeholder="description">{{ old('description', $category->description) }}</textarea>
                      @if ($errors->has('description'))
                      <span class="error">{{ $errors->first('description') }}</span>
                      @endif
	              </div>
	            </div>                
                                
                
	            <div class="form-group">
	              <div class="col-md-6 col-md-offset-4">
				  <input class="btn btn-primary" type="submit" value="Update">
	              </div>
	            </div>

		</form>
        </div><!-- .panel-body -->
      </div><!-- .panel -->
    </div><!-- .col -->
  </div><!-- .row -->
</div><!-- .container-fluid -->
@endsection