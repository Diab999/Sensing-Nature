<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Portfolio;
use App\Models\ContactInfo;
use App\Traits\HasLocaleHandling;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use HasLocaleHandling;

    public function index(Request $request)
    {
        $this->setLocaleFromRequest($request);
        
        // Get only featured projects (max 3) for home page
        $projects = Project::featured()->latest()->take(3)->get();
        
        $portfolios = Portfolio::latest()->take(6)->get();
        $services = Service::all();
        $teamMembers = TeamMember::all();
        $contactInfos = ContactInfo::active()->ordered()->get();
        
        return view('index', compact('projects', 'portfolios', 'services', 'teamMembers', 'contactInfos'));
    }
} 