<?php
/**
 * Created by PhpStorm.
 * User: avltree
 * Date: 18/09/18
 * Time: 9:16
 */

namespace AVL\WAF\Http\Middleware;

abstract class Middleware
{
    public function enabled()
    {
        return config('waf.enabled');
    }
}