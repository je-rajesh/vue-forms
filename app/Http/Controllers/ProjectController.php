<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function create()
    {
        return view('welcome', ['projects' => Project::all()]);
    }

    public function store(Request $request)
    {
        $data  = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $project = Project::forceCreate($data);
        return ['message' => 'Project Created', 'data' => $project];
    }
}
