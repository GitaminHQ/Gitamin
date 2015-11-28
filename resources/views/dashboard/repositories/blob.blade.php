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
        <!-- start -->
           <div class="source-view">
        <div class="source-header">
            <div class="meta"></div>

            <div class="btn-group pull-right">
                <a href="/Gitamin/raw/master/.bowerrc" class="btn btn-default btn-sm"><span class="fa fa-file-text-o"></span> Raw</a>
                <a href="/Gitamin/blame/master/.bowerrc" class="btn btn-default btn-sm"><span class="fa fa-bullhorn"></span> Blame</a>
                <a href="/Gitamin/commits/master/.bowerrc" class="btn btn-default btn-sm"><span class="fa fa-list"></span> History</a>
            </div>
        </div>
                <div class="CodeMirror CodeMirror-wrap"><div style="overflow: hidden; position: relative; width: 3px; height: 0px; top: 4.79688px; left: 33.7969px;"><textarea style="position: absolute; padding: 0; width: 1px; height: 1em" wrap="off" autocorrect="off" autocapitalize="off"></textarea></div><div class="CodeMirror-scrollbar cm-sb-overlap" style="display: none;"><div class="CodeMirror-scrollbar-inner"></div></div><div class="CodeMirror-scroll cm-s-default" tabindex="-1"><div style="position: relative"><div style="position: relative; top: 0px;"><div class="CodeMirror-gutter" style="height: 90px;"><div class="CodeMirror-gutter-text"><pre><a name="L1"></a><a href="#L1">1</a></pre><pre><a name="L2"></a><a href="#L2">2</a></pre><pre><a name="L3"></a><a href="#L3">3</a></pre><pre><a name="L4"></a><a href="#L4">4</a></pre><pre>&nbsp;<a name="L5"></a><a href="#L5">5</a></pre></div></div><div class="CodeMirror-lines"><div style="position: relative; z-index: 0; outline: none; margin-left: 24px;"><div style="position: absolute; width: 100%; height: 0px; overflow: hidden; visibility: hidden;"></div><pre class="CodeMirror-cursor" style="top: 0px; left: 0px;">&nbsp;</pre><pre class="CodeMirror-cursor" style="visibility: hidden">&nbsp;</pre><div style="position: relative; z-index: -1; display: none;"></div><div><pre>{</pre><pre>    "directory": "vendor/bower_components",</pre><pre>    "interactive": false</pre><pre>}</pre><pre> </pre></div></div></div></div></div></div></div>
            </div>
        <!-- end -->

        </div>
    </div>
</div>
@stop
