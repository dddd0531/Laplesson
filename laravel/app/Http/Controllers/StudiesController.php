<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Study;
use App\Post;

class StudiesController extends Controller
{
	public function store(Request $request,$userId,$postId){
	//public function store(Request $request, $postId, $userId){
    /*  $study = new Study();
      $study->user_id = $userId;
      $study->post_id = $postId;
	  $study->status_id = $request->status_id;
      $study->save();
	  */
	  
	  /*
	  $study = Study::firstOrNew(['user_id' => $userId],['post_id' => $postId]);
      $study->user_id = $userId;
      $study->post_id = $postId;
	  $study->status_id = $request->status_id;
      $study->save();
	  */
	  	$user = $userId;
	  	$post = $postId;
	  	//$category = $request->category_id;
	  	$status = $request->status;
	  
		if ( count(Study::where('user_id', '=', $user)->where('post_id', '=', $post)->get()) == 0 ) {
			  // 新規作成処理
			  $study = new Study();
			  $study->user_id =  $user;
			  $study->post_id =  $post;
			  //$study->category_id =  $category;
			  $study->status = $status;
			  $study->save();
		} else {
			  // アップデート処理
			  Study::where('user_id', '=', $userId)->where('post_id', '=', $postId)->update(['status' => $status]);
		}
		
      return redirect('/lesson/'.$postId);
		
		
		
	}
	
	public function storeStatus(Request $request){
	  	$user = $request->user_id;
	  	$post = $request->post_id;
	  	$status = $request->status;
	  	$category = $request->category_id;
		
		if ( count(Study::where('user_id', '=', $user)->where('post_id', '=', $post)->get()) == 0 ) {
		  $study = new Study();
		  $study->user_id =  $user;
		  $study->post_id =  $post;
		  $study->status = $status;
		  $study->save();
		} else {
			  // アップデート処理
			  Study::where('user_id', '=', $user)->where('post_id', '=', $post)->update(['status' => $status]);
		}
		
		
		//ステータスの集計
		$posttemp = Post::where('category_id', '=', $category)->where('released','=','1')->get();
		$migakusyu = count($posttemp);
		$i=0;
		foreach($posttemp as $pos){
			
			$studytemp = Study::where('user_id','=', $user)->where('post_id','=',$pos->id)->first();   	
			if(isset($studytemp->status)){
				if($studytemp->status == 1){
					$i++;
				}
			}
		}
		$studies =$i;
		
			
		return response()->json([
			'studies' => $studies,
			'migakusyu' => $migakusyu - $studies,
			'status' => $status
			]);
	}
	
	
	
}
