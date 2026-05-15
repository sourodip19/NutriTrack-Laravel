<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightLog;
use Carbon\Carbon;
class DashboardController extends Controller
{
  public function index()
{
    $user = Auth::user();

    /*
    --------------------------------
    Today's Meals
    --------------------------------
    */

    $breakfastMeals = Meal::where(
        'user_id',
        $user->id
    )

    ->whereDate(
        'consumed_at',
        now()->toDateString()
    )

    ->where(
        'meal_type',
        'breakfast'
    )

    ->get();

    $lunchMeals = Meal::where(
        'user_id',
        $user->id
    )

    ->whereDate(
        'consumed_at',
        now()->toDateString()
    )

    ->where(
        'meal_type',
        'lunch'
    )

    ->get();

    $dinnerMeals = Meal::where(
        'user_id',
        $user->id
    )

    ->whereDate(
        'consumed_at',
        now()->toDateString()
    )

    ->where(
        'meal_type',
        'dinner'
    )

    ->get();

    $snackMeals = Meal::where(
        'user_id',
        $user->id
    )

    ->whereDate(
        'consumed_at',
        now()->toDateString()
    )

    ->where(
        'meal_type',
        'snack'
    )

    ->get();

    /*
    --------------------------------
    Nutrition Totals
    --------------------------------
    */

    $allMeals = Meal::where(
        'user_id',
        $user->id
    )

    ->whereDate(
        'consumed_at',
        now()->toDateString()
    )

    ->get();

    $totalCalories =
        $allMeals->sum('calories');

    $totalProtein =
        $allMeals->sum('protein');

    $totalCarbs =
        $allMeals->sum('carbs');

    $totalFat =
        $allMeals->sum('fat');

    /*
    --------------------------------
    Targets
    --------------------------------
    */

    $targetCalories =
        $user->daily_calorie_goal ?? 0;

    $targetProtein =
        round($user->weight * 1.8);

    $targetCarbs =
        round($targetCalories * 0.50 / 4);

    $targetFat =
        round($targetCalories * 0.25 / 9);

    /*
    --------------------------------
    Weight
    --------------------------------
    */

    $currentWeight = WeightLog::where(
        'user_id',
        $user->id
    )

    ->latest('logged_at')

    ->value('weight');

    /*
    --------------------------------
    Weekly Analytics
    --------------------------------
    */

    $dates = [];

    $calorieData = [];

    $weightData = [];

    for ($i = 6; $i >= 0; $i--) {

        $date =
            Carbon::now()->subDays($i);

        $dates[] =
            $date->format('M d');

        $dailyCalories = Meal::where(
            'user_id',
            $user->id
        )

        ->whereDate(
            'consumed_at',
            $date->toDateString()
        )

        ->sum('calories');

        $calorieData[] =
            round($dailyCalories);

        $dailyWeight = WeightLog::where(
            'user_id',
            $user->id
        )

        ->whereDate(
            'logged_at',
            $date->toDateString()
        )

        ->latest('logged_at')

        ->value('weight');

        $weightData[] =
            $dailyWeight ?? 0;
    }

    return view('dashboard', [

        'totalCalories' => $totalCalories,

        'totalProtein' => $totalProtein,

        'totalCarbs' => $totalCarbs,

        'totalFat' => $totalFat,

        'targetCalories' => $targetCalories,

        'targetProtein' => $targetProtein,

        'targetCarbs' => $targetCarbs,

        'targetFat' => $targetFat,

        'breakfastMeals' => $breakfastMeals,

        'lunchMeals' => $lunchMeals,

        'dinnerMeals' => $dinnerMeals,

        'snackMeals' => $snackMeals,

        'dates' => $dates,

        'calorieData' => $calorieData,

        'weightData' => $weightData,

        'currentWeight' =>
            $currentWeight ?? $user->weight,
    ]);
}
}