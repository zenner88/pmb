<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";
include "../config/fungsi_rupiah.php";

// Bagian Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='admin'){
  echo "<h2>Selamat Datang</h2>
          <p>Hai <b>". $_SESSION['namalengkap']."</b>, selamat datang di halaman Administrator.<br> Silahkan klik menu pilihan yang berada 
          di sebelah kiri untuk mengelola konten website anda. </p>
          <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
  }else{
  echo "<h2>Selamat Datang</h2>
          <p>Hai <b>".$_SESSION['namalengkap']."</b>, selamat datang di halaman <b>Jurusan</b>.<br> Silahkan klik menu pilihan yang berada 
          di sebelah kiri untuk mengelola konten website anda. </p>
          <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
  }
}

// Bagian Modul
elseif ($_GET['module']=='modul'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_modul/modul.php";
  }
}

// Bagian Modul
elseif ($_GET['module']=='herregistrasi'){
  if ($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='petugas'){
    include "modul/mod_herregistrasi/herregistrasi.php";
  }
}

// Bagian pin
elseif ($_GET['module']=='pin'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_pin/mod_pin.php";
  }
}

// Bagian Pendaftar
elseif ($_GET['module']=='daftar'){
  if ($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='petugas')  {
    include "modul/mod_daftar/daftar.php";
  }
}

// Bagian mhsundangan
elseif ($_GET['module']=='mhsundangan'){
  if ($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='petugas')  {
    include "modul/mod_mhsundangan/undangan.php";
  }
}

// Bagian Cek Belum Isi Biodata
elseif ($_GET['module']=='biodata'){
  if ($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='petugas')  {
    include "modul/mod_biodata/biodata.php";
  }
}

// Bagian tahun
elseif ($_GET['module']=='tahun'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_ta/ta.php";
  }
}

// Bagian gelombang
elseif ($_GET['module']=='gelombang'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_gelombang/gelombang.php";
  }
}

// Bagian mhs pmdk
elseif ($_GET['module']=='mhspmdk'){
  if ($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='petugas'){
    include "modul/mod_mhspmdk/mhspmdk.php";
  }
}

// Bagian mhs reguler
elseif ($_GET['module']=='mhsreguler'){
  if ($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='petugas'){
    include "modul/mod_mhsreguler/mhsreguler.php";
  }
}

// Bagian Kategori Berita Jurusan
elseif ($_GET['module']=='kategori'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kategori/kategori.php";
  }
}

// Bagian Berita
elseif ($_GET['module']=='berita'){
  //if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_berita/berita.php";
  //}
}

// Bagian Profil
elseif ($_GET['module']=='profil'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_profil/profil.php";
  }
}

// Bagian Hubungi Kami/Pesan Masuk
elseif ($_GET['module']=='hubungi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_hubungi/hubungi.php";
  }
}

// Bagian Cara Pembelian
elseif ($_GET['module']=='carabeli'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_carabeli/carabeli.php";
  }
}

// Modul bank
elseif ($_GET['module']=='bank'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_bank/bank.php";
  }
}

// Bagian Banner
elseif ($_GET['module']=='banner'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_banner/banner.php";
  }
}

// Bagian Header
elseif ($_GET['module']=='header'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_header/header.php";
  }
}

// Bagian Menu Utama
elseif ($_GET['module']=='menuutama'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_menuutama/menuutama.php";
  }
}

// Bagian Sub Menu
elseif ($_GET['module']=='submenu'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_submenu/submenu.php";
  }
}

// Bagian Password
elseif ($_GET['module']=='password'){
  //if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_password/password.php";
  //}
}

// Bagian Laporan
elseif ($_GET['module']=='laporan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_laporan/laporan.php";
  }
}

// Bagian YM
elseif ($_GET['module']=='ym'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_ym/ym.php";
  }
}

// Bagian Selamat Datang
elseif ($_GET['module']=='welcome'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_welcome/welcome.php";
  }
}

// Bagian Download
elseif ($_GET['module']=='download'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_download/download.php";
  }
}

// Bagian Chatbox
elseif ($_GET['module']=='chatbox'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_chatbox/chatbox.php";
  }
}

// Bagian Tag
elseif ($_GET['module']=='tag'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_tag/tag.php";
  }
}

// Bagian User
elseif ($_GET['module']=='user'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_users/users.php";
  }
}

// Bagian Pendaftaran PMDK
elseif ($_GET['module']=='pmdk'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_pmdk/pmdk.php";
  }
}

// Bagian Pendaftaran Reguler
elseif ($_GET['module']=='reguler'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_reguler/reguler.php";
  }
}

// Bagian Biaya
elseif ($_GET['module']=='biaya'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_biaya/biaya.php";
  }
}

// Bagian Album
elseif ($_GET['module']=='album'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_album/album.php";
  }
}

// Bagian Galeri Foto
elseif ($_GET['module']=='galerifoto'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_galerifoto/galerifoto.php";
  }
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
