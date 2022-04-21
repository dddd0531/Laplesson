@extends('layouts.admin')


@section('title')
Lessons
@endsection

@section('content')
              <h1>
<a href="{{ url('/admin/lesson/create') }}" class="pull-right btn btn-warning">Add New</a>
Lessons</h1>

		@foreach ($categories as $category)
        	<div class="space50"></div>
        	<h3>{{ $category->category }}</h3>
            <table class="table table-striped"><tbody>

			@forelse ($posts as $post)
                @if($post->category_id == $category->id)
                    <tr>
                    <th width="2%">{{ $post->id }}</th>
                    <td width="5%">
                    @if($post->released == "1")
                    	<span class="accent">公開済み</span>
                    @else
                    	<span class="gray">未公開</span>
                    @endif
                    </td>
                    <td width="5%">
                    @if($post->usersonly == "1")
                    	<span class="gray">会員専用</span>
                    @elseif($post->usersonly == "2")
                    	<span class="gray">準備中</span>
                    @else
                    	<span class="gray">公開用</span>
                    @endif
                    </td>
                    
                    <td width="15%"><a href="{{ route('lesson.show', $post->id) }}">{{ $post->title }}</a></td>                    
                    <td width="30%">{!! nl2br(e($post->body)) !!}</td>
                    <td width="3%">
                    @if($post->imageflag == "1")
                    	画像
                    @endif
                    </td>
                    <td width="7%">{!! $post->playtime !!}</td>
                    <td width="5%"><a href="{{ route('lesson.edit', $post->id) }}" class="btn btn-primary btn-xs">Edit</a></td> 
                    <td width="5%"><form action="{{ route('lesson.destroy', $post->id) }}" id="form_{{ $post->id }}" method="post" style="display:inline">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                          <a href="#" data-id="{{ $post->id }}" onclick="deletePost(this);">×</a>
                        </form></td>
                    </tr>
                @endif
			@empty
			<li>No Posts</li>
			@endforelse
		</tbody></table>
	@endforeach     

        <h4>未分類</h4>
        <table class="table table-striped"><tbody>
			@forelse ($posts as $post)
                @if(!$post->category_id)
                    <tr>
                    <th>{{ $post->id }}</th>
                    <td><a href="{{ action('PostsController@show', $post->id) }}">{{ $post->title }}</a></td>
                    <td>{!! nl2br(e($post->body)) !!}</td>
                    <td><a href="{{ action('PostsController@edit', $post->id) }}" class="btn btn-primary btn-xs">Edit</a></td> 
                    <td><form action="{{ action('PostsController@destroy', $post->id) }}" id="form_{{ $post->id }}" method="post" style="display:inline">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                          <a href="#" data-id="{{ $post->id }}" onclick="deletePost(this);">×</a>
                        </form></td>
                    </tr>
                @endif
			@empty
				<tr><td>No Posts</td></tr>
			@endforelse
		</tbody></table>


<script>
{{-- Post削除 --}}
function deletePost(e) {
  'use strict';

  if (confirm('本当に削除してよろしいですか？')) {
    document.getElementById('form_' + e.dataset.id).submit();
  }
}
</script>

@endsection