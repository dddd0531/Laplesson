<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Post;
use App\Models\Category;
use App\Models\Study;
use App\Models\News;
use App\Models\User;
use App\Models\Access;
use App\Http\Requests\PostRequest;
use App\Http\Requests\EditRequest;
use Auth;
use DB;
use Carbon\Carbon;

class PostsController extends Controller
{
    //トップページ
	public function index(){
		//カテゴリー一覧とポスト数の集計
		$catecount = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
			->where('categories.released','=','1')
			->where('posts.released','=','1')
			->select('category_id', DB::raw('category_id,number,category,description,categories.released,count(*) as count'))
			->orderBy('number','DESC')
			->groupBy('category_id')
            ->get();

		$posts = Post::where('released', '=', '1')->where('usersonly','!=','2')->get();
		$posts = count($posts);
		$categories = Category::where('released', '=', '1')->get();
		$categories = count($categories);

		$news = News::where('open','=','1')->where('created_at','<=',Carbon::now())->take(3)->latest()->get();
		return view('top', compact('catecount', 'posts', 'categories','news') );
	}


	///ラプレッスンとは？
	public function about(){
		return view('about');
	}

	///学習ガイド
	public function guide(){
		$posts = Post::where('released', '=', '1')->where('usersonly','!=','2')->get();
		$posts = count($posts);
		$categories = Category::where('released', '=', '1')->get();
		$categories = count($categories);
		return view('guide', compact('posts', 'categories') );
	}

	///利用規約
	public function rule(){
		return view('rule');
	}

	///プライバシーポリシー
	public function policy(){
		return view('policy');
	}


	///一般用

	//アクセスログ

    public function access(Request $request){

	  	$user = $request->user_id;
	  	$now = $request->now;
	  	$times = $request->times;
	  	$url = $request->url;

		$access = new Access();
		$access->user_id = $user;
		$access->starttime = $now;
		$access->times = $times;
		$access->url = $url;
		$access->save();


    }



	public function lesson(){
		$posts = Post::orderBy('title','asc')->get();

		//カテゴリー一覧とポスト数の集計
		$catecount = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
			->where('categories.released','=','1')
			->where('posts.released','=','1')
			->select('category_id', DB::raw('category,number,description,categories.released,count(*) as count'))
			->orderBy('number','DESC')
			->groupBy('category_id')
            ->get();

		//カテゴリーごと学習完了数を取得
		$categories = Category::orderBy('number','asc')->get();

		if (Auth::check()) {
			$user = Auth::user();
			$userId = $user->id;

			/*
			$studiestemp = Study::where('user_id','=',$userId)->where('status','=','1')->get();
			$studies = array();
			foreach($studiestemp as $study){
				$studies[] = $study->post_id;
			}
			*/


			//学習完了情報を取得
			$studies = array();
			$postcount = array();

			//カテゴリーごとにループ
			foreach($categories as $category){
				//カテゴリー別のポスト一覧を取得
				$posttemp = Post::where('category_id', '=', $category->id)->where('released', '=', '1')->get();
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

			return view('posts.lesson', compact('posts','categories', 'catecount','studies','postcount') );

		}else{
			return view('posts.lesson', compact('posts','categories', 'catecount') );
		}
	}

	public function lessoncategory($categoryId){
		$posts = Post::where('category_id', '=', $categoryId)->where('released', '=', '1')->orderBy('title','asc')->get();


		//カテゴリー名とポスト数
		$categorycount = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
			->where('posts.released','=','1')
			->select('category_id', DB::raw('category,number,description,count(*) as count'))
			->where('category_id','=',$categoryId)
			->groupBy('category_id')
            ->first();


		//カテゴリー一覧とポスト数の集計
		$catecount = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
			->where('categories.released','=','1')
			->where('posts.released','=','1')
			->select('category_id', DB::raw('category,number,description,categories.released,count(*) as count'))
			->orderBy('number','desc')
			->groupBy('category_id')
            ->get();


		if (Auth::check()) {
			$user = Auth::user();
			$userId = $user->id;
			$studiestemp = Study::where('user_id','=',$userId)->where('status','=','1')->get();
			$studies = array();
			foreach($studiestemp as $study){
				$studies[] = $study->post_id;
			}


			//postsの該当カテゴリー一覧取得
			$posttemp = Post::where('category_id', '=', $categoryId)->where('released', '=', '1')->get();
			$migakusyu = count($posttemp);
			$i=0;
			foreach($posttemp as $pos){

				$studytemp = Study::where('user_id','=', $userId)->where('post_id','=',$pos->id)->first();
				if(isset($studytemp->status)){
					if($studytemp->status == 1){
						$i++;
					}
				}
			}
			$studies2 =$i;
			//http://nazo.hatenablog.com/entry/2015/04/03/105948 参考に



			return view('posts.lessoncategory', compact('posts', 'catecount','categorycount','studies', 'studies2','migakusyu') );

		}else{
			return view('posts.lessoncategory', compact('posts', 'catecount','categorycount') );
		}
	}

	public function lessonshow($id){
		$post = Post::findOrFail($id);
		$category = $post->category_id;
		$posts = Post::where('category_id', '=', $category)->where('released', '=', '1')->orderBy('title','asc')->get();
        $refer1 = "";if($post->refer1){$refer1 = Post::findOrFail($post->refer1);}
		$refer2 = "";if($post->refer2){$refer2 = Post::findOrFail($post->refer2);}
		$refer3 = "";if($post->refer3){$refer3 = Post::findOrFail($post->refer3);}
		$refer4 = "";if($post->refer4){$refer4 = Post::findOrFail($post->refer4);}

		//ページ送り
		//post_idの一覧を配列にいれる
		$poststemp = array();
		foreach($posts as $pos){
			$poststemp[] = $pos->id;
		}
		$current = array_search($id,$poststemp);
		$last = count($poststemp)-1;
		if($current == $last){
			$next = 'last';
		}else{
			$next = $poststemp[$current+1];
		}
		if($current == 0){
			$prev = 'first';
		}else{
			$prev = $poststemp[$current-1];
		}
		//自分の１つ前のpost_id


		//自分の１つ後のpost_id

		if (Auth::check()) {
			// ユーザーはログイン済み…
			$user = Auth::user();
			$userId = $user->id;
			//学習ステータス
			$study = Study::where('user_id', '=', $userId)->where('post_id', '=', $id)->orderBy('created_at','desc')->first();

			$statuestemp = Study::where('user_id','=',$userId)->where('status','=','1')->get();
			$statues = array();
			foreach($statuestemp as $status){
				$statues[] = $status->post_id;
			}


			//postsの該当カテゴリー一覧取得
			$posttemp = Post::where('category_id', '=', $category)->where('released', '=', '1')->get();
			$migakusyu = count($posttemp);
			$i=0;
			foreach($posttemp as $pos){

				$studytemp = Study::where('user_id','=', $userId)->where('post_id','=',$pos->id)->first();
				if(isset($studytemp->status)){
					if($studytemp->status == 1){
						$i++;
					}
				}
			}
			$studies =$i;
			//http://nazo.hatenablog.com/entry/2015/04/03/105948 参考に



			//公開済みのニュース
			//$news = News::where('open','=','1')->take(3)->latest()->get();
			$news = News::where('open','=','1')->where('created_at','<=',Carbon::now())->take(3)->latest()->get();

			//ピックアップニュース
			$pickup_news = DB::table('news')
					->where('open','=','1')
					->whereBetween('created_at',array(Carbon::now()->subMonth(2),Carbon::now()))

					->where('pickup','=','1')
					//->whereNotExists(function($query){
					->whereNotExists(function($query) use ($userId){
						//$query->select(DB::raw('id,news_id,user_id'))
						$query->select(DB::raw('*'))
							->from('news_users')
							->whereRaw('news_users.news_id = news.id')
							->whereRaw('news_users.user_id = '.$userId.'');
					})
					->orderBy('created_at', 'desc')
					->take(1)
					->get();

			return view( 'posts.lessonshow', compact('post', 'posts', 'study','studies','migakusyu','statues','next','prev','news','pickup_news','refer1','refer2','refer3','refer4') );

		}else{
			return view( 'posts.lessonshow', compact('post','posts','next','prev','refer1','refer2','refer3','refer4') );

		}
	}



	///ログインユーザー用///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function mypage(){
		$user = Auth::user();
		$userId = $user->id;
		$posts = Post::orderBy('title','asc')->get();

		$studied = Study::where('user_id','=', $userId)->where('status','=','1')->get();
		$studied =count($studied);

		$studyedcategory = array();
		//カテゴリーごと学習完了数を取得
		//$categories = Category::oldest('created_at')->get();
		$categories = Category::orderBy('number','asc')->get();
		//カテゴリーごとにループ
		foreach($categories as $category){

			//カテゴリー別のポスト一覧を取得
			$posttemp = Post::where('category_id', '=', $category->id)->where('released', '=', '1')->get();

			//該当カテゴリーの学習完了済みポストを取得
			$i = 0;
			$studydatetmp = array();
			foreach($posttemp as $pos){
				$studytemp = Study::where('user_id','=', $userId)->where('post_id','=',$pos->id)->where('status','=','1')->first();
				if(isset($studytemp)){
					$i++;
					$studydatetmp[] = $studytemp->created_at;
				}
			}
			if(!empty($studydatetmp)){
				$studyedcategory[] = array('id'=>$category->id,'category'=>$category->category,'studies'=>$i,'postcount'=>count($posttemp),'created_at'=>max($studydatetmp));
			}

		}

		if($studied != 0){
			//日付順に並び替え
			foreach ((array) $studyedcategory as $key => $value) {
				$sort[$key] = $value['created_at'];
			}
			array_multisort($sort, SORT_DESC, $studyedcategory);
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


		//学習日数の取得
		//$days = DB::table('accesses')->where('user_id','=', $userId)->distinct()->count()->DATE('starttime', 'Y-m-d');
		//->select('time_sheets.progress',DATE_FORMAT('time_sheets.date', "%d/%l/%Y") ,'role_users.role_id','roles.role_name');

		//          ->selectRaw("time_sheets.progress, DATE_FORMAT('time_sheets.date', '%d/%l/%Y') as date, role_users.role_id, roles.role_name");

		//$days = DB::selectRaw("count(distinct DATE_FORMAT('accesses.starttime', '%Y-%m-%d')) AS tmp_date")->where('user_id','=', $userId);

		$days = DB::table('accesses')
					->selectRaw('count(distinct DATE_FORMAT(starttime, "%Y-%m-%d")) as date')
					->where('user_id','=', $userId)
					->first();


		//公開済みのニュース
		//$news = News::where('open','=','1')->take(3)->latest()->get();
		$news = News::where('open','=','1')->where('created_at','<=',Carbon::now())->take(3)->latest()->get();

		$pickup_news = DB::table('news')
					->where('open','=','1')
					->whereBetween('created_at',array(Carbon::now()->subMonth(2),Carbon::now()))
					->where('pickup','=','1')
					//->whereNotExists(function($query){
					->whereNotExists(function($query) use ($userId){
						//$query->select(DB::raw('id,news_id,user_id'))
						$query->select(DB::raw('*'))
							->from('news_users')
							->whereRaw('news_users.news_id = news.id')
							->whereRaw('news_users.user_id = '.$userId.'');
							//->where('news_users.news_id','=','news.id');
							//->where('news_users.user_id','=','18');
							//->whereRaw('news_users.news_id = ? and news_users.user_id = ?', array('news.id','18'));
							//->whereRaw("news_users.news_id = ' news.id AND news_users.user_id = '".$userId."'");
					})
					->orderBy('created_at', 'desc')
					->take(3)
					->get();


		//ピックアップニュース
		//$pickups = News::where('open','=','1')->where('pickup','=','1')->take(1)->latest()->get();

		return view( 'posts.mypage', compact('categories','studied','studyedcategory','news','pickups','pickup_news','times','days') );
	}


	public function profile(){
		$user = Auth::user();
		return view('posts.profile', compact('user') );
	}
	public function nameupdate(PostRequest $request, $id){
		$user = Auth::user();
		$user->name = $request->name;
      	$post->save();
      	return redirect('/mypage/profile')->with('flash_message', 'Profile Updated!');
	}


	///管理者用///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function home(){

		// Temporarily increase memory limit to 256MB
		// 会員数7500人を超えたところで/admin/homeで500エラーが発生。メモリ不足のため一時的に変更する
        // 原因は下記コード
        //$completed = count(Study::where('status','=','1')->get());
        //↓変更し解消。
        //$completed = Study::where('status','=','1')->count();

		ini_set('memory_limit','256M');

		//正会員数
		$properusers = User::where('confirmation_token','=','')->count();

		//総会員数
		$users = User::count();

		//都道府県別会員数
		$todofu = DB::table('users')
			->select(DB::raw('todofu,count(*) as count'))
			->where('todofu','!=','')
			->groupBy('todofu')
			->orderBy('count','desc')
            ->get();

		//会員リスト
		$userlist = User::orderBy('id','desc')->take(30)->get();

		//会員別完了レッスン数
		$complesson = DB::table('users')
            ->join('studies', 'users.id', '=', 'studies.user_id')
			->select('studies.user_id',DB::raw('name,count(*) as count'))
			->where('status','=',1)
			->groupBy('users.id')
			->orderBy('count','desc')
            ->get();
        
		//会員別学習時間
		$time2 = DB::table('users')
            ->join('accesses', 'users.id', '=', 'accesses.user_id')
			->select('accesses.user_id',DB::raw('name,sum(times) as sum'))
			->groupBy('users.id')
			->orderBy('sum','desc')
			->take(30)
            ->get();
		//レッスンカテゴリー数
		$categories = Category::count();

		//レッスン数
		$posts = Post::count();

		//完了レッスン数
		$completed = Study::where('status','=','1')->count();


		return view( 'admin.home', compact('users','properusers','posts','categories','completed','todofu','userlist','complesson','time2') );
	}


	public function post(){
		$posts = Post::orderBy('title','asc')->get();
		$categories = Category::latest('number')->get();
		return view( 'admin.index', compact('posts','categories') );
	}

	public function show($id){
		$post = Post::findOrFail($id);
		if (Auth::check()) {
			// ユーザーはログイン済み…
			$user = Auth::user();
			$userId = $user->id;
			$category = $post->category_id;
			//学習ステータス
			$study = Study::where('user_id', '=', $userId)->where('post_id', '=', $id)->orderBy('created_at','desc')->first();


			//postsの該当カテゴリー一覧取得
			$posttemp = Post::where('category_id', '=', $category)->get();
			$migakusyu = count($posttemp);
			$i=0;
			foreach($posttemp as $pos){

				$studytemp = Study::where('user_id','=', $userId)->where('post_id','=',$pos->id)->first();
				if(isset($studytemp->status)){
					if($studytemp->status == 1){
						$i++;
					}
				}
			}
			$studies =$i;
			//http://nazo.hatenablog.com/entry/2015/04/03/105948 参考に

			//return view('posts.show',['post' => $post], ['statuses' => $statuses], ['study' => $study] );
			return view( 'admin.show', compact('post', 'study','studies','migakusyu') );

		}else{
			return view( 'admin.show', compact('post') );

		}
	}

