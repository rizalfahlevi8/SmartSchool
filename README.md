# Deskripsi Aplikasi

Aplikasi "Smart School" adalah sebuah platform berbasis Laravel yang dirancang untuk membantu institusi pendidikan dalam mengelola berbagai aspek operasional sekolah, termasuk manajemen siswa, guru, dan administrasi sekolah. Aplikasi ini akan mempermudah pengelolaan data, pengarsipan, dan interaksi antara stakeholder dalam lingkungan pendidikan.

Link smartscholl : [Smart School (click)](https://e-digitaledu.id/)

## Dosen Pembimbing

- Lukie Perdanasari
- Bety Etikasari
- Aji Seto

## Tim Pengembang / MBKM

- Fahim / [https://github.com/Rynare](https://github.com/Rynare)
- Rizal / [https://github.com/rizalfahlevi8](https://github.com/rizalfahlevi8)
- Sultan / [https://github.com/Nov189](https://github.com/Nov189)
- Dimaz / [https://github.com/DimazRM](https://github.com/DimazRM)

## Tim Tefa/Colaborator

- -

## Fitur Utama

Aplikasi "Smart School" akan memiliki beberapa fitur utama, termasuk:

1. Manajemen Siswa: Mendaftarkan, mengupdate, dan mengarsipkan data siswa.
2. Manajemen Guru: Mengelola data guru, jadwal mengajar, dan informasi pribadi guru.
3. Manajemen Kelas: Membuat dan mengelola kelas, serta menghubungkannya dengan guru dan siswa.
4. Penilaian dan Raport: Mencatat penilaian siswa dan menghasilkan raport secara otomatis.
5. Manajemen Administrasi: Mengelola inventaris, dan administrasi sekolah lainnya.
6. Komunikasi: Memfasilitasi komunikasi antara siswa, guru, dan orang tua melalui pesan dan pemberitahuan.

## Panduan Penggunaan

1. Clone repositori ini ke server lokal Anda.
    ```
    git clone https://github.com/Rynare/siakad.git
    ```
2. Masuk ke direktori proyek.
    ```
    cd siakad
    ```
3. Instal dependensi dengan Composer.
    ```
    composer install
    ```
4. Salin file .env.example menjadi .env dan atur konfigurasi database.
    ```
    cp .env.example .env
    ```
5. Generate kunci aplikasi untuk .env.
    ```
    php artisan key:generate
    ```
6. Migrasi dan seeding basis data.
    ```
    php artisan migrate:fresh --seed
    ```
7. Jalankan server lokal.
    ```
    php artisan serve
    ```
8. Buka aplikasi di browser dengan alamat yang muncul pada cmd setelah menjalankan perintah diatas, contoh url : [http://localhost:8000](http://localhost:8000).
<br><br>
# 🚀 LIST DEFAULT ACCOUNT

### 📌 **Admin/root access**
- **Username:** root
- **Password:** admin

### 📌 **Guru/teacher access**
- **Username:** guru
- **Password:** guru

### 📌 **Murid/student access**
- **Username:** siswa
- **Password:** siswa

## Kontribusi

Kami menyambut kontribusi dari siapa saja yang ingin berpartisipasi dalam pengembangan aplikasi "Smart School". Jika Anda ingin berkontribusi, silakan buat pull request dan kami akan meninjau kontribusi Anda.

Terima kasih telah berkontribusi pada proyek "Smart School"!
