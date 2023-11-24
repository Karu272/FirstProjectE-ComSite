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
                            <li class="breadcrumb-item active">Products Images</li>
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
                @if (Session::has('error_message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 10px">
                        {{ Session::get('error_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- Error msg end  -->
                <!-- Success msg start  -->
                @if (Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: : 10px">
                        {{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- Success msg end  -->

                <!-- SELECT2 EXAMPLE -->
                <form name="addImagesForm" id="addImagesForm" method="post"
                    action="{{ URL('admin/add-images/' . $productdata['id']) }}" enctype="multipart/form-data">@csrf

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
                                    <div class="form-group">
                                        <label for="product_name">Product
                                            Name:</label>&nbsp;{{ $productdata['product_name'] }}
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">Product
                                            Color:</label>&nbsp;{{ $productdata['product_color'] }}
                                    </div>
                                    <div class="form-group">
                                        <label for="product_code">Product
                                            Code:</label>&nbsp;{{ $productdata['product_code'] }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img style="width:180px"
                                            src="{{ asset('images/product_images/small/' . $productdata['product_image']) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="margin-bottom: 10px" class="field_wrapper">
                                        <div>
                                            <input multiple="" id="images" type="file" name="images[]" value=""
                                                placeholder="Add Image" required="" />

                                            <a title="Add" href="javascript:void(0);" class="add_button"
                                                title="Add field">&nbsp;&nbsp;&nbsp;<i class="fas fa-plus-square"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add Images</button>
                            </div>
                        </div>
                    </div>

                </form>
                <!-- card -->
                <form name="editImagesForm" id="editImagesForm" method="post"
                    action="{{ URL('admin/add-images/' . $productdata['id']) }}">@csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Added Products Images</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="products" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productdata['images'] as $image)
                                        <input style="display: none" type="text" name="attrId[]"
                                            value="{{ $image['id'] }}">
                                        <tr>
                                            <td>{{ $image['id'] }}</td>
                                            <td>
                                                <img style="width:40px"
                                                    src="{{ asset('images/product_images/small/' . $image['image']) }}">
                                            </td>
                                            <td>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a title="Delete Images" href="javascript:void(0)" class="confirmDelete"
                                                    record="image" recordid="{{ $image['id'] }}">Delete
                                                    Image&nbsp;&nbsp;&nbsp;<i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Uppdate Images</button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </form>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
