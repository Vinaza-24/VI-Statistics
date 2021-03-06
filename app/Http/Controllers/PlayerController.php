<?php

namespace App\Http\Controllers;

use App\Mail\InfoRegistro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Seld\JsonLint\JsonParser;

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
        $id = Auth::user()->team_id;

        $players = DB::table('users')
            ->select( 'users.*')
            ->where('users.team_id','like',''. $id .'')
            ->count();

        if($players === 13){
            return redirect()->route('home')->with('danger', 'Player Not Created, You have the maximum number of players');
        }else {
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

            return redirect()->route('home')->with('success', 'Player Created Successfully');
        }
    }

    public function delete(Request $request)
    {
        $player = User::find($request->id);
        $player->team_id = 1;
        $player->save();

        return redirect()->route('home')->with('success', 'Player Delete Successfully');
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function myData()
    {
        return view('user.userPanel');
    }

    public function myDataModify(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->birth_date = $request->birth_date;

        $user->save();

        return redirect()->route('panel.myData')->with('success', 'Modified Data Successfully');
    }



    public function watchPlayer($id_player){

        $player = User::find($id_player);


        $comprobacion = DB::table('statistics')->select('*')->where('player_id', "=", $id_player)->count();

        if($comprobacion != 0){

            $medias = DB::table('statistics')
                ->select(DB::raw('AVG(min) as minutos, AVG(pts) as puntos, AVG(reb) as rebotes, AVG(ast) as asistencias, AVG(rob) as robo, AVG(tap) as tapones'))
                ->where('player_id', '=', $id_player)
                ->get();

            $games = DB::table('statistics')
                ->select('*')
                ->where('player_id', '=', $id_player)
                ->groupBy('player_id')
                ->count();


            return view('coach.watchPlayer')->with(['noAVG' => 0, 'player' => $player, 'games' => $games, 'avg' => $medias[0]] );
        }else{
            return view('coach.watchPlayer')->with(['noAVG' => 1, 'player' => $player, 'games' => 0]);
        }
    }

    public function watchPlayerNoTeam(){

        $myPlayers = DB::table('users')
            ->select( 'users.*')
            ->where('users.team_id','like','1')
            ->get();

        return view('coach.playerPool')->with('players',$myPlayers);
    }

    public function watchPlayerHire($id_player){

        $player = User::find($id_player);
        $team_id = Auth::user()->team_id;

        $players = DB::table('users')
            ->select( 'users.*')
            ->where('users.team_id','like',''. $team_id .'')
            ->count();

        if($players === 13){
            return redirect()->route('panel.player.pool')->with('danger', 'Player Not Hire, You have the maximum number of players');
        }else {
            $player->team_id = $team_id;
            $player->save();

            return redirect()->route('home')->with('success', 'Player Hire Successfully');
        }
    }

    public function watchTeam(){

            $medias = DB::table('users')
                ->select(DB::raw('users.name, AVG(statistics.min) as minutos, AVG(statistics.pts) as puntos, AVG(statistics.reb) as rebotes, AVG(statistics.ast) as asistencias, AVG(statistics.rob) as robo, AVG(statistics.tap) as tapones'))
                ->leftJoin('statistics', 'statistics.player_id', '=', 'users.id')
                ->where('users.position', '!=', 'Coach')
                ->where('users.team_id', '=', Auth::user()->team_id)
                ->groupBy('users.id')
                ->get();

        return view('user.watchTeam')->with(['avg' => $medias]);
    }

    //select users.name, AVG(statistics.min) as minutos, AVG(statistics.pts) as puntos, AVG(statistics.reb) as rebotes, AVG(statistics.ast) as asistencias, AVG(statistics.rob) as robo, AVG(statistics.tap) as tapones from `users` LEFT JOIN statistics ON users.id = statistics.id GROUP BY users.name;

}
