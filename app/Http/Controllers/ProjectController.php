<?php

namespace App\Http\Controllers;

use App\Project;
use App\Projectdetail;
use App\Template;
use App\Templatedetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;
use function Sodium\add;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $projects = Project::orderByDesc('created_at')->get();
        return view('project.index', compact('projects'));
    }
    public function edit(Project $project){

        return view('project.edit', compact('project'));
    }

    public function create()
    {
        $templates = Template::orderBy('created_at')->get();
        return view('project.create', compact('templates'));
    }
    public function update(Request $request, Project $project){
        $this->validate($request, [
            'title' => 'required',
            'address' => 'required',
            'projectStartDate' => 'required',
            'projectEndDate' => 'required',
            'description' => 'required',
            'budget' => 'required',

        ]);

        $projectEdit = Project::find($project->id)->update([
            'title' => $request->get('title'),
            'address' => $request->get('address'),
            'startDate' => Carbon::createFromFormat('d.m.Y', $request->get('projectStartDate'))->format('Y-m-d'),
            'endDate' =>  Carbon::createFromFormat('d.m.Y', $request->get('projectEndDate'))->format('Y-m-d'),
            'description' => $request->get('description'),
            'budget' => $request->get('budget'),
            'area' => $request->get('area'),
            'floor' => $request->get('floor'),
        ]);

        return redirect()->back();
    }

    public function createOne(Request $request, Project $project = null)
    {
        //  dd(Carbon::createFromFormat('d.m.Y', $request->get('startDate'))->format('Y-m-d'));
        // dd($project, $request->all());
        $this->validate($request, [
            'title' => 'required',
            'template' => 'required',
            'address' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'description' => 'required',
            'budget' => 'required',

        ]);

        $project = Project::create([
            'title' => $request->get('title'),
            'address' => $request->get('address'),
            'startDate' => Carbon::createFromFormat('d.m.Y', $request->get('startDate'))->format('Y-m-d'),
            'endDate' =>  Carbon::createFromFormat('d.m.Y', $request->get('endDate'))->format('Y-m-d'),
            'description' => $request->get('description'),
            'budget' => $request->get('budget'),
            'area' => $request->get('area'),
            'floor' => $request->get('floor'),
        ]);

        $template = Template::whereId($request->get('template'))
            ->with('categories')
            ->first();;

        $rootCategory = $template->categories->where('templatedetail_id', 0);

        foreach ($rootCategory as $category){
           // print 'ID :'.$category->id. ' CategoryID :' .$category->templatedetail_id .' Name :'. $category->name."<br/>";

            $ustCategory = Projectdetail::create(
                [
                    'project_id' => $project->id,
                    'parent' => 0,
                    'sortorder' => $category->sort,
                    'text' => $category->name,
                    'start_date' => Carbon::now(),
                    'duration' => 5
                ]
            );

            $this->addChieldCategory($project, $category,$ustCategory->id);

        }

        return redirect()->action('ProjectController@projectCreateDetails', $project);

    }
    public function projectCreateDetails(Project $project){

         $project = Project::whereId($project->id)
             ->with('categories')
         ->first();
        // return $project->categories;
        $templates = Template::orderBy('created_at')->get();
        return view('project.createOne', compact('project','templates'));
    }
    public function projectDetailsStore(Request $request){


        $this->validate($request, [
            'template_id' => 'required',
            'category' => 'required',
        ]);

        Projectdetail::create([
            'project_id' => $request->template_id,
            'text' => $request->category,
            'parent' => 0,
            'start_date' => Carbon::now(),

        ]);

        return redirect()->back();
    }
    public function projectDetailsDelete(Projectdetail $projectdetail){
        Projectdetail::destroy($projectdetail->id);
        return redirect()->back();
    }
    //X_EDITABLE
    public function projectUpdateTitle(Request $request){

        Projectdetail::find($request->get('pk'))
            ->update(
                ['text' => $request->value]
            );

        return response()->json($request->all());

    }

    public function projectUpdateStartDate(Request $request){

        Projectdetail::find($request->get('pk'))
            ->update(
                ['start_date' => $request->value]
            );

        return response()->json($request->all());

    }
    //X_EDITABLE
    private function addChieldCategory($project,$category,$ustCategory)
    {
        $chieldCategories = Templatedetail::where('templatedetail_id', $category->id)->get();
        if ($chieldCategories->count() > 0)
        {
            foreach ($chieldCategories  as $chieldCategory)

               // print 'ID :'.$chieldCategory->id. ' CategoryID :' .$chieldCategory->templatedetail_id .' Name :'. $chieldCategory->name."<br/>";

            $birustCategory = Projectdetail::create(
                [
                    'project_id' => $project->id,
                    'parent' => $ustCategory,
                    'text' => $chieldCategory->name,
                    'sortorder' => $chieldCategory->sort
                ]
            );

            $this->addChieldCategory($project,$chieldCategory,$birustCategory->id);
        }
    }
    public function updateProject(Request $request)
    {

        $data = json_decode($request->data, true);



        foreach ($data as $key => $row){

           $detail = Projectdetail::where('id', $row)
                ->update([
                    'sortorder' => $key,
                    'parent' => 0

                ]);

            //dump($row);
            if (isset($row['children'])){
                if (count($row['children']) > 0){

                    $this->subProject($row['children'], $row['id']);
                }
            }

        }

        return response()->json($data);

    }
    function subProject($children, $parent ){

        foreach ($children as $keys => $child){

            Projectdetail::where('id', $child)
                ->update([
                    'parent' => $parent,
                    'sortorder' => $keys
                ]);
            if (isset($child['children'])){
                if(count($child['children']) > 0){
                    $this->subProject($child['children'],$child['id']);
                }
            }

        }


    }

    //AJAX

    public function projectDetail($id){

        $projectDetail = Projectdetail::find($id);

        return response()->json($projectDetail);


    }
}
