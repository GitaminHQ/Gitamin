@extends('layout.dashboard')

@section('body')
    @include('dashboard.partials.navigation')
    <div class="container">

   <table class="table table-striped commits">
    <thead>
                    @forelse($moments as $moment)
                        @if($moment->momentable)
                        @include('moments.partials.' . strtolower($moment->momentableName))
                    @endif
                    @empty
                    <div class="list-group-item text-danger">{{ trans('dashboard.moments.add.message') }}</div>
                    @endforelse
</thead>
</table>
    </div>
@endsection