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
                            <li class="breadcrumb-item active">Listning page right banner</li>
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
                                <h3 class="card-title">Listining right Imgs</h3>
                                <a href="{{ URL('admin/add-edit-listright') }}"
                                    style="max-width: 150px; float: right; display:inline-block"
                                    class="btn btn-block btn-success">Add Img</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="listrightImg" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>First txt</th>
                                            <th>Second txt</th>
                                            <th>Third txt</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listrightDBdata as $right)
                                            <tr>
                                                <td>{{ $right['id'] }}</td>
                                                <td>{{ $right['title'] }}</td>
                                                <td>
                                                    <img style="width: 150px"
                                                        src="{{ asset('images/banner_images/' . $right['listrightImg']) }}">
                                                </td>
                                                <td>{{ $right['first'] }}</td>
                                                <td>{{ $right['second'] }}</td>
                                                <td>{{ $right['third'] }}</td>
                                                <td>
                                                    <a title="Edit Img"
                                                        href="{{ URL('admin/add-edit-listright/'. $right['id']) }}"><i
                                                            class="far fa-edit"></i></a>
                                                    &nbsp;&nbsp;
                                                    <a title="Delete Img" href="javascript:void(0)" class="confirmDelete"
                                                        record="listright" recordid="{{ $right['id'] }}"><i
                                                            class="far fa-trash-alt"></i></a>
                                                    &nbsp;&nbsp; <!-- record needs same name as 'delete- ?? ' in web.php -->
                                                    @if ($right['status'] == 1)
                                                        <a class="updatelistrightStatus"
                                                            id="listright-{{ $right['id'] }}"
                                                            listright_id="{{ $right['id'] }}"
                                                            href="javascript:void(0)"><i class="fas fa-toggle-on"
                                                                aria-hidden="true" status="Active"></i></a>
                                                    @else
                                                        <a class="updatelistrightStatus"
                                                            id="listright-{{ $right['id'] }}"
                                                            listright_id="{{ $right['id'] }}"
                                                            href="javascript:void(0)"><i class="fas fa-toggle-off"
                                                                aria-hidden="true" status="Inactive"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <p>OBS! Only one active picture at the time.</p>
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
