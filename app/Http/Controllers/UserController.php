<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $timezones = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);

        return view('users')
            ->with('timezones', $timezones);
    }

    public function list()
    {
        // All users
        $users = User::all()->toArray();

        // Convert timezone to mine
        foreach ($users as $key => $user) {
            $users[$key]['created_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $user['created_at'], 'UTC')->setTimezone(Auth::user()->timezone)->toDateTimeString();
        }

        return response()->json($users);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'timezone' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'timezone' => $request->timezone,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['success' => true], 200);
    }

    public function get($id)
    {
        $user = User::findOrFail($id)->toArray();

        // Convert timezone to mine
        $user['created_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $user['created_at'], 'UTC')->setTimezone(Auth::user()->timezone)->toDateTimeString();

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'timezone' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'string|min:6|confirmed',
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->timezone = $request->timezone;
        $user->email = $request->email;

        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return response()->json(['success' => true], 200);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        return response()->json(['success' => true], 200);
    }

}
