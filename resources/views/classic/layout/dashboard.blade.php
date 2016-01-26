<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />

    <meta name="env" content="{{ app('env') }}" />
    <meta name="token" content="{{ csrf_token() }}" />

    <link rel="icon" type="image/png" href="/img/favicon.ico">
    <link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">
    <title>{{ $page_title or $app_name.' | Gitamin' }}</title>
    <link rel="stylesheet" href="{{ elixir('dist/css/classic.css') }}">
    <script src="{{ elixir('dist/js/gitamin.js') }}"></script>
    </head>

    <body>
        @yield('body')
    </body>
</html>
