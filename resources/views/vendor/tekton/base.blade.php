<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Tekton' }}</title>
    @yield('tekton-styles')
    @yield('styles')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    @yield('tekton-scripts')
    @yield('scripts')
</body>
</html>