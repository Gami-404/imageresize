<?php
/**
 * Created by PhpStorm.
 * User: gami
 * Date: 21/08/16
 * Time: 02:59 م
 */

namespace Image\Facades;

use Illuminate\Support\Facades\Facade;

class Image extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'image';
    }
}