<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ticket Shopping</title>

    <!-- Fonts -->
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">--}}

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('css')
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
@include('layouts.navigation')
<!-- Page Content -->
    <main class="py-4">

        @auth
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-2">
                        <ul class="list-group">

                            <li class="list-group-item">
                                <a href="{{route('tickets.index')}}">Tickets</a>
                            </li>
                            @if(\Auth::user()->isCustomer())
                                <li class="list-group-item">
                                    <a href="{{route('user.purchased_tickets')}}">My Purchased Tickets</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{route('profile.edit',\Auth::user())}}">Profile</a>
                                </li>
                            @endif

                            @if(\Auth::user()->isAdmin())
                                <li class="list-group-item">
                                    <a href="{{route('customers_list')}}">Customers List</a>
                                </li>

                                <li class="list-group-item">
                                    <a href="{{route('tickets.canceled')}}">Canceled Tickets</a>
                                </li>
                            @endif

                        </ul>

                    </div>
                    <div class="col-md-10">
                        @yield('content')
                    </div>
                </div>
            </div>
        @else
            <div class="col-12">
                @yield('content')
            </div>
        @endauth

    </main>
</div>
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
