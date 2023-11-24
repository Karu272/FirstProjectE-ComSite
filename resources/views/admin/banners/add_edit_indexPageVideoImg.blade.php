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
                <form name="indexPageVideoImgForm" id="indexPageVideoImgForm" @if (empty($videoImg['id'])) action="{{ URL('admin/add-edit-indexPageVideoImg/')}}" @else action="{{ URL('admin/add-edit-indexPageVideoImg/' . $videoImg['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
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
                                            placeholder="Enter Img Title" @if (!empty($videoImg['title'])) value="{{ $videoImg['title'] }}" @else value="{{ old('title') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="link">Img Link</label>
                                        <input readonly="" type="text" class="form-control" name="link" id="link"
                                            placeholder="Enter Img Link" @if (!empty($videoImg['link'])) value="{{ $videoImg['link'] }}" @else value="{{ old('link') }}" @endif>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="indexPageVideoImg"
                                                    id="indexPageVideoImg" accept="image/*">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>
                                        </div>
                                        <div>Image must be size: width: 621px, Height:640px </div>
                                        @if (!empty($videoImg['indexPageVideoImg']))
                                            <div>
                                                <img style="width:80px; margin-top:5px"
                                                    src="{{ asset('images/banner_images/' . $videoImg['indexPageVideoImg']) }}">
                                                &nbsp;
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="alt">Alternative Text</label>
                                        <input readonly="" name="alt" id="alt" class="form-control" rows="1"
                                            placeholder="Enter alternative text...."@if (!empty($videoImg['alt'])) value="{{ $videoImg['alt'] }}" @else value="{{ old('alt') }}" @endif>
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
