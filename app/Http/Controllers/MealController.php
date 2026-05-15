<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    public function store(Request $request)
{
    Meal::create([

        'user_id' => Auth::id(),

        'food_name' => $request->food_name,

        'meal_type' => strtolower($request->meal_type),

        'calories' => $request->calories,

        'protein' => $request->protein,

        'carbs' => $request->carbs,

        'fat' => $request->fat,

        'consumed_at' => now()->toDateString(),
    ]);

    return back();
}
}