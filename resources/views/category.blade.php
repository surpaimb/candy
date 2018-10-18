@extends('_layouts/base')
@section('title', candyAttribute($category, 'name') .' | Get Candy')
@section('meta-desciption', '')

@section('content')

    {{-- Breadcrumbs --}}
    <div class="container-fluid push-top">
        <div class="row breadcrumbs">
            <div class="col-xs-12">
                <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <i class="fa fa-home" aria-hidden="true"></i> 
                        <a itemprop="item" href="/"><span itemprop="name">Home</span></a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <span itemprop="item">
                            <span itemprop="name">{!! candyAttribute($category, 'name') !!}</span>
                        </span>
                        <meta itemprop="position" content="2" />
                    </li>
                </ol>
            </div>
        </div>
    </div>
    {{-- END Breadcrumbs --}}

    <main class="container-fluid page no-mar-top">

        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">

                <search-filter-buttons parent-category="{{ $category['id'] }}"></search-filter-buttons>

                <div class="side-bar">

                    <search-filters parent-category="{{ $category['id'] }}"></search-filters>

                </div>
            </div>

            <div class="col-xs-12 col-sm-8 col-md-9">

                {{-- Category List
                <div class="row">
                    @foreach ($category['descendants'] as $subCategory)
                        @if ($subCategory['parent_id'] == $category['id'])
                        <div class="col-xs-12 col-md-3">
                            <div class="element product-box category">
                                <a href="/categories/{!! candyRoute($subCategory) !!}" class="product-details" title="{!! candyAttribute($subCategory, 'name') !!}">
                                    {!! candyAttribute($subCategory, 'name') !!}
                                </a>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>--}}
                {{-- End Category List --}}

                <div class="row">
                    <div class="col-xs-12">
                        <div class="element sort-pagination product-list">
                            <h1 class="small">{!! candyAttribute($category, 'name') !!}</h1>
                            <div class="category-description">
                                <p>{!! candyAttribute($category, 'description') !!}</p>
                            </div>
                            <hr>
                            <search-sort-by></search-sort-by>

                            <search-display></search-display>

                            <search-pagination></search-pagination>
                        </div>
                    </div>
                </div>

                {{-- Product List--}}
                <search-listings :static-listings="{{ count($searchResults['data']) }}" :static-meta="{{ json_encode($searchResults['meta']) }}" category="{{ $category['id'] }}" page="{{ $page }}" display="{{ $display }}" sortBy="{{ $sortBy }}">

                    {{-- Render snapshot here --}}
                    <template slot-scope="prop">
                        <div class="row" v-show="prop.show">

                            @foreach ($searchResults['data'] as $product)

                            <div class="col-xs-12 col-md-6">
                                <div class="element product-box listing">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <a href="/product/{{ candyRoute($product) }}" class="product-img">
                                                <img src="{{ candyPrimaryThumbnail($product) }}" alt="{{ candyAttribute($product, 'name') }}">
                                            </a>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="product-details">
                                                <a href="/product/{{ candyRoute($product) }}" class="product-title">
                                                    {{ candyAttribute($product, 'name') }}
                                                </a>
                                                <search-add-to-basket :product="{{ json_encode($product) }}"></search-add-to-basket>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach

                        </div>
                        {{-- END Render snapshot here --}}
                    </template>

                </search-listings>
                {{-- End Product List --}}

                <div class="row">
                    <div class="col-xs-12">

                        <div class="element sort-pagination">

                            <search-sort-by></search-sort-by>

                            <search-display></search-display>

                            <search-pagination></search-pagination>

                        </div>

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