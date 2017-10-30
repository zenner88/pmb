<?php
include "../config/koneksi.php";
include "config/library.php";
include "config/fungsi_indotgl.php";
include "config/fungsi_combobox.php";
include "config/class_paging.php";

// Bagian Home
if ($_GET['module']=='home'){
  echo "<h2>Selamat Datang</h2>
 <p align=right>Login : $hari_ini,";
  echo date("Y m d");
  echo " | ";
  echo date("H:i:s");
  echo " WIB</p>
Halaman Penerimaan Mahasiswa Baru Online Politeknik Pos Indonesia.<br><br>
			<p>Nama : <br><b>$_SESSION[nama]</b> <br>
			<p>NISN : <br><b>$_SESSION[nis]</b> <br>
			<p>No Pendaftaran : <br><b>$_SESSION[kode_briva]</b> <br>
          Jalur Pendaftaran : <br><b>$_SESSION[jalur_pendaftaran]</b> <br>
	   Pilihan Perguruan Tinggi : <br><b>$_SESSION[pilihan]</b></p><br><br>
Pilih menu <B>REGISTRASI</B> untuk mengisi bioadata, print hasil registrasi sebagai bukti registrasi.
Cetak kartu ujian dilakukan setelah proses registrasi sudah dilengkapi.<br><br>

Terima Kasih.

		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>";


         
}

// Bagian Registrasi
elseif ($_GET['module']=='registrasi'){
    include "modul/mod_registrasi/registrasi.php";
} elseif ($_GET['module']=='biodata')
	{
		include "modul/mod_kartuujian/kartuujian.php";
	}
	elseif ($_GET['module']=='kartuujian')
	{
		include "modul/mod_biodata/kartu.php";
	}
		elseif ($_GET['module']=='updatebio')
	{
		include "modul/mod_updatebio/updatebio.php";
	}
			elseif ($_GET['module']=='konfirmpay')
	{
		include "modul/mod_konfirmpay/konfirmpay.php";
	}
	elseif ($_GET['module']=='herregistrasi')
	{
		include "modul/mod_herregistrasi/herregistrasi.php";
	}
// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}

?>
