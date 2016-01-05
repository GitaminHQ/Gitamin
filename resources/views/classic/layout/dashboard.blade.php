<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8" />
    <title>{{ $page_title or $app_name.' | Gitamin' }}</title>
    <link rel="stylesheet" href="{{ elixir('dist/css/classic.css') }}">
    <script src="{{ elixir('dist/js/gitamin.js') }}"></script>
        
        <!--[if lt IE 9]>
        <script src="/dist/js/classic/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        @yield('body')
    </body>
</html>
