# TUGAS WEEK 5 - Otorisasi Laravel (Role, Gate, Policy)

- ![alt text](../../public/images/week5/tabeluser.png)
  Bukti kolom `role` di tabel `users` dan ada minimal 1 akun `admin`.
  Saran ambil dari phpMyAdmin (table users) atau data list users.

- ![alt text](<../../public/images/week5/roleadmin.png>)
  Login sebagai admin, tampilkan badge/teks role di navbar.

- ![alt text](../../public/images/week5/roleuser.png)
  Login sebagai user biasa, tampilkan badge/teks role di navbar.

- ![alt text](../../public/images/week5/exportadmin.png)
  Halaman product saat login admin, tombol Export terlihat.

- ![alt text](../../public/images/week5/exportuser.png)
  Halaman product saat login user, tombol Export tidak terlihat.

- ![alt text](../../public/images/week5/aksesexportuser.png)
  User akses URL export langsung (`/product/export`) dan ditolak (403/unauthorized).

- ![alt text](../../public/images/week5/edituser.png)
  User mengedit produk miliknya sendiri dan berhasil.

- ![alt text](../../public/images/week5/hapusadmin.png)
  Admin menghapus produk milik user lain dan berhasil.

- ![alt text](../../public/images/week5/tampilanuser.png)
  User hanya melihat tombol delete pada produk miliknya, tidak pada produk orang lain.

- ![alt text](../../public/images/week5/createuser.png)
  Form create saat login user: owner terkunci ke diri sendiri (tidak bisa pilih user lain).

- ![alt text](../../public/images/week5/createadmin.png)
  Form create saat login admin: owner bisa dipilih.