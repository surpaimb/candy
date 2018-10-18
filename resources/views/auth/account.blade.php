@extends('_layouts/base')
@section('title', 'Account | Get Candy')
@section('meta-desciption', '')

@section('content')

    <div class="container-fluid push-top">
        <div class="row breadcrumbs">
            <div class="col-xs-12">
                <ol>
                    <li><i class="fa fa-home" aria-hidden="true"></i> <a href="/">Home</a></li>
                    <li><a href="/account">Account</a></li>
                </ol>
            </div>
        </div>
    </div>

    <main class="container-fluid page no-mar-top">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="btn-group phone">
                    <button type="button" class="btn btn-blue side-menu">Account Menu</button>
                </div>
                <div class="side-bar">
                    <div class="element aside">
                        <div class="title">Your Account</div>

                        @include('_partials/account-sidebar')
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="row account-dashboard">
                    <div class="col-md-4">
                        <a href="/account/orders" class="element product-box account-box">
                            <img src="/images//icons/account-orders.gif" alt="Orders Icon">
                            <p class="title">Orders</p>
                            <p>Track a current order or review orders from the last 12 months</p>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/account/details" class="element product-box account-box">
                            <img src="/images/icons/account-details.gif" alt="Personal Details Icon">
                            <p class="title">Personal Details</p>
                            <p>Update your name, contact details &amp; company details if required </p>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/account/password" class="element product-box account-box">
                            <img src="/images/icons/account-password.gif" alt="New Password Icon">
                            <p class="title">New Password</p>
                            <p>Update your password to keep your account secure</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

@stop
@section('bodyscript')
@stop