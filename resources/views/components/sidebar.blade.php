<nav class="sidebar-nav">
    <ul class="nav">
        @foreach(config('menu.' . (Auth::guest() ? 'guest' : 'authenticated')) as $menu)
            @if($menu['type'] == 'title')
                <li class="nav-title">{{ $menu['text'] }}</li>
            @elseif($menu['type'] == 'link')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route($menu['route']) }}">
                        <i class="{{ $menu['icon'] }}"></i> {{ $menu['text'] }}
                    </a>
                </li>
            @elseif($menu['type'] == 'dropdown')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="{{ $menu['icon'] }}"></i> {{ $menu['text'] }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @foreach($menu['items'] as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route($item['route']) }}">
                                    <i class="{{ $item['icon'] }}"></i> {{ $item['text'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @elseif($menu['type'] == 'logout')
                <li class="nav-item">
                    <form id="logout-form" action="{{ route($menu['route']) }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link">
                            <i class="{{ $menu['icon'] }}"></i> {{ $menu['text'] }}
                        </button>
                    </form>
                </li>
            @endif
        @endforeach
    </ul>
</nav>
<button class="sidebar-minimizer brand-minimizer" type="button"></button>