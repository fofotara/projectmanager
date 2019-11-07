@extends('layouts.backend')
@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/pages/x-editable.js') }}"></script>
    <script src="{{ asset('js/pages/nestable.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.tr.min.js') }}"></script>


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

        //EDITABLE
        $('.modal-editable').on('click', function () {
            var nestedId = $(this).data('id');

            $.ajax({
                url: '/dashboard/projects/projectDetail/' + nestedId,
                type:'GET',
                success: function (data) {
                    console.log(data);
                    $('#DivStartDate').data('date',data.startDate);
                    $('#nestedName').html(data.name);
                    //  $('#DivStartDate').val(data.startDate).datepicker("update");

                    $('#DivStartDate').datepicker({
                        language:'tr'
                    }).on('changeDate', function() {
                        $('#startDate').val(
                            $('#DivStartDate').datepicker('getFormattedDate')
                        );
                    });


                }
            });

            console
                .log(nestedId);
            $('#modal-nestedDetails').modal('show');
        })
    </script>



@stop
@section('css_after')
    <link href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/x-editable.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/nested.css') }}">
@stop
@section('content')
    <!-- From Left Modal -->
    <div class="modal fade" id="modal-nestedDetails" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
        <div class="modal-dialog modal-dialog-fromleft" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title" id="nestedName"></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="startDate">Başlangıç Tarihi</label>
                                    <div id="DivStartDate" data-date="12/03/2012"></div>
                                    <input type="text" id="startDate">
                                </div>
                                <div class="col-md-6">
                                    <label for="startDate">Bitiş Tarihi</label>
                                    <div class="input-group">

                                        <input name="endDate" id="endDate" type="text"
                                               class="form-control datetimepicker">
                                        <div class="input-group-append">
                                          <span class="input-group-text">
                                              <i class="fa fa-calendar"></i>
                                          </span>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-alt-success" data-dismiss="modal">
                        <i class="fa fa-check"></i> Perfect
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- END From Left Modal -->
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10" id="titleCopy">

            </h2>
            <h3 class="h5 text-muted mb-0">
                <i class="fa fa-map-pin mr-5"></i> <span id="addressCopy"></span>
            </h3>
        </div>
        <div class="block block-rounded block-fx-shadow">
            <div class="block-content p-0 bg-image" style="background-image: url('/media/photos/photo35@2x.jpg');">
                <div class="px-20 py-150 bg-black-op text-center rounded-top">
                    <h5 id="budgetCopy" class="font-size-h1 font-w300 text-white mb-10"></h5>
                    <span class="badge badge-primary text-uppercase font-w700 py-10 px-15">For Sale</span>
                </div>
            </div>
            <div class="block-content bg-body-light">
                <div class="row py-10">
                    <div class="col-6 col-md-4">
                        <p>
                            <i class="fa fa-fw fa-bed text-muted mr-5"></i> <strong>2</strong> Bedrooms
                        </p>
                    </div>
                    <div class="col-6 col-md-4">
                        <p>
                            <i class="fa fa-fw fa-bath text-muted mr-5"></i> <strong>1</strong> Bathroom
                        </p>
                    </div>
                    <div class="col-6 col-md-4">
                        <p>
                            <i class="fa fa-fw fa-car text-muted mr-5"></i> <strong>1</strong> Parking
                        </p>
                    </div>
                    <div class="col-6 col-md-4">
                        <p>
                            <i class="fa fa-fw fa-arrows-alt text-muted mr-5"></i> <strong>310</strong> sq.ft.
                        </p>
                    </div>
                    <div class="col-6 col-md-4">
                        <p>
                            <i class="fa fa-fw fa-fire text-muted mr-5"></i> Electricity
                        </p>
                    </div>
                    <div class="col-6 col-md-4">
                        <p>
                            <i class="fa fa-fw fa-globe text-muted mr-5"></i> <strong>1</strong> Gbps
                        </p>
                    </div>
                </div>
            </div>


            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-md-6 order-md-2 py-20">
                        <div class="row gutters-tiny js-gallery img-fluid-100">
                            <div class="col-6">
                                <a class="img-link img-link-simple img-thumb img-lightbox"
                                   href="/media/photos/photo35@2x.jpg">
                                    <img class="img-fluid" src="/media/photos/photo35.jpg" alt="">
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="img-link img-link-simple img-thumb img-lightbox"
                                   href="/media/photos/photo41@2x.jpg">
                                    <img class="img-fluid" src="/media/photos/photo41.jpg" alt="">
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="img-link img-link-simple img-thumb img-lightbox"
                                   href="/media/photos/photo42@2x.jpg">
                                    <img class="img-fluid" src="/media/photos/photo42.jpg" alt="">
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="img-link img-link-simple img-thumb img-lightbox"
                                   href="/media/photos/photo43@2x.jpg">
                                    <img class="img-fluid" src="/media/photos/photo43.jpg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 order-md-1 py-20" style="position: relative">
                        <div class="block">
                            <div class="block-content-full bg-secondary  p-50">
                                <form action="{{ action('ProjectController@projectDetailsStore') }}"
                                      method="post">
                                    @csrf
                                    <input type="hidden" name="template_id"
                                           value="{{ $project->id }}">
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
                        <div class="js-nestable-connected-treeview dd" id="nestable">
                            <ol class="dd-list">
                                @foreach($project->categories->where('parent',null) as $selectT)
                                    <li class="dd-item dd3-item" data-id="{{ $selectT->id }}">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content">

                                            <div class="pull-left">
                                                <a href="#" class="x-editable" data-type="text"
                                                   data-pk="{{ $selectT->id }}">
                                                    {{$selectT->text}}
                                                </a>

                                            </div>
                                            <div class="pull-right">
                                                <span>  {{ $selectT->start_date != null ? 'Başlangıç : '. $selectT->start_date->format('d-m-Y') : '' }}</span>
                                                <button data-id="{{ $selectT->id }}"
                                                        class="btn btn-sm btn-warning modal-editable">Düzenle</button>
                                                <a href="{{ action('ProjectController@projectDetailsDelete', $selectT) }}"
                                                   class="btn btn-sm btn-danger">Sil</a>
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
{{--            <div class="block-content block-content-full border-top clearfix">--}}
{{--                <button type="submit" class="btn btn-hero btn-alt-danger float-right">--}}
{{--                    <i class="fa fa-forward"></i> İleri--}}
{{--                </button>--}}
{{--                <a class="btn btn-hero btn-alt-primary" href="javascript:void(0)">--}}
{{--                    <i class="fa fa-backward mr-5"></i> Geri--}}
{{--                </a>--}}
{{--            </div>--}}

        </div>
    </div>
    <!-- END Page Content -->


@endsection
