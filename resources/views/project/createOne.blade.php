@extends('layouts.backend')
@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/pages/x-editable.js') }}"></script>
    <script src="{{ asset('js/pages/nestable.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.tr.min.js') }}"></script>


    <script>
        $(document).ready(function () {

            $('.datepicker-field').datepicker({
                //format:'YYYY-mm-dd'
                language: 'tr'
            });

            $('#projectStartDate').datepicker('update', new Date("{{ $project->startDate }}"));
            $('#projectEndDate').datepicker('update', new Date("{{ $project->endDate }}"));


            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                    //   console.log(output.val())
                } else {
                    output.val('JSON browser support required for this demo.');

                }

                $.post("/dashboard/projects/updateProject", {
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
                $('#nestable').nestable({
                    maxDepth: 15
                }).on('change', updateOutput);

                // output initial serialised data
                updateOutput($('#nestable').data('output', $('#nestable-output')));
            } catch (e) {

                console.log('Element Nothing')

            }

            $('#editable-mode').on('click', function () {
                document.getElementById('nestable');
            })

        });


        //Title Change
        $('.x-editable').editable({
            url: '/dashboard/projects/projectUpdateTitle',
            placements: 'top',
            title: 'Sekme Adını Değiştirebilsinz',
            success: function (response, newValue) {
                console.log(response, newValue);
            }

        });
        Date.prototype.addDays = function (days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }
        //EDITABLE
        $('#newStockButton').on('click', function () {
            console.log('On click New Button');

            $('#nestedName').html('Yeni Kayıt');
            $('#updateTask')[0].reset();
            $('#modal-nestedDetails').modal('show');
        });
        $('.modal-editable').on('click', function () {
            let nestedId = $(this).data('id');
            $.ajax({
                url: '/dashboard/projects/projectDetail/' + nestedId,
                type: 'GET',
                success: function (data) {
                    $('#nestedName').html(data.text);
                    $('#text').val(data.text);
                    $('#id').val(data.id);
                    $('#guess_cost_amount').val(data.guess_cost_amount);
                    $('#startDate').datepicker('update', new Date(data.start_date));
                    $('#lastDate').datepicker('update', new Date(data.last_date));
                    $('#endDate').datepicker('update', new Date(data.end_date !== null ? data.end_date : ''));
                }
            });
            $('#action').val('update');
            $('#modal-nestedDetails').modal('show');
        });
        /*
        $('#updateTask').on('submit', function (event) {
            event.preventDefault();
            let data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                type:'post',
                data: data,
            }).done(function (response) {

                console.log(response);
            })
        })
        */

    </script>



@stop
@section('css_after')


    <link rel="stylesheet" href="{{ asset('css/pages/nested.css') }}">
    <link href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@stop
@section('content')
    <!-- From Left Modal -->
    <div class="modal fade" id="modal-nestedDetails" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft"
         data-keyboard="false" data-backdrop="static"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-fromleft" role="document">
            <form id="updateTask" method="post" action="{{ action('ProjectDetailController@CreateOrUpdate') }}">
                @csrf
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title" id="nestedName"></h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Kapat">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <input type="hidden" name="id" id="id" autocomplete="off" required>
                            <input type="hidden" name="projectId" value="{{ $project->id }}" autocomplete="off"
                                   required>
                            <div class="form-group">
                                <label for="starDate">Aşama Adı</label>
                                <input class="form-control " name="text" id="text" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="starDate">Başlangıç Tarihi</label>
                                <input class="form-control datepicker-field" name="startDate" id="startDate"
                                       autocomplete="off" required>
                            </div>

                            <div class="form-group">
                                <label for="starDate">Kesin Bitiş Tarihi</label>
                                <input class="form-control datepicker-field" name="lastDate" id="lastDate"
                                       autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="starDate">Bitiş Tarihi</label>
                                <input class="form-control datepicker-field" name="endDate" id="endDate"
                                       autocomplete="off" required>
                            </div>
                            <div class="row form-group col-md-4">
                                <label for="starDate">Tahmini Bedeli</label>
                                <input type="number" step="any" class="form-control" name="guess_cost_amount" id="guess_cost_amount"
                                       autocomplete="off" required>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-alt-success">
                            <i class="fa fa-check"></i> Kaydet
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END From Left Modal -->
    <!-- Page Content -->
    <div class="content">
        <div class="block block-rounded block-fx-shadow">
            <div class="block-header block-header-default">
                {{ $project->title }} Detayları
            </div>
            <form method="post" action="{{ action('ProjectController@update',$project) }}">
                @csrf
            <div class="block-content">
                <div class="col-md-6 order-md-1 py-20">

                    <div class=" form-group">
                        <label>Proje Adı</label>
                        <input name="title" id="title" class="form-control" value="{{ old('title',$project->title) }}">
                    </div>
                    <div class=" form-group">
                        <label>Adres</label>
                        <textarea name="address" id="address" rows="5"
                                  class="form-control">{{ old('address',$project->address) }}</textarea>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="startDate">Başlangıç Tarihi</label>
                            <div class="input-group">

                                <input name="projectStartDate" id="projectStartDate" type="text"   autocomplete="off"
                                       class="form-control datepicker-field">
                                <div class="input-group-append">
                                          <span class="input-group-text">
                                              <i class="fa fa-calendar"></i>
                                          </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="startDate">Bitiş Tarihi</label>
                            <div class="input-group">

                                <input name="projectEndDate" id="projectEndDate" type="text"  autocomplete="off"
                                       class="form-control datepicker-field">
                                <div class="input-group-append">
                                          <span class="input-group-text">
                                              <i class="fa fa-calendar"></i>
                                          </span>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class=" form-group">

                        <label for="description">Detay</label>
                        <textarea name="description" id="description" rows="5"
                                  class="form-control">{{ old('description',$project->description) }}</textarea>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="area">Arsa Yüz Ölçümü ( m<sup>2</sup> )</label>
                            <input type="number" step="any" name="area" id="area" class="form-control" value="{{ old('area',$project->area) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="floor">Bina Yüz Ölçümü ( m<sup>2</sup> )</label>
                            <input type="number" step="any" name="floor" id="floor" class="form-control" value="{{ old('floor',$project->floor) }}">
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="budget">Tahmini Proje Tutarı</label>
                            <input type="number" step="any" name="budget" id="budget" class="form-control" value="{{ old('budget',$project->budget) }}">
                        </div>

                    </div>
                </div>
            </div>
            <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm text-right">

                    <button type="submit" class="btn btn-sm btn-square btn-primary min-width-125 mb-10"><i
                            class="fa fa-save"></i> Kaydet
                    </button>

            </div>
            </form>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded block-fx-shadow">
            <div class="block-header block-header-default">
                {{ $project->title }} Aşamaları
                <div class="block-options">
                    <button id="newStockButton" class="btn btn-sm btn-square btn-primary min-width-125 mb-10"><i
                            class="fa fa-plus-circle"></i> Yeni Ekle
                    </button>
                </div>
            </div>
            <div class="block-content block-content-full">
                <div class="order-md-1 py-20" style="position: relative">
                    <div class="js-nestable-connected-treeview dd" id="nestable">
                        <ol class="dd-list">
                            @foreach($project->categories->where('parent',null) as $selectT)
                                <li class="dd-item dd3-item" data-id="{{ $selectT->id }}">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a href="#" class="x-editable" data-type="text"
                                                   data-pk="{{ $selectT->id }}">
                                                    {{$selectT->text}}
                                                </a>
                                            </div>
                                            <div class="col-md-8">
                                                @if($selectT->start_date !=null)
                                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="popover" title="Başlangıç Tarihi" data-placement="left" data-html="true" data-content="{!! 'Bu sekmenin başlangıç tarihi : </br>' .$selectT->start_date->format('d-m-Y') !!}"> Başlangıç: {{ $selectT->start_date->format('d-m-Y') }}</button>
                                                @endif
                                                    @if($selectT->start_date !=null)
                                                        <button type="button" class="btn btn-sm btn-alt-success" data-toggle="popover" title="Bitiş Tarihi" data-placement="top" data-html="true" data-content="{!! 'Bu sekmenin bitiş tarihi : </br>' .\Carbon\Carbon::parse($selectT->start_date)->addDays($selectT->duration)->format('d-m-Y') !!}"> Bitiş: {{\Carbon\Carbon::parse($selectT->start_date)->addDays($selectT->duration)->format('d-m-Y') }}</button>
                                                    @endif
                                                    @if($selectT->end_date !=null)
                                                        <button type="button" class="btn btn-sm btn-alt-warning" data-toggle="popover" title="Kesin Tarihi" data-placement="left" data-html="true" data-content="{!! 'Bu sekmenin Kesin Bitiş tarihi : </br>' .$selectT->end_date->format('d-m-Y') !!}"> Kesin Bitiş: {{ $selectT->end_date->format('d-m-Y') }}</button>
                                                    @endif
                                                    <span class="badge badge-success guess_cost_amount" data-toggle="popover" title="Tahmin edilen" data-placement="top" data-html="true" data-content="{!! 'Bu sekmede Yapılması öngörülen harcama : </br>' .number_format($selectT->guess_cost_amount,2,',','.') !!}">{{ number_format($selectT->guess_cost_amount,2,',','.') }}</span>
                                                    <span class="badge badge-warning cost_amount" data-toggle="popover" title="Yapılan Harcama" data-placement="top" data-html="true" data-content="{!! 'Bu sekmede Yapılan toplam Harcama : </br>' .number_format($selectT->cost_amount,2,',','.') !!}">{{ number_format($selectT->cost_amount,2,'.',',') }}</span>
                                                    <span class="badge badge-danger total_cost_amount" data-toggle="popover" title="Toplam Yapılan Harcama" data-placement="top" data-html="true" data-content="{!! 'Bu sekmede ve alt sekmelerinde : </br>' .number_format($selectT->total_cost_amount,2,',','.') !!}" >{{ number_format($selectT->total_cost_amount,2,',','.') }}</span>
                                                <div class="float-right">
                                                    <button data-id="{{ $selectT->id }}"
                                                            class="btn btn-sm btn-warning modal-editable">Düzenle
                                                    </button>
                                                    <a href="{{ action('ProjectController@projectDetailsDelete', $selectT) }}"
                                                       class="btn btn-sm btn-danger">Sil</a>
                                                </div>

                                            </div>

                                        </div>



                                    </div>
                                    @include('project.include-categories', ['children' => $selectT])
                                </li>
                            @endforeach
                        </ol>
                    </div>
                    <textarea class="form-control" style="display: none" rows="10" id="nestable-output"></textarea>
                </div>
            </div>
        </div>


        <!-- END Page Content -->

    </div>
@endsection
