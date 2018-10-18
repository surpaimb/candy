@extends('_layouts/checkout')
@section('title', 'Order Confirmation')
@section('meta-desciption', '')

@section('content')

    <main class="container-fluid page">
        <div class="row">
            <div class="col-xs-12">
                <div class="element standard checkout-process finished">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">

                            <p class="h1 thank-you">
                                <strong>Thank you</strong>, your order has been placed
                            </p>

                            <p class="confirmation">
                                We've sent you an email confirmation with all your details.
                            </p>

                            <div class="thankyou-box order-details">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4">
                                        <p>Order Reference</p>
                                        <p class="focus">{{ $order['reference'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="thankyou-box share-order">
                                <p class="h3">Share your order with your friends</p>
                                <ul class="social-links">
                                    <li class="facebook"><a href="#" target="_blank" rel="noopener"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li class="twitter"><a href="#" target="_blank" rel="noopener"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li class="email"><a href="#" target="_blank" rel="noopener"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <div class="thankyou-box email-signup">
                                <p class="h3">Interested in receiving emails about all our latest deals?</p>
                                <p>Based on your order we’ll send you relevant promotions and items that suit you.</p>
                                <form method="get" target="_blank" novalidate>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm btn-light-blue" type="submit" name="subscribe">Subscribe</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 feed-back">

                            @if(\Session::has('success'))
                                <div class="alert alert-success">
                                    <p>Your feedback has been received, Thank you.</p>
                                </div>
                            @endif

                            <form action="/contact/feedback" method="post">

                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Please take a moment to rate your shopping experience.</label>
                                    <div class="inline-radio-list">
                                        <div class="radio custom-radio">
                                            <label>
                                                <input type="radio" name="rating" id="optionsRadios1" value="1 - Bad">
                                                <span>
                                                    1
                                                    <small><em>Bad</em></small>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="radio custom-radio">
                                            <label>
                                                <input type="radio" name="rating" id="optionsRadios2" value="2">
                                                <span>
                                                    2
                                                </span>
                                            </label>
                                        </div>
                                        <div class="radio custom-radio">
                                            <label>
                                                <input type="radio" name="rating" id="optionsRadios3" value="3">
                                                <span>
                                                    3
                                                </span>
                                            </label>
                                        </div>
                                        <div class="radio custom-radio">
                                            <label>
                                            <input type="radio" name="rating" id="optionsRadios4" value="4">
                                                <span>
                                                    4
                                                </span>
                                            </label>
                                        </div>
                                        <div class="radio custom-radio">
                                            <label>
                                                <input type="radio" name="rating" id="optionsRadios5" value="5 - Excellent" checked>
                                                <span>
                                                    5
                                                    <small><em>Excellent</em></small>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Any other feedback you'd like to leave us?</label>
                                    <textarea name="feedback" rows="6" class="form-control"></textarea>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-green">Submit Feedback</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('_partials.newsletter')
@stop