@extends('layouts.admin')


@section('title')
Edit New
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Edit New<a href="{{ url('/admin/status') }}" class="pull-right fs12">back</a></div>
        <div class="panel-body">



		<form class="form-horizontal" method="post" action="{{ url('/admin/status', $status->id) }}">
		 {{ csrf_field() }}
		 {{ method_field('patch') }}

	            <div class="form-group">
	              <label class="col-md-4 control-label">Category Name</label>
	              <div class="col-md-6">
			  <input class="form-control" type="text" name="status" placeholder="status name" value="{{ old('status', $status->status) }}">
			  @if ($errors->has('status'))
			  <span class="error">{{ $errors->first('status') }}</span>
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