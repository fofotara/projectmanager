@extends('layouts.backend')
@section('side-bar-button')
    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout"
            data-action="side_overlay_toggle">
        <i class="fa fa-tasks"></i>
    </button>

@stop
@section('side-bar')
    @include('layouts.sidebar-show-project', ['project' => $project])
    @stop
@section('content')
    <div class="block">
        <div class="block-content">

            <div class="block-content block-content-full ">

                    <div class="text-center">
                        <h4>{{ $project->title }}</h4>
                        <div class="js-pie-chart pie-chart" data-percent="{{$task->progress*100}}" data-line-width="4"
                             data-size="120" data-bar-color="#ef5350" data-track-color="#e9e9e9"
                             data-scale-color="rgba(255,255,255,.5)">
                            <span class="text-danger">{{$task->children->count()}}<br>Sekme</span>
                        </div>
                        <div class="font-size-h3 font-w600">{{$task->text}}</div>
                    </div>

            </div>
                   <div class="row">
                <div class="col-md-4">
                    <div class="block block-link-shadow block-bordered">
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="item item-circle bg-success-light mx-auto mb-10">
                                        <i class="si si-calendar"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="font-w600">
                                        Proje Başlangıç
                                    </p>
                                    {{ $project->startDate->format('d-m-Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block block-link-shadow block-bordered">
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="item item-circle bg-success-light mx-auto mb-10">
                                        <i class="si si-calendar "></i>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <p class="font-w600">
                                        Proje Bitiş
                                    </p>
                                    {{ $project->endDate->format('d-m-Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block block-link-shadow block-bordered">
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="item item-circle bg-success-light mx-auto mb-10">
                                        <i class="si si-calendar"></i>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <p class="font-w600">
                                        Kalan Gün
                                    </p>
                                    {{ $project->endDate->diffInDays($project->startDate)}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-xl-2">
                <a class="block block-link-shadow" href="javascript:popup('stock')">
                    <div class="block-content block-content-full">
                        <div class="font-size-h2 font-w700">64</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Malzeme Giderleri</div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-2">
                <a class="block block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h2 font-w700">64</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">PERSONEL TAKİBİ</div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-2">
                <a class="block block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h2 font-w700">64</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">ÖDEMELER</div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-2">
                <a class="block block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h2 font-w700">64</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">GÖREVLENDİRMELER</div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-2">
                <a class="block block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h2 font-w700">64</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">HATIRLATMALAR</div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Extra Large Modal -->
    <div class="modal fade-up" id="public-box" tabindex="-1" role="dialog" aria-labelledby="public-box" aria-hidden="true" data-keyboard="false" data-backdrop="static" >
        <div class="modal-dialog modal-xl modal-dialog-fromleft" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Terms &amp; Conditions</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
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
    <!-- END Extra Large Modal -->


@endsection
@section('js_after')
    <script src="{{ asset('js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script>
        jQuery(function () {
            Codebase.helpers('easy-pie-chart');
        });


        function popup(values){


            jQuery('#public-box .block-title').text(values);
            jQuery('#public-box').modal('show');



           //  jQuery('#public-box .block-title').text(values);


        }

        // $('#public-box').on('show.bs.modal', function (e) {
        //     jQuery('#public-box').children('.block-title').text('Stok');
        // })





    </script>
@stop
@section('css_after')
    <link rel="stylesheet" href="{{ asset('css/pages/nestedFull.css') }}">

@stop
