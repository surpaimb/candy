@extends('_layouts/checkout')
@section('title', 'Checkout | Get Candy')
@section('meta-desciption', '')

@section('content')

    {{--
    <div class="container-fluid push-top">
        <div class="row breadcrumbs">
            <div class="col-xs-12">
                <ol>
                    <li><i class="fa fa-home" aria-hidden="true"></i> <a href="/">Home</a></li>
                    <li><a href="/basket">Back to basket</a></li>
                </ol>
            </div>
        </div>
    </div>
    --}}

    <main class="container-fluid page no-mar-top">
        <div class="row">
            <div class="col-xs-12">
                <div class="element standard checkout-process">
                    
                    <div class="row">

                        <div class="col-xs-12">
                            <div class="text-center">
                                <p class="h1">Checkout</p>
                            </div>
                        </div>

                        {{-- Summary Basket --}}
                        <div class="col-xs-12 col-md-4 col-md-push-8">

                            <checkout-basket-summary></checkout-basket-summary>

                        </div>
                        {{-- End Summary Basket --}}

                        {{-- Main Content --}}
                        <div class="col-xs-12 col-md-8 col-md-pull-4">
                        
                            {{-- Delivery Address --}}
                            <checkout-delivery-address :regions="{{ json_encode($regions) }}" :prefill="{{ json_encode($order) }}"></checkout-delivery-address>
                            {{-- End Delivery Address --}}

                            {{-- Delivery Method --}}
                            <checkout-delivery-method :methods="{{ json_encode($deliveryMethods) }}"></checkout-delivery-method>
                            {{-- End Delivery Options --}}

                            {{-- Contact Details --}}
                            <checkout-contact-details :prefill="{{ json_encode($order) }}"></checkout-contact-details>
                            {{-- End Contact Details --}}

                            {{-- Payment Details --}}
                            <checkout-payment-details :regions="{{ json_encode($regions) }}" :prefill="{{ json_encode($order) }}" auth="{{ $paymentAuth }}"></checkout-payment-details>
                            {{-- End Payment Details --}}

                        </div>
                         {{-- End Main Content --}}

                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- @include('_partials.newsletter') --}}
@stop
@section('headscript')
    <!-- Load the Client component. -->
    <script src="https://js.braintreegateway.com/web/3.26.0/js/client.min.js"></script>

    <!-- Load the 3D Secure component. -->
    <script src="https://js.braintreegateway.com/web/3.26.0/js/three-d-secure.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.9.2/js/dropin.min.js"></script>
@stop