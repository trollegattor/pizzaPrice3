<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizza_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cafe_id');
            $table->string('size')->default('Standart');
            $table->string('flavor')->nullable();
            $table->foreign('cafe_id')
                ->references('id')
                ->on('cafes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizza_properties');
    }
};
