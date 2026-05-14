<?php

namespace App\Services;

use Carbon\Carbon;

class CalorieCalculatorService
{
    public function calculate($user)
    {
        $weight = $user->weight;
        $height = $user->height;
        $age = $user->age;

        /*
        --------------------------------
        Calculate BMR
        --------------------------------
        */

        if ($user->gender === 'Male') {

            $bmr = (10 * $weight)
                + (6.25 * $height)
                - (5 * $age)
                + 5;

        } else {

            $bmr = (10 * $weight)
                + (6.25 * $height)
                - (5 * $age)
                - 161;
        }

        /*
        --------------------------------
        Activity Multipliers
        --------------------------------
        */

        $activityFactors = [

            'Sedentary' => 1.2,

            'Light' => 1.375,

            'Moderate' => 1.55,

            'Heavy' => 1.725,
        ];

        $activityFactor =
            $activityFactors[$user->activity_level] ?? 1.2;

        /*
        --------------------------------
        Maintenance Calories (TDEE)
        --------------------------------
        */

        $maintenanceCalories =
            round($bmr * $activityFactor);

        /*
        --------------------------------
        Weight Difference
        --------------------------------
        */

        $weightDifference =
            $user->target_weight - $user->weight;

        /*
        --------------------------------
        If no target date
        --------------------------------
        */

        if (!$user->target_date) {

            return [
                'maintenance' => $maintenanceCalories,
                'goal' => $maintenanceCalories,
            ];
        }

        /*
        --------------------------------
        Days Remaining
        --------------------------------
        */

        $daysRemaining =
            Carbon::now()->diffInDays(
                Carbon::parse($user->target_date),
                false
            );

        /*
        --------------------------------
        Prevent invalid dates
        --------------------------------
        */

        if ($daysRemaining <= 0) {

            return [
                'maintenance' => $maintenanceCalories,
                'goal' => $maintenanceCalories,
            ];
        }

        /*
        --------------------------------
        Total calories needed
        1kg ≈ 7700 kcal
        --------------------------------
        */

        $totalCaloriesNeeded =
            abs($weightDifference) * 7700;

        /*
        --------------------------------
        Daily deficit/surplus
        --------------------------------
        */

        $dailyAdjustment =
            $totalCaloriesNeeded / $daysRemaining;

        /*
        --------------------------------
        Final Goal Calories
        --------------------------------
        */

        if ($weightDifference < 0) {

            $goalCalories =
                $maintenanceCalories - $dailyAdjustment;

        } else {

            $goalCalories =
                $maintenanceCalories + $dailyAdjustment;
        }
        /*
--------------------------------
BMI Calculation
--------------------------------
*/

$heightInMeters = $height / 100;

$bmi =
    $weight / ($heightInMeters * $heightInMeters);

$bmi = round($bmi, 1);

/*
--------------------------------
BMI Status
--------------------------------
*/

if ($bmi < 18.5) {

    $bmiStatus = 'Underweight';

} elseif ($bmi < 25) {

    $bmiStatus = 'Normal';

} elseif ($bmi < 30) {

    $bmiStatus = 'Overweight';

} else {

    $bmiStatus = 'Obese';
}
        return [

    'maintenance' =>
        round($maintenanceCalories),

    'goal' =>
        round($goalCalories),

    'bmi' =>
        $bmi,

    'bmi_status' =>
        $bmiStatus,
];
    }
}