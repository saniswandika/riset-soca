
<li class="nav-item">
    <a href="{{ route('jadwals.index') }}" class="nav-link {{ Request::is('jadwals*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Jadwals</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('rekom-dtks.index') }}" class="nav-link {{ Request::is('rekomDtks*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Rekom Dtks</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('suketDtks.index') }}" class="nav-link {{ Request::is('suketDtks*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Suket Dtks</p>
    </a>
</li>
