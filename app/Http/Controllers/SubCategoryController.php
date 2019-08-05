<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function review ($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return view ('subcategories.review', compact('category'));
    }

    public function addSubcategoryCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        
        return view ('subcategories.create', compact('category'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subcategory = Subcategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        //validate subcategory requests

        $this->validate($request, [
            'name' => 'required|min:3', 
            'description' => 'required|max:500'
        ], [
            'name.min' => 'Името на категорията трябва да съдържа минимум три знака'
        ]);
        $categoryId = $request->category_id;

        return redirect('/citadel/subcategory/'.$categoryId.'/review')->with('message', 'Създадена е нова подкатегория');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::all();

        return view ('subcategories.edit', compact('subcategory', 'categories'));
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
        $subcategory = Subcategory::find($id);

        $subcategory->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        //validate subcategory requests

        $this->validate($request, [
            'name' => 'required|min:3', 
            'description' => 'required|max:500'
        ], [
            'name.min' => 'Името на подкатегорията трябва да съдържа минимум три знака'
        ]);
        $categoryId = $request->category_id;
        $subcategoryName = $request->name;

        return redirect('/citadel/subcategory/'.$categoryId.'/review')->with('message', 'Подкатегория '.$subcategoryName.' е редактирана');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();

        return redirect()->back()->with('message', 'Податегория '.$subcategory->name.' е изтрита!');
    }
}
