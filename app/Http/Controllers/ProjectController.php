<?php

namespace App\Http\Controllers;

use App\Project;
use App\Projectdetail;
use App\Template;
use App\Templatedetail;
use Illuminate\Http\Request;
use function Sodium\add;

class ProjectController extends Controller
{
    public function index()
    {

        return;

    }

    public function create()
    {
        $templates = Template::orderBy('created_at')->get();
        return view('project.create', compact('templates'));
    }

    public function createOne(Request $request, Project $project = null)
    {

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
            'startDate' => $request->get('startDate'),
            'endDate' => $request->get('endDate'),
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
                    'projectdetail_id' => 0,
                    'sort' => $category->sort,
                    'name' => $category->name
                ]
            );

            $this->addChieldCategory($project, $category,$ustCategory->id);

        }

        return view('project.createOne', compact('project'));

    }

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
                    'projectdetail_id' => $ustCategory,
                    'name' => $chieldCategory->name,
                    'sort' => $chieldCategory->sort
                ]
            );

            $this->addChieldCategory($project,$chieldCategory,$birustCategory->id);
        }
    }
    public function updateProject(Request $request)
    {

        $data = json_decode($request->data, true);



        foreach ($data as $key => $row){

            Projectdetail::where('id', $row)
                ->update([
                    'sort' => $key,
                    'projectdetail_id' => 0

                ]);

            //dump($row);
            if (isset($row['children'])){
                if (count($row['children']) > 0){

                    $this->subProject($row['children'], $row['id']);
                }
            }

        }

    }
    function subProject($children, $parent ){

        foreach ($children as $keys => $child){

            Projectdetail::where('id', $child)
                ->update([
                    'projectdetail_id' => $parent,
                    'sort' => $keys
                ]);
            if (isset($child['children'])){
                if(count($child['children']) > 0){
                    $this->subProject($child['children'],$child['id']);
                }
            }

        }


    }
}
