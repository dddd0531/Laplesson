<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Status;
use App\Http\Requests\StatusRequest;

class StatusesController extends Controller
{
	public function index(){
		$statuses = Status::oldest('created_at')->get();
		return view('admin.status',['statuses' => $statuses]);	
	}

	public function create(){
		return view('admin.statuscreate');	
	}

	public function edit($id){
		$status = Status::findOrFail($id);
		return view('admin.statusedit',['status' => $status]);	
	}

	public function destroy($id){
		$status = Status::findOrFail($id);
		$status->delete();
		return redirect('/admin/status')->with('flash_message', 'Status Deleted!');
	}

	public function store(StatusRequest $request) {
		$status = new Status();
	      	$status->status = $request->status;
	      	$status->save();
	      	return redirect('/admin/status')->with('flash_message', 'Status Added!');
	}

	public function update(StatusRequest $request, $id) {
	      	$status = Status::findOrFail($id);
	      	$status->status = $request->status;
	      	$status->save();
	      	return redirect('/admin/status')->with('flash_message', 'Status Updated!');
	}

}
