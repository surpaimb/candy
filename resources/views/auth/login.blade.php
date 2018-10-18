@extends('_layouts/base')
@section('title', 'Login | Get Candy')
@section('meta-desciption', '')

@section('content')

    <div class="container-fluid push-top">
        <div class="row breadcrumbs">
            <div class="col-xs-12">
                <ol>
                    <li><i class="fa fa-home" aria-hidden="true"></i> <a href="/">Home</a></li>
                    <li><a href="/login">Login</a></li>
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
                                <h1>Existing Customers</h1>
                                <hr>
                            </header>

                            <form method="post">
                                {{ csrf_field() }}
                                <span class="error">{{ $errors->first('error') }}</span>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                </div>

                                <a href="/forgotten-password">Forgotten your password?</a>
                                <button type="submit" class="btn btn-green pull-right">Login</button>

                            </form>

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

    @include('_partials.newsletter')
@stop