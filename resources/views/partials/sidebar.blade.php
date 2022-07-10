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
        <li class="{{ Request::is('file_application/index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('file_application.index') }}">
                <i class="fas fa-file-export"></i>
                <span>@lang('app.file_application')</span>
            </a>
        </li>
        @permission('file_transaction.view')
            <li class="{{ Request::is('file_transaction/') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('file_application.index') }}">
                    <i class="fas fa-right-left"></i>
                    <span>@lang('app.file_transaction')</span>
                </a>
            </li>
        @endpermission
        {{-- <li class="{{ Request::is('laboratory*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('laboratory.list') }}">
                <i class="fas fa-industry"></i> 
                 <span>@lang('app.laboratory')</span>
            </a>
        </li>
       <li class="nav-item dropdown {{ Request::is('registration*') || Request::is('validation*') || Request::is('approval*') || Request::is('reporting*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-warehouse"></i> <span>@lang('app.in_house')</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Request::is('registration*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('registration.list') }}">Registration</a>
                </li>
                <li class="{{ Request::is('validation*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('validation.list') }}">Validation</a>
                </li>
                <li class="{{ Request::is('approval*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('approval.list') }}">Approval</a>
                </li>
                <li class="{{ Request::is('reporting*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('reporting.list') }}">Reporting</a>
                </li>
            </ul>
        </li>
         <li class="nav-item dropdown {{ Request::is('customer_sas*') || Request::is('customer_invoice*') || Request::is('customer_spec*') || Request::is('customer_cer*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i> <span>@lang('app.user_interface')</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Request::is('customer_sas*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customer_sas.list') }}">Customer Satisfaction</a>
                </li>
                <li class="{{ Request::is('customer_invoice*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customer_invoice.list') }}">Invoices</a>
                </li>
                <li class="{{ Request::is('customer_spec*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customer_spec.list') }}">Specification for Quotation</a>
                </li>
                <li class="{{ Request::is('customer_cer*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customer_cer.list') }}">Certificated Tracking</a>
                </li>
            </ul>
        </li>
        <li class="{{ Request::is('lab_instrument*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('lab_instrument.list') }}">
                <i class="fas fa-vials"></i> 
                 <span>@lang('app.laboratory_instru')</span>
            </a>
        </li>
        <li class="{{ Request::is('data_analysis*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('data_analysis.list') }}">
                <i class="fas fa-chart-area"></i> 
                 <span>@lang('app.data_analysis')</span>
            </a>
        </li>
        <li class="{{ Request::is('tender*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('tender.list') }}">
                <i class="fas fa-desktop"></i> 
                 <span>@lang('app.tender_monitor')</span>
            </a>
        </li>
        <li class="{{ Request::is('inventory*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('inventory.list') }}">
                <i class="fas fa-dolly-flatbed"></i> 
                 <span>@lang('app.iventory_consumable')</span>
            </a>
        </li>
        <li class="{{ Request::is('document*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('document.list') }}">
                <i class="fas fa-file-alt"></i> 
                 <span>@lang('app.iso_control')</span>
            </a>
        </li>
        <li class="{{ Request::is('certificate*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('certificate.list') }}">
                <i class="fas fa-certificate"></i> 
                 <span>Certificate Library</span>
            </a>
        </li>
        <li class="nav-item dropdown {{ Request::is('sampling*') || Request::is('filtration*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-wrench"></i> <span>Outside Services</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Request::is('sampling*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('sampling.list') }}">Sampling</a>
                </li>
                <li class="{{ Request::is('filtration*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('filtration.list') }}">Filtration</a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown {{ Request::is('product-etods-kit*') || Request::is('product-rubber-adaptor*')? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-chart-line"></i> <span>Product Commercialization</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Request::is('product-etods-kit*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('product-etods-kit.list') }}">EtODS Sampling Kit</a>
                </li>
                <li class="{{ Request::is('product-rubber-adaptor*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('product-rubber-adaptor.list') }}">Rubber Adaptor</a>
                </li>
            </ul>
        </li>
        <li class="{{ Request::is('quality-control') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('quality-control.list') }}">
                <i class="fas fa-check-square"></i> 
                 <span>Quality Control</span>
            </a>
        </li>
        <li class="{{ Request::is('quality-assurance') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('quality-assurance.list') }}">
                <i class="fas fa-binoculars"></i> 
                 <span>Quality Assurance</span>
            </a>
        </li>
        <li class="{{ Request::is('financial') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('financial.list') }}">
                <i class="fas fa-money-bill-wave-alt"></i> 
                 <span>Financial Management</span>
            </a>
        </li>
        <li class="nav-item dropdown {{ Request::is('training-record*') || Request::is('training-supplier-record*') || Request::is('csi-record*')? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-people-carry"></i> <span>Staff Training</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Request::is('training-record*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('training-record.list') }}">Training Record</a>
                </li>
                <li class="{{ Request::is('training-supplier-record*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('training-supplier-record.list') }}">Supplier Record</a>
                </li>
                <li class="{{ Request::is('csi-record*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('csi-record.list') }}">CSI Record</a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown {{ Request::is('waste-record*') || Request::is('waste-supplier-record*')? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-people-carry"></i> <span>Waste Management</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Request::is('waste-record*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('waste-record.list') }}">Scheduling</a>
                </li>
                <li class="{{ Request::is('waste-supplier-record*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('waste-supplier-record.list') }}">Supplier Record</a>
                </li>
            </ul>
        </li>
        <li class="{{ Request::is('staff-performance') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('staff-performance.list') }}">
                <i class="fas fa-dumbbell"></i> 
                 <span>Staff Performance</span>
            </a>
        </li>
        <li class="menu-header">Administration</li> --}}
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
                <li class="{{ Request::is('activity*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('activity.index') }}">
                        <i class="fas fa-server"></i>
                        <span>@lang('app.activity_log')</span>
                    </a>
                </li>
            @endpermission
            <li
                class="nav-item dropdown {{ Request::is('role*') || Request::is('permission*') || Request::is('administrator*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users-cog"></i> <span>Roles &
                        Permissions</span></a>
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
