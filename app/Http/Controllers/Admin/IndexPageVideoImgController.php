<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndexPageVideoImg;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class IndexPageVideoImgController extends Controller
{
    public function indexPageVideoImg(){
        Session::put('page','indexPageVideoImg');
        $videoImgs = IndexPageVideoImg::get()->toArray();
        // dd($videoImgs); die;
        return view('admin.banners.indexPageVideoImg')->with(compact('videoImgs'));
    }

    public function addEditIndexPageVideoImg(Request $request,$id=null){
        Session::put('page','indexPageVideoImg');
        if($id==""){
            // Add Img
            $videoImg = new IndexPageVideoImg;
            $title = "Add Image";
            $message = "Image added successfully";
        }else{
            // Edit Image
            $videoImg = IndexPageVideoImg::find($id);
            $title = "Edit Image";
            $message = "Image updated successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $videoImg->link = $data['link'];
            $videoImg->title = $data['title'];
            $videoImg->alt = $data['alt'];

            // Upload Img
            if($request->hasFile('indexPageVideoImg')){
                $image_tmp = $request->file('indexPageVideoImg');
                   if($image_tmp->isValid()){
                       // Upload image after Resize
                       $image_name = $image_tmp->getClientOriginalName();
                       $extension = $image_tmp->getClientOriginalExtension();
                       $imageName = rand(11,9999).'.'.$extension;
                       // Set Path
                       $video_image_path = 'images/banner_images/'.$imageName;
                       // Upload Banner Image after Resize
                       Image::make($image_tmp)->resize(621,640)->save($video_image_path);
                       // save image in products table
                       $videoImg->indexPageVideoImg = $imageName;
                   }
            }

            $videoImg->save();
            Session::flash('success_message',$message);
            return redirect('admin/indexPageVideoImg');
        }
        return view('admin.banners.add_edit_indexPageVideoImg')->with(compact('title','videoImg'));

    }

    public function updateVideoImgStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            if($data['status']== "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            IndexPageVideoImg::where('id',$data['videoImg_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'videoImg_id'=>$data['videoImg_id']]);
        }
    }

    public function deleteVideoImg($id){
        Session::put('page','indexPageVideoImg');
        $placedVideoImg = IndexPageVideoImg::where('id',$id)->first();
        //Get Banner Image Path
        $video_image_path = 'images/banner_images/';

        // Delete if the image exist
        if(file_exists($video_image_path.$placedVideoImg->indexPageVideoImg)){
            unlink($video_image_path.$placedVideoImg->indexPageVideoImg);
        }

         // Delete image from banners table
         IndexPageVideoImg::where('id',$id)->delete();
         Session::flash('success_message','Image have been successfully deleted');
         return redirect()->back();
    }
}
