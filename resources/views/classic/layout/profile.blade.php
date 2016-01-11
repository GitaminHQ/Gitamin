@extends('layout.dashboard')

@section('body')
    @include('dashboard.partials.navigation')

    <div class="container">
        @yield('content')
        @include('dashboard.partials.footer')
    </div>
@stop
