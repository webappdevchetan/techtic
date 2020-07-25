<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogs = Blog::where('user_id',\Auth::user()->id)->orderBy('id','desc')->get();
        return view('home',compact('blogs'));
    }
    
    public function welcome(){
        $blogs = Blog::orderBy('id','desc')->get();
        return view('welcome',compact('blogs'));
    }
}
