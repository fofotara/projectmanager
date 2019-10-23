<?php

namespace App\Http\Controllers;

use App\Template;
use App\Templatedetail;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Template $template = null)
    {
        $selectTemplates = null;
        $templates = Template::orderBy('created_at')->get();
        if ($template != null) {
            $selectTemplates = Template::where('id', $template->id)->firstOrFail();
        }

        // return $selectTemplates->categories;

        return view('template.index', compact('templates', 'selectTemplates'));
    }

    public function updateTemplate(Request $request)
    {

        $data = json_decode($request->data, true);


        foreach ($data as $key => $row){

            Templatedetail::where('id', $row)
                ->update([
                    'sort' => $key,
                    'templatedetail_id' => 0

                ]);

            //dump($row);
            if (isset($row['children'])){
                if (count($row['children']) > 0){

                    $this->subTemplate($row['children'], $row['id']);
                }
            }

        }

    }

    function subTemplate($children, $parent ){

        foreach ($children as $keys => $child){

            Templatedetail::where('id', $child)
                ->update([
                    'templatedetail_id' => $parent,
                    'sort' => $keys
                ]);
            if (isset($child['children'])){
                if(count($child['children']) > 0){
                    $this->subTemplate($child['children'],$child['id']);
                }
            }

        }


    }

    public function TemplateStore(Request $request)
    {
        $data = $request->all();

        //   return $data['name'];
        // return $data['description'];

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        Template::create([
            'name' => $data['name'],
            'description' => $data['description'] == null,
        ]);

        return redirect()->action($this->index());
    }
    public function TemplateDetailsStore(Request $request){

    }


}
