@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-exclamation-circle"></i> {{ trans('dashboard.issues.issues') }}
                </span>
                <a class="btn btn-sm btn-success pull-right" href="{{ route('dashboard.issues.add') }}">
                    {{ trans('dashboard.issues.add.title') }}
                </a>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @include('dashboard.partials.errors')
                    <!--<p class="lead">{!! trans_choice('dashboard.issues.logged', $issues->count(), ['count' => $issues->count()]) !!}</p>-->

                    <div class="striped-list">
                        @foreach($issues as $issue)
                        <div class="row striped-list-item">
                            <div class="col-xs-6">
                                <i class="{{ $issue->icon }}"></i> <strong>{{ $issue->title }}</strong>
                                @if($issue->description)
                                <p><small>{{ Str::words($issue->description, 5) }}</small></p>
                                @endif
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="{{ $issue->url }}/edit" class="btn btn-sm btn-default">{{ trans('forms.edit') }}</a>
                                <a href="{{ $issue->url }}/delete" class="btn btn-sm btn-danger confirm-action" data-method='DELETE'>{{ trans('forms.delete') }}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
