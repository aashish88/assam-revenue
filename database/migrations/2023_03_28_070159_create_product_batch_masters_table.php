<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBatchMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_batch_masters', function (Blueprint $table) {
            $table->id();
            $table->string('item_title');
            $table->string('item');
            $table->string('qty');
            $table->string('uom');
            $table->string('oem');
            $table->string('batch_id');
            $table->string('site_id');
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
        Schema::dropIfExists('product_batch_masters');
    }
}
