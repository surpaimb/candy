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

            <!--


            STILL WORK IN PROGRESS!


            -->

            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="element content page">
                    <header>
                        <h1>Order History</h1>
                    </header>
                    <hr>
                    <div class="order-details">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Order Details</h5>

                                <div class="row ">
                                    <div class="col-xs-12">
                                        <p><strong>Order No.:</strong></p>
                                    </div>
                                    <div class="col-xs-12 order-no">
                                        <p>{!! $order['reference'] !!}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    {{--<div class="col-md-6">
                                        <p><strong>Reference:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{!! $order['reference'] !!}</p>
                                    </div>--}}
                                    <div class="col-md-6">
                                        <p><strong>Order Date:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{!! date('d/m/Y', strtotime($order['created_at']['date'])) !!}</p>
                                    </div>
                                    {{--<div class="col-md-6">
                                        <p><strong>Order Method:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Online</p>
                                    </div>--}}
                                    <div class="col-md-6">
                                        <p><strong>Order Status:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{!! $order['status'] !!}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Total:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{!! $currency['symbol'] !!}{!! $order['total'] !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Payment Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Cardholder:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{!! $order['billing']['firstname'] !!} {!! $order['billing']['lastname'] !!}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Card type:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Visa</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Card number:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>**** **** **** 7456</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Billing Address:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            {!! $order['billing']['address'] !!}<br>
                                            {!! $order['billing']['city'] !!}<br>
                                            {!! $order['billing']['county'] !!}<br>
                                            {!! $order['billing']['zip'] !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <h5>Delivery Address</h5>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    {!! $order['shipping']['firstname'] !!} {!! $order['shipping']['lastname'] !!}<br>
                                    {!! $order['shipping']['address'] !!}<br>
                                    {!! $order['shipping']['city'] !!}<br>
                                    {!! $order['shipping']['county'] !!}<br>
                                    {!! $order['shipping']['zip'] !!}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Delivery Service:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{!! $order['shipping_method'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="order-lines">

                            @forelse($order['lines']['data'] as $line)
                                <div class="order-line">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><span class="quantity">{!! $line['quantity'] !!}</span> x {!! $line['product'] !!} <span class="option">(Detox)</span></p>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <p>&pound;{!! $line['total'] !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h2>no orders</h2>
                            @endforelse

                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-8">
                                <div class="row order-totals">
                                    <div class="col-md-6">
                                        <p>Sub Total</p>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <p>&pound;{!! $order['total'] !!}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Delivery</p>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <p>{!! $order['shipping_total'] = '0.00' ? 'FREE' : '£'.$order['shipping_total'] !!}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>VAT Total</p>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <p>&pound;{!! $order['vat'] !!}</p>
                                    </div>
                                    <div class="col-md-6 order-total">
                                        <p>Order Total</p>
                                    </div>
                                    <div class="col-md-6 text-right order-total">
                                        <p>&pound;{!! $order['total'] !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <div class="btn-horizontal-group">
                                        <button class="btn btn-sm btn-green">Print Invoice <i class="fa fa-print" aria-hidden="true"></i></button>
                                        <button class="btn btn-sm btn-green">Email Invoice <i class="fa fa-envelope" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@stop
@section('bodyscript')
@stop