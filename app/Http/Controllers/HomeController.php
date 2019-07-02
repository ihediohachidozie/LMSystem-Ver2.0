<?php

namespace App\Http\Controllers;

use App\Leave;
use App\User;
use App\Department;
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
        $users = User::all()->count();
        $departments = Department::all()->count();
        $leaves = Leave::where('status', '=', '2')->count();
        $pending = Leave::where(['user_id' => auth()->id(), 'status' => '0'])->count();
        return view('home', compact('pending', 'users', 'leaves', 'departments'));
    }
}
