<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Collection;

class Category extends Model
{
	use SoftDeletes;
    //category object include 3 properties: name, status, parent_id.
    protected $table = 'categories';
    protected $filltable = ['id','name', 'slug', 'status','parent_id'];
    protected $dates = ['deleted_at'];

    public function getId()
	{
    	return $this->id;
	}
    public function getName()
	{
    	return $this->name;
	}
	public function setName($value)
	{
    	$this->name = $value;
	}
    public function getSlug()
    {
        return $this->slug;
    }
    public function setSlug($value, $id)
    {
        if($id==null){
            $id = 0;
            try {
                $id = ++Category::all()->last()->id;       
            } catch (\Exception $e) {
                $id = ++$id;
            }       
            $value = strtolower(str_replace(" ","-",$value)).'/c'.$id;
            $this->slug = $value;
        }else{
            $value = strtolower(str_replace(" ","-",$value)).'/c'.$id;
            $this->slug = $value;
        }
    }      
	public function getStatus()
	{
    	return $this->status;
	}
	public function setStatus($value)
	{
    	$this->status = $value;
	}
	public function getParent_id()
	{
    	return $this->parent_id;
	}
	public function setParent_id($value)
	{
    	$this->parent_id = $value;
	}

	public static function getAllCategories(){
		$categoriesList = Category::all();
		return $categoriesList;
	}

	public static function getCategoryById($id){
		$category = Category::find($id);
		return $category;
	}

    public function createOrUpdateCategory(Category $category){
        if ($category->parent_id != -1) {
        	$category->save();         	
        }else{
        	$category->setParent_id(null);
        	$category->save(); 
        }            
    }

    public static function getAllCategoriesWithParentNames(){
    	$categoriesList = Category::getAllCategories(); 
    	foreach ($categoriesList as $category) {
    		foreach ($categoriesList as $category2) {
    			if($category->getParent_id()==$category2->getId()){
    				$category->setParent_id($category2->getName());
    			}
    		}
    	}
    	return $categoriesList;
    }

    public static function getCategoryParentName(Category $category){
    	$categoriesList = Category::getAllCategories(); 
    	foreach ($categoriesList as $item) {
    		if($category->parent_id==$item->id){
    			$category->parent_id=$item->name;
    		}
    	}
    	return $category;
    }
    //get all lower categories available for parent category
    public static function getAllChildsOfCategory($id, array $listChilds){
    	$categoriesList = Category::where('parent_id','=',$id)->where('id','<>',$id)->get();
    	foreach ($categoriesList as $item) {
    		array_push($listChilds,$item);
    		Category::getAllChildsOfCategory($item->id, $listChilds);
    	}
    	return $listChilds;
    }

    public static function getAvailableNamesCategory($id, array $listChilds){
    	$categoriesList = Category::where('id','<>',$id)->get();
    	$listParentCateogry = array();
    	$isChild = true;
    	if($listChilds==null){
            return $categoriesList;
        }else{
            foreach ($categoriesList as $category) {
                foreach ($listChilds as $categoryChild) {
                    if($category->id==$categoryChild->id){
                        $isChild = true;
                        break;
                    }else{
                        $isChild = false;
                        continue;
                    }
                }
                if ($isChild==false) {
                    array_push($listParentCateogry,$category);
                    $isChild = true;
                }
            }
        }
    	return $listParentCateogry;
    }

    public static function deleteCategoryById($id){
    	$category = Category::getCategoryById($id)->delete();
    }

    public static function hideChildCategoriesAfterDelete(array $listChilds){
    	foreach ($listChilds as $category) {
    		$category->setParent_id(null);
    		$category->setStatus(0);
    		$category->save();
    	}
    }

    public static function getRootCategories(){
        $categoriesList = Category::where('parent_id','=',null)->get();
        return $categoriesList;
    }
    //get lower categories available for parent category
    public static function getChildsOfCategory($id){
        $categoriesList = Category::where('parent_id','=',$id)->where('id','<>',$id)->get();
        return $categoriesList;
    }
    //get name for breadcrum
    public static function getNameBreadcrum($id, array $listChilds){
        $category = Category::getCategoryById($id);
        array_push($listChilds,$category);
        while ($category->parent_id!=null) {            
            $category = Category::getCategoryById($category->parent_id);
            array_push($listChilds,$category);
        }
        $length=count($listChilds);
        for ($i=0; $i < count($listChilds) ; $i++) { 
            if($length!=1){
                $temp = $listChilds[$i];
                $listChilds[$i] = $listChilds[$length-1];
                $listChilds[$length-1] = $temp;
            }
            $length = --$length;
        }
        return $listChilds;
    }
}
