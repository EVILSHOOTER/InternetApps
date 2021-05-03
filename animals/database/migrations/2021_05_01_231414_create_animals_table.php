<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
			
			$table->string('name', 20);
			$table->enum('type',['dog', 'cat', 'fish', 'snake'])->default('dog');
			$table->date('date_of_birth')->nullable();
			$table->string('description', 256)->nullable();
			$table->string('image', 256)->nullable();
			$table->string('availability')->default('Available');
			
			
			$table->bigInteger('owner')->unsigned()->nullable(); // null as a default value
			$table->foreign('owner')->references('id')->on('users'); // foreign key (animal owned by owner)
			
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
        Schema::dropIfExists('animals');
    }
}
