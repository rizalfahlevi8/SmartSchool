<div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href=" /">
        <div class="text-white w-auto "
            style="display: flex; align-items: center; justify-content: start; column-gap: 10px">
            <i class="material-icons opacity-10" style="font-size:35px">school</i> <span
                class="ms-1 font-weight-bold text-white" style="font-size:23px">SIAKUR</span>
        </div>
    </a>
</div>
<hr class="horizontal light mt-0 mb-2">
<div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white {{ Request::is('dashboard*') ? 'bg-gradient-primary ' : '' }} "
                href="/dashboard">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">dashboard</i>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        @if (auth()->user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('administrasi/guru*') ? 'bg-gradient-primary ' : '' }}"
                    href="/administrasi/guru">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">groups</i>
                    </div>
                    <span class="nav-link-text ms-1">Data Guru</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('administrasi/siswa*') ? 'bg-gradient-primary ' : '' }}"
                    href="/administrasi/siswa">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">groups</i>
                    </div>
                    <span class="nav-link-text ms-1">Data Siswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('akademik/mapel*') ? 'bg-gradient-primary ' : '' }}"
                    href="/akademik/mapel">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">task</i>
                    </div>
                    <span class="nav-link-text ms-1">Data Mata Pelajaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('data-kelas*') ? 'bg-gradient-primary ' : '' }}"
                    href="/sarana/kelas">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">task</i>
                    </div>
                    <span class="nav-link-text ms-1">Data Kelas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('sarana/ruang*') ? 'bg-gradient-primary ' : '' }}"
                    href="/sarana/ruang">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">task</i>
                    </div>
                    <span class="nav-link-text ms-1">Data Ruang</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('sarana/barang*') ? 'bg-gradient-primary ' : '' }}"
                    href="/sarana/barang">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">task</i>
                    </div>
                    <span class="nav-link-text ms-1">Data Barang</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('sarana/inventaris*') ? 'bg-gradient-primary ' : '' }}"
                    href="/sarana/inventaris">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">task</i>
                    </div>
                    <span class="nav-link-text ms-1">Inventaris</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('akademik/jadwal*') ? 'bg-gradient-primary ' : '' }}"
                    href="/akademik/jadwal">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Jadwal Pelajaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('akademik/raport*') || Request::is('raport*') ? 'bg-gradient-primary ' : '' }}"
                    href="/akademik/raport-admin">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">document_scanner</i>
                    </div>
                    <span class="nav-link-text ms-1">Raport</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('data-peminjaman*') ? 'bg-gradient-primary ' : '' }}"
                    href="/data-peminjaman">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Peminjaman</span>
                </a>
            </li>
        @elseif(auth()->user()->hasRole('guru'))
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('data-jadwalguru') ? 'bg-gradient-primary ' : '' }} "
                    href="/data-jadwalguru/{{ auth()->user()->guru->id }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">description</i>
                    </div>
                    <span class="nav-link-text ms-1">Jadwal Mengajar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->segment(1) == 'data-inputnilai' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-nilai-atur' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-detail-nilai' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-input-nilai' ? 'bg-gradient-primary ' : '' }}"
                    href="/data-inputnilai/{{ auth()->user()->guru->id }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">grading</i>
                    </div>
                    <span class="nav-link-text ms-1">Input Nilai</span>
                </a>
            </li>
            @if (true)
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'data-raport' ? 'bg-gradient-primary ' : '' }}   {{ request()->segment(1) == 'data-raport-input' ? 'bg-gradient-primary ' : '' }} "
                        href="/data-raport">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">document_scanner</i>
                        </div>
                        <span class="nav-link-text ms-1">Input Raport</span>
                    </a>
                </li>
            @endif
        @elseif(auth()->user()->hasRole('siswa'))
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->segment(1) == 'data-jadwal' ? 'bg-gradient-primary ' : '' }} "
                    href="/akademik/jadwal-siswa">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">description</i>
                    </div>
                    <span class="nav-link-text ms-1">Jadwal Pelajaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                    {{ request()->segment(1) == 'data-raport' ? 'bg-gradient-primary ' : '' }}
                    {{ request()->segment(1) == 'data-raport-input' ? 'bg-gradient-primary ' : '' }}>
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">document_scanner</i>
                    </div>
                    <span class="nav-link-text ms-1">Raport</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/akademik/raport-siswa/uts">UTS</a>
                    </li>
                    <li><a class="dropdown-item" href="/data-raport-cetak-siswa/uas">UAS</a>
                    </li>


                </ul>
            </li>
        @endif
    </ul>
</div>
{{-- <div class="sidenav-footer position-absolute w-100 bottom-0 ">
    <div class="mx-3">
        <a class="btn bg-gradient-primary mt-4 w-100 font-weight-bold"
            onclick="return confirm('Apakah anda yakin akan keluar?')" href="/logout" type="button"><i
                class="fa fa-sign-out"></i> Keluar</a>
    </div>
</div> --}}
