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
                            <li class="breadcrumb-item active">Brands</li>
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
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: : 10px">
                        {{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- Success msg end  -->
                <!-- SELECT2 EXAMPLE -->
                <form name="brandForm" id="brandForm" @if (empty($brand['id'])) action="{{ URL('admin/add-edit-brand') }}" @else action="{{ URL('admin/add-edit-brand/' . $brand['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
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
                                        <label for="brand_name">Brand Name</label>
                                        <input required type="text" class="form-control" name="brand_name" id="brand_name"
                                            placeholder="Enter brand name" @if (!empty($brand['name'])) value="{{ $brand['name'] }}" @else value="{{ old('name') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea type="text" name="description" id="description" class="form-control"
                                            rows="8"
                                            placeholder="Enter....">@if (!empty($brand['description'])) {{ $brand['description'] }} @else {{ old('description') }} @endif</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="url">URL</label>
                                        <input required type="text" class="form-control" name="url" id="url"
                                            placeholder="Enter url Name" @if (!empty($brand['url'])) value="{{ $brand['url'] }}" @else value="{{ old('url') }}" @endif> Note; Same name as "Brand name"
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Brand logo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input required type="file" class="custom-file-input" name="brand_logo"
                                                    id="brand_logo" accept="image/*">
                                                <label class="custom-file-label" for="brand_logo">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>
                                        </div>
                                        <div>Image must be size: width: 600px, Height 337px </div>
                                        @if (!empty($brand['brand_logo']))
                                            <div>
                                                <img style="width:80px; margin-top:5px"
                                                    src="{{ asset('images/brand_logos/' . $brand['brand_logo']) }}">
                                                &nbsp;
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="Submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection
