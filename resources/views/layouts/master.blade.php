<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stage/Formation</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- Sorting -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               @include('partials.menu')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
               @include('partials.menu')
            </div>
        </div>
    </div>
    @section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <!-- deleteAll -->
    <script src="{{asset('js/app.js')}}"></script>  
    @show
</body>
</html>