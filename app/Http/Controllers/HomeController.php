<?php

namespace App\Http\Controllers;

use App\Leave;
use App\User;
use App\Department;
use App\Comment;
use App\Category;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('id', '<>', '1')->count();
        $departments = Department::all()->count();
        $leaves = Leave::where('status', '=', '2')->count();
        $pending = Leave::where(['user_id' => auth()->id(), 'status' => '1'])->count();
        $request = Leave::where(['approval_id' => auth()->id(), 'status' => '1'])->count();
        $comments = Comment::where('user_id', auth()->id())->orderBy('id', 'DESC')->get();
        return view('home', compact('pending', 'users', 'comments', 'request', 'departments'));
    }
}
