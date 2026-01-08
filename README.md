# Sistem Informasi Pendaftaran Wisuda

## 1. Latar Belakang & Deskripsi Sistem
Sistem Informasi Pendaftaran Wisuda adalah perangkat lunak berbasis web yang dikembangkan untuk memodernisasi dan mendigitalisasi alur administrasi kelulusan di lingkungan universitas. Sistem ini bertujuan untuk meningkatkan efisiensi validasi data calon wisudawan serta menyediakan transparansi status pendaftaran antara mahasiswa dan biro akademik.

Sistem dibangun menggunakan kerangka kerja **Laravel** dengan manajemen basis data **SQLite**, yang dioptimalkan untuk berjalan pada lingkungan pengembangan lokal **Laravel Herd**.

## 2. Arsitektur Teknologi
Sistem ini dikembangkan dengan spesifikasi teknis sebagai berikut:

* **Framework:** Laravel (PHP)
* **Database Management:** SQLite
* **Database Viewer:** DB Browser for SQLite
* **Local Server Environment:** Laravel Herd
* **Architecture Pattern:** MVC (Model-View-Controller)

## 3. Spesifikasi Fungsional & Logika Bisnis
Sistem menerapkan **Otorisasi Bertingkat (Role-Based Access Control)** yang membedakan hak akses berdasarkan peran pengguna dan status akademik.

### A. Antarmuka Publik (Landing Page)
Halaman muka dirancang interaktif untuk memberikan informasi komprehensif kepada pengguna sebelum melakukan login:
* **Sistem Panduan Pengguna (User Guidance):** Implementasi *Pop-up Modal* otomatis yang menjabarkan alur pendaftaran secara sekunsial.
* **Repositori Dokumen:** Akses cepat (*Forwarding*) untuk mengunduh dokumen legalitas seperti Surat Keputusan (SK) dan Buku Pedoman Wisuda dalam format PDF.
* **Integrasi Multimedia:** Fitur *embedded player* untuk penayangan video profil atau lagu himne "Terima Kasih UNS" sebagai bentuk apresiasi institusi.

### B. Modul Mahasiswa (Validasi Kurikulum)
Sistem memiliki algoritma validasi otomatis untuk memfilter hak akses berdasarkan beban studi (Semester):

1.  **Mahasiswa Belum Eligible (Semester < 7)**
    * **Restriksi Akses:** Menu pendaftaran wisuda dinonaktifkan secara otomatis oleh sistem.
    * **Akses Informasi:** Hak akses terbatas hanya untuk melihat basis data alumni (*Tracer Study*) dan daftar wisudawan terdahulu.

2.  **Mahasiswa Eligible (Semester ≥ 7)**
    * **Pengajuan Wisuda:** Akses penuh untuk mengisi formulir pendaftaran dan unggah berkas persyaratan.
    * **Pelacakan Status:** Mahasiswa dapat memantau status validasi berkas (Menunggu Verifikasi / Disetujui / Ditolak).
    * **Pencetakan Dokumen Bersyarat:** Fitur cetak (Undangan Wisuda & Kartu Tanda Peserta) menggunakan logika *conditional rendering*; tombol cetak hanya akan aktif jika status pendaftaran telah berubah menjadi **"ACC"** (Disetujui) oleh Administrator.

### C. Modul Administrator
* **Verifikasi Data:** Fitur untuk memvalidasi kelengkapan berkas pendaftar dengan opsi persetujuan (ACC) atau penolakan.
* **Manajemen Periode:** Pengaturan siklus wisuda aktif, kuota peserta, dan jadwal pelaksanaan.
* **Sistem Notifikasi:** Mekanisme penyampaian informasi atau revisi berkas kepada dashboard mahasiswa.

## 4. Konfigurasi Instalasi & Penggunaan
Mengingat proyek ini menggunakan data persisten lokal (SQLite) dan Laravel Herd, berikut adalah prosedur operasionalnya:

### Persiapan Database
1.  Pastikan file `database.sqlite` berada pada direktori `/database`.
2.  Gunakan aplikasi **DB Browser for SQLite** untuk membuka, mengedit, atau memantau struktur tabel dan data *dummy* yang telah tersedia.

### Menjalankan Aplikasi
Proyek ini dikonfigurasi untuk berjalan di atas **Laravel Herd**. Oleh karena itu:
1.  **Tidak diperlukan** perintah `php artisan serve`.
2.  Pastikan *Service* Herd telah aktif.
3.  Akses aplikasi secara langsung melalui peramban web (browser) menggunakan domain lokal yang terdeteksi oleh Herd (contoh: `http://nama-folder-project.test`).

---
**Catatan Pengembang:**
Data *dummy* yang digunakan dalam sistem ini telah disesuaikan dengan konteks Bahasa Indonesia untuk keperluan simulasi pengujian fitur.
