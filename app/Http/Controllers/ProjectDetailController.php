<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectDetailController extends Controller
{
    public function main($id){
      $project = Project::find($id);
        return view('project.projectdetailMenu', compact('project'));
    }

    public function action($id,$actionId){
        $project = Project::find($id);
        $task = $project->categories->find($actionId);
        return view('projectDetails.action',compact('project', 'task'));
    }
}
