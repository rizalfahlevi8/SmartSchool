@extends('components.main')
@section('title-content')
    Dashboard
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Edit Password</h6>
@endsection
@section('additional-css')
    <style>
        .field-icon {
            right: 10px;
            top: 50%;
            position: absolute;
            z-index: 20;
            transform: translateY(-50%);
            cursor: pointer;
            color: rgb(148, 148, 156);
        }
    </style>
@endsection
@section('script')
    <script>
        $(document).on('click', '.toggle-password', function(e) {
            e.preventDefault();
            let target = $($(this).attr('data-target'))
            if (target.attr('type') == 'password') {
                target.attr('type', 'text')
                $(this).addClass('fa-eye-slash')
            } else {
                target.attr('type', 'password')
                $(this).removeClass('fa-eye-slash')
            }
        })

        $(document).on('click', '.toggle-password2', function(e) {
            e.preventDefault();
            let target = $($(this).attr('data-target'))
            if (target.attr('type') == 'password') {
                target.attr('type', 'text')
                $(this).addClass('fa-eye-slash')
            } else {
                target.attr('type', 'password')
                $(this).removeClass('fa-eye-slash')
            }
        })

        $(document).on('click', '.toggle-password3', function(e) {
            e.preventDefault();
            let target = $($(this).attr('data-target'))
            if (target.attr('type') == 'password') {
                target.attr('type', 'text')
                $(this).addClass('fa-eye-slash')
            } else {
                target.attr('type', 'password')
                $(this).removeClass('fa-eye-slash')
            }
        })
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-5 col-md-6 mb-4">
            <div class="card z-index-2 ">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                        <div class="chart">
                            <h6 class="text-white text-capitalize ps-3">Ubah Password</h6>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <form action="{{ route('option.change-password', auth()->user()->id) }}" class="row" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="old_password" class="form-label">Password Lama
                            </label>
                            <div class="input-group">
                                <input type="password" name="old_password" id="old_password" minlength="5"
                                    class="form-control rounded-3" required value="{{ old('old_password') }}"
                                    {{ $errors->has('old_password') ? 'autofocus="true"' : '' }}>
                                <span data-target="#old_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                            </div>
                            @if ($errors->has('old_password'))
                                <span class="text-danger">{{ $errors->first('old_password') }}</span>
                            @endif
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" name="new_password" id="new_password" minlength="5"
                                    class="form-control rounded-3" required value="{{ old('new_password') }}"
                                    {{ $errors->has('new_password') ? 'autofocus="true"' : '' }}>
                                <span data-target="#new_password"
                                    class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                            </div>
                            @if ($errors->has('new_password'))
                                <span class="text-danger">{{ $errors->first('new_password') }}</span>
                            @endif
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="new_password_confirm" class="form-label">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <input type="password" name="new_password_confirm" id="new_password_confirm" minlength="5"
                                    class="form-control rounded-3" required value="{{ old('new_password_confirm') }}"
                                    {{ $errors->has('new_password_confirm') ? 'autofocus="true"' : '' }}>
                                <span data-target="#new_password_confirm"
                                    class="fa fa-fw fa-eye field-icon toggle-password3"></span>
                            </div>
                            @if ($errors->has('new_password_confirm'))
                                <span class="text-danger">{{ $errors->first('new_password_confirm') }}</span>
                            @endif
                        </div>

                        <div class="col text-right mt-4">
                            <button type="submit" class="btn btn-primary ml-5 text-sm rounded-3" style="float:right; ">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                            <a href="{{ redirect()->back()->getTargetUrl() }}" type="button"
                                class="btn btn-danger text-sm rounded-3" style="float: right;margin-right:10px"><i
                                    class="fa fa-ban"></i>
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
