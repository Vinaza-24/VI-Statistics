<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $comprobacion = DB::table('statistics')->select('*')->where('player_id', "=", $user->id)->count();


        if($user->team_id === 1 && @Auth::user()->hasRole('Coach')){
            return view('coach.teamRegister');
        }elseif($user->team_id !== 1 && @Auth::user()->hasRole('CoachTeam')){
            return redirect()->route('home');
        }elseif(@Auth::user()->hasRole('Generated Password')){
            return view('reset')->with('user', $user);
        }else{
            if($comprobacion != 0){
                $medias = DB::table('statistics')
                    ->select(DB::raw('AVG(min) as minutos, AVG(pts) as puntos, AVG(reb) as rebotes, AVG(ast) as asistencias, AVG(rob) as robo, AVG(tap) as tapones'))
                    ->where('player_id', '=', $user->id)
                    ->get();
                return view('home')->with(['avg' => $medias[0],'noAVG' => 0]);
            }else{
                return view('home')->with(['noAVG' => 1]);
            }
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
            $user->assignRole("Player");
            $comprobacion = DB::table('statistics')->select('*')->where('player_id', "=", $user->id)->count();

            if($comprobacion != 0){
                $medias = DB::table('statistics')
                    ->select(DB::raw('AVG(min) as minutos, AVG(pts) as puntos, AVG(reb) as rebotes, AVG(ast) as asistencias, AVG(rob) as robo, AVG(tap) as tapones'))
                    ->where('player_id', '=', $user->id)
                    ->get();
                return view('home')->with(['avg' => $medias[0],'noAVG' => 0]);
            }else{
                return view('home')->with(['noAVG' => 1]);
            }
        }else{
            return "ERROR";
        }
    }

}
