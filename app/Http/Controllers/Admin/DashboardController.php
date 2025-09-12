<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $contactCount = Contact::count();
        $projectCount = Project::count();
        $skillCount = Skill::count();
        $publishedProjectCount = Project::where('status', 'published')->count();
        $recentContacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard.index', compact(
            'contactCount',
            'projectCount',
            'skillCount',
            'publishedProjectCount',
            'recentContacts'
        ));
    }
}
