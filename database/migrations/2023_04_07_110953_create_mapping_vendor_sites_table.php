<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingVendorSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapping_vendor_sites', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name');
            $table->string('site_id');
            $table->string('date');
            $table->string('end_date');
            $table->integer('created_by');
            $table->text('priority');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapping_vendor_sites');
    }
}
