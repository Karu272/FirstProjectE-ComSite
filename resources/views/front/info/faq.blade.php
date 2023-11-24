
@extends('layouts.front_layout.front_layout')
@section('content')
    <!-- banner -->
    <div class="banner10" id="home1">
        <div class="container">
            <h2>FAQs</h2>
        </div>
    </div>
    <!-- //banner -->

    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="{{ URL('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                    <i>/</i></li>
                <li>FAQ's</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->

    <div class="checkout">
        <div class="container">
            <div class="span9 faqBorder">                
                <div class="row faqMargin">
                    <h2 class="faqInner">FAQs</h2>                  
                        @foreach ($getFAQs as $faq)
                        <div class="modal-header">
                            <h3 class="faqInnerInner">{{ $faq['title'] }}</h3>
                        </div>
                        <br>
                            <h5 style="margin-bottom: 50px">{{ $faq['text'] }}</h5>
                            <hr class="soft" />
                        @endforeach  
                </div>
            </div>
            <button class="trance">
                <p style="margin-top: 14px"><a class="item_add"
                        href="{{ URL('/') }}">Back</a></p>
            </button> 
        </div>
    </div>
@endsection
