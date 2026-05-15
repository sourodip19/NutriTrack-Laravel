
<x-app-layout>

    @php

        $user = auth()->user();

       $height =
    $user->height ?? 0;

$weight =
    $currentWeight
    ?? $user->weight
    ?? 0;

$heightInMeters =
    $height > 0
    ? $height / 100
    : 0;

$bmi =
    $heightInMeters > 0
    ? $weight / ($heightInMeters * $heightInMeters)
    : 0;

        $caloriesPercentage =
            $targetCalories > 0
            ? min(($totalCalories / $targetCalories) * 100, 100)
            : 0;

        $proteinPercentage =
            $targetProtein > 0
            ? min(($totalProtein / $targetProtein) * 100, 100)
            : 0;

        $carbsPercentage =
            $targetCarbs > 0
            ? min(($totalCarbs / $targetCarbs) * 100, 100)
            : 0;

        $fatPercentage =
            $targetFat > 0
            ? min(($totalFat / $targetFat) * 100, 100)
            : 0;

        $mealSections = [

            [
                'title' => 'Breakfast',
                'emoji' => '🍳',
                'meals' => $breakfastMeals,
                'empty' => 'No breakfast meals added.',
            ],

            [
                'title' => 'Lunch',
                'emoji' => '🍛',
                'meals' => $lunchMeals,
                'empty' => 'No lunch meals added.',
            ],

            [
                'title' => 'Dinner',
                'emoji' => '🍽️',
                'meals' => $dinnerMeals,
                'empty' => 'No dinner meals added.',
            ],

            [
                'title' => 'Snacks',
                'emoji' => '🍪',
                'meals' => $snackMeals,
                'empty' => 'No snacks added.',
            ],
        ];

        $macroCards = [

            [
                'title' => 'Calories',
                'value' => round($totalCalories),
                'goal' => round($targetCalories),
                'unit' => '',
                'percentage' => round($caloriesPercentage),
                'color' => 'red',
            ],

            [
                'title' => 'Protein',
                'value' => round($totalProtein, 1),
                'goal' => round($targetProtein),
                'unit' => 'g',
                'percentage' => round($proteinPercentage),
                'color' => 'blue',
            ],

            [
                'title' => 'Carbs',
                'value' => round($totalCarbs, 1),
                'goal' => round($targetCarbs),
                'unit' => 'g',
                'percentage' => round($carbsPercentage),
                'color' => 'yellow',
            ],

            [
                'title' => 'Fat',
                'value' => round($totalFat, 1),
                'goal' => round($targetFat),
                'unit' => 'g',
                'percentage' => round($fatPercentage),
                'color' => 'green',
            ],
        ];

    @endphp

    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->

            <div class="mb-8">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <div>

                        <h1
                            class="
                                text-4xl
                                font-bold
                                text-gray-900 dark:text-white
                            "
                        >

                            Today's Nutrition Dashboard 📊

                        </h1>

                        <p
                            class="
                                mt-2
                                text-gray-600 dark:text-gray-400
                            "
                        >

                            Track meals, body metrics, nutrition progress and fitness goals.

                        </p>

                    </div>

                    <!-- Quick Actions -->

                    <div class="flex flex-wrap gap-3">

                        <a
                            href="/food-search"

                            class="
                                px-5 py-3
                                bg-green-500 hover:bg-green-600
                                text-white
                                rounded-2xl
                                font-semibold
                                shadow-lg
                                transition
                            "
                        >

                            🔍 Search Food

                        </a>

                        <button
                            onclick="document.getElementById('manualMeal').scrollIntoView({ behavior: 'smooth' })"

                            class="
                                px-5 py-3
                                bg-blue-500 hover:bg-blue-600
                                text-white
                                rounded-2xl
                                font-semibold
                                shadow-lg
                                transition
                            "
                        >

                            🍽️ Add Meal

                        </button>

                        <button
                            onclick="document.getElementById('weightTracker').scrollIntoView({ behavior: 'smooth' })"

                            class="
                                px-5 py-3
                                bg-purple-500 hover:bg-purple-600
                                text-white
                                rounded-2xl
                                font-semibold
                                shadow-lg
                                transition
                            "
                        >

                            ⚖️ Log Weight

                        </button>
<a
    href="/logs"

    class="
        px-5 py-3
        bg-orange-500 hover:bg-orange-600
        text-white
        rounded-2xl
        font-semibold
        shadow-lg
        transition
    "
>

    📚 Logs

</a>
                    </div>

                </div>

            </div>

            <!-- Hero Summary -->

            <div
                class="
                    bg-white dark:bg-gray-800
                    rounded-3xl
                    shadow-2xl
                    p-8
                    mb-8
                "
            >

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                    <div>

                        <p class="text-gray-500 dark:text-gray-400 text-lg">

                            Daily Calories

                        </p>

                        <h2
                            class="
                                mt-3
                                text-5xl
                                font-bold
                                text-gray-900 dark:text-white
                            "
                        >

                            {{ round($totalCalories) }}

                            <span class="text-2xl text-gray-400">

                                / {{ round($targetCalories) }} kcal

                            </span>

                        </h2>

                        <div
                            class="
                                mt-6
                                w-full lg:w-[500px]
                                h-4
                                bg-gray-200 dark:bg-gray-700
                                rounded-full
                                overflow-hidden
                            "
                        >

                            <div
                                class="
                                    h-full
                                    bg-gradient-to-r
                                    from-red-500 to-orange-400
                                    rounded-full
                                "

                                style="width: {{ $caloriesPercentage }}%;"
                            ></div>

                        </div>

                    </div>

                    <div
                        class="
                            flex items-center justify-center
                            w-40 h-40
                            rounded-full
                            border-[12px]
                            border-red-500
                            text-center
                        "
                    >

                        <div>

                            <p class="text-4xl font-bold text-red-500">

                                {{ round($caloriesPercentage) }}%

                            </p>

                            <p class="text-gray-400 text-sm mt-1">

                                completed

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Macro Cards -->

            <div
                class="
                    grid grid-cols-1
                    sm:grid-cols-2
                    xl:grid-cols-4
                    gap-5
                    mb-8
                "
            >

                @foreach($macroCards as $card)

                    <div
                        class="
                            bg-white dark:bg-gray-800
                            rounded-2xl
                            shadow-xl
                            p-6
                        "
                    >

                        <div class="flex justify-between items-start">

                            <div>

                                <p class="text-gray-500 dark:text-gray-400">

                                    {{ $card['title'] }}

                                </p>

                                <h3
                                    class="
                                        mt-4
                                        text-4xl
                                        font-bold
                                        text-{{ $card['color'] }}-500
                                    "
                                >

                                    {{ $card['value'] }}{{ $card['unit'] }}

                                </h3>

                                <p class="text-gray-400 mt-1">

                                    Goal: {{ $card['goal'] }}{{ $card['unit'] }}

                                </p>

                            </div>

                            <div
                                class="
                                    text-{{ $card['color'] }}-500
                                    font-bold
                                    text-lg
                                "
                            >

                                {{ $card['percentage'] }}%

                            </div>

                        </div>

                        <div
                            class="
                                mt-6
                                h-3
                                bg-gray-200 dark:bg-gray-700
                                rounded-full
                                overflow-hidden
                            "
                        >

                            <div
                                class="
                                    h-full
                                    bg-{{ $card['color'] }}-500
                                    rounded-full
                                "

                                style="width: {{ $card['percentage'] }}%;"
                            ></div>

                        </div>

                    </div>

                @endforeach

            </div>

            <!-- Body Metrics -->

            <div
                class="
                    grid grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-3
                    gap-5
                    mb-8
                "
            >

                <div
                    class="
                        bg-white dark:bg-gray-800
                        rounded-2xl
                        shadow-xl
                        p-6
                    "
                >

                    <p class="text-gray-500 dark:text-gray-400">

                        Current Weight

                    </p>

                    <h2 class="mt-4 text-4xl font-bold text-blue-500">

                        {{ $currentWeight ?? $user->weight ?? '--' }}

                        <span class="text-xl">

                            kg

                        </span>

                    </h2>

                </div>

                <div
                    class="
                        bg-white dark:bg-gray-800
                        rounded-2xl
                        shadow-xl
                        p-6
                    "
                >

                    <p class="text-gray-500 dark:text-gray-400">

                        Height

                    </p>

                    <h2 class="mt-4 text-4xl font-bold text-green-500">

                        {{ $user->height ?? '--' }}

                        <span class="text-xl">

                            cm

                        </span>

                    </h2>

                </div>

                <div
                    class="
                        bg-white dark:bg-gray-800
                        rounded-2xl
                        shadow-xl
                        p-6
                    "
                >

                   @php

    $bmiStatus = 'Unknown';

    $bmiColor = 'text-gray-400';

    if ($bmi > 0 && $bmi < 18.5) {

        $bmiStatus = 'Underweight';

        $bmiColor = 'text-yellow-500';
    }

    elseif ($bmi >= 18.5 && $bmi < 25) {

        $bmiStatus = 'Normal';

        $bmiColor = 'text-green-500';
    }

    elseif ($bmi >= 25 && $bmi < 30) {

        $bmiStatus = 'Overweight';

        $bmiColor = 'text-orange-500';
    }

    elseif ($bmi >= 30) {

        $bmiStatus = 'Obese';

        $bmiColor = 'text-red-500';
    }

