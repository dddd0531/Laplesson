@extends('layouts.admin')


@section('title')
News
@endsection

@section('content')
<h1><a href="{{ url('/admin/news/create') }}" class="pull-right btn btn-warning">Add New</a>
News</h1>

            <table class="table table-striped"><tbody>

			@forelse ($news as $new)
                    <tr>
                    <th>@if($new->open == 0)<span class="label label-default">下書き</span>@else<span class="label label-primary">公開済み</span>@endif</th>
                    <th>@if($new->pickup == 0)<span class="label label-default">通常</span>@else<span class="label label-success">ピックアップ</span>@endif</th>
                    <th>{{ $new->created_at}}</th>
                    <th>{{ $new->id }}</th>
                    <td>{{ $new->title }}</td>
                    <td><a href="{{ action('NewsController@edit', $new->id) }}" class="btn btn-primary btn-xs">Edit</a></td> 
                    <td><form action="{{ action('NewsController@destroy', $new->id) }}" id="form_{{ $new->id }}" method="post" style="display:inline">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                          <a href="#" data-id="{{ $new->id }}" onclick="deletePost(this);">×</a>
                        </form></td>
                    </tr>
			@empty
                <li>No News</li>
			@endforelse
		</tbody></table>



<script>
{{-- Post削除 --}}
function deletePost(e) {
  'use strict';

  if (confirm('are you sure?')) {
    document.getElementById('form_' + e.dataset.id).submit();
  }
}
</script>

@endsection