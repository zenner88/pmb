<?php
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus header
if ($module=='header' AND $act=='hapus'){
  mysql_query("DELETE FROM header WHERE id_header='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input header
elseif ($module=='header' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  
  $edit = mysql_query("SELECT * FROM berita WHERE id_berita='$_POST[judulberita]'");
  $r    = mysql_fetch_array($edit);
  $isi_berita = htmlentities(strip_tags($r['isi_berita'])); // membuat paragraf pada isi berita dan mengabaikan tag html
  $isi = substr($isi_berita,0,250); // ambil sebanyak 220 karakter
  $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadHeader($nama_file);
    mysql_query("INSERT INTO header(judul,
                                    url,
									judulberita,
                                    tgl_posting,
                                    gambar) 
                            VALUES('$_POST[judul]',
                                   '$_POST[url]',
								   '$isi',
                                   '$tgl_sekarang',
                                   '$nama_file')");
  }
  else{
    mysql_query("INSERT INTO header(judul,
                                    tgl_posting,
                                    url,
									judulberita) 
                            VALUES('$_POST[judul]',
                                   '$tgl_sekarang',
                                   '$_POST[url]',
								   '$isi')");
  }
  header('location:../../media.php?module='.$module);
}

// Update header
elseif ($module=='header' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  
  $edit = mysql_query("SELECT * FROM berita WHERE id_berita='$_POST[judulberita]'");
  $r    = mysql_fetch_array($edit);
  $isi_berita = htmlentities(strip_tags($r['isi_berita'])); // membuat paragraf pada isi berita dan mengabaikan tag html
  $isi = substr($isi_berita,0,250); // ambil sebanyak 220 karakter
  $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE header SET judul     = '$_POST[judul]',
                                   url       = '$_POST[url]',
								   judulberita       = '$isi'
                             WHERE id_header = '$_POST[id]'");
  }
  else{
    UploadHeader($nama_file);
    mysql_query("UPDATE header SET judul     = '$_POST[judul]',
                                   url       = '$_POST[url]',
								   judulberita       = '$isi',
                                   gambar    = '$nama_file'   
                             WHERE id_header = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
?>
