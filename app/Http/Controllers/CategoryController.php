<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show all categories as a list
        $category = new Category;   
        $param = array('categoriesList'=>$category->getParentNames(Category::all()));
        return $this->create_view('layouts.admin.category.list', $param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $param = array('name'=>'Add', 'categories'=>$categories, 'action'=>0);
        return $this->create_view('layouts.admin.category.add_edit',$param);
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
        $category = new Category;
        $category->create_category($request);
        return redirect('administrator/category');
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
        //get current category
        $category = Category::find($id);
        //check logic
        $categoriesList = Category::where('id','<>',$id)->where(function($query) use ($id){
            $query->where('parent_id','=',null)->orwhere('parent_id','<>',$id);
        })
        ->get();
        $param = array('name'=>'Update','categories'=>$category->getParentNames($categoriesList),'action'=>1,'item'=>$category);        
        return $this->create_view('layouts.admin.category.add_edit',$param);        
    }
    //Repository

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //update category information
        $category = Category::find($id);
        $category->update_category($category, $request);
        return redirect('administrator/category');

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
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('administrator/category');
    }

    public function create_view($view, array $param){
        return view($view, $param);
    }
}
