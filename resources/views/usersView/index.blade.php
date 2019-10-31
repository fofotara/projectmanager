@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content">


        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Kullanıcı Listesi</h3>
                <div class="block-options">
                    <a href="{{ action('UserController@create') }}" type="submit"
                       class="btn btn-sm btn-square btn-primary min-width-125 mb-10">
                        <i class="fa fa-plus-circle"></i> Yeni Kullanıcı
                    </a>
                </div>
            </div>
            <div class="block-content">
                <div class="table-responsive"> <table class="table table-hover table-center">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Adı Soyadı</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Role</th>
                            <th class="text-center" style="width: 100px;">--</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <th class="text-center" scope="row">{{$key+1}}</th>
                                <td>{{$user->name}}</td>
                                <td class="d-none d-sm-table-cell">
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                            <label class="badge badge-dark">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                title="Delete">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table></div>

            </div>
        </div>


    </div>
    <!-- END Page Content -->
@stop
