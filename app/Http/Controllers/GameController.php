<?php

namespace App\Http\Controllers;

use App\Mail\InfoRegistro;
use App\Models\Game;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class GameController extends Controller
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

        $numPlayer = DB::table('users')
                    ->where("team_id", "=", Auth::user()->team_id)
                    ->where("position" , "!=", "Coach")
                    ->count();

        $teams = DB::table('teams')
            ->where("id", "!=", Auth::user()->team_id)
            ->get();


        return view('coach.gameRegister', ['array' => ['teams' => $teams,'players' => $players,'numPlayers' => $numPlayer]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Game
     */
    public function create(Request $request)
    {
        $players = DB::table('users')
            ->where("team_id", "=", Auth::user()->team_id)
            ->where("position" , "!=", "Coach")
            ->get();

        $game = new Game();
        $game->create();

        $gameDate = Game::all()->last();
        $gameDate->date_game = $request->date_game;
        $gameDate->save();

        $union = DB::table('union_games_teams')->insert([
            "id" => $gameDate->id,
            "game_id" =>  $gameDate->id,
            "team1_id" => Auth::user()->team_id,
            "team2_id" => $request->team2,
        ]);

        foreach ($players as $player){

            $min = "Min".$player->id;
            $pts = "Pts".$player->id;
            $reb = "Reb".$player->id;
            $ast = "Ast".$player->id;
            $rob = "Rob".$player->id;
            $tap = "Tap".$player->id;

            $statistics = DB::table('statistics')->insert([
                "min" => $request->$min,
                "pts" => $request->$pts,
                "reb" => $request->$reb,
                "ast" => $request->$ast,
                "rob" => $request->$rob,
                "tap" => $request->$tap,

                "player_id" => $player->id,
                "game_id" => $gameDate->id,
            ]);
        }

        return redirect()->route('panel.create.game')->with('success', 'Statistics Created Successfully');

    }

    public function delete(Request $request)
    {

    }
}
