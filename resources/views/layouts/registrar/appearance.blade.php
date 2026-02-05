<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        <style>
            :root {
                --sidebar-bg: {{ request()->cookie('sidebar_bg','#343a40') }};
                --brand-link: {{ request()->cookie('sidebar_brand','#343a40') }};
            }
        </style>

        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">


        @livewireStyles
    </head>
    <body>  

        @extends('adminlte::page')
  

        @section('preloader')
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
        </div>
         @stop

        @section('content')

        {{ $slot }}

        @endsection
        
        
        @livewireScripts


     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscolor/2.5.2/jscolor.min.js" integrity="sha512-qFhMEJrjI50TwLDGZ7Oi0ksTSWnFOqTNXhlqqUgWnE65S23rWUtQOv+tMNEybkMYSXKgAc3eg/SzkX+qrtJT/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>
</html>
