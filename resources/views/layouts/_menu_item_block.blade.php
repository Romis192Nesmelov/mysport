<li class="{{ preg_match('/^('.($prefix ? str_replace('/','\/',$prefix) : '').str_replace('/','\/',$menu['href']).')/', Request::path()) ? 'active' : '' }} {{ isset($menu['submenu']) && count($menu['submenu']) ? 'dropdown mega-menu mega-menu-wide' : '' }}">
    <a {{ isset($menu['submenu']) && count($menu['submenu']) ? 'class=dropdown-toggle data-toggle=dropdown' : '' }} href="{{ url($prefix.$menu['href']) }}"><i class="{{ $menu['icon'] }}"></i> <span>{{ str_limit($menu['name'], 20) }}</span></a>
    @if (isset($menu['submenu']) && count($menu['submenu']))
        <ul class="dropdown-menu width-250">
            @foreach ($menu['submenu'] as $submenu)
                <?php
                $addAttrStr = '';
                if (isset($submenu['addAttr']) && count($submenu['addAttr']) ) {
                    foreach ($submenu['addAttr'] as $attr => $val) {
                        $addAttrStr .= $attr.'="'.$val.'"';
                    }
                }
                ?>
                <li {{ (preg_match('/^('.($prefix ? str_replace('/','\/',$prefix) : '').str_replace('/','\/',$menu['href'].'/'.$submenu['href']).')/', Request::path())) /*|| (Request::path() == 'admin/products' && Request::has('id') && Request::input('id') == (int)str_replace('?id=','',$submenu['href']))*/ ? 'class=active' : '' }}>
                    <a href="{{ url($prefix.$menu['href'].'/'.$submenu['href']) }}" {!! $addAttrStr !!}>{{ str_limit($submenu['name'], 20) }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</li>