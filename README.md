## Gitamin

![Gitamin](https://camo.githubusercontent.com/0befc9a96508922a1b1465952ecf2d3e00115a7e/687474703a2f2f7777772e363438322e636f6d2f676974616d696e2e706e673f726e643d313233)

Gitamin(pronounced /ˈgɪtəmɪn/, inspired by Vitamin) is an open source git repository management software built with the Laravel PHP Framework. Gitamin supports a wide range of operations on git repository. Frequently used operations (git repository management, code reviews, issue tracking, activity feeds and wikis) can be performed via the user interface, while you still have the ability to directly execute any git-cli command.

## Features

![Gitamin](https://camo.githubusercontent.com/fa4651da6e44b1434fe4ee524ddb4c06adc3f055/687474703a2f2f7777772e363438322e636f6d2f73637265656e73686f742e6a7067)

This package is currently in (very-)alpha stage, so all of the following features may or may not work yet. However, feel free to post issues and features requests [here](https://github.com/gitaminhq/Gitamin/issues) . We will try to fix and improve the package as fast as we can based on your help!

* Multiple repository support
* Commit history, blame, diff
* Pull Requests
* Web Hooks
* Repository statistics
* Issues tracking
* Activity feeds
* Wikis
* RSS feeds
* Syntax highlighting

## Requirements

- PHP 5.5.9+
- [Composer](https://getcomposer.org)

## Installation

```shell
git clone https://github.com/gitaminhq/Gitamin
cd Gitamin
composer install --no-dev -o
cp .env.example .env
php artisan migrate
php artisan key:generate
php artisan config:cache
```
Type http://your_domain/ in your web browser's address bar.

## Official Documentation 

Documentation for Gitamin can be found on the [Gitamin website](http://gitamin.com/docs).

## Contributing

If you wish to contribute to this website, please [fork it on Gitamin](https://github.com/gitaminhq/Gitamin), push your change to a named branch, then send a pull request. If it is a big feature, you might want to start an Issue first to make sure it's something that will be accepted.  If it involves code, please also write tests for it.

## Development Requirements

These extra dependencies are required to develop Gitamin:

- Node.js
- Bower
- Gulp

```shell
npm install
bower install
gulp
```

### License

Gitamin is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
