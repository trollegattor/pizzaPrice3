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
        Schema::create('pizzas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('establishment_id');
            $table->string('size')->default('Standart');
            $table->string('flavor')->nullable();
            $table->integer('weight')->nullable();
            $table->decimal('price',6,2,true);
            $table->foreign('establishment_id')
                ->references('id')
                ->on('establishment')
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
        Schema::dropIfExists('pizzas');
    }
};
