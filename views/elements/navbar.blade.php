<div class="header-nav @if(!Route::is('home')) small-header @endif" id="header">
    <div class="container navigation">
        <ul class="header-nav-left">
            @foreach($navbar as $element)
                @if(!$element->isDropdown())
                    <li class="item @if($element->isCurrent()) active @endif">
                        <a href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank"
                           rel="noopener noreferrer" @endif>{{ $element->name }}</a>
                    </li>
                @else
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $element->id }}" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $element->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $element->id }}">
                            @foreach($element->elements as $childElement)
                                <a class="dropdown-item @if($childElement->isCurrent()) active @endif"
                                   href="{{ $childElement->getLink() }}" @if($childElement->new_tab) target="_blank"
                                   rel="noopener noreferrer" @endif>{{ $childElement->name }}</a>
                            @endforeach
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>

        <ul class="header-nav-right">
            @guest
                <li class="item">
                    <a href="{{ route('login') }}">
                        {{ trans('auth.login') }}
                    </a>
                </li>
                @if(Route::has('register'))
                    <li class="item">
                        <a href="{{ route('register') }}">
                            {{ trans('auth.register') }}
                        </a>
                    </li>
                @endif
            @else
                <li class="item">
                    <a class="nav-link dropdown-toggle d-inline-flex align-items-center" href="#" id="notificationsDropdown" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- Counter - Notifications -->
                        <i class="bi bi-bell-fill fs-4 me-2"></i>
                        @if(! $notifications->isEmpty())
                            <span class="badge badge-danger"
                                  id="notificationsCounter">{{ $notifications->count() }}</span>
                        @endif
                    </a>

                    <!-- Dropdown - Notifications -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right"
                         aria-labelledby="notificationsDropdown">
                        <h6 class="dropdown-header">{{ trans('messages.notifications.notifications') }}</h6>

                        @if(! $notifications->isEmpty())
                            <div id="notifications">
                                @foreach($notifications as $notification)
                                    <a href="#" class="dropdown-item media align-items-center">
                                        <div class="mr-3">
                                            <div class="rounded-circle text-white d-inline-block py-1 bg-{{ $notification->level }}">
                                                <i class="bi bi-{{ $notification->icon() }} fs-4 m-2"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="small">{{ format_date($notification->created_at, true) }}</div>
                                            {{ $notification->content }}
                                        </div>
                                    </a>
                                @endforeach

                                <a href="{{ route('notifications.read.all') }}" id="readNotifications"
                                   class="dropdown-item text-center small text-gray-500">
                                    <span class="d-none spinner-border spinner-border-sm load-spinner"
                                          role="status"></span>
                                    {{ trans('messages.notifications.read') }}
                                </a>
                            </div>
                        @endif

                        <div id="noNotificationsLabel"
                             class="dropdown-item text-center small text-success @if(! $notifications->isEmpty()) d-none @endif">
                            <i class="bi bi-check-lg"></i> {{ trans('messages.notifications.empty') }}
                        </div>
                    </div>
                </li>
                <li class="item">
                    <a id="userDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            {{ trans('messages.nav.profile') }}
                        </a>

                        @foreach(plugins()->getUserNavItems() ?? [] as $navId => $navItem)
                            <a class="dropdown-item" href="{{ route($navItem['route']) }}">
                                {{ trans($navItem['name']) }}
                            </a>
                        @endforeach

                        @if(Auth::user()->hasAdminAccess())
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                {{ trans('messages.nav.admin') }}
                            </a>
                        @endif

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ trans('auth.logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>

    <div class="header-content">
        @if(setting('background'))
            <div class="position-absolute background-brand top-0 left-0 w-100">
                <img class="img-fluid w-100"
                     src="{{ image_url(setting('background')) }}"
                     alt="">
            </div>
        @endif
        <div class="description">
            @if(setting('logo'))
                <img src="{{ image_url(setting('logo')) }}" alt="Logo">
            @else
                <h1>{{ site_name() }}</h1>
            @endif
            <p class="mt-3">{{ theme_config('subtitle') }}</p>
        </div>

        <div class="container" style="position: relative;">
            <div class="go-to-button" id="go-to-bottom">
                <span><i class="bi bi-chevron-double-down"></i></span>
            </div>
        </div>
    </div>
</div>

<div class="header-mobile-nav">
    <div class="mobile-btn" id="mobile-btn">
        <span id="nav-btn-icon"><i class="bi bi-list"></i></span>
    </div>

    <ul class="mobile-navigation" id="mobile-nav">
        @foreach($navbar as $element)
            @if(!$element->isDropdown())
                <li class="item @if($element->isCurrent()) active @endif">
                    <a href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank"
                       rel="noopener noreferrer" @endif>
                        <span class="name">{{ $element->name }}</span>
                    </a>
                </li>
            @else
                <li class="item nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $element->id }}" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ $element->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $element->id }}">
                        @foreach($element->elements as $childElement)
                            <a class="dropdown-item @if($childElement->isCurrent()) active @endif"
                               href="{{ $childElement->getLink() }}" @if($childElement->new_tab) target="_blank"
                               rel="noopener noreferrer" @endif>{{ $childElement->name }}</a>
                        @endforeach
                    </div>
                </li>
            @endif
        @endforeach
        @guest
            <li class="item">
                <a href="{{ route('login') }}">
                    <span class="name">{{ trans('auth.login') }}</span>
                </a>
            </li>

            @if(Route::has('register'))
                <li class="item">
                    <a href="{{ route('register') }}">
                        <span class="name">{{ trans('auth.register') }}</span>
                    </a>
                </li>
            @endif
        @else
            <li class="item nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- Counter - Notifications -->
                    <i class="bi bi-bell-fill  fs-4"></i>
                    @if(! $notifications->isEmpty())
                        <span class="badge badge-danger" id="notificationsCounter">{{ $notifications->count() }}</span>
                    @endif
                </a>
                <div class="dropdown-menu" aria-labelledby="notificationsDropdown">
                    <h6 class="dropdown-header">{{ trans('messages.notifications.notifications') }}</h6>

                    @if(! $notifications->isEmpty())
                        <div id="notifications">
                            @foreach($notifications as $notification)
                                <a href="#" class="dropdown-item media align-items-center">
                                    <div class="mr-3">
                                        <div class="rounded-circle text-white d-inline-block py-1 bg-{{ $notification->level }}">
                                            <i class="bi bi-{{ $notification->icon() }}  fs-4 m-2"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <div class="small">{{ format_date($notification->created_at, true) }}</div>
                                        {{ $notification->content }}
                                    </div>
                                </a>
                            @endforeach

                            <a href="{{ route('notifications.read.all') }}" id="readNotifications"
                               class="dropdown-item text-center small text-gray-500">
                                <span class="d-none spinner-border spinner-border-sm load-spinner" role="status"></span>
                                {{ trans('messages.notifications.read') }}
                            </a>
                        </div>
                    @endif

                    <div id="noNotificationsLabel"
                         class="dropdown-item text-center small text-success @if(! $notifications->isEmpty()) d-none @endif">
                        <i class="bi bi-check-lg"></i> {{ trans('messages.notifications.empty') }}
                    </div>
                </div>
            </li>

            <li class="item nav-item dropdown">
                <a class="nav-link dropdown-toggle d-inline-flex align-items-center" href="#" id="notificationsDropdown" role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="notificationsDropdown">
                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                        {{ trans('messages.nav.profile') }}
                    </a>

                    @foreach(plugins()->getUserNavItems() ?? [] as $navId => $navItem)
                        <a class="dropdown-item" href="{{ route($navItem['route']) }}">
                            {{ trans($navItem['name']) }}
                        </a>
                    @endforeach

                    @if(Auth::user()->hasAdminAccess())
                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                            {{ trans('messages.nav.admin') }}
                        </a>
                    @endif

                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ trans('auth.logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</div>
