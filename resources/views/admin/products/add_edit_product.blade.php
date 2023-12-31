@extends('layouts.admin_layout.admin_layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Catalogues</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Error msg start  -->
                @if ($errors->any())
                    <div class="alert alert-danger" style="margin-top: 10px">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Error msg end  -->
                <!-- Success msg start  -->
                @if (Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px">
                        {{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- Success msg end  -->
                <!-- SELECT2 EXAMPLE -->
                <form name="productForm" id="productForm" @if(empty($productdata['id'])) action="{{ URL('admin/add-edit-product')}}"
                 @else action="{{ URL('admin/add-edit-product/' . $productdata['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="from-group">
                                        <label>Select Brand</label>
                                        <select name="brand_id" id="brand_id" class="form-control select2"
                                            style="width: 100%">
                                            <option value="">Select</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand['id'] }}" @if (!empty($productdata['brand_id']) && $productdata['brand_id'] == $brand['id']) selected="" @endif>{{ $brand['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Category</label>
                                        <select id="category_id" name="category_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach ($categories as $section)
                                                <optgroup label="{{ $section['name'] }}"></optgroup>
                                                @foreach ($section['categories'] as $category)
                                                    <option value="{{ $category['id'] }}" @if (!empty(@old('category_id')) && $category['id'] == @old('category_id')) selected="" @elseif(!empty($productdata['category_id']) && $productdata['category_id'] == $category['id']) selected="" @endif>
                                                        &nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{ $category['category_name'] }}
                                                    </option>
                                                    @foreach ($category['subcategories'] as $subcategory)
                                                        <option value="{{ $subcategory['id'] }}" @if (!empty(@old('category_id')) && $subcategory['id'] == @old('category_id')) selected="" @elseif(!empty($productdata['category_id']) && $productdata['category_id'] == $subcategory['id']) selected="" @endif>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{ $subcategory['category_name'] }}
                                                        </option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_name">Product Name</label>
                                        <input required type="text" class="form-control" name="product_name" id="product_name"
                                            placeholder="Enter product Name" @if (!empty($productdata['product_name'])) value="{{ $productdata['product_name'] }}" @else value="{{ old('product_name') }}" @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_code">Product Code</label>
                                        <input required type="text" class="form-control" name="product_code" id="product_code"
                                            placeholder="Enter product code" @if (!empty($productdata['product_code'])) value="{{ $productdata['product_code'] }}" @else value="{{ old('product_code') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">Product Color</label>
                                        <input required type="text" class="form-control" name="product_color" id="product_color"
                                            placeholder="Enter product color" @if (!empty($productdata['product_color'])) value="{{ $productdata['product_color'] }}" @else value="{{ old('product_color') }}" @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="product_price">Product Price</label>
                                        <input required type="text" class="form-control" name="product_price" id="product_price"
                                            placeholder="Enter product price" @if (!empty($productdata['product_price'])) value="{{ $productdata['product_price'] }}" @else value="{{ old('product_price') }}" @endif>
                                    </div>
                                    <!-- <div class="form-group">
                        <label for="product_discount">Product Discount(%)</label>
                        <input type="text" class="form-control" name="product_discount" id="product_discount" placeholder="Enter product discount" @if (!empty($productdata['product_discount'])) value="{{ $productdata['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif>
                    </div>       -->
                                     <div class="form-group">
                                         <label for="description">Meta Description</label>
                                         <textarea name="meta_description" id="meta_description" class="form-control" rows="3"
                                             placeholder="Enter Longer info about the product....">@if (!empty($productdata['meta_description'])) {{ $productdata['meta_description'] }} @else {{ old('meta_description') }} @endif</textarea>
                                     </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="3"
                                            placeholder="Enter short and simpel....">@if(!empty($productdata['description'])){{ $productdata['description'] }}@else{{ old('description') }}@endif</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keywords">Featured Item</label>
                                        <input type="checkbox" name="is_featured" id="is_featured" value="Yes" @if (!empty($productdata['is_featured']) && $productdata['is_featured'] == 'Yes') checked="" @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_weight">Product Weight in grams</label>
                                        <input required type="text" class="form-control" name="product_weight" id="product_weight"
                                            placeholder="Enter product weight in grams" @if (!empty($productdata['product_weight'])) value="{{ $productdata['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="main_image">product Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="main_image"
                                                    id="main_image" accept="image/*">
                                                <label class="custom-file-label" for="main_image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>
                                        </div>
                                        <div>Recomended Image size: width: 1040px, Height: 1200px </div>
                                        @if (!empty($productdata['product_image']))
                                            <div>
                                                <img style="width:80px; margin-top:5px"
                                                    src="{{ asset('images/product_images/small/' . $productdata['product_image']) }}">
                                                &nbsp;
                                                <a class="confirmDelete" href="javascript:void(0)" record="product-image"
                                                    recordid="{{ $productdata['id'] }}">Delete Image</a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="product_video">product Video</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="product_video"
                                                    id="product_video" accept="">
                                                <label class="custom-file-label" for="product_video">Choose file</label>
                                            </div>
                                        </div>
                                        @if (!empty($productdata['product_video']))
                                            <div>
                                                <a href="{{ URL('videos/product_videos/' . $productdata['product_video']) }}"
                                                    download>Download</a>
                                                &nbsp;&nbsp;&nbsp;
                                                <a class="confirmDelete" href="javascript:void(0)" record="product-video"
                                                    recordid="{{ $productdata['id'] }}">Delete Video</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                </form>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
