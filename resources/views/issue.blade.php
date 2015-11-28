@extends('layout.master')

@section('content')
<div class="section-messages">
    @include('dashboard.partials.errors')
</div>

@include('partials.about-app')

<h4>{{ formatted_date($issue->created_at) }}</h4>

<div class="timeline">
    <div class="content-wrapper">
        <div class="moment first">
            <div class="row event clearfix">
                <div class="col-sm-1">
                    <div class="status-icon status-{{ $issue->status }}" data-toggle="tooltip" title="{{ $issue->humanStatus }}" data-placement="left">
                        <i class="{{ $issue->icon }}"></i>
                    </div>
                </div>
                <div class="col-xs-10 col-xs-offset-2 col-sm-11 col-sm-offset-0">
                    @include('partials.issue', ['issue' => $issue, 'with_link' => false])
                </div>
            </div>
        </div>
    </div>
</div>
@stop
