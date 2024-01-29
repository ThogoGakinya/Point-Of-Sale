<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('uom_id')->nullable();
            $table->string('category_id')->nullable();
            $table->integer('instock')->nullable();
            $table->string('size_id')->nullable();
            $table->integer('regular_price')->nullable();
            $table->integer('price_level2')->nullable();
            $table->integer('price_level3')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('reorder_qty')->nullable();
            $table->integer('base_stock')->nullable();
            $table->string('image_name')->nullable();
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
        Schema::dropIfExists('inventories');
    }
}
