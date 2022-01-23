{{-- resources/views/emails/contact.blade.php --}}


<p>
    ラプレッスンのウェブサイトでお問い合わせがありました。対応してください。<br>
</p>

<p>
	お名前　　：　{{ $name2 }} <br>
    <?php if($user_id == 0){?>
    ユーザーID：　非会員もしくはログインしていません<br>
    <?php }else{?>
	ユーザーID：　{{ $user_id }} <br>
    <?php }?>
	メール　　：　{{ $email }}<br>
    内容　　　：　{{ $content }}
    <br>
    <br>
    <br>
</p>



<p>
このメールはラプレッスン・ウェブサイトより送信されました。<br>
心当たりの無い場合は破棄して頂きますようお願いいたします。<br>
</p>