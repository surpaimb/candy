<!-- Main Navigation -->
<div class="container-fluid navigation element" data-spy="affix" data-offset-top="115">
    <div class="wrap">
        <button type="button" class="btn btn-blue btn-browse" onClick=""><i class="fa fa-bars" aria-hidden="true"></i> Browse <span class="hidden-xs">Categories</span></button>
        <nav class="categories">
            <ul class="nav-wrap">

                @forelse ($categories as $category)
                    <li class="@if(!empty($category['children']) && count($category['children'])) sub-nav @else nav-{!! candyRoute($category) !!} @endif">
                        <a href="/categories/{!! candyRoute($category) !!}" title="">
                            {!! candyAttribute($category, 'name') !!}
                            @if(!empty($category['children']) && count($category['children']))
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            @endif
                        </a>
                        @if(!empty($category['children']) && count($category['children']))
                           <div class="mega-menu">
                                <div class="row sub-links">
                                    <div class="col-xs-12 visible-xs-block">
                                        <ul>
                                            <li class="back"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</li>
                                        </ul>
                                    </div>
                                    @foreach (array_chunk($category['children'], 6) as $childCategoryChunk)
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <ul>

                                            @foreach ($childCategoryChunk as $childCategory)
                                            <li class="nav-{!! candyRoute($childCategory) !!}"><a href="/categories/{!! candyRoute($childCategory) !!}" title="">{!! candyAttribute($childCategory, 'name') !!}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endforeach

                                    @if ($category['id'] == 'wz6d39dj')
                                        <div class="clearfix visible-sm-block"></div>
                                        <div class="hidden-xs col-xs-12 col-sm-6 col-md-3 col-md-offset-3">
                                            <a href="#" class="sales-block" style="background-image: url('/images/getcandy/promotions/mega-menu/bowl-of-sweets.jpg')">
                                                <span class="sales-title">
                                                    <small>Shop our</small>
                                                    Tasty Sweet Selection
                                                </span>
                                            </a>
                                        </div>
                                        <div class="hidden-xs col-xs-12 col-sm-6 col-md-3">
                                            <a href="#" class="sales-block" style="background-image: url('/images/getcandy/promotions/mega-menu/chocolate-eggs.jpg')">
                                                <span class="sales-title">
                                                    <small>Shop our</small>
                                                    Tasty Sweet Selection
                                                </span>
                                            </a>
                                        </div>
                                    @elseif ($category['id'] == 'yel5o9pw') {{-- Parts --}}
                                        <div class="clearfix visible-sm-block"></div>
                                        <div class="hidden-xs col-xs-12 col-sm-6 col-md-3">
                                            <a href="#" class="sales-block" style="background-image: url('/images/getcandy/promotions/mega-menu/sweet-selection.jpg')">
                                                <span class="sales-title">
                                                    <small>Shop our</small>
                                                    Tasty Sweet Selection
                                                </span>
                                            </a>
                                        </div>
                                    @elseif ($category['id'] == '3pl71lde') {{-- Accessories --}}
                                        <div class="clearfix visible-sm-block"></div>
                                        <div class="hidden-xs col-xs-12 col-sm-6 col-md-3">
                                            <a href="#" class="sales-block" style="background-image: url('/images/getcandy/promotions/mega-menu/bowl-of-sweets.jpg')">
                                                <span class="sales-title">
                                                    <small>Shop our</small>
                                                    Tasty Sweet Selection
                                                </span>
                                            </a>
                                        </div>
                                        <div class="hidden-xs col-xs-12 col-sm-6 col-md-3">
                                            <a href="#" class="sales-block" style="background-image: url('/images/getcandy/promotions/mega-menu/chocolate-eggs.jpg')">
                                                <span class="sales-title">
                                                    <small>Shop our</small>
                                                    Tasty Sweet Selection
                                                </span>
                                            </a>
                                        </div>
                                    @elseif ($category['id'] == 'v8l4rp60') {{-- LA Parts --}}
                                        <div class="clearfix visible-sm-block"></div>
                                        <div class="hidden-xs col-xs-12 col-sm-6 col-md-3 col-md-offset-3">
                                            <a href="#" class="sales-block" style="background-image: url('/images/getcandy/promotions/mega-menu/sweet-selection.jpg')">
                                                <span class="sales-title">
                                                    <small>Shop our</small>
                                                    Tasty Sweet Selection
                                                </span>
                                            </a>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        @endif
                    </li>

                        {{--  @if ($category['lazy'])
                            <li class="sub"><a href="/categories/{!! candyRoute($category) !!}" title="">{!! candyAttribute($category, 'name') !!} <i class="fa fa-angle-down" aria-hidden="true"></i></a>

                            </li>

                        @else  --}}
                         {{--  {{ dump($category['routes']['data']) }}  --}}

                        {{--  @endif  --}}
                @empty
                    No Categories
                @endforelse
            </ul>
        </nav>

        {{-- For Mobile --}}
        <button type="button" class="btn btn-light-blue btn-search"><i class="fa fa-search" aria-hidden="true"></i><span class="txt">Search</span></button>
        <search-mobile></search-mobile>
        <a href="/basket" class="btn btn-green btn-basket"><!--<span class="count">2</span> --><i class="fa fa-shopping-basket" aria-hidden="true"></i>Basket</a>
        {{--END For Mobile --}}

    </div>
</div>
<!-- END Main Navigation -->