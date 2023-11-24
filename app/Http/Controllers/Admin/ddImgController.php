<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DdImg;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ddImgController extends Controller
{
    public function ddImg(){
        Session::put('page','ddImgPage');
        $dropDownImg = DdImg::get()->toArray();

        return view('admin.banners.ddImgPage')->with(compact('dropDownImg'));
    }

    public function addEditddImg(Request $request,$id=null){
        Session::put('page','ddImgPage');
        if($id==""){
            // Add Img
            $ddImgData = new DdImg;
            $title = "Add Image";
            $message = "Image added successfully";
        }else{
            // Edit Image
            $ddImgData = DdImg::find($id);
            $title = "Edit Image";
            $message = "Image updated successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $ddImgData->title = $data['title'];
            $ddImgData->first = $data['first'];
            $ddImgData->second = $data['second'];

            // Upload Img
            if($request->hasFile('ddImg')){
                $image_tmp = $request->file('ddImg');
                   if($image_tmp->isValid()){
                       // Upload image after Resize
                       $image_name = $image_tmp->getClientOriginalName();
                       $extension = $image_tmp->getClientOriginalExtension();
                       $imageName = rand(11,9999).'.'.$extension;
                       // Set Path
                       $dd_image_path = 'images/banner_images/'.$imageName;
                       // Upload Banner Image after Resize
                       Image::make($image_tmp)->resize(588,545)->save($dd_image_path);
                       // save image in products table
                       $ddImgData->ddImg = $imageName;
                   }
            }

            $ddImgData->save();
            Session::flash('success_message',$message);
            return redirect('admin/ddImgPage');
        }
        return view('admin.banners.add_edit_ddImg')->with(compact('title','ddImgData'));
    }

    public function updateddImgStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            if($data['status']== "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            DdImg::where('id',$data['ddImg_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'ddImg_id'=>$data['ddImg_id']]);
        }
    }

    public function deleteddImg($id){
        Session::put('page','ddImgPage');
        $placedDdImg = DdImg::where('id',$id)->first();
        //Get Banner Image Path
        $dd_image_path = 'images/banner_images/';

        // Delete if the image exist
        if(file_exists($dd_image_path.$placedDdImg->ddImg)){
            unlink($dd_image_path.$placedDdImg->ddImg);
        }

         // Delete image from banners table
         DdImg::where('id',$id)->delete();
         Session::flash('success_message','Image have been successfully deleted');
         return redirect()->back();
    }
}
