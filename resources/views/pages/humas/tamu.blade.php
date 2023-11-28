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
            <main class="form-Tamu">
              <form action="/tamu" method="post">
                @csrf
                <div class="mb-3 col-md-6" style="padding-left: 20px; padding-right: 20px;">
                  <label for="inputNamaTamu" class="form-label"> Nama Tamu </label>
                    <div class="col-auto">
                      <input id="nama_tamu" type="text" name="namaTamu" class="form-control rounded-3"
                        maxlength="20">
                    </div>
                </div>
                <div class="mb-3 col-md-6" style="padding-left: 20px; padding-right: 20px;">
                  <label for="inputAlamat" class="form-label">Alamat Tamu atau Asal Instansi Tamu </label>
                  <div class="input-g">
                    <input id="input_alamat" type="text" name="alamatTamu"  class="form-control"
                      >
                  </div>
                </div>
              
                  
                <div class="mb-3" style="padding-left: 20px; padding-right: 20px;">
                      <label class="col-form-label"> Bertujuan Bertemu Dengan Siapa </label>
                      <div class="row g-3 py-1 px-4">
                        <div class="col-md-3">
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
                        <div class="col-md-3">
                          <input type="text" id="searchInput" placeholder="Cari Username" class="form-control rounded-3" aria-label="Default select example" >
                        </div>
                        <div class="col-md-3">
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
                    <div class="form-floating mb-3" > 
                        <textarea class="form-control" name="keteranganTamu" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px"  ></textarea>
                        <label for="floatingTextarea" style="color:darkgrey" > Jelaskan tujuan anda datang </label>
                    </div>
                  </div>
                  <div class="card-footer d-flex justify-content-end" style="gap: 10px">
                    <Input type='submit' onclick="return confirm('apakah anda yakin data sudah benar ?')"
                    value="Kirim" class="btn btn-primary" >
                  </div>
              </form>
            </main>
          </div>
      </div>
  </div>
