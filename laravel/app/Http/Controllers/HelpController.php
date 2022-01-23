<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Help;


class HelpController extends Controller
{
	
	
	public function helpshow($id){
		$help1 = Help::findOrFail($id);
		return view( 'posts.helpshow', compact('help1') );			
		
	}
	
	
	
	
	//管理画面
	public function help(){
		$helps = Help::latest()->get();
		return view( 'admin.help', compact('helps') );			
	}	


	public function create(){
		return view('admin.helpcreate');
	}	
	
	public function edit($id){
		$helps = Help::findOrFail($id);
		return view( 'admin.helpedit', compact('helps') );			
	}
	
	public function destroy($id){
		$helps = Help::findOrFail($id);
		$helps->delete();
		return redirect('/admin/help')->with('flash_message', 'Help Deleted!');
	}


    public function store(Request $request) {

      $helps = new Help();
      $helps->question = $request->question;
      $helps->answer = $request->answer;
      $helps->open = $request->open;
      $helps->category = $request->category;
      $helps->save();
      return redirect('/admin/help')->with('flash_message', 'help Added!');
    }	

    public function update(Request $request, $id) {
      $helps = Help::findOrFail($id);
      $helps->question = $request->question;
      $helps->answer = $request->answer;
      $helps->open = $request->open;
      $helps->category = $request->category;
      $helps->save();
      return redirect('/admin/help')->with('flash_message', 'helps Updated!');
    }




}
