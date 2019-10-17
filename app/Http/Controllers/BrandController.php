<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandController extends Controller
{
    public function index(){
    	return view('admin.add_brand');
    }
    public function save_brand(Request $request){
    	$data=array();
        $data['brand_id'] = $request->brand_id;
        $data['brand_name'] = $request->brand_name;
        $data['brand_description'] = $request->brand_description;
        $data['pub_status'] = $request->pub_status;
      
        DB::table('tbl_brand')->insert($data);
        Session::put('message', 'Brand Add Successfull !!');
        return Redirect::to('/add-brand');
    }
     public function all_brand(){
        $all_brand_info=DB::table('tbl_brand')->get();
        $manage_brand=view('admin.all_brand')
        ->with('all_brand_info', $all_brand_info);
        return view('admin_layout')
        ->with('admin.tbl_brand', $manage_brand);
        /*return view('admin.all_category');*/

        }

        public function delete_brand($brand_id){
        DB::table('tbl_brand')
        ->where('brand_id',$brand_id)
        ->delete();
        Session::get('message', 'Brand Delete Successfully !');
        return Redirect::to('/all-brand');

    }

    public function unactive_brand($brand_id){
        DB::table('tbl_brand')
        ->where('brand_id', $brand_id)
        ->update(['pub_status'=>0]);
        Session::put('message', 'Brand Uncative Successfull !!');
        return Redirect::to('all-brand');

    } 

     public function active_brand($brand_id){
        DB::table('tbl_brand')
        ->where('brand_id', $brand_id)
        ->update(['pub_status'=>1]);
        Session::put('message', 'Brand Active Successfull !!');
        return Redirect::to('all-brand');

    } 
     public function edit_brand($brand_id){
        $category_info=DB::table('tbl_brand')
        ->where('brand_id', $brand_id)
        ->first();
        $category_info=view('admin.edit_brand')
        ->with('brand_info', $category_info);
        return view('admin_layout')
        ->with('admin.edit_brand', $category_info);
        /*return view('admin.edit_category');*/
    }

    public function update_brand(Request $request,$brand_id){
        $data=array();
        $data['brand_name']=$request->brand_name;
        $data['brand_description']=$request->brand_description;
        DB::table('tbl_brand')
        ->where('brand_id', $brand_id)
        ->update($data);
        Session::get('message', 'Brand Update Successfully !');
        return Redirect::to('/all-brand');
    }




}
