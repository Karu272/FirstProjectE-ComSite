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
                            <li class="breadcrumb-item active">Catagories</li>
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
                <form name="categoryForm" id="CategoryForm" @if (empty($categorydata['id'])) action="{{ URL('admin/add-edit-category') }}" @else action="{{ URL('admin/add-edit-category/' . $categorydata['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
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
                                    <!-- append start  -->
                                    <div id="appendCategoriesLevel">
                                        @include('admin.categories.append_categories_level')
                                        Just leave this as main
                                    </div>
                                    <!-- append end  -->
                                    <div class="form-group">
                                        <label>Select Section</label>
                                        <select id="section_id" name="section_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach ($getSections as $section)
                                                <option value="{{ $section->id }}" @if (!empty($categorydata['section_id']) && $categorydata['section_id'] == $section->id) selected @endif>{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- append end  -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_name">Category</label>
                                        <input required type="text" class="form-control" name="category_name" id="category_name"
                                            placeholder="Enter Category Name" @if (!empty($categorydata['category_name'])) value="{{ $categorydata['category_name'] }}" @else value="{{ old('category_name') }}" @endif>EXAMPLE; lipgloss, lipstick, wash oil, face peeler etc
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="url">URL</label>
                                        <input required type="text" class="form-control" name="url" id="url"
                                            placeholder="Enter url Name" @if (!empty($categorydata['url'])) value="{{ $categorydata['url'] }}" @else value="{{ old('url') }}" @endif> Note; Same name as "Category"
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
