@extends('layouts.default')


@section('title')プライバシーポリシー | <?php echo Config::get('app.sitename');?>@endsection
@section('description'){{ Config::get('app.description')}}@endsection
@section('keywords'){{ Config::get('app.keywords')}}@endsection
@section('content')
<?php //アプリ判定////////////////////////
$appclass = "";
$appflag = 0;
if (Util::ua_app() == true) {
	$appclass = Config::get('app.appclass');
	$appflag = 1;
}
//アプリ判定////////////////////////?> 

        <div class="container subpage about <?php echo $appclass;?>">
               <h1 class="subpage-h1">プライバシーポリシー</h1>
               <div class="text-center">

                    <div class="row">
                    	<div class="col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">
                          <p class="text-left">本ウェブサービス、ラプレッスンの運営会社であるラ・プレシャス（以下「当社」と言います。）は、個人情報保護を目的として以下の取り組みを実施しております。</p>
                        </div>
                    </div>
                    <div class="space50"></div>
                </div>
         </div><!--container-->
        <div class="block bg-gray bordertop">
        	<div class="container">
              	<h3>個人情報保護方針</h3>
                <p>当社は、以下のとおり個人情報保護方針を定め、個人情報保護の仕組みを構築し、全従業員に個人情報保護の重要性の認識と取組みを徹底させることにより、個人情報の保護を推進致します。
                </p>
                <div class="space30"></div>          
            
            	<h3>個人情報の管理について</h3>
                <p>当社は、お客さまの個人情報を正確かつ最新の状態に保ち、個人情報への不正アクセス・紛失・破損・改ざん・漏洩などを防止するため、セキュリティシステムの維持・管理体制の整備・社員教育の徹底等の必要な措置を講じ、安全対策を実施し個人情報の厳重な管理を行ないます。
                </p>
                <div class="space30"></div>
                <h3>個人情報の利用目的について</h3>
                <p>当社は、個人情報を次の利用目的の達成に必要な範囲で利用いたします。</p>
                <ol>
                    <li>当社のサービス利用時における本人確認のため</li>
                    <li>お問い合わせへの対応のため</li>
                </ol>
                <div class="space30"></div>
                <h3>情報の統計データの開示</h3>
                <p>当社では、お客さまから取得させていただいた個人情報を集計・分析し、個人が特定できない統計データに加工して、第三者に開示することがあります。この場合、利用・開示されるのは集計結果のみであり、お客さまの個人情報自体が第三者に開示されることは一切ありません。</p>
                <div class="space30"></div>
                <h3>個人情報の第三者への開示・提供の禁止</h3>
                <p>当社は、お客さまよりお預かりした個人情報を適切に管理し、次のいずれかに該当する場合を除き、個人情報を第三者に開示いたしません。</p>
                <ol>
                    <li>お客さまの同意がある場合</li>
                    <li>お客さまが希望されるサービスを行なうために当社が業務を委託する業者に対して開示する場合</li>
                    <li>法令に基づき開示することが必要である場合</li>
                </ol>                
                <div class="space30"></div>                
                <h3>個人情報の安全対策</h3>
                <p>当社は、個人情報の正確性及び安全性確保のために、セキュリティに万全の対策を講じています。</p>
                <div class="space30"></div>                
                 <h3>ご本人の照会</h3>
                <p>お客さまがご本人の個人情報の照会・修正・削除などをご希望される場合には、ご本人であることを確認の上、対応させていただきます。</p>
                <div class="space30"></div>                
                 <h3>法令、規範の遵守と見直し</h3>
                <p>当社は、個人情報保護に対する取り組みを、継続的に見直し、改善していきます。</p>
                <div class="space30"></div>            
                 <h3>個人情報に関するお問い合せ窓口</h3>
                <p>当社の個人情報の取扱に関するお問い合せは下記までご連絡ください。<br>ラ・プレシャス<br>Mail:info@la-precious.jp</p>
                <div class="space30"></div>                   
                 <h3>お問い合わせメールの免責事項</h3>
                <p>info@la-precious.jp宛にお送りいただいたお問い合わせメールのうち、添付書類のついたものは、ウィルスによる事故を回避するため開かないで削除いたしますのでご了承下さい。お問い合わせ内容は全てメール本文にお書きいただきますようお願い申し上げます。
                </p>
                <div class="space30"></div>   
                <p class="text-right">以上<br>
                <br>2016年7月7日 制定
                <br>ラ・プレシャス</p>             
            
            
            </div>
        
        </div> 
@if($appflag == 0)<!--アプリ判定 1:アプリ 0:ブラウザ-->
<div id="footer-top">
	<div class="container">
        <div class="pull-left">
            <ol class="breadcrumb">
              <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
              <li class="active">ラプレッスンとは？</li>
            </ol>

        </div>
        
        @if (!strstr(Request::url(), '/lesson/category/'))
	        <div id="snsbox-footer" class="pull-right"></div>
        @endif
    </div>
</div>
@endif

@endsection