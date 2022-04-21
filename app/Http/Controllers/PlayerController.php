<?php

namespace App\Http\Controllers;

use App\Mail\InfoRegistro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('coach.playerRegister');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $password = Str::random(10);
        $coach = User::find(auth()->id());
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->remember_token = $request->_token;
        $user->position = $request->position;
        $user->birth_date = $request->birth_date;
        $user->team_id = $coach->team_id;

        $user->save();

        $user->assignRole("Generated Password");

        Mail::to($request->email)->send(new InfoRegistro($user, $password));

        return redirect()->route('home')->with('success','Player Created Successfully');
    }
}
