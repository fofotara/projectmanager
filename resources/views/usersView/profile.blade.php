@extends('layouts.backend')
@section('content')

    <div class="content">
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Yeni Kullanıcı Ekle</h3>
                <div class="block-options">
                    <a href="{{ action('UserController@profileUpdate', Auth::id()) }}" type="submit"
                       class="btn btn-sm btn-square btn-primary min-width-125 mb-10">
                        <i class="fa fa-history"></i> Kullanıcı Listesi
                    </a>
                </div>
            </div>
            <div class="block-content">

                <h2 class="content-heading text-black">Kullanıcı Detayları</h2>
                <form action="{{ action('UserController@profileUpdate', $user) }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right" for="name">Adı Soyadı :</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control  @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{old('name',$user->name)}}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right" for="email">Email Adresi :</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control  @error('name') is-invalid @enderror"
                                   id="email" name="email" value="{{old('email',$user->email)}}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right" for="password">Şifre :</label>
                        <div class="col-md-7">
                            <input type="password"
                                   class="form-control form-control  @error('name') is-invalid @enderror"
                                   id="password" name="password"  autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right" for="password_confirmation">Şifre
                            Tekrar:</label>
                        <div class="col-md-7">
                            <input type="password" class="form-control form-control"
                                   id="password_confirmation" name="password_confirmation"
                                   autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-7 offset-md-3">
                            <button type="submit" class="btn btn-sm btn-square btn-success min-width-125 mb-10">
                                <i class="fa fa-save"></i> Güncelle
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@stop
