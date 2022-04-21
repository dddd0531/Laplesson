<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;


//Laravel8では不要　コメントアウト
//use Illuminate\Foundation\Auth\ThrottlesLogins;
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{

    /**
     * @return View
     */
    public function adminLogin()
    {
        return view('admin.login', ['authgroup' => 'admin']);
    }



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
	protected $guard = 'admin';//<-追加　これがないとuserのテーブルにselectしてしまう
    protected $redirectTo = '/admin/lesson';//ログイン後のリダイレクト先
	protected $loginView = '/admin.login';  //←追加
	protected $registerView = '/admin.register';  //←追加


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'getLogout']);
		//$this->middleware('guest:admin', ['except' => 'getLogout']);
        $this->middleware('guest:admin')->except('logout');
    }

    public function postLogin(LoginFormRequest $request)
    {
        $credentials = $request->only('email','password');

        //ログイン判定
        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();  
            return redirect()->route('adminLesson');
        }
        //もしエラーの場合
        return back()->withErrors([
            'login_error' => 'アカウントが存在しないか、メールアドレスかパスワードが間違っています',
        ]);
    }


    
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
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }




}
