<?php

namespace Hashstudio\JuroSdk;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lande\JuroSdk\Skeleton\SkeletonClass
 */
class JuroSdkFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'juro-sdk';
    }
}
