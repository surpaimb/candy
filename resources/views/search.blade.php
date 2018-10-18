@extends('_layouts/base')
@section('title', 'Search results for: '. $searchTerm .' | Get Candy')
@section('meta-desciption', '')

@section('content')

    {{-- Breadcrumbs --}}
    <div class="container-fluid push-top">
        <div class="row breadcrumbs">
            <div class="col-xs-12">
                <ol>
                    <li><i class="fa fa-home" aria-hidden="true"></i> <a href="/">Home</a></li>
                    <li>Search results</li>
                </ol>
            </div>
        </div>
    </div>
    {{-- END Breadcrumbs --}}

    <main class="container-fluid page no-mar-top">

        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">

                    <search-filter-buttons></search-filter-buttons>

                <div class="side-bar">

                    <search-filters></search-filters>

                </div>
            </div>

            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="element content product-list">
                    <div class="inner">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="small">Search Results</h1>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">

                        <div class="element sort-pagination">

                            <search-display></search-display>

                            <div class="sort form-inline">

                            </div>

                            <search-pagination></search-pagination>

                        </div>
                    </div>
                </div>

                {{-- Product List--}}
                <search-listings keywords="{!! $searchTerm !!}" ></search-listings>
                {{-- End Product List --}}

                <div class="row">
                    <div class="col-xs-12">

                        <div class="element sort-pagination">

                            <search-display></search-display>

                            <div class="sort form-inline">

                            </div>

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