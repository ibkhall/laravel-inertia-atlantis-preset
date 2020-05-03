<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('/atlantis/js/plugin/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link rel="icon" href="{{ asset('img/logo2.svg') }}">
    <title>Laravel</title>
    <script src="{{ mix('/js/app.js') }}" defer></script>
</head>
<body>

@routes
@inertia

<script src="{{ asset('atlantis/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('atlantis/js/core/popper.min.js') }}"></script>
<script src="{{ asset('atlantis/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('atlantis/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('atlantis/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('atlantis/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('atlantis/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('atlantis/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('atlantis/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('atlantis/js/plugin/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('atlantis/js/atlantis.min.js') }}"></script>
</body>
</html>
