<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingVendorItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapping_vendor_items', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment("This is Vendor Id");
            $table->string('site_id');
            $table->string('item_id');
            $table->string('serial_id');
            $table->string('qty');
            $table->integer('status');
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
        Schema::dropIfExists('mapping_vendor_items');
    }
}
