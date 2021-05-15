<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function add_experience(Request $request)
    {
        $request->validate([
            'start_date' => ['date', 'required'],
            'end_date' => ['date', 'required'],
            'title' => ['string', 'required'],
            'type' => ['string', 'required'],
            'description' => ['text', 'required'],
            'place' => ['string', 'required']
        ]);

        $experience = new Experience();
        $experience->start_date = $request->start_date;
        $experience->end_date = $request->end_date;
        $experience->title = $request->title;
        $experience->type = $request->type;
        $experience->description = $request->description;
        $experience->place = $request->place;

        return $experience->save();
    }

    public function update_experience(Request $request)
    {
        $request->validate([
            'id' => ['numeric', 'required'],
            'start_date' => ['date', 'required'],
            'end_date' => ['date', 'required'],
            'title' => ['string', 'required'],
            'type' => ['string', 'required'],
            'description' => ['text', 'required'],
            'place' => ['string', 'required']
        ]);

        $experience = Experience::find($request->id);
        $experience->start_date = $request->start_date;
        $experience->end_date = $request->end_date;
        $experience->title = $request->title;
        $experience->type = $request->type;
        $experience->description = $request->description;
        $experience->place = $request->place;

        return $experience->save();
    }

    public function delete_experience(Request $request)
    {
        $request->validate([
            'id' => ['numeric', 'required']
        ]);

        $experience = Experience::find($request->id);
        $experience->deleted = 1;
        $experience->deleted_at = date('Y-m-d h:m:s');

        return $experience->save();
    }

    public function get_list()
    {
        return Experience::all()->where('deleted', '=', 0);
    }

    public function search(Request $request)
    {
        $request->validate([
            'id' => ['numeric', 'required']
        ]);

        return Experience::find($request->id);
    }
}
