<?php 

namespace Mediumart\Intercom;

use Illuminate\Support\Facades\Facade;

class Intercom extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'intercom'; }
}