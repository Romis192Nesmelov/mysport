@if (!$start)
    <li><a {{ Request::path() == '/' ? 'class=active' : '' }} href="{{ url('/') }}">{{ trans('content.home_page') }}</a></li>
@endif
@for($i=$start;$i<$end;$i++)
    @php
        $parts = explode(' ',$menu[$i]['name']);
        $name = $break && count($parts) > 2 ? $parts[0].'<br>'.$parts[1].' '.$parts[2] : $menu[$i]['name'];
    @endphp
    <li><a {{ isset($menu[$i]['href']) ? 'href='.$menu[$i]['href'] : (Request::path() == '/' ? 'data-scroll='.$menu[$i]['data_scroll'] : 'href='.url('/#'.$menu[$i]['data_scroll'])) }}>{!! $name !!}</a></li>
@endfor