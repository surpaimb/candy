@extends('_layouts/base')
@section('title', candyAttribute($product, 'name') .' | Get Candy')
@section('meta-desciption', '')

@section('content')

    <div class="container-fluid push-top">
        <div class="row breadcrumbs">
            <div class="col-xs-12">
                <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <a itemprop="item" href="/"><span itemprop="name">Home</span></a>
                    </li>

                    @foreach ($product['categories']['data'] as $category)
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <a  itemprop="item" href="/categories/{!! candyRoute($category) !!}"><span itemprop="name">{!! candyAttribute($category, 'name') !!}</span></a>
                        </li>
                    @endforeach

                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <span itemprop="item">
                            <span itemprop="name">{!! candyAttribute($product, 'name') !!}</span>
                        </span>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="sticky-summary">
        <div class="container-fluid">
            <div class="product-summary">

                {{-- GALLERY HERE --}}

                <div class="product-description">
                    <p class="h4 product-title">{!! candyAttribute($product, 'name') !!}</p>
                    <product-sku></product-sku>
                    <product-stock></product-stock>
                </div>

                @if (count($product['option_data']))
                    <product-variants :variants="{!! htmlspecialchars(json_encode($product['variants'])) !!}" :options="{!! htmlspecialchars(json_encode($product['option_data'])) !!}"></product-variants>
                @endif

            </div>

            <div class="price-summary">
                <add-to-basket :product="{!! htmlspecialchars(json_encode($product)) !!}"></add-to-basket>
            </div>

        </div>
    </div>

    <main class="container-fluid page no-mar-top">
        <div class="row">
            <div class="col-xs-12">
                <div class="element product" itemscope="" itemtype="http://schema.org/Product">
                    <meta itemprop="itemCondition" content="http://schema.org/NewCondition">
                    <div class="row">
                        <div class="col-xs-12 col-md-4">

                            <product-gallery :product="{!! htmlspecialchars(json_encode($product)) !!}"></product-gallery>

                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-5">

                            <header>
                                <h1 itemprop="name">{!! candyAttribute($product, 'name') !!}</h1>
                                <product-sku></product-sku>
                                <product-stock></product-stock>
                            </header>

                            @if (count($product['option_data']))
                                <product-variants :variants="{!! htmlspecialchars(json_encode($product['variants'])) !!}" :options="{!! htmlspecialchars(json_encode($product['option_data'])) !!}"></product-variants>
                            @endif

                            <div class="product-summary">
                                @if(!empty(candyAttribute($product, 'short_description')))
                                    {!! candyAttribute($product, 'short_description') !!}
                                @endif
                                @if(!empty(candyAttribute($product, 'description')))
                                    <a href="#more-info" class="page-anchor">More info</a>
                                @endif
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-5 col-md-3">
                            <form>
                                <add-to-basket :product="{!! htmlspecialchars(json_encode($product)) !!}"></add-to-basket>
                            </form>
                            <a href="/delivery-information" class="element promo-box text-center">
                                <h3>
                                    Free Shipping
                                    <small>on all <br>orders over</small>
                                </h3>
                                <span class="price">
                                    @if(userHasRole('trade'))
                                    <small>&pound;</small>{!! priceConverter(50) !!}<br><small style="display: block; line-height: 0.2;">+VAT</small>
                                    @else
                                    <small>&pound;</small>{!! priceConverter(50) !!}
                                    @endif
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12" id="more-info">
                <div class="box content">
                    <div class="row">
                        @if (count($product['associations']['data']))
                        <div class="col-xs-12 col-md-8">
                        @else
                        <div class="col-xs-12">
                        @endif
                            @if(candyAttribute($product, 'description'))
                                <div class="element content more-product-info">
                                    <div class="inner">
                                        {!! candyAttribute($product, 'description') !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if (count($product['associations']['data']))
                            <div class="col-xs-12 col-md-4 interested-in">

                                <p class="h3">You may also be interested in...</p>
                                <div class="row">

                                    @foreach ($product['associations']['data'] as $association)
                                        <div class="col-xs-12 col-sm-6 col-md-12 recommended-product">
                                            <div class="element product-box listing">
                                                <div class="row">
                                                    <div class="col-xs-5">
                                                        <a href="{!! candyRoute($association['association']['data']) !!}" class="product-img">
                                                            <img src="{!! candyPrimaryThumbnail($association['association']['data']) !!}" alt="{!! candyAttribute($association['association']['data'], 'name') !!}">
                                                        </a>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <div class="product-details">
                                                            <a href="{!! candyRoute($association['association']['data']) !!}" class="product-title">
                                                                {!! candyAttribute($association['association']['data'], 'name') !!}
                                                            </a>
                                                            <div class="product-price">
                                                                <small>&pound;</small>24.99
                                                                <span class="vat">Exc.<br>VAT</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <add-to-basket-modal></add-to-basket-modal>

    @include('_partials.newsletter')
@stop
@section('bodyscript')
    @parent

@stop