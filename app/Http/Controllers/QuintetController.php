<?php

namespace App\Http\Controllers;

use App\Mail\InfoRegistro;
use App\Models\Quintet;
use App\Models\User;
use Couchbase\QueryIndex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class QuintetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $players = DB::table('users')
                    ->where("team_id", "=", Auth::user()->team_id)
                    ->where("position" , "!=", "Coach")
                    ->get();
        $numPlayers = DB::table('users')
                    ->where("team_id", "=", Auth::user()->team_id)
                    ->where("position" , "!=", "Coach")
                    ->count();

        return view('coach.quintetRegister', ['players' => $players, 'numPlayers'=> $numPlayers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(Request $request)
    {
            $coach = User::find(auth()->id());

            $quintet = new Quintet();
            $quintet->name = $request->name_quintet;
            $quintet->team_id = $coach->team_id;
            $quintet->save();



        $formedQuintetteams = DB::table('formed_quintet_teams')->insert([
            "quintet_id" =>  $quintet->id,
            "player1_id" => $request->player1,
            "player2_id" => $request->player2,
            "player3_id" => $request->player3,
            "player4_id" => $request->player4,
            "player5_id" => $request->player5,
        ]);

            return $quintet;
    }

    public function delete(Request $request)
    {

    }
}