@endphp

<p class="text-gray-500 dark:text-gray-400">

    BMI Score

</p>

<div class="mt-4 flex items-end gap-3">

    <h2
        class="
            text-5xl
            font-bold
            text-purple-500
            leading-none
        "
    >

        {{ round($bmi, 1) }}

    </h2>

    <span
        class="
            mb-1
            text-xl
            font-semibold
            {{ $bmiColor }}
        "
    >

        {{ $bmiStatus }}

    </span>

</div>

                </div>

            </div>

            <!-- Insights -->

            <div
                class="
                    grid grid-cols-1
                    md:grid-cols-2
                    xl:grid-cols-4
                    gap-5
                    mb-8
                "
            >

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">

                    <p class="text-gray-400 text-sm">

                        Avg Daily Calories

                    </p>

                    <h2 class="text-3xl font-bold text-red-500 mt-3">

                        {{ round(collect($calorieData)->avg()) }}

                    </h2>

                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">

                    <p class="text-gray-400 text-sm">

                        Weight Trend

                    </p>

                    <h2 class="text-3xl font-bold text-blue-500 mt-3">

                        {{ $weightData[count($weightData) - 1] ?? $currentWeight }} kg

                    </h2>

                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">

                    <p class="text-gray-400 text-sm">

                        Protein Completion

                    </p>

                    <h2 class="text-3xl font-bold text-green-500 mt-3">

                        {{ round($proteinPercentage) }}%

                    </h2>

                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">

                    <p class="text-gray-400 text-sm">

                        Weekly Streak

                    </p>

                    <h2 class="text-3xl font-bold text-yellow-500 mt-3">

                        {{ count(array_filter($calorieData)) }} Days

                    </h2>

                </div>

            </div>

            <!-- Weight Logger -->

            <div
                id="weightTracker"

                class="
                    bg-white dark:bg-gray-800
                    rounded-3xl
                    shadow-xl
                    p-6
                    mb-8
                "
            >

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <div>

                        <h2
                            class="
                                text-2xl
                                font-bold
                                text-gray-900 dark:text-white
                            "
                        >

                            Log Today's Weight ⚖️

                        </h2>

                        <p class="text-gray-500 dark:text-gray-400 mt-2">

                            Keep track of your body progress.

                        </p>

                    </div>

                    <form
                        action="/weight-log"
                        method="POST"

                        class="
                            flex flex-col sm:flex-row
                            gap-4
                            w-full lg:w-auto
                        "
                    >

                        @csrf

                        <input
                            type="number"
                            step="0.1"
                            name="weight"
                            placeholder="Today's weight"
                            required

                            class="
                                px-5 py-3
                                rounded-2xl
                                bg-gray-100 dark:bg-gray-700
                                text-gray-900 dark:text-white
                                border-0
                                focus:ring-2
                                focus:ring-purple-500
                            "
                        >

                        <button
                            type="submit"

                            class="
                                px-6 py-3
                                bg-purple-500 hover:bg-purple-600
                                text-white
                                rounded-2xl
                                font-semibold
                                transition
                            "
                        >

                            Save Weight

                        </button>

                    </form>

                </div>

            </div>

            <!-- Manual Meal Entry -->

            <div
                id="manualMeal"

                class="
                    bg-white dark:bg-gray-800
                    rounded-3xl
                    shadow-xl
                    p-6
                    mb-8
                "
            >

                <div class="mb-6">

                    <h2
                        class="
                            text-2xl
                            font-bold
                            text-gray-900 dark:text-white
                        "
                    >

                        Add Custom Meal 🍽️

                    </h2>

                    <p class="text-gray-500 dark:text-gray-400 mt-2">

                        Add meals manually if you already know the nutrition values.

                    </p>

                </div>

                <form
                    action="/manual-meal"
                    method="POST"

                    class="
                        grid grid-cols-1
                        md:grid-cols-2
                        xl:grid-cols-6
                        gap-4
                    "
                >

                    @csrf

                    <input
                        type="text"
                        name="food_name"
                        placeholder="Food Name"
                        required

                        class="dashboard-input xl:col-span-2"
                    >

                    <input
                        type="number"
                        name="calories"
                        placeholder="Calories"
                        required

                        class="dashboard-input"
                    >

                    <input
                        type="number"
                        step="0.1"
                        name="protein"
                        placeholder="Protein"
                        required

                        class="dashboard-input"
                    >

                    <input
                        type="number"
                        step="0.1"
                        name="carbs"
                        placeholder="Carbs"
                        required

                        class="dashboard-input"
                    >

                    <input
                        type="number"
                        step="0.1"
                        name="fat"
                        placeholder="Fat"
                        required

                        class="dashboard-input"
                    >

                    <select
                        name="meal_type"

                        class="dashboard-input"
                    >

                        <option value="breakfast">

                            Breakfast

                        </option>

                        <option value="lunch">

                            Lunch

                        </option>

                        <option value="dinner">

                            Dinner

                        </option>

                        <option value="snack">

                            Snack

                        </option>

                    </select>

                    <button
                        type="submit"

                        class="
                            xl:col-span-6
                            py-4
                            bg-green-500 hover:bg-green-600
                            text-white
                            rounded-2xl
                            font-bold
                            transition
                        "
                    >

                        Add Meal

                    </button>

                </form>

            </div>

            <!-- Meal Sections -->

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                @foreach($mealSections as $section)

                    <div
                        class="
                            bg-white dark:bg-gray-800
                            rounded-3xl
                            shadow-xl
                            p-6
                        "
                    >

                        <div class="flex items-center justify-between mb-6">

                            <h2
                                class="
                                    text-2xl
                                    font-bold
                                    text-gray-900 dark:text-white
                                "
                            >

                                {{ $section['title'] }} {{ $section['emoji'] }}

                            </h2>

                            <span class="text-gray-400 text-sm">

                                {{ $section['meals']->count() }} meals

                            </span>

                        </div>

                        @forelse($section['meals'] as $meal)

                            <div
                                class="
                                    flex items-center justify-between
                                    gap-4
                                    py-4
                                    border-b
                                    border-gray-200 dark:border-gray-700
                                "
                            >

                                <div>

                                    <h3
                                        class="
                                            font-semibold
                                            text-gray-900 dark:text-white
                                        "
                                    >

                                        {{ $meal->food_name }}

                                    </h3>

                                    <div
                                        class="
                                            flex flex-wrap gap-3
                                            mt-2
                                            text-sm
                                            text-gray-500
                                        "
                                    >

                                        <span>

                                            Protein: {{ $meal->protein }}g

                                        </span>

                                        <span>

                                            Carbs: {{ $meal->carbs }}g

                                        </span>

                                        <span>

                                            Fat: {{ $meal->fat }}g

                                        </span>

                                    </div>

                                </div>

                                <div
                                    class="
                                        text-right
                                        text-red-500
                                        font-bold
                                    "
                                >

                                    {{ $meal->calories }} kcal

                                </div>

                            </div>

                        @empty

                            <p class="text-gray-400">

                                {{ $section['empty'] }}

                            </p>

                        @endforelse

                    </div>

                @endforeach

            </div>

        </div>

    </div>

    <style>

        .dashboard-input {
            @apply rounded-2xl bg-gray-100 dark:bg-gray-700 dark:text-white border-0 px-5 py-3 focus:ring-2 focus:ring-green-500;
        }

    </style>

</x-app-layout>
