@extends('layout.project')

@section('content')
    @include('dashboard.partials.breadcrumb')
    @include('dashboard.partials.errors')
issue show
<br />
<a href="issues/new">{{ trans('dashboard.issues.new.title') }}</a>
@endsection