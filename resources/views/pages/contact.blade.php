@extends('_layouts/base')
@section('title', ' | Get Candy')
@section('meta-desciption', '')

@section('content')

    <div class="container-fluid push-top">
        <div class="row breadcrumbs">
            <div class="col-xs-12">
                <ol>
                    <li><i class="fa fa-home" aria-hidden="true"></i> <a href="/">Home</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ol>
            </div>
        </div>
    </div>

    <main class="container-fluid page no-mar-top">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="btn-group phone">
                    <button type="button" class="btn btn-blue side-menu">Menu</button>
                </div>
                <div class="side-bar">
                    <div class="element aside">
                        @include('_partials/info-sidebar')
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="element content page">

                    <header>
                        <h1>Contact</h1>
                    </header>

                    <hr>

                    <p class="lead">Visit our store</p>

                    <div class="row feature-row contact-details">
                        <div class="col-md-6">
                            <h5>Telephone</h5>
                            <p><strong class="tel" itemprop="telephone">01234 567890</strong></p>

                            <h5>Opening Times</h5>
                            <table class="table">
                                <tr>
                                    <td>Monday</td>
                                    <td>9am - 5pm</td>
                                </tr>
                                <tr>
                                    <td>Tuesday</td>
                                    <td>9am - 5pm</td>
                                </tr>
                                <tr>
                                    <td>Wednesday</td>
                                    <td>9am - 5pm</td>
                                </tr>
                                <tr>
                                    <td>Thursday</td>
                                    <td>9am - 5pm</td>
                                </tr>
                                <tr>
                                    <td>Friday</td>
                                    <td>9am - 5pm</td>
                                </tr>
                                <tr>
                                    <td>Saturday</td>
                                    <td>10am - 4pm</td>
                                </tr>
                                <tr>
                                    <td>Sunday</td>
                                    <td>10am - 4pm</td>
                                </tr>
                            </table>

                            <h5>Address</h5>
                            <p itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"><strong>Get Candy</strong>, <br><span itemprop="streetAddress">Basecamp</span>, <br><span itemprop="addressLocality">Candy Mountain</span>, <br><span itemprop="addressRegion">CandyLand CL4 5GB</span></p>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            <h5>Enquiry Form</h5>

                            <form action="/contact/enquiry" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" class="form-control" required>
                                    @if ($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif

                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="email" class="form-control" required>
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Telphone</label>
                                    <input name="telephone" type="tel" class="form-control">
                                    @if ($errors->has('telephone'))
                                        <div class="error">{{ $errors->first('telephone') }}</div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Order Reference</label>
                                        <input name="order_reference" type="text" class="form-control">
                                        @if ($errors->has('order_reference'))
                                            <div class="error">{{ $errors->first('order_reference') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Enquiry</label>
                                    <textarea name="enquiry" rows="6" class="form-control" required></textarea>
                                    @if ($errors->has('enquiry'))
                                        <div class="error">{{ $errors->first('enquiry') }}</div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-green">Send Enquiry</button>
                            </form>
                        </div>
                    </div>

                </div>

                </div>

            </div>
        </div>
    </main>

    @include('_partials.newsletter')
@stop