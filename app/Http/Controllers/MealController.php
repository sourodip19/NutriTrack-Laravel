<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function store(Request $request)
    {
        Meal::create([

            'user_id' => auth()->id(),

            'food_name' => $request->food_name,

            'meal_type' => $request->meal_type,

            'calories' => $request->calories,

            'protein' => $request->protein,

            'carbs' => $request->carbs,

            'fat' => $request->fat,

            'consumed_at' => now()->toDateString(),
        ]);

        return response()->json([

            'success' => true
        ]);
    }
}