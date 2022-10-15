<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('user_id')->constrained('users');
            $table->string('description', 255)->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock_qty', false)->nullable();
            $table->decimal('cost', 10, 2)->nullable();
            $table->decimal('avg_cost', 10, 2)->nullable();
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
        Schema::drop('recipes');
    }
}
