<x-app-layout>

    <div class="py-10">

        <div class="max-w-7xl mx-auto px-4">

            <!-- Heading -->

            <div class="mb-8">

                <h1 class="text-4xl font-bold
                           text-gray-900 dark:text-white">

                    Food Search 🍎

                </h1>

                <p class="mt-2 text-gray-600
                          dark:text-gray-400">

                    Search foods and explore nutrition values.

                </p>

            </div>

            <!-- Search -->

            <div class="relative mb-10">

                <input
                    id="foodInput"
                    type="text"
                    placeholder="Search food..."

                    class="w-full rounded-2xl
                           border border-gray-300
                           dark:border-gray-700

                           bg-white dark:bg-gray-800

                           text-gray-900 dark:text-white

                           px-6 py-5
                           text-lg
                           shadow-lg
                           focus:ring-2
                           focus:ring-green-500"
                >

                <!-- Suggestions -->

                <div
                    id="suggestions"

                    class="hidden absolute z-50
                           mt-2 w-full
                           rounded-xl
                           bg-white dark:bg-gray-800
                           shadow-2xl
                           overflow-hidden"
                ></div>

            </div>

            <!-- Loading -->

            <div
                id="loading"
                class="hidden flex justify-center mb-10"
            >

                <div
                    class="w-14 h-14
                           border-4 border-green-500
                           border-t-transparent
                           rounded-full
                           animate-spin"
                ></div>

            </div>

            <!-- Results -->

            <div
                id="results"

                class="grid grid-cols-1
                       md:grid-cols-2
                       lg:grid-cols-3
                       gap-8"
            ></div>

        </div>

    </div>

    <script>

        const foodInput =
            document.getElementById('foodInput');

        const results =
            document.getElementById('results');

        const loading =
            document.getElementById('loading');

        const suggestions =
            document.getElementById('suggestions');

        let timeout = null;

        /*
        --------------------------------
        Live Search
        --------------------------------
        */

        foodInput.addEventListener('input', function () {

            clearTimeout(timeout);

            const query =
                this.value.trim();

            if (query.length < 2) {

                results.innerHTML = '';

                suggestions.classList.add('hidden');

                return;
            }

            timeout = setTimeout(() => {

                searchFood(query);

            }, 300);
        });

        /*
        --------------------------------
        Search Function
        --------------------------------
        */

        async function searchFood(query) {

            loading.classList.remove('hidden');

            results.innerHTML = `

                <div class="col-span-3
                            text-center
                            text-gray-400
                            py-10">

                    Searching foods...

                </div>
            `;

            try {

                const response = await fetch('/food-search', {

                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',

                        'X-CSRF-TOKEN':
                            document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content
                    },

                    body: JSON.stringify({
                        food: query
                    })
                });

                const data = await response.json();

                loading.classList.add('hidden');

                renderFoods(data.foods);

                renderSuggestions(data.foods);

            } catch (error) {

                loading.classList.add('hidden');

                console.error(error);
            }
        }

        /*
        --------------------------------
        Render Suggestions
        --------------------------------
        */

        function renderSuggestions(foods) {

            suggestions.innerHTML = '';

            if (foods.length === 0) {
                suggestions.classList.add('hidden');
                return;
            }

            foods.slice(0, 5).forEach(food => {

                suggestions.innerHTML += `

                    <div
                        class="px-5 py-4
                               cursor-pointer
                               hover:bg-gray-100
                               dark:hover:bg-gray-700
                               text-gray-900
                               dark:text-white"

                        onclick="selectSuggestion('${food.name}')"
                    >

                        ${food.name}

                    </div>
                `;
            });

            suggestions.classList.remove('hidden');
        }

        function selectSuggestion(name) {

            foodInput.value = name;

            suggestions.classList.add('hidden');

            searchFood(name);
        }

        /*
        --------------------------------
        Render Food Cards
        --------------------------------
        */

        function renderFoods(foods) {
suggestions.classList.add('hidden');
            results.innerHTML = '';

            if (foods.length === 0) {

                results.innerHTML = `

                    <div
                        class="text-red-500
                               text-xl font-semibold"
                    >

                        No foods found.

                    </div>
                `;

                return;
            }

            foods.forEach(food => {

                results.innerHTML += `

                    <div
                        class="bg-white dark:bg-gray-800
                               rounded-3xl
                               overflow-hidden
                               shadow-2xl
                               hover:scale-[1.02]
                               transition
                               duration-300"
                    >

                    

                        <div class="p-6">

                            <h2
                                class="text-2xl font-bold
                                       text-gray-900
                                       dark:text-white"
                            >

                                ${food.name}

                            </h2>

                            <p
                                class="mt-1 text-gray-500
                                       dark:text-gray-400"
                            >

                                ${food.brand}

                            </p>

                            <div class="mt-6 space-y-3">

                                <div class="flex justify-between">

                                    <span class="text-gray-600 dark:text-gray-300">
                                        Calories
                                    </span>

                                    <span class="font-bold text-red-500">
                                        ${food.calories} kcal
                                    </span>

                                </div>

                                <div class="flex justify-between">

                                    <span class="text-gray-600 dark:text-gray-300">
                                        Protein
                                    </span>

                                    <span class="font-bold text-blue-500">
                                        ${food.protein} g
                                    </span>

                                </div>

                                <div class="flex justify-between">

                                    <span class="text-gray-600 dark:text-gray-300">
                                        Carbs
                                    </span>

                                    <span class="font-bold text-yellow-500">
                                        ${food.carbs} g
                                    </span>

                                </div>

                                <div class="flex justify-between">

                                    <span class="text-gray-600 dark:text-gray-300">
                                        Fat
                                    </span>

                                    <span class="font-bold text-green-500">
                                        ${food.fat} g
                                    </span>

                                </div>

                            </div>

                            <button

    onclick='addMeal(${JSON.stringify(food)})'

    class="mt-6 w-full

           bg-green-500
           hover:bg-green-600

           text-white

           py-3 rounded-xl

           font-semibold

           transition"

>

    + Add Meal

</button>
                        </div>

                    </div>
                `;
            });
        }
document.addEventListener('click', function (e) {

    if (
        !foodInput.contains(e.target) &&
        !suggestions.contains(e.target)
    ) {

        suggestions.classList.add('hidden');
    }
});
async function addMeal(food) {

    const mealType = prompt(

        'Enter meal type:\\nBreakfast / Lunch / Dinner / Snacks'
    );

    if (!mealType) return;

    try {

        const response = await fetch('/meals', {

            method: 'POST',

            headers: {

                'Content-Type': 'application/json',

                'X-CSRF-TOKEN':
                    document.querySelector(
                        'meta[name=\"csrf-token\"]'
                    ).content
            },

            body: JSON.stringify({

                food_name: food.name,

                meal_type: mealType,

                calories: food.calories,

                protein: food.protein,

                carbs: food.carbs,

                fat: food.fat,
            })
        });

        const data = await response.json();

        if (data.success) {

            alert('Meal Added Successfully ✅');
        }

    } catch (error) {

        console.error(error);
    }
}
    </script>

</x-app-layout>
