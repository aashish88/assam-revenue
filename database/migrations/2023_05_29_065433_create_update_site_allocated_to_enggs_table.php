<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateSiteAllocatedToEnggsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_site_allocated_to_enggs', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('login_id');
            $table->string('work_activity');
            $table->string('s_date');
            $table->string('e_date');
            $table->string('status');
            $table->string('remark');
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
        Schema::dropIfExists('update_site_allocated_to_enggs');
    }
}
