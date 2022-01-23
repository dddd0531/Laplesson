@extends('layouts.admin')


@section('title')
Posts Category
@endsection

@section('content')
              <h1>
<a href="{{ url('/admin/category/create') }}" class="pull-right btn btn-warning">Add New</a>
Category</h1>

		<table class="table table-striped"><tbody>
			@forelse ($categories as $category)
			 <tr>
				<th>{{ $category->number }}</th>
				<td>{{ $category->id }}</td>
				<td>@if( $category->released == "1")
                		<span class="accent">公開済</span>
                    @else
                    	未公開
                    @endif
                </td>
			   	<td>{{ $category->category }}</td>
			   	<td>{{ $category->description }}</td>
			    <td><a href="{{ action('CategoriesController@edit', $category->id) }}" class="btn btn-primary btn-xs">Edit</a></td> 
			 	<td>
					<form action="{{ action('CategoriesController@destroy', $category->id) }}" id="form_{{ $category->id }}" method="post" style="display:inline">
					    {{ csrf_field() }}
					    {{ method_field('delete') }}
					      <a href="#" data-id="{{ $category->id }}" onclick="deleteCategory(this);">[delete]</a>
				    </form>
				</td>
			  </tr>
			@empty
			<li>No Post Category</li>
			@endforelse
		</tbody></table>

<script>
{{-- Post削除 --}}
function deleteCategory(e) {
  'use strict';

  if (confirm('are you sure?')) {
    document.getElementById('form_' + e.dataset.id).submit();
  }
}
</script>

@endsection