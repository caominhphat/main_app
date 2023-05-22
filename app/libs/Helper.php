<?php

namespace App\libs;

use Illuminate\Support\Facades\Cache;

class Helper
{
    public static function clearCache($table) {
        for ($i = 0; $i < 100; $i++) {
            $cacheName = $table.'_page_'.$i;
            if(Cache::has($cacheName)) {
                Cache::forget($cacheName);
            }
        }
    }
}
