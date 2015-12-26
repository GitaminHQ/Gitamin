<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>{{ $page_title }}</title>
        <link rel="stylesheet" href="{{ elixir('dist/css/style.css') }}">
        <!--[if lt IE 9]>
        <script src="/dist/js/classic/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        @yield('body')
        <script src="/dist/js/classic/jquery.js"></script>
        <script src="/dist/js/classic/raphael.js"></script>
        <script src="/dist/js/classic/bootstrap.js"></script>
        <script src="/dist/js/classic/codemirror.js"></script>
        <script src="/dist/js/classic/showdown.js"></script>
        <script src="/dist/js/classic/table.js"></script>
        <script src="/dist/js/classic/main.js"></script>
        <script src="/dist/js/classic/networkGraph.js"></script>
    </body>
</html>
