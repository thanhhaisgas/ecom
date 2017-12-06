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

        //show all categories as a list
        $categoriesList = Category::getAllCategoriesWithParentNames();   
        $param = array('categoriesList'=>$categoriesList);
        return $this->create_view('layouts.admin.category.list', $param);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::getAllCategories();
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
        $category->setName($request->categoryname);
        $category->setStatus($request->cbStatus);
        $category->setParent_id($request->categoryParent);
        $category->createOrUpdateCategory($category);
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
        $categoriesList = array();
        $categoriesList = Category::getAvailableNamesCategory($id, Category::getChildOfCategory($id, $categoriesList));
        $param = array('name'=>'Update','categories'=>$categoriesList,'action'=>1,'item'=>$category);        
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
        $category = Category::getCategoryById($id);
        $category->setName($request->categoryname);
        $category->setStatus($request->cbStatus);
        $category->setParent_id($request->categoryParent);
        $category->createOrUpdateCategory($category);
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
        $categoriesList = array();
        $categoriesList = Category::getChildOfCategory($id,$categoriesList);
        Category::hideChildCategoriesAfterDelete($categoriesList);
        Category::deleteCategoryById($id);
        return redirect('administrator/category');
    }

    public function create_view($view, array $param){
        return view($view, $param);
    }
}
