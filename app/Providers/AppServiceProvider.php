<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(
            \App\Repositories\User\InterFaceUser::class,
            \App\Repositories\User\UserRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Student\InterFaceStudent::class,
            \App\Repositories\Student\StudentRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\LopHoc\InterFaceLopHoc::class,
            \App\Repositories\LopHoc\LopHocRepository::class,
        );
    }
}
