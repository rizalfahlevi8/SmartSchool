@extends('components.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Data User</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        {{-- <button type="button" id="btntambah" class="btn btn-primary font-weight-bold text-xs"
                            data-bs-toggle="modal" data-bs-target="#insert-modal">
                            <i class="material-icons opacity-10">add</i>
                            Tambah
                        </button> --}}
                        <!-- Button trigger modal -->

                        <a href="/administrasi/user/export" type="export" id="btnexport"
                            class="btn btn-success font-weight-bold text-xs">
                            Export Data user
                        </a>
                        <button type="button" class="btn btn-success font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#importModal">
    Import Data User
</button>
                
                        <table id="example" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <td
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        No</td>
                                    <td
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Username</td>
                                    <td
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Roles</td>
                                    <td
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center"> {{ $user->username }} </td>
                                        <td class="text-center"> {{ $user->role }} </td>
                                        <td class="text-center">
                                            <button type="button"data-bs-toggle="modal" data-bs-target="#update-modal"
                                                class="btn  btn-warning font-weight-bold btn--edit text-sm rounded mx-3"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"
                                                onclick="showUpdateModal(this)" id_user="{{ $user->id }}"
                                                username ="{{ $user->username }}" user-roles = "{{ $user->role }}">Set
                                                Roles
                                            </button>
                                            <button type="button"data-bs-toggle="modal" data-bs-target="#reset-modal"
                                                class="btn  btn-danger font-weight-bold btn--edit text-sm rounded"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"
                                                onclick="showResetModal(this)" id_user="{{ $user->id }}"
                                                username ="{{ $user->username }}" nama ="{{ $user->nama }}"
                                                user-roles = "{{ $user->role }}">Reset Password
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="importModalLabel">Import Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="excel_file" class="form-label">Choose Excel File</label>
                        <input type="file" class="form-control" id="excel_file" name="excel_file" required>
                    </div>
                    <button type="submit" class="btn btn-success">Import Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <br>
                    <form action="" class="row g-3 px-4" method="post" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class=" g-2 align-items-center px-3" style="display: flex; justify-content: space-between">
                            <div class="col-auto">
                                <label for="update-username" class="col-form-label">Username</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="username" class="form-control text-sm" value=""
                                    id="update-username" required readonly disabled style="max-width: 302px;">
                            </div>

                        </div>
                        <br>
                        <div class="g-2 align-items-center px-3" style="display: flex; justify-content: space-between">
                            <div class="col-auto">
                                <label for="update-roles" class="col-form-label">Roles</label>
                            </div>
                            <div style="display: flex; flex-wrap: wrap; column-gap: 10px;row-gap: 5px;max-width: 302px"
                                id="update-roles">
                                @foreach (config('app.DB_user_roles') as $item)
                                    <div style="display: flex; width: fit-content;column-gap: 5px;">
                                        <input type="checkbox" name="roles[]" id="role-update-{{ $item }}"
                                            value="{{ $item }}">
                                        <label for="role-update-{{ $item }}"
                                            style="margin: 0">{{ ucfirst($item) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="reset-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Reset Password
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <br>
                    <form action="modal-title text-black" class="row g-3 px-4" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class=" g-2 align-items-center px-3">
                            <h5 style="font-family: 'Roboto', Helvetica, Arial, sans-serif">
                                Apakah Anda yakin ingin mereset password</h5>
                            <h5 id="nama_reset" style="display: inline; font-weight: bold;"></h5> <b>(<h5
                                    id="username_reset" style="display: inline; font-weight: bold;"
                                    nama="username_reset"></h5>)</b>
                            <hr>
                            <h6><b>Note:</b> password akan sama dengan <b>username</b></h6>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="username" class="form-control text-sm" id="username" required
                                readonly hidden style="max-width: 302px;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-sm btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="insert-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Tambah User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <br>
                    <form action="" class="row g-3 px-4" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row g-2 align-items-center px-3">
                            <div class="col-auto">
                                <label for="username" class="col-form-label">Username</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="username" class="form-control text-sm" value=""
                                    id="username" required>
                            </div>

                        </div>
                        <br>
                        <div class="row g-2 align-items-center px-3">
                            <div class="col-auto">
                                <label for="roles" class="col-form-label">Roles</label>
                            </div>
                            <div style="display: flex; flex-wrap: wrap;">
                                @foreach (config('app.DB_user_roles') as $item)
                                    <div style="display: flex; width: fit-content; gap: 10px; justify-content: center">
                                        <input type="checkbox" name="{{ $item }}" id="{{ $item }}">
                                        <label for="{{ $item }}" style="margin: 0">{{ ucfirst($item) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div> --}}
    <script>
        function showUpdateModal(element) {
            const updateModalForm = document.querySelector('#update-modal form');
            const username = updateModalForm.querySelector('#update-username');
            const roles = updateModalForm.querySelector('#update-roles');
            const selected_roles = element.getAttribute('user-roles').split(',');

            updateModalForm.setAttribute('action', `/administrasi/users/${element.getAttribute('id_user')}`);
            username.value = element.getAttribute('username');

            roles.querySelectorAll("input[type='checkbox'][name='roles[]']").forEach((item) => {
                item.checked = false;
            });
            selected_roles.forEach((role) => {
                if (roles.querySelector(`input[type='checkbox'][name='roles[]'][value='${role}']`)) {
                    roles.querySelector(`input[type='checkbox'][name='roles[]'][value='${role}']`).checked = true;
                }
            });
        }

        function showResetModal(element) {
            const updateModalForm = document.querySelector('#reset-modal form');
            const username = updateModalForm.querySelector('#username_reset');
            const usernameValue = updateModalForm.querySelector('#username');
            const nama = updateModalForm.querySelector('#nama_reset');

            updateModalForm.setAttribute('action', `/administrasi/users/reset/${element.getAttribute('id_user')}`);
            username.innerText = element.getAttribute('username');
            usernameValue.value = element.getAttribute('username');
            nama.innerText = element.getAttribute('nama');
        }
        document.getElementById('importDataUserBtn').addEventListener('click', function () {
        // Optional: Close any existing modals
        // var existingModal = new bootstrap.Modal(document.getElementById('reset-modal'));
        // existingModal.hide();

        // Open the import modal
        var importModal = new bootstrap.Modal(document.getElementById('importModal'));
        importModal.show();
    });
    </script>
@endsection
