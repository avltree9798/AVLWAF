<?php

use AVL\WAF\Database\Seeds\RulesTableSeeder;
use AVL\WAF\Database\Seeds\UsersTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
        $this->call(RulesTableSeeder::class);
    }
}
