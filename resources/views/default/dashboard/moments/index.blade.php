@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-sliders"></i> {{ trans('dashboard.moments.moments') }}
                </span>
                <div class="clearfix"></div>
            </div>
            @include('dashboard.partials.errors')
            <div class="row">
                <div class="col-sm-12 striped-list" id="moment-list">
                    <div class="content_list">
                    @forelse($moments as $moment)
                        @if($moment->momentable)
                        @include('moments.partials.' . strtolower($moment->momentableName))
                    @endif
                    @empty
                    <div class="list-group-item text-danger">{{ trans('dashboard.moments.add.message') }}</div>
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
