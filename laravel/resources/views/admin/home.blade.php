@extends('layouts.admin')


@section('title')
Home
@endsection

@section('content')
              <h1>Home</h1>
              <div class="row">
              	<div class="col-sm-8">
                  <h2>サマリー</h2>
                  <table class="table table-striped">
                  <tbody>
                  <tr><th>正会員</th><td>{{ $properusers }}</td></tr>
                  <tr><th>総会員</th><td>{{ $users }}</td></tr>
                  <tr><th>レッスンカテゴリー</th><td>{{ $categories }}</td></tr>
                  <tr><th>レッスン</th><td>{{ $posts }}</td></tr>
                  <tr><th>完了レッスン</th><td>{{ $completed }}</td></tr>
                    
                  </tbody>
                  </table>
                  <div class="space50"></div>
                  <h2>会員一覧</h2>
                  <table class="table table-striped">
                  <tbody>
                    <?php $i =1;?>
                  	@foreach($userlist as $user)
                  		<tr><th><?php echo $i;?></th><td>{{$user->created_at}}</td><td>{{$user->name}}</td><td>{{$user->todofu}}</td><td>{{$user->email}}</td>
                        <td>
                        	@if($user->confirmed_at == null)
                           		×
                            @endif
                        </td>
                        </tr>
                        <?php $i++;?>
					@endforeach
                  </tbody>
                  </table>
               	</div> 
              	<div class="col-sm-4">
                  <h2>会員別学習時間・完了レッスン数</h2>
                  <table class="table table-striped">
                  <tbody>
                    <?php $i=1;?>
                  	@foreach($time2 as $time3)
                    		<?php 
                    		//時間表示のフォーマット　日本語
                            $time = round($time3->sum / 1000);
                            //$s = $time % 60;
                            $m = floor(($time / 60) % 60);
                            $h = floor($time / 3600);
                            //$times = $h.': '.$m;
                            $times = sprintf("%02d:%02d", $h, $m);
                    		?>
                    
					  <tr><th><?php echo $i.'位';?></th><td>{{$time3->name}}</td><td>{{ $time3->user_id }}</td><td><?php echo $times;?></td><td>
                        @foreach($complesson as $lesson)
                        	@if($lesson->user_id == $time3->user_id)
                            	{{ $lesson->count}}
                            @endif
                        @endforeach
						</td></tr>
						<?php $i++;?>
                    @endforeach
                  </tbody>
                  </table>
                
                  <div class="space50"></div>
                  <h2>都道府県別会員数</h2>
                  <table class="table table-striped">
                  <tbody>
                  	<?php $n = 1;?>
                  	@foreach($todofu as $todo)
                  		<tr><th><?php echo $n;?></th><td>{{$todo->todofu}}</td><td>{{$todo->count}}</td><td></td></tr>
                        <?php $n++;?>
					@endforeach
                  </tbody>
                  </table>
               	</div> 
              </div> 
 @endsection