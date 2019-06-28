<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->double('price');
            $table->integer('duration')->nullable();
            $table->text("description")->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
            
            $table->softDeletes();
            $table->timestamps();

            $table->integer("hospital_doctor_id")->unsigned();
            $table->foreign('hospital_doctor_id')->references('id')->on('hospital_doctors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('services');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
