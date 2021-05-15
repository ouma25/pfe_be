<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    public function add_evaluation(Request $request)
    {
        $request->validate([
            'stars_number' => ['numeric', 'required'],
            'comment' => ['string', 'required'],
            'flags_number' => ['numeric', 'required']
        ]);

        $evaluation = new Evaluation();
        $evaluation->stars_number = $request->stars_number;
        $evaluation->comment = $request->comment;
        $evaluation->flags_number = $request->flags_number;

        return $evaluation->save();
    }

    public function update_evaluation(Request $request)
    {
        $request->validate([
            'id' => ['numeric', 'required'],
            'stars_number' => ['numeric', 'required'],
            'comment' => ['string', 'required'],
            'flags_number' => ['numeric', 'required']
        ]);

        $evaluation = Evaluation::find($request->id);
        $evaluation->stars_number = $request->stars_number;
        $evaluation->comment = $request->comment;
        $evaluation->flags_number = $request->flags_number;

        return $evaluation->save();
    }

    public function delete_evaluation(Request $request)
    {
        $request->validate([
            'id' => ['numeric', 'required']
        ]);

        $evaluation = Evaluation::find($request->id);
        $evaluation->deleted = 1;
        $evaluation->deleted_at = date('Y-m-d h:m:s');
        return $evaluation->save();
    }

    public function get_list()
    {
        return Evaluation::all()->where('delete', '=', 0);
    }

    public function search(Request $request)
    {
        $request->validate([
            'id' => ['numeric', 'required']
        ]);

        return Evaluation::find($request->id);
    }
}
