@extends('layout.project')

@section('content')
    @include('dashboard.partials.breadcrumb')

    <div class="source-view">
        <div class="source-header">
            <div class="meta"></div>

            <div class="btn-group pull-right">
                <a href="/battlecity/raw/master/.env.example" class="btn btn-default btn-sm"><span class="fa fa-file-text-o"></span> Raw</a>
                <a href="/battlecity/blame/master/.env.example" class="btn btn-default btn-sm"><span class="fa fa-bullhorn"></span> Blame</a>
                <a href="/battlecity/commits/master/.env.example" class="btn btn-default btn-sm"><span class="fa fa-list"></span> History</a>
            </div>
        </div>
                <div class="CodeMirror CodeMirror-wrap"><div style="overflow: hidden; position: relative; width: 3px; height: 0px; top: 4.79688px; left: 47.7969px;"><textarea style="position: absolute; padding: 0; width: 1px; height: 1em" wrap="off" autocorrect="off" autocapitalize="off"></textarea></div><div class="CodeMirror-scrollbar cm-sb-overlap" style="display: none;"><div class="CodeMirror-scrollbar-inner"></div></div><div class="CodeMirror-scroll cm-s-default" tabindex="-1"><div style="position: relative"><div style="position: relative; top: 0px;"><div class="CodeMirror-gutter" style="height: 330px;"><div class="CodeMirror-gutter-text"><pre><a name="L1"></a><a href="#L1">1</a></pre><pre><a name="L2"></a><a href="#L2">2</a></pre><pre><a name="L3"></a><a href="#L3">3</a></pre><pre><a name="L4"></a><a href="#L4">4</a></pre><pre><a name="L5"></a><a href="#L5">5</a></pre><pre><a name="L6"></a><a href="#L6">6</a></pre><pre><a name="L7"></a><a href="#L7">7</a></pre><pre><a name="L8"></a><a href="#L8">8</a></pre><pre><a name="L9"></a><a href="#L9">9</a></pre><pre><a name="L10"></a><a href="#L10">10</a></pre><pre><a name="L11"></a><a href="#L11">11</a></pre><pre><a name="L12"></a><a href="#L12">12</a></pre><pre><a name="L13"></a><a href="#L13">13</a></pre><pre><a name="L14"></a><a href="#L14">14</a></pre><pre><a name="L15"></a><a href="#L15">15</a></pre><pre><a name="L16"></a><a href="#L16">16</a></pre><pre><a name="L17"></a><a href="#L17">17</a></pre><pre><a name="L18"></a><a href="#L18">18</a></pre><pre><a name="L19"></a><a href="#L19">19</a></pre><pre>&nbsp;&nbsp;<a name="L20"></a><a href="#L20">20</a></pre></div></div><div class="CodeMirror-lines"><div style="position: relative; z-index: 0; outline: none; margin-left: 38px;"><div style="position: absolute; width: 100%; height: 0px; overflow: hidden; visibility: hidden;"></div><pre class="CodeMirror-cursor" style="top: 0px; left: 0px;">&nbsp;</pre><pre class="CodeMirror-cursor" style="visibility: hidden">&nbsp;</pre><div style="position: relative; z-index: -1; display: none;"></div><div><pre>APP_ENV=local</pre><pre>APP_DEBUG=true</pre><pre>APP_KEY=SomeRandomString</pre><pre> </pre><pre>DB_HOST=localhost</pre><pre>DB_DATABASE=homestead</pre><pre>DB_USERNAME=homestead</pre><pre>DB_PASSWORD=secret</pre><pre> </pre><pre>CACHE_DRIVER=file</pre><pre>SESSION_DRIVER=file</pre><pre>QUEUE_DRIVER=sync</pre><pre> </pre><pre>MAIL_DRIVER=smtp</pre><pre>MAIL_HOST=mailtrap.io</pre><pre>MAIL_PORT=2525</pre><pre>MAIL_USERNAME=null</pre><pre>MAIL_PASSWORD=null</pre><pre>MAIL_ENCRYPTION=null</pre><pre> </pre></div></div></div></div></div></div></div>
            </div>
            
@stop