<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('codes')){
			Schema::create('codes', function(Blueprint $table)
			{
				$table->increments('id');
			    $table->string('membertype');
			    $table->string('activationcode');
			    $table->unique('activationcode');
			    $table->string('sponsor');
			    $table->string('status');
			    $table->timestamps();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('codes');
	}

}
