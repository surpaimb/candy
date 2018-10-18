@extends('_layouts/base')
@section('title', ' | Get Candy')
@section('meta-desciption', '')

@section('content')

    {{-- Breadcrumbs --}}
    <div class="container-fluid push-top">
        <div class="row breadcrumbs">
            <div class="col-xs-12">
                <ol>
                    <li><i class="fa fa-home" aria-hidden="true"></i> <a href="/">Home</a></li>
                    <li><a href="{!! URL::previous() !!}">Back to previous page</a></li>
                </ol>
            </div>
        </div>
    </div>
    {{-- END Breadcrumbs --}}

    <main class="container-fluid page no-mar-top">
        <div class="row">
            <div class="col-xs-12">
                <div class="element standard basket">

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <h3>Your Basket</h3>
                        </div>
                        <div class="col-xs-12 col-sm-6 text-right">
                            <basket-proceed-btn logged-in="{!! $loggedIn !!}"></basket-proceed-btn>
                        </div>
                    </div>
                    <hr>

                    <basket-lines></basket-lines>

                    <div class="basket-btm">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-sm-push-6 col-md-4 col-md-push-8">

                                <basket-discount></basket-discount>

                                <basket-totals></basket-totals>

                                <basket-proceed-btn logged-in="{!! $loggedIn !!}"></basket-proceed-btn>

                            </div>

                            <div class="col-xs-12 col-sm-6 col-sm-pull-6 col-md-8 col-md-pull-4">
                                <div class="row promo-area table-layout">
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <a href="/trade-account" class="element promo-box">
                                            <h3>
                                            <small>Great Discounts</small>
                                            For Sweet Shops
                                            </h3>
                                            <button type="button" class="btn btn-green btn-sm">Find out more</button>
                                            <img src="images/getcandy/promotions/tradesmen.jpg" class="promo-img edge bottom" alt="Great discounts for Sweet Shops">
                                        </a>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <a href="/delivery-information" class="element promo-box text-center">
                                            <h3>
                                                Free Shipping
                                                <small>on all <br>orders over</small>
                                            </h3>
                                            <span class="price">
                                                @if(userHasRole('trade'))
                                                <small>&pound;</small>300<br><small style="display: block; line-height: 0.2;">+VAT</small>
                                                @else
                                                <small>&pound;</small>50
                                                @endif
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <basket-proceed-modal></basket-proceed-modal>

    @include('_partials.newsletter')
@stop