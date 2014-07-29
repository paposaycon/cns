<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodesUserLimitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('codes_user_limit'))
		{
			Schema::create('codes_user_limit', function(Blueprint $table)
			{
				$table->increments('ref');
				$table->integer('id')->unsigned();
				$table->integer('count');
				$table->integer('allocated_by')->unsigned();
				$table->foreign('id')->references('id')->on('users');
			    $table->foreign('allocated_by')->references('id')->on('users');
				$table->timestamps();
			});
		}

		Schema::table('codes_user_limit', function($table)
		{
			$table->increments('ref');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('codes_user_limit');
	}

}
