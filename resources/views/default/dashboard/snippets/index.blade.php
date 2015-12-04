@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-clipboard"></i> {{ trans('dashboard.snippets.snippets') }}
                </span>
                <a class="btn btn-sm btn-success pull-right" href="{{ route('dashboard.snippets.index') }}">
                    {{ trans('dashboard.snippets.add.title') }}
                </a>
                <div class="clearfix"></div>
            </div>
            @include('dashboard.partials.errors')
            <div class="row">
                <div class="col-sm-12 striped-list" id="snippet-list">
                    @forelse($snippets as $snippet)
                    <div class="row striped-list-item {{ !$snippet->enabled ? 'bg-warning' : null }}" data-snippet-id="{{ $snippet->id }}">
                        <div class="col-xs-6">
                            <h4>
                                @if($snippets->count() > 1)
                                <span class="drag-handle"><i class="ion-drag"></i></span>
                                @endif
                                <a href="{{ route('dashboard.snippets.show', $snippet->id) }}">{{ $snippet->name }}</a> <small>{{ $snippet->humanStatus }}</small>
                            </h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="/dashboard/snippets/{{ $snippet->id }}/edit" class="btn btn-default">{{ trans('forms.edit') }}</a>
                            <a href="/dashboard/snippets/{{ $snippet->id }}/delete" class="btn btn-danger confirm-action" data-method="DELETE">{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item"><a href="{{ route('dashboard.snippets.index') }}">{{ trans('dashboard.snippets.add.message') }}</a></div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@stop
