<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndexBottomLeft;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class IndexBottomLeftController extends Controller
{
    public function bottomLeftImg(){
        Session::put('page','bottomLeftImg');
        $bottomLeftImg = IndexBottomLeft::get()->toArray();
        // dd($bottomLeftImg); die;
        return view('admin.banners.bottomLeftImg')->with(compact('bottomLeftImg'));
    }

    public function addEditBottomLeftImg(Request $request,$id=null){
        Session::put('page','bottomLeftImg');
        if($id==""){
            // Add Img
            $bottomLeft = new IndexBottomLeft;
            $title = "Add Image";
            $message = "Image added successfully";
        }else{
            // Edit Image
            $bottomLeft = IndexBottomLeft::find($id);
            $title = "Edit Image";
            $message = "Image updated successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $bottomLeft->title = $data['title'];
            $bottomLeft->first = $data['first'];
            $bottomLeft->second = $data['second'];

            // Upload Img
            if($request->hasFile('indexBottomLeft')){
                $image_tmp = $request->file('indexBottomLeft');
                   if($image_tmp->isValid()){
                       // Upload image after Resize
                       $image_name = $image_tmp->getClientOriginalName();
                       $extension = $image_tmp->getClientOriginalExtension();
                       $imageName = rand(11,9999).'.'.$extension;
                       // Set Path
                       $left_image_path = 'images/banner_images/'.$imageName;
                       // Upload Banner Image after Resize
                       Image::make($image_tmp)->resize(1000,400)->save($left_image_path);
                       // save image in products table
                       $bottomLeft->indexBottomLeft = $imageName;
                   }
            }

            $bottomLeft->save();
            Session::flash('success_message',$message);
            return redirect('admin/bottomLeftImg');
        }
        return view('admin.banners.add_edit_bottomLeftImg')->with(compact('title','bottomLeft'));
    }

    public function updateBottomLeftImageStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            if($data['status']== "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            IndexBottomLeft::where('id',$data['bottomLeft_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'bottomLeft_id'=>$data['bottomLeft_id']]);
        }
    }

    public function deleteBottomLeftImg($id){
        Session::put('page','bottomLeftImg');
        $placedBottomLeftImg = IndexBottomLeft::where('id',$id)->first();
        //Get Banner Image Path
        $left_image_path = 'images/banner_images/';

        // Delete if the image exist
        if(file_exists($left_image_path.$placedBottomLeftImg->indexBottomLeft)){
            unlink($left_image_path.$placedBottomLeftImg->indexBottomLeft);
        }

         // Delete image from banners table
         IndexBottomLeft::where('id',$id)->delete();
         Session::flash('success_message','Image have been successfully deleted');
         return redirect()->back();
    }

}
