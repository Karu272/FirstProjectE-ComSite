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
                            <li class="breadcrumb-item active">Add/edit info</li>
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
                <form name="infoForm" id="infoForm" @if (empty($infoData['id'])) action="{{URL('admin/add-edit-info')}}" @else action="{{ URL('admin/add-edit-info/' . $infoData['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
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
                                        <label  for="title"> About Us Title</label>
                                        <input required type="text" class="form-control" name="title" id="title"
                                            placeholder="Enter 'About us' Title" @if (!empty($infoData['title'])) value="{{ $infoData['title'] }}" @else value="{{ old('title') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">About us Text</label>
                                        <textarea name="text" id="text" class="form-control" rows="6"
                                            placeholder="Enter 'About us' long text...." required>@if(!empty($infoData['text'])){{ $infoData['text'] }}@else{{ old('text') }}@endif</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address"> Contact us Address</label>
                                        <input required type="text" class="form-control" name="address" id="address"
                                            placeholder="Enter Img address" @if (!empty($infoData['address'])) value="{{ $infoData['address'] }}" @else value="{{ old('address') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone"> Contact us Phone</label>
                                        <input required type="text" class="form-control" name="phone" id="phone"
                                            placeholder="Enter 'Contact us' phone" @if (!empty($infoData['phone'])) value="{{ $infoData['phone'] }}" @else value="{{ old('phone') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="email"> Contact us Email</label>
                                        <input required type="text" class="form-control" name="email" id="email"
                                            placeholder="Enter 'Contact us' Email" @if (!empty($infoData['email'])) value="{{ $infoData['email'] }}" @else value="{{ old('email') }}" @endif>
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
