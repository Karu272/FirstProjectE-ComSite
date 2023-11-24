<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndexBottomRight;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class IndexBottomRController extends Controller
{
    public function bottomRImg(){
        Session::put('page','bottomRImg');
        $bottomRightImg = IndexBottomRight::get()->toArray();

        return view('admin.banners.bottomRImg')->with(compact('bottomRightImg'));
    }

    public function addEditBottomRImg(Request $request,$id=null){
        Session::put('page','bottomRImg');
        if($id==""){
            // Add Img
            $bottomRight = new IndexBottomRight;
            $title = "Add Image";
            $message = "Image added successfully";
        }else{
            // Edit Image
            $bottomRight = IndexBottomRight::find($id);
            $title = "Edit Image";
            $message = "Image updated successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $bottomRight->title = $data['title'];
            $bottomRight->first = $data['first'];
            $bottomRight->second = $data['second'];

            // Upload Img
            if($request->hasFile('rightImg')){
                $image_tmp = $request->file('rightImg');
                   if($image_tmp->isValid()){
                       // Upload image after Resize
                       $image_name = $image_tmp->getClientOriginalName();
                       $extension = $image_tmp->getClientOriginalExtension();
                       $imageName = rand(11,9999).'.'.$extension;
                       // Set Path
                       $right_image_path = 'images/banner_images/'.$imageName;
                       // Upload Banner Image after Resize
                       Image::make($image_tmp)->resize(640,426)->save($right_image_path);
                       // save image in products table
                       $bottomRight->rightImg = $imageName;
                   }
            }

            $bottomRight->save();
            Session::flash('success_message',$message);
            return redirect('admin/bottomRImg');
        }
        return view('admin.banners.add_edit_bottomRightImg')->with(compact('title','bottomRight'));
    }

    public function updateBottomRImgStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            if($data['status']== "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            IndexBottomRight::where('id',$data['bottomRight_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'bottomRight_id'=>$data['bottomRight_id']]);
        }
    }

    public function deleteBottomRImg($id){
        Session::put('page','bottomRImg');
        $placedBottomRightImg = IndexBottomRight::where('id',$id)->first();
        //Get Banner Image Path
        $right_image_path = 'images/banner_images/';

        // Delete if the image exist
        if(file_exists($right_image_path.$placedBottomRightImg->rightImg)){
            unlink($right_image_path.$placedBottomRightImg->rightImg);
        }

         // Delete image from banners table
         IndexBottomRight::where('id',$id)->delete();
         Session::flash('success_message','Image have been successfully deleted');
         return redirect()->back();
    }
}
