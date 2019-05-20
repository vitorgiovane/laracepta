<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketsTable extends Migration
{
  /**
   * Schema table name to migrate
   * @var string
   */
  public $set_schema_table = 'baskets';

  /**
   * Run the migrations.
   * @table baskets
   *
   * @return void
   */
  public function up()
  {
    if (Schema::hasTable($this->set_schema_table)) return;
    Schema::create($this->set_schema_table, function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->integer('product_id')->unsigned();
      $table->integer('sale_id')->unsigned();
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
    Schema::dropIfExists($this->set_schema_table);
  }
}
