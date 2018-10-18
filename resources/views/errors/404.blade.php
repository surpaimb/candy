@extends('_layouts/base')
@section('title', 'Sorry, the page you are looking for could not be found.')

@section('content')

    <div class="container-fluid push-top">
        <div class="row breadcrumbs">
            <div class="col-xs-12">
                <ol>
                    <li><i class="fa fa-home" aria-hidden="true"></i> <a href="/">Home</a></li>
                    <li><a href="/about-us">Page Not Found</a></li>
                </ol>
            </div>
        </div>
    </div>

    <main class="container-fluid page no-mar-top">
        <div class="row">
            <div class="col-xs-12">

                <div class="element panel">
                    <div class="row">
                        <div class="col-xs-12">

                            <header class="text-center">
                                <h1>Sorry, the page you are looking for could not be found.</h1>
                            </header>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

@stop