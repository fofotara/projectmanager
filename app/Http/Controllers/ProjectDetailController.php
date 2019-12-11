<?php

namespace App\Http\Controllers;

use App\Project;
use App\Projectdetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectDetailController extends Controller
{
    public function main($id)
    {
        $project = Project::find($id);
        return view('project.projectdetailMenu', compact('project'));
    }

    public function action($id, $actionId)
    {
        $project = Project::find($id);
        $task = $project->categories->find($actionId);
        return view('projectDetails.action', compact('project', 'task'));
    }

    public function CreateOrUpdate(Request $request)
    {

        /*
         * "id" => "2"
          "projectId" => "1"
          "text" => "Ortaklık Mevzuarı"
          "startDate" => "05.12.2019"
          "lastDate" => "10.12.2019"
          "endDate" => "01.12.2019"
         * */
        $startDate = Carbon::parse($request->startDate);
        $lasttDate = Carbon::parse($request->lastDate);
        $endtDate = Carbon::parse($request->endDate);

        $duration = $lasttDate->diffInDays($startDate); //return $startDate;


        Projectdetail::updateOrCreate([
            'id' => $request->id,

        ], [
            'text' => $request->text,
            'start_date' => $startDate,
            'duration' => $duration,
            'end_date' => $endtDate,
            'project_id' => $request->projectId

        ]);
        // dd($request->all());
        return  redirect()->back();

    }
}
