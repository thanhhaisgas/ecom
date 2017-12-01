<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Category;
use App\Product_To_Category;
use App\Product_Attribute;
use Storage;
use Object;
use App\Image;

use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Eloquent\EloquentProductRepository;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function index()
    {
       $product_list = Product::getAll();
       return view('layouts.admin.product.list')->with('product_list',$product_list);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category_list = Category::all();
        return view('layouts.admin.product.add')->with('category_list',$category_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {   
    
     //insert product
    $product = new Product;
    $product->setName($request->name);
    $product->setPrice($request->price);
    $product->setInfo($request->info);
    $product->setOverview($request->overview);
    $product->setLink(changeTitle($request->name));
    $product->setInventory($request->inventory);
    $product->setStatus($request->status);
    $product->CreateOrUpdateProduct($product);

      //get file from form
          foreach($request->file('file') as $item){
            $stringrand=str_random(6);
            $images[] =$stringrand.$item->getClientOriginalName();
            //move file
             Storage::put($stringrand.$item->getClientOriginalName(), file_get_contents($item)); 
        }  
        

        //insert product_to_category
        $product_to_category = new Product_To_Category;
        $product_to_category->setProduct_id(Product::getByIdProductLast()->getId());
        $product_to_category->setCategory_id($request->category_id);
        $product_to_category->CreateProduct_To_Category($product_to_category);

        //insert image
        $image = new Image;
        $image->setProduct_id(Product::getByIdProductLast()->getId());
        $image->Image_Create_Many($images);
       
       return redirect('administrator/product');  
        
        
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
        //
        
        return view('layouts.admin.product.edit')
        ->with([
            'product_edit'=>Product::getByIdProduct($id),
            'attribute'=>Product_Attribute::getByIdAttribute($id),
          
            ]);
        
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
        
       $product_edit = Product::getByIdProduct($id);
       $product_edit->setName($request->name);
       $product_edit->setPrice($request->price);
       $product_edit->setInfo($request->info);
       $product_edit->setOverview($request->overview);
       $product_edit->setLink(changeTitle($request->name));
       $product_edit->setInventory($request->inventory);
       $product_edit->setStatus($request->status);
       $product_edit->CreateOrUpdateProduct($product_edit);
        return redirect('administrator/product');
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
   
        $filename = Image::getByImageProduct_id($id);
        foreach($filename as $item){
           Storage::delete($item['url']);
        }
        Image::DeleteImageProduct_id($id);
        Product_To_Category::DeleteProduct_To_Category($id);
        Product_Attribute::DeleteAttributeProduct_id($id);
        Product::DeleteProduct($id);
        return redirect('administrator/product');
    }
}
