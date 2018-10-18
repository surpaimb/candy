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
                <div class="element content page">
                    <header>
                        <h1>Order History</h1>
                    </header>
                    <hr>
                    <p>If you require details of specific orders please contact us on 01234 567890 or fill out our <a href="/contact">enquiry form</a>.</p>
                    <br>
                    @forelse ($orders as $order)

                        <div class="order-line">
                            <div class="row">
                                <div class="col-md-5">
                                    <p>Order Placed: <strong>{!! date('d/m/Y', strtotime($order['created_at']['date'])) !!}</strong></p>{{-- 05/01/2018 --}}
                                    <p class="order-no">Order No.: <strong>{!! $order['reference'] !!}</strong></p>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Order Status: {!! $order['status'] !!}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-md-push-6">
                                            <div class="product-price">
                                                <div class="numeric numeric-lg">&pound;{!! $order['total'] !!}</div>
                                                <span class="vat">Inc.<br>VAT</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-md-pull-6">
                                            <a href="/account/order/{!! $order['id'] !!}" class="btn btn-xs btn-lighter-blue">View Order Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <hr>
                        <p class="text-center">You have not yet placed an order</p>
                        <hr>
                    @endforelse

                </div>
            </div>
        </div>
    </main>

@stop
@section('bodyscript')
@stop