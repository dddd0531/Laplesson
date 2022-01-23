{{-- resouces/views/sidebarbaner.blade.php --}}

<!--SRPセミナー-->

<div class="row">
<div class="col-sm-12 col-lg-offset-1 col-lg-10">
<h4>少しだけ宣伝させてください！</h4>


<!--
<a class="tsbanner" href="http://tenderspace.jp/dh-seminar-tenderspace8/" target="_blank" >
<img class="img-responsive img-responsive-overwrite" src="https://la-precious.jp/wdps/wp-content/themes/work/image/banner8m.png" alt="歯科衛生士勉強会TENDERSPACE８期生募集">
</a>
<div class="space50 pconly"></div>
<div class="space20 mobileonly"></div>
-->

<!--
<a class="tsbanner" href="https://la-precious.jp/siawase/" target="_blank" >
<img class="img-responsive img-responsive-overwrite" src="https://la-precious.jp/wdps/wp-content/uploads/2019/10/image.jpg" alt="2/23「手から伝わる幸せホルモン〜オキシトシンの本当の力〜」岡村が登壇します！">
</a>
<div class="space20"></div>
-->

<?php
$cateid = 0;
if(isset($post->categories->id)){
    $cateid = $post->categories->id;
}?>
@if($cateid == 23 || $cateid == 25 || $cateid == 18 || $cateid == 19)  {{-- SRP --}}
<?php $srpnum = mt_rand(1, 3);?>
  <a class="tsbanner" href="https://laptre.jp/service/srp<?php echo $srpnum; ?>" target="_blank" >
  <img class="img-responsive img-responsive-overwrite" src="/image/banner_laptre<?php echo $srpnum; ?>.jpg" alt="ラプトレSRPレッスン">
  </a>
  <div class="space20"></div>
@else
<?php
$lessonurl = "";
$srpnum = mt_rand(4, 9);
if($srpnum == 4){
  $lessonurl = "space";
}else if($srpnum == 5){
  $lessonurl = "chair";
}else if($srpnum == 6){
  $lessonurl = "chairtraner";
}else if($srpnum == 7){
  $lessonurl = "mente";
}else if($srpnum == 8){
  $lessonurl = "hyouka";
}else if($srpnum == 9){
  $lessonurl = "tbi";
}
?>
  <a class="tsbanner" href="https://laptre.jp/service/<?php echo $lessonurl; ?>" target="_blank" >
  <img class="img-responsive img-responsive-overwrite" src="/image/banner_laptre<?php echo $srpnum; ?>.jpg" alt="ラプトレ レッスン">
  </a>
  <div class="space20"></div>
@endif

<!--
<a class="tsbanner" href="https://la-precious.jp/matsuri2021" target="_blank">
  <img src="https://la-precious.jp/matsuri2021/img/ogp.jpg" class="img-responsive img-responsive-overwrite"/>
</a>
<div class="space20"></div>
-->

<a class="tsbanner" href="https://shop.la-precious.jp/" target="_blank" >
<img class="img-responsive img-responsive-overwrite" src="https://laptre.jp/wdps/wp-content/themes/laptre/images/banner_ec_m.jpg" alt="ラプレショップ | 歯科グッズ, 歯科説明ツール, 患者啓蒙ポスター,バッチ,文具">
</a>
<div class="space20"></div>
<a class="stbanner" href="https://la-precious.jp/setsumeitool/" target="_blank" >
<img class="img-responsive img-responsive-overwrite" src="https://la-precious.jp/wdps/wp-content/themes/work/image/banner_st01_2m.png" alt="歯周病説明ツール学習キット">
</a>
<div class="space20"></div>
<a class="tsbanner" href="https://laptre.jp" target="_blank" >
<img class="img-responsive img-responsive-overwrite" src="https://la-precious.jp/wdps/wp-content/themes/work/image/banner_laptre_m.png" alt="歯科衛生士の学び場">
</a>
<div class="space20 mobileonly"></div>

</div>
</div>

@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
<div class="space50 "></div>
@endif

<style>
a.tsbanner img{
    border: 1px solid #f5f5f5;
    box-shadow: 1px 1px 1px #ccc;
    padding: 10px;
    border-radius: 10px;
	background-color:#fff;
}
a.tsbanner img:hover{
	background-color:#f5f5f5;
}
a.stbanner img{
    border: 1px solid #f5f5f5;
    box-shadow: 1px 1px 1px #ccc;
    padding: 10px;
    border-radius: 10px;
	background-color:#EAD02F;
}
a.stbanner img:hover{
	background-color:#DBBD28;
}


</style>


<!-- バナー -->
<!--
<?php if (!Request::is('news/179')) {?>
<h4>イベントします★リアルにお会いしませんか？</h4>
<a class="tsbanner" href="https://laplesson.jp/news/179">
<img class="img-responsive pconly" src="/image/lapkai02.png" alt="【会員様限定★スケーリングと女子トーク】リアルにつながる 第２回ラプ会やります！">
</a>
<div class="space50 mobileonly"></div>
<style>
a.tsbanner img{
    border: 1px solid #f5f5f5;
    box-shadow: 1px 1px 1px #ccc;
    padding: 10px;
    border-radius: 10px;
	background-color:#fff;
}
a.tsbanner img:hover{
	background-color:#f5f5f5;
}
</style>
<?php }?>
-->
<!--SRPセミナー-->
<!--
<div class="row">
<div class="col-sm-12 col-lg-offset-1 col-lg-10">
<h4>少しだけ宣伝させてください！大阪でSRPセミナー残席3名です。</h4>
<a class="tsbanner" href="http://la-precious.jp/semminar/sem009/" target="_blank" >
<img class="img-responsive img-responsive-overwrite" src="/image/srpbaner.png" alt="SRPセミナー第6期生募集">
</a>
<div class="space50 mobileonly"></div>
</div>
</div>
<div class="space50"></div>
<style>
a.tsbanner img{
    border: 1px solid #f5f5f5;
    box-shadow: 1px 1px 1px #ccc;
    padding: 10px;
    border-radius: 10px;
	background-color:#fff;
}
a.tsbanner img:hover{
	background-color:#f5f5f5;
}
</style>
-->




<!-- バナー -->
<!--
<h4>少しだけ宣伝させてください！大阪で勉強会をやっています。</h4>
<a class="tsbanner" href="http://tenderspace.jp/dh-seminar-tenderspace7/" target="_blank" >
<img class="img-responsive pconly" src="http://tenderspace.jp/wp/wp-content/themes/tenderspace/image/banner_09.jpg" alt="テンダースペース７期生募集">
<img class="img-responsive mobileonly" src="http://tenderspace.jp/wp/wp-content/themes/tenderspace/image/banner_09m.jpg" alt="テンダースペース７期生募集">
</a>
<div class="space50"></div>
<style>
a.tsbanner img{
    border: 1px solid #f5f5f5;
    box-shadow: 1px 1px 1px #ccc;
    padding: 10px;
    border-radius: 10px;
	background-color:#fff;
}
a.tsbanner img:hover{
	background-color:#f5f5f5;
}
</style>
-->
