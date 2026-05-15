<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\WeightLog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogsController extends Controller
{
    public function index(Request $request)
    {
        /*
        --------------------------------
        Selected Date
        --------------------------------
        */

        $selectedDate =
            $request->date
            ?? now()->toDateString();

        /*
        --------------------------------
        Meals
        --------------------------------
        */

        $meals = Meal::where(

            'user_id',
            Auth::id()

        )

        ->whereDate(
            'consumed_at',
            $selectedDate
        )

        ->latest()

        ->get();

        /*
        --------------------------------
        Nutrition Totals
        --------------------------------
        */

        $totalCalories =
            $meals->sum('calories');

        $totalProtein =
            $meals->sum('protein');

        $totalCarbs =
            $meals->sum('carbs');

        $totalFat =
            $meals->sum('fat');

        /*
        --------------------------------
        Weight
        --------------------------------
        */

        $weight = WeightLog::where(

            'user_id',
            Auth::id()

        )

        ->whereDate(
            'logged_at',
            $selectedDate
        )

        ->latest('logged_at')

        ->value('weight');

        return view('logs.index', [

            'selectedDate' => $selectedDate,

            'meals' => $meals,

            'totalCalories' => $totalCalories,

            'totalProtein' => $totalProtein,

            'totalCarbs' => $totalCarbs,

            'totalFat' => $totalFat,

            'weight' => $weight,
        ]);
    }
}