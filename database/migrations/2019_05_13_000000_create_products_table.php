<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
  /**
   * Schema table name to migrate
   * @var string
   */
  public $set_schema_table = 'products';

  /**
   * Run the migrations.
   * @table products
   *
   * @return void
   */
  public function up()
  {
    if (Schema::hasTable($this->set_schema_table)) return;
    Schema::create($this->set_schema_table, function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->string('name', 80);
      $table->string('description', 200);
      $table->integer('quantity');
      $table->decimal('price', 6, 2);
      $table->string('picture', 120);
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
