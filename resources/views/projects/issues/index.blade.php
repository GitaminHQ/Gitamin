@extends('layout.dashboard')

@section('content')
<div class="header">
    <div class="sidebar-toggler visible-xs">
        <i class="fa fa-navicon"></i>
    </div>
    <span class="uppercase">
        <i class="fa fa-cubes"></i> {{ trans('dashboard.projects.projects') }}
    </span>
    &gt; <small>{{ trans('dashboard.projects.show.title') }}</small>
</div>

<div class="content-wrapper">

    <div class="row">
        <div class="col-sm-12">   
            <ul class="nav nav-tabs">
                <li><a href="/Baidu/Gitamin"><i class="fa fa-code"></i><span>Code</span></a></li>
                <li class="active"><a href="/Gitamin/issues"><i class="fa fa-exclamation-circle"></i><span>Issues</span></a></li>
                <li><a href="/Baidu/Gitamin/stats/master"><i class="fa fa-tasks"></i><span>Merge Requests</span></a></li>
            </ul>
        </div>
    </div>

    <div class="row">
	    <div class="col-sm-12">
	    	abc
	    </div>
    </div>

</div>
@stop