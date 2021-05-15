<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function add_service(Request $request)
    {
        $request->validate([
            'name' => ['string', 'required'],
            'type' => ['string', 'required'],
            'description' => ['string', 'required']
        ]);

        $service = new Service();
        $service->name = $request->name;
        $service->type = $request->type;
        $service->description = $request->description;

        return $service->save();
    }

    public function update_service(Request $request)
    {
        $request->validate([
            'id' => ['string', 'required'],
            'name' => ['string', 'required'],
            'type' => ['string', 'required'],
            'description' => ['string', 'required']
        ]);

        $service = Service::all()->where('id', '=', $request->id);
        $service->name = $request->name;
        $service->type = $request->type;
        $service->description = $request->description;

        return $service->save();
    }

    public function delete_service(Request $request)
    {
        $request->validate([
            'id' => ['numeric', 'required']
        ]);

        $service = Service::all()->find($request->id);
        $service->deleted = 1;
        $service->deleted_at = date('Y-m-d h:m:s');

        return $service->save();
    }

    public function get_list()
    {
        return Service::all()->where('deleted', '=', 0);
    }

    public function search(Request $request)
    {
        $request->validate([
            'id' => ['string', 'required']
        ]);

        return Service::all()->find($request->id);
    }
}
