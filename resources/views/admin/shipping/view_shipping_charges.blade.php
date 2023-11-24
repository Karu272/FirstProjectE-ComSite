@extends('layouts.admin_layout.admin_layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
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
                    <div class="col-sm-6">
                        <h1>Shipping Charges</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Catalogues</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.card -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Shipping charges</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="shipping" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Country</th>
                                            <th>0 - 500g</th>
                                            <th>501 - 1000g</th>
                                            <th>1001 - 2000g</th>
                                            <th>2001 - 5000g</th>
                                            <th>above 5000g</th>
                                            <th>Status</th>
                                            <th>Updated at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shipping_charges as $shipping)
                                            <tr>
                                                <td>{{ $shipping['id'] }}</td>
                                                <td>{{ $shipping['country'] }}</td>
                                                <td>{{ $shipping['0_500g'] }}</td>
                                                <td>{{ $shipping['501_1000g'] }}</td>
                                                <td>{{ $shipping['1001_2000g'] }}</td>
                                                <td>{{ $shipping['2001_5000g'] }}</td>
                                                <td>{{ $shipping['above_5000g'] }}</td>
                                                <td>
                                                    @if($shipping['status'] == 1)
                                                        <a class="updateshippingStatus" id="shipping-{{ $shipping['id'] }}" shipping_id="{{ $shipping['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                                                    @else
                                                        <a class="updateshippingStatus" id="shipping-{{ $shipping['id'] }}" shipping_id="{{ $shipping['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                                                    @endif
                                                </td>
                                                <td>{{ date('d-m-Y'), strtotime($shipping['updated_at']) }}</td>
                                                <td>
                                                    <a title="Update Shipping Charges" href="{{ URL('admin/edit-shipping-charges/' . $shipping['id']) }}"><i class="far fa-edit"></i></a>&nbsp;&nbsp;
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
