<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">

<head>
    @include('partials.head')
</head>
<body>

    {{ $slot }}

    @fluxScripts
    </body>

</html>