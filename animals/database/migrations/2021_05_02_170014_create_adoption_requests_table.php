<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptionRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adoption_requests', function (Blueprint $table) {
            $table->id();
			
			$table->bigInteger('animal')->unsigned();
			$table->foreign('animal')->references('id')->on('animals'); // animal
			
			$table->bigInteger('requester')->unsigned();
			$table->foreign('requester')->references('id')->on('users'); // owner (requester)
			
			$table->string('status', 20);// status (approved, denied, undecided)
			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adoption_requests');
    }
}
