@if (auth()->user()->hasRole('admin', 'kepsek'))
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">people</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize"><b>DATA TEKNISI</b></p>
                        <h4 class="mb-0">{{ $teknisi }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">groups</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize"><b>DATA GURU</b></p>
                        <h4 class="mb-0">{{ $guru->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">groups</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize"><b>DATA KELAS</b></p>
                        <h4 class="mb-0">{{ $kelas->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-warning shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">group</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize"><b>DATA SISWA</b></p>
                        <h4 class="mb-0">{{ $siswa->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pengumuman -->
        <div class="card mt-4">
            <div class="card-header">
            <h4 class="card-title">Pengumuman</h4>
                </div>
                <div class="card-body">
        @if ($pengumumans->isEmpty())
            <p class="text-muted">Tidak ada pengumuman saat ini.</p>
        @else
            <ul class="list-group">
                @foreach ($pengumumans as $pengumuman)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="col-md-4">
                            <h5>{{ $pengumuman->title }}</h5>
                        </div>
                        <div class="col-md-4">
                            <p>{{ $pengumuman->message }}</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <p class="text-muted">{{ $pengumuman->role }}</p>
                            <button class="btn btn-sm btn-warning edit-notification" data-bs-toggle="modal" data-bs-target="#editPengumuman{{ $pengumuman->id }}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <a href="/dashboard/hapus-pengumuman/{{ $pengumuman->id }}" onclick="return confirm('Anda yakin akan menghapus pengumuman ini?')" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </li>
                            <!-- Modal Edit Pengumuman -->   
                                <div class="modal fade" id="editPengumuman{{ $pengumuman->id }}" tabindex="-1" role="dialog" aria-labelledby="editPengumumanLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editPengumumanLabel">Edit Pengumuman</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post" action="{{ route('update-pengumuman', ['pengumuman' => $pengumuman->id]) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="notificationTitle" class="form-label">Judul Pengumuman</label>
                                                    <input type="text" class="form-control" id="notificationTitle" name="title" value="{{ $pengumuman->title }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="notificationMessage" class="form-label">Isi Pengumuman</label>
                                                    <textarea class="form-control" id="notificationMessage" name="message" rows="4" required>{{ $pengumuman->message }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="notificationRoles" class="form-label">Select Roles</label>
                                                    @foreach ($rolePengumuman as $role)
                                                        @php
                                                        $selectedRoles = explode(',', $pengumuman->roles);
                                                        @endphp
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role }}" id="role{{ $role }}" @if(in_array($role, $selectedRoles)) checked @endif>
                                                            <label class="form-check-label" for="role{{ $role }}">
                                                                {{ $role }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </ul>
                        @endif
                        <div class="card-footer" style="padding: 0.5rem;">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-xl-0 mb-4">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buatPengumuman">
                                Buat Pengumuman
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

    <!-- Modal Buat Pengumuman -->   
    <div class="modal fade" id="buatPengumuman" tabindex="-1" role="dialog" aria-labelledby="buatPengumumanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buatPengumumanLabel">Buat Pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('buat-pengumuman') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="notificationTitle" class="form-label">Judul Pengumuman</label>
                            <input type="text" class="form-control" id="notificationTitle" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="notificationMessage" class="form-label">Isi Pengumuman</label>
                            <textarea class="form-control" id="notificationMessage" name="message" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                        <label for="notificationRoles" class="form-label">Select Roles</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[]" value="guru" id="roleGuru">
                            <label class="form-check-label" for="roleGuru">Guru</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[]" value="siswa" id="roleStudent">
                            <label class="form-check-label" for="roleStudent">Siswa</label>
                        </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Buat</button>
                    </form>
                </div>
            </div>
        </div>
</div>
    </div>
    </div>
    
    @elseif (auth()->user()->hasRole('wakasek'))
    <div class="row gap-1 justify-content-evenly">
    <div class="card col-4" style="height: 650px; width: 450px; border-radius: 25px;">
        <div class="card-body d-flex flex-column justify-content-between">
            <div class="text-center mb-3">
                <img class=" rounded-4" src="{{ asset('assets/img/c.jpg')}}" style="width: 100%; border-radius: 25px;" alt="Deskripsi Gambar">
            </div>
            <h5 class="mt-3 text-capitalize text-center" style="color: black; font-size: 30px; font-weight: 700; word-wrap: break-word;">DATA RUANG</h5>
            <div class="text-end">
                <a href="{{ route('ruang_main') }}" class="btn btn-primary">Daftar Ruang </a>
            </div>
        </div>
    </div>
    <div class="card col-4" style="height: 650px; width: 450px; border-radius: 25px;">
        <div class="card-body d-flex flex-column justify-content-between">
            <div class="text-center mb-3">
                <img class=" rounded-4" src="{{ asset('assets/img/a.jpg')}}" style="width: 100%; border-radius: 25px;" alt="Deskripsi Gambar">
            </div>
            <h5 class="mt-3 text-capitalize text-center" style="color: black; font-size: 30px; font-weight: 700; word-wrap: break-word;">DATA BARANG</h5>
            <div class="text-end">
                <a href="{{ route('barang_main') }}" class="btn btn-primary">Daftar Barang </a>
            </div>
        </div>
    </div>
</div>

@endif
