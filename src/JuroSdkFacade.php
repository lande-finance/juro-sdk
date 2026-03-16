<?php

namespace Hashstudio\JuroSdk;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hashstudio\JuroSdk\JuroSdk
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
        return JuroSdk::class;
    }
}
