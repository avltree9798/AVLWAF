<?php
/**
 * Created by PhpStorm.
 * User: avltree
 * Date: 19/09/18
 * Time: 20:32
 */

Route::post('/firewall', function (\Illuminate\Http\Request $request) {
    return response()->json([
        'success' => true
    ]);
});