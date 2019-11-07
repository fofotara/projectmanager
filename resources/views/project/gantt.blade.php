@extends('layouts.backend')
@section('css_before')

    <link href="{{ asset('assets/gantt/codebase/skins/dhtmlxgantt_meadow.css') }}" rel="stylesheet">
    <style>
        .complete_button{
            margin-top: 1px;
            background-image:url("../../common/v_complete.png");
            width: 20px;
        }
    </style>
@endsection
@section('js_after')
    <script src="{{ asset('assets/gantt/codebase/dhtmlxgantt.js') }}"></script>
    <script src="{{ asset('assets/gantt/codebase/locale/locale_tr.js') }}"></script>
    <script type="text/javascript">
        var projectId = "{{ $project->id }}";

        console.log("Project Id " + projectId);
        gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
        gantt.config.order_branch = true;/*!*/
        gantt.config.order_branch_free = true;/*!*/
        gantt.config.open_tree_initially = true;
        //CUSTOM
        gantt.attachEvent("onTaskCreated", function(task){
            task.project_id = projectId;
            return true;
        });
        gantt.config.autosize ="y";
        gantt.config.autofit = true;
        gantt.config.row_height = 60;
        gantt.config.readonly = true;
       // gantt.config.editable_property = "text";

        //Complet Button
        gantt.locale.labels["complete_button"] = "İş Bitti";
        gantt.attachEvent("onLightboxButton", function(button_id, node, e){
            if(button_id === "complete_button"){
                var id = gantt.getState().lightbox;
                gantt.getTask(id).progress = 1;
                gantt.updateTask(id);
                gantt.hideLightbox();
            }
        });
        //
        gantt.attachEvent("onGanttReady", function(){
            gantt.config.buttons_left = ["gantt_save_btn","gantt_cancel_btn","complete_button"];
            gantt.config.buttons_right = ["gantt_delete_btn"];
        });

        function clone_task(id){
            var task = gantt.getTask(id);
         //   var clone = gantt.copy(task);
         //   clone.id = +(new Date());
            console.log(id);
          //  gantt.addTask(clone, clone.parent, clone.$index)
        }



        gantt.config.columns = [
            {name:"text",       label:"Task name",  width:"200", tree:true },
            {name:"duration",   label:"Duration",   align:"center" },
            {name:"add",        label:"",           width:44 },
            {name:"modal", label:"-", width:44, template: function(task){
                    return "<input type=button class='btn btn-xs btn-success' value='Detay' onclick=clone_task("+task.id+")>"
                }}
        ];
        //CUSTOM

        gantt.init("gantt_here");
        gantt.load("/data/" + projectId);
        gantt.config.order_branch = true;
        gantt.config.order_branch_free = true;
        var dp = new gantt.dataProcessor("/");/*!*/
        dp.init(gantt);/*!*/
        dp.setTransactionMode("REST");/*!*/
    </script>
@endsection
@section('content')

    <div class="row">

        <div class="content">
            <div class="block">
                <div class="block-header">
                    <h2>{{ $project->title }}</h2>
                </div>
                <div class="block-content-full">
                    <div id="gantt_here" style='width:100%; height:100%;'></div>
                </div>

            </div>


        </div>
    </div>
@endsection
