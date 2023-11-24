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
                            <li class="breadcrumb-item active">Shipping charges</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Error msg start  -->
                @if (Session::has('success_message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php Session::forget('success_message'); ?>
                @endif
                @if (Session::has('error_message'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php Session::forget('error_message'); ?>
                @endif
                <!-- Success msg end  -->
                <!-- SELECT2 EXAMPLE -->
                <form name="shippingForm" id="shippingForm"
                    action="{{ URL('admin/edit-shipping-charges/' . $shippingDetails['id']) }}" method="post"
                    enctype="multipart/form-data">@csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Update shipping charges</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Country Country</label>
                                        <input class="form-control" readonly value="{{ $shippingDetails['country'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="0_500g">Shipping Charges (0 - 500g)</label>
                                        <input required type="text" class="form-control" name="0_500g"
                                            id="0_500g" placeholder="Enter Shipping Charges" @if (!empty($shippingDetails['0_500g'])) value="{{ $shippingDetails['0_500g'] }}" @else value="{{ old('0_500g') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="501_1000g">Shipping Charges (501 - 1000g)</label>
                                        <input required type="text" class="form-control" name="501_1000g"
                                            id="501_1000g" placeholder="Enter Shipping Charges" @if (!empty($shippingDetails['501_1000g'])) value="{{ $shippingDetails['501_1000g'] }}" @else value="{{ old('501_1000g') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="1001_2000g">Shipping Charges (1001 - 2000g)</label>
                                        <input required type="text" class="form-control" name="1001_2000g"
                                            id="1001_2000g" placeholder="Enter Shipping Charges" @if (!empty($shippingDetails['1001_2000g'])) value="{{ $shippingDetails['1001_2000g'] }}" @else value="{{ old('1001_2000g') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="2001_5000g">Shipping Charges (2001 - 5000g)</label>
                                        <input required type="text" class="form-control" name="2001_5000g"
                                            id="2001_5000g" placeholder="Enter Shipping Charges" @if (!empty($shippingDetails['2001_5000g'])) value="{{ $shippingDetails['2001_5000g'] }}" @else value="{{ old('2001_5000g') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="above_5000g">Shipping Charges (above - 5000g)</label>
                                        <input required type="text" class="form-control" name="above_5000g"
                                            id="above_5000g" placeholder="Enter Shipping Charges" @if (!empty($shippingDetails['above_5000g'])) value="{{ $shippingDetails['above_5000g'] }}" @else value="{{ old('above_5000g') }}" @endif>
                                    </div>
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
