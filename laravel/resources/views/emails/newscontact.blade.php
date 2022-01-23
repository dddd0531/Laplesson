{{-- resources/views/emails/newscontact.blade.php --}}


<p>
    ラプレッスンのウェブサイトでお申し込みがありました。対応してください。<br>
</p>

<p>

	参加イベント　　：　{{ $title }} <br>
	ニックネーム　　：　{{ $name2 }} <br>
    <?php if($user_id == 0){?>
    ユーザーID：　ログインしていません<br>
    <?php }else{?>
	ユーザーID：　{{ $user_id }} <br>
    <?php }?>
	メール　　：　{{ $email }}<br>
	電話番号　　：　{{ $tell }}<br>   
	歯科衛生士経験年数　　：　{{ $years }}<br>
	質問など　　　：　{{ $content }}
    <br>
    <br>
    <br>
</p>



<p>
このメールはラプレッスン・ウェブサイトより送信されました。<br>
心当たりの無い場合は破棄して頂きますようお願いいたします。<br>
</p>