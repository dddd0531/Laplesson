{{-- resources/views/emails/email-confirm.blade.php --}}

<p>
※※※※※※※※※※※※※※※※※※<br>
このメールは自動で送信しております。<br>
返信しないようにお願いいたします。<br>
※※※※※※※※※※※※※※※※※※<br><br>
 </p>
<p>
    {{ $user['name'] }} さん<br>
</p>

<p>
	登録メールアドレスを変更します。<br><br>
	変更前：　{{ $user['email'] }} <br>
	↓<br>
	変更後：　{{ $user['new_email'] }}<br><br>
</p>

<p>
    よろしければ下記のリンクをクリックしてください。<br />
    ログイン画面が開くので新しいメールアドレスでログインしてください。
</p>

<p>
    <a href="{{ url('mypage/confirm', [$token]) }}">{{ url('mypage/confirm', [$token]) }}</a>
    <br><br><br>
</p>



<p>
このメールはラプレッスン・ウェブサイトより送信されました。<br>
心当たりの無い場合は破棄して頂きますようお願いいたします。<br>
<br>
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>
<?php echo Config::get('app.sitename');?><br>
<br>
○運営会社<br>
歯科衛生士をキラキラにする会社　ラ・プレシャス<br>
MAIL : info@la-precious.jp<br>
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>
</p>
