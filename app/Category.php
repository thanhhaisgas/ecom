<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Collection;

class Category extends Model
{
    //category object include 3 properties: name, status, parent_id.
    protected $table = 'categories';
    protected $filltable = ['id','name','status','parent_id'];

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

    public function create_category(Request $req){
        $this->setName($req->categoryname);
        $this->setStatus($req->cbStatus);
        $this->setParent_id($req->categoryParent);
        $this->save();
    }

    public function update_category(Category $category, Request $req){
        $category->setName($req->categoryname);
        $category->setStatus($req->cbStatus);
        if ($req->categoryParent != -1) {
        	$category->setParent_id($req->categoryParent);        	
        }else{
        	$category->setParent_id(null);
        }
        $category->save();        
    }

    public function getParentNames(\Illuminate\Database\Eloquent\Collection $categoriesList){ 
    	foreach ($categoriesList as $category) {
    		foreach ($categoriesList as $category2) {
    			if($category->getParent_id()==$category2->getId()){
    				$category->setParent_id($category2->getName());
    			}
    		}
    	}
    	return $categoriesList;
    }
}
