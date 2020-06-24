<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run() {
        DB::table('roles')->insert([[
            'slug'			=> 'admin',
            'name'			=> 'admin',
            'created_at'	=> date('Y-m-d H:i:s'),
            'updated_at'	=> date('Y-m-d H:i:s'),
        ],
        [
            'slug'			=> 'member',
            'name'			=> 'member',
            'created_at'	=> date('Y-m-d H:i:s'),
            'updated_at'	=> date('Y-m-d H:i:s'),
        ]]);
    }
}
