<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// make table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
			$table->boolean('staff')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
		
		// insert an example staff member
		DB::table('users')->insert(
			array(
				'name' => "Staff1",
				'email' => 'staff1@astonanimals.com',
				'password' => '$2y$10$ubep7ER5mIVM/EJKcHlmTe6vwfYsPkn.Kbihiy1BT/xsK8ZDBVLw6', // aaaaaaaa
				'staff' => True
			)
		);
		// insert a fake user member
		DB::table('users')->insert(
			array(
				'name' => "User1",
				'email' => 'user1@astonanimals.com',
				'password' => '$2y$10$ubep7ER5mIVM/EJKcHlmTe6vwfYsPkn.Kbihiy1BT/xsK8ZDBVLw6', // aaaaaaaa
				'staff' => False
			)
		);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
