<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaruselImgs;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CaruselController extends Controller
{
    public function carusel(){
        Session::put('page','caruselImgPage');
        $caruselImgs = CaruselImgs::get()->toArray();

        return view('admin.banners.caruselImgPage')->with(compact('caruselImgs'));
    }

    public function addEditCarusel(Request $request,$id=null){
        Session::put('page','caruselImgPage');
        if($id==""){
            // Add Img
            $caruselData = new CaruselImgs;
            $title = "Add Image";
            $message = "Image added successfully";
        }else{
            // Edit Image
            $caruselData = CaruselImgs::find($id);
            $title = "Edit Image";
            $message = "Image updated successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $caruselData->title = $data['title'];
            $caruselData->first = $data['first'];
            $caruselData->second = $data['second'];

            // Upload Img
            if($request->hasFile('caruselImg')){
                $image_tmp = $request->file('caruselImg');
                   if($image_tmp->isValid()){
                       // Upload image after Resize
                       $image_name = $image_tmp->getClientOriginalName();
                       $extension = $image_tmp->getClientOriginalExtension();
                       $imageName = rand(11,9999).'.'.$extension;
                       // Set Path
                       $carusel_image_path = 'images/banner_images/'.$imageName;
                       // Upload Banner Image after Resize
                       Image::make($image_tmp)->resize(1600,400)->save($carusel_image_path);
                       // save image in products table
                       $caruselData->caruselImg = $imageName;
                   }
            }
            $caruselData->save();
            Session::flash('success_message',$message);
            return redirect('admin/caruselImgPage');
        }
        return view('admin.banners.add_edit_carusel')->with(compact('title','caruselData'));
    }

    public function updateCaruselStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            if($data['status']== "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            CaruselImgs::where('id',$data['carusel_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'carusel_id'=>$data['carusel_id']]);
        }
    }

    public function deleteCarusel($id){
        Session::put('page','caruselImgPage');
        $placedCaruselImg = CaruselImgs::where('id',$id)->first();
        //Get Banner Image Path
        $carusel_image_path = 'images/banner_images/';

        // Delete if the image exist
        if(file_exists($carusel_image_path.$placedCaruselImg->caruselImg)){
            unlink($carusel_image_path.$placedCaruselImg->caruselImg);
        }

         // Delete image from banners table
         CaruselImgs::where('id',$id)->delete();
         Session::flash('success_message','Image have been successfully deleted');
         return redirect()->back();
    }

}
