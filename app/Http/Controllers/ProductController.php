<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Category;
use App\Product_To_Category;
use App\Product_Attribute;
use Storage;
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
     private $product;
    public function __construct(ProductRepository $product){
        $this->product=$product;
    }


    public function index()
    {
       $product_list = $this->product->getAll();
       // $first = $this->product->getByIdFirst('id');
 
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
        // request data from form
        try{ 
            $array_product = [
                'name'=>$request->name,
                'price'=>$request->price,
                'info'=>$request->info,
                'overview'=>$request->overview,
                'link'=>changeTitle($request->name),
                'inventory'=>$request->inventory,
                'status'=>$request->cbright,
            ];

            //imsert
        $product_add = $this->product->createProduct($array_product,'id',$request->cbcategory,$request->file('file'));

        return redirect('administrator/product');

        }catch(\Exception $e){
            return redirect('administrator/product')->with('error_insert','Something wrong ...');
        }
        
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
        $attribute  = Product_Attribute::where('product_id',$id)->get();
        $product_edit = Product::find($id);
        return view('layouts.admin.product.edit')->with(['product_edit'=>$product_edit,'attribute'=>$attribute]);
        
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
        //
        $product_edit = Product::find($id);
        $product_edit->name = $request->name;
        $product_edit->price = $request->price;
        $product_edit->link = changeTitle($request->name);
        $product_edit->overview = $request->overview;
        $product_edit->inventory = $request->inventory;
        $product_edit->status=$request->cbright;
        $product_edit->save();
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
        $product = Product::find($id);
        $product_to_category = Product_To_Category::where('product_id',$id);
        $image = Image::where('product_id',$id);
        $attribute = Product_Attribute::where('product_id',$id);
        $filename = Image::where('product_id',$id)->get()->toArray();
        //foreach($filename as $item){
        //    Storage::disk('public')->delete($item['url']);
        //}
        $image->delete();
        $product_to_category->delete();
        $attribute->delete();
        $product->delete();
        return redirect('administrator/product');
    }
}
