<x-app-layout>

    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4">

            <!-- Header -->

            <div
                class="flex flex-col
                       lg:flex-row
                       lg:items-center
                       lg:justify-between
                       gap-6
                       mb-8"
            >

                <div>

                    <h1
                        class="
                            text-4xl
                            font-bold
                            text-gray-900 dark:text-white
                        "
                    >

                        Nutrition Logs 📚

                    </h1>

                    <p
                        class="
                            mt-2
                            text-gray-600
                            dark:text-gray-400
                        "
                    >

                        View your nutrition and body progress history.

                    </p>

                </div>

                <!-- Date Picker -->

                <form
                    method="GET"
                    action="/logs"
                >

                    <input
                        type="date"

                        name="date"

                        value="{{ $selectedDate }}"

                        onchange="this.form.submit()"

                        class="
                            px-5 py-3
                            rounded-2xl
                            bg-white dark:bg-gray-800
                            dark:text-white
                            border border-gray-300
                            dark:border-gray-700
                            shadow-lg
                        "
                    >

                </form>

            </div>

            <!-- Analytics Cards -->

            <div
                class="
                    grid grid-cols-1
                    sm:grid-cols-2
                    xl:grid-cols-5
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

                    <p class="text-gray-400">

                        Calories

                    </p>

                    <h2
                        class="
                            mt-4
                            text-3xl
                            font-bold
                            text-red-500
                        "
                    >

                        {{ round($totalCalories) }}

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

                    <p class="text-gray-400">

                        Protein

                    </p>

                    <h2
                        class="
                            mt-4
                            text-3xl
                            font-bold
                            text-blue-500
                        "
                    >

                        {{ round($totalProtein, 1) }}g

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

                    <p class="text-gray-400">

                        Carbs

                    </p>

                    <h2
                        class="
                            mt-4
                            text-3xl
                            font-bold
                            text-yellow-500
                        "
                    >

                        {{ round($totalCarbs, 1) }}g

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

                    <p class="text-gray-400">

                        Fat

                    </p>

                    <h2
                        class="
                            mt-4
                            text-3xl
                            font-bold
                            text-green-500
                        "
                    >

                        {{ round($totalFat, 1) }}g

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

                    <p class="text-gray-400">

                        Weight

                    </p>

                    <h2
                        class="
                            mt-4
                            text-3xl
                            font-bold
                            text-purple-500
                        "
                    >

                        {{ $weight ?? '--' }}

                    </h2>

                </div>

            </div>

            <!-- Meals -->

            <div
                class="
                    bg-white dark:bg-gray-800
                    rounded-3xl
                    shadow-xl
                    p-6
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

                        Meal History 🍽️

                    </h2>

                    <p
                        class="
                            mt-2
                            text-gray-500
                            dark:text-gray-400
                        "
                    >

                        Meals consumed on
                        {{ $selectedDate }}

                    </p>

                </div>

                @forelse($meals as $meal)

                    <div
                        class="
                            flex flex-col
                            lg:flex-row
                            lg:items-center
                            lg:justify-between
                            gap-4
                            py-5
                            border-b
                            border-gray-200
                            dark:border-gray-700
                        "
                    >

                        <div>

                            <h3
                                class="
                                    text-lg
                                    font-semibold
                                    text-gray-900
                                    dark:text-white
                                "
                            >

                                {{ $meal->food_name }}

                            </h3>

                            <div
                                class="
                                    flex flex-wrap
                                    gap-4
                                    mt-2
                                    text-sm
                                    text-gray-500
                                "
                            >

                                <span>

                                    Protein:
                                    {{ $meal->protein }}g

                                </span>

                                <span>

                                    Carbs:
                                    {{ $meal->carbs }}g

                                </span>

                                <span>

                                    Fat:
                                    {{ $meal->fat }}g

                                </span>

                            </div>

                        </div>

                        <div
                            class="
                                text-xl
                                font-bold
                                text-red-500
                            "
                        >

                            {{ $meal->calories }}
                            kcal

                        </div>

                    </div>

                @empty

                    <div
                        class="
                            py-12
                            text-center
                            text-gray-400
                        "
                    >

                        No meals found for this date.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>