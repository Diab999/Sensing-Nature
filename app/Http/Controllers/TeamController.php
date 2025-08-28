<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Traits\HasLocaleHandling;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    use HasLocaleHandling;

    public function index(Request $request)
    {
        $this->setLocaleFromRequest($request);
        
        $teamMembers = TeamMember::paginate(12);
        return view('team.index', compact('teamMembers'));
    }
}
