const notifikasi = $('.info-data').data('infodata');
if (notifikasi == "Login Berhasil" || notifikasi == "Tambah Pengguna Berhasil" || notifikasi == "Data Berhasil diHapus" || notifikasi == "Edit Berhasil" || notifikasi == "Tambah Berhasil" || notifikasi == "Edit Kategori Berhasil" || notifikasi == "User Berhasil diBlokir" || notifikasi == "Aktivasi Pengguna Berhasil") {
  Swal.fire({
    icon: 'success',
    title: 'Sukses',
    text: notifikasi,
  })
} else if (notifikasi == "Login Gagal") {
  Swal.fire({
    icon: 'error',
    title: 'GAGAL',
    text: 'Username atau Password Salah!',
  })
} else if (notifikasi == "Maaf Akses di Tolak") {
  Swal.fire({
    icon: 'warning',
    title: 'MENOLAK AKSES',
    text: notifikasi,
  })
} else if (notifikasi == "Tambah Pengguna Gagal" || notifikasi == "Tambah Projek Gagal" || notifikasi == "Edit Gagal" || notifikasi == "Username Sudah Terdaftar!" || notifikasi == "Data Gagal diHapus" || notifikasi == "Kode Projek Sudah Terdaftar!" || notifikasi == "Edit Kategori Gagal" || notifikasi == "User Gagal diBlokir" || notifikasi == "Aktivasi Pengguna Berhasil" || notifikasi == "Akun Anda Telah diBlokir!" || notifikasi == "Akun anda telah diblokir dari projek!") {
  Swal.fire({
    icon: 'error',
    title: 'GAGAL',
    text: notifikasi,
  })
} else if (notifikasi == "Level Administator Tidak dapat diHapus!" || notifikasi == "Akun anda telah diblokir dari projek") {
  Swal.fire({
    icon: 'warning',
    title: 'PERINGATAN',
    text: notifikasi,
  })
} else if (notifikasi == "Login Projek Gagal") {
  Swal.fire({
    icon: 'error',
    title: 'GAGAL',
    text: 'Gagal, kode atau token salah!',
  })
} else if (notifikasi == "Status Tidak Aktif") {
  Swal.fire({
    icon: 'error',
    title: 'GAGAL',
    text: 'Status projek tidak aktif',
  })
} else if (notifikasi == "Tambah Berhasil") {
  Swal.fire({
    icon: 'success',
    title: 'Sukses',
    text: notifikasi,
  })
}
$('.delete-data').on('click', function (e) {
  e.preventDefault();
  var getLink = $(this).attr('href');

  Swal.fire({
    title: 'Hapus Data?',
    text: "Data akan dihapus permanen",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus'
  }).then((result) => {
    if (result.value) {
      window.location.href = getLink;
    }
  })
});
$('.aktifkan-data').on('click', function (e) {
  e.preventDefault();
  var getLink = $(this).attr('href');

  Swal.fire({
    title: 'Aktifkan Kembali?',
    text: "Akun pengguna akan diaktifkan kembali di projek",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#28A745',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aktifkan'
  }).then((result) => {
    if (result.value) {
      window.location.href = getLink;
    }
  })
});