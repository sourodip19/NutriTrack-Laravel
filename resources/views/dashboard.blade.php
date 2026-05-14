<x-app-layout>

    <div class="py-10">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold mb-8
                       text-gray-900 dark:text-white">

                Welcome Back,
                {{ auth()->user()->name }} 👋

            </h1>

            <!-- GRID -->

            <div class="grid grid-cols-1 md:grid-cols-2
                        lg:grid-cols-3 gap-6">

                <!-- BMI -->

                <div class="bg-white dark:bg-gray-800
                            shadow rounded-2xl p-6">

                    <h2 class="text-lg font-semibold
                               text-gray-700 dark:text-gray-200">

                        BMI

                    </h2>

                    <p class="text-4xl font-bold mt-4
                              text-green-600">

                        {{ auth()->user()->bmi ?? '--' }}

                    </p>

                    <p class="mt-2 text-sm
                              text-gray-500 dark:text-gray-400">

                        {{ auth()->user()->bmi_status ?? 'No Data' }}

                    </p>
                </div>

                <!-- Maintenance Calories -->

                <div class="bg-white dark:bg-gray-800
                            shadow rounded-2xl p-6">

                    <h2 class="text-lg font-semibold
                               text-gray-700 dark:text-gray-200">

                        Maintenance Calories

                    </h2>

                    <p class="text-4xl font-bold mt-4
                              text-blue-600">

                        {{ auth()->user()->maintenance_calories ?? '--' }}

                    </p>

                    <p class="mt-2 text-sm
                              text-gray-500 dark:text-gray-400">

                        kcal/day

                    </p>
                </div>

                <!-- Goal Calories -->

                <div class="bg-white dark:bg-gray-800
                            shadow rounded-2xl p-6">

                    <h2 class="text-lg font-semibold
                               text-gray-700 dark:text-gray-200">

                        Goal Calories

                    </h2>

                    <p class="text-4xl font-bold mt-4
                              text-red-500">

                        {{ auth()->user()->daily_calorie_goal ?? '--' }}

                    </p>

                    <p class="mt-2 text-sm
                              text-gray-500 dark:text-gray-400">

                        kcal/day

                    </p>
                </div>

                <!-- Current Weight -->

                <div class="bg-white dark:bg-gray-800
                            shadow rounded-2xl p-6">

                    <h2 class="text-lg font-semibold
                               text-gray-700 dark:text-gray-200">

                        Current Weight

                    </h2>

                    <p class="text-4xl font-bold mt-4
                              text-purple-500">

                        {{ auth()->user()->weight ?? '--' }} kg

                    </p>
                </div>

                <!-- Target Weight -->

                <div class="bg-white dark:bg-gray-800
                            shadow rounded-2xl p-6">

                    <h2 class="text-lg font-semibold
                               text-gray-700 dark:text-gray-200">

                        Target Weight

                    </h2>

                    <p class="text-4xl font-bold mt-4
                              text-yellow-500">

                        {{ auth()->user()->target_weight ?? '--' }} kg

                    </p>
                </div>

                <!-- Target Date -->

                <div class="bg-white dark:bg-gray-800
                            shadow rounded-2xl p-6">

                    <h2 class="text-lg font-semibold
                               text-gray-700 dark:text-gray-200">

                        Target Date

                    </h2>

                    <p class="text-2xl font-bold mt-4
                              text-indigo-500">

                        {{ auth()->user()->target_date ?? '--' }}

                    </p>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>