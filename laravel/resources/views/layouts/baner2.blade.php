{{-- resouces/views/layout/baner2.blade.php --}}


<?php
$banurl = "";
$banimg = "";
$bannum = mt_rand(1, 6);
if($bannum == 1){
  $banurl = "https://laptre.jp/service/srp3";
  $banimg = "/image/banner_laptre3.jpg";
}else if($bannum == 2){
  $banurl = "https://laptre.jp/service/chair";
  $banimg = "/image/banner_laptre5.jpg";
}else if($bannum == 3){
  $banurl = "https://laptre.jp/service/chairtraner";
  $banimg = "/image/banner_laptre6.jpg";
}else if($bannum == 4){
  $banurl = "https://shop.la-precious.jp/";
  $banimg = "https://laptre.jp/wdps/wp-content/themes/laptre/images/banner_ec_m.jpg";
}else if($bannum == 5){
  $banurl = "https://la-precious.jp/setsumeitool/";
  $banimg = "https://la-precious.jp/wdps/wp-content/themes/work/image/banner_st01_2m.png";
}else if($bannum == 6){
  $banurl = "https://laptre.jp";
  $banimg = "https://la-precious.jp/wdps/wp-content/themes/work/image/banner_laptre_m.png";
}

?>
<!--
<a class="tsbanner" href="https://la-precious.jp/matsuri2021" target="_blank">
  <img src="https://la-precious.jp/matsuri2021/img/ogp.jpg" class="img-responsive img-responsive-overwrite"/>
</a>
<div class="space20"></div>
-->
<!--
<a class="tsbanner" href="<?php echo $banurl; ?>" target="_blank" >
<img class="img-responsive img-responsive-overwrite" src="<?php echo $banimg; ?>" alt="バナー">
</a>
<div class="space20"></div>
-->

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
