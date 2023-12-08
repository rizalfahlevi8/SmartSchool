<div class="flex-shrink-0 p-3 bg-transparent" style="">
    <a href="/" class="d-flex align-items-center pb-3 my-4 link-dark text-decoration-none"
        style="border-bottom: 2px solid white; justify-content: center">
        <div class="text-white w-auto "
            style="display: flex; align-items: center; justify-content: center; column-gap: 3px">
            {{-- <img src="{{ asset('assets/img/web-icon-brain.png') }}" alt="HTML tutorial"
                style="height: 36px;filter:brightness(0%) invert(90%)"> --}}
            <img src="{{ asset('assets/img/web-icon-brain.png') }}" alt="HTML tutorial" style="height: 36px;">
            {{-- <span class="ms-1 font-weight-bold text-white" style="font-size:23px">Smart School</span> --}}
            <span class="ms-1 font-weight-bold"
                style="font-size: 24px; background-image: linear-gradient(to right, #0cb1d8, #00c4dc, #00d5d1, #00e4b8, #29f194);
                   -webkit-background-clip: text;color: transparent;">
                Smart School
            </span>

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
                <div class="collapse {{ Request::is('administrasi/guru*') || Request::is('administrasi/siswa*') || Request::is('akademik/mapel*') || Request::is('sarana/kelas*') || Request::is('sarana/ruang*') || Request::is('sarana/barang*') || Request::is('administrasi/users*') ? 'show' : '' }}"
                    id="master-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="link-light rounded mb-1 {{ Request::is('administrasi/users*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/administrasi/users"><i
                                    class="material-icons opacity-10 mx-2">groups</i> Data User</a>
                        </li>
                        <li><a class="link-light rounded mb-1 {{ Request::is('administrasi/guru*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/administrasi/guru"><i
                                    class="material-icons opacity-10 mx-2">groups</i> Data
                                Guru</a></li>
                        <li><a class="link-light rounded mb-1 {{ Request::is('administrasi/siswa*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/administrasi/siswa"><i
                                    class="material-icons opacity-10 mx-2">groups</i> Data
                                Siswa</a></li>
                                <li><a class="link-light rounded mb-1 {{ Request::is('administrasi/usermoodle*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/administrasi/usermoodle"><i
                                    class="material-icons opacity-10 mx-2">groups</i> Data User Moodle</a>
                                    </li>
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
                <div class="collapse {{ Request::is('akademik/jadwal*') || Request::is('akademik/kalender*') ? 'show' : '' }}"
                    id="kurikulum-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="link-light rounded mb-1 {{ Request::is('akademik/jadwal*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/akademik/jadwal"><i
                                    class="material-icons opacity-10 mx-2">receipt_long</i>
                                Jadwal Pelajaran</a></li>
                    </ul>
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="link-light rounded mb-1 {{ Request::is('akademik/kalender*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/akademik/kalender/index"><i
                                    class="material-icons opacity-10 mx-2">receipt_long</i>
                                Kalender Akademik</a></li>
                    </ul>
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="link-light rounded mb-1 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="javascript:void(0);" onclick="konfirmasiBukaLink()"><i
                                    class="material-icons opacity-10 mx-2" >task</i>
                                Elearning</a></li>
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
                <div class="collapse {{ Request::is('akademik/absensi*') || Request::is('/data-nilai-moodle/course-moodle*') ? 'show' : '' }}" id="kesiswaan-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="link-light rounded mb-1 {{ Request::is('akademik/absensi*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/akademik/absensi"> <i
                                    class="material-icons opacity-10 mx-2">receipt_long</i>
                                Presensi</a></li>
                    </ul>
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="link-light rounded mb-1 {{ Request::is('/data-nilai-moodle/course-moodle*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/data-nilai-moodle/course-moodle"> <i
                                    class="material-icons opacity-10 mx-2">receipt_long</i>
                                nilai moodle</a></li>
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
                                style="width: 100%" href="/sarana/inventaris"> <i
                                    class="material-icons opacity-10 mx-2">task</i>
                                Inventaris</a></li>
                    </ul>
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="link-light rounded mb-1 {{ Request::is('data-peminjaman*') ? 'bg-gradient-primary ' : '' }}"
                                style="width: 100%" href="/data-peminjaman"> <i
                                    class="material-icons opacity-10 mx-2">task</i>
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
                        <li><a class="link-light rounded mb-1" style="width: 100%" href="#"> <i
                                    class="material-icons opacity-10 mx-2">groups</i>
                                Tamu</a></li>
                    </ul>
                </div>
            </li>
        @elseif (auth()->user()->hasRole('waka'))
           
           <li class="mb-1">
               <button class="btn align-items-center rounded collapsed text-white font-weight-bold"
                   style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px"
                   data-bs-toggle="collapse" data-bs-target="#sarpras-collapse" aria-expanded="false">
                   <span class="material-symbols-outlined">
                       architecture
                   </span>
                   Sapras <i class="material-icons opacity-10 ms-auto">expand_more</i>
               </button>
               <div class="collapse {{ Request::is('sarana/inventaris*') || Request::is('sarana/ruang*') || Request::is('sarana/barang*')  || Request::is('data-peminjaman*') ? 'show' : '' }}"
                   id="sarpras-collapse">
                   <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                       <li><a class="link-light rounded mb-1 {{ Request::is('sarana/inventaris*') ? 'bg-gradient-primary ' : '' }}"
                           style="width: 100%" href="/sarana/inventaris"> <i class="material-icons opacity-10 mx-2">task</i>
                               Inventaris</a>
                       </li>
                   </ul>
                   <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                       <li><a class="link-light rounded mb-1 {{ Request::is('data-peminjaman*') ? 'bg-gradient-primary ' : '' }}"
                           style="width: 100%" href="/data-peminjaman"> <i class="material-icons opacity-10 mx-2">task</i>
                               Peminjaman</a></li>
                   </ul>
               </div>
           </li>
        @elseif (auth()->user()->hasRole('guru'))
            <li class="mb-1" style="">
                <a class="btn rounded text-white font-weight-bold {{ Request::is('#*') ? 'bg-gradient-primary ' : '' }}"
                    style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px"
                    href="/#"> <span class="material-symbols-outlined">groups</span> Data Siswa</a>
            </li>
            <li class="mb-1" style="">
                <a class="btn rounded text-white font-weight-bold {{ Request::is('/akademik/jadwal-guru*') ? 'bg-gradient-primary ' : '' }}"
                    style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px"
                    href="/akademik/jadwal-guru/{{ auth()->user()->id }}"> <span
                        class="material-symbols-outlined">event_note</span> Jadwal Mengajar</a>
            </li>
            <li class="mb-1" style="">
                <a class="btn rounded text-white font-weight-bold 'bg-gradient-primary ' : '' }}"
                    style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px"
                    href="javascript:void(0);" onclick="konfirmasiBukaLink()"> <span
                        class="material-symbols-outlined">task</span> Elearning</a>
            </li>
        @elseif (auth()->user()->hasRole('siswa'))
            <li class="mb-1" style="">
                <a class="btn rounded text-white font-weight-bold {{ Request::is('/akademik/jadwal-siswa/*') ? 'bg-gradient-primary ' : '' }}"
                    style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px"
                    href="/akademik/jadwal-siswa/{{ auth()->user()->siswa->id_kelas ?? 'null' }}"> <span
                        class="material-symbols-outlined">event_note</span> Jadwal Pelajaran</a>
            </li>
            <li class="mb-1" style="">
                <a class="btn rounded text-white font-weight-bold 'bg-gradient-primary ' : '' }}"
                    style="text-transform: none; width: 100%;display: flex; align-items: center; column-gap:10px"
                    href="javascript:void(0);" onclick="konfirmasiBukaLink()"> <span
                        class="material-symbols-outlined">task</span> Elearning</a>
            </li>
        @endif
    </ul>
</div>
<script>
    function konfirmasiBukaLink() {
        var konfirmasi = confirm("Apakah Anda yakin ingin membuka Elearning?");

        if (konfirmasi) {
            window.open("http://localhost/moodle/login/index.php", "_blank");
        }
    }
</script>