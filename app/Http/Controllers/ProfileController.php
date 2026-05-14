<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Services\CalorieCalculatorService;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(
    ProfileUpdateRequest $request,
    CalorieCalculatorService $calculator
): RedirectResponse {

    $user = $request->user();

    $user->fill($request->validated());

    /*
    --------------------------------
    Calculate Daily Calories
    --------------------------------
    */

    if (
        $user->age &&
        $user->gender &&
        $user->height &&
        $user->weight &&
        $user->activity_level &&
        $user->goal_type
    ) {

    $calories = $calculator->calculate($user);

$user->maintenance_calories =
    $calories['maintenance'];

$user->daily_calorie_goal =
    $calories['goal'];

    $user->bmi =
    $calories['bmi'];

$user->bmi_status =
    $calories['bmi_status'];
    }

    /*
    --------------------------------
    Email Verification Reset
    --------------------------------
    */

    if ($user->isDirty('email')) {

        $user->email_verified_at = null;
    }

    $user->save();

    return Redirect::route('profile.edit')
        ->with('status', 'profile-updated');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
