<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
  /**
   * Schema table name to migrate
   * @var string
   */
  public $set_schema_table = 'sales';

  /**
   * Run the migrations.
   * @table sales
   *
   * @return void
   */
  public function up()
  {
    if (Schema::hasTable($this->set_schema_table)) return;
    Schema::create($this->set_schema_table, function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->integer('quantity');
      $table->integer('product_id')->unsigned();
      $table->integer('seller_id')->unsigned();

      $table->index(["product_id"], 'fk_sales_products1_idx');
      $table->index(["seller_id"], 'fk_sales_sellers1_idx');
      $table->timestamps();
      $table->softDeletes();


      $table->foreign('product_id', 'fk_sales_products1_idx')
        ->references('id')->on('products')
        ->onDelete('no action')
        ->onUpdate('no action');

        $table->foreign('seller_id', 'fk_sales_sellers1_idx')
        ->references('id')->on('sellers')
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
