<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use App\Models\ListLeft;
use App\Models\ListRight;

class BannersController extends Controller
{
    public function banners(){
        Session::put('page','banners');
        $banners = Banner::get()->toArray();
        // dd($banners); die;
        return view('admin.banners.banners')->with(compact('banners'));
    }

    public function addEditBanner(Request $request,$id=null){
        Session::put('page','banners');
        if($id==""){
            // Add Banner
            $title = "Add Banner Image";
            $banner = new Banner;
            $message = "Banner added successfully";
        }else{
            // Edit Banner
            $banner = Banner::find($id);
            $title = "Edit Banner Image";
            $message = "Banner updated successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $banner->link = $data['link'];
            $banner->title = $data['title'];
            $banner->alt = $data['alt'];

            // Upload index top Banner Image
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    // Upload Image after Resize
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(11,9999).'.'.$extension;
                    // Set Path
                    $banner_image_path = 'images/banner_images/'.$imageName;
                    // Upload Banner Image after Resize
                    Image::make($image_tmp)->resize(1600,400)->save($banner_image_path);
                    // save image in products table
                    $banner->image = $imageName;
                }
            }
            $banner->save();
            Session::flash('success_message',$message);
            return redirect('admin/banners');
        }

        return view('admin.banners.add_edit_banner')->with(compact('title','banner'));
    }

    public function updateBannerStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Banner::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'banner_id'=>$data['banner_id']]);
        }
    }

    public function deleteBanner($id){
        Session::put('page','banners');
        // Get Banner Image
        $bannerImage = Banner::where('id',$id)->first();
        //Get Banner Image Path
        $banner_image_path = 'images/banner_images/';

        // Delete if the image exist
        if(file_exists($banner_image_path.$bannerImage->image)){
            unlink($banner_image_path.$bannerImage->image);
        }

         // Delete image from banners table
         Banner::where('id',$id)->delete();

         Session::flash('success_message','Banner image have been successfully deleted');
         return redirect()->back();
    }

    public function listleft(){
        Session::put('page', 'listleftPage');
        $listleftDBdata = ListLeft::get()->toArray();

        return view('admin.banners.listleftPage')->with(compact('listleftDBdata'));
    }

    public function addEditListleft(Request $request,$id=null){
        Session::put('page','listleftPage');
        if($id==""){
            // Add Img
            $listleftData = new ListLeft;
            $title = "Add Image";
            $message = "Image added successfully";
        }else{
            // Edit Image
            $listleftData = ListLeft::find($id);
            $title = "Edit Image";
            $message = "Image updated successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $listleftData->title = $data['title'];
            $listleftData->first = $data['first'];
            $listleftData->second = $data['second'];
            $listleftData->third = $data['third'];

            // Upload Img
            if($request->hasFile('listleftImg')){
                $image_tmp = $request->file('listleftImg');
                   if($image_tmp->isValid()){
                       // Upload image after Resize
                       $image_name = $image_tmp->getClientOriginalName();
                       $extension = $image_tmp->getClientOriginalExtension();
                       $imageName = rand(11,9999).'.'.$extension;
                       // Set Path
                       $listleft_image_path = 'images/banner_images/'.$imageName;
                       // Upload Banner Image after Resize
                       Image::make($image_tmp)->resize(640,426)->save($listleft_image_path);
                       // save image in products table
                       $listleftData->listleftImg = $imageName;
                   }
            }
            $listleftData->save();
            Session::flash('success_message',$message);
            return redirect('admin/listleftPage');
        }
        return view('admin.banners.add_edit_listleft')->with(compact('title','listleftData'));
    }

    public function updatelistleftStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            if($data['status']== "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ListLeft::where('id',$data['listleft_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'listleft_id'=>$data['listleft_id']]);
        }
    }

    public function deleteListleft($id){
        Session::put('page','listleftPage');
        $placedLeftImg = ListLeft::where('id',$id)->first();
        //Get Banner Image Path
        $listleft_image_path = 'images/banner_images/';

        // Delete if the image exist
        if(file_exists($listleft_image_path.$placedLeftImg->listleftImg)){
            unlink($listleft_image_path.$placedLeftImg->listleftImg);
        }

         // Delete image from banners table
         ListLeft::where('id',$id)->delete();
         Session::flash('success_message','Image have been successfully deleted');
         return redirect()->back();
    }

    public function listright(){
        Session::put('page', 'listrightPage');
        $listrightDBdata = ListRight::get()->toArray();

        return view('admin.banners.listrightPage')->with(compact('listrightDBdata'));
    }

    public function addEditListright(Request $request,$id=null){
        Session::put('page','listrightPage');
        if($id==""){
            // Add Img
            $listrightData = new ListRight;
            $title = "Add Image";
            $message = "Image added successfully";
        }else{
            // Edit Image
            $listrightData = ListRight::find($id);
            $title = "Edit Image";
            $message = "Image updated successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $listrightData->title = $data['title'];
            $listrightData->first = $data['first'];
            $listrightData->second = $data['second'];
            $listrightData->third = $data['third'];

            // Upload Img
            if($request->hasFile('listrightImg')){
                $image_tmp = $request->file('listrightImg');
                   if($image_tmp->isValid()){
                       // Upload image after Resize
                       $image_name = $image_tmp->getClientOriginalName();
                       $extension = $image_tmp->getClientOriginalExtension();
                       $imageName = rand(11,9999).'.'.$extension;
                       // Set Path
                       $listright_image_path = 'images/banner_images/'.$imageName;
                       // Upload Banner Image after Resize
                       Image::make($image_tmp)->resize(640,426)->save($listright_image_path);
                       // save image in products table
                       $listrightData->listrightImg = $imageName;
                   }
            }
            $listrightData->save();
            Session::flash('success_message',$message);
            return redirect('admin/listrightPage');
        }
        return view('admin.banners.add_edit_listright')->with(compact('title','listrightData'));

    }

    public function updatelistrightStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            if($data['status']== "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ListRight::where('id',$data['listright_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'listright_id'=>$data['listright_id']]);
        }
    }

    public function deleteListright($id){
        Session::put('page','listrightPage');
        $placedRightImg = ListRight::where('id',$id)->first();
        //Get Banner Image Path
        $listright_image_path = 'images/banner_images/';

        // Delete if the image exist
        if(file_exists($listright_image_path.$placedRightImg->listrightImg)){
            unlink($listright_image_path.$placedRightImg->listrightImg);
        }

         // Delete image from banners table
         ListRight::where('id',$id)->delete();
         Session::flash('success_message','Image have been successfully deleted');
         return redirect()->back();
    }
}
