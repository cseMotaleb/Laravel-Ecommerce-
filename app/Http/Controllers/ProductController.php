<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller{
    public function index(){
    	return view('admin.add_product');
    }


public function save_product(Request $request){
      $data=array();
        $data['product_name']=$request->product_name;
        $data['category_id']=$request->category_id;
        $data['brand_id']=$request->brand_id;
        $data['product_short_description']=$request->product_short_description;
        $data['product_long_description']=$request->product_long_description;
        $data['product_price']=$request->product_price;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;
        $data['pub_status']=$request->pub_status;     
      $image=$request->file('product_image');
    if ($image) {
       $image_name=str_random(20);
       $ext=strtolower($image->getClientOriginalExtension());
       $image_full_name=$image_name.'.'.$ext;
       $upload_path='image/';
       $image_url=$upload_path.$image_full_name;
       $success=$image->move($upload_path,$image_full_name);
       if ($success) {
         $data['product_image']=$image_url;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Product added successfully!!');
            return Redirect::to('/add-product');
         // echo "<pre>";
         // print_r($data);
         // echo "</pre>";
         // exit();
            
       }
    }
    $data['product_image']='';
            DB::table('tbl_product')->insert($data);
            Session::put('message','product added successfully without image!!');
            return Redirect::to('/add-product');
   }


	public function all_product()
	 {
	  
       $all_product_info=DB::table('tbl_product')
                     ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
                     ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
                     ->select('tbl_product.*','tbl_category.category_name','tbl_brand.brand_name')
                     ->get();
                  
    $manage_product=view('admin.all_product')
               ->with('all_product_info',$all_product_info);
       return view('admin_layout')
               ->with('admin.all_product',$manage_product); 
                       
	 }

   public function unactive_product($product_id)
   {
         DB::table('tbl_product')
              ->where('product_id',$product_id)
              ->update(['pub_status' => 0]);
          Session::put('message','Product Unactive successfully !! ');
              return Redirect::to('/all-product');
   }

   public function active_product($product_id)
   {
         DB::table('tbl_product')
              ->where('product_id',$product_id)
              ->update(['pub_status' => 1]);
          Session::put('message','Product Active successfully !! ');
              return Redirect::to('/all-product');
   }

    public function delete_product($product_id)
    {  
    	
    	DB::table('tbl_product')
    	    ->where('product_id',$product_id)
    	    ->delete();
    	Session::get('message','Product Deleted successfully! ');
    	return Redirect::to('/all-product');    
    }

    public function edit_product($product_id)
    {  
        $product_info=DB::table('tbl_product')
                     ->where('product_id',$product_id)
                     ->first();
       $product_info=view('admin.edit_product')
                ->with('product_info',$product_info);
       return view('admin_layout')
                ->with('admin.edit_product',$product_info);
    }

     public function update_product(Request $request,$product_id)
    {
        $data=array();
        $data['product_name']=$request->product_name;
        $data['category_id']=$request->category_id;
        $data['brand_id']=$request->brand_id;
        $data['product_short_description']=$request->product_short_description;
        $data['product_long_description']=$request->product_long_description;
        $data['product_price']=$request->product_price;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;
        $image=$request->file('product_image');
        if ($image) {
       $image_name=str_random(20);
       $ext=strtolower($image->getClientOriginalExtension());
       $image_full_name=$image_name.'.'.$ext;
       $upload_path='image/';
       $image_url=$upload_path.$image_full_name;
       $success=$image->move($upload_path,$image_full_name);
       if ($success) {
        $data['product_image']=$image_url;
        DB::table('tbl_product')->insert($data);
        Session::put('message','Product added successfully!!');
         return Redirect::to('/add-product');
         // echo "<pre>";
         // print_r($data);
         // echo "</pre>";
         // exit();
            
       }else{

       }
    }
       /* echo "<pre>";
         print_r($data);
        echo "</pre>";*/
          DB::table('tbl_brand')
           ->where('brand_id',$brand_id)
            ->update($data);

             Session::get('message','Brand update successfully !');
           return Redirect::to('/all-brand');
    }
}
