<?php

namespace App\Http\Controllers\Auth;

//use App\Models\User;
//use Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Foundation\Auth\ThrottlesLogins;

//Laravel8では不要　コメントアウト
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers; 
use Mail;

// 追加　登録時のメール認証
use Carbon\Carbon;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Config\Repository as Config;

class AuthController extends Controller
{
    /**
     * @return View
     */
    public function getLogin()
    {
        return view('auth.login');
        
    }

    /**
     * @param App\Http\Requests\LoginFormRequest;
     * $request
     */
    public function postLogin(LoginFormRequest $request)
    {
        $credentials = $request->only('email','password');

        //ログイン判定
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('mypage');
        }
        //もしエラーの場合
        return back()->withErrors([
            'login_error' => 'アカウントが存在しないか、メールアドレスかパスワードが間違っています',
        ]);
    }

    /**
     * ユーザーをアプリケーションからログアウトさせる
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('getLogin')->with('logout','ログアウトしました');
    }

    /*
    |--------------------------------------------------------------------------
    　ここから下がLaravel5.2のコード
    |--------------------------------------------------------------------------
     */



    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    //Laravel8では不要　コメントアウト
    //use AuthenticatesAndRegistersUsers, ThrottlesLogins;



    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/mypage';

	protected $redirectAfterLogout = '/auth/login';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    
//Laravel8では不要　コメントアウト
/*
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
		$this->middleware('confirm', ['only' => 'postLogin']);
    }
*/
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'todofu' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(Mailer $mailer, array $data, $app_key)
    {
     $user = new User;
 
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->todofu = $data['todofu'];
        $user->password = bcrypt($data['password']);
 
        $user->makeConfirmationToken($app_key);
        $user->confirmation_sent_at = Carbon::now();
 
        $user->save();
 
        $this->sendConfirmMail($mailer, $user);
 
        return $user;
    }

	 /**
     * 確認メールの送信
     *
     * @param Mailer $mailer
     * @param User $user
     */
    private function sendConfirmMail(Mailer $mailer, User $user)
    {
		/*
        $mailer->send(
            'emails.confirm',
            ['user' => $user, 'token' => $user->confirmation_token],
            function($message) use ($user) {
                $message->to($user->email, $user->name)->subject('【ラプレッスン】仮登録完了。本登録をしてください。');
            }
        );
		*/

	
$body ="";
$body .= "※※※※※※※※※※※※※※※※※※\n";
$body .= "このメールは自動で送信しております。\n";
$body .= "返信しないようにお願いいたします。\n";
$body .= "※※※※※※※※※※※※※※※※※※\n\n\n";
$body .= "ラプレッスンにようこそ、".$user['name']."さん！\n\n\n";
$body .= "『仮登録を受け付けました。まだ会員登録は完了しておりません。\n\n\n";
$body .= "下記のURLにアクセスして、本登録をお願い致します。』\n";
$body .= "本メールの送信から24時間以内に下記のURLへアクセスいただき、ご登録手続きを完了させてください。\n";
$body .= "※本メールの送信より24時間を過ぎた場合は、下記の URLは無効になりますのでご注意ください。』\n\n";
$body .= url('auth/confirm', [$user->confirmation_token])."\n\n";
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
				$message->to($user->email, $user->name)
				->subject('【ラプレッスン】仮登録完了。本登録をしてください。');
			}
		);
		

		
    }

  /**
     * 確認メール再送画面を表示する
     *
     * @return \Illuminate\View\View
     */
    public function getResend()
    {
        return view('auth.confirm');
    }

  /**
     * 確認メールの再送信する
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postResend(Request $request, Mailer $mailer, Config $config)
    {
    $this->validate($request, ['email' => 'required|email']);
    $user = User::where('email', '=', $request->input('email'))->first();
    if(! $user) {
            return redirect()->back()
        ->withInput($request->only('email'))
        ->withErrors(['email' => trans('passwords.user')]);
    }
    if($user->isConfirmed()) {
        \Session::flash('flash_message', '既に、ユーザー登録が完了しています。ログインしてください。');
        return redirect('auth/login');
    }
 
        $this->sendConfirmMail($mailer, $user);
 
    \Session::flash('flash_message', 'ユーザー登録メールを再送信しました。メールをご確認ください。');
	\Session::flash('flash_info', '本登録を実施してください');
	\Session::flash('flash_info2', '【ユーザー登録メール】を登録されたメールアドレスに送信しましたので、記載された手順で【本登録】を完了してください。');
	\Session::flash('flash_info3', 'メールが届かない場合はこちら');
	
    return redirect()->guest('auth/login');
    }
	
 /**
     * ユーザー登録アクション
     * バリデーションチェックを行い、ユーザーを作成する
     *
     * @param Request $request
     * @param Mailer $mailer
     * @param Config $config
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(Request $request, Mailer $mailer, Config $config)
    {
        $validator = $this->validator($request->all());
 
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
 
        $this->create($mailer, $request->all(), $config->get('app.key'));
 
        \Session::flash('flash_message', '仮登録を受け付けました。');
        \Session::flash('flash_info', 'まだユーザー登録は完了しておりません。');
        \Session::flash('flash_info2', '【ユーザー登録メール】を登録されたメールアドレスに送信しましたので、記載された手順で【本登録】を完了してください。');
        \Session::flash('flash_info3', 'メールが届かない場合はこちら');
        return redirect('auth/login');
    }
	

 	/**
     * ユーザーを確認済にする
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getConfirm($token) {
        $user = User::where('confirmation_token', '=', $token)->first();
        if (! $user) {
            \Session::flash('flash_message', 'エラーは発生しました。別のブラウザでログインしている場合はログアウトしてください。');
            return redirect('auth/login');
        }
 
        $user->confirm();
        $user->save();
 
        \Session::flash('flash_message', '本登録が完了しました。ログインしてください。');
        return redirect('auth/login');
    }
		
}
