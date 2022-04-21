<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    /**
     * if the user is created by an admin, it will be redirected to change the password obligatory
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index( )
    {
        $user = User::find(auth()->id());

        if($user->team_id === 1 && @Auth::user()->hasRole('Coach')){
            return view('coach.teamRegister');
        }elseif($user->team_id !== 1 && @Auth::user()->hasRole('CoachTeam')){
            return redirect()->route('home');
        }else{
            return "Jugador";
        }
    }

    /**
     * if the password it's correct, the user's password will be changed
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function resetPassword(Request $request )
    {
        $user = User::find($request->id);
        if($request->password == $request->password_confirmation){
            $user->password = Hash::make($request->password);
            $user->save();

            $user->removeRole('Generated Password');

            return redirect()->route('home')->with('success','Contraseña Actualizada');
        }else{
            return "ERROR";
        }
    }

}
