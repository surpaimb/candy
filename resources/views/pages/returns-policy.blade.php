@extends('_layouts/base')
@section('title', ' | Get Candy')
@section('meta-desciption', '')

@section('content')

    <div class="container-fluid push-top">
        <div class="row breadcrumbs">
            <div class="col-xs-12">
                <ol>
                    <li><i class="fa fa-home" aria-hidden="true"></i> <a href="/">Home</a></li>
                    <li><a href="/returns-policy">Returns Policy</a></li>
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
                        <h1>Refunds Policy</h1>
                    </header>
                    <hr>

                    <p class="lead">Soufflé marzipan chocolate bar. Jelly-o jelly tootsie roll croissant danish pudding chocolate bar candy canes.</p>

                    <p>Gummi bears jelly beans cupcake caramels. Chocolate bar tiramisu candy canes chocolate bar sugar plum macaroon tart. Icing dessert sesame snaps candy caramels donut jujubes. Cotton candy dragée apple pie pastry sesame snaps. Sweet tart topping. Caramels croissant toffee gummi bears sesame snaps tart donut candy topping. Brownie cake powder. Fruitcake biscuit dessert. Oat cake pie bear claw jelly-o pudding. Cookie biscuit soufflé cake wafer muffin. Wafer cotton candy dragée carrot cake cookie powder jelly. Gummi bears tootsie roll jelly-o halvah sugar plum sugar plum icing.</p>

                    <p>Brownie sugar plum cupcake. Lollipop topping powder cake ice cream chocolate. Cotton candy fruitcake ice cream sugar plum candy canes. Gingerbread icing tart cotton candy sesame snaps icing marshmallow. Gummies gummi bears cookie apple pie gummies tart. Gummi bears donut caramels marzipan oat cake jelly-o sesame snaps cookie lemon drops. Carrot cake cookie dessert marshmallow icing apple pie. Carrot cake croissant liquorice cupcake tart lollipop biscuit sesame snaps. Jelly beans brownie dessert cupcake carrot cake pudding gummies. Gummi bears cake sweet roll danish danish sweet bonbon cake cupcake. Caramels chupa chups jujubes toffee chupa chups. Macaroon pie chocolate cookie bonbon. Soufflé dessert candy chocolate cake sugar plum donut tiramisu dessert.</p>

                    <p>Candy sugar plum jelly beans dessert. Biscuit fruitcake muffin chocolate jelly bear claw. Fruitcake gingerbread cookie chocolate bar cotton candy jujubes jelly jujubes. Marzipan croissant liquorice toffee. Liquorice ice cream oat cake. Lollipop sesame snaps jelly beans sweet roll. Jelly icing tart jelly-o icing jelly. Cookie croissant fruitcake chupa chups jelly beans. Muffin topping cookie. Candy biscuit sesame snaps gingerbread cotton candy wafer. Toffee candy canes caramels dragée cotton candy chupa chups biscuit lollipop dragée. Icing cookie carrot cake jelly jelly beans fruitcake pastry oat cake fruitcake.</p>

                    <p>Oat cake croissant powder caramels sweet gummi bears. Chocolate fruitcake dragée topping toffee gummies ice cream chocolate. Marshmallow chocolate bar ice cream marzipan. Biscuit gummi bears biscuit gingerbread donut. Tootsie roll bear claw ice cream chocolate macaroon. Gingerbread chocolate cake oat cake. Donut oat cake marshmallow macaroon. Gingerbread halvah sesame snaps cake sweet roll marzipan cake ice cream gummi bears. Dragée toffee cheesecake sesame snaps. Fruitcake jelly bear claw icing marzipan. Jelly dessert ice cream sugar plum brownie lollipop powder powder pie. Soufflé oat cake bonbon tart chocolate cake.</p>

                    <p>Lollipop cheesecake halvah powder. Cheesecake jelly-o wafer candy canes. Tart jelly-o tart pastry tart danish candy canes. Liquorice sweet roll cupcake jujubes marzipan lemon drops cheesecake. Bonbon gummies pastry biscuit candy canes jelly beans jelly beans jelly beans. Pudding pudding gingerbread cookie cotton candy chocolate topping chocolate muffin. Toffee cupcake liquorice. Jelly-o gummies brownie cake gummi bears bonbon. Oat cake caramels jujubes powder dragée. Marzipan dessert tart jelly-o marshmallow brownie. Muffin tootsie roll brownie donut oat cake. Apple pie marzipan gummi bears gingerbread liquorice lemon drops pudding. Cake cotton candy sugar plum. Bonbon muffin chocolate apple pie chocolate bar macaroon dessert apple pie topping.</p>

                </div>

            </div>
        </div>
    </main>

    @include('_partials.newsletter')
@stop