<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('contect_no')->nullable()->comment('user mobile no 10 digit only.');
            $table->string('user_type')->comment('1->Admin, 2->Officer, 3->Vendor, 4->Engineer');
            $table->string('address');
            $table->enum('user_role_type', array('1', '2','3'))->comment('1->Admin, 2->View, 3->Update');
            $table->string('status')->comment('1->Active, 2->Deactive, 3->Deleted');
            $table->rememberToken();
            $table->string('created_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('users');
    }
}
