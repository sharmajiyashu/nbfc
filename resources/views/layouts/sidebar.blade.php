


<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto" style="background-color: brown;
            width: 100%;
            padding: 10px 0px 0px 0px;"><a class="navbar-brand" href="{{ route('dashboard') }}">
                    <h2 class="brand-text">KAFL</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ \Request::is('/') ? 'active' : ''  }}"><a class="d-flex align-items-center" href="{{ url('/') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">DASHBOARD</span><span class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>
                
            </li>

            <li class=" nav-item {{ Request::routeIs('enquires.index', 'enquires.edit','enquires.create','application-form', 'master.payment-mode.edit','master.payment-mode.create','master.order-status.index', 'master.order-status.edit','master.order-status.create') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="Invoice">CUSTOMER ENQUIRY</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('enquires.index', 'enquires.edit','enquires.create','application-form') ? 'active' : '' }} " href="{{ route('enquires.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> ENQUIRY LIST</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create','master.payment-mode.index', 'master.payment-mode.edit','master.payment-mode.create','master.order-status.index', 'master.order-status.edit','master.order-status.create') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="Invoice">CUSTOMER <br> MANAGEMENT</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> CUSTOMER LIST</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create','master.payment-mode.index', 'master.payment-mode.edit','master.payment-mode.create','master.order-status.index', 'master.order-status.edit','master.order-status.create') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="Invoice">PAYROLL  AND PAYOUT</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Employee <br> Management</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Staff Attendence</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Leave Management</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Salary Management</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create','master.payment-mode.index', 'master.payment-mode.edit','master.payment-mode.create','master.order-status.index', 'master.order-status.edit','master.order-status.create') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="Invoice">Gold Loan</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> CALCULATOR</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> APPLICATIONS</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> DISBURSEMENTS</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> ACCOUNTS</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create','master.payment-mode.index', 'master.payment-mode.edit','master.payment-mode.create','master.order-status.index', 'master.order-status.edit','master.order-status.create') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="Invoice">Group Loan</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> CALCULATOR</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> APPLICATIONS</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> DISBURSEMENTS</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> ACCOUNTS</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create','master.payment-mode.index', 'master.payment-mode.edit','master.payment-mode.create','master.order-status.index', 'master.order-status.edit','master.order-status.create') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="Invoice">VEHICLE LOAN</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> CALCULATOR</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> APPLICATIONS</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> DISBURSEMENTS</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> ACCOUNTS</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create','master.payment-mode.index', 'master.payment-mode.edit','master.payment-mode.create','master.order-status.index', 'master.order-status.edit','master.order-status.create') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="Invoice">PERSONAL LOAN</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> CALCULATOR</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> APPLICATIONS</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> DISBURSEMENTS</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> ACCOUNTS</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create','master.payment-mode.index', 'master.payment-mode.edit','master.payment-mode.create','master.order-status.index', 'master.order-status.edit','master.order-status.create') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="Invoice">PROPERTY LOAN</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> CALCULATOR</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> APPLICATIONS</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> DISBURSEMENTS</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> ACCOUNTS</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('loan_application_approvel', 'master.payment-status.edit','master.payment-status.create','master.payment-mode.index', 'master.payment-mode.edit','master.payment-mode.create','master.order-status.index', 'master.order-status.edit','master.order-status.create') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="Invoice">LOAN APPROVAL</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('loan_application_approvel', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="{{ route('loan_application_approvel') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> LOAN APPLICATION <br>APPROVAL</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> FORECLOSER  APPROVAL</span></a>
                    </li>

                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create','master.payment-mode.index', 'master.payment-mode.edit','master.payment-mode.create','master.order-status.index', 'master.order-status.edit','master.order-status.create') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="Invoice">Report</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Member-Report</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Loan-Type-Report</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Loan-Report</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Upcomig-Emi-Report</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create','master.payment-mode.index', 'master.payment-mode.edit','master.payment-mode.create','master.order-status.index', 'master.order-status.edit','master.order-status.create') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="Invoice">COLLECT EMI</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('master.payment-status.index', 'master.payment-status.edit','master.payment-status.create') ? 'active' : '' }} " href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Collect-Emi</span></a>
                    </li>
                </ul>
            </li>

            
            
        
        </ul>
    </div>
</div>
<!-- END: Main Menu-->