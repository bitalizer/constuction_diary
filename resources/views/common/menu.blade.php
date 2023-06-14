<div id="left" class="fixed">
    <div class="menu_scroll left_scrolled">
        <ul id="menu">
            <li class="{!! (Request::is('events*')? 'active':"") !!}">
                <a href="{{ URL::to('events') }}">
                    <i class="fa fa-calendar"></i>
                    <span class="link-title menu_hide">Sündmused</span>
                    <span class="badge badge-pill badge-warning float-right calendar_badge menu_hide">10</span>
                </a>
            </li>
            <li class="dropdown_menu {!! (Request::is('documents*')? 'active':"") !!}">
                <a href="javascript:">
                    <i class="fa fa-paperclip"></i>
                    <span class="link-title menu_hide">Dokumendid</span>
                    <span class="fa arrow menu_hide"></span>
                </a>
                <ul>
                    @permission('store-diary')
                    <li class="{!! (Request::is('documents/diary/add')? 'active':"") !!}">
                        <a href="{{ URL::to('documents/diary/add') }}">
                            <i class="fa fa-angle-right"></i>
                            <span class="link-title">Päeviku täitmine</span>
                        </a>
                    </li>
                    @endpermission
                    @permission('view-diaries')
                    <li class="{!! (Request::is('documents/diary')? 'active':"") !!}">
                        <a href="{{ URL::to('documents/diary') }}">
                            <i class="fa fa-angle-right"></i>
                            <span class="link-title">Päevikute nimekiri</span>
                        </a>
                    </li>
                    @endpermission
                </ul>
            </li>
            @permission('view-employees')
            <li class="dropdown_menu {!! Request::is('employees*') || Request::is('positions*') ? 'active' : '' !!}">
                <a href="javascript:">
                    <i class="fa fa-users"></i>
                    <span class="link-title menu_hide">Töötajate haldamine</span>
                    <span class="fa arrow menu_hide"></span>
                </a>
                <ul>
                    <li class="{!! (Request::is('employees')? 'active':"") !!}">
                        <a href="{{ URL::to('employees') }}">
                            <i class="fa fa-angle-right"></i>
                            <span class="link-title">Töötajad</span>
                        </a>
                    </li>
                    @permission('view-positions')
                    <li class="{!! (Request::is('positions')? 'active':"") !!}">
                        <a href="{{ URL::to('positions') }}">
                            <i class="fa fa-angle-right"></i>
                            <span class="link-title">Positsioonid</span>
                        </a>
                    </li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('view-projects')
            <li {!! (Request::is('projects*')? 'class="active"':"") !!}>
                <a href="{{ URL::to('projects') }} ">
                    <i class="fa fa-briefcase"></i>
                    <span class="link-title menu_hide">Objektid</span>
                </a>
            </li>
            @endpermission
            @permission('view-accounting')
            <li class="dropdown_menu {!! (Request::is('accounting/*')? 'active':"") !!}">
                <a href="javascript:">
                    <i class="fa fa-book"></i>
                    <span class="link-title menu_hide">Raamatupidamine</span>
                    <span class="fa arrow menu_hide"></span>
                </a>
                <ul>
                    <li class="{!! (Request::is('accounting/payroll')? 'active':"") !!}">
                        <a href="{{ URL::to('accounting/payroll') }}">
                            <i class="fa fa-angle-right"></i>
                            <span class="link-title">Töötasu</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endpermission
            @permission('view-attendances')
            <li class="dropdown_menu {!! (Request::is('attendances*')? 'active':"") !!}">
                <a href="javascript:">
                    <i class="fa fa-street-view"></i>
                    <span class="link-title menu_hide">Kohalolek</span>
                    <span class="fa arrow menu_hide"></span>
                </a>
                <ul>
                    <li class="{!! (Request::is('attendances/calendar')? 'active':"") !!}">
                        <a href="{{ URL::to('attendances/calendar') }}">
                            <i class="fa fa-angle-right"></i>
                            <span class="link-title">Kohaloleku kalender</span>
                        </a>
                    </li>
                    <li class="{!! (Request::is('attendances/table')? 'active':"") !!}">
                        <a href="{{ URL::to('attendances/table') }}">
                            <i class="fa fa-angle-right"></i>
                            <span class="link-title">Kohaloleku nimeriki</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endpermission
            @permission('manage-settings')
            <li class="dropdown_menu {!! (Request::is('settings*')? 'active':"") !!}">
                <a href="javascript:">
                    <i class="fa fa-cogs"></i>
                    <span class="link-title menu_hide">Seaded</span>
                    <span class="fa arrow menu_hide"></span>
                </a>
                <ul>
                    <li class="{!! (Request::is('settings/general')? 'active':"") !!}">
                        <a href="{{ URL::to('settings/general') }}">
                            <i class="fa fa-angle-right"></i>
                            <span class="link-title">Üldised seaded</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endpermission
        </ul>
        <!-- /#menu -->
    </div>
</div>
<!-- /#left -->