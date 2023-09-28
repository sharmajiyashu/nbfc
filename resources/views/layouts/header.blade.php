<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
                
                <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><h5 style="color: #000000bd;
                    font-weight: 900;">ACCOUNTS <span class="caret"></span></h5> </a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown">
                        <li class="scrollable-container media-list">
                            <a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <span class="fa fa-list-ul"></span>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Journal Entries</span></p>
                                        <small class="notification-text"> Receipt, Payment, Expenses, System entries</small>
                                    </div>
                                </div>
                            </a>

                            <a class="d-flex" href="{{ route('profit_loss') }}">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <span class="fa fa-inr"></span>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Profit and Loss (P & L)</span></p>
                                        <small class="notification-text"> Click here to see Profit and Loss statement</small>
                                    </div>
                                </div>
                            </a>

                            <a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <span class="fa fa-inr"></span>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Cash Deposit</span></p>
                                        <small class="notification-text"> Click here to Cash Deposit</small>
                                    </div>
                                </div>
                            </a>

                            <a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <span class="fa fa-inr"></span>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Cash Withdrawl</span></p>
                                        <small class="notification-text"> Click here to Cash Withdrawl</small>
                                    </div>
                                </div>
                            </a>

                            <a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <span class="fa fa-plus-circle"></span>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Ledgers</span></p>
                                        <small class="notification-text"> Create & manage ledger accounts</small>
                                    </div>
                                </div>
                            </a>

                            <a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <span class="fa fa-bar-chart"></span>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Balance Sheet</span></p>
                                        <small class="notification-text"> Click here to see Balance Sheet</small>
                                    </div>
                                </div>
                            </a>

                            <a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <span class="fa fa-balance-scale"></span>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Trial Balance</span></p>
                                        <small class="notification-text"> Display all accounts with balance</small>
                                    </div>
                                </div>
                            </a>

                            <a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <span class="fa fa-random"></span>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Income Statement</span></p>
                                        <small class="notification-text"> Click here to see income statement</small>
                                    </div>
                                </div>
                            </a>
                            
                        </li>
                    </ul>
                </li> 

                <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="dropdown"><h5 style="color: #000000bd;
                    font-weight: 900;">NEW JOURNAL ENTRY </h5> </a></li>

                <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><h5 style="color: #000000bd;
                    font-weight: 900;">DAILY COLLECTION  <span class="caret"></span></h5> </a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown">
                        <li class="scrollable-container media-list">
                            <a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <span class="fa fa-user-secret"></span>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Dashboard</span></p>
                                        <small class="notification-text"> Collection Overview</small>
                                    </div>
                                </div>
                            </a>
                            
                            
                        </li>
                    </ul>
                </li>
            </ul>
            
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            
           
            
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">    </span><span class="user-status" style="color: #000000;
                        font-weight: 900;">Yashu9079</span></div><span class="avatar"><img class="round" src="{{ asset('public/admin/app-assets/images/portrait/small/avatar-s-11.jpg')}}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                     <a class="dropdown-item" href="page-profile.html"><i class="me-50" data-feather="user"></i> Profile</a>
                    {{--<a class="dropdown-item" href="app-email.html"><i class="me-50" data-feather="mail"></i> Inbox</a>
                    <a class="dropdown-item" href="app-todo.html"><i class="me-50" data-feather="check-square"></i> Task</a>
                    <a class="dropdown-item" href="app-chat.html"><i class="me-50" data-feather="message-square"></i> Chats</a> --}}
                    {{-- <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="page-account-settings-account.html"><i class="me-50" data-feather="settings"></i> Settings</a>
                    <a class="dropdown-item" href="page-pricing.html"><i class="me-50" data-feather="credit-card"></i> Pricing</a>
                    <a class="dropdown-item" href="page-faq.html"><i class="me-50" data-feather="help-circle"></i> FAQ</a> --}}
                    <a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="me-50" data-feather="power"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="me-75" data-feather="alert-circle"></span><span>No results found.</span></div>
        </a></li>
</ul>
<!-- END: Header-->