@extends('_layouts/base')
@section('title', 'Get Candy | Demo Store')
@section('meta-desciption', '')

@section('content')

    @include('_partials/banner')

    <main class="container-fluid home">
        <div class="row">
            <!-- Promotional Area -->
            <section class="promo-area top-area">
                <div class="col-xs-12 col-md-6">
                    <div class="element promo-box video" style="background-image: url('/images/getcandy/promotions/video.jpg')">
                        <div class="center">
                            <lightbox href="https://www.youtube.com/watch?v=nkAWMtW1VT4&t=6s" classes="btn btn-green">
                                <img src="/images/icons/play.svg" alt="play video">
                            </lightbox>
                            <h3>Introducing Sweets!</h3>
                            <p>It's all about Get Candy</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <a href="#" class="element promo-box">
                                <h3>Drum Sticks</h3>
                                <span class="sale">
                                    <span class="center">
                                        from only
                                        <span class="price"><small>{!! $currency['symbol'] !!}</small>{!! priceConverter(1.55, false) !!}</span>
                                    </span>
                                </span>
                                <img src="/images/getcandy/promotions/drumsticks.jpg" class="promo-img" alt="Drumsticks">
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <a href="#" class="element promo-box">
                                <h3>Haribo Selections</h3>
                                <span class="sale">
                                    <span class="center">
                                        all under
                                        <span class="price">
                                            <small>{!! $currency['symbol'] !!}</small>{!! priceConverter(8.99, false) !!}
                                        </span>
                                    </span>
                                </span>
                                <img src="/images/getcandy/promotions/haribo.jpg" class="promo-img" alt="Haribo">
                            </a>
                        </div>
                        <div class="col-xs-12">
                            <a href="#" class="element promo-box">
                                <h3>Show someone you care!</h3>
                                <p class="promo-txt">Soufflé marzipan chocolate bar. Jelly-o jelly tootsie roll croissant danish pudding chocolate bar candy canes. Gummi bears jelly beans cupcake caramels. </p>
                                <span class="sale">
                                    <span class="center">
                                        from only
                                        <span class="price"><small>{!! $currency['symbol'] !!}</small>{!! priceConverter(2.99, false) !!}</span>
                                    </span>
                                </span>
                                <img src="/images/getcandy/promotions/love-hearts.jpg" class="promo-img right pull-top-md" alt="Love Hearts">
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END Promotional Area -->
        </div>
        <div class="row">
            <!-- Homepage Content -->
            <section class="col-xs-12 col-md-5 section-content">
                <header>
                    <h1>Great Sweet Selections from Get Candy</h1>
                </header>
                <p class="lead">Get Candy is the online brand for every sweet on earth!</p>

                <p>
                    Soufflé marzipan chocolate bar. Jelly-o jelly tootsie roll croissant danish pudding chocolate bar candy canes. Gummi bears jelly beans cupcake caramels. Chocolate bar tiramisu candy canes chocolate bar sugar plum macaroon tart. Icing dessert sesame snaps candy caramels donut jujubes.
                </p>

                <p>
                    Cotton candy dragée apple pie pastry sesame snaps. Sweet tart topping. Caramels croissant toffee gummi bears sesame snaps tart donut candy topping. Brownie cake powder. Fruitcake biscuit dessert. Oat cake pie bear claw jelly-o pudding. Cookie biscuit soufflé cake wafer muffin. Wafer cotton candy dragée carrot cake cookie powder jelly. Gummi bears tootsie roll jelly-o halvah sugar plum sugar plum icing.
                </p>

                <p>
                    Brownie sugar plum cupcake. Lollipop topping powder cake ice cream chocolate. Cotton candy fruitcake ice cream sugar plum candy canes. Gingerbread icing tart cotton candy sesame snaps icing marshmallow. Gummies gummi bears cookie apple pie gummies tart. Gummi bears donut caramels marzipan oat cake jelly-o sesame snaps cookie lemon drops. Carrot cake cookie dessert marshmallow icing apple pie.
                </p>

            </section>
            <!-- END Homepage Content -->
            <!-- Promotional Area -->
            <section class="col-xs-12 col-md-6 col-md-offset-1 promo-area table-layout">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <a href="/delivery-information" class="element promo-box text-center">
                            <h3>
                                Free Shipping
                                <small>on all <br>orders over</small>
                            </h3>
                            <span class="price">
                                <small>{!! $currency['symbol'] !!}</small>{!! priceConverter(50) !!}
                            </span>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <a href="/trade-account" class="element promo-box">
                            <h3>
                                <small>Great Discounts</small>
                                For Sweet Shops
                            </h3>
                            <button href="/trade-account" class="btn btn-green btn-sm">Find out more</button>
                            <img src="/images/getcandy/promotions/tradesmen.jpg" class="promo-img edge bottom"
                                 alt="Great discounts for Sweet Shops">
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <a href="#" class="element promo-box">
                            <h3>
                                Happy Birthday!
                                <small>Get custom made <br>sweets to your door</small>
                            </h3>
                            <span class="sale">
                                <span class="center">
                                    from only
                                    <span class="price"><small>{!! $currency['symbol'] !!}</small>{!! priceConverter(11.99, false) !!}</span>
                                </span>
                            </span>
                            <img src="/images/getcandy/promotions/happy-birthday.jpg" class="promo-img" alt="Happy Birthday Sweets">
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <a href="#" class="element promo-box text-center">
                            <h3>
                                Enjoy our Sweets
                                <small>next day delivery on everything!</small>
                            </h3>
                            <button type="button" class="btn btn-green btn-sm">Shop Now</button>
                            <img src="/images/getcandy/promotions/gummy-bears.jpg" class="promo-img edge bottom"
                                 alt="Gummy Bears">
                        </a>
                    </div>
                </div>
            </section>
            <!-- END Promotional Area -->
        </div>
    </main>

    @include('_partials.newsletter')
@stop