@extends('layouts.admin')


@section('title')
Help
@endsection

@section('content')
<h1><a href="{{ url('/admin/help/create') }}" class="pull-right btn btn-warning">Add New</a>
Help</h1>

            <table class="table table-striped"><tbody>

			@forelse ($helps as $help)
                    <tr>
                    <th>@if($help->open == 0)<span class="label label-default">下書き</span>@else<span class="label label-primary">公開済み</span>@endif</th>
                    <th>@if($help->category == 0)ユーザー登録について@elseif($help->category == 1)ログインできない場合について@elseif($help->category == 2)退会について@endif</th>
                    <th>{{ $help->id }}</th>
                    <td>{{ $help->question }}</td>
                    <td>{{ $help->answer }}</td>
                    <td><a href="{{ route('help.edit', $help->id) }}" class="btn btn-primary btn-xs">Edit</a></td> 
                    <td><form action="{{ route('help.destroy', $help->id) }}" id="form_{{ $help->id }}" method="post" style="display:inline">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                          <a href="#" data-id="{{ $help->id }}" onclick="deletePost(this);">×</a>
                        </form></td>
                    </tr>
			@empty
                <li>No Help</li>
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