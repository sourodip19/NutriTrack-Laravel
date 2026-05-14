<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <div>
    <x-input-label for="age" :value="__('Age')" />

    <x-text-input
        id="age"
        name="age"
        type="number"
        class="mt-1 block w-full"
        :value="old('age', $user->age)"
    />

    <x-input-error class="mt-2" :messages="$errors->get('age')" />
</div>

<div>
    <x-input-label for="gender" :value="__('Gender')" />

    <select
        id="gender"
        name="gender"
        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
    >
        <option value="">Select Gender</option>

        <option value="Male" @selected($user->gender == 'Male')>
            Male
        </option>

        <option value="Female" @selected($user->gender == 'Female')>
            Female
        </option>
    </select>

    <x-input-error class="mt-2" :messages="$errors->get('gender')" />
</div>

<div>
    <x-input-label for="height" :value="__('Height (cm)')" />

    <x-text-input
        id="height"
        name="height"
        type="number"
        step="0.1"
        class="mt-1 block w-full"
        :value="old('height', $user->height)"
    />

    <x-input-error class="mt-2" :messages="$errors->get('height')" />
</div>

<div>
    <x-input-label for="weight" :value="__('Weight (kg)')" />

    <x-text-input
        id="weight"
        name="weight"
        type="number"
        step="0.1"
        class="mt-1 block w-full"
        :value="old('weight', $user->weight)"
    />

    <x-input-error class="mt-2" :messages="$errors->get('weight')" />
</div>

<div>
    <x-input-label for="target_weight" :value="__('Target Weight (kg)')" />

    <x-text-input
        id="target_weight"
        name="target_weight"
        type="number"
        step="0.1"
        class="mt-1 block w-full"
        :value="old('target_weight', $user->target_weight)"
    />

    <x-input-error class="mt-2" :messages="$errors->get('target_weight')" />
</div>

<div>
    <x-input-label for="activity_level" :value="__('Activity Level')" />

    <select
        id="activity_level"
        name="activity_level"
        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
    >
        <option value="">Select Activity Level</option>

        <option value="Sedentary" @selected($user->activity_level == 'Sedentary')>
            Sedentary
        </option>

        <option value="Light" @selected($user->activity_level == 'Light')>
            Light
        </option>

        <option value="Moderate" @selected($user->activity_level == 'Moderate')>
            Moderate
        </option>

        <option value="Heavy" @selected($user->activity_level == 'Heavy')>
            Heavy
        </option>
    </select>

    <x-input-error class="mt-2" :messages="$errors->get('activity_level')" />
</div>

<div>
    <x-input-label for="goal_type" :value="__('Goal Type')" />

    <select
        id="goal_type"
        name="goal_type"
        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
    >
        <option value="">Select Goal</option>

        <option value="Weight Loss" @selected($user->goal_type == 'Weight Loss')>
            Weight Loss
        </option>

        <option value="Maintain" @selected($user->goal_type == 'Maintain')>
            Maintain
        </option>

        <option value="Weight Gain" @selected($user->goal_type == 'Weight Gain')>
            Weight Gain
        </option>
    </select>

    <x-input-error class="mt-2" :messages="$errors->get('goal_type')" />
</div>
<div>
    <x-input-label for="target_date":value="__('Target Date')" />

    <x-text-input
        id="target_date"
        name="target_date"
        type="date"
        class="mt-1 block w-full"
        :value="old('target_date', $user->target_date)"
    />

    <x-input-error class="mt-2":messages="$errors->get('target_date')" />
</div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
