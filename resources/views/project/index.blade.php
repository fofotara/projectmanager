@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content">


        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Kullanıcı Listesi</h3>
                <div class="block-options">
                    <a href="{{ action('ProjectController@create') }}" type="submit"
                       class="btn btn-sm btn-square btn-primary min-width-125 mb-10">
                        <i class="fa fa-plus-circle"></i> Yeni Proje
                    </a>
                </div>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-hover table-center">
                        <thead>
                        <tr>
                            <th>Proje Adı</th>
                            <th>Açıklama</th>
                            <th>Başlangıç</th>
                            <th>Bitiş</th>
                            <th class="text-center" >--</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $key => $project)
                            <tr>

                                <td><a href="{{ action('GanttController@index', $project) }}">{{$project->title}}</a> </td>
                                <td class="text-sm-left">
                                    <p class="font-weight-lighter">{{ $project->description }} </p>
                                </td>
                                <td>  {{ $project->startDate->format('d-m-Y') }}</td>
                                <td>{{ $project->endDate->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ action('ProjectController@edit', $project) }}" type="button" class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                title="Delete">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>


    </div>
    <!-- END Page Content -->
@stop
