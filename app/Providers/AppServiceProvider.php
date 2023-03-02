<?php

namespace App\Providers;

use App\Constants\Enum;
use Illuminate\Database\Query\Builder;
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
        Builder::macro('whereUndeleted', function () {
            $this->where(function ($q) {
                return $q->orWhereNull('delete_flag')
                    ->orWhere('delete_flag', config('constants.UNDELETED'));
            });
        });
    }
}
