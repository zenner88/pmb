<?php
include "../config/koneksi.php";
include "config/library.php";
include "config/fungsi_indotgl.php";
include "config/fungsi_combobox.php";
include "config/class_paging.php";

// Bagian Home
if ($_GET['module']=='home'){
	include 'home.php';         
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
