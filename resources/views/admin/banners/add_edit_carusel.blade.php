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
                            <li class="breadcrumb-item active">Add/edit img</li>
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
                <form name="caruselImgForm" id="caruselImgForm" @if (empty($caruselData['id'])) action="{{URL('admin/add-edit-carusel')}}" @else action="{{ URL('admin/add-edit-carusel/' . $caruselData['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
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
                                        <label for="title">Img Title</label>
                                        <input required type="text" class="form-control" name="title" id="title"
                                            placeholder="Enter Img Title" @if (!empty($caruselData['title'])) value="{{ $caruselData['title'] }}" @else value="{{ old('title') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="first">First txt</label>
                                        <input type="text" class="form-control" name="first" id="first"
                                            placeholder="Enter first txt" @if (!empty($caruselData['first'])) value="{{ $caruselData['first'] }}" @else value="{{ old('first') }}" @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input required type="file" class="custom-file-input" name="caruselImg"
                                                    id="caruselImg" accept="image/*">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>
                                        </div>
                                        <div>Image must be size: width: 1600px, Height: 400px </div>
                                        @if (!empty($caruselData['caruselImg']))
                                            <div>
                                                <img style="width:80px; margin-top:5px"
                                                    src="{{ asset('images/banner_images/'. $caruselData['caruselImg']) }}">
                                                &nbsp;
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="second">Second txt</label>
                                        <input required name="second" id="second" class="form-control" rows="1"
                                            placeholder="Enter second txt" @if (!empty($caruselData['second'])) value="{{ $caruselData['second'] }}" @else value="{{ old('second') }}" @endif>
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
