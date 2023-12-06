<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.5') }}" rel="stylesheet" />
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    
    <style>
        .field-icon {
            right: 10px;
            top: 50%;
            position: absolute;
            z-index: 100;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>

    <style>
            body {
              background-color: #f5f5f5;
              justify-content: center;
              align-items: center;
              /* height: 10vh; */
              margin: 3%;  
          }

          form {
              background-color: #ffffff;
              padding: 20px;
              border-radius: 10px;
              box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);   
          }

          h2 {
              margin-bottom: 10px;
          }

          label {
              display: block;
              margin-bottom: 5px;
          }

          input, select, textarea {
              width: 50%;
              padding: 5px;
              /* margin-bottom: 10px; */
              border: 1px solid #cccccc;
              border-radius: 5px;
              outline: none;
          }

          button:hover {
              background-color: #0056b3;
          }
          </style>
</head>
<body>
<div class="form-container">
  {{-- @yield('content') --}}
        <main class="container">
            <div class="row">
              <div class="col-12">
                  <div class="card my-4">
                      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                              <h6 class="text-white text-capitalize ps-3">Tambah Data Tamu</h6>
                          </div>
                      </div>
                      <div class="card-body">
                        <main class="form-Tamu">
                          <form action="{{ route('kirim-tamu') }}" method="post">
                            @csrf
                            <div class="mb-3 col-md-8" style="padding-left: 20px; padding-right: 20px;">
                              <label for="inputNamaTamu" class="form-label"> Nama Tamu </label>
                                <div class="col-auto">
                                  <div class="input-group input-group-outline">
                                    <input id="nama_tamu" type="text" name="namaTamu" class="form-control rounded-3"
                                      maxlength="20" value="{{ old('namaTamu') }}" {{ $errors->has('namaTamu') ? 'autofocus="true"' : '' }}>
                                  </div>
                                  @if ($errors->has('namaTamu'))
                                      <span class="text-danger">{{ $errors->first('namaTamu') }}</span>
                                  @endif
                                </div>
                            </div>
                            <div class="mb-3 col-md-8" style="padding-left: 20px; padding-right: 20px;">
                              <label for="inputAlamat" class="form-label">Alamat Tamu atau Asal Instansi Tamu </label>
                              <div class="input-group input-group-outline">
                                <input id="input_alamat" type="text" name="alamatTamu"  class="form-control"
                                value="{{ old('alamatTamu') }}" {{ $errors->has('alamatTamu') ? 'autofocus="true"' : '' }}>
                              </div>
                              @if ($errors->has('namaTamu'))
                                  <span class="text-danger">{{ $errors->first('namaTamu') }}</span>
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
                                        <option value="">Cari Username</option>
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

                              <div lass="mb-3" style="padding-left: 20px; padding-right: 20px;">
                                <label for="exampleFormControlTextarea1" class="form-label fs-6">Keterangan</label>
                                <div class="form-floating mb-3">
                                  <div class="input-group input-group-outline"> 
                                    <textarea class="form-control" name="keteranganTamu" placeholder="Jelaskan tujuan anda datang" id="floatingTextarea" style="height: 100px" 
                                    value="{{ old('keteranganTamu') }}" {{ $errors->has('keteranganTamu') ? 'autofocus="true"' : '' }} ></textarea>
                                  </div>
                                  @if ($errors->has('keteranganTamu'))
                                      <span class="text-danger">{{ $errors->first('keteranganTamu') }}</span>
                                  @endif
                                  </div>
                              </div>
                              
                                <div class="card-footer d-flex justify-content-end" style="gap: 10px">
                                  <a href="{{ route('login') }}" type="button" class="btn btn-danger text-sm rounded-3"
                                    style="margin-bottom: 0;">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                  </a>
                                  <button type="submit" onclick="return confirm('Apakah anda yakin data sudah benar?')"
                                    class="btn btn-primary text-sm rounded-3 mr-2" style="margin-bottom: 0;">
                                   <i class="fa fa-save"></i> Kirim
                                  </button>
                                {{-- <Input type='submit' onclick="return confirm('apakah anda yakin data sudah benar ?')"
                                value="Kirim" class="btn btn-primary" > --}}
                                </div>
                              
                          </form>
                        </main>
                      </div>
                  </div>
              </div>
            </div>
        </main>
</div>
</body>
</html>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

{{-- @endsection --}}
