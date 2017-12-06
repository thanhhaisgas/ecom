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
        $category->setSlug($request->categoryname, null);
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
        $category = Category::getCategoryParentName(Category::find($id));
        //check logic
        $categoriesList = array();
        $categoriesList = Category::getAvailableNamesCategory($id, Category::getAllChildsOfCategory($id, $categoriesList));
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
        $category->setSlug($request->categoryname, $id);
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
        $categoriesList = Category::getAllChildsOfCategory($id,$categoriesList);
        Category::hideChildCategoriesAfterDelete($categoriesList);
        Category::deleteCategoryById($id);
        return redirect('administrator/category');
    }

    private function create_view($view, array $param){
        return view($view, $param);
    }
}
