<?php

namespace App\Http\Controllers\ProductListDetail;

use App\Product_Attribute;
use App\Product_To_Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Image;

class ViewController extends Controller
{
    //
    public function setViewListing($slug, $id, $numPage){
        //setup category and breadcrum
        $listCategories = Category::getChildsOfCategory($id);
        //print_r($listCategories);
    	$listBreadcrum = array();
    	$listBreadcrum = Category::getNameBreadcrum($id, $listBreadcrum);
        //get all products belong to this category
        $tempProductsList = Product::getProductsInCategory($id);
        //pagination
        $totalProducts = count($tempProductsList);
        $totalPage = ceil($totalProducts/9);
        $productsList = Product::getPaginationProducts($tempProductsList, $numPage);
        //setView
    	$param = array('categoriesList'=>$listCategories, 'listBreadcrum'=>$listBreadcrum, 'listProducts'=>$productsList, 'totalPage'=>$totalPage, 'idCategory'=>$id, 'currentPage'=>$numPage);
    	return $this->createView("layouts.slug_layout", $param);
    }

    public function setViewHome($numPage){
        //setup category and breadcrum
    	$listCategories = Category::getRootCategories();
        //get all products
        $tempProductsList = array();
        foreach (Product::getAll() as $product) {
            array_push($tempProductsList, $product);
        }
        //pagination
        $totalProducts = count($tempProductsList);
        $totalPage = ceil($totalProducts/9);
        $productsList = Product::getPaginationProducts($tempProductsList, $numPage);
        //setView
    	$param = array('categoriesList'=>$listCategories,'listBreadcrum'=>null, 'listProducts'=>$productsList, 'totalPage'=>$totalPage, 'currentPage'=>$numPage);
    	return $this->createView("layouts.home", $param);
    }

    public function setViewProductDetail($productName, $id){
        $product = Product::getByIdProduct($id);
        $listBreadcrum = array();
        $idCategory = Product_To_Category::getCategoryIdByProductId($id);
        $listBreadcrum = Category::getNameBreadcrum($idCategory, $listBreadcrum);
        $listSizes = Product_Attribute::getAttributeByProductId($id, 'Size');
        $listColors = Product_Attribute::getAttributeByProductId($id, 'Color');
        $param = array('product'=>$product, 'listBreadcrum'=>$listBreadcrum, 'listSizes'=>$listSizes, 'listColors'=>$listColors);
        return $this->createView("layouts.product_detail", $param);
    }

    private function createView($view, array $param){
        return view($view, $param);
    }
}
