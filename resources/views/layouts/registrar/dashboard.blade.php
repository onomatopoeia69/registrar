<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>


        @livewireStyles
    </head>
    <body>  

        @extends('adminlte::page')


        @section('content')

        {{ $slot }}

        @endsection
        
        @livewireScripts

     <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/gsap.min.js"></script>
    </body>
</html>
