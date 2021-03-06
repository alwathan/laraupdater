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

## Add Service Provider

Add new provider to the providers array of `config/app.php`:

```php
'providers' => [
    // ...
    
    /*
     * Package Service Providers...
     */
    Alwathan\LaraUpdater\LaraUpdaterServiceProvider::class,
    
    // ...
],
```

## Configuration
After installing the package you need to publish the configuration file via
```sh
$ php artisan vendor:publish --provider="Alwathan\LaraUpdater\LaraUpdaterServiceProvider"
```
 
**Note:** Please enter correct value for vendor and repository name in your `config/laraupdater.php`.

### :information_source: Setting the currently installed version

Before starting an update, make sure to set the version installed correctly.
You're responsible to set the current version installed, either in the config file or better via the env variable `APP_VERSION`.


Setting in `config/laraupdater.php`

```php
return [
    'app_version'               => env('APP_VERSION', 'v2.0'),
    'github' => [
        'vendor'                    => env('GITHUB_VENDOR','vendor'),
        'repository'                => env('GITHUB_REPOSITORY','repository'),
        'personal_access_token'     => env('GITHUB_PERSONAL_ACCESS_TOKEN','token_access'),
    ],
];
```
### Example to Execute LaraUpdater

`localhost:8000/laraupdater`

## Licence
The MIT License (MIT). Please see [Licence file](LICENSE) for more information.

<a href="https://www.buymeacoffee.com/alwathan" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: 41px !important;width: 174px !important;box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;" ></a>
