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
                            <li class="breadcrumb-item active">Add/edit FAQ</li>
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
                <form name="faqForm" id="faqForm" @if (empty($faqData['id'])) action="{{URL('admin/add-edit-faq')}}" @else action="{{ URL('admin/add-edit-faq/' . $faqData['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title"> FAQ Title</label>
                                        <input required type="text" class="form-control" name="title" id="title"
                                            placeholder="Enter 'About us' Title" @if (!empty($faqData['title'])) value="{{ $faqData['title'] }}" @else value="{{ old('title') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">FAQ Text</label>
                                        <input required name="text" id="text" class="form-control" rows="6"
                                            placeholder="Enter 'About us' long text...."@if (!empty($faqData['text'])) value="{{ $faqData['text'] }}" @else value="{{ old('text') }}" @endif>
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
