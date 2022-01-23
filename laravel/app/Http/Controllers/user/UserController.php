<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Study;
use App\Category;
use App\News;
use Image;
use Hash;
use DB;
use Response;
use Auth;
use Validator;
use Redirect;
use Mail;

// 追加　登録時のメール認証
use Carbon\Carbon;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Config\Repository as Config;
class UserController extends Controller
{
protected $user;

    public function __construct()
    {
        $this->middleware('auth:users'); // 認証

        $this->user = Auth::guard('users')->user();
    }


	//プロフィール表示//////////////////////////////
    public function getProfile()
    {
		$user = Auth::user();
		$userId = $user->id;
		$posts = Post::orderBy('title','asc')->get();

		$studied = Study::where('user_id','=', $userId)->where('status','=','1')->get();
		$studied =count($studied);

		$studies = array();
		$postcount = array();
		//カテゴリーごと学習完了数を取得
		$categories = Category::oldest('created_at')->get();
		//カテゴリーごとにループ
		foreach($categories as $category){
			//カテゴリー別のポスト一覧を取得
			$posttemp = Post::where('category_id', '=', $category->id)->get();
			$postcount[] = count($posttemp);//レコード数を取得
			//該当カテゴリーの学習完了済みポストを取得
			$i = 0;
			foreach($posttemp as $pos){
				$studytemp = Study::where('user_id','=', $userId)->where('post_id','=',$pos->id)->where('status','=','1')->first();
				if(isset($studytemp)){
					$i++;
				}
			}
			$studies[] = $i;
		}


		//総学習時間の取得
		$timestemp = DB::table('accesses')->where('user_id','=', $userId)->sum('times');

		//時間表示のフォーマット　日本語
		$time = round($timestemp / 1000);
		//$s = $time % 60;
		$m = floor(($time / 60) % 60);
		$h = floor($time / 3600);
		//$times = $h.': '.$m;
		$times = sprintf("%02d:%02d", $h, $m);


		$days = DB::table('accesses')
					->selectRaw('count(distinct DATE_FORMAT(starttime, "%Y-%m-%d")) as date')
					->where('user_id','=', $userId)
					->first();


		//公開済みのニュース
		$news = News::where('open','=','1')->take(3)->latest()->get();


		return view( 'posts.profile', compact('new1','categories','postcount','studies','studied','news','times','days','user') );

    }


	//ニックネーム変更処理//////////////////////////////
    public function postName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|max:255'
        ]);
		//　エラーチェック
		if( $validator->fails() ){
		   return redirect('/mypage/profile')->with('flash_error','ニックネームを入力してください。');
		}

		$user = User::find($this->user->id);
		$user->name = $request->input('name');
		$user->save();


	   return redirect('/mypage/profile')->with('flash_message','ニックネームが変更されました。');
    }


	//アバター処理//////////////////////////////
    public function postAvater(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avater'  => 'required|image|max:2000'//kbyte
        ]);
		//　エラーチェック
		if( $validator->fails() ){
		   return redirect('/mypage/profile#avater')->with('flash_error','選択されていないか、または画像を大きすぎる、または形式が違います。（2Mbyte以内・jpg,png,gif形式)');
		}

		$imagename = "";
       	if( $request->hasFile('avater')){
			// アップロード画像を取得
			$image = $request->file('avater');

			// ファイル名を生成し画像をアップロード
			$imagename = md5(sha1(uniqid(mt_rand(), true))).'.'.$image->getClientOriginalExtension();
			$upload = $image->move('media', $imagename);

			$user = User::find($this->user->id);
			$user->avater =  $imagename;
			$user->save();

			//画像加工
			Image::make($upload)
					  //リサイズ　高さは比率に合わせる
					  ->resize(150, null, function ($constraint) {
							$constraint->aspectRatio();
						})
					  //トリミング　中心から100pxずつ
					  ->crop(100, 100)
					  ->save();

		   return redirect('/mypage/profile#avater')->with('flash_message','プロフィール画像が変更されました。');
		}
    }

  //メールアドレス変更処理(0から4)//////////////////////////////

    /**
     * 0．メールアドレスのバリデーション設定
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
    */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users'
        ]);
    }

    /**
     * 1，メールアドレス変更アクション
     * バリデーションチェックを行い、postEmailにデータを送る。
     *
     * @param Request $request
     * @param Mailer $mailer
     * @param Config $config
     * @return \Illuminate\Http\RedirectResponse
    */

    public function postUpdate(Request $request, Mailer $mailer, Config $config)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect('/mypage/profile#email')->with('flash_error','メールアドレスが間違っているか、すでに登録されている可能性があります。');
        }

        $this->postEmail($mailer, $request->all(), $config->get('app.key'));

        return redirect('/mypage/profile#email');
    }

    /**
     * 2，メールアドレス変更アクション
     * 入力されたアドレスをカラム「new_email」に仮登録
     * カラム「confirmation_token」に確認用の乱数文字列を登録
     * sendConfirmMailにデータを送る。
    */
    public function postEmail(Mailer $mailer, array $data, $app_key)
    {
			$user = User::find($this->user->id);

	    $user->makeConfirmationToken($app_key);
	    $user->confirmation_sent_at = Carbon::now();

	 		$user->new_email = $data['email'];

	 		$user->save();

			$this->sendConfirmMail($mailer, $user);

			return $user;
    }

		/**
     * 3．確認メールの送信
     * 受け取ったアドレス宛にメールを送信
     * 変数tokenを受け渡す
     *
     * @param Mailer $mailer
     * @param User $user
    */
    private function sendConfirmMail(Mailer $mailer, User $user)
    {


$body ="";
$body .= "※※※※※※※※※※※※※※※※※※\n";
$body .= "このメールは自動で送信しております。\n";
$body .= "返信しないようにお願いいたします。\n";
$body .= "※※※※※※※※※※※※※※※※※※\n\n\n";
$body .= $user['name']."さん！\n\n\n";
$body .= "登録メールアドレスを変更します。\n\n\n";
$body .= "変更前：　".$user['email']."\n";
$body .= "↓\n";
$body .= "変更後：　".$user['new_email']."\n\n";
$body .= "よろしければ下記のリンクをクリックして新しいメールアドレスを有効化してください。\n\n";
$body .= "※別の端末でメールを受信している場合は、下記リンクを操作している端末にコピーしてアクセスしてください。\n\n";
$body .= url('mypage/confirm', [$user->confirmation_token])."\n\n";
$body .= "このメールはラプレッスン・ウェブサイトより送信されました。\n";
$body .= "心当たりの無い場合は破棄して頂きますようお願いいたします。\n\n";
$body .= "＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
$body .= "○運営会社\n";
$body .= "歯科衛生士をキラキラにする会社　ラ・プレシャス\n";
$body .= "MAIL : info@la-precious.jp\n";
$body .= "＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";


		Mail::raw(
			$body,
			function($message) use ($user) {
				$message->to($user->new_email, $user->name)
				->subject('【ラプレッスン】メールアドレス変更');
			}
		);

		/*

        $mailer->send(
            'emails.email-confirm',
            ['user' => $user, 'token' => $user->confirmation_token],
            function($message) use ($user) {
                $message->to($user->new_email, $user->name)->subject('【ラプレッスン】メールアドレス変更');
            }
        );
		*/

        \Session::flash('flash_message', 'メールアドレス変更確認メールを送りました。');
    }


 	/**
     * 4．ユーザーを確認済にする
     * 受け取ったメールから$tokenを取得し、
     * カラム「confirmation_token」と一致するか認証する。
     * 一致したら、カラム「email」に「new_email」を代入し、保存する。
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
    */
    public function getConfirm($token) {
        $user = User::where('confirmation_token', '=', $token)->first();
        if (! $user) {
            \Session::flash('flash_message', '無効なトークンです。');
			return redirect('/mypage/profile#email');
        }
 		$user->email = $user->new_email;
        $user->confirm();
        $user->save();

        \Session::flash('flash_message', 'メールアドレスを変更しました。');
		return redirect('/mypage/profile#email');
    }


	//パスワード再設定処理//////////////////////////////
	public function passwordSettingExec(Request $request)
	{

        //ログインユーザーの情報を取得
        $userInfo = Auth::user();
        $userUniqId = $userInfo->id;

        //現在のユーザーパスワードをDBから取得
        $hashedPassword = $userInfo->password;
        $password = $request->password;

		/*
		$this->validate($request, [
			'passwordnew'  => 'required|min:6'

		  ]);
*/

        //inputs
        $inputs = $request->all();

        //rules
        $rules = [
			'passwordnew'  => 'required|min:6'
        ];

        //validation
        $validation = \Validator::make($inputs,$rules);




        //入力された現在パスワードとDBのパスワードが合致しているかチェック
        if (Hash::check($password, $hashedPassword)){
        $validator = $this->validatorpass($request->all());
        if ($validator->fails()) {
            return redirect('/mypage/profile#password')->with('flash_error','新しいパスワードは6文字以上で入力してください');
        }

	     // パスワード一致したら。。。
        // 新しいパスワードの２つがあっているかチェックして
            if( $request->passwordnew == $request->passwordconfirm){
               //合っていれば新しいパスワードをHashしてDBに格納
                $encrypted = Hash::make($request->passwordnew);
                User::where('id', '=', $userUniqId)->update(array('password' => $encrypted));
				Auth::logout();
				\Session::flash('flash_message', 'パスワードが変更されました。新しいパスワードでログインしてください。');
				return redirect('/auth/login');
            }else{
				\Session::flash('flash_error', '新しいパスワードが一致しません。');
				return redirect('/mypage/profile#password');
			}

        } else {
			\Session::flash('flash_error', '現在のパスワードが間違っています。');
            return redirect('/mypage/profile#password');
        }

    }

    protected function validatorpass(array $data)
    {
        return Validator::make($data, [
			'passwordnew'  => 'required|min:6'
        ]);
    }



	public function allusers(){
    $users = User::orderBy('created_at','desc')->paginate(300);
		return view( 'admin.users', compact('users') );
	}

	public function userdestroy($id){
		$user = User::findOrFail($id);
		$user->delete();
		return redirect('/admin/userslist')->with('flash_message', 'User Deleted!');
	}


  //CSVエクスポート////////////////////////////////////////////////////////////////////////////////////////////////
	public function userdownload(Request $request){

		//単語一覧取得
		//$users = User::all();
    $users = User::whereNotNull('confirmed_at')->get();
		$csv ="";
		// CSVデータ作成
			$csv .= 'id,name,email,created_at,confirmed_at';
			$csv .= "\r";
		foreach ($users as $user){
			$csv .= mb_convert_encoding($user['id'], 'sjis-win', 'utf-8');
			$csv .= ",";
			$csv .= mb_convert_encoding($user['name'], 'sjis-win', 'utf-8');
			$csv .= ",";
			$csv .= mb_convert_encoding($user['email'], 'sjis-win', 'utf-8');
			$csv .= ",";
      $csv .= mb_convert_encoding($user['created_at'], 'sjis-win', 'utf-8');
			$csv .= ",";
			$csv .= mb_convert_encoding($user['confirmed_at'], 'sjis-win', 'utf-8');
			$csv .= "\r";
		}
		// 出力
		$fileName = "users_" . date("YmdHis") . ".csv";
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename=' . $fileName);
		echo $csv;

	}





}
