@if (empty($isTrue))
    @php
        $isTrue = false;
    @endphp
@endif
@php
    $value = null;
    for ($i=0; $i < $child_category->level; $i++){
        $value .= '--';
    }
@endphp
@if($isTrue)
<optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;{{ $child_category->getTranslation('name') }}">
    <option  @if(!empty($product) && $product->category_id == $child_category->id) selected="selected" @endif value="{{ $child_category->id }}">{{ $value." ".$child_category->getTranslation('name') }}</option>
    @if ($child_category->categories)
        @foreach ($child_category->categories as $childCategory)
            @include('categories.child_category', ['child_category' => $childCategory, 'isTrue' => false])
        @endforeach
    @endif
</optgroup>
@else
    <option  @if( !empty($product) &&  @$product->category_id == $child_category->id) selected="selected" @endif value="{{ $child_category->id }}">{{ $value." ".$child_category->getTranslation('name') }}</option>
    @if ($child_category->categories)
        @foreach ($child_category->categories as $childCategory)
            @include('categories.child_category', ['child_category' => $childCategory, 'isTrue' => false])
        @endforeach
    @endif
@endif

