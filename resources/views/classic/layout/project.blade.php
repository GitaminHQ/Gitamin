@extends('layout.dashboard')

@section('body')
    @include('dashboard.partials.navigation')

    <div class="container">
        <div class="header row">
            <div class="col-sm-12">

                <form class="pull-right" action="" method="POST">
                    <input type="search" name="query" class="form-control input-sm" placeholder="Search commits...">
                </form>

                @if(isset($project))
                    @include('projects.partials.branch_menu')
                    @include('projects.partials.menu')
                @endif
            </div>
        </div>

        @yield('content')

        @include('dashboard.partials.footer')
    </div>
@stop
