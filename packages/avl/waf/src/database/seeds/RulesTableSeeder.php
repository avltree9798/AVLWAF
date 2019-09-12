<?php
/**
 * Created by PhpStorm.
 * User: avltree
 * Date: 18/09/18
 * Time: 10:29
 */

namespace AVL\WAF\Database\Seeds;

use AVL\WAF\Http\Models\Rule;
use Illuminate\Database\Seeder;
class RulesTableSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents(__DIR__ . '/rules.json');
        $filters = json_decode($json, true)['filters'];
        foreach ($filters as $filter) {
            Rule::create([
                'rule'        => $filter['rule'],
                'description' => $filter['description'],
                'impact'      => $filter['impact']
            ]);
        }
    }
}