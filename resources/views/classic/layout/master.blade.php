@extends('layout.dashboard')

@section('body')
    @include('dashboard.partials.navigation')

    <div class="container">
        <div class="row">
            @yield('content')
        </div>
        @include('dashboard.partials.footer')
    </div>
@stop
