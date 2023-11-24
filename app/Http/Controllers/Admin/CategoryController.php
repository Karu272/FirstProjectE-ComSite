<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function categories(){
        Session::put('page','categories');
        $categories = Category::with('section')->get();
        return view('admin.categories.categories')->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Category::where('id',$data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        }
    }

    public function addEditCategory(Request $request, $id=null){
        Session::put('page','categories');
        if($id==""){
            // Add Category Func
            $title = "Add Category";
            $category = new Category;
            $categorydata = array();
            $getCategories = array();
            $message = "Category added succesfully";
        }else{
            // Edit Category Func
            $title = "Edit Category";
            $categorydata = Category::where('id',$id)->first();
            $getCategories = Category::where(['parent_id'=>0,'section_id'=>$categorydata['section_id']])->get();
            $category = Category::find($id);
            $message = "Category updated succesfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // Category Validation
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required',

            ];
            $customMessages = [
                 'category_name.required' => 'Category name is required',
                 'category_name.regex' => 'Valid name is required',
                 'section_id.required' => 'Section number is required',
                 'url.required' => 'url is required to direct to right page in front-end',
            ];
            $this->validate($request,$rules,$customMessages);

            // Uppload Category Image
            if($request->hasFile('category_image')){
                $image_tmp = $request->file('category_image');
                if($image_tmp->isValid()){
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'images/category_images/'.$imageName;
                    // Upload the Image
                    Image::make($image_tmp)->save($imagePath);
                    // Save Category Image
                    $category->category_image = $imageName;
                }
            }

            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->url = $data['url'];
            $category->status = 1;
            $category->save();

            Session::flash('success_message', $message);
            return redirect('admin/categories');
        }

        // Get All Sections
        $getSections = Section::get();

        return view('admin.categories.add_edit_category')->with(compact('title','getSections','categorydata','getCategories'));
    }


    // Append category level
    public function appendCategoryLevel(Request $request){
        Session::put('page','categories');
        if($request->ajax()){
            $data = $request->all();

            $getCategories = Category::where(['section_id'=>$data['section_id'],'parent_id'=>0,'status'=>1])->get();
            $getCategories = json_decode(json_encode($getCategories),true);

            return view('admin.categories.append_categories_level')->with(compact('getCategories'));
        }
    }

    // Delete Category Image
    public function deleteCategoryImage($id){
        Session::put('page','categories');
        // Get Category Image
        $categoryImage = Category::select('category_image')->where('id',$id)->first();
        // Get Category Image path
        $category_image_path = 'images/category_images/';
        // Delete Category image from category_images folder IF exist
        if(file_exists($category_image_path.$categoryImage->category_image)){
            unlink($category_image_path.$categoryImage->category_image);
        }
        // Delete Category image from categories table
        Category::where('id',$id)->update(['category_image'=>'']);

        $message = 'Category image has been deleted successfully';
        Session::flash('success_message', $message);
        return redirect()->back();
    }

    // Delete whole Category
    public function deleteCategory($id){
        Session::put('page','categories');
        Category::where('id',$id)->delete();

        $message = 'Category have been deleted successfully';
        Session::flash('success_message', $message);
        return redirect()->back();
    }
}
