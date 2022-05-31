<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('coach.teamRegister');
    }

    public function create(Request $request)
    {
        $teamRep = DB::table('teams')
            ->where("name", "=", $request->name)
            ->count();
        
        if($teamRep === 0) {
            $team = new Team();
            $team->name = $request->name;
            $team->trophies = $request->trophies;
            $team->save();

            $user = User::find(auth()->id());

            $user->team_id = $team->id;
            $user->save();

            $user->removeRole('Coach');
            $user->assignRole(['CoachTeam']);

            return redirect()->route('home')->with('success', 'Team Created Successfully');
        }else{
            return redirect()->route('panel.create.team')->with('danger', 'There is already a team with that name');
        }
    }
}
