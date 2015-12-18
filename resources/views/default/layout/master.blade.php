<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="env" content="{{ app('env') }}">
    <meta name="token" content="{{ csrf_token() }}">

    <link rel="alternate" type="application/atom+xml" href="/atom" title="{{ $app_name.' | Gitamin' }} - Atom Feed">
    <link rel="alternate" type="application/rss+xml" href="/rss" title="{{ $app_name.' | Gitamin' }} - RSS Feed">

    <!-- Mobile friendliness -->
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading -->
    <meta http-equiv="cleartype" content="on">

    @if (isset($favicon))
    <link rel="icon" type="image/png" href="/img/{{ $favicon }}.ico">
    <link rel="shortcut icon" href="/img/{{ $favicon }}.png" type="image/x-icon">
    @else
    <link rel="icon" type="image/png" href="/img/favicon.ico">
    <link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">
    @endif

    <title>{{ $app_name.' | Gitamin' . $page_title }} {{ $page_title }}</title>
    <link href="{{ $google_fonts_url or 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ elixir('dist/css/gitamin.css') }}">

    @include('partials.stylesheet')

    @include('partials.crowdin')

    @if($stylesheet = $app_stylesheet)
    <style type="text/css">
    {!! $stylesheet !!}
    </style>
    @endif

    <script type="text/javascript">
        var Global = {};
        Global.locale = '{{ $app_locale }}';
    </script>
    <script src="{{ elixir('dist/js/gitamin.js') }}"></script>
</head>
<body class="@yield('bodyClass')">

    @include('partials.banner')

    <div class="container">
    @yield('content')
    </div>

    @include('partials.footer')
</body>
</html>
