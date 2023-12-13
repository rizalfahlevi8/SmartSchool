<head>
  <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
</head>  

@extends('components.main')
@section('title-content')
    Data Tamu
@endsection
@section('breadcrumbs')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard"> Dashboard </a></li>
        <li class="breadcrumb-item text-sm text-dark active"><a class="opacity-5 text-dark" href="/data-tamu"> Daftar Tamu </a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"> Tamu </li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Tamu</h6>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
      <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Tambah Data Tamu</h6>
              </div>
          </div>
          <div class="card-body px-0 pb-2">
            <main class="form-tambah-tamu">
              <form action="/tamu" method="post">
                @csrf
                <div class="mb-3 col-md-6" style="padding-left: 20px; padding-right: 20px;">
                  <label for="inputNamaTamu" class="form-label"> Nama Tamu </label>
                    <div class="col-auto">
                      <input id="nama_tamu" type="text" name="namaTamu" class="form-control rounded-3"
                        maxlength="20"
                        value="{{ old('namaTamu') }}" {{ $errors->has('namaTamu') ? 'autofocus="true"' : '' }}>
                    </div>
                    @if ($errors->has('namaTamu'))
                        <span class="text-danger">{{ $errors->first('namaTamu') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6" style="padding-left: 20px; padding-right: 20px;">
                  <label for="inputAlamat" class="form-label">Alamat Tamu atau Asal Instansi Tamu </label>
                  <div class="input-g">
                    <input id="input_alamat" type="text" name="alamatTamu"  class="form-control"
                    value="{{ old('alamatTamu') }}" {{ $errors->has('alamatTamu') ? 'autofocus="true"' : '' }} >
                  </div>
                  @if ($errors->has('alamatTamu'))
                        <span class="text-danger">{{ $errors->first('alamatTamu') }}</span>
                  @endif
                </div>
              
                <div class="mb-3" style="padding-left: 20px; padding-right: 20px;">
                      <label class="col-form-label"> Bertujuan Bertemu Dengan Siapa </label>
                      <div class="row g-3 py-1 px-4">
                        <div class="col-md-3">
                          <select onchange="handleTujuan(this)" id="opsi_tujuan" name="Opsi" class="form-select " aria-label="Default select example">
                            <option value="" selected disabled>Pilih Tujuan</option>
                            @foreach ($userRoles as $r)
                              @php
                                $formattedRole = ucwords($r->role);
                              @endphp
                              <option value="{{ $r->role }}">{{ $formattedRole }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-3">
                          <select id="opsi_lanjutan" name="Opsi_Lanjutan" class="form-select col-md-3" aria-label="Default select example">
                            <option value="">Silahkan cari nama</option>
                          </select>
                        </div>
                      </div>
                  <div class="col-auto">
                  <span class="form-text">
                      Keterangan : <br>
                        - Silahkan pilih Tujuan kemudian cari nama orang yang ingin di temui <br>
                        - Kedatangan Tamu bertujuan menemui siapa <br> 
                    </span> 
                    </div>
                </div>

                  <div class="mb-3" style="padding-left: 20px; padding-right: 20px;">
                    <label for="exampleFormControlTextarea1" class="form-label fs-6">Keterangan</label>
                    <div class="form-floating mb-3" > 
                        <textarea class="form-control" name="keteranganTamu" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" 
                        value="{{ old('keteranganTamu') }}" {{ $errors->has('keteranganTamu') ? 'autofocus="true"' : '' }} ></textarea>
                        <label for="floatingTextarea" style="color:darkgrey" > Jelaskan tujuan anda datang </label>
                        @if ($errors->has('keteraganTamu'))
                        <span class="text-danger">{{ $errors->first('keteranganTamu') }}</span>
                        @endif
                    </div>
                  </div>
                  <div class="card-footer d-flex justify-content-end" style="gap: 10px">
                    {{-- <a href="/data-tamu" type="button" class="btn btn-danger text-sm rounded-3"
                                >
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                    <Input type='submit' onclick="return confirm('apakah anda yakin data sudah benar ?')"
                    value="Kirim" class="btn btn-primary" > --}}
                    <a href="/data-tamu" type="button" class="btn btn-danger text-sm rounded-3"
                        style="margin-bottom: 0;">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit"
                        onclick="return insertInputTamu()"
                        class="btn btn-primary text-sm rounded-3 mr-2" style="margin-bottom: 0;">
                      <i class="fa fa-save"></i> Simpan
                    </button>
                  </div>
              </form>
            </main>
          </div>
      </div>
  </div>
</div>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- <script>
  $( '#basic-usage' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
} );
</script> --}}

  {{-- <script>
    const opsi_lanjutan_dropdown = $('opsi_lanjutan');
    const username_dipilih = 'username_terpilih';

    opsi_lanjutan_dropdown.on('change', function() {
        const username_pilihan = $(this).val();
        if (username_pilihan === username_terpilih) {
            pesan_tamu.text(`Anda memiliki tamu yang akan menemu Anda: ${username_terpilih}`);
        } else {
            pesan_tamu.text('');
        }
    });
    console.log(username_pilihan.html());
  </script> --}}

  <script>
    $(document).ready(function() {
      const opsi_lanjutan_dropdown = $('#opsi_lanjutan');
      const opsi_tujuan_dropdown = $('#opsi_tujuan');
  
      opsi_tujuan_dropdown.select2({
        theme: 'bootstrap-5',
        width: opsi_tujuan_dropdown.data('width') ? opsi_tujuan_dropdown.data('width') : opsi_tujuan_dropdown.hasClass('w-100') ? '100%' : 'style',
        placeholder: opsi_tujuan_dropdown.data('placeholder'),
      });
  
      opsi_lanjutan_dropdown.select2({
        theme: 'bootstrap-5',
        width: opsi_lanjutan_dropdown.data('width') ? opsi_lanjutan_dropdown.data('width') : opsi_lanjutan_dropdown.hasClass('w-100') ? '100%' : 'style',
        placeholder: opsi_lanjutan_dropdown.data('placeholder'),
      });
  
      const handleTujuan = async (role) => {
        try {
          const res = await fetch(`/get-username-by-role/${role}`);
          const result = await res.json();
          console.log(result);
  
          // let options = result.map(username => `<option value="${username}">${username}</option>`);
          let options = result.map(user => `<option value="${user.username}">${user.nama}</option>`);
  
          opsi_lanjutan_dropdown.empty().append(options).trigger('change');
          // console.log(opsi_lanjutan_dropdown.html());
        } catch (error) {
          console.error('Error fetching or processing data:', error);
        }
      };
      console.log('Change event triggered!');
  
      opsi_tujuan_dropdown.on('change', function() {
        const selectedRole = $(this).val();
        handleTujuan(selectedRole);
      });
  
      opsi_lanjutan_dropdown.on('select2:opening', function(e) {
        const selectedRole = opsi_tujuan_dropdown.val();
        if (!selectedRole) {
          e.preventDefault();
          alert('Pilih terlebih dahulu tujuan untuk memfilter nama yang ingin di tuju');
        }
      });
    });
  </script>
  

{{-- <script>
  const opsi_lanjutan_dropdown = document.getElementById('opsi_lanjutan');
  const opsi_tujuan_dropdown = document.getElementById('opsi_tujuan');

  const handleTujuan = async (e) => {
    try {
      const res = await fetch(`/get-username-by-role/${e.value}`);
      const result = await res.json();
      console.log(result);

      let kontenHtml = '';

      result.forEach((username) => {
        kontenHtml += `<option value="${username}">${username}</option>`;
      });

      opsi_lanjutan_dropdown.innerHTML = kontenHtml;
    } catch (error) {
      console.error('Error fetching or processing data:', error);
    }
  }

  document.getElementById('searchInput').addEventListener('input', function() {
    console.log('Input terpanggil');
    let searchString = this.value.toLowerCase();
    let selectedRole = opsi_tujuan_dropdown.value;
    let options = [];

    @if ($namaUserGuru)
      @foreach($namaUserGuru as $nuserGuru)
        options.push({ role: 'guru', username: '{{ $nuserGuru->username }}' });
      @endforeach
    @endif

    @if ($namaUserSiswa)
      @foreach($namaUserSiswa as $nuserSiswa)
        options.push({ role: 'siswa', username: '{{ $nuserSiswa->username }}' });
      @endforeach
    @endif

    opsi_lanjutan_dropdown.innerHTML = '';

    options
      .filter(option => option.role === selectedRole && option.username.toLowerCase().includes(searchString))
      .forEach(function (option) {
        let optionElement = document.createElement('option');
        optionElement.value = option.username; // Set nilai sesuai dengan apa yang ingin Anda gunakan
        optionElement.text = option.username;
        opsi_lanjutan_dropdown.appendChild(optionElement);
      });
  });
</script>  --}}

@endsection
