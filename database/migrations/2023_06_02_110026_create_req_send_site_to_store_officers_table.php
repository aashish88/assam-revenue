<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqSendSiteToStoreOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('req_send_site_to_store_officers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('User Table Id');
            $table->string('site_id')->comment('SiteMasters Table Id');
            $table->integer('status')->comment('1->Active, 2->Deactive');
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
        Schema::dropIfExists('req_send_site_to_store_officers');
    }
}
