<!--begin::Header Menu-->

<ul class="menu-nav ">
    <li class="menu-item {{ Route::currentRouteName() == 'home' ? 'menu-item-active' : '' }} " data-menu-toggle="click"
        aria-haspopup="true">
        <a href="{{ route('home') }}" class="menu-link">
            <i class="fa fa-home p-1"></i>
            <span class="menu-text">{{ trans('word.main-page') }}</span>
        </a>
    </li>


   @can('Setting')
        <li class="menu-item menu-item-submenu menu-item-rel  @if (Route::currentRouteName() == 'users.index' || Route::currentRouteName() == 'roles.index') menu-item-active @endif"
            data-menu-toggle="click" aria-haspopup="true">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class="fa fa-cog p-1"></i>
                <span class="menu-text">{{ trans('word.settings') }}</span>
            </a>
            <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                <ul class="menu-subnav">

                    @can('Setting')
                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                            <a href="javascript:;" class="menu-link menu-toggle">
                                <span class="svg-icon menu-icon">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\User.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <path
                                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path
                                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-text">{{ trans('word.users') }}</span>
                                <i class="menu-user"></i>
                            </a>
                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                <ul class="menu-subnav">
                                    @can('Users List')
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{ route('users.index') }}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-line">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">{{ trans('word.users') }}</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('Permissions List')
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{ route('roles.index') }}" class="menu-link">

                                                <i class="menu-bullet menu-bullet-line">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">{{ trans('word.permission') }}</span>
                                            </a>
                                        </li>
                                    @endcan

                                </ul>
                            </div>
                        </li>
                    @endcan

                </ul>
            </div>
        </li>
    @endcan


</ul>
<!--end::Header Nav-->
