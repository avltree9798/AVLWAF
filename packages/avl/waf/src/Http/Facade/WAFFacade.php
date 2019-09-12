<?php
/**
 * Created by PhpStorm.
 * User: avltree
 * Date: 18/09/18
 * Time: 9:32
 */

namespace AVL\WAF\Http\Facade;

use Illuminate\Support\Facades\Facade;

class WAFFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'waf';
    }
}