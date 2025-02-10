@props(['route', 'routeFamily', 'icon', 'title', 'subItems' => []])

<li class="sidebar-item {{ request()->routeIs($routeFamily) ? 'active' : '' }} {{ $subItems ? 'has-sub' : '' }}">
    <a href="{{ $subItems ? '#' : route($route) }}" class='sidebar-link'>
        <i class="{{ $icon }}"></i>
        <span>{{ $title }}</span>
    </a>
    @if($subItems)
        <ul class="submenu">
            @foreach($subItems as $subItem)
                <li class="submenu-item {{ request()->routeIs($subItem['url']) ? 'active' : '' }}">
                    <a href="{{ route($subItem['url']) }}" class="submenu-link">{{ $subItem['title'] }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</li>
