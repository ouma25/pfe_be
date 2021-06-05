<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'user' => ['required', 'numeric'],
            'professional' => ['required', 'numeric'],
            'stars_number' => ['required', 'numeric']
        ]);

        $evaluation = Evaluation::all()->where('user', '=', $request->user)
                                        ->where('professional', '=', $request->professional)
                                        ->first();
        if($evaluation)
        {
            $evaluation->stars_number = $request->stars_number;
            return $evaluation->save();
        }
        else
        {
            return Evaluation::create([
                'user' => $request->user,
                'professional' => $request->professional,
                'stars_number' => $request->stars_number
            ]);
        }
    }

    public function get(Request $request)
    {
        $request->validate([
            'professional' => ['numeric', 'required']
        ]);

        $stars = 1;

        $evaluations = Evaluation::all()->where('professional', '=', $request->professional);

        foreach($evaluations as $eval)
        {
            $stars += $eval->stars_number;
        }

        if(sizeof($evaluations) > 0)
        {
            return $stars / sizeof($evaluations);
        }
        else
        {
            return 1;
        }
    }
}
