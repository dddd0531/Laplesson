@extends('layouts.admin')


@section('title')
Status
@endsection

@section('content')
<h1>
<a href="{{ url('/admin/status/create') }}" class="pull-right btn btn-warning">Add New</a>
Status</h1>

		<table class="table table-striped"><tbody>
			@forelse ($statuses as $status)
		  <tr>
				<th>{{ $status->id }}</th>
			    	<td>{{ $status->status }}</td>
			    	<td><a href="{{ action('StatusesController@edit', $status->id) }}" class="btn btn-primary btn-xs">Edit</a></td> 
			 	<td>
					<form action="{{ action('StatusesController@destroy', $status->id) }}" id="form_{{ $status->id }}" method="post" style="display:inline">
					    {{ csrf_field() }}
					    {{ method_field('delete') }}
					      <a href="#" data-id="{{ $status->id }}" onclick="deleteStatus(this);">×</a>
				    </form>
				</td>
			  </tr>
			@empty
			<li>No Status</li>
			@endforelse
		</tbody></table>

<script>
{{-- Status削除 --}}
function deleteStatus(e) {
  'use strict';

  if (confirm('are you sure?')) {
    document.getElementById('form_' + e.dataset.id).submit();
  }
}
</script>

@endsection