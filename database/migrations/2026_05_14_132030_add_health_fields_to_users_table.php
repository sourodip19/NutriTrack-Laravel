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
    Schema::table('users', function (Blueprint $table) {

        $table->integer('age')->nullable();

        $table->string('gender')->nullable();

        $table->float('height')->nullable();

        $table->float('weight')->nullable();

        $table->float('target_weight')->nullable();

        $table->string('activity_level')->nullable();

        $table->string('goal_type')->nullable();

        $table->integer('daily_calorie_goal')->nullable();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {

        $table->dropColumn([
            'age',
            'gender',
            'height',
            'weight',
            'target_weight',
            'activity_level',
            'goal_type',
            'daily_calorie_goal'
        ]);

    });
}
};
