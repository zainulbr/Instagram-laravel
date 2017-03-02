<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class PostRepositoryServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->bind('App\Repositories\BaseRepository', 'App\Repositories\PostRepository');
    }

}