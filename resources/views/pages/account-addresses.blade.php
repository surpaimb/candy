@extends('_layouts/base')
@section('title', 'Account | Get Candy')
@section('meta-desciption', '')

@section('content')

    <div class="container-fluid push-top">
        <div class="row breadcrumbs">
            <div class="col-xs-12">
                <ol>
                    <li><i class="fa fa-home" aria-hidden="true"></i> <a href="/">Home</a></li>
                    <li><a href="/account">Account</a></li>
                </ol>
            </div>
        </div>
    </div>

    <main class="container-fluid page no-mar-top">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="side-bar">
                    <div class="btn-group phone">
                        <button type="button" class="btn btn-blue side-menu">Menu</button>
                    </div>
                    <div class="element aside">
                        <div class="title">Your Account</div>
                        
                        @include('_partials/account-sidebar')
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="element content page">
                    <header>
                        <h1>Address Book</h1>
                    </header>
                    <hr>
                </div>
            </div>
        </div>
    </main>

@stop
@section('bodyscript')
@stop