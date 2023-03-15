<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $breadcrumbs = [
            ['route' => '', 'name' => 'Dashboard'],
        ];
        $teams = DB::table('teams')
        ->select('id', 'name')
        ->selectRaw("(CASE WHEN (SELECT COUNT(*) FROM team_mapping AS mapping WHERE mapping.teamId = teams.id > 0) THEN (SELECT COUNT(*) FROM team_mapping AS mapping WHERE mapping.teamId = teams.id) ELSE 0 END) as people")
        ->whereRaw('teams.deleted_at IS NULL')
        ->orderBy('name', 'asc')
        ->get();
        return view('home', [
            'title' => 'Dashboard',
            'breadcrumbs' => $breadcrumbs,
            'teams' => $teams
        ]);
    }
}
