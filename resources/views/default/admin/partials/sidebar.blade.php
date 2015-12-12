<div class="sidebar">
    <div class="sidebar-inner">
        <ul>
            <li {!! set_active('admin') !!}>
                <a href="{{ route('admin.index') }}">
                    <i class="fa fa-wrench"></i>
                    <span>{{ trans('admin.admin') }}</span>
                </a>
            </li>
            <li {!! set_active('admin/setting*') !!}>
                 <a href="{{ route('admin.settings.general') }}">
                    <i class="fa fa-gear"></i>
                    <span>{{ trans('admin.settings.settings') }}</span>
                </a>
            </li>
        </ul>
        
    </div>
</div>
