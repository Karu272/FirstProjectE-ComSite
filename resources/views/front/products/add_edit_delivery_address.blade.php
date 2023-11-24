@extends('layouts.front_layout.front_layout')
@section('content')
    <!-- banner -->
    <div class="banner10" id="home1">
        <div class="container">
            <h2>Edit/Update Delivery info</h2>
        </div>
    </div>
    <!-- //banner -->

    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="{{ URL('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                    <i>/</i></li>
                <li>Edit/Update Delivery info</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->

    <div id="myModal88" role="dialog" aria-labelledby="myModal88">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="margin-top: 20px" class="modal-title" id="myModalLabel"> {{ $title }}</h4>
                    <hr class="soft" />

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
                    @if ($errors->any())
                        <div class="alert alert-danger" style="margin-top: 10px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="modal-body modal-body-sub">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="sap_tabs">

                                    <div class="span4">
                                        <div class="well">
                                            Enter your delivery address details<br /><br />
                                            <form id="deliveryAddressForm" @if (empty($address['id'])) action="{{ url('/add-edit-delivery-address') }}" @else action="{{ url('/add-edit-delivery-address/' . $address['id']) }}" @endif method="post">@csrf
                                                <div class="control-group">
                                                    <label class="control-label" for="name">Name</label>
                                                    <div class="controls">
                                                        <input class="span3" type="text" id="name" name="name"
                                                            placeholder="Enter Name" @if (isset($address['name'])) value="{{ $address['name'] }}" @else value="{{ old('name') }}" @endif required="">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="address">Address</label>
                                                    <div class="controls">
                                                        <input class="span3" type="text" id="address" name="address"
                                                            placeholder="Enter Address" @if (isset($address['address'])) value="{{ $address['address'] }}" @else value="{{ old('address') }}" @endif>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="city">City</label>
                                                    <div class="controls">
                                                        <input class="span3" type="text" id="city" name="city"
                                                            placeholder="Enter City" @if (isset($address['city'])) value="{{ $address['city'] }}" @else value="{{ old('city') }}" @endif>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="state">Province</label>
                                                    <div class="controls">
                                                        <input class="span3" type="text" id="province" name="province"
                                                            placeholder="Enter Province" @if (isset($address['province'])) value="{{ $address['province'] }}" @else value="{{ old('state') }}" @endif>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="country">Country</label>
                                                    <div class="controls">
                                                        <select class="span3" id="country" name="country"
                                                            style="width: 160px">
                                                            <option value="">Select Country</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country['country_name'] }}" @if ($country['country_name'] == $address['country']) selected="" @elseif($country['country_name']==old('country')) selected="" @endif>{{ $country['country_name'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="pincode">Pincode</label>
                                                    <div class="controls">
                                                        <input class="span3" type="text" id="pincode" name="pincode"
                                                            placeholder="Enter Pincode" @if (isset($address['pincode'])) value="{{ $address['pincode'] }}" @else value="{{ old('pincode') }}" @endif>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="mobile">Mobile</label>
                                                    <div class="controls">
                                                        <input class="span3" type="text" id="mobile" name="mobile"
                                                            placeholder="Enter Mobile" @if (isset($address['mobile'])) value="{{ $address['mobile'] }}" @else value="{{ old('mobile') }}" @endif>
                                                    </div>
                                                </div>
                                                <div class="controls" style="margin-top: 20px">
                                                    <button type="submit" class="btn block">Submit</button>
                                                    <a style="float: right;" class="btn block"
                                                        href="{{ url('checkout') }}">Back</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <br>
    <br>
    <br>
    <br>

@endsection
