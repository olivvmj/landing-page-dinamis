{{-- 
    sidebar admin 
    //segment (2) -> ex: admin/dashboard
    //segment (3) ->> ex: admin/masterdata(dropdown)/datauser
--}}
<ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
        <a class="nav-link {{ Request::segment("1") == "dashboard" ? '' : 'collapsed' }}" href="{{ url('/dashboard') }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <!-- End Dashboard Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('kelola-tentang.index') }}">
            <i class="bi bi-info-circle"></i>
            <span>Tentang Parkirkan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('kelola-solusi.index') }}">
            <i class="bi bi-lightbulb"></i>
            <span>Solusi Parkirkan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('kelola-manfaat.index') }}">
            <i class="bi bi-heart"></i>
            <span>Manfaat Parkirkan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('kelola-fitur.index') }}">
            <i class="bi bi-gear"></i>
            <span>Fitur Parkirkan</span>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/profil') }}">
            <i class="bi bi-person"></i>
            <span>Profil</span>
        </a>
    </li><!-- End Profile Page Nav -->
</ul>
