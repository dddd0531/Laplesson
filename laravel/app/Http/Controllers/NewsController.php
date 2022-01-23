<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\NewsRequest;
use App\News;
use App\Post;
use App\Category;
use App\Study;
use App\User;
use App\Access;
use App\Http\Requests\PostRequest;
use Auth;
use DB;
use Validator;
use Mail;
use Session; //セッション

class NewsController extends Controller
{


	public function newsshow($id){
		$new1 = News::findOrFail($id);

		$posts = Post::orderBy('title','asc')->get();
		if (Auth::check()) {
			$user = Auth::user();
			$userId = $user->id;
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


			//ピックアップニュースの既読処理
			if($new1->pickup == 1){
				if(count(DB::table('news_users')->where('user_id', '=', $userId)->where('news_id', '=', $id)->get()) == 0){
					DB::table('news_users')->insert(
						['news_id' => $id,'user_id' => $userId]
						);
				}
			}
		}

		//公開済みのニュース
		$news = News::where('open','=','1')->take(3)->latest()->get();

		return view( 'posts.newsshow', compact('new1','categories','postcount','studies','studied','news','times','days') );

	}


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name2'  => 'required|max:255',
            'email' => 'required|email|max:255',
            'tell'  => 'required|numeric',
            'years'  => 'required'
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

		return view('posts.newsconfirm', compact("data"));

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
		$title = $data["title"];
		$name2 = $data["name2"];
		$email = $data["email"];
		$tell = $data["tell"];
		$years = $data["years"];
		$content = $data["content"];


		//メール送信

		Mail::send('emails.newscontact',
			['title' => $title,'name2' => $name2,'user_id' => $userId,'email' => $email,'tell' => $tell,'years' => $years,'content' => $content],
			function($message)
		{
			$message->to('info@la-precious.jp', 'ラプレッスン')->subject('【ラプレッスン】お申し込みがありました。');
			//$message->to('dai.nosaka@hito.works', 'ラプレッスン')->subject('【ラプレッスン】お申し込みがありました。');
		});


      	return redirect('/newscontact/thanks')->with('flash_thanks', 'ありがとうございます。メッセージは送信されました。');
	}

	// サンキューページ
    public function thanks()
    {
      return view('posts.newsthanks');
    }

	public function news(){
		$news = News::latest()->get();
		return view( 'admin.news', compact('news') );
	}

	public function show($id){
		$news = News::findOrFail($id);
		return view( 'admin.newsshow', compact('news') );
	}


	public function create(){
		return view('admin.newscreate');
	}

	public function edit($id){
		$news = News::findOrFail($id);
		return view( 'admin.newsedit', compact('news') );
	}

	public function destroy($id){
		$news = News::findOrFail($id);
		$news->delete();
		return redirect('/admin/news')->with('flash_message', 'News Deleted!');
	}

    public function store(NewsRequest $request) {

      $news = new News();
      $news->title = $request->title;
      $news->body = $request->body;
      $news->newsurl = $request->newsurl;
      $news->code = $request->code;
      $news->open = $request->open;
      $news->pickup = $request->pickup;
      $news->form = $request->form;
      $news->description = $request->description;
      $news->save();

			//画像のアップ
		  $last_insert_id = $news->id;
			//画像のアップ
		  $newsimg1 = "";
		  if( $request->hasFile('newsimg1')){
				// アップロード画像を取得
				$image = $request->file('newsimg1');
				// ファイル名を生成し画像をアップロード
				$newsimg1 = 'newsimg'.$last_insert_id.'_1.'.$image->getClientOriginalExtension();
				$upload = $image->move('image', $newsimg1);
		  }

		  $newsimg2 = "";
		  if( $request->hasFile('newsimg2')){
				// アップロード画像を取得
				$image = $request->file('newsimg2');
				// ファイル名を生成し画像をアップロード
				$newsimg2 = 'newsimg'.$last_insert_id.'_2.'.$image->getClientOriginalExtension();
				$upload = $image->move('image', $newsimg2);
		  }
			$newsimg3 = "";
		  if( $request->hasFile('newsimg3')){
				// アップロード画像を取得
				$image = $request->file('newsimg3');
				// ファイル名を生成し画像をアップロード
				$newsimg3 = 'newsimg'.$last_insert_id.'_3.'.$image->getClientOriginalExtension();
				$upload = $image->move('image', $newsimg3);
		  }
			$newsimg4 = "";
		  if( $request->hasFile('newsimg4')){
				// アップロード画像を取得
				$image = $request->file('newsimg4');
				// ファイル名を生成し画像をアップロード
				$newsimg4 = 'newsimg'.$last_insert_id.'_4.'.$image->getClientOriginalExtension();
				$upload = $image->move('image', $newsimg4);
		  }
			$newsimg5 = "";
		  if( $request->hasFile('newsimg5')){
				// アップロード画像を取得
				$image = $request->file('newsimg5');
				// ファイル名を生成し画像をアップロード
				$newsimg5 = 'newsimg'.$last_insert_id.'_5.'.$image->getClientOriginalExtension();
				$upload = $image->move('image', $newsimg5);
		  }


      return redirect('/admin/news')->with('flash_message', 'News Added!');
    }


    public function update(NewsRequest $request, $id) {


			//画像のアップ
		  $newsimg1 = "";
		  if( $request->hasFile('newsimg1')){
				// アップロード画像を取得
				$image = $request->file('newsimg1');
				// ファイル名を生成し画像をアップロード
				$newsimg1 = 'newsimg'.$id.'_1.'.$image->getClientOriginalExtension();
				$upload = $image->move('image', $newsimg1);
		  }

		  $newsimg2 = "";
		  if( $request->hasFile('newsimg2')){
				// アップロード画像を取得
				$image = $request->file('newsimg2');
				// ファイル名を生成し画像をアップロード
				$newsimg2 = 'newsimg'.$id.'_2.'.$image->getClientOriginalExtension();
				$upload = $image->move('image', $newsimg2);
		  }
			$newsimg3 = "";
		  if( $request->hasFile('newsimg3')){
				// アップロード画像を取得
				$image = $request->file('newsimg3');
				// ファイル名を生成し画像をアップロード
				$newsimg3 = 'newsimg'.$id.'_3.'.$image->getClientOriginalExtension();
				$upload = $image->move('image', $newsimg3);
		  }
			$newsimg4 = "";
		  if( $request->hasFile('newsimg4')){
				// アップロード画像を取得
				$image = $request->file('newsimg4');
				// ファイル名を生成し画像をアップロード
				$newsimg4 = 'newsimg'.$id.'_4.'.$image->getClientOriginalExtension();
				$upload = $image->move('image', $newsimg4);
		  }
			$newsimg5 = "";
		  if( $request->hasFile('newsimg5')){
				// アップロード画像を取得
				$image = $request->file('newsimg5');
				// ファイル名を生成し画像をアップロード
				$newsimg5 = 'newsimg'.$id.'_5.'.$image->getClientOriginalExtension();
				$upload = $image->move('image', $newsimg5);
		  }


      $news = News::findOrFail($id);
      $news->title = $request->title;
      $news->body = $request->body;
      $news->newsurl = $request->newsurl;
      $news->code = $request->code;
      $news->open = $request->open;
      $news->created_at = $request->created_at;
      $news->pickup = $request->pickup;
      $news->form = $request->form;
      $news->description = $request->description;
      $news->save();
      return redirect('/admin/news')->with('flash_message', 'News Updated!');
    }


}
