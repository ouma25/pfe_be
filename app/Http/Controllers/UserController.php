<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Professional;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function add_user(Request $request)
    {
        $request->validate([
            'first_name' => ['string', 'required'],
            'last_name' => ['string', 'required'],
            'city' => ['string', 'required'],
            'email' => ['email', 'required'],
            'phone' => ['string', 'required'],
            'password' => ['string', 'required', 'min:8', 'max:32'],
            'type' => ['string', 'required']
        ]);

        switch(strtolower($request->type))
        {
            case 'client': {

                $user = new User();
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->city = $request->city;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->password = Hash::make($request->password);
                $user->type = 'client';

                break;
            }

            case 'professional': {

                $request->validate([
                    'birthdate' => ['date', 'required'],
                    'job_title' => ['string', 'required'],
                    'image' => ['required', 'url'],
                    'image_cin' => ['required', 'url'],
                    'service' => ['required', 'numeric']
                ]);

                $user = new User();
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->city = $request->city;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->image = $request->image;
                $user->image_cin = $request->image_cin;
                $user->birthdate = $request->birthdate;
                $user->job_title = $request->job_title;
                $user->image = $request->image;
                $user->password = Hash::make($request->password);
                $user->type = 'professional';
                $user->service = $request->service;

                break;
            }

            default:
                break;
        }

        return $user->save();
    }

    public function update_user(Request $request)
    {
        $request->validate([
            'id' => ['numeric', 'required'],
            'first_name' => ['string', 'required'],
            'last_name' => ['string', 'required'],
            'city' => ['string', 'required'],
            'email' => ['email', 'required'],
            'phone' => ['string', 'required'],
            'type' => ['string', 'required']
        ]);

        $user = User::all()->find($request->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->city = $request->city;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->type = $request->type;

        return $user->save();
    }

    public function delete_user(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $user = User::all()->find($request->id);
        $user->deleted = 1;
        $user->deleted_at = date('Y-m-d h:m:s');

        return $user->save();
    }

    public function get_list()
    {
        return User::all()->where('deleted', '=', 0);
    }

    public function search(Request $request)
    {
        $request->validate([
            'id' => ['numeric', 'required']
        ]);

        return User::all()->find($request->id);
    }

    // Admin functions
    public function validate_user(Request $request)
    {
        $request->validate([
            'id' => ['numeric', 'required']
        ]);

        return User::all()->find($request->id);
    }

    public function get_professionals()
    {
        return User::all()->where('deleted', '=', 0)->where('active', '=', 1)->where('type', '=', 'professional');
    }

    public function get_clients()
    {
        return User::all()->where('deleted', '=', 0)->where('active', '=', 1)->where('type', '=', 'client');
    }

    public function get_details(Request $request)
    {
        return User::all()->where('id', '=', $request->id)->first();
    }

    public function upload_image(Request $request)
    {
        $file_name = md5("image123" . rand(1, 9999)) . ".".$request->image->extension();

        $request->image->storeAs('public/images', $file_name);

        return $file_name;
    }

    public function forgot_password(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $user = User::all()->where('email', '=', $request->email)->first();

        if($user)
        {
            $user->password = '$2y$10$6BzZUJBOgzQdbSk40eM5D./MLrgSm7mLcpmVuoph5Rv.YxnBnT2/G'; // 123456789
            $user->save();

            // Send confirmation email to the user
        }
        else
        {
            throw ValidationException::withMessages([
                'email' => ['The email is not found!'],
            ]);
        }

        return response(['message' => 'success']);
    }

    public function get_details_email(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        return User::all()->where('email', '=', $request->email)->first();
    }

    public function filter_professionals(Request $request)
    {
        if(isset($request->city) && $request->city != "")
        {
            return User::all()->where('type', '=', 'professional')
                                ->where('deleted', '=', 0)
                                ->where('city', '=', $request->city);
        }
        else if(isset($request->service) && $request->service != -1)
        {
            return User::all()->where('type', '=', 'professional')
                ->where('deleted', '=', 0)
                ->where('service', '=', $request->service);
        }
        else
        {
            return User::all()->where('deleted', '=', 0);
        }
    }
}
