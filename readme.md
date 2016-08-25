# Small units
Small units can use in  many apps this has one purpose is resize the image.
add this very faster unit because this work in any service provider and very spacial is not take time 
in autoload 
## Contributing

Thank you for considering contributing to the smallUnit component! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within smallUnit, please send an e-mail to Taylor Otwell at [abdo.gamy2010@gmail.com]() . All security vulnerabilities will be promptly addressed.

## License

The smallunit framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
##Documentation
###First Download
using composer ...
 ```
 composer require smallunit/image
 ```
 
###next
bind the class by using any service provider active in laravel,as app/Providers/AppServiceProvider.php
path is created by laravel  copy
```
$this->app->bind("image", function () {
            return new Image(config('config_file_name.versions'));
        });
```
in AppServiceProvider@boot method.
[config_file_name] you can config you versions in any file you want
or create you own config file in [project_name/config/myconfigFile] ,[versions] is key of array of version you can change it.
###Final
add Facade alias in config/app.php
```
  'Image'=> Image\Facades\Image::class,
```
###Configuration
add in you file which you define in Your service provider this structure
```/*
       |--------------------------------------------------------------------------
       | Image versions
       |--------------------------------------------------------------------------
       | Defining your standard versions 's information for image  which you
       | resize. it is very easy way and very simple code to resize image
       */
   
     'versions' => [
           'Profile'=>[// version name
               'height'=>'150',
               'width'=>'200',
               'quality'=>'100',//quality of new version
               'suffix'=>'profile',//suffix of version
               'path'=>''//form public path in laravel project
           ],
           //another version
           'Icons-posts'=>[
               'height'=>'75',
               'width'=>'75',
               'quality'=>'50',
               'suffix'=>'icons',
               'path'=>'src/img/posts/'
           ]
       ],

```
##Functions
```
/**
     * add runtime versions
     * @param $version
 */
Image::addVersion($versionArray)
 /**
     * Make all version  for image
     * @param $originalPath > the path of originalPath
     */
Image::makeAllVersions($originalPath)
    /**
     * Make version which his name $versionName 
     * @param $versionName
     * @param $originalPath
     */
Image::makeVersion($versionName, $originalPath)
**
     * @param $versionName
     * @param $originalPath
     * @return string path of the version will be created or been created
     */
Image::getVersionPath($versionName, $originalPath)
 /**
     * return the suffix of version
     * @param $versionName
     * @return mixed
 */
Image::suffix($versionName)
```
##Example
Apply this docs 
```
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Image\Image;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind("image", function () {
            return new Image(config('services.versions'));//Enter the you config_file , version
        });
    }
    ......................................
```

then .....
```
'aliases' => [
        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        ..
        ...
        ...
        ...
        .....
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\UR
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'Image'=> Image\Facades\Image::class,
  ],
```
add versions in config/services.php as 
```/*
       |--------------------------------------------------------------------------
       | Image versions
       |--------------------------------------------------------------------------
       | Defining your standard versions 's information for image  which you
       | resize. it is very easy way and very simple code to resize image
       */
     'versions' => [
           'Profile'=>[// version name
               'height'=>'150',
               'width'=>'200',
               'quality'=>'100',//quality of new version
               'suffix'=>'profile',//suffix of version
               'path'=>''//form public path in laravel project
           ],
           //another version
           'Icons-posts'=>[
               'height'=>'75',
               'width'=>'75',
               'quality'=>'50',
               'suffix'=>'icons',
               'path'=>'src/img/posts/'
           ]
       ],

```
Route resize test...
```
Route::get('reszie',function(){
    //Add path the original path
    Image::makeAllVersions(public_path('src/1825537641364050182.jpg'));
    return 'done';
});
```
to get the path of version use [getVersionPath] method.
send you feedback [abdo.gamy2010@gmail.com]()

