<?php
namespace Ali\ChatSystem;
 
use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;


class PackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        (new Filesystem)->ensureDirectoryExists(app_path('HTTP/Controllers'));
        (new Filesystem)->ensureDirectoryExists(app_path('Events'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/layouts'));
        (new Filesystem)->copyDirectory(__DIR__.'/../stubs/controller', app_path('HTTP/Controllers'));
        (new Filesystem)->copyDirectory(__DIR__.'/../stubs/Events', app_path('Events'));
        (new Filesystem)->copyDirectory(__DIR__.'/../stubs/Models', app_path('Models'));
        (new Filesystem)->copyDirectory(__DIR__.'/../stubs/views', resource_path('/views'));
        (new Filesystem)->copyDirectory(__DIR__.'/../stubs/public', base_path('/public'));
        (new Filesystem)->copyDirectory(__DIR__.'/../stubs/migration', base_path('/database/migrations'));
        copy(__DIR__.'/../stubs/layouts/messenger.blade.php', resource_path('/views/layouts/messenger.blade.php'));

    }
}
