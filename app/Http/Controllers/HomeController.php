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

        return view('home')->with('players',$myPlayers);
    }
}
