@extends('_layouts/base')
@section('title', 'Register | Get Candy')
@section('meta-desciption', '')

@section('content')

    <div class="container-fluid push-top">
        <div class="row breadcrumbs">
            <div class="col-xs-12">
                <ol>
                    <li><i class="fa fa-home" aria-hidden="true"></i> <a href="/">Home</a></li>
                    <li><a href="/register">Register</a></li>
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
                                <h1>Register for a new account</h1>
                                <hr>
                            </header>

                            <form action="" method="post">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="firstname">First Name</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" placeholder="First Name" name="firstname" value="{{ old('firstname') }}" required>
                                            </div>
                                            <span class="error">{{ $errors->first('firstname') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Last Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" placeholder="Last Name" name="lastname" value="{{ old('lastname') }}" required>
                                                </div>
                                                <span class="error">{{ $errors->first('lastname') }}</span>
                                            </div>
                                        </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                    </div>
                                    <span class="error">{{ $errors->first('email') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                    <span class="error">{{ $errors->first('password') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                                    </div>
                                    <span class="error">{{ $errors->first('password_confirmation') }}</span>
                                </div>
                                <a href="/login">Already have an account?</a>

                                <input type="hidden" name="language" value="{{ env('APP_LANGUAGE', 'en') }}">
                                <button type="submit" class="btn btn-green pull-right">Register</button>

                            </form>

                        </div>
                        <div class="col-xs-12 col-sm-6">

                            <header>
                                <h1>Benefits of becoming a registered member</h1>
                                <hr>
                            </header>

                            <ul>
                                <li>Log in at any time to check order statuses</li>
                                <li>Personalize your shopping</li>
                                <li>Speed up future purchases</li>
                                <li>*Optional* Receive our latest promotions</li>
                            </ul>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @include('_partials.newsletter')
@stop