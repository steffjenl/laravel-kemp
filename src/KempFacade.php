<?php
namespace Kemp;

/**
 * Class Facade
 *
 * @package   laravel-kemp
 * @author    Stephan Eizinga <stephan@monkeysoft.nl>
 */
class KempFacade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'kemp';
    }
}
