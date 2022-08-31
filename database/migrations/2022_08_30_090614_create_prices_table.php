<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pizza_id');
            $table->unsignedInteger('pizza_property_id');
            $table->decimal('price', 6, 2, true);
            $table->foreign('pizza_id')
                ->references('id')
                ->on('pizzas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('pizza_property_id')
                ->references('id')
                ->on('pizza_properties')
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
        Schema::dropIfExists('prices');
    }
};
