<?php
use App\Models\Cart;
use App\Models\Product;
?>
@extends('layouts.front_layout.front_layout')
@section('content')
    <!-- banner -->
    <div class="banner10" id="home1">
        <div class="container">
            <h2>Shopping Cart</h2>
        </div>
    </div>
    <!-- //banner -->
    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="{{ URL('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                    <i>/</i></li>
                <li>Chopping Cart</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <!-- cart -->
    <div id="AppendCartItems">
        <!-- Success/error msg -->
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
        <!-- // Success/error msg -->
        @include('front.products.cart_items')
    </div>
    <!-- //cart -->
    <div class="w3l_related_products">
        @include('front.banners.home_page_banners')
    </div>
@endsection
