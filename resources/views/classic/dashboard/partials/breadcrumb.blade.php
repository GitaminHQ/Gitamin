<ol class="breadcrumb">
    <li><a href="{{ $project->url }}/tree/{{ $current_branch }}">{{ $project->owner_path }}/{{ $project->path }}</a></li>

    @foreach($bread_crumbs as $breadcrumb)
    <li><a href="{{ $project->url }}/tree/{{ $current_branch }}/{{ $breadcrumb['path'] }}">{{ $breadcrumb['dir'] }}</a></li>
    @endforeach

    <div class="pull-right">
        <div class="btn-group download-buttons">
            <a type="button" href="{{ $project->url }}/zipball/{{ $current_branch }}" class="btn btn-default btn-xs" title="Download 'master' as a ZIP archive">ZIP</a>
            <a type="button" href="{{ $project->url }}/tarball/{{ $current_branch }}" class="btn btn-default btn-xs" title="Download 'master' as a TAR archive">TAR</a>
            <a href="{{ $project->url }}/{{ $current_branch }}/rss/"><span class="fa fa-rss rss-icon"></span></a>
        </div>
    </div>
</ol>