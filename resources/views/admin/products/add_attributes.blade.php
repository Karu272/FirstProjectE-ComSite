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
                            <li class="breadcrumb-item active">Products Attributes</li>
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
                <form name="addAttributeForm" id="addAttributeForm" method="post"
                    action="{{ URL('admin/add-attributes/' . $productdata['id']) }}">@csrf

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
                                            <input id="stock" type="number" name="stock[]" value="" placeholder="stock"
                                                required="" />
                                            <input id="sku" type="text" name="sku[]" value="" placeholder="SKU code"
                                                required="" />
                                            <a title="Add" href="javascript:void(0);" class="add_button"
                                                title="Add field">&nbsp;&nbsp;&nbsp;<i class="fas fa-plus-square"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add Attributes</button>
                            </div>
                        </div>
                    </div>

                </form>
                <!-- card -->
                <form name="editAttributeForm" id="editAttributeForm" method="post"
                    action="{{ URL('admin/edit-attributes/' . $productdata['id']) }}">@csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Added Products Attributes</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="products" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Stock</th>
                                        <th>SKU</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productdata['attributes'] as $attribute)
                                        <input required style="display: none" type="text" name="attrId[]"
                                            value="{{ $attribute['id'] }}">
                                        <tr>
                                            <td>{{ $attribute['id'] }}</td>
                                            <td><input required type="number" name="stock[]" value="{{ $attribute['stock'] }}"
                                                    required=""></td>
                                            <td>{{ $attribute['sku'] }}</td>
                                            <td>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a title="Delete Attribute" href="javascript:void(0)" class="confirmDelete"
                                                    record="attribute" recordid="{{ $attribute['id'] }}"><i
                                                        class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Uppdate Attributes</button>
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
