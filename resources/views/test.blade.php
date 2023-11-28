<form action="/api/request-dd" method="POST">
    @csrf
    <!-- Input untuk data pengguna -->
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" value="{{ old('nama') }}">

    <label for="umur">Umur:</label>
    <input type="number" id="umur" name="umur" value="{{ old('umur') }}">

    <!-- Input untuk data alamat bersarang -->
    <label for="alamat">Alamat:</label>
    @php
        $kota = 'kota';
    @endphp
    <input type="text" id="alamat_jalan" name="alamat[jalan]" placeholder="Jalan" value="{{ old('alamat.jalan') }}">
    <input type="text" id="alamat_kota" name="alamat[kota]" placeholder="Kota" value="{{ old('alamat.' . $kota) }}">
    <input type="text" id="alamat_negara" name="alamat[negara]" placeholder="Negara"
        value="{{ old('alamat.negara') }}">

    <!-- Input untuk data lainnya -->
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}">

    <label for="telepon">Telepon:</label>
    <input type="tel" id="telepon" name="telepon" value="{{ old('telepon') }}">

    <!-- Tombol untuk mengirimkan formulir -->
    <button type="submit">Kirim</button>
</form>
