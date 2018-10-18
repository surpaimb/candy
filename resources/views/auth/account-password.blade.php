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
                <div class="btn-group phone">
                    <button type="button" class="btn btn-blue side-menu">Account Menu</button>
                </div>
                <div class="side-bar">
                    <div class="element aside">
                        <div class="title">Your Account</div>

                        @include('_partials/account-sidebar')
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="element content page">
                    @if(\Session::has('success'))
                        <div class="alert alert-success">
                            <p>Your password has been successfully changed</p>
                        </div>
                    @endif
                    <header>
                        <h1>New Password</h1>
                    </header>
                    <hr>
                    <p>To keep your account secure we recommended that you change your password every 90 days.</p>
                    <h5>Username</h5>
                    <p>{!! $customer['email'] !!}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="/account/password" method="post">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="h5">Existing Password</label>
                                    <input name="current_password" type="password" class="form-control" required>
                                    @if ($errors->has('current_password'))
                                        <div class="error">{{ $errors->first('current_password') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="h5">New Password</label>
                                    <p>Make your password stronger by using a mixture of uppercase &amp; lowercase characters, numbers and symbols (like ! or $).</p>
                                </div>
                                <div class="form-group">
                                    <input name="password" type="password" class="form-control" placeholder="Type new password" required>
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input name="password_confirmation" type="password" class="form-control" placeholder="Re-type new password" required>
                                    @if ($errors->has('password_confirmation'))
                                        <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>
                                <div class="btn-horizontal-group">
                                    <button type="submit" class="btn btn-green">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@stop
@section('bodyscript')
@stop