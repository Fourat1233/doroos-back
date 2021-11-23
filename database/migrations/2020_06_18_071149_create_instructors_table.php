<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('about')->nullable();
            $table->double('pricing')->nullable();
            $table->float('latitude', 10, 7);
            $table->float('longitude', 10, 7);
            $table->integer('years_of_experience')->nullable();
            $table->json('teaching_level')->nullable();
            $table->json('teaching_type')->nullable();
            $table->json('operating_hours')->nullable();
            $table->boolean('is_trusted')->default(false);
            $table->boolean('is_completed')->default(false);
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
        Schema::dropIfExists('instructors');
    }
}
