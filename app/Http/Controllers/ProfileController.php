<?php

namespace App\Http\Controllers;

use App\User;
use App\Department;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // dd(auth()->id());
       $departments = Department::all();
        $user = User::find(auth()->id());
        return view('profile.edit', compact('user', 'departments'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $user = User::find($id);
        
        if($request->profile == 'info')
        {
            $data = request()->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required',
                'department_id' => 'required',
            ]);

            $msg = 'Profile data successfully updated.';
        }
        elseif($request->profile == 'password')
        {
            $data = request()->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed|min:6|different:current_password',
                'password_confirmation' => 'required',
            ]);
    
    
            if(Hash::check($request->get('current_password'), $user->password)){
                $data = ['password' => Hash::make($request->get('password'))];

                $msg = 'Password successfully changed.';
            }
            else{
                $msg = 'Invalid current password entered!';
            }
            
        }
        else
        {
            $data = request()->validate([
                'image' => 'sometimes|file|image|max:5000',
            ]); 
                  

    
            $msg ='Profile Image uploaded successfully.';
            

           //return back()->withStatus(__($msg)); 
        }
      //  dd($data);
        
        $user->update($data);
        $this->storeImage();

        return back()->withStatus(__($msg)); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function storeImage()
    {
        if(request()->has('image')){
            auth()->user()->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);
            //dd(auth()->user()->image);

            $image = Image::make(('storage/'. auth()->user()->image))->fit(300, 300);
               // dd(public_path('storage/'. auth()->user()->image));
            $image->save();
        }
    }
}
