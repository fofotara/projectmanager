<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;
use App\Link;

class GanttController extends Controller
{
    public function index($projects)
    {

        if ($projects == null) redirect('404');

        $project = Project::find($projects);

        return view('project.gantt', compact('project'));
    }

    public function get($projects)
    {
        $tasks = Project::find($projects)->categories;
        $links = new Link();

        return response()->json([
            "data" => $tasks,
            "links" => $links->all()
        ]);
    }
}
