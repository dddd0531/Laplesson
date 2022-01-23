    <?php 
	//URLを取得
	$url = $_SERVER["REQUEST_URI"];
	
	//現在時刻を取得
	$now = date('Y-m-d H:i:s');
	?>

    
    @if (Auth::guest())
    	<?php $user_id = '00000';?>
    @else
    	<?php $user_id = Auth::user()->id;?>
    @endif
    <script type="text/javascript">
	$.ajaxSetup({
	   headers: { 
	   'X-CSRF-Token' : $('meta[name=_token]').attr('content') 
	   }
	});
	</script>
	<script type="text/javascript">
		//アクセスログ、滞在時間を取得////////////////////////////////////////////////////
		$(function() {
			//アクセスした時間を変数に格納
			var starttime = new Date;
				
				
				/*

			//画面遷移、画面を閉じたときに起動する
			$(window).on('beforeunload', function() {

				
				//DB登録
				var now = '<?php echo $now; ?>';
				var user_id = '<?php echo $user_id;?>';
				var times = (new Date - starttime);
				var url = '<?php echo $url;?>';
				
                $.ajax({
                    type: 'POST',
					async: false,       // ←非同期フラグにfalseをセット。画面遷移が完了してもデータを書き込むため
					url: '/lesson/access',
                    //dataType: 'JSON',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
						user_id : user_id,
						now : now,
						times : times,
						url : url						
                    },
                    //成功後の挙動
                    success: function(data) {
						success: console.log('AccessLog added')
                        <!--$('div.subpage').prepend('<div class="space20"></div><div class="alert alert-success flash_message" onclick="this.classList.add("hidden")">成功 !!!</div>');-->
                    },
                    error: function(){
                        console.log('AccessLog failed');
                        <!--$('div.subpage').prepend('<div class="space20"></div><div class="alert alert-danger flash_message" onclick="this.classList.add("hidden")">失敗 !!!</div>');-->
                    }            
				});
			});
			*/
			
			//画面遷移、画面を閉じたときに起動する
			$(document).bind('pagehide', function(e){
				//DB登録
				var now = '<?php echo $now; ?>';
				var user_id = '<?php echo $user_id;?>';
				var times = (new Date - starttime);
				var url = '<?php echo $url;?>';
				
                $.ajax({
                    type: 'POST',
					async: false,       // ←非同期フラグにfalseをセット。画面遷移が完了してもデータを書き込むため
					url: '/lesson/access',
                    //dataType: 'JSON',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
						user_id : user_id,
						now : now,
						times : times,
						url : url						
                    },
                    //成功後の挙動
                    success: function(data) {
						success: console.log('AccessLog added')
                        <!--$('div.subpage').prepend('<div class="space20"></div><div class="alert alert-success flash_message" onclick="this.classList.add("hidden")">成功 !!!</div>');-->
                    },
                    error: function(){
                        console.log('AccessLog failed');
                        <!--$('div.subpage').prepend('<div class="space20"></div><div class="alert alert-danger flash_message" onclick="this.classList.add("hidden")">失敗 !!!</div>');-->
                    }            
				});
			});
			
			
		});
	</script>