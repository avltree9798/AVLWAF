<?php
/**
 * Created by PhpStorm.
 * User: avltree
 * Date: 18/09/18
 * Time: 9:24
 */

namespace AVL\WAF\Http\Support;

use Illuminate\Http\Response;

class Responder
{
    /**
     * @param array $response
     * @param array $data
     * @return array|\Illuminate\Http\Response
     */
    public function respond($response = [], $data = [])
    {
        if ($response['code'] === 200) {
            return;
        }
        /**
         * @var \Illuminate\Http\Response $response
         */
        $response = Response::create($response['message'], $response['code']);

        return $response;
    }
}