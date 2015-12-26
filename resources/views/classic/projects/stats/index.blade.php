@extends('layout.project')

@section('content')
    @include('dashboard.partials.breadcrumb')
<table class="table stats">
        <thead>
            <tr>
                <th width="30%"><span class="fa fa-file-text"></span> File extensions (18)</th>
                <th width="40%"><span class="fa fa-users"></span> Authors (1)</th>
                <th width="30%"><span class="fa fa-star"></span> Other</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <ul>
                                            <li><strong>.php</strong>: 50 files</li>
                                            <li><strong>.gitignore</strong>: 9 files</li>
                                            <li><strong>.png</strong>: 5 files</li>
                                            <li><strong>.gitkeep</strong>: 5 files</li>
                                            <li><strong>.json</strong>: 3 files</li>
                                            <li><strong>.js</strong>: 3 files</li>
                                            <li><strong>.scss</strong>: 2 files</li>
                                            <li><strong>.htaccess</strong>: 2 files</li>
                                            <li><strong>.coffee</strong>: 2 files</li>
                                            <li><strong>.md</strong>: 1 files</li>
                                            <li><strong>.txt</strong>: 1 files</li>
                                            <li><strong>.tmx</strong>: 1 files</li>
                                            <li><strong>.example</strong>: 1 files</li>
                                            <li><strong>.ico</strong>: 1 files</li>
                                            <li><strong>.xml</strong>: 1 files</li>
                                            <li><strong>.gitattributes</strong>: 1 files</li>
                                            <li><strong>.lock</strong>: 1 files</li>
                                            <li><strong>.yml</strong>: 1 files</li>
                                        </ul>
                </td>
                <td>
                    <ul>
                                            <li><strong><a href="mailto:earljohn3ric@gmail.com">John Eric</a></strong>: 23 commits</li>
                                        </ul>
                </td>
                <td>
                    <p>
                        <strong>Total files:</strong> 91
                    </p>

                    <p>
                        <strong>Total bytes:</strong> 966030 bytes (1 MB)
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
@stop