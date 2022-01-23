<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Auth;
use DB;
use Mail;
use Session; //セッション


class ContactController extends Controller
{
	// お問い合わせ入力フォーム
    public function index()
    {
	  $data = 'お問い合わせ';	
	  $text = 'ご質問や気になることがございましたら、お気軽にお問い合わせくださいませ。';	
      return view('contact.contact', compact("data","text"));
    }

	// フィードバックフォーム
    public function index2()
    {
	  $data = 'あなたの感想をください';	
	  $text = 'ラプレッスンをもっと良くするために、使い勝手の感想やお褒めの言葉を頂けるとスタッフのモチベーションになるんです。あと作ってほしいレッスンをリクエストも受け付けています。すべてのリクエストにお応えすることは難しいかもしれませんが、出来る限り皆様のお声を反映させれるサービスに成長させたいと思っています。';	
	  return view('contact.contact', compact("data","text"));
    }
   

	
	
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name2'  => 'required|max:255',
            'email' => 'required|email|max:255',
            'content'  => 'required'
        ]);
    }
	

	   
	// 確認フォーム
	public function confirm(Request $request)
	{
        $validator = $this->validator($request->all());
 
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
		$data = $request->all();
		$request->session()->put($data); //入力内容をセッションに保存
		 
		return view('contact.confirm', compact("data"));		
		

	}
	

		
	// 登録処理
	public function complete()
	{
		if (Auth::check()) {
			$user = Auth::user();
			$userId = $user->id;	
		}else{
			$userId = 0;	
		}
		
		$data = session()->all(); //セッションの値を取得
		$name2 = $data["name2"];
		$email = $data["email"];
		$content = $data["content"];
		DB::table('contacts')->insert([
				'name' => $name2,
				'user_id' => $userId,
				'email' => $email,
				'content' => $content
		]); // 入力内容をデータベースへ挿入
		
		//メール送信
		
		Mail::send('emails.contact',
			['name2' => $name2,'user_id' => $userId,'email' => $email,'content' => $content],
			function($message)
		{
			$message->to('info@la-precious.jp', 'ラプレッスン')->subject('【ラプレッスン】お問い合わせがありました。');
			//$message->to('dai.nosaka@hito.works', 'ラプレッスン')->subject('【ラプレッスン】お問い合わせがありました。');
		});


		
		
      	return redirect('/contact/thanks')->with('flash_thanks', 'ありがとうございます。メッセージは送信されました。');
	}  
	
	// サンキューページ
    public function thanks()
    {
      return view('contact.thanks');
    }
}
