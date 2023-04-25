<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_masters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('item_id');
            $table->bigInteger('batch_id');
            $table->text('site_id');
            $table->text('sdate');
            $table->text('edate');
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
        Schema::dropIfExists('site_masters');
    }
}
