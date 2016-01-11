@extends('layout.dashboard')

@section('body')
    @include('dashboard.partials.navigation')

    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-3 sidebar">
                <div class="list-group">
                    @foreach($sub_menu as $key => $item)
                    <a href="{{ $item['url'] }}" class="list-group-item @if($item['active']) active @endif">{{ $item['title'] }}</a>
                    @endforeach
                </div>
            </div>
            @yield('content')
        </div>
        @include('dashboard.partials.footer')
    </div>
@stop
