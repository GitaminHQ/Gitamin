<tr>
    <td width="5%"><img src="{{ $moment->author->avatar }}" style="width:40px; height: 40px;" /></td>
    <td width="95%">
        <span class="pull-right"><span class="fa fa-list-alt"></span> {{ $moment->created_at_diff }}</span>
        <h4>{{ $moment->actionName }} account</h4>
        <span>
            <a href="{{ $moment->author->url }}">{{ $moment->momentable->name }}</a> authored on {{ $moment->created_at }}
                            </span>
    </td>
</tr>