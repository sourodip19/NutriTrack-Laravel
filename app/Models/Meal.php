<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [

        'user_id',

        'food_name',

        'meal_type',

        'calories',

        'protein',

        'carbs',

        'fat',

        'consumed_at',
    ];
}