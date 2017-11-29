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
        //get all categories to list      
        $categoriesList = Category::all();
        
        //get all name of parent for each category in list  
        $parentNames = array();
        foreach ($categoriesList as $item) {
            if ($item->parent_id==null) {
                array_push($parentNames, "");
            }else{
                $category = Category::find($item->parent_id);
                array_push($parentNames, $category->name);
            }
        }        
        return view('layouts.admin.category.list')->with(['categoriesList'=>$categoriesList,'parentNames'=>$parentNames]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('layouts.admin.category.add_edit')->with(['name'=>"Add",'categories'=>$categories,'action'=>0]);
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
        $category = new category;
        $category->name = $request->categoryname;
        $category->status = $request->cbStatus;
        if (isset($_POST['categoryParent'])&&$_POST['categoryParent']!=-1) {
            $parent = $_POST['categoryParent'];        
            $category->parent_id = $parent;
        }
        $category->save();
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
        //find category
        $item = Category::find($id);
        //check logic and edit
        $categoriesList = Category::where('id','<>',$id)->where(function($query) use ($id){
            $query->where('parent_id','=',null)->orwhere('parent_id','<>',$id);
        })
        ->get();
        foreach ($categoriesList as $value) {
               if($item->parent_id!=null && $item->parent_id==$value->id){
                    $item->parent_id = $value->name;
               }
        }   
        return view('layouts.admin.category.add_edit')->with(['name'=>"Update",'categories'=>$categoriesList,'action'=>1,'item'=>$item]);
        
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
        //update category information
        $category = Category::find($id);
        $category->name = $request->categoryname;
        $category->status = $request->cbStatus;
        if (isset($_POST['categoryParent'])&&$_POST['categoryParent']!=-1) {
            $parent = $_POST['categoryParent'];        
            $category->parent_id = $parent;
        }else{
            $category->parent_id = null;
        }
        $category->save();
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
}
