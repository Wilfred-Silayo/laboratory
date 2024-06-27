@props(['route', 'icon', 'title'])

<li class="nav-item">
    <a href="{{ route($route) }}" class="nav-link {{ request()->routeIs($route) ? 'active' : '' }}">
        <i class="nav-icon fas fa-{{ $icon }}"></i>
        <p>{{ $title }}</p>
    </a>
</li>
