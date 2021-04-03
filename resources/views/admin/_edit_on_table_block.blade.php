@php
    if (isset($slug) && $slug) {
        $addString = '/'.$slug;
        $firstVar = true;
    } else {
        $addString = '?id='.$id;
        $firstVar = false;
    }
@endphp
@if (isset($addVars))
    @foreach($addVars as $var => $val)
        @php
            $addString .= ($firstVar ? '?' : '&').$var.'='.$val;
            if ($firstVar) $firstVar = false;
        @endphp
    @endforeach
@endif
<td class="edit"><a href="{{ url('/admin/'.$method.$addString) }}"><i class="icon-pencil5"></i></a></td>