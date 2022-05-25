<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $id = Auth::user()->team_id;

        $myPlayers = DB::table('users')
            ->select( 'users.*')
            ->where('users.team_id','like',''. $id .'')
            ->get();

        $comprobacion = DB::table('statistics')->select('*')->where('player_id', "=", Auth::user()->id)->count();
        if($comprobacion != 0){
            $medias = DB::table('statistics')
                ->select(DB::raw('AVG(min) as minutos, AVG(pts) as puntos, AVG(reb) as rebotes, AVG(ast) as asistencias, AVG(rob) as robo, AVG(tap) as tapones'))
                ->where('player_id', '=', Auth::user()->id)
                ->get();
            return view('home')->with(['avg' => $medias[0],'noAVG' => 0, 'players'=> $myPlayers]);
        }else{
            return view('home')->with(['noAVG' => 1,'players'=> $myPlayers]);
        }
    }
}
