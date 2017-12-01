<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product_Attribute;
class AjaxController extends Controller
{
    //
    public function Post_Insert_Value_List(Request $request){
       // 
       $attribute_list  = Product_Attribute::where('product_id',$request->id)->get()->toJson();
        return $attribute_list;
    }


    
    public function Post_Insert_Value(Request $request){
        
            $attribute_add = new Product_Attribute;
            $attribute_add->name=$request->key;
            $attribute_add->value = $request->value;
            $attribute_add->product_id=$request->id;
            $attribute_add->save();
           
      

  
   }
}
