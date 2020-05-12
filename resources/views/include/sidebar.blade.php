<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="#"><img src="{{ asset('/storage/users/'.$user->image) }}" width="38" height="38" class="rounded-circle" alt=""></a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ $user->username }}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-pin font-size-sm"></i> &nbsp;{{ $user->address }}
                        </div>

                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- side bar -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                        <i class="icon-home4"></i>
                        <span>
									{{ trans('labels.admin.dashboard')}}
								</span>
                    </a>
                </li>
                @if ($user->can('view_user_block'))
                    <li class="nav-item nav-item-submenu">

                        <a href="#" class="nav-link"><i class="icon icon-user"></i> <span>{{ trans('labels.admin.user.name')}}</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                            {{--<li class="nav-item"><a href="index.html" class="nav-link active">Default layout</a></li>--}}
                            @if ($user->can('view-user'))
                                <li class="nav-item"><a href="{{route('user.index')}}" class="nav-link">{{ trans('labels.admin.user.list')}}</a></li>
                            @endif
                            @if ($user->can('add-user'))
                                <li class="nav-item"><a href="{{route('user.add')}}" class="nav-link">{{ trans('labels.admin.user.add')}}</a></li>
                            @endif
                            {{--@if ($user->can('edit-user'))--}}
                                {{--<li class="nav-item"><a href="{{route('role.index')}}" class="nav-link">Role</a></li>--}}
                            {{--@endif--}}
                            {{--@if ($user->can('delete-user'))--}}
                                {{--<li class="nav-item"><a href="{{route('role.index')}}" class="nav-link">Role</a></li>--}}
                            {{--@endif--}}
                        </ul>
                    </li>
                @endif
                <li class="nav-item nav-item-submenu">

                    <a href="#" class="nav-link"><i class="icon icon-user"></i> <span>{{ trans('labels.admin.role.name')}}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        @if ($user->can('view-role'))
                            <li class="nav-item"><a href="{{route('role.index')}}" class="nav-link">{{ trans('labels.admin.role.list')}}</a></li>
                        @endif
                        @if ($user->can('add-role'))
                            <li class="nav-item"><a href="{{route('role.add')}}" class="nav-link">{{ trans('labels.admin.role.add')}}</a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">

                    <a href="#" class="nav-link"><i class="icon icon-user"></i> <span>{{ trans('labels.admin.permission.name')}}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        @if ($user->can('view-permission'))
                            <li class="nav-item"><a href="{{route('permission.index')}}" class="nav-link">{{ trans('labels.admin.permission.list')}}</a></li>
                        @endif
                        @if ($user->can('add-permission'))
                            <li class="nav-item"><a href="{{route('permission.add')}}" class="nav-link">{{ trans('labels.admin.permission.add')}}</a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">

                    <a href="#" class="nav-link"><i class="icon icon-user"></i> <span>{{ trans('labels.admin.category.name')}}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        @if ($user->can('view-category'))
                            <li class="nav-item"><a href="{{route('category.index')}}" class="nav-link">{{ trans('labels.admin.category.list')}}</a></li>
                        @endif
                        @if ($user->can('add-category'))
                            <li class="nav-item"><a href="{{route('category.add')}}" class="nav-link">{{ trans('labels.admin.category.add')}}</a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">

                    <a href="#" class="nav-link"><i class="icon icon-user"></i> <span>{{ trans('labels.admin.subcategory.name')}}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        @if ($user->can('view-subcategory'))
                            <li class="nav-item"><a href="{{route('sub_category.index')}}" class="nav-link">{{ trans('labels.admin.subcategory.list')}}</a></li>
                        @endif
                        @if ($user->can('add-subcategory'))
                            <li class="nav-item"><a href="{{route('sub_category.add')}}" class="nav-link">{{ trans('labels.admin.subcategory.add')}}</a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">

                    <a href="#" class="nav-link"><i class="icon icon-user"></i> <span>{{ trans('labels.admin.news.name')}}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        @if ($user->can('view-news'))
                            <li class="nav-item"><a href="{{route('ne_ws.index')}}" class="nav-link">{{ trans('labels.admin.news.list')}}</a></li>
                        @endif
                        @if ($user->can('add-news'))
                            <li class="nav-item"><a href="{{route('ne_ws.add')}}" class="nav-link">{{ trans('labels.admin.news.add')}}</a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">

                    <a href="#" class="nav-link"><i class="icon icon-user"></i> <span>{{ trans('labels.admin.gallery.name')}}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        @if ($user->can('view-gallery'))
                            <li class="nav-item"><a href="{{route('gallery.index')}}" class="nav-link">{{ trans('labels.admin.gallery.list')}}</a></li>
                        @endif
                        @if ($user->can('add-gallery'))
                            <li class="nav-item"><a href="{{route('gallery.add')}}" class="nav-link">{{ trans('labels.admin.gallery.add')}}</a></li>
                        @endif
                            @if ($user->can('add-video'))
                                <li class="nav-item"><a href="{{route('videos.index')}}" class="nav-link">{{ trans('labels.admin.video.add')}}</a></li>
                            @endif
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">

                    <a href="#" class="nav-link"><i class="icon icon-user"></i> <span>{{ trans('labels.admin.advertising.name')}}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        @if ($user->can('view-advertising'))
                            <li class="nav-item"><a href="{{route('advertise.index')}}" class="nav-link">{{ trans('labels.admin.advertising.list')}}</a></li>
                        @endif
                        @if ($user->can('add-advertising'))
                            <li class="nav-item"><a href="{{route('advertise.add')}}" class="nav-link">{{ trans('labels.admin.advertising.add')}}</a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">

                    <a href="#" class="nav-link"><i class="icon icon-user"></i> <span>{{ trans('labels.admin.popup.name')}}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        @if ($user->can('view-popup'))
                            <li class="nav-item"><a href="{{route('popup.index')}}" class="nav-link">{{ trans('labels.admin.popup.list')}}</a></li>
                        @endif
                        @if ($user->can('add-popup'))
                            <li class="nav-item"><a href="{{route('popup.add')}}" class="nav-link">{{ trans('labels.admin.popup.add')}}</a></li>
                        @endif
                    </ul>
                </li>


                <!-- /page kits -->

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>