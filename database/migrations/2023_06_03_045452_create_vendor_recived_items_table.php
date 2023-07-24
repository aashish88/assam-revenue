<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorRecivedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_recived_items', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->string('site_id');
            $table->string('recived_date');
            $table->integer('login_id');
            $table->ipAddress('visitor');
            $table->macAddress('device');
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
        Schema::dropIfExists('vendor_recived_items');
    }
}
