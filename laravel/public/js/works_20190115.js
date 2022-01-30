// JavaScript Document

$(document).ready(function() {
	
	
	////////////////////////////////////////////////////////////////////////////////
	/// スマホのホバー設定
	////////////////////////////////////////////////////////////////////////////////
	$('a').bind( 'touchstart', function(){
	$( this ).addClass( 'hover' );
	}).bind( 'touchend', function(){
		$( this ).removeClass( 'hover' );
	});
	
	////////////////////////////////////////////////////////////////////////////////
	/// #(ハッシュ)指定されたタブを表示する
	////////////////////////////////////////////////////////////////////////////////	
    var hashTabName = document.location.hash;
    if (hashTabName) {
        $('.nav-tabs a[href=' + hashTabName + 'page]').tab('show');
    }
	
	
	////////////////////////////////////////////////////////////////////////////////
	/// タブのページURLにハッシュをつける
	////////////////////////////////////////////////////////////////////////////////	
	$('.profilepage .nav-tabs li').click(function(e){
		var key = $(this).children("a").attr('aria-controls');
		e.preventDefault();
		location.hash = key;
	});

	////////////////////////////////////////////////////////////////////////////////
	/// BACK TO TOP
	////////////////////////////////////////////////////////////////////////////////	
	var showFlug = false;
	var topBtn = $('#backtotop');
	//最初はボタン位置をページ外にする
	topBtn.css('bottom', '-1000px');
	//スクロールが100に達したらボタン表示
	$(window).scroll(function () {
		if ($(this).scrollTop() > 700) {
				if (showFlug == false) {
					showFlug = true;
					topBtn.stop().animate({'bottom' : '80px'}, 1000); 
				}
			} else {
				if (showFlug) {
					showFlug = false;
					topBtn.stop().animate({'bottom' : '-1000px'}, 500); 
				}
		}
	});
	//スクロールしてトップに戻る
	//500の数字を大きくするとスクロール速度が遅くなる
	topBtn.click(function () {
	$('body,html').animate({
			scrollTop: 0
	}, 500);
		return false;
	});
	

    //アラートメッセージ
        /*
         * 1秒かけてメッセージを表示し、
         * その後2秒間何もせず、
         * その後2秒かけてメッセージを非表示にする
         */
       // $('.flash_message').delay(2000).fadeOut(500);
});