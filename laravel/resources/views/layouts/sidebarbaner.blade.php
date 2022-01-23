{{-- resouces/views/sidebarbaner.blade.php --}}
<div class="sidebarbaner">

<!--
<a class="tsbanner pconly" href="http://tenderspace.jp/dh-seminar-tenderspace7/" target="_blank" >
<img class="img-responsive" src="http://tenderspace.jp/wp/wp-content/themes/tenderspace/image/banner_09m.jpg" alt="テンダースペース７期生募集">
</a>
<div class="space20"></div>
-->

<!--
<a class="stbanner pconly" href="https://la-precious.jp/setsumeitool/" target="_blank" >
<img class="img-responsive img-responsive-overwrite" src="https://la-precious.jp/wdps/wp-content/themes/work/image/banner_st02.png" alt="歯周病説明ツール学習キット">
</a>
<div class="space20"></div>-->
<!-- SRPセミナー-->
<!--
<a class="tsbanner pconly" href="http://la-precious.jp/semminar/sem009" target="_blank" >
<img class="img-responsive" src="/image/srpbaner.png" alt="SRPセミナー第6期生募集">
</a>
<div class="space20"></div>
-->

<!--
<?php if (!Request::is('news/179')) {?>
<a href="/news/179"><img class="img-responsive img-responsive-overwrite" src="/image/lapkai02.png" alt="【会員様限定★スケーリングと女子トーク】リアルにつながる 第2回ラプ会やります！"></a>
<div class="space20"></div>
<?php }?>
-->



@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
<div class="fb-page" data-href="https://www.facebook.com/laplesson.forDH/" data-width="500" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/laplesson.forDH/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/laplesson.forDH/">ラプレッスン</a></blockquote></div>
<div class="space20"></div>
@endif

<a href="/feedback"><img class="img-responsive img-responsive-overwrite" src="/image/feedback.png" alt="レッスンリクエスト"></a>


</div>
