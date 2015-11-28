## Gitamin

![Gitamin](https://camo.githubusercontent.com/dc4da064add8031774697e66d8bbb2af578bcea3/687474703a2f2f7777772e363438322e636f6d2f676974616d696e2e706e67)

Gitamin is an open source git repository management software built with the Laravel PHP Framework. Gitamin supports a wide range of operations on git repository. Frequently used operations (git repository management, code reviews, issue tracking, activity feeds and wikis) can be performed via the user interface, while you still have the ability to directly execute any git-cli command.

## Features

This package is currently in (very-)alpha stage, so all of the following features may or may not work yet. However, feel free to post issues and features requests [here](https://github.com/gitaminhq/Gitamin/issues) . I'll try to fix and improve the package as fast as I can based on your help!

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
type http://your_domain/ in you brower.

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
