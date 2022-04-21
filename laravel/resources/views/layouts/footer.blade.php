{{-- resouces/views/footer.blade.php --}}

<div id="backtotop"><a href="#header"></a></div>
<div id="footer" class="text-center">
  <div class="container">
    <div class="footer-body">
    	<div class="row">
		<div class="col-sm-6">
         <a href="/"><img src="/image/footerlogo3.png" class="img-responsive img-responsive-overwrite" alt="動画で学べる！歯科衛生士のための無料学習サイト ラプレッスン"></a>
          <div class="row text-left content">
            <div class="col-sm-6">
              <ul style="padding:0;">
                <li><a href="/lesson">レッスン一覧</a></li>
                <li><a href="/about">ラプレッスンとは？</a></li>
                <li><a href="/guide">学習ガイド</a></li>
                <li><a href="/auth/register">無料利用登録</a></li>
              </ul>
            </div>
            <!--col-->
            <div class="col-sm-6" >
              <ul style="padding:0;">
                <li><a href="/contact">お問い合わせ</a></li>
                <li><a href="/policy">プライバシーポリシー</a></li>
                <li><a href="/rule">利用規約</a></li>
                <li><a href="http://la-precious.jp" target="_blank">運営会社</a></li>
              </ul>
            </div>
            <!--col-->
          </div>
          <!--row-->
        </div><!--col-->
        <div class="col-sm-6">
        	<div class="space50 pconly"></div>
        	<div class="space20"></div>


        </div><!--col-->
     </div><!--row-->
    <div class="space30"></div>
      <div class="followme-footer">
      @include('layouts.followme')
	</div>

<!--
      <div class="row">
        <<div class="col-sm-6"> <a href="http://tenderspace.jp" target="_blank"><img class="img-responsive img-responsive-overwrite footerlink" src="/image/footer-ts.png" alt="仲間と一緒に学べる歯科衛生士年間スクールTenderSpace"></a> </div>
        <div class="space20 mobileonly"></div>
        <div class="col-sm-6"> <a href="http://la-precious.jp" target="_blank"><img class="img-responsive img-responsive-overwrite footerlink" src="/image/footer-lp.png" alt="歯科衛生士のための医院研修とセミナー　La Precious　ラプレシャス"></a> </div>
      </div>

        <div class="space50"></div>
            -->
      <div class="row">
        <div class="col-sm-offset-1 col-sm-10">
          <a class="lptbanner" href="http://la-precious.jp" target="_blank">
            <img class="img-responsive img-responsive-overwrite footerlink" src="/image/footer-lp.png" alt="歯科衛生士のための医院研修とセミナー　La Precious　ラプレシャス">
          </a>
          <div class="space50"></div>
          <a class="lptbanner" href="https://shop.la-precious.jp/" target="_blank">
            <img class="img-responsive img-responsive-overwrite footerlink pconly" src="https://laptre.jp/wdps/wp-content/themes/laptre/images/banner_ec.jpg" alt="ラプレショップ | 歯科グッズ, 歯科説明ツール, 患者啓蒙ポスター,バッチ,文具">
            <img class="img-responsive img-responsive-overwrite footerlink mobileonly" src="https://laptre.jp/wdps/wp-content/themes/laptre/images/banner_ec_m.jpg" alt="ラプレショップ | 歯科グッズ, 歯科説明ツール, 患者啓蒙ポスター,バッチ,文具">
    			</a>
          <div class="space50"></div>
    			<a class="stbanner" href="https://la-precious.jp/setsumeitool/" target="_blank">
    				<img class="img-responsive img-responsive-overwrite footerlink pconly" src="https://la-precious.jp/wdps/wp-content/themes/work/image/banner_st01_2.png" alt="歯周病説明ツール学習キット">
    				<img class="img-responsive img-responsive-overwrite footerlink mobileonly" src="https://la-precious.jp/wdps/wp-content/themes/work/image/banner_st01_2m.png" alt="歯周病説明ツール学習キット">
    			</a>
          <div class="space50"></div>
          <a class="lptbanner" href="https://laptre.jp" target="_blank">
    				<img class="img-responsive img-responsive-overwrite footerlink pconly" src="https://la-precious.jp/wdps/wp-content/themes/work/image/banner_laptre.png" alt="歯科衛生士の学び場">
    				<img class="img-responsive img-responsive-overwrite footerlink mobileonly" src="https://la-precious.jp/wdps/wp-content/themes/work/image/banner_laptre_m.png" alt="歯科衛生士の学び場">
    			</a>
  		  </div>
      </div>
<style>
a.stbanner img{
    padding: 10px;
    border-radius: 10px;
  	background-color:#EAD02F;
    width: 100%;
}
a.stbanner img:hover{
	background-color:#DBBD28;
}
a.lptbanner img{
    padding: 10px;
    border-radius: 10px;
  	background-color:#fff;
    width: 100%;
}
a.lptbanner img:hover{
	background-color:#eee;
}

</style>

      <!--row-->
    </div>
    <!-- footer-body -->
    <div class="footer-bottom">
        <span class="pull-left"><a href="/admin/login">サイト管理</a></span>
        <span class="pull-right">&copy; LAPLESSON.</span>
    </div><!--footer-bottom-->

  </div>
  <!--container-->
</div>
<!--footer ////////////////////////////////////////////////////////////////-->