	public function edit($id){
		$post = Post::findOrFail($id);
		$categories = Category::orderBy('number','desc')->get();
		return view('admin.edit',['post' => $post],['categories' => $categories]);
		//return view('posts.edit',['categories' => $categories]);
	}

	public function destroy($id){
		$post = Post::findOrFail($id);
		$post->delete();
		return redirect('/admin/lesson')->with('flash_message', 'Post Deleted!');
	}
	public function create(){
		$categories = Category::all();
		return view('admin.create',['categories' => $categories]);
	}

    public function store(PostRequest $request) {

      $post = new Post();
      $post->title = $request->title;
      $post->body = $request->body;
      $post->hosoku = $request->hosoku;
      $post->hosokutitle1 = $request->hosokutitle1;
      $post->hosoku1 = $request->hosoku1;
      $post->hosokutitle2 = $request->hosokutitle2;
      $post->hosoku2 = $request->hosoku2;
      $post->hosokutitle3 = $request->hosokutitle3;
      $post->hosoku3 = $request->hosoku3;
      $post->hosokutitle4 = $request->hosokutitle4;
      $post->hosoku4 = $request->hosoku4;
      $post->movie = $request->movie;
      $post->playtime = $request->playtime;
      $post->category_id = $request->category_id;
      $post->contents = $request->contents;
      $post->released = $request->released;
      $post->usersonly = $request->usersonly;
      $post->imageflag = $request->imageflag;
      $post->squareflag = $request->squareflag;
      $post->refer4 = $request->refer4;
      $post->refer3 = $request->refer3;
      $post->refer2 = $request->refer2;
      $post->refer1 = $request->refer1;
      $post->save();

	  //画像のアップ
	  $last_insert_id = $post->id;
	  $imagename = "";
	  if( $request->hasFile('lessonimage')){
			// アップロード画像を取得
			$image = $request->file('lessonimage');

			// ファイル名を生成し画像をアップロード
			$imagename = 'lessonshow'.$last_insert_id.'.'.$image->getClientOriginalExtension();
			$upload = $image->move('image', $imagename);
	  }



      return redirect('/admin/lesson')->with('flash_message', 'LESSON Added!');
    }

    public function update(EditRequest $request, $id) {


	  //画像のアップ
	  $imagename = "";
	  if( $request->hasFile('lessonimage')){
			// アップロード画像を取得
			$image = $request->file('lessonimage');

			// ファイル名を生成し画像をアップロード
			$imagename = 'lessonshow'.$id.'.'.$image->getClientOriginalExtension();
			$upload = $image->move('image', $imagename);
	  }

      $post = Post::findOrFail($id);
      $post->title = $request->title;
      $post->body = $request->body;
      $post->hosoku = $request->hosoku;
      $post->hosokutitle1 = $request->hosokutitle1;
      $post->hosoku1 = $request->hosoku1;
      $post->hosokutitle2 = $request->hosokutitle2;
      $post->hosoku2 = $request->hosoku2;
      $post->hosokutitle3 = $request->hosokutitle3;
      $post->hosoku3 = $request->hosoku3;
      $post->hosokutitle4 = $request->hosokutitle4;
      $post->hosoku4 = $request->hosoku4;
      $post->movie = $request->movie;
      $post->playtime = $request->playtime;
      $post->category_id = $request->category_id;
      $post->contents = $request->contents;
      $post->released = $request->released;
      $post->usersonly = $request->usersonly;
      $post->imageflag = $request->imageflag;
      $post->squareflag = $request->squareflag;
      $post->refer4 = $request->refer4;
      $post->refer3 = $request->refer3;
      $post->refer2 = $request->refer2;
      $post->refer1 = $request->refer1;
      $post->save();
      return redirect('/admin/lesson')->with('flash_message', 'Post Updated!');
    }

}
