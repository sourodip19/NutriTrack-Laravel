<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FoodController extends Controller
{
    public function index()
    {
        return view('food.search');
    }

    public function search(Request $request)
    {
        $query = trim(strtolower($request->food));

        if (!$query) {

            return response()->json([
                'foods' => []
            ]);
        }

        $response = Http::get(
            'https://api.nal.usda.gov/fdc/v1/foods/search',
            [
                'api_key' => env('USDA_API_KEY'),

                'query' => $query,

                'pageSize' => 25,

                'dataType' => [
                    'Foundation',
                    'SR Legacy'
                ],
            ]
        );

        $foodsData =
            $response->json()['foods'] ?? [];

        $foods = [];

        foreach ($foodsData as $food) {

            $description =
                strtolower($food['description'] ?? '');

            /*
            --------------------------------
            Filter Bad Results
            --------------------------------
            */

            if (!str_contains($description, $query)) {
                continue;
            }

            $nutrients =
                $food['foodNutrients'] ?? [];

            $calories = 0;
            $protein = 0;
            $carbs = 0;
            $fat = 0;

            foreach ($nutrients as $nutrient) {

                $name =
                    $nutrient['nutrientName'] ?? '';

                $value =
                    $nutrient['value'] ?? 0;

                if ($name === 'Energy') {
                    $calories = $value;
                }

                if ($name === 'Protein') {
                    $protein = $value;
                }

                if ($name === 'Carbohydrate, by difference') {
                    $carbs = $value;
                }

                if ($name === 'Total lipid (fat)') {
                    $fat = $value;
                }
            }

            /*
            --------------------------------
            Exact Match Priority Score
            --------------------------------
            */

            $priority = 0;

            if ($description === $query) {
                $priority += 100;
            }

            if (str_starts_with($description, $query)) {
                $priority += 50;
            }

            if (str_contains($description, 'raw')) {
                $priority += 30;
            }

            if (strlen($description) < 30) {
                $priority += 20;
            }

            $foods[] = [

                'name' =>
                    ucwords($food['description'] ?? 'Unknown Food'),

                'brand' =>
                    $food['brandOwner'] ?? 'USDA',

                'image' =>
                    'https://placehold.co/600x400/png?text=' .
                    urlencode(explode(',', $food['description'])[0]),

                'calories' =>
                    round($calories),

                'protein' =>
                    round($protein, 1),

                'carbs' =>
                    round($carbs, 1),

                'fat' =>
                    round($fat, 1),

                'priority' =>
                    $priority,
            ];
        }

        /*
        --------------------------------
        Sort Best Foods First
        --------------------------------
        */

        usort($foods, function ($a, $b) {
            return $b['priority'] <=> $a['priority'];
        });

        /*
        --------------------------------
        Limit Results
        --------------------------------
        */

        $foods = array_slice($foods, 0, 9);

        return response()->json([
            'foods' => $foods
        ]);
    }
}