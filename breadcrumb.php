<?php
if($_GET['module']=='beranda'){
	echo "<span class='current'><b>Beranda</b></span>";
}
elseif($_GET['module']=='profilkami'){
	echo "<span class='current'><b>Profil</b></span>";
}
elseif($_GET['module']=='carabeli'){
	echo "<span class='current'><b>Cara Pendaftaran Peserta</b></span>";
}
elseif($_GET['module']=='pmdk'){
	echo "<span class='current'><b>Cara Pendaftaran PMDK - Jalur Prestasi</b></span>";
}
elseif($_GET['module']=='reguler'){
	echo "<span class='current'><b>Cara Pendaftaran Reguler</b></span>";
}
elseif($_GET['module']=='semuadownload'){
	echo "<span class='current'><b>Download Katalog</b></span>";
}
elseif($_GET['module']=='hubungikami'){
	echo "<span class='current'><b>Hubungi Kami</b></span>";
}
elseif($_GET['module']=='hubungiaksi'){
	echo "<span class='current'><b>Hubungi Kami</b></span>";
}
elseif($_GET['module']=='hasilcari'){
	echo "<span class='current'><b>Hasil Pencarian</b></span>";
}

elseif($_GET['module']=='detailberita'){
	$detail	=mysql_query("SELECT * FROM berita,users,kategori    
            	          WHERE users.username=berita.username 
                	      AND kategori.id_kategori=berita.id_kategori 
                     	  AND id_berita='$_GET[id]'");
	$d		= mysql_fetch_array($detail);
	echo "<span class='current'><a href='beranda'><b>Beranda</b></a> &#187; <a href=kategori-$d[id_kategori]-$d[kategori_seo].html><b>$d[nama_kategori]</b></a> &#187; <b>$d[judul]</b></span>";
}
elseif($_GET['module']=='detailkategori'){
	$detail	=mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
	$d		= mysql_fetch_array($detail);
	echo "<span class='current'><a href='beranda'><b>Beranda</b></a> &#187; <b>$d[nama_kategori]</b></span>";
}
?>
