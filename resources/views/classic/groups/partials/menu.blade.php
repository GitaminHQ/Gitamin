<ul class="nav nav-tabs">
    <li @if($active_item == 'group_show') class="active" @endif><a href="{{ $group->url }}"><i class="octicon octicon-organization"></i> Group</a></li>
    <li @if($active_item == 'group_edit') class="active" @endif><a href="{{ $group->url }}/edit"><i class="octicon octicon-gear"></i> Settings</a></li>
</ul>