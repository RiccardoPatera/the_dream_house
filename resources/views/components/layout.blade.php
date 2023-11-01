<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{asset('/favicon.svg')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/203597dd98.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <title>The Dream House Interiors</title>
    @vite('resources/css/app.css')
    @livewireStyles
    
</head>
    <body>
        

        <main class="tw-min-h-[100vh]">

        
        <x-navbar/>
            @livewire('cart-shop')
                {{$slot}}

            @if(!Route::is('cartsummary') && !Route::is('shipping'))
                @livewire('cart-button')
            @endif
        </main>
        

            <x-footer/> 
        



        @livewireScripts
        @vite('resources/js/app.js')
        @include('cookie-consent::index')
    
    
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
</body>
</html>
