<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

trait ModelTrait
{
    /**
     * generate
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {

        });

        static::updating(function (Model $model) {

        });

        static::saving(function (Model $model) {

        });

        static::updated(function (Model $model) {

        });

        static::created(function (Model $model) {
            self::clearCache($model);
        });
    }

    protected static function clearCache($model) {
        for ($i = 0; $i < 100; $i++) {
            $cacheName = $model->getTable().'_page_'.$i;
            if(Cache::has($cacheName)) {
                Cache::forget($cacheName);
            }
        }
    }
}
