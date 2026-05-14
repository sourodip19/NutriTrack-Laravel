<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meals', function (Blueprint $table) {
           $table->id();

$table->foreignId('user_id')
      ->constrained()
      ->onDelete('cascade');

$table->string('food_name');

$table->string('meal_type');

$table->integer('calories');

$table->float('protein');

$table->float('carbs');

$table->float('fat');

$table->date('consumed_at');

$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
