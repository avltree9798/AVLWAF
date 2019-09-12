<?php
/**
 * Created by PhpStorm.
 * User: avltree
 * Date: 19/09/18
 * Time: 19:30
 */

namespace AVL\WAF\Database\Seeds;

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'          => 'Anthony Viriya, CEH, CSCU',
            'email'         => 'anthony@avlitsolution.com',
            'password'      => bcrypt('leonie'),
            'client_secret' => '34534nigi34543',
            'client_key'    => 'leonieandanthonycelamalamanyah'
        ]);

        User::create([
            'name'     => 'Leonie Madeleine Tirtamulia, S.Kom',
            'email'    => 'sdhleonie9a17@gmail.com',
            'password' => bcrypt('leonie')
        ]);
    }
}