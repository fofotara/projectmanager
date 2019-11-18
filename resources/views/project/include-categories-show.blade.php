@if($children->count() > 0)
    <ol class="dd-list">
        @foreach($children->children as $childrenAs)
            <li class="dd-item" data-id="{{$childrenAs->id}}">
                <div class="dd3-content">
                    <div class="block block-link-shadow block-bordered">
                        <div class="block-header block-header-default">
                            <i class="si si-grid"></i>
                            {{ $childrenAs->text }}
                            <div class="block-options">
                                <a href="{{ action('ProjectDetailController@action', [$project->id,$childrenAs->id]) }}" type="button" class="btn btn-sm btn-primary">Hareketler</a>

                            </div>
                        </div>
                        <div class="block-content block-content-full clearfix">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="float-left">
                                        <img class="img-avatar" src="{{ asset('media/avatars/avatar14.jpg') }}"
                                             alt="">
                                    </div>
                                    <div class="text-right float-left mt-10">

                                        <div class="font-w600 mb-5">{{$childrenAs->text}}</div>
                                        @if($childrenAs->user_id > 0)
                                            <div
                                                class="font-size-sm text-muted">{{optional($childrenAs->user)->name}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-3 text-center">
                                            <i class="si si-calendar fa-2x bg-success"></i>
                                            <p class="text-muted">Başlangıç Tarihi</p>
                                            <p class="text-muted">{{ $childrenAs->start_date->format('d-m-Y') }}</p>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <i class="si si-calendar fa-2x bg-success"></i>
                                            <p class="text-muted">Bitiş Tarihi</p>
                                            <p class="text-muted">{{ $childrenAs->start_date->addDays($childrenAs->duration)->format('d-m-Y') }}</p>
                                        </div>
                                        <div class="col-md-3 text-center text-danger">
                                            <i class="si si-calendar fa-2x bg-warning"></i>
                                            <p class="text-muted">Kesin Bitiş</p>
                                            <p class="text-muted">
                                                {{ $childrenAs->end_date->format('d-m-Y')}}

                                            </p>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                @include('project.include-categories-show', ['children' => $childrenAs])
            </li>
        @endforeach
    </ol>
@endif

