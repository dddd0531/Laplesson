@extends('layouts.admin')


@section('title')
Users
@endsection

@section('content')
              <h1>
                <a href="{{ url('/admin/userslist/download') }}" class="pull-right btn btn-warning">ダウンロード</a>
users</h1>

		<table class="table table-striped"><tbody>
			@forelse ($users as $user)
			 <tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->created_at }}</td>
			   	<td>{{ $user->name }}</td>
			   	<td>{{ $user->todofu }}</td>
			   	<td>{{ $user->email }}</td>
			 	<td>
					<form action="{{ route('user.destroy', $user->id) }}" id="form_{{ $user->id }}" method="post" style="display:inline">
					    {{ csrf_field() }}
					    {{ method_field('delete') }}
					      <a href="#" data-id="{{ $user->id }}" onclick="deleteUser(this);">[delete]</a>
				    </form>
				</td>
			  </tr>
			@empty
			<li>No Post user</li>
			@endforelse
		</tbody></table>

		{{$users->links()}}

<script>
{{-- Post削除 --}}
function deleteUser(e) {
  'use strict';

  if (confirm('ID: '+e.dataset.id+' を削除します。よろしいですか？')) {
    document.getElementById('form_' + e.dataset.id).submit();
  }
}
</script>

@endsection
