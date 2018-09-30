<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Tekton' }}</title>
    @yield('tekton-styles')
    @include('components.styles')
    @yield('styles')
</head>
<body class="app sidebar-show aside-menu-show">
    <div class="app-body">
        <div class="sidebar">
            @include('components.sidebar')
        </div>
        <main class="main">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-menu">
                    @if(!Auth::guest())
                    <span>
                        Welcome, {{ Auth::user()->name }}
                    </span>
                    @endif
                </li>
            </ol>
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
    @yield('tekton-scripts')
    @include('components.scripts')
    @yield('scripts')
</body>
</html>