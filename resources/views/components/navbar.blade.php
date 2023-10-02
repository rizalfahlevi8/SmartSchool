<nav class="navbar navbar-main navbar-expand-sm shadow-none" id="navbarBlur" data-scroll="true">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            @yield('breadcrumbs')
        </nav>
        <div class="collapse navbar-collapse" id="navbar">
            <div class="dropdown show"
                style="justify-self: flex-end; max-width: fit-content; margin: 0; margin-left: auto">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                    id="profile-dropdown" aria-haspopup="true" aria-expanded="false">
                    {{-- <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                        class="rounded-circle me-2"> --}}
                    <strong>
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">
                            @if (auth()->user()->hasRole('admin'))
                                {{ auth()->user()->username }}
                            @elseif (auth()->user()->hasRole('guru'))
                                {{ auth()->user()->guru->nama }}
                            @elseif (auth()->user()->hasRole('siswa'))
                                {{ auth()->user()->siswa->nama }}
                            @elseif (Auth::guard('kepsek')->check())
                                {{ Auth::guard('kepsek')->user()->nama }}
                            @endif
                        </span>
                    </strong>
                </button>
                <ul class="dropdown-menu" aria-labelledby="profile-dropdown">
                    <li><a class="dropdown-item" href="editpassword">Edit password</a></li>
                    <li><a class="dropdown-item" href="/logout"
                            onclick="return confirm('Apakah anda yakin akan keluar?')">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    </div>
</nav>
