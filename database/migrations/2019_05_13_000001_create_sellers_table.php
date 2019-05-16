<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
  /**
   * Schema table name to migrate
   * @var string
   */
  public $set_schema_table = 'sellers';

  /**
   * Run the migrations.
   * @table sellers
   *
   * @return void
   */
  public function up()
  {
    if (Schema::hasTable($this->set_schema_table)) return;
    Schema::create($this->set_schema_table, function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->string('name', 45);
      $table->string('email', 45);
      $table->string('picture', 45)->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists($this->set_schema_table);
  }
}
