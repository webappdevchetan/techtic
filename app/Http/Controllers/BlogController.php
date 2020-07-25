<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Comment;
class BlogController extends Controller
{
    //

    public function create(){
        return view('blog.create');
    }

    public function store(Request $request){
        
        $this->validate($request, [
            'title' => 'required|unique:blogs',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required',
        ]);
        $data = $request->except(['_token']);
        $data['slug'] = str_slug($data['title']);
        $data['user_id'] = \Auth::user()->id;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $real_name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $path = $file->getPathName();
            $dir = public_path() . '/Blogs';
            $old = umask(0);
            \File::exists($dir) or mkdir($dir, 0777, true);
            umask($old);
            $file->move($dir, $real_name);
            $data['image'] = $real_name;
        }
        $blog = Blog::create($data);
        \Session::flash('flash_message', 'Blog added!');
        return redirect('/home');
    }

    public function detail($slug){
        $blog = Blog::where('slug', '=', $slug)->firstOrFail();
        return view('blog.view', compact('blog'));
    }
    public function storeComment(Request $request){
        
        $this->validate($request, [
            'comment' => 'required',
        ]);
        $data = $request->except(['_token']);
        $data['user_id'] = \Auth::user()->id;
        
        $comment = Comment::create($data);
        \Session::flash('flash_message', 'Comment added!');
        return redirect()->back();
    }

    public function deleteComment($id){
        
       $comment = Comment::find($id);
       if(\Auth::user() && $comment->id === \Auth::user()->id){
            $comment->delete();
            \Session::flash('flash_message', 'Comment delete successfully!');
            return redirect()->back();
       }else{
            \Session::flash('flash_error', 'Comment can not be delete, You are not authorised to delete!');
            return redirect()->back();
       }
    }
}
