<div class="flex-shrink-0 p-3 bg-transparent" style="">
    <a href="/" class="d-flex align-items-center pb-3 my-4 link-dark text-decoration-none"
        style="border-bottom: 2px solid white;">
        <div class="text-white w-auto "
            style="display: flex; align-items: center; justify-content: start; column-gap: 10px">
            <i class="material-icons opacity-10" style="font-size:35px">school</i> <span
                class="ms-1 font-weight-bold text-white" style="font-size:23px">Smart School</span>
        </div>
    </a>
    <ul class="list-unstyled ps-0" style="width: 100%">
        <li class="mb-1" style="">
            <a class="btn rounded text-white font-weight-bold {{ Request::is('dashboard*') ? 'bg-gradient-primary ' : '' }}"
                style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px"
                href="/dashboard"> <span class="material-symbols-outlined">dashboard</span> Dashboard</a>
        </li>
        @if (auth()->user()->hasRole('admin'))
            <li class="mb-1" style="width: 100%">
                <button class="btn align-items-center rounded collapsed text-white font-weight-bold"
                    style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px;"
                    data-bs-toggle="collapse" data-bs-target="#master-collapse" aria-expanded="true">
                    <span class="material-symbols-outlined"> database </span> Master <i
                        class="material-icons opacity-10 ms-auto" style="">expand_more</i>
                </button>
                <div class="collapse {{ Request::is('administrasi/guru*') || Request::is('administrasi/siswa*') || Request::is('akademik/mapel*') || Request::is('sarana/kelas*') || Request::is('sarana/ruang*') || Request::is('sarana/barang*') ? 'show' : '' }}"
                    id="master-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="link-light rounded mb-1 {{ Request::is('administrasi/guru*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/administrasi/guru"><i
                                    class="material-icons opacity-10 mx-2">groups</i> Data
                                Guru</a></li>
                        <li><a class="link-light rounded mb-1 {{ Request::is('administrasi/siswa*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/administrasi/siswa"><i
                                    class="material-icons opacity-10 mx-2">groups</i> Data
                                Siswa</a></li>
                        <li><a class="link-light rounded mb-1 {{ Request::is('akademik/mapel*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/akademik/mapel"><i
                                    class="material-icons opacity-10 mx-2">task</i> Data Mata
                                Pelajaran</a></li>
                        <li><a class="link-light rounded mb-1 {{ Request::is('sarana/kelas*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/sarana/kelas"><i
                                    class="material-icons opacity-10 mx-2">task</i> Data Kelas</a>
                        </li>
                        <li><a class="link-light rounded mb-1 {{ Request::is('sarana/ruang*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/sarana/ruang"><i
                                    class="material-icons opacity-10 mx-2">task</i> Data Ruang</a>
                        </li>
                        <li><a class="link-light rounded mb-1 {{ Request::is('sarana/barang*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/sarana/barang"><i
                                    class="material-icons opacity-10 mx-2">task</i> Data Barang</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="mb-1" style="width: 100%">
                <button class="btn align-items-center rounded collapsed text-white font-weight-bold"
                    style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px"
                    data-bs-toggle="collapse" data-bs-target="#kurikulum-collapse" aria-expanded="false">
                    <span class="material-symbols-outlined">
                        event_note
                    </span>
                    Kurikulum <i class="material-icons opacity-10 ms-auto">expand_more</i>
                </button>
                <div class="collapse {{ Request::is('akademik/jadwal*') ? 'show' : '' }}" id="kurikulum-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="link-light rounded mb-1 {{ Request::is('akademik/jadwal*') ? 'bg-gradient-primary ' : '' }}"
                                href="/akademik/jadwal"><i class="material-icons opacity-10 mx-2">receipt_long</i>
                                Jadwal Pelajaran</a></li>
                    </ul>
                </div>
            </li>
            <li class="mb-1" style="width: 100%">
                <button class="btn align-items-center rounded collapsed text-white font-weight-bold"
                    style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px;"
                    data-bs-toggle="collapse" data-bs-target="#kesiswaan-collapse" aria-expanded="false">
                    <span class="material-symbols-outlined">
                        school
                    </span>
                    Kesiswaan <i class="material-icons opacity-10 ms-auto">expand_more</i>
                </button>
                <div class="collapse {{ Request::is('akademik/absensi*') ? 'show' : '' }}" id="kesiswaan-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="link-light rounded mb-1 {{ Request::is('akademik/absensi*') ? 'bg-gradient-primary ' : '' }}"
                                href="/akademik/absensi"> <i class="material-icons opacity-10 mx-2">receipt_long</i>
                                Presensi</a></li>
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <button class="btn align-items-center rounded collapsed text-white font-weight-bold"
                    style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px"
                    data-bs-toggle="collapse" data-bs-target="#sarpras-collapse" aria-expanded="false">
                    <span class="material-symbols-outlined">
                        architecture
                    </span>
                    Sapras <i class="material-icons opacity-10 ms-auto">expand_more</i>
                </button>
                <div class="collapse {{ Request::is('sarana/inventaris*') || Request::is('data-peminjaman*') ? 'show' : '' }}"
                    id="sarpras-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="link-light rounded mb-1 {{ Request::is('sarana/inventaris*') ? 'bg-gradient-primary ' : '' }}"
                                href="/sarana/inventaris"> <i class="material-icons opacity-10 mx-2">task</i>
                                Inventaris</a></li>
                    </ul>
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="link-light rounded mb-1 {{ Request::is('data-peminjaman*') ? 'bg-gradient-primary ' : '' }}"
                                href="/data-peminjaman"> <i class="material-icons opacity-10 mx-2">task</i>
                                Peminjaman</a></li>
                    </ul>
                </div>
            </li>
            <li class="mb-1" style="width: 100%">
                <button class="btn align-items-center rounded collapsed text-white font-weight-bold"
                    style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px"
                    data-bs-toggle="collapse" data-bs-target="#humas-collapse" aria-expanded="false">
                    <span class="material-symbols-outlined">
                        workspaces
                    </span>
                    Humas <i class="material-icons opacity-10 ms-auto">expand_more</i>
                </button>
                <div class="collapse" id="humas-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="link-light rounded mb-1" href="#"> <i
                                    class="material-icons opacity-10 ms-auto">groups</i> Tamu</a></li>
                    </ul>
                </div>
            </li>
        @endif
    </ul>
</div>
