<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\FAQ;
use Illuminate\Support\Facades\Session;
use App\Models\Review;

class InformationController extends Controller
{
    public function information(){
        Session::put('page','infoPage');
        $aboutContactInfo = Information::get()->toArray();

        return view('admin.info.infoPage')->with(compact('aboutContactInfo'));
    }

    public function addEditInfo(Request $request,$id=null){
        Session::put('page','infoPage');
        if($id==""){
            // Add Info
            $infoData = new Information;
            $title = "Add Info";
            $message = "Info/Txt added successfully";
        }else{
            // Edit Info
            $infoData = Information::find($id);
            $title = "Edit Info";
            $message = "Info/Txt updated successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $infoData->title = $data['title'];
            $infoData->text = $data['text'];
            $infoData->address = $data['address'];
            $infoData->phone = $data['phone'];
            $infoData->email = $data['email'];
            $infoData->save();
            Session::flash('success_message',$message);
            return redirect('admin/infoPage');
        }
        return view('admin.info.add_edit_info')->with(compact('title','infoData'));
    }

    public function faq(){
        Session::put('page','faqPage');
        $faqNotes = FAQ::get()->toArray();

        return view('admin.info.faqPage')->with(compact('faqNotes'));
    }

    public function addEditFaq(Request $request,$id=null){
        Session::put('page','faqPage');
        if($id==""){
            // Add Info
            $faqData = new FAQ;
            $title = "Add FAQ";
            $message = "FAQ added successfully";
        }else{
            // Edit Info
            $faqData = FAQ::find($id);
            $title = "Edit FAQ";
            $message = "FAQ updated successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $faqData->title = $data['title'];
            $faqData->text = $data['text'];
            $faqData->save();
            Session::flash('success_message',$message);
            return redirect('admin/faqPage');
        }
        return view('admin.info.add_edit_faq')->with(compact('title','faqData'));
    }

    public function deleteFaq($id){
        Session::put('page','faqPage');

        FAQ::where('id',$id)->delete();
        Session::flash('success_message','FAQ have been successfully deleted');
         return redirect()->back();
    }

    public function review(){
        Session::put('page','reviewPage');
        $reviewText = Review::get()->toArray();

        return view('admin.info.reviewPage')->with(compact('reviewText'));
    }

    public function updateReviewStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            if($data['status']== "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Review::where('id',$data['review_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'review_id'=>$data['review_id']]);
        }
    }

    public function deleteReview($id){
        Session::put('page','reviewPage');

        Review::where('id',$id)->delete();
        Session::flash('success_message','Review have been successfully deleted');
        return redirect()->back();
    }
}
