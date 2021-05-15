<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function add_notification(Request $request)
    {
        $request->validate([
            'date' => ['datetime', 'required'],
            'type_notification' => ['string', 'required']
        ]);

        $notification = new Notification();
        $notification->date = $request->date;
        $notification->type_notification = $request->type_notification;
        return $notification->save();
    }

    public function update_notification(Request $request)
    {
        $request->validate([
            'date' => ['datetime', 'required'],
            'type_notification' => ['string', 'required']
        ]);

        $notification = Notification::find($request->id);
        $notification->date = $request->date;
        $notification->type_notification = $request->type_notification;
        return $notification->save();
    }

    public function delete_notification(Request $request)
    {
        $request->validate([
            'id' => ['required', 'string']
        ]);

        $notification = Notification::find($request->id);
        $notification->deleted = 1;
        $notification->deleted_at = date('Y-m-d h:m:s');
        return $notification->save();
    }

    public function get_list()
    {
        return Notification::all()->where('deleted', '=', 0);
    }

    public function search(Request $request)
    {
        $request->validate([
            'id' => ['numeric', 'required']
        ]);

        return Notification::find($request->id);
    }
}
