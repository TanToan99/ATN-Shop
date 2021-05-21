<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Comment;

class CommentController extends Controller
{
    public function index()
    {
    	$comments = Comment::orderBy('id', 'desc')->paginate(3);
    	return view('admin.comments.index', compact('comments'));
    }

    public function approve($id)
    {
    	DB::table('comments')
			->where("comments.id", '=',  $id)
			// dd(DB::table('comments')
			// ->where("comments.id", '=',  $id)->first());
			->update(['comments.active'=> 1]);
		return redirect()->route('comments.index');
    }	

    public function remove($id)
    {
    	DB::table('comments')
			->where("comments.id", '=',  $id)
			// dd(DB::table('comments')
			// ->where("comments.id", '=',  $id)->first());
			->update(['comments.active'=> 2]);
		return redirect()->route('comments.index');
    }	

    public function show($id)
    {
    	$comment = Comment::find($id);
    	return view('admin.comments.detail', compact('comment'));
    }	


    public function create(Request $request)
    {
        $data = $request->all();
        Comment::create($data);
        $request->session()->flash('status', 'Bình luận thành công!');
        return back();
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $comments = Comment::where('name', 'LIKE', "%$search%")->orderBy('id', 'desc')->paginate(3);
        return view('admin.comments.search', compact('comments'));
    }    
}
