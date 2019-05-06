<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
      //Middleware category
        $this->middleware('protect.category')->except(['index','show']);;
    } 

    public function index()
    {
        $categories = Category::all();
        return view ('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        //validate category requests

        $this->validate($request, [
            'name' => 'required|min:3', 
            'description' => 'required|max:500'
        ], [
            'name.min' => 'Името на категорията трябва да съдържа минимум три знака'
        ]);
        
        return redirect('citadel/category')->with('message', 'Създадена е нова категория');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $subcategories = Subcategory::all();
        return view ('categories.show', compact('category', 'subcategories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view ('categories.edit', compact('category'));
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
        $category = Category::find($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        //validate category requests

        $this->validate($request, [
            'name' => 'required|min:3', 
            'description' => 'required|max:500'
        ], [
            'name.min' => 'Името на категорията трябва да съдържа минимум три знака'
        ]);
        
        return redirect('citadel/category/')->with('message', 'Категорията е редактирана');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('citadel/category/')->with('message', 'Категория '.$category->name.' е изтрита!');
    }
}
