@extends('_layouts/base')
@section('title', ' | Get Candy')
@section('meta-desciption', '')

@section('content')

    <div class="container-fluid push-top">
        <div class="row breadcrumbs">
            <div class="col-xs-12">
                <ol>
                    <li><i class="fa fa-home" aria-hidden="true"></i> <a href="/">Home</a></li>
                    <li><a href="/about-us">About Us</a></li>
                </ol>
            </div>
        </div>
    </div>

    <main class="container-fluid page no-mar-top">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="btn-group phone">
                    <button type="button" class="btn btn-blue side-menu">Menu</button>
                </div>
                <div class="side-bar">
                    <div class="element aside">
                        @include('_partials/info-sidebar')
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="element content page">
                    @if(\Session::has('success'))
                        <div class="alert alert-success">
                            <p>Your request has been sent</p>
                        </div>
                    @endif
                    <header>
                        <h1>Sweet Shop Account</h1>
                    </header>

                    <hr>

                    <p>Chocolate fruitcake dragée topping toffee gummies ice cream chocolate. Marshmallow chocolate bar ice cream marzipan. Biscuit gummi bears biscuit gingerbread donut.</p>

                    <p>Please fill out the form below with your trading details to enable us to look into your status.</p>

                    <div class="contact-details">
                        <h5>Apply for a Sweet Shop Account</h5>

                        <!-- NEED HOOKING UP -->

                        <form action="/trade-request" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Contact Name</label>
                                    <input name="contactName" type="text" class="form-control" required>
                                    @if ($errors->has('contactName'))
                                        <div class="error">{{ $errors->first('contactName') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Business Name</label>
                                    <input name="businessName" type="text" class="form-control" required>
                                    @if ($errors->has('businessName'))
                                        <div class="error">{{ $errors->first('businessName') }}</div>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Business Address</label>
                                    <input name="businessAddress" type="text" class="form-control" required>
                                    @if ($errors->has('businessemail'))
                                        <div class="error">{{ $errors->first('businessAddress') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <input name="city" type="text" class="form-control" required>
                                    @if ($errors->has('city'))
                                        <div class="error">{{ $errors->first('city') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label>County</label>
                                    <!-- Can we have this a select box with all the counties-->
                                    <input name="county" type="text" class="form-control" required>
                                    @if ($errors->has('county'))
                                        <div class="error">{{ $errors->first('county') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Post Code</label>
                                    <input name="postCode" type="text" class="form-control" required>
                                    @if ($errors->has('postCode'))
                                        <div class="error">{{ $errors->first('postCode') }}</div>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Business Email</label>
                                    <input name="businessEmail" type="email" class="form-control" required>
                                    @if ($errors->has('businessemail'))
                                        <div class="error">{{ $errors->first('businessEmail') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Website</label>
                                    <input name="website" type="tel" class="form-control">
                                    @if ($errors->has('website'))
                                        <div class="error">{{ $errors->first('website') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Primary Contact No.</label>
                                    <input name="primaryContact" type="tel" class="form-control">
                                    @if ($errors->has('primaryContact'))
                                        <div class="error">{{ $errors->first('primaryContact') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mobile Contact No.</label>
                                    <input name="mobileContact" type="tel" class="form-control">
                                    @if ($errors->has('mobileContact'))
                                        <div class="error">{{ $errors->first('mobileContact') }}</div>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-green">Send Application</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @include('_partials.newsletter')
@stop