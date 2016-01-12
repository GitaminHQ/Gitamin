@extends('layout.project')

@section('content')
    @include('dashboard.partials.breadcrumb')

<div class="commit-view">
    <div class="commit-header">
        <span class="pull-right">
            <a class="btn btn-default btn-sm" href="{{ $project->url }}/tree/{{ $commit->getHash() }}" title="Browse code at this point in history"><span class="fa fa-list-alt"></span> Browse code</a></span>
        <h4>{{ $commit->getMessage() }}</h4>
    </div>
    <div class="commit-body">
        <p>{{ $commit->getBody() }}</p>
                    <img src="/img/no_user_avatar.png" style="width:40px; height:32px;" class="pull-left space-right">
        <span>
            <a href="mailto:{{ $commit->getAuthor()->getEmail() }}">{{ $commit->getAuthor()->getName() }}</a> authored on 111
                            <br>Showing {{ $commit->getChangedFiles() }} changed files
        </span>
    </div>
</div>

 <ul class="commit-list">
    @foreach($commit->getDiffs() as $diff)
    <li><i class="fa fa-file-text-o"></i> <a href="#diff-{{ $diff->getIndex() }}">{{ $diff->getFile() }}</a> <span class="meta pull-right">{{ $diff->getIndex() }}</span></li>
    @endforeach
</ul>

@foreach($commit->getDiffs() as $diff)
<div class="source-view">
    <div class="source-header">
        <div class="meta"><a id="diff-1">{{ $diff->getFile() }}</div>

        <div class="btn-group pull-right">
            <a href="#"  class="btn btn-default btn-sm"><span class="fa fa-list-alt"></span> History</a>
            <a href="#"  class="btn btn-default btn-sm"><span class="fa fa-file"></span> View file @ {{ $commit->getShortHash() }}</a>
        </div>
    </div>

    <div class="source-diff">
    <table>
    @foreach($diff->getLines() as $line)
        <tr>
            <td class="lineNo">
                @if($line->getType() != 'chunk')
                    <a name="L1R{{ $line->getNumOld() }}"></a>
                    <a href="#L1R{{ $line->getNumOld() }}">
                @endif
                {{ $line->getNumOld() }}
                @if($line->getType() != 'chunk')
                    </a>
                @endif
            </td>
            <td class="lineNo">
                @if($line->getType() != 'chunk')
                    <a name="L1L{{ $line->getNumNew() }}"></a>
                    <a href="#L1L{{ $line->getNumNew() }}">
                @endif
                {{ $line->getNumNew() }}
                @if($line->getType() != 'chunk')
                    </a>
                @endif
            </td>
            <td style="width: 100%">
                <pre @if($line->getType()) class="{{ $line->getType() }}" @endif>{{ $line->getLine() }}</pre>
            </td>
        </tr>
    @endforeach
    </table>
    </div>
</div>
@endforeach
@endsection