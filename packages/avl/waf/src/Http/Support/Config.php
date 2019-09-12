<?php
/**
 * Created by PhpStorm.
 * User: avltree
 * Date: 18/09/18
 * Time: 9:30
 */

namespace AVL\WAF\Http\Support;

class Config
{
    /**
     * @param $string
     * @return \Illuminate\Config\Repository|mixed
     */
    public function get($string)
    {
        return config('waf'.$string);
    }
}