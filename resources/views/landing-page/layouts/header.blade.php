<div class="d-flex align-items-center justify-content-center">
    <a href="index.html" class="logo d-flex align-items-center justify-content-center">
        <img src="{{ asset('admin') }}/assets/img/logo.png" alt="" style="max-height: 35px">
        <span class="d-none d-lg-block">MangDaib</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn" ></i>
</div><!-- End Logo -->

<div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
</div><!-- End Search Bar -->

<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
        
        <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
            </a>
        </li><!-- End Search Icon-->
        
        <li class="nav-item dropdown">
            
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                <span class="badge bg-primary badge-number">4</span>
            </a>
            
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                <li class="dropdown-header">
                    You have 4 new notifications
                    <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>Lorem Ipsum</h4>
                        <p>Quae dolorem earum veritatis oditseno</p>
                        <p>30 min. ago</p>
                    </div>
                </li>
                
                <li>
                    <hr class="dropdown-divider">
                </li>
                
                <li class="notification-item">
                    <i class="bi bi-x-circle text-danger"></i>
                    <div>
                        <h4>Atque rerum nesciunt</h4>
                        <p>Quae dolorem earum veritatis oditseno</p>
                        <p>1 hr. ago</p>
                    </div>
                </li>
                
                <li>
                    <hr class="dropdown-divider">
                </li>
                
                <li class="notification-item">
                    <i class="bi bi-check-circle text-success"></i>
                    <div>
                        <h4>Sit rerum fuga</h4>
                        <p>Quae dolorem earum veritatis oditseno</p>
                        <p>2 hrs. ago</p>
                    </div>
                </li>
                
                <li>
                    <hr class="dropdown-divider">
                </li>
                
                <li class="notification-item">
                    <i class="bi bi-info-circle text-primary"></i>
                    <div>
                        <h4>Dicta reprehenderit</h4>
                        <p>Quae dolorem earum veritatis oditseno</p>
                        <p>4 hrs. ago</p>
                    </div>
                </li>
                
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li class="dropdown-footer">
                    <a href="#">Show all notifications</a>
                </li>
                
            </ul>
            
        </li>
        
        <li class="nav-item dropdown pe-3">
                
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                @if (empty(Auth::user()->gambar)) 
                <img src="{{ url('/admin/assets/img/default_gambar.png') }}" alt="Profile" class="rounded-circle" 
                style="width: 38px; height: 120px; border-radius: 50%">
                @else
                    <img src="{{ url('/storage/'.Auth::user()->gambar) }}" alt="Profile" class="rounded-circle" 
                    style="width: 38px; height: 100px; border-radius: 40%">
                @endif
                <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
            </a><!-- End Profile Iamge Icon -->
                
            
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                    <h6>{{ auth()->user()->name }}</h6>
                    <span>{{ auth()->user()->name }}</span>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                
                <li>
                    {{-- @if (Auth::user()->level == 1)
                    <a class="dropdown-item d-flex align-items-center" href="{{ url('/admin/profil') }}">
                        <i class="bi bi-person"></i>
                        <span>Profil Saya</span>
                    </a>     
                    @else
                    <a class="dropdown-item d-flex align-items-center" href="{{ url('/dokter/profil') }}">
                        <i class="bi bi-person"></i>
                        <span>Profil Saya</span>
                    </a>
                    @endif --}}
                    <a class="dropdown-item d-flex align-items-center" href="{{ url('/profil') }}">
                        <i class="bi bi-person"></i>
                        <span>Profil Saya</span>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                
                {{-- <li>
                    <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                        <i class="bi bi-gear"></i>
                        <span>Account Settings</span>
                    </a>
                </li> --}}
    
                
                {{-- <li>
                    <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                        <i class="bi bi-question-circle"></i>
                        <span>Bantuan?</span>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li> --}}
                
                <li>
                    <a href="{{ url('/logout') }}">
                        <button type="submit" class="dropdown-item d-flex align-items-center">
                            <i class="bi bi-box-arrow-right"></i>
                            Keluar
                        </button>
                    </a>
                </li>
                
            </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

    </ul>
</nav><!-- End Icons Navigation -->

    