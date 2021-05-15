<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact_request;

class Contact_requestController extends Controller
{
    public function add_contact_request(Request $request)
    {
        $request->validate([
            'status' => ['required', 'string'],
            'message' => ['required', 'text']
        ]);

        $contact_request = new Contact_request();
        $contact_request->status = $request->status;
        $contact_request->message = $request->message;

        return $contact_request->save();
    }

    public function update_contact_request(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
            'status' => ['required', 'string'],
            'message' => ['required', 'text']
        ]);

        $contact_request = Contact_request::find($request->id);
        $contact_request->status = $request->status;
        $contact_request->message = $request->message;

        return $contact_request->save();
    }

    public function delete_contact_request(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric']
        ]);

        $contact_request = Contact_request::find($request->id);
        $contact_request->deleted = 1;
        $contact_request->deleted_at = date('Y-m-d h:m:s');

        return $contact_request->save();
    }

    public function get_list()
    {
        return Contact_request::all()->where('deleted', '=', 0);
    }

    public function search(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric']
        ]);

        return Contact_request::find($request->id);
    }
}
