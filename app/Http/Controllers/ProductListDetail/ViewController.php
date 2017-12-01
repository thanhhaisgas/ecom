<?php

namespace App\Http\Controllers\ProductListDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class ViewController extends Controller
{
    //
    public function setView($slug, $id){
    	$listCategories = Category::getChildsOfCategory($id);
    	$listBreadcrum = array();
    	$listBreadcrum = Category::getNameBreadcrum($id, $listBreadcrum);
    	$param = array('categoriesList'=>$listCategories, 'listBreadcrum'=>$listBreadcrum);
    	return $this->createView("layouts.slug_layout", $param);
    }

    public function setViewHome(){
    	$listCategories = Category::getRootCategories();
    	$param = array('categoriesList'=>$listCategories,'listBreadcrum'=>null);
    	return $this->createView("layouts.slug_layout", $param);
    }

    private function createView($view, array $param){
        return view($view, $param);
    }
}