</div>
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
{{-- awal bikin script --}}
{{-- <script>

  const opsi_lanjutan = document.getElementById('opsi_lanjutan')

  const handleTujuan = async (e) => {
    if(e.value == 'guru'){
      try {
      const res = await fetch(`/get-username-by-role/${e.value}`);
      const result = await res.json();
      console.log(result);

      let kontenHtml = '';

      result.forEach((username) => {
        kontenHtml += `<option value="${username}">${username}</option>`;
      });

      opsi_lanjutan.innerHTML = kontenHtml;
    } catch (error) {
      console.error('Error fetching or processing data:', error);
    }
    }
    if(e.value == 'siswa'){
      try {
      const res = await fetch(`/get-username-by-role/${e.value}`);
      const result = await res.json();
      console.log(result);

      let kontenHtml = '';

      result.forEach((username) => {
        kontenHtml += `<option value="${username}">${username}</option>`;
      });

      opsi_lanjutan.innerHTML = kontenHtml;
    } catch (error) {
      console.error('Error fetching or processing data:', error);
    }
    } 
    // else if(e.value == 'siswa'){
    //   const res = await fetch(`/get-username-by-role/${e.value}`)
    //   const result = await res.json()
    //   console.log(result);

    //   let kontenHtml = ''

    //   result.forEach((element, index) => {
    //     kontenHtml += `<option value="${result[index]}">${result[index]}</option>`
    //   });

    //   opsi_lanjutan.innerHTML = kontenHtml
    // }
  }

  // document.getElementById('opsi_tujuan').addEventListener('change',function async () {
  //   let opsi_tujuan = this.value;
  //   let opsi_lanjutan_dropdown = document.getElementById('opsi_lanjutan');

    // //hapus opsi lanjutan yang ada sebelumnya
    // // opsi_lanjutan_dropdown.innerHTML = '';

    // // Kosongkan dropdown subcategories
    // document.getElementById('opsi_lajutan').innerHTML = '<option value="">Pilih Username</option>';

    // //Menentukan pilihan opsi lanjutan berdasarkan opsi tujuan yang di pilih
    // // if (opsi_tujuan === 'wakil kepala sekolah') {
    // //   addOptionsToDropdown(opsi_lanjutan_dropdown, ['Wakases', 'Seketaris', 'Wakases Pembelajaran']);
    // // } 
    // // else 
  
    
  //   // Ambil data dari server menggunakan AJAX
  //   const res = await fetch(`/get-username-by-role/${opsi_tujuan}`);
  //   console.log(res);

  //   }

    // fetch(`/get-username-by-role/${opsi_tujuan}`) // Sesuaikan dengan rute yang sesuai di aplikasi Laravel Anda
    //     .then(response => response.json())
    //     .then(data => {
    //       // console.log('Role yang dipilih:', opsi_tujuan);
    //       console.log('Data dari server:', data)
    //       // Tambahkan opsi ke dropdown
    //       data.forEach(username => {
    //         addOptionsToDropdown(opsi_lanjutan_dropdown, [username]);
    //       });

    //       var subcategoriesDropdown = document.getElementById('opsi_lajutan');
    //             for (var username in role) {
    //                 subcategoriesDropdown.options[subcategoriesDropdown.options.length] = new Option(role[username],

    //     })
    //     .catch(error => console.error('Error:', error));
   
  // });

  //fungsi untuk menambahkan opsi ke dropdown opsi lanjutan 
  // function addOptionsToDropdown(dropdown, options) {
  //   options.forEach(function(option) {
  //     let optionElement = document.createElement('option');
  //     optionElement.value = option.toLowerCase().replace(' ', ''); //set nilai tanpa spasi
  //     optionElement.text = option;
  //     dropdown.appendChild(optionElement);
  //   });
  // }

  // Fungsi untuk menangani pencarian berdasarkan opsi yang dipilih
  document.getElementById('cari').addEventListener('click', function() {
    let selectedOption = document.getElementById('opsi_lanjutan').value;
    // Lakukan aksi yang sesuai dengan nilai yang dipilih
    // Contoh: Bisa redirect atau menampilkan informasi terkait username yang dipilih.
    // Di sini, saya hanya menampilkan alert sebagai contoh:
    alert('Anda memilih: ' + selectedOption);
  });
</script>
<script>

  //   const searchByUsername = async () => {
  //   const searchInput = document.getElementById('searchInput').value;
    
  //   // Lakukan validasi input jika diperlukan

  //   const res = await fetch(`/search-by-username/${searchInput}`);
  //   const result = await res.json();

  //   // Manipulasi atau tampilkan hasil sesuai kebutuhan
  //   displaySearchResults(result);
  // };

  // const displaySearchResults = (results) => {
  //   const resultsContainer = document.getElementById('opsi_lajutan');
  //   // Manipulasi elemen HTML untuk menampilkan hasil pencarian
  //   // Misalnya, bisa menggunakan loop untuk menampilkan hasil dalam bentuk daftar atau tabel
  // };



    document.getElementById('searchInput').addEventListener('input', function() {
      let searchString = this.value.toLowerCase();
      let opsi_tujuan = document.getElementById('opsi_tujuan').value;
      let opsi_lanjutan_dropdown = document.getElementById('opsi_lanjutan');
      let options = [];

      // Menentukan pilihan opsi lanjutan berdasarkan opsi tujuan yang dipilih
                                            // if (opsi_tujuan === 'wakil kepala sekolah') {
                                            //   options = ['Wakases', 'Seketaris', 'Wakases Pembelajaran'];
                                            // } 
                                            // else 
      // Menentukan pilihan opsi lanjutan berdasarkan opsi tujuan yang dipilih
      // if (opsi_tujuan === 'guru') {
      //   @foreach($namaUserGuru as $userGuru)
      //     options.push('{{ $userGuru->username }}');
      //   @endforeach
      // } 
      // else if (opsi_tujuan === 'siswa') {
      //   @foreach($namaUserSiswa as $userSiswa)
      //     options.push('{{ $userSiswa->username }}');
      //   @endforeach
      // }

      // // Menentukan pilihan opsi lanjutan berdasarkan opsi tujuan yang dipilih
      @if ($namaUserGuru)
        @foreach($namaUserGuru as $nuserGuru)
          options.push('{{ $nuserGuru->username }}');
        @endforeach
      @endif
      @if ($namaUserSiswa)
        @foreach($namaUserSiswa as $nuserSiswa)
          options.push('{{ $nuserSiswa->username }}');
        @endforeach
      @endif

      // Menghapus opsi lanjutan yang ada sebelumnya
      opsi_lanjutan_dropdown.innerHTML = '';

      // Menampilkan opsi sesuai dengan teks pencarian
      // options.forEach(function(option) {
      //   if (option.toLowerCase().includes(searchString)) {
      //     let optionElement = document.createElement('option');
      //     optionElement.value = option.toLowerCase().replace(' ', ''); // Set nilai tanpa spasi
      //     optionElement.text = option;
      //     opsi_lanjutan_dropdown.appendChild(optionElement);
      //   }
      // });
      // Menampilkan opsi sesuai dengan teks pencarian
      options.forEach(function (option) {
        if (option.toLowerCase().includes(searchString)) {
          let optionElement = document.createElement('option');
          optionElement.value = option.toLowerCase().replace(' ', ''); // Set nilai tanpa spasi
          optionElement.text = option;
          opsi_lanjutan_dropdown.appendChild(optionElement);
        }
      });
    });
</script> --}}
{{-- script modif dari temen (jangan di hapus) --}}
{{-- <script>
      const opsi_lanjutan_dropdown = document.getElementById('opsi_lanjutan');

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
      console.log('input terpanggil');
      let searchString = this.value.toLowerCase();
      let options = [];

      @if ($namaUserGuru)
        @foreach($namaUserGuru as $nuserGuru)
          options.push('{{ $nuserGuru->username }}');
        @endforeach
      @endif

      @if ($namaUserSiswa)
        @foreach($namaUserSiswa as $nuserSiswa)
          options.push('{{ $nuserSiswa->username }}');
        @endforeach
      @endif

      opsi_lanjutan_dropdown.innerHTML = '';

      // options.forEach(function (option) {
      //   if (option.toLowerCase().includes(searchString)) {
      //     let optionElement = document.createElement('option');
      //     optionElement.value = option; // Set nilai sesuai dengan apa yang ingin Anda gunakan
      //     optionElement.text = option;
      //     opsi_lanjutan_dropdown.appendChild(optionElement);
      //   }
      // });
      options
          .filter(option => option.toLowerCase().includes(searchString))
          .forEach(function (option) {
            let optionElement = document.createElement('option');
            optionElement.value = option; // Set nilai sesuai dengan apa yang ingin Anda gunakan
            optionElement.text = option;
            opsi_lanjutan_dropdown.appendChild(optionElement);
          });
    });
</script> --}}


@endsection
