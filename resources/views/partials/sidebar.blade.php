<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}">{{ setting('app_name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('dashboard') }}">L6</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::is('/') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-columns"></i> 
                 <span>@lang('app.dashboard')</span>
            </a>
        </li>
        <li class="menu-header">Management</li>
        <li class="{{ Request::is('content*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('content.list') }}">
                <i class="fas fa-industry"></i> 
                 <span>@lang('app.laboratory')</span>
            </a>
        </li>
        <li class="{{ Request::is('content*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('content.list') }}">
                <i class="fa fa-warehouse"></i>
                 <span>@lang('app.in_house')</span>
            </a>
        </li>
        <li class="{{ Request::is('content*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('content.list') }}">
                <i class="fas fa-user"></i> 
                 <span>@lang('app.user_interface')</span>
            </a>
        </li>
        <li class="{{ Request::is('content*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('content.list') }}">
                <i class="fas fa-vials"></i> 
                 <span>@lang('app.laboratory_instru')</span>
            </a>
        </li>
        <li class="{{ Request::is('content*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('content.list') }}">
                <i class="fas fa-chart-area"></i> 
                 <span>@lang('app.data_analysis')</span>
            </a>
        </li>
        <li class="{{ Request::is('content*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('content.list') }}">
                <i class="fas fa-desktop"></i> 
                 <span>@lang('app.tender_monitor')</span>
            </a>
        </li>
        <li class="{{ Request::is('content*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('content.list') }}">
                <i class="fas fa-dolly-flatbed"></i> 
                 <span>@lang('app.iventory_consumable')</span>
            </a>
        </li>
        <li class="{{ Request::is('content*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('content.list') }}">
                <i class="fas fa-file-alt"></i> 
                 <span>@lang('app.iso_control')</span>
            </a>
        </li>
       
      
        <li class="menu-header">Administration</li>
        @permission(['roles.manage', 'permissions.manage'])
        @permission('users.manage')
        <li class="{{ Request::is('user*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.list') }}">
                <i class="fas fa-users"></i> 
                <span>@lang('app.users')</span>
            </a>
        </li>
        @endpermission   

        @permission('users.activity')
        <li class="{{ Request::is('activity*') ? 'active' : ''  }}">
            <a class="nav-link" href="{{ route('activity.index') }}">
                <i class="fas fa-server"></i> 
                <span>@lang('app.activity_log')</span>
            </a>
        </li>
        @endpermission        
        <li class="nav-item dropdown {{ Request::is('role*') || Request::is('permission*') || Request::is('administrator*')? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-users-cog"></i> <span>Roles & Permissions</span></a>
            <ul class="dropdown-menu">
                @permission('roles.manage')
                <li class="{{ Request::is('role*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('role.index') }}">@lang('app.roles')</a>
                </li>
                @endpermission
                @permission('permissions.manage')
                <li class="{{ Request::is('permission*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('permission.index') }}">@lang('app.permissions')</a>
                </li>
                @endpermission
            </ul>
        </li>        
        @endpermission 

        @permission(['settings.general', 'settings.auth', 'settings.notifications'], false)
        <li class="menu-header">Settings</li>
        <li class="nav-item dropdown {{ Request::is('settings*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i> <span>Settings</span></a>
            <ul class="dropdown-menu">
                @permission('settings.general')
                <li class="{{ Request::is('settings') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('settings.general') }}">@lang('app.general')</a>
                </li>
                @endpermission
                @permission('settings.auth')
                <li class="{{ Request::is('settings/auth*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('settings.auth') }}">@lang('app.auth_and_registration')</a>
                </li>
                @endpermission
                @permission('settings.notifications')
                <li class="{{ Request::is('settings/notifications*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('settings.notifications') }}">@lang('app.notifications')</a>
                </li>
                @endpermission
            </ul>
        </li>
        @endpermission        

     </ul>
</aside>
