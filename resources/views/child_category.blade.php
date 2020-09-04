<li>{{ $child_category->name }}</li>
@if ($child_category->allChildren)
    <ul>
        @foreach ($child_category->allChildren as $childCategory)
            @include('child_category', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif
