
@extends('layouts.admin_layout.admin_layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Information</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Information</li>
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
                        <!-- /.card -->
                        <!-- Success MSG start -->
                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="margin-top: : 10px">
                                {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <!-- Success MSG end -->
                        <!-- card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">About text</h3>
                                <a href="{{ URL('admin/add-edit-info') }}"
                                    style="max-width: 150px; float: right; display:inline-block"
                                    class="btn btn-block btn-success">Add info</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="row">
                                <div class="span4">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Text</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($aboutContactInfo as $info)
                                            <tr>
                                                <th>{{$info['title']}}</th>
                                                <th>{{$info['text']}}</th>
                                                <th>&nbsp;&nbsp;<a title="Edit Info"
                                                    href="{{ URL('admin/add-edit-info/'. $info['id']) }}"><i
                                                        class="far fa-edit"></i></a>
                                                &nbsp;&nbsp;</th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Contact info</h3>
                            </div>
                            <div class="row">
                                <div class="span4">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($aboutContactInfo as $info)
                                            <tr>
                                                <th>{{$info['address']}}</th>
                                                <th>{{$info['phone']}}</th>
                                                <th>{{$info['email']}}</th>
                                                <th>&nbsp;&nbsp;<a title="Edit Info"
                                                    href="{{ URL('admin/add-edit-info/'. $info['id']) }}"><i
                                                    class="far fa-edit"></i></a>
                                                    &nbsp;&nbsp;</th>
                                            </tr>
                                        @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
