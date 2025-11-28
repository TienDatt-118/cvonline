<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JobArt') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="art-bg font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <div class="w-full sm:max-w-md mt-6 px-8 py-10 glass-form shadow-2xl overflow-hidden sm:rounded-[2rem]">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
