@extends('layouts.backend')
@section('content')
    <div class="block">
        <div class="block-content">

            <div class="block-content block-content-full ">
                <div class="text-center">
                    <div class="js-pie-chart pie-chart" data-percent="{{$project->progress}}" data-line-width="4"
                         data-size="120" data-bar-color="#ef5350" data-track-color="#e9e9e9"
                         data-scale-color="rgba(255,255,255,.5)">
                        <span class="text-danger">{{$project->categories->count()}}<br>Sekme</span>
                    </div>
                    <div class="font-size-h3 font-w600">{{$project->title}}</div>
                </div>

            </div>
            <h5> {{ $project->address }}</h5>
            <h6> {{ $project->description }}</h6>
            <div class="row">
                <div class="col-md-4">
                    <div class="block block-link-shadow block-bordered">
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="item item-circle bg-success-light mx-auto mb-10">
                                        <i class="si si-calendar fa-2x"></i>
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
                                        <i class="si si-calendar fa-2x"></i>
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
                                        <i class="si si-calendar fa-2x"></i>
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
    <div class="block block-bordered">
        <div class="block-content">
            <div class="js-nestable-connected-treeview dd" id="nestable">
                <ol class="dd-list">
                    @foreach($project->categories->where('parent',null) as $selectT)
                        <li class="dd-item " data-id="{{ $selectT->id }}">
                            <div class="dd3-content">
                                <div class="block block-link-shadow block-bordered">
                                    <div class="block-header block-header-default">
                                        <i class="si si-grid"></i>
                                        <div class="block-options">

                                                <a href="{{ action('ProjectDetailController@action', [$project->id,$selectT->id]) }}" type="button" class="btn btn-sm btn-primary">Hareketler</a>


                                        </div>


                                    </div>
                                    <div class="block-content block-content-full clearfix">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="float-left">
                                                    <img class="img-avatar"
                                                         src="{{ asset('media/avatars/avatar14.jpg') }}"
                                                         alt="">
                                                </div>
                                                <div class="text-right float-left mt-10">

                                                    <div class="font-w600 mb-5">{{$selectT->text}}</div>
                                                    @if($selectT->user_id > 0)
                                                        <div
                                                            class="font-size-sm text-muted">{{optional($selectT->user)->name}}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-3 text-center">
                                                        <i class="si si-calendar fa-2x bg-success"></i>
                                                        <p class="text-muted">Başlangıç Tarihi</p>
                                                        <p class="text-muted">{{ $selectT->start_date->format('d-m-Y') }}</p>
                                                    </div>
                                                    <div class="col-md-3 text-center">
                                                        <i class="si si-calendar fa-2x bg-success"></i>
                                                        <p class="text-muted">Bitiş Tarihi</p>
                                                        <p class="text-muted">{{ $selectT->start_date->addDays($selectT->duration)->format('d-m-Y') }}</p>
                                                    </div>
                                                    <div class="col-md-3 text-center text-danger">
                                                        <i class="si si-calendar fa-2x bg-warning"></i>
                                                        <p class="text-muted">Kesin Bitiş</p>
                                                        <p class="text-muted">
                                                            {{ $selectT->end_date != null ? $selectT->end_date->format('d-m-Y'): ''}}

                                                        </p>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('project.include-categories-show', ['children' => $selectT])
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

@endsection
@section('js_after')
    <script src="{{ asset('js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script>jQuery(function () {
            Codebase.helpers('easy-pie-chart');
        });</script>
@stop
@section('css_after')
    <link rel="stylesheet" href="{{ asset('css/pages/nestedFull.css') }}">
    <style>

        .top-nav {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;


            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            color: #FFF;
            height: 50px;
            padding: 1em;
            z-index: 100000000;
        }

        .menu {
            display: flex;
            flex-direction: row;
            list-style-type: none;
            margin: 0;
            padding: 0;
            z-index: 100000000;
        }

        .menu > li {
            margin: 0 1rem;
        }

        .menu-button-container {
            display: none;
            height: 100%;
            width: 30px;
            cursor: pointer;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        #menu-toggle {
            display: none;
        }

        .menu-button,
        .menu-button::before,
        .menu-button::after {
            display: block;
            background-color: #fff;
            position: absolute;
            height: 4px;
            width: 30px;
            transition: transform 400ms cubic-bezier(0.23, 1, 0.32, 1);
            border-radius: 2px;
        }

        .menu-button::before {
            content: '';
            margin-top: -8px;
        }

        .menu-button::after {
            content: '';
            margin-top: 8px;
        }

        #menu-toggle:checked + .menu-button-container .menu-button::before {
            margin-top: 0px;
            transform: rotate(405deg);
        }

        #menu-toggle:checked + .menu-button-container .menu-button {
            background: rgba(255, 255, 255, 0);
        }

        #menu-toggle:checked + .menu-button-container .menu-button::after {
            margin-top: 0px;
            transform: rotate(-405deg);
        }

        @media (max-width: 700px) {
            .menu-button-container {
                display: flex;
            }

            .menu {
                position: absolute;
                top: 20px;
                margin-top: 50px;
                left: 0;
                flex-direction: column;
                width: 100%;
                justify-content: center;
                align-items: center;
                z-index: 10000000;
            }

            #menu-toggle ~ .menu li {
                height: 0;
                margin: 0;
                padding: 0;
                border: 0;
                transition: height 400ms cubic-bezier(0.23, 1, 0.32, 1);
            }

            #menu-toggle:checked ~ .menu li {
                border: 1px solid #333;
                height: 2.5em;
                padding: 0.5em;
                transition: height 400ms cubic-bezier(0.23, 1, 0.32, 1);
            }

            .menu > li {
                display: flex;
                justify-content: center;
                margin: 0;
                padding: 0.5em 0;
                width: 100%;
                color: white;
                background-color: #222;
            }

            .menu > li:not(:last-child) {
                border-bottom: 1px solid #444;
            }
        }
    </style>
@stop
