<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVSAllocatedToESTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_s_allocated_to_e_s', function (Blueprint $table) {
            $table->id();
            $table->string('site_id');
            $table->string('user_id');
            $table->string('status')->comment('1->Active, 2->Deactive, 3->Other');
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
        Schema::dropIfExists('v_s_allocated_to_e_s');
    }
}
