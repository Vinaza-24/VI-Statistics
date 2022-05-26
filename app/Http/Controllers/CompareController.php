<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $id = Auth::user()->team_id;

        $myPlayers = DB::table('users')
            ->select( 'users.id as id', 'users.name as name')
            ->join('statistics', 'statistics.player_id', '=', 'users.id')
            ->groupBy('users.id')
            ->get();

        return view('coach.comparePlayer')->with(['players'=> $myPlayers]);
    }

    public function compare(Request $request)
    {
        $player1 = User::find($request->player1);
        $player2 = User::find($request->player2);

        $comprobacionP1 = DB::table('statistics')->select('*')->where('player_id', "=", $player1->id)->count();
        $comprobacionP2 = DB::table('statistics')->select('*')->where('player_id', "=", $player2->id)->count();

        if($comprobacionP1 != 0 && $comprobacionP2 != 0){

            $mediasP1 = DB::table('statistics')
                ->select(DB::raw('AVG(min) as minutos, AVG(pts) as puntos, AVG(reb) as rebotes, AVG(ast) as asistencias, AVG(rob) as robo, AVG(tap) as tapones'))
                ->where('player_id', '=', $player1->id)
                ->get();

            $mediasP2 = DB::table('statistics')
                ->select(DB::raw('AVG(min) as minutos, AVG(pts) as puntos, AVG(reb) as rebotes, AVG(ast) as asistencias, AVG(rob) as robo, AVG(tap) as tapones'))
                ->where('player_id', '=', $player2->id)
                ->get();


            return view('coach.compareStatistics')->with(['namePlayer1' => $player1->name, 'namePlayer2' => $player2->name, 'noAVG' => 1, 'mediaPlayer1' => $mediasP1[0], 'mediaPlayer2' => $mediasP2[0] ]);
        }
    }
}
