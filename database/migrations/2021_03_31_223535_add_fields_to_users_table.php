<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname');
			$table->boolean('leader')->default(false);
        });
		
		Schema::create('vacations', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
			$table->boolean('approved')->nullable();
			$table->timestamps();
		});
		
		User::create([
				'email' => 'user@test.com',
				'name' => 'Иван',
				'lastname' => 'Иванов',
				'password' => Hash::make('user')
		]);
		User::create([
			'email' => 'leader@test.com',
			'name' => 'Василий',
			'lastname' => 'Петров',
			'password' => Hash::make('leader'),
			'leader' => true
		]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
