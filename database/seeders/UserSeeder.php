<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		User::create([
			'email' => 'user@test.com',
			'name' => 'Иван',
			'lastname' => 'Иванов',
			'password' => Hash::make('user')
		]);
		User::create([
			'email' => 'manager@test.com',
			'name' => 'Михаил',
			'lastname' => 'Сидоров',
			'password' => Hash::make('manager')
		]);
		User::create([
			'email' => 'leader@test.com',
			'name' => 'Василий',
			'lastname' => 'Петров',
			'password' => Hash::make('leader'),
			'leader' => true
		]);
    }
}
