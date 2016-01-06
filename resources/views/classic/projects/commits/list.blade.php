@foreach($commits as $date => $commit_list)
<table class="table table-striped commits">
    <thead>
        <tr>
            <th colspan="3">{{ $date }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($commit_list as $commit)
        <tr>
            <td width="5%"><img style="width:32px; height:32px;" src="/img/no_user_avatar.png" /></td>
            <td width="95%">
                <span class="pull-right"><a class="btn btn-default btn-sm" href="{{ $project->url }}/commit/{{ $commit->getHash() }}"><span class="fa fa-list-alt"></span> View {{ $commit->getShortHash() }}</a></span>
                <h4>{{ $commit->getMessage() }}</h4>
                <span>
                    <a href="mailto:{{ $commit->getAuthor()->getEmail() }}">{{ $commit->getAuthor()->getName() }}</a> authored on 26/10/2015 01:50:59
                                    </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endforeach

<ul class="pager">
    @if($pager['current'] != 0)
    <li class="previous">
        <a href="?page={{ $pager['previous'] }}">&larr; Newer</a>
    </li>
    @endif
    @if($pager['current'] != $pager['last'])
    <li class="next">
        <a href="?page={{ $pager['next'] }}">Older &rarr;</a>
    </li>
    @endif
</ul>
