@extends('layouts.backend')
@section('css_after')
    <!-- Page JS Plugins CSS -->

    <link rel="stylesheet" href="{{ asset('css/pages/x-editable.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/nested.css') }}">
    <style>

    </style>
@stop
@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/pages/x-editable.js') }}"></script>
    <script src="{{ asset('js/pages/nestable.js') }}"></script>
    <script>
        $('.x-editable').editable({
            url: '/dashboard/templates/templateUpdateTitle',
            placements: 'top',
            title: 'Sekme Adını Değiştirebilsiniz',
            success: function (response, newValue) {
                console.log(response, newValue);
            }

        });

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

                $.post("/dashboard/settings/templates/updateTemplate", {
                        'data': output.val()
                    },

                    function (data) {
                        //  Codebase.blocks('#designBlock','state_normal');
                        console.log(data);
                    }
                )
            };

            // activate Nestable for list 1
            try {
                $('#nestable').nestable({maxDepth:15 } ) .on('change', updateOutput);

                // output initial serialised data
                updateOutput($('#nestable').data('output', $('#nestable-output')));
            }catch (e) {

                console.log('Element Nothing')

            }

            $('#editable-mode').on('click', function () {
                document.getElementById('nestable').eve
            })

        });

    </script>

@stop
@section('content')
    <!-- Page Content -->
    <div class="content">

        <div class="row">
            <div class="col-md-4">
                <!-- Collapsible Inbox Navigation -->
                <div class="js-inbox-nav d-none d-md-block">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Projeler</h3>
                            @if($selectTemplates != null)
                                <div class="block-options">
                                    <a href="{{ action('TemplateController@deleteTemplate',$selectTemplates) }}"
                                       onclick="return confirm(' Aktif Olan Proje tasarımı ve tüm alt sekmeleri silinecek !.. \n\r Eminmisiniz ?');"
                                       type="button" class="btn btn-sm btn-danger"> Aktif Projeyi Sil</a>
                                </div>
                            @endif
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
                                            <span><i
                                                    class="fa fa-building mr-5"></i> {{ $template->name }}</span>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                            <div class="block">
                                <div class="block-content-full bg-secondary  p-50">
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
                                            <button type="submit" class="btn btn-sm btn-success"><i
                                                    class="fa fa-plus"></i> Kaydet
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Collapsible Inbox Navigation -->


            </div>
            @if($selectTemplates !=null)
                <div class="col-md-8">
                    <!-- Message List -->
                    <div class="block" id="designBlock">
                        <div class="block-header block-header-default">
                            <div class="block-title">
                                <strong>{{ ($selectTemplates !=null ? $selectTemplates->name : '') .' Aşamaları' }}</strong>
                            </div>
                            <div class="block-options">
                                @if($selectTemplates->categories->count() >0)
                                    <a href="{{ action('TemplateController@deleteTemplateDetails',$selectTemplates) }}"
                                       onclick="return confirm(' Aktif Olan Projenin Tüm Sekmeleri silinecek !.. \n\r Eminmisiniz ?');"
                                       type="button" class="btn btn-sm btn-danger"> Aktif Proje Detaylarını Sil</a>
                                @endif
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row">

                                <div class="col-md-12">
                                    <!-- Simple -->
                                    <div class="block">
                                        <div class="js-nestable-connected-treeview dd" id="nestable">
                                            <ol class="dd-list">
                                                @foreach($selectTemplates->categories->where('templatedetail_id',null) as $selectT)
                                                    <li class="dd-item dd3-item" data-id="{{ $selectT->id }}">
                                                        <div class="dd-handle dd3-handle"></div>
                                                        <div class="dd3-content">
                                                            <div class="pull-left"><a href="#" class="x-editable"
                                                                                      data-type="text"
                                                                                      data-pk="{{ $selectT->id }}">
                                                                    {{$selectT->name}}
                                                                </a>
                                                            </div>
                                                            <div class="pull-right">
                                                                <a href="{{ action('TemplateController@templateDetailsDelete', $selectT) }}" class="btn btn-sm btn-danger">Sil</a>
                                                            </div>

                                                        </div>

                                                        @include('template.include-categories', ['children' => $selectT])
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="block">
                                        <div class="block-content-full bg-secondary  p-50">
                                            <form action="{{ action('TemplateController@TemplateDetailsStore') }}"
                                                  method="post">
                                                @csrf
                                                <input type="hidden" name="template_id"
                                                       value="{{ $selectTemplates->id }}">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <input name="category" class="form-control" id="category"
                                                               type="text" placeholder="Ekle" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-success"><i
                                                                class="fa fa-plus"></i> Ekle
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                    <textarea class="form-control" style="display: none" rows="10"
                                              id="nestable-output"></textarea>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- END Message List -->
                </div>
            @endif
        </div>
    </div>
    <!-- END Page Content -->
@stop
