{{-- resources/views/auth/emails/password.blade.php --}}

<p>
※※※※※※※※※※※※※※※※※※<br>
このメールは自動で送信しております。<br>
返信しないようにお願いいたします。<br>
※※※※※※※※※※※※※※※※※※<br><br>
 </p>
 
 <p>
    {{ $user['name'] }} さん
</p>

 
下記リンクをクリックしてパスワードを再設定してください：<br>
<a href="{{ url('password/reset/'.$token) }}">{{ url('password/reset/'.$token) }}</a>



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