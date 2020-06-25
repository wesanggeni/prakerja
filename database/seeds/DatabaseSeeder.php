<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
		public function run() {
				DB::table('roles')->insert([[
						'slug'      => 'admin',
						'name'      => 'admin',
						'created_at'  => date('Y-m-d H:i:s'),
						'updated_at'  => date('Y-m-d H:i:s'),
				],
				[
						'slug'      => 'member',
						'name'      => 'member',
						'created_at'  => date('Y-m-d H:i:s'),
						'updated_at'  => date('Y-m-d H:i:s'),
				]]);
				
				DB::table('users')->insert([
				[
						'name'          => 'Tester One',
						'first_name'    => 'Tester',
						'last_name'			=> 'One',
						'email'         => 'tester1@gmail.com',
						'password'      => '$2y$10$R4M9iPcUtNzklvgy/e.FxON/bWtnX/4egDX1wYRolnBkXTSkHAD.i',
						'avatar_lg'     => 'img/1/avatar-lg.jpg',
						'avatar_md'     => 'img/1/avatar-md.jpg',
						'avatar_sm'     => 'img/1/avatar-sm.jpg',
						'created_at'    => date('Y-m-d H:i:s'),
						'updated_at'    => date('Y-m-d H:i:s'),
				],
				[
						'name'          => 'Tester Two',
						'first_name'    => 'Tester',
						'last_name'			=> 'Two',
						'email'         => 'tester2@gmail.com',
						'password'      => '$2y$10$R4M9iPcUtNzklvgy/e.FxON/bWtnX/4egDX1wYRolnBkXTSkHAD.i',
						'avatar_lg'     => 'img/2/avatar-lg.jpg',
						'avatar_md'     => 'img/2/avatar-md.jpg',
						'avatar_sm'     => 'img/2/avatar-sm.jpg',
						'created_at'    => date('Y-m-d H:i:s'),
						'updated_at'    => date('Y-m-d H:i:s'),
				],
				[
						'name'          => 'Tester Three',
						'first_name'    => 'Tester',
						'last_name'			=> 'Three',
						'email'         => 'tester3@gmail.com',
						'password'      => '$2y$10$R4M9iPcUtNzklvgy/e.FxON/bWtnX/4egDX1wYRolnBkXTSkHAD.i',
						'avatar_lg'     => 'img/3/avatar-lg.jpg',
						'avatar_md'     => 'img/3/avatar-md.jpg',
						'avatar_sm'     => 'img/3/avatar-sm.jpg',
						'created_at'    => date('Y-m-d H:i:s'),
						'updated_at'    => date('Y-m-d H:i:s'),
				],
				[
						'name'          => 'Tester Four',
						'first_name'    => 'Tester',
						'last_name'			=> 'Four',
						'email'         => 'tester4@gmail.com',
						'password'      => '$2y$10$R4M9iPcUtNzklvgy/e.FxON/bWtnX/4egDX1wYRolnBkXTSkHAD.i',
						'avatar_lg'     => 'img/4/avatar-lg.jpg',
						'avatar_md'     => 'img/4/avatar-md.jpg',
						'avatar_sm'     => 'img/4/avatar-sm.jpg',
						'created_at'    => date('Y-m-d H:i:s'),
						'updated_at'    => date('Y-m-d H:i:s'),
				]
		]);

				DB::table('role_users')->insert([
				[
						'user_id'       => 1,
						'role_id'       => 2,
						'created_at'    => date('Y-m-d H:i:s'),
						'updated_at'    => date('Y-m-d H:i:s'),
				],
				[
						'user_id'       => 2,
						'role_id'       => 2,
						'created_at'    => date('Y-m-d H:i:s'),
						'updated_at'    => date('Y-m-d H:i:s'),
				],
				[
						'user_id'       => 3,
						'role_id'       => 2,
						'created_at'    => date('Y-m-d H:i:s'),
						'updated_at'    => date('Y-m-d H:i:s'),
				],
				[
						'user_id'       => 4,
						'role_id'       => 2,
						'created_at'    => date('Y-m-d H:i:s'),
						'updated_at'    => date('Y-m-d H:i:s'),
				],
				]);


				DB::table('activations')->insert([
				[
						'user_id'       => 1,
						'code'          => 'Z3nH8LegVcwszew4NiwpRbDsfHn5O8Pr',
						'completed'     => 1,
						'completed_at'  => date('Y-m-d H:i:s'),
						'created_at'    => date('Y-m-d H:i:s'),
						'updated_at'    => date('Y-m-d H:i:s'),
				],
				[
						'user_id'       => 2,
						'code'          => 'S0o2iI9Eeoq0ROI7wa8HXice3w89ZcCU',
						'completed'     => 1,
						'completed_at'  => date('Y-m-d H:i:s'),
						'created_at'    => date('Y-m-d H:i:s'),
						'updated_at'    => date('Y-m-d H:i:s'),
				],
				[
						'user_id'       => 3,
						'code'          => 'AVnuN8KZrQOUzywP0WuZF0O0ofwNJrEx',
						'completed'     => 1,
						'completed_at'  => date('Y-m-d H:i:s'),
						'created_at'    => date('Y-m-d H:i:s'),
						'updated_at'    => date('Y-m-d H:i:s'),
				],
				[
						'user_id'       => 4,
						'code'          => 'uN38I1L7EzypbzRUNjNGNdBFq12nzx5P',
						'completed'     => 1,
						'completed_at'  => date('Y-m-d H:i:s'),
						'created_at'    => date('Y-m-d H:i:s'),
						'updated_at'    => date('Y-m-d H:i:s'),
				],
				]);

		}
}
