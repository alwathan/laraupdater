# LaraUpdater - Laravel App Self Updater From Github Repository

This package provides some basic methods to implement a self updating from Github private repository
functionality for your Laravel 7 application. 

## Compatibility

* PHP: 7.3 & 7.4
* Laravel: 7.x
  
## Install

To install the latest version from the master using [Composer](https://getcomposer.org/):
```sh
$ composer require alwathan/laraupdater
```

## Configuration
After installing the package you need to publish the configuration file via
```sh
$ php artisan vendor:publish --provider="Alwathan\LaraUpdater\LaraUpdaterServiceProvider"
```
 
**Note:** Please enter correct value for vendor and repository name in your `config/laraupdater.php`.

### :information_source: Setting the currently installed version

Before starting an update, make sure to set the version installed correctly.
You're responsible to set the current version installed, either in the config file or better via the env variable `SELF_UPDATER_VERSION_INSTALLED`.


Select the branch that should be used via the `use_branch` setting [inside the configuration](https://github.com/codedge/laravel-selfupdater/blob/master/config/self-update.php).

```php
// ...
'repository_types' => [
    'github' => [
        'type' => 'github',
        'repository_vendor' => env('SELF_UPDATER_REPO_VENDOR', ''),
        'repository_name' => env('SELF_UPDATER_REPO_NAME', ''),
        // ...
        'use_branch' => 'v2',
   ],          
   // ...
];
```
## Licence
The MIT License (MIT). Please see [Licence file](LICENSE) for more information.
