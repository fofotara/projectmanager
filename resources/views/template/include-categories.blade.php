@if($children->count() > 0)
    <ol class="dd-list">
        @foreach($children->children as $childrenAs)
            <li class="dd-item dd3-item" data-id="{{$childrenAs->id}}">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">
                    <div class="pull-left"><a href="#" class="x-editable"
                                              data-type="text"
                                              data-pk="{{ $childrenAs->id }}">
                            {{$childrenAs->name}}
                        </a>
                    </div>
                    <div class="pull-right">
                        <a href="{{ action('TemplateController@templateDetailsDelete', $childrenAs) }}" class="btn btn-sm btn-danger">Sil</a>
                    </div>

                </div>
                @include('template.include-categories', ['children' => $childrenAs])
            </li>
        @endforeach
    </ol>
@endif

