<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Laravolt\Mural\Comment;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post_count = Post::all()->count();
        $category_count = Category::all()->count();
        $user_count = User::where('email','!=','sabieh.ahmed@gmail.com')->latest()->count();
        $comments =collect();
        return view('admin.dashboard')->with(['post_count'=>$post_count,
            'category_count'=>$category_count,'user_count'=>$user_count,'comments'=>$comments]);
    }


    /**
     * 
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function approveComment(Request $request,$id)
    {
//        $comment = Comment::findOrFail($id);
//        $comment->is_approved = true;
//        $comment->save();
        return redirect('/admin/dashboard')->withSuccess('Comment Has Been Approved.');
    }


    public function deleteComment(Request $request,$id)
    {
//        $comment = Comment::findOrFail($id);
//        $comment->delete();
        return redirect('/admin/dashboard')->withSuccess('Comment Has Been Deleted.');
    }

}
