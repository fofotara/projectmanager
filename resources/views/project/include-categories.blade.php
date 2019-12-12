@if($children->count() > 0)
    <ol class="dd-list">
        @foreach($children->children as $childrenAs)
            <li class="dd-item dd3-item" data-id="{{$childrenAs->id}}">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="#" class="x-editable" data-type="text"
                               data-pk="{{ $childrenAs->id }}">
                                {{$childrenAs->text}}
                            </a>
                        </div>
                        <div class="col-md-8">
                            @if($childrenAs->start_date !=null)
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="popover" title="Başlangıç Tarihi" data-placement="left" data-html="true" data-content="{!! 'Bu sekmenin başlangıç tarihi : </br>' .$childrenAs->start_date->format('d-m-Y') !!}"> Başlangıç: {{ $childrenAs->start_date->format('d-m-Y') }}</button>
                            @endif
                            @if($childrenAs->start_date !=null)
                                <button type="button" class="btn btn-sm btn-alt-success" data-toggle="popover" title="Bitiş Tarihi" data-placement="top" data-html="true" data-content="{!! 'Bu sekmenin bitiş tarihi : </br>' .\Carbon\Carbon::parse($childrenAs->start_date)->addDays($childrenAs->duration)->format('d-m-Y') !!}"> Bitiş: {{\Carbon\Carbon::parse($childrenAs->start_date)->addDays($childrenAs->duration)->format('d-m-Y') }}</button>
                            @endif
                            @if($childrenAs->end_date !=null)
                                <button type="button" class="btn btn-sm btn-alt-warning" data-toggle="popover" title="Kesin Tarihi" data-placement="left" data-html="true" data-content="{!! 'Bu sekmenin Kesin Bitiş tarihi : </br>' .$childrenAs->end_date->format('d-m-Y') !!}"> Kesin Bitiş: {{ $childrenAs->end_date->format('d-m-Y') }}</button>
                            @endif
                            <span class="badge badge-success guess_cost_amount" data-toggle="popover" title="Tahmin edilen" data-placement="top" data-html="true" data-content="{!! 'Bu sekmede Yapılması öngörülen harcama : </br>' .number_format($childrenAs->guess_cost_amount,2,',','.') !!}">{{ number_format($childrenAs->guess_cost_amount,2,',','.') }}</span>
                            <span class="badge badge-warning cost_amount" data-toggle="popover" title="Yapılan Harcama" data-placement="top" data-html="true" data-content="{!! 'Bu sekmede Yapılan toplam Harcama : </br>' .number_format($childrenAs->cost_amount,2,',','.') !!}">{{ number_format($childrenAs->cost_amount,2,'.',',') }}</span>
                            <span class="badge badge-danger total_cost_amount" data-toggle="popover" title="Toplam Yapılan Harcama" data-placement="top" data-html="true" data-content="{!! 'Bu sekmede ve alt sekmelerinde : </br>' .number_format($childrenAs->total_cost_amount,2,',','.') !!}" >{{ number_format($childrenAs->total_cost_amount,2,',','.') }}</span>
                            <div class="float-right">
                                <button data-id="{{ $childrenAs->id }}"
                                        class="btn btn-sm btn-warning modal-editable">Düzenle
                                </button>
                                <a href="{{ action('ProjectController@projectDetailsDelete', $childrenAs) }}"
                                   class="btn btn-sm btn-danger">Sil</a>
                            </div>

                        </div>

                    </div>



                </div>
                @include('project.include-categories', ['children' => $childrenAs])
            </li>
        @endforeach
    </ol>
@endif

