<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use App\Models\ProductsAttribute;
use App\Models\ProductsImage;
use App\Models\Brand;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    public function products()
    {
        Session::put('page', 'products');
        $products = Product::with(['category' => function ($query) {
            $query->select('id', 'category_name');
        }, 'section' => function ($query) {
            $query->select('id', 'name');
        }])->get();
        // Query removes unwanted data
        return view('admin.products.products')->with(compact('products'));
    }


    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }


    // Delete Product
    public function deleteProduct($id)
    {
        Session::put('page', 'products');
        Product::where('id', $id)->delete();
        $message = 'Product have been deleted successfully';
        Session::flash('success_message', $message);
        return redirect()->back();
    }


    // Add edit products
    public function addEditProduct(Request $request, $id = null){
        Session::put('page', 'products');
        if ($id == "") {
            $title = "Add Product";
            $product = new Product;
            $productdata = array();
            $message = "Product added successfully";
        } else {
            $title = "Edit Product";
            $productdata = Product::find($id);
            $productdata = json_decode(json_encode($productdata), true);

            $product = Product::find($id);
            $message = "Product updated successfully";
        }


        if ($request->isMethod('post')) {
            $data = $request->all();

            // Product Validation
            $rules = [
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessages = [
                'category_id.required' => 'Category is required',
                'product_name.required' => 'Category name is required',
                'product_name.regex' => 'Valid name is required',
                'product_code.required' => 'Code is required',
                'product_code.regex' => 'Valid code is required',
                'product_price.required' => 'Price is required',
                'product_price.numeric' => 'Valid price is required',
                'product_color.required' => 'Color is required',
                'product_color.regex' => 'Valid color is required',
                'product_weight.required' => 'Weight is required',
                'product_weight.numeric' => 'Valid weight is required. No letters are allowed',
            ];
            $this->validate($request, $rules, $customMessages);

            // Upload Project Image
            if ($request->hasFile('main_image')) {
                $image_tmp = $request->file('main_image');
                if ($image_tmp->isValid()) {
                    // Upload Image afer Resize
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(11, 9999) . '.' . $extension;
                    // Set Paths for S M and L images
                    $large_image_path = 'images/product_images/large/' . $imageName;
                    $medium_image_path = 'images/product_images/medium/' . $imageName;
                    $small_image_path = 'images/product_images/small/' . $imageName;
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(520, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260, 300)->save($small_image_path);
                    // save image in products table
                    $product->product_image = $imageName;
                }
            }


            // Upload Product Video
            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {
                    // Upload Video
                    $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = rand(11, 9999) . '.' . $extension;
                    $video_path = 'video/product_videos/';
                    $video_tmp->move($video_path, $video_name);
                    // save video in products table
                    $product->product_video = $videoName;
                }
            }

            // Save Products in product table
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->brand_id = $data['brand_id'];
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            // $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->meta_description = $data['meta_description'];
            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            } else {
                $product->is_featured = "No";
            }
            $product->status = 1;
            $product->save();
            Session::flash('success_message', $message);
            return redirect('admin/products');
        }

        // Sections with categories and sub categories

        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);

        // Get All Brands
        $brands = Brand::get();
        $brands = json_decode(json_encode($brands), true);


        return view('admin.products.add_edit_product')->with(compact('title', 'categories', 'productdata', 'brands'));
    }


    // Delete product Image/video
    public function deleteProductImage($id)
    {
        Session::put('page', 'products');
        // Get product Image
        $productImage = Product::select('product_image')->where('id', $id)->first();
        // Get product Image paths
        $large_image_path = 'images/product_images/large/';
        $medium_image_path = 'images/product_images/medium/';
        $small_image_path = 'images/product_images/small/';
        // Delete product image from product_images folder IF exist
        if (file_exists($large_image_path . $productImage->product_image)) {
            unlink($large_image_path . $productImage->product_image);
        }
        if (file_exists($medium_image_path . $productImage->product_image)) {
            unlink($medium_image_path . $productImage->product_image);
        }
        if (file_exists($small_image_path . $productImage->product_image)) {
            unlink($small_image_path . $productImage->product_image);
        }
        // Delete product image from products table
        Product::where('id', $id)->update(['product_image' => '']);

        $message = 'product image has been deleted successfully';
        Session::flash('success_message', $message);
        return redirect()->back();
    }

    public function deleteProductVideo($id)
    {
        Session::put('page', 'products');
        // Get Product Video
        $productVideo = Product::select('product_video')->where('id', $id)->first();
        // Get Product Video path
        $product_video_path = 'video/product_video/';
        // Delete Product Video from category_Video folder IF exist
        if (file_exists($product_video_path . $productVideo->product_video)) {
            unlink($product_video_path . $productVideo->product_video);
        }
        // Delete Product Video from products table
        Product::where('id', $id)->update(['product_video' => '']);

        $message = 'Product video has been deleted successfully';
        Session::flash('success_message', $message);
        return redirect()->back();
    }


    // Add Attributes
    public function addAttributes(Request $request, $id)
    {
        Session::put('page', 'products');
        if ($request->isMethod('post')) {
            $data = $request->all();

            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {

                    // SKU already exist error msg
                    $attrCountSKU = ProductsAttribute::where('sku', $value)->count();
                    if ($attrCountSKU > 0) {
                        $message = 'SKU code already exists';
                        Session::flash('error_message', $message);
                        return redirect()->back();
                    }
                    // Save attribute data to table
                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }

            $message = 'Attributes added successfully';
            Session::flash('success_message', $message);
            return redirect()->back();
        }


        $productdata = Product::select('id', 'product_name', 'product_code', 'product_color', 'product_image')->with('attributes')->find($id);
        $productdata = json_decode(json_encode($productdata), true);

        $title = "Product Attributes";
        return view('admin.products.add_attributes')->with(compact('productdata', 'title'));
    }

    // Edit attributes
    public function editAttributes(Request $request, $id)
    {
        Session::put('page', 'products');
        if ($request->isMethod('post')) {
            $data = $request->all();

            foreach ($data['attrId'] as $key => $attr) {
                if (!empty($attr)) {
                    ProductsAttribute::where(['id' => $data['attrId'][$key]])->update(['stock' => $data['stock'][$key]]);
                }
            }
            $message = 'Product attributes has been updated successfully';
            Session::flash('success_message', $message);
            return redirect()->back();
        }
    }

    // Delete attribute
    public function deleteAttribute($id)
    {
        Session::put('page', 'products');
        ProductsAttribute::where('id', $id)->delete();
        $message = 'Attribute have been deleted successfully';
        Session::flash('success_message', $message);
        return redirect()->back();
    }

    // Add Images
    public function addImages(Request $request, $id)
    {
        Session::put('page', 'products');
        if ($request->isMethod('post')) {
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $key => $image) {
                    $productImage = new ProductsImage;
                    $image_tmp = Image::make($image);
                    // $orginalName = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $imageName = rand(111, 9999) . time() . "." . $extension;

                    // Set Paths for S M and L images
                    $large_image_path = 'images/product_images/large/' . $imageName;
                    $medium_image_path = 'images/product_images/medium/' . $imageName;
                    $small_image_path = 'images/product_images/small/' . $imageName;
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(306, 400)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260, 300)->save($small_image_path);
                    // save image in products table
                    $productImage->image = $imageName;
                    $productImage->product_id = $id;
                    $productImage->save();
                }

                $message = 'Images have been added successfully';
                Session::flash('success_message', $message);
                return redirect()->back();
            }
        }
        $productdata = Product::with('images')->select('id', 'product_name', 'product_code', 'product_color', 'product_image')->find($id);
        $productdata = json_decode(json_encode($productdata), true);

        $title = "Product Images";
        return view('admin.products.add_images')->with(compact('productdata', 'title'));
    }


    // Delete Image/video
    public function deleteImage($id)
    {
        Session::put('page', 'products');
        // Get Image
        $productImage = ProductsImage::select('image')->where('id', $id)->first();
        // Get Image paths
        $large_image_path = 'images/product_images/large/';
        $medium_image_path = 'images/product_images/medium/';
        $small_image_path = 'images/product_images/small/';
        // Delete image from product_images folder IF exist
        if (file_exists($large_image_path . $productImage->image)) {
            unlink($large_image_path . $productImage->image);
        }
        if (file_exists($medium_image_path . $productImage->image)) {
            unlink($medium_image_path . $productImage->image);
        }
        if (file_exists($small_image_path . $productImage->image)) {
            unlink($small_image_path . $productImage->image);
        }
        // Delete image from products table
        ProductsImage::where('id', $id)->delete();

        $message = 'Images has been deleted successfully';
        Session::flash('success_message', $message);
        return redirect()->back();
    }
}
