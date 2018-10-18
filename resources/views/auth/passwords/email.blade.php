@extends('_layouts/base')
@section('title', 'Get Candy - Forgotten Password')

@section('content')

    <div class="container-fluid push-top">
        <div class="row breadcrumbs">
            <div class="col-xs-12">
                <ol>
                    <li><i class="fa fa-home" aria-hidden="true"></i> <a href="/">Home</a></li>
                    <li><a href="/forgotten-password">Forgotten Password</a></li>
                </ol>
            </div>
        </div>
    </div>

    <main class="container-fluid page no-mar-top">
        <div class="row">
            <div class="col-xs-12">

                <div class="element panel">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">

                            <header>
                                <h1>Forgotten Password</h1>
                                <hr>
                            </header>

                            @if(Session::has('response'))
                                @include('_partials.form-notifications')
                            @else
                                <form method="post">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label class="sr-only">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                            <input type="email" class="form-control" placeholder="Email" name="email">
                                        </div>
                                    </div>

                                    <a href="/login">Back to login</a>
                                    <button type="submit" class="btn btn-green pull-right">Submit</button>

                                </form>
                            @endif



                        </div>
                        <div class="col-xs-12 col-sm-6">

                            <header>
                                <h1>Not a registered member?</h1>
                                <hr>
                            </header>

                            <p>Creating a new account is easy and takes less than a minute.</p>
                            <a href="/register">Register for a new account</a>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

@stop