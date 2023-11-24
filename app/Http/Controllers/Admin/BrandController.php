<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function brands(){
        Session::put('page','brands');
        $brands = Brand::get()->toArray();
        return view('admin.brands.brands')->with(compact('brands'));
    }

    public function addEditBrand(Request $request,$id=null){
        Session::put('page','brands');
        if($id==""){
            $title = "Add Brand";
            $brand = new Brand;
            $message = "Brand added successfully";
        }else{
            $brand = Brand::find($id);
            $title = "Edit Brand";
            $message = "Brand updated successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();

            $brand->name = $data['brand_name'];
            $brand->url = $data['url'];
            $brand->description = $data['description'];

            // Upload Banner Image
            if($request->hasFile('brand_logo')){
                $image_tmp = $request->file('brand_logo');
                if($image_tmp->isValid()){
                    // Upload Image afer Resize
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(11,9999).'.'.$extension;
                    // Set Path
                    $brand_image_path = 'images/brand_logos/'.$imageName;
                    // Upload Banner Image after Resize
                    Image::make($image_tmp)->resize(600,337)->save($brand_image_path);
                    // save image in products table
                    $brand->brand_logo = $imageName;
                }
            }
            $brand->save();
            Session::flash('success_message',$message);
            return redirect('admin/brands');
        }

        return view('admin.brands.add_edit_brand')->with(compact('title','brand'));
    }

    public function updateBrandStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Brand::where('id',$data['brand_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'brand_id'=>$data['brand_id']]);
        }
    }

    // Delete brand
    public function deleteBrand($id){
        Session::put('page','brands');
        // Get Banner Image
        $brandImage = Brand::where('id',$id)->first();
        //Get Banner Image Path
        $brand_image_path = 'images/brand_logos/';
        // Delete if the image exist
        if(file_exists($brand_image_path.$brandImage->brand_logo)){
            unlink($brand_image_path.$brandImage->brand_logo);
        }

        Brand::where('id',$id)->delete();
        $message = 'Brand have been deleted successfully';
        Session::flash('success_message',$message);
        return redirect()->back();
    }


}
