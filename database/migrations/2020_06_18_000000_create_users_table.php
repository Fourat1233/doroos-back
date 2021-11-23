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
            $table->bigIncrements('id');
            $table->string('full_name', 100);
            $table->string('contact_point')->unique();
            $table->string('encrypted_password', 60);
            $table->string('profile_image')->default('default.png')->nullable();
            $table->string('phone_cell')->nullable();
            $table->enum('gender', ['Male', 'Female']);
            $table->morphs('userable');
            $table->index('userable_id');
            $table->index('userable_type');
            $table->timestamp('verified_at')->nullable();
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
