@extends('layouts.backend')
@section('css_after')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/nestable2/jquery.nestable.min.css') }}">
@stop
@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/pages/nestable.js') }}"></script>
    <script>

        $(document).ready(function () {

            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                 //   console.log(output.val())
                } else {
                    output.val('JSON browser support required for this demo.');

                }

                $.post("{{ action('TemplateController@updateTemplate') }}",{
                    'data' : output.val()
                },
                function (data) {
                    console.log(data);
                }
                )
            };

            // activate Nestable for list 1
            $('#nestable').nestable({
                group: 1,

            })
                .on('change', updateOutput);


            // output initial serialised data
            updateOutput($('#nestable').data('output', $('#nestable-output')));


        });


    </script>

@stop
@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            <button type="button" class="btn btn-sm btn-rounded btn-primary d-md-none float-right ml-5"
                    data-toggle="class-toggle" data-target=".js-inbox-nav" data-class="d-none d-md-block">Menu
            </button>
            <button type="button" class="btn btn-sm btn-rounded btn-success float-right" data-toggle="modal"
                    data-target="#modal-compose">New Message
            </button>

        </h2>
        <div class="row">
            <div class="col-md-4">
                <!-- Collapsible Inbox Navigation -->
                <div class="js-inbox-nav d-none d-md-block">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Projeler</h3>

                        </div>
                        <div class="block-content">
                            <ul class="nav nav-pills flex-column push">
                                @foreach($templates as $template)
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center justify-content-between
                                            @if($selectTemplates != null)
                                        {{ $selectTemplates->id == $template->id ? 'active' : '' }}
                                        @endif
                                            "
                                           href="{{action('TemplateController@index', $template)}}">
                                            <span><i class="fa fa-fw fa-inbox mr-5"></i> {{ $template->name }}</span>
                                            <span class="badge badge-pill badge-secondary"></span>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END Collapsible Inbox Navigation -->

                <!-- Recent Contacts -->
                <div class="block block-themed">
                    <div class="block-header  bg-danger">
                        <h3 class="block-title">Yeni Proje Tasarımı Yarat </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <form action="{{ action('TemplateController@TemplateStore') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <input name="name" class="form-control" placeholder="Proje Adı" required>
                            </div>
                            <div class="form-group row">
                                <textarea name="description" rows="5" class="form-control" placeholder="Açıklama"
                                          required></textarea>
                            </div>
                            <div class="form-group row">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Kaydet
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Recent Contacts -->
            </div>
            <div class="col-md-8">
                <!-- Message List -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-title">
                            <strong>{{ ($selectTemplates !=null ? $selectTemplates->name : '') .' Aşamaları' }}</strong>
                        </div>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="fullscreen_toggle"></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row">

                            <div class="col-md-12">
                                <!-- Simple -->
                                <div class="block">
                                    <div class="dd" id="nestable">
                                        <ol class="dd-list">
                                            @foreach($selectTemplates->categories->where('templatedetail_id',null) as $selectT)
                                                <li class="dd-item" data-id="{{ $selectT->id }}">
                                                    <div class="dd-handle">{{'('.$selectT->id.') '.$selectT->name}}</div>
                                                    @include('template.include-categories', ['children' => $selectT])
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                                <!-- END Simple -->
                                <form action="#" method="post">
                                    @csrf
                                    <input type="hidden" name="template_id" value="{{ $selectTemplates->id }}">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input name="category" class="form-control" id="category" type="text" placeholder="Ekle" required>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-danger">Ekle</button>
                                        </div>
                                    </div>
                                </form>

                                <textarea class="form-control" rows="10" id="nestable-output"></textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- END Message List -->
            </div>

        </div>
    </div>
    <!-- END Page Content -->
@stop
