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
            <table class="table tree">
        <thead>
            <tr>
                <th width="80%">Name</th>
                <th width="10%">Mode</th>
                <th width="10%">Size</th>
            </tr>
        </thead>
        <tbody>
                                    <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Gitamin/tree/master/app/">app</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Gitamin/tree/master/bootstrap/">bootstrap</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Gitamin/tree/master/config/">config</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Gitamin/tree/master/database/">database</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Gitamin/tree/master/public/">public</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Gitamin/tree/master/resources/">resources</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Gitamin/tree/master/storage/">storage</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Gitamin/tree/master/tests/">tests</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/.bowerrc">.bowerrc</a></td>
                <td>100644</td>
                <td>0 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/.editorconfig">.editorconfig</a></td>
                <td>100644</td>
                <td>0 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/.env.example">.env.example</a></td>
                <td>100644</td>
                <td>0 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/.gitattributes">.gitattributes</a></td>
                <td>100644</td>
                <td>0 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/.gitignore">.gitignore</a></td>
                <td>100644</td>
                <td>0 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/.travis.yml">.travis.yml</a></td>
                <td>100644</td>
                <td>1 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/CONTRIBUTING.md">CONTRIBUTING.md</a></td>
                <td>100644</td>
                <td>3 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/LICENSE">LICENSE</a></td>
                <td>100644</td>
                <td>1 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/README.md">README.md</a></td>
                <td>100644</td>
                <td>2 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/VERSION">VERSION</a></td>
                <td>100644</td>
                <td>0 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/artisan">artisan</a></td>
                <td>100644</td>
                <td>2 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/bower.json">bower.json</a></td>
                <td>100644</td>
                <td>1 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/composer.json">composer.json</a></td>
                <td>100644</td>
                <td>3 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/composer.lock">composer.lock</a></td>
                <td>100644</td>
                <td>165 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/gulpfile.js">gulpfile.js</a></td>
                <td>100644</td>
                <td>2 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/npm-debug.log">npm-debug.log</a></td>
                <td>100644</td>
                <td>1,197 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/package.json">package.json</a></td>
                <td>100644</td>
                <td>0 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/phpunit.xml.dist">phpunit.xml.dist</a></td>
                <td>100644</td>
                <td>1 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Gitamin/blob/master/server.php">server.php</a></td>
                <td>100644</td>
                <td>0 kb</td>
            </tr>
                    </tbody>
    </table>
        </div>
    </div>
</div>
@stop
