@extends('layout.project')

@section('content')
    @include('dashboard.partials.breadcrumb')
    <table class="table tree table-hover">
        <thead>
            <tr>
                <th width="80%">Name</th>
                <th width="10%">Mode</th>
                <th width="10%">Size</th>
            </tr>
        </thead>
        <tbody>
                                    <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Baidu/api/tree/master/app/">app</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Baidu/api/tree/master/bootstrap/">bootstrap</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Baidu/api/tree/master/config/">config</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Baidu/api/tree/master/database/">database</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Baidu/api/tree/master/public/">public</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Baidu/api/tree/master/resources/">resources</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Baidu/api/tree/master/storage/">storage</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-folder-open"></span> <a href="/Baidu/api/tree/master/tests/">tests</a></td>
                <td>040000</td>
                <td></td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Baidu/api/blob/master/.env.example">.env.example</a></td>
                <td>100755</td>
                <td>0 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Baidu/api/blob/master/.gitattributes">.gitattributes</a></td>
                <td>100755</td>
                <td>0 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Baidu/api/blob/master/.gitignore">.gitignore</a></td>
                <td>100755</td>
                <td>0 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Baidu/api/blob/master/.htaccess">.htaccess</a></td>
                <td>100644</td>
                <td>0 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Baidu/api/blob/master/artisan">artisan</a></td>
                <td>100755</td>
                <td>2 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Baidu/api/blob/master/composer.json">composer.json</a></td>
                <td>100755</td>
                <td>1 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Baidu/api/blob/master/composer.lock">composer.lock</a></td>
                <td>100755</td>
                <td>114 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Baidu/api/blob/master/elixir-extension.js">elixir-extension.js</a></td>
                <td>100644</td>
                <td>1 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Baidu/api/blob/master/gulpfile.js">gulpfile.js</a></td>
                <td>100755</td>
                <td>1 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Baidu/api/blob/master/package.json">package.json</a></td>
                <td>100755</td>
                <td>0 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Baidu/api/blob/master/phpspec.yml">phpspec.yml</a></td>
                <td>100755</td>
                <td>0 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Baidu/api/blob/master/phpunit.xml">phpunit.xml</a></td>
                <td>100755</td>
                <td>1 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Baidu/api/blob/master/readme.md">readme.md</a></td>
                <td>100755</td>
                <td>2 kb</td>
            </tr>
                        <tr>
                <td><span class="fa fa-file-text-o"></span> <a href="/Baidu/api/blob/master/server.php">server.php</a></td>
                <td>100755</td>
                <td>1 kb</td>
            </tr>
                    </tbody>
    </table>

    <div class="readme-view">
            <div class="md-header">
                <span class="meta">readme</span>
            </div>
            <div id="md-content">README</div>
        </div>

        <hr />
@stop