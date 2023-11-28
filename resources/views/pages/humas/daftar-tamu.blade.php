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
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    
    <style>
            body {
              background-color: #f5f5f5;
              display: flex;
              justify-content: center;
              align-items: center;
              height: 110vh;
              margin: 0;
          }

          form {
              background-color: #ffffff;
              padding: 20px;
              border-radius: 10px;
              box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
          }

          h2 {
              margin-bottom: 20px;
          }

          label {
              display: block;
              margin-bottom: 5px;
          }

          input, select, textarea {
              width: 100%;
              padding: 5px;
              margin-bottom: 20px;
              border: 1px solid #cccccc;
              border-radius: 5px;
              outline: none;
          }

          /* button {
              width: 100%;
              padding: 10px;
              background-color: #007bff;
              color: #ffffff;
              border: none;
              border-radius: 5px;
              cursor: pointer;
          } */

          button:hover {
              background-color: #0056b3;
          }
          </style>
          {{-- <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script> --}}
</head>
<body>
<div class="form-container">
  {{-- @yield('content') --}}
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
                          <form action="{{ route('humas.kirim-tamu') }}" method="post">
                            @csrf
                            <div class="mb-3 col-md-8" style="padding-left: 20px; padding-right: 20px;">
                              <label for="inputNamaTamu" class="form-label"> Nama Tamu </label>
                                <div class="col-auto">
                                  <div class="input-group input-group-outline">
                                    <input id="nama_tamu" type="text" name="namaTamu" class="form-control rounded-3"
                                      maxlength="20">
                                  </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-8" style="padding-left: 20px; padding-right: 20px;">
                              <label for="inputAlamat" class="form-label">Alamat Tamu atau Asal Instansi Tamu </label>
                              <div class="input-group input-group-outline">
                                <input id="input_alamat" type="text" name="alamatTamu"  class="form-control"
                                  >
                              </div>
                            </div>
                          
                              
                            <div class="mb-3" style="padding-left: 20px; padding-right: 20px;">
                                  <label class="col-form-label"> Bertujuan Bertemu Dengan Siapa </label>
                                  <div class="row g-3 py-1">
                                    <div class="col-md-4">
                                      <select onchange="handleTujuan(this)" id="opsi_tujuan" name="Opsi" class="form-select " aria-label="Default select example">
                                        {{-- <option value="kepala sekolah">Kepala Sekolah</option>
                                        <option value="wakil kepala sekolah">Wakil Kepala Sekolah</option>
                                        <option value="guru">Guru</option>
                                        <option value="siswa">Siswa</option> --}}
                                        <option value="">Pilih Tujuan</option>
                                        @foreach ($userRoles as $r)
                                            <option value="{{ $r->role }}">{{ $r->role }}</option>  
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="input-group input-group-outline">
                                        <input type="text" id="searchInput" placeholder="Cari Username" class="form-control rounded-3" aria-label="Default select example" >
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <select id="opsi_lanjutan" name="Opsi_Lanjutan" class="form-select col-md-3" aria-label="Default select example">
                                        {{-- <optgroup label="wakil_kepala_sekolah">
                                          <option value=""></option>
                                        </optgroup>
                                        <optgroup label="guru">
                                          <option value="mipa">MIPA</option>
                                          <option value="ips">IPS</option>
                                        </optgroup> --}}
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
                                    <textarea class="form-control" name="keteranganTamu" placeholder="Jelaskan tujuan anda datang" id="floatingTextarea" style="height: 100px"  ></textarea>
                                  </div>
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
</div>
</body>
</html>
<script>
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
</script> 

{{-- @endsection --}}
