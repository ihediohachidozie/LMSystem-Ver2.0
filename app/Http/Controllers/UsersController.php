<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserActivation;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth'); // locking all parts
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->id() == 1)
        {
            $users = User::where('id', '>', '1')->paginate(6);
            return view('users.index', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(auth()->id() == 1)
        {
            $categories = Category::all();
            return view('users.edit', compact('user', 'categories'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(auth()->id() == 1)
        {
            if($request->has('password'))
            {
                $data = ['password' => Hash::make($request->get('password'))];

                $user->update($data);
        
                return redirect('users')->withStatus(__('User password reset successfully to "password"'));
            }else
            {
                $data = request()->validate([
                    'category_id' => 'sometimes',
                    'permission' => 'sometimes',
                ]);
                $user->update($data);

                // send an email to the user

                $when = now()->addMinutes(10);
 
                Mail::to($user->email)->later($when, new UserActivation($user));
    
                return redirect('users')->withStatus(__('User data successfully updated.'));
            }


        }
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(auth()->id() == 1)
        {
              $user->delete();
  
              return redirect('users')->withStatus(__('User successfully deleted.'));
        }
        return back();
    }
}
