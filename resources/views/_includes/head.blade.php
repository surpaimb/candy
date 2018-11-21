<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="language" content="{{ $language }}">
<meta name="channel" content="{{ env('APP_CHANNEL', 'webstore') }}">
<meta name="currency-code" content="{{ $currency['code'] }}">
<meta name="currency-symbol" content="{{ $currency['symbol'] }}">

<title>@yield('title')</title>
<meta name="description" content="@yield('meta-desciption')">

<link href="/images/getcandy/branding/favicon.png" rel="shortcut icon" type="image/png" />

{{-- CSS --}}
<link href="https://fonts.googleapis.com/css?family=Cabin:400,400i,700,700i|Source+Sans+Pro:400,400i,700,700i" rel="stylesheet">
<link href="{{ mix('css/app.css') }}" rel="stylesheet">

{{-- Head Scripts --}}
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
@section('headscript')
@show

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->