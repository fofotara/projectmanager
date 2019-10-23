@if($children->count() > 0)
    <ol class="dd-list">
        @foreach($children->children as $childrenAs)
            <li class="dd-item" data-id="{{$childrenAs->id}}">
                <div class="dd-handle">{{'( '. $children->id .' - '. $childrenAs->id .' ) '. $childrenAs->name}}</div>
                @include('template.include-categories', ['children' => $childrenAs])
            </li>
        @endforeach
    </ol>
@endif
