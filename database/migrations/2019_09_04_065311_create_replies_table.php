<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('replies', function (Blueprint $table) {
			$table->Increments('id');
			$table->string('body');
			$table->unsignedInteger('post_id')->index();
			$table->unsignedInteger('user_id')->index();
			$table->boolean('bestAnswer')->default('0');
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
		Schema::dropIfExists('replies');
	}
}
