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

                    <header>
                        <h1>About Us</h1>
                    </header>

                    <hr>

                    <p class="lead">Oat cake croissant powder caramels sweet gummi bears.</p>

                    <p>Chocolate fruitcake dragée topping toffee gummies ice cream chocolate. Marshmallow chocolate bar ice cream marzipan. Biscuit gummi bears biscuit gingerbread donut. Tootsie roll bear claw ice cream chocolate macaroon. Gingerbread chocolate cake oat cake. Donut oat cake marshmallow macaroon. Gingerbread halvah sesame snaps cake sweet roll marzipan cake ice cream gummi bears.</p>

                    <p>Dragée toffee cheesecake sesame snaps. Fruitcake jelly bear claw icing marzipan. Jelly dessert ice cream sugar plum brownie lollipop powder powder pie. Soufflé oat cake bonbon tart chocolate cake.</p>

                    <p>Lollipop cheesecake halvah powder. Cheesecake jelly-o wafer candy canes. Tart jelly-o tart pastry tart danish candy canes. Liquorice sweet roll cupcake jujubes marzipan lemon drops cheesecake. Bonbon gummies pastry biscuit candy canes jelly beans jelly beans jelly beans.</p>

                    <p>Pudding pudding gingerbread cookie cotton candy chocolate topping chocolate muffin. Toffee cupcake liquorice. Jelly-o gummies brownie cake gummi bears bonbon. Oat cake caramels jujubes powder dragée. Marzipan dessert tart jelly-o marshmallow brownie.</p>

                    <p>Muffin tootsie roll brownie donut oat cake. Apple pie marzipan gummi bears gingerbread liquorice lemon drops pudding. Cake cotton candy sugar plum. Bonbon muffin chocolate apple pie chocolate bar macaroon dessert apple pie topping.</p>
                </div>

                </div>

            </div>
        </div>
    </main>

    @include('_partials.newsletter')
@stop
