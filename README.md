## Gitamin


[![Build Status](https://travis-ci.org/GitaminHQ/Gitamin.svg)](https://travis-ci.org/GitaminHQ/Gitamin)
[![StyleCI](https://styleci.io/repos/47098331/shield)](https://styleci.io/repos/47098331/)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gitaminhq/Gitamin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gitaminhq/Gitamin/?branch=master)
[![License](https://poser.pugx.org/gitaminhq/Gitamin/license.svg)](https://packagist.org/packages/gitaminhq/Gitamin)

![Gitamin](https://camo.githubusercontent.com/0befc9a96508922a1b1465952ecf2d3e00115a7e/687474703a2f2f7777772e363438322e636f6d2f676974616d696e2e706e673f726e643d313233)

Gitamin(pronounced /ˈgɪtəmɪn/, inspired by Vitamin) is an open source git repository management software built with the Laravel PHP Framework. Gitamin supports a wide range of operations on git repository. Frequently used operations (git repository management, code reviews, issue tracking, activity feeds and wikis) can be performed via the user interface, while you still have the ability to directly execute any git-cli command.

## Features

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

There are a few things that you will need to have set up in order to run Gitamin:

- A web server: **Nginx**, **Apache** (with mod_rewrite), or **Lighttpd**
- **PHP 5.5.9+** with the following extensions: mbstring, pdo_mysql
- **MySQL** or **PostgreSQL**
- **Git 1.7.10+**
- **Redis 2.4+**
- **Composer**

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
