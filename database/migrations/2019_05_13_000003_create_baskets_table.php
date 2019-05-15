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
      $table->increments('product_id');
      $table->integer('sale_id');

      $table->index(["product_id"], 'fk_products_has_sales_products_idx');

      $table->index(["sale_id"], 'fk_products_has_sales_sales1_idx');


      $table->foreign('product_id', 'fk_products_has_sales_products_idx')
        ->references('id')->on('products')
        ->onDelete('no action')
        ->onUpdate('no action');

      $table->foreign('sale_id', 'fk_products_has_sales_sales1_idx')
        ->references('id')->on('sales')
        ->onDelete('no action')
        ->onUpdate('no action');
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
