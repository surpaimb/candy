{{-- Top Bar --}}
<div class="container-fluid top element">
    <div class="row">
        <div class="col-xs-6 col-md-4">
            <p class="phone-number"><span class="hidden-xs">Have an enquiry?</span> Call  <strong itemprop="telephone">0124 123 4313</strong></p>
        </div>
        <div class="hidden-xs hidden-sm col-md-5">
            <nav>
                <ul>
                    <li><a href="/contact" title="Got to our Contact page">Contact Us</a></li>
                    <li><a href="/about" title="Got to our About page">About</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-xs-6 col-md-3 top-right">
            @if(env('APP_LANGUAGE', 'en') == 'fr')
                <div class="language">
                    <language-select :value="{{ json_encode(Session::get('language')) }}"></language-select>
                </div>
            @endif
            <vat-toggle :value="{{ json_encode(Session::get('excl_tax')) }}"></vat-toggle>
        </div>
    </div>
</div>
{{-- END Top Bar --}}

{{-- Header Area --}}
<div class="container-fluid header">
    <div class="row">

        <div class="col-xs-6 col-sm-4 col-md-2">
            <a href="/" class="logo" title="Go back to homepage">
                <img src="/images/getcandy/branding/get-candy.png" alt="Get Candy">
            </a>
        </div>

        <div class="col-xs-12 col-sm-4 search">
            <search></search>
        </div>

        <div class="col-xs-6 col-sm-8 col-md-6 text-right">
            <a href="/delivery-information" class="free-shipping">
                <div class="info">
                    <strong>Free Shipping</strong>
                    on orders over
                </div>
                @if(userHasRole('trade'))
                <div class="price-band trade">
                    {!! $currency['symbol'] !!}<strong>{!! priceConverter(300) !!}</strong><small>+VAT</small>
                </div>
                @else
                <div class="price-band">
                    {!! $currency['symbol'] !!}<strong>{!! priceConverter(50) !!}</strong>
                </div>
                @endif
            </a>
            <nav class="store">
                <ul>
                    <li class="account">
                        <div class="store-img">
                            <i class="fa fa-user store-icon" aria-hidden="true"></i>
                        </div>

                        <div class="store-3txt">
                            <p class="store-title">Account <i class="fa fa-caret-down" aria-hidden="true"></i></p>
                        </div>

                        <div class="account-menu">

                            @if (isset($loggedIn))
                                <ul class="account-links">
                                    <li><a href="/account">Account</a></li>
                                    <li><a href="/account/orders">Orders</a></li>
                                    <li><a href="/account/details">Personal Details</a></li>
                                    <li><a href="/account/password">New Password</a></li>
                                </ul>
                                <ul>
                                    <li class="sign-in"><a href="/logout" class="btn btn-green btn-sm">Sign Out</a></li>
                                </ul>
                            @else
                                <ul>
                                    <li class="sign-in"><a href="/login" class="btn btn-green btn-sm">Sign In</a></li>
                                    <li class="register"><a href="/register" class="btn btn-purple btn-sm">Register</a></li>
                                </ul>
                            @endif

                        </div>
                    </li>
                    <li class="basket">

                        <basket></basket>

                    </li>
                </ul>
            </nav>
        </div>

    </div>
</div>
{{-- END Header Area --}}