<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\User;
use App\Models\DeliveryAddress;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\Brand;
use App\Models\ListLeft;
use App\Models\Information;
use App\Models\CaruselImgs;
use App\Models\DdImg;
use App\Models\ListRight;
use App\Models\Review;
use App\Models\ShippingCharge;

class ProductsController extends Controller
{
    public function listing(){
        $randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();
        $getInfo = Information::get()->toArray();
        $getListleftImg = ListLeft::where('status', '1')->first()->toArray();
        $getListrightImg = ListRight::where('status', '1')->first()->toArray();
        // Get featured items
        $featuredItemsCount = Product::where('is_featured', 'YES')->count();
        $featuredItems = Product::where('is_featured', 'YES')->get()->toArray();
        $getddImg = DdImg::where('status', '1')->get()->toArray();
        $featuredItemsChunk = array_chunk($featuredItems, 4);
        // Get New Products display
        $newProducts = Product::orderBy('id', 'Desc')->limit(4)->get()->toArray();
        $sideBarCategories = Category::select('category_name', 'url')->get()->toArray();
        $sideBarBrands = Brand::select('name', 'url', 'description', 'brand_logo', 'id')->get()->toArray();

        $page_name = "listing";
        $url = Route::getFacadeRoot()->current()->uri();

        $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
        if ($categoryCount > 0) {
            $categoryDetails = Category::catDetails($url);
            $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds']);
            // Check if #sort option seleceted by user
            if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                if ($_GET['sort'] == "product_latest") {
                    $categoryProducts->orderBy('id', 'Desc');
                } else if ($_GET['sort'] == "product_name_a_z") {
                    $categoryProducts->orderBy('product_name', 'Asc');
                } else if ($_GET['sort'] == "product_name_z_a") {
                    $categoryProducts->orderBy('product_name', 'Desc');
                } else if ($_GET['sort'] == "price_lowest") {
                    $categoryProducts->orderBy('product_price', 'Asc');
                } else if ($_GET['sort'] == "price_higest") {
                    $categoryProducts->orderBy('product_price', 'Desc');
                }
            } else {
                $categoryProducts->orderBy('product_name', 'Asc');
            }

            $categoryProducts = $categoryProducts->paginate(3);

            return view('front.products.listing')->with(compact('getListrightImg','getddImg','randomProducts','getInfo','getListleftImg', 'page_name', 'featuredItemsChunk', 'featuredItemsCount', 'newProducts', 'sideBarCategories', 'categoryDetails', 'categoryProducts', 'sideBarBrands'));
        } else {
            abort(404);
        }
    }

    public function details($id)
    {
        $randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();
        $getInfo = Information::get()->toArray();
        $productDetails = Product::with('Category', 'Brand', 'Attributes', 'Images')->find($id)->toArray();
        $getddImg = DdImg::where('status', '1')->get()->toArray();
        $total_stock = ProductsAttribute::where('product_id', $id)->sum('stock');
        $relatedProducts = Product::where('category_id', $productDetails['category']['id'])->where('id', '!=', $id)->limit(3)->inRandomOrder()->get()->toArray();
        $getReview = Review::where('status', '1')->get()->toArray();

        return view('front.products.detail')->with(compact('getReview','getddImg','getInfo','randomProducts','productDetails', 'total_stock', 'relatedProducts'));
    }

    public function getProductPrice(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($data['product_id']);
            return $getDiscountedAttrPrice;
        }
    }

    public function addtocart(Request $request)
    {
        Session::forget('error_message');
        Session::forget('success_message');
        if ($request->isMethod('post')) {
            $data = $request->all();

            // Check if stock is available or not
            $getProductStock = optional(ProductsAttribute::where(['product_id' => $data['product_id']])->first())->toArray();

            if ($getProductStock !== null && $getProductStock['stock'] < $data['quantity']) {
                $message = "Requireed Quantity is not available!";
                session::flash('error_message', $message);
                return redirect()->back();
            } else if ($getProductStock['stock'] == null) {
                $message = "Item is not available at the moment";
                session::flash('error_message', $message);
                return redirect()->back();
            }

            // Generate Session ID if not exist
            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }

            // CHeck if product already exist in cart or in user cart
            if (Auth::check()) {
                // User is logged in
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'user_id' => Auth::user()->id])->count();
            } else {
                // user is not loged in
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'session_id' => Session::get('session_id')])->count();
            }


            if ($countProducts > 0) {
                $message = "Product already exists in cart!";
                session::flash('error_message', $message);
                return redirect()->back();
            }

            // Add user ID to added products in cart
            if (Auth::check()) {
                $user_id = Auth::user()->id;
            } else {
                $user_id = 0;
            }

            // Save Product in Cart
            $cart = new Cart;
            $cart->session_id = $session_id;
            $cart->user_id = $user_id;
            $cart->product_id = $data['product_id'];
            $cart->quantity = $data['quantity'];
            $cart->save();

            $message = "Product has been added in cart!";
            session::flash('success_message', $message);
            return redirect('cart');
        }
    }

    public function cart()
    {
        Session::forget('error_message');
        Session::forget('success_message');

        $getddImg = DdImg::where('status', '1')->get()->toArray();
        $randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();
        $getInfo = Information::get()->toArray();
        $userCartItems = Cart::userCartItems();
        $getCaruselImg = CaruselImgs::where('status', '1')->get()->toArray();
        return view('front.products.cart')->with(compact('getddImg','randomProducts','getInfo','getCaruselImg','userCartItems'));
    }

    public function updateCartItemQty(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // Get Cart Details
            $cartDetails = Cart::find($data['cartid']);
            // Get avaible product stock
            $availableStock = ProductsAttribute::select('stock')->where(['product_id' => $cartDetails['product_id']])->first()->toArray();

            //Check if stock is avaible or not
            if ($data['qty'] > $availableStock['stock']) {
                $userCartItems = Cart::userCartItems();

                return response()->json([
                    'status' => false,
                    'cart' =>   Product::query()
                        ->select('products.*')
                        ->join('carts', 'carts.product_id', '=', 'products.id')
                        ->where('carts.session_id', '=', Session::get('session_id'))
                        ->get(),
                ], 200);
            }

            Cart::where('id', $data['cartid'])->update(['quantity' => $data['qty']]);
            $userCartItems = Cart::userCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'status' => true,
                'totalCartItems' => $totalCartItems,
                'cart' =>   Product::query()
                    ->select('products.*', 'carts.quantity as cart_quantity')
                    ->join('carts', 'carts.product_id', '=', 'products.id')
                    ->where('carts.session_id', '=', Session::get('session_id'))
                    ->get(),
                'view' => (string)View::make('front.products.cart_items')->with(compact('userCartItems'))
            ], 200);
        }
    }

    public function deleteCartItem(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Cart::where('id', $data['cartid'])->delete();
            $message = 'Product have been deleted successfully';
            Session::flash('success_message', $message);
            $userCartItems = Cart::userCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'totalCartItems' => $totalCartItems,
                'view' => (string)View::make('front.products.cart_items')->with(compact('userCartItems'))
            ]);
        }
    }

    public function applyCoupon(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $userCartItems = Cart::userCartItems();
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();
            if ($couponCount == 0) {
                $userCartItems = Cart::userCartItems();
                $totalCartItems = totalCartItems();
                Session::forget('couponCode');
                Session::forget('couponAmount');
                return response()->json([
                    'status' => false,
                    'message' => 'This coupon is not valid!',
                    'totalCartItems' => $totalCartItems,
                    'view' => (string)View::make('front.products.cart_items')->with(compact('userCartItems'))
                ]);
            } else {

                // Check for other coupon conditions

                // Get Coupon Details
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();

                // Check if coupon is Inactive
                if ($couponDetails->status == 0) {
                    $message = 'This coupon is not active!';
                }

                // Check if coupon is Expired
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if ($expiry_date < $current_date) {
                    $message = 'This coupon is expired!';
                }

                // check if coupon is for single or multiple times
                if($couponDetails->coupon_type == "Single Times"){
                    // Check in orders if coupon is already availed by user
                    $couponCount = Order::where(['coupon_code'=>$data['code'],'user_id'=>Auth::user()->id])->count();
                    if($couponCount >= 1){
                        $message = "This coupon is already availed by you!";
                    }
                }

                // Check if coupon is from selected categories
                // Get all selected categories from coupon
                $catArr = explode(",", $couponDetails->categories);

                // Get Cart Items
                $userCartItems = Cart::userCartItems();

                // Check if coupon belongs to logged in user
                // Get all selected users of coupon
                if (!empty($couponDetails->users)) {
                    $usersArr = explode(",", $couponDetails->users);
                    // Get User ID's of all selected users
                    foreach ($usersArr as $key => $user) {
                        $getUserID = User::select('id')->where('email', $user)->first()->toArray();
                        $userID[] = $getUserID['id'];
                    }
                }

                // Get Cart Total Amount
                $total_amount = 0;
                foreach ($userCartItems as $key => $item) {

                    if (!in_array($item['product']['category_id'], $catArr)) {
                        $message = 'This coupon code is not for one of the selected products!';
                    }

                    if (!empty($couponDetails->users)) {
                        if (!in_array($item['user_id'], $userID)) {
                            $message = 'This coupon code is not for you!';
                        }
                    }

                    $attrPrice = Product::getDiscountedAttrPrice($item['product_id']);
                    $total_amount = $total_amount + ($attrPrice['final_price'] * $item['quantity']);
                }

                if (isset($message)) {
                    $userCartItems = Cart::userCartItems();
                    $totalCartItems = totalCartItems();
                    return response()->json([
                        'status' => false,
                        'message' => $message,
                        'totalCartItems' => $totalCartItems,
                        'view' => (string)View::make('front.products.cart_items')->with(compact('userCartItems'))
                    ]);
                } else {

                    // Check if amount type is Fixed or Percentage
                    if ($couponDetails->amount_type == "Fixed") {
                        $couponAmount = $couponDetails->amount;
                    } else {
                        $couponAmount = $total_amount * ($couponDetails->amount / 100);
                    }
                    $grand_total = $total_amount - $couponAmount;

                    // Add Coupon Code & Amount in Session Variables
                    Session::put('couponAmount', $couponAmount);
                    Session::put('couponCode', $data['code']);

                    $message = "Coupon code successfully applied. You are availing discount!";
                    $totalCartItems = totalCartItems();
                    $userCartItems = Cart::userCartItems();
                    return response()->json([
                        'status' => true,
                        'message' => $message,
                        'totalCartItems' => $totalCartItems,
                        'couponAmount' => $couponAmount,
                        'grand_total' => $grand_total,
                        'view' => (string)View::make('front.products.cart_items')->with(compact('userCartItems'))
                    ]);
                }
            }
        }
    }

    public function checkout(Request $request)
    {
        $userCartItems = Cart::userCartItems();

        // Error msg if user try to click "checkout" before adding to items to cart
        if(count($userCartItems)==0){
            $message = "Shopping cart is empty please add products to checkout";
            Session::put('error_message',$message);
            return redirect('cart');
        }

        $total_price = 0;
        $total_weight = 0;
        foreach($userCartItems as $item){
            $product_weight = $item['product']['product_weight'];
            $total_weight = $total_weight + $product_weight;
            $attrPrice = Product::getDiscountedAttrPrice($item['product_id']);
            $total_price = $total_price + $attrPrice['final_price'] * $item['quantity'];
        }

        $deliveryAddresses = DeliveryAddress::deliveryAddresses();
        // adding the shipping charges from the model and put it in the array of $deliveryAddresses
        foreach($deliveryAddresses as $key => $value){
            $shippingCharges = ShippingCharge::getShippingCharges($total_weight,$value['country']);
            $deliveryAddresses[$key]['shipping_charges'] = $shippingCharges;
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            if (empty($data['address_id'])) {
                $message = "Please select Delivery Address!";
                session::flash('error_message', $message);
                return redirect()->back();
            }
            if (empty($data['payment_gateway'])) {
                $message = "Please select Payment Method!";
                session::flash('error_message', $message);
                return redirect()->back();
            }

            if ($data['payment_gateway'] == "COD") {
                $payment_method = "COD";
            } else {
                $payment_method = "Prepaid";
            }

            // Get Delvery Address from address_id
            $deliveryAddress = DeliveryAddress::where('id', $data['address_id'])->first()->toArray();

            // Get the shipping charges
            $shipping_charges = ShippingCharge::getShippingCharges($total_weight,$deliveryAddress['country']);

            // Calculate Grand Total
            $grand_total = $total_price + $shipping_charges - Session::get('couponAmount');

            // Insert Grand Total in session variable
            Session::put('grand_total', $grand_total);

            DB::beginTransaction();

            // Insert Order Details
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->name = $deliveryAddress['name'];
            $order->address = $deliveryAddress['address'];
            $order->city = $deliveryAddress['city'];
            $order->province = $deliveryAddress['province'];
            $order->country = $deliveryAddress['country'];
            $order->pincode = $deliveryAddress['pincode'];
            $order->mobile = $deliveryAddress['mobile'];
            $order->email = Auth::user()->email;
            $order->shipping_charges = $shipping_charges;
            $order->coupon_code = Session::get('couponCode');
            $order->coupon_amount = Session::get('couponAmount');
            $order->order_status = "New";
            $order->payment_method = $payment_method;
            $order->payment_gateway = $data['payment_gateway'];
            $order->grand_total = Session::get('grand_total');
            $order->save();

            // Get last Inserted Order Id
            $order_id = DB::getPdo()->lastInsertId();

            // Get User Cart Items
            $cartItems = Cart::where('user_id', Auth::user()->id)->get()->toArray();
            foreach ($cartItems as $key => $item) {
                $cartItem = new OrdersProduct;
                $cartItem->order_id = $order_id;
                $cartItem->user_id = Auth::user()->id;

                $getProductDetails = Product::select('product_code', 'product_name', 'product_color')->where('id', $item['product_id'])->first()->toArray();
                $cartItem->product_id = $item['product_id'];
                $cartItem->product_code = $getProductDetails['product_code'];
                $cartItem->product_name = $getProductDetails['product_name'];
                $cartItem->product_color = $getProductDetails['product_color'];
                $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($item['product_id']);
                $cartItem->product_price = $getDiscountedAttrPrice['final_price'];
                $cartItem->product_qty = $item['quantity'];
                $cartItem->save();
            }

            // Insert Order id in Session Variable
            Session::put('order_id', $order_id);

            DB::commit();

            if ($data['payment_gateway'] == "COD") {

                $orderDetails = Order::with('orders_products')->where('id',$order_id)->first()->toArray();
                $userDetails = User::where('id',$orderDetails['user_id'])->first()->toArray();

                // Send order email
                $email = Auth::user()->email;
                $messageData = [
                    'email' => $email,
                    'name' => Auth::user()->name,
                    'order_id' => $order_id,
                    'orderDetails' => $orderDetails,
                ];
                Mail::send('emails.order',$messageData, function($message) use($email){
                    $message->to($email)->subject('Order Placed - Rayeallistic.com');
                });

                return redirect('/thanks');
            }else if($data['payment_gateway'] == "Paypal"){
                // Paypal -> redirect user to paypal page after placing order
                return redirect('paypal');
            }else{
                echo "Other Prepaid Method Coming Soon";
                die;
            }

            echo "Order placed";
            die;
        }
        $getInfo = Information::get()->toArray();
        $randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();
        $getddImg = DdImg::where('status', '1')->get()->toArray();

        return view('front.products.checkout')->with(compact('getddImg','randomProducts','getInfo','userCartItems', 'deliveryAddresses','total_price'));
    }

    public function thanks()
    {
        $getInfo = Information::get()->toArray();
        $randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();
        $getddImg = DdImg::where('status', '1')->get()->toArray();
        $getCaruselImg = CaruselImgs::where('status', '1')->get()->toArray();

        if (Session::has('order_id')) {
            // Empty the User Cart
            Cart::where('user_id', Auth::user()->id)->delete();
            return view('front.products.thanks')->with(compact('getCaruselImg','getInfo','randomProducts','getddImg'));
        } else {
            return redirect('/cart');
        }
    }

    public function addEditDeliveryAddress(Request $request, $id = null)
    {
        if ($id == "") {
            // Add Delivery Address
            $title = "Add Delivery Address";
            $address = new DeliveryAddress;
            $message = "Delivery Address added successfully!";
        } else {
            // Edit Delivery Address
            $title = "Edit Delivery Address";
            $address = DeliveryAddress::find($id);
            $address = json_decode(json_encode($address),true);

            if(Auth::user()->id!=$address['user_id']){
                $message = "Not authorized to edit this address! Please edit your own address.";
                Session::put('error_message',$message);
                return redirect('checkout');
            }
            $message = "Delivery Address updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'address' => 'required',
                'city' => 'required|regex:/^[\pL\s\-]+$/u',
                'province' => 'required|regex:/^[\pL\s\-]+$/u',
                'country' => 'required',
                'pincode' => 'required|numeric|digits:6',
                'mobile' => 'required|numeric|digits:10',
            ];
            $customMessages = [
                'name.required' => 'Name is required',
                'name.regex' => 'Valid Name is required',
                'address.required' => 'Address is required',
                'city.required' => 'City is required',
                'city.regex' => 'Valid City is required',
                'province.required' => 'province is required',
                'province.regex' => 'Valid province is required',
                'country.required' => 'Country is required',
                'pincode.required' => 'Pincode is required',
                'pincode.numeric' => 'Valid Pincode is required',
                'pincode.digits' => 'Pincode must be of 6 digits',
                'mobile.required' => 'Mobile is required',
                'mobile.numeric' => 'Valid Mobile is required',
                'mobile.digits' => 'Mobile must be of 10 digits',
            ];
            $this->validate($request, $rules, $customMessages);

            $address->user_id = Auth::user()->id;
            $address->name = $data['name'];
            $address->address = $data['address'];
            $address->city = $data['city'];
            $address->province = $data['province'];
            $address->country = $data['country'];
            $address->pincode = $data['pincode'];
            $address->mobile = $data['mobile'];
            $address->save();
            Session::put('success_message', $message);
            return redirect('checkout');
        }
        $getInfo = Information::get()->toArray();
        $randomProducts = Product::with('Brand')->inRandomOrder()->limit(3)->get()->toArray();
        $getddImg = DdImg::where('status', '1')->get()->toArray();

        $countries = Country::where('status', 1)->get()->toArray();
        return view('front.products.add_edit_delivery_address')->with(compact('getddImg','randomProducts','getInfo','countries', 'title', 'address'));
    }

    public function deleteDeliveryAddress($id)
    {
        DeliveryAddress::where('id', $id)->delete();
        $message = "Delivery Address deleted successfully!";
        Session::put('success_message', $message);
        return redirect()->back();
    }

    public function review(Request $request)
    {
        $reviewData = new Review;

        $message = "Thank you, your review will be posted shortly";

        if($request->isMethod('post')){
            $data = $request->all();
            $reviewData->name = $data['name'];
            $reviewData->email = $data['email'];
            $reviewData->title = $data['title'];
            $reviewData->text =$data['text'];
            $reviewData->status = 0;
            $reviewData->save();
            Session::flash('success_message',$message);
            return redirect()->back();
        }
        return view('front.products.details')->with(compact('reviewData'));
    }
}
