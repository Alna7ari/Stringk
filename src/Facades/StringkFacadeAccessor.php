<?php

namespace Alnahari\Stringk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class SampleFacadeAccessor
 *
 * @author  Ahmed Alnahari <alna7ari@gmail.com>
 */
class StringkFacadeAccessor extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'stringk.sample';
    }
}
