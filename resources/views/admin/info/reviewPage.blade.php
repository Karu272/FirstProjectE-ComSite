
@extends('layouts.admin_layout.admin_layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>FAQs</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Reviews</li>
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
                        <!-- card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Reviews</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="row">
                                <div class="span4">
                                    <table id="review" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Title</th>
                                                <th>Text</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($reviewText as $review)
                                            <tr>
                                                <th>{{$review['name']}}</th>
                                                <th>{{$review['email']}}</th>
                                                <th>{{$review['title']}}</th>
                                                <th>{{$review['text']}}</th>
                                                <th>
                                                    &nbsp;&nbsp;
                                                    @if ($review['status'] == 1)
                                                        <a class="updateReviewStatus" id="review-{{ $review['id'] }}"
                                                            review_id="{{ $review['id'] }}" href="javascript:void(0)"><i
                                                                class="fas fa-toggle-on" aria-hidden="true"
                                                                status="Active"></i></a>
                                                    @else
                                                        <a class="updateReviewStatus" id="review-{{ $review['id'] }}"
                                                            review_id="{{ $review['id'] }}" href="javascript:void(0)"><i
                                                                class="fas fa-toggle-off" aria-hidden="true"
                                                                status="Inactive"></i></a>
                                                    @endif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a title="Delete Review" href="javascript:void(0)" class="confirmDelete"
                                                        record="review" recordid="{{ $review['id'] }}"><i
                                                            class="far fa-trash-alt"></i></a>
                                                    &nbsp;&nbsp; <!-- record needs same name as 'delete- ?? ' in web.php -->
                                            </th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
