@extends('layouts.backend')
@section('js_after')
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.tr.min.js') }}"></script>
    <script>
        $('.datetimepicker').datepicker({
            language: 'tr'
        });

        $('#title').on('keyup', function (e) {
            //console.log($('#title').val());
            $('#titleCopy').html($('#title').val());
        });
        $('#budget').on('keyup', function (e) {
            //console.log($('#title').val());
            $('#budgetCopy').html($('#budget').val() + ' .-TL.');
        });
        $('#address').on('keyup', function (e) {
            //console.log($('#title').val());
            $('#addressCopy').html($('#address').val());
        });
    </script>
@stop
@section('css_before')
    <link href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@stop
@section('content')
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
            <form action="{{ action('ProjectController@createOne') }}" method="post">
                @csrf
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
                    <div class="col-md-6 order-md-1 py-20">

                            <div class=" form-group">
                                <label>Proje Adı</label>
                                <input name="title" id="title" class="form-control" value="{{ old('title') }}">
                            </div>
                            <div class=" form-group">
                                <label>Proje Tipi</label>
                                <select name="template" id="template" class="form-control">
                                    <option>Proje Tipini Seçin</option>
                                    @foreach($templates as $template)
                                        <option value="{{ $template->id }}">{{ $template->name }}</option>
                                        @endforeach
                                </select>

                            </div>
                            <div class=" form-group">
                                <label>Adres</label>
                                <textarea name="address" id="address" rows="5"
                                          class="form-control">{{ old('address') }}</textarea>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="startDate">Başlangıç Tarihi</label>
                                    <div class="input-group">

                                        <input name="startDate" id="startDate" type="text"
                                               class="form-control datetimepicker">
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
                            <div class=" form-group">

                                <label for="description">Detay</label>
                                <textarea name="description" id="description" rows="5"
                                          class="form-control">{{ old('description') }}</textarea>
                            </div>
                            <div class="row form-group">
                            <div class="col-md-6">
                                <label for="area">Arsa Yüz Ölçümü ( m<sup>2</sup> )</label>
                                <input type="number" step="any" name="area" id="area" class="form-control" value="{{ old('area') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="floor">Bina Yüz Ölçümü ( m<sup>2</sup> )</label>
                                <input type="number" step="any" name="floor" id="floor" class="form-control" value="{{ old('floor') }}">
                            </div>

                        </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="budget">Tahmini Proje Tutarı</label>
                                    <input type="number" step="any" name="budget" id="budget" class="form-control" value="{{ old('budget') }}">
                                </div>

                            </div>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full border-top clearfix">
                <button type="submit" class="btn btn-hero btn-alt-danger float-right" >
                    <i class="fa fa-forward"></i> İleri
                </button>
                <a class="btn btn-hero btn-alt-primary" href="javascript:void(0)">
                    <i class="fa fa-backward mr-5"></i> Geri
                </a>
            </div>
            </form>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

