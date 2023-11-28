<nav class="navbar navbar-main navbar-expand-sm shadow-none" id="navbarBlur" data-scroll="true">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            @yield('breadcrumbs')
        </nav>
        <div class="collapse navbar-collapse" id="navbar" style="overflow: visible !important;">
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
                                {{ auth()->user()->guru->nama ?? auth()->user()->username }}
                            @elseif (auth()->user()->hasRole('siswa'))
                                {{ auth()->user()->siswa->nama ?? auth()->user()->username }}
                            @elseif (auth()->user()->hasRole('kepsek'))
                                {{ auth()->user()->guru->nama ?? auth()->user()->username }}
                            @else
                                {{ auth()->user()->username }}
                            @endif
                        </span>
                    </strong>
                </button>
                <ul class="dropdown-menu" aria-labelledby="profile-dropdown">
                    <li><a class="dropdown-item" href="/option/change-password">Edit password</a></li>
                    @if (count(array_diff(explode(',', auth()->user()->role), ['root'])) > 1)
                        <li><a href="javacript(0)" data-bs-toggle="modal" data-bs-target="#update-navbar-role-modal"
                                class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"
                                onclick="navbarSetCheckedRole()">Ganti Role
                            </a>
                        </li>
                    @endif
                    <li><a class="dropdown-item" href="/logout"
                            onclick="return confirm('Apakah anda yakin akan keluar?')">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    @if (count(array_diff(explode(',', auth()->user()->role), ['root'])) > 1)
        <div class="modal fade" id="update-navbar-role-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Ganti role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('set_role') }}" class="row g-3 px-4" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div style="display: flex;flex-wrap: wrap; column-gap: 10px;row-gap: 5px;">
                                @foreach (explode(',', auth()->user()->role) as $value_role)
                                    @if ($value_role != 'root')
                                        <div style="display: flex; column-gap: 5px;">
                                            <input type="radio" name="role" value="{{ $value_role }}"
                                                id="navbar-role-{{ $value_role }}"
                                                current-role = "{{ auth()->user()->current_role }}">
                                            <label style="margin: 0"
                                                for="navbar-role-{{ $value_role }}">{{ ucfirst($value_role) }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary"
                                    data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function navbarSetCheckedRole() {
                const input = document.querySelectorAll("#update-navbar-role-modal input[type='radio']");

                input.forEach(function(radio) {
                    if (radio.getAttribute('current-role') == radio.getAttribute('value')) {
                        radio.checked = true;
                        return;
                    }
                });
            }
        </script>
    @endif

</nav>
