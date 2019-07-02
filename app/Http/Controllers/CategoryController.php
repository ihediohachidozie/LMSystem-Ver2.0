<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
            $categories = Category::paginate(10);
            return view('category.index', compact('categories') );
        }
        return back();  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->id() == 1)
        {
            $category = new Category();
            return view('category.create', compact('category'));
        }
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->id() == 1)
        {
            $data = request()->validate([
                'category' => 'required',
                'days' => 'required|max:30|min:1',
            ]);
            $category = Category::create($data);
    
            return redirect('category')->withStatus(__('Category successfully saved.'));
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if(auth()->id() == 1)
        {
            return view('category.edit', compact('category'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if(auth()->id() == 1)
        {
            $data = request()->validate([
                'category' => 'required',
                'days' => 'required|max:30|min:1',
            ]);
            $category->update($data);
    
            return redirect('category')->withStatus(__('Category successfully updated.'));
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(auth()->id() == 1)
        {
             $category->delete();
 
             return redirect('category')->withStatus(__('Category successfully deleted.'));
        }
        return back();
    }
}
