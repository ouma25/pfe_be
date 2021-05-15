<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function add_job(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['required', 'mimes:png,jpg,jpeg']
        ]);

        $job = new Job();
        $job->name = $request->name;
        $job->description = $request->description;
        $job->image = $request->image;
        return $job->save();
    }

    public function update_job(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['required', 'mimes:png,jpg,jpeg']
        ]);

        $job = Job::find($request->id);
        $job->name = $request->name;
        $job->description = $request->description;
        $job->image = $request->image;
        return $job->save();
    }

    public function delete_job(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);

        $job = Job::find($request->id);
        $job->deleted = 1;
        $job->deleted_at = date('Y-m-d h:m:s');
        return $job->save();
    }

    public function get_list()
    {
        return Job::all()->where('deleted', '=', 0);
    }

    public function search(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);

        return Job::find($request->id);
    }
}
