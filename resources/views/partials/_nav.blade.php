<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">
            {{ config('app.name', 'Dev-Blog') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item {{ request()->is('login') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @if (Route::has('register'))
                    <li class="nav-item {{ request()->is('register') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ auth()->user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @can('manage')
                                <a class="dropdown-item" href="{{ route('admin.users.index') }}">User Managment</a>
                                <a class="dropdown-item" href="{{ route('admin.posts.index') }}">Post Managment</a>
                                <a class="dropdown-item" href="{{ route('admin.categories.index') }}">Category Managment</a>
                                <a class="dropdown-item" href="{{ route('admin.tags.index') }}">Tag Managment</a>
                                <a class="dropdown-item" href="{{ route('admin.comments.index') }}">Comment Managment</a>
                            @elsecan ('manageOwn')
                                <a class="dropdown-item" href="{{ route('posts.own') }}">My Posts</a>
                            @endcan

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>