<ol class="breadcrumb">
    @if(isset($project))
    <li><a href="{{ $project->url }}/tree/{{ $current_branch or 'master' }}">{{ $project->owner_path }}/{{ $project->path }}</a></li>
    @endif
    @foreach($bread_crumbs as $breadcrumb)
    @if(isset($project))
    <li><a href="{{ $project->url }}/tree/{{ $current_branch or 'master' }}/{{ $breadcrumb['path'] }}">{{ $breadcrumb['dir'] }}</a></li>
    @else
    <li>{{ $breadcrumb['dir'] }}</li>
    @endif
    @endforeach

    <div class="pull-right">
        <div class="btn-group download-buttons">
            @if(isset($project))
            <a type="button" href="{{ $project->url }}/zipball/{{ $current_branch or 'master' }}" class="btn btn-default btn-xs" title="Download 'master' as a ZIP archive">ZIP</a>
            <a type="button" href="{{ $project->url }}/tarball/{{ $current_branch or 'master' }}" class="btn btn-default btn-xs" title="Download 'master' as a TAR archive">TAR</a>
            <a href="{{ $project->url }}/{{ $current_branch or 'master' }}/rss/"><span class="fa fa-rss rss-icon"></span></a>
            @endif
        </div>
    </div>
</ol>