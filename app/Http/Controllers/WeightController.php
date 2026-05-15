<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeightController extends Controller
{
    public function store(Request $request)
    {
        WeightLog::create([

            'user_id' => Auth::id(),

            'weight' => $request->weight,

            'logged_at' => now()->toDateString(),
        ]);

        return back();
    }
}