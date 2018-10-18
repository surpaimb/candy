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
                            <p>Your account details have been succesfully updated</p>
                        </div>
                    @endif
                    <header>
                        <h1>Personal Details</h1>
                    </header>
                    <hr>
                    <p>If you wish to change you login password please go to the <a href="/account-password">new password</a> section</p>
                    <div class="row">
                        <div class="col-md-6">

                                <form action="/account/details" method="post">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" type="email" class="form-control" value="{!! $customer['email'] !!}" required>
                                        @if ($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Title</label>
                                        <select name="title" class="form-control custom-dropdown" value="{!! $customer['title'] !!}">
                                            @foreach(['Mr.', 'Mrs.', 'Ms.', 'Miss', 'Dr.', 'Prof.', 'Rev.'] as $key)
                                            <option @if($customer['title'] == $key) selected @endif>{!! $key !!}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('title'))
                                            <div class="error">{{ $errors->first('title') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input name="firstname" type="text" class="form-control" value="{!! $customer['firstname'] !!}" required>
                                        @if ($errors->has('firstname'))
                                            <div class="error">{{ $errors->first('firstname') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="lastname" type="text" class="form-control" value="{!! $customer['lastname'] !!}" required>
                                        @if ($errors->has('lastname'))
                                            <div class="error">{{ $errors->first('lastname') }}</div>
                                        @endif
                                    </div>
                                    <!-- Only display with a Trade customer -->
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input name="contact_number" type="text" class="form-control" value="{!! $customer['contact_number'] !!}">
                                        @if ($errors->has('contact_number'))
                                            <div class="error">{{ $errors->first('contact_number') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input name="company_name" type="text" class="form-control" value="{!! $customer['company_name'] !!}">
                                        @if ($errors->has('company_name'))
                                            <div class="error">{{ $errors->first('company_name') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>VAT No.</label>
                                        <input name="vat_no" type="text" class="form-control" value="{!! $customer['vat_no'] !!}">
                                        @if ($errors->has('vat_no'))
                                            <div class="error">{{ $errors->first('vat_no') }}</div>
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