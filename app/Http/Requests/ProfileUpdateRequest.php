<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'name' => ['required', 'string', 'max:255'],

        'email' => [
            'required',
            'string',
            'lowercase',
            'email',
            'max:255',
            Rule::unique(User::class)->ignore($this->user()->id),
        ],

        'age' => ['nullable', 'integer'],

        'gender' => ['nullable', 'string'],

        'height' => ['nullable', 'numeric'],

        'weight' => ['nullable', 'numeric'],

        'target_weight' => ['nullable', 'numeric'],

        'target_date' => ['nullable', 'date'],

        'activity_level' => ['nullable', 'string'],

        'goal_type' => ['nullable', 'string'],
    ];
}
}
