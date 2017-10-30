<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_header/aksi_header.php";
switch($_GET[act]){
  // Tampil header
  default:
    echo "<h2>Ganti Header</h2>
          <input type=button  class=tombol value='Tambahkan Header' onclick=location.href='?module=header&act=tambahheader'>
          <table>
          <tr><th>No</th><th>Judul</th><th>Link Berita</th><th>Tgl. Posting</th><th>Aksi</th></tr>";
    $tampil=mysql_query("SELECT * FROM header ORDER BY id_header DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tgl_posting]);
      echo "<tr><td>$no</td>
                <td>$r[judul]</td>
				<td>$r[url]</td>
                <td>$tgl</td>
                <td><a href=?module=header&act=editheader&id=$r[id_header]>Edit</a> | 
	                  <a href=$aksi?module=header&act=hapus&id=$r[id_header]>Hapus</a>
		        </tr>";
    $no++;
    }
    echo "</table>";
    break;
  
  case "tambahheader":
    echo "<h2>Tambahkan Header</h2>
          <form method=POST action='$aksi?module=header&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td>Judul</td><td>  : <input type=text name='judul' size=30></td></tr>
		  <tr><td>Link Berita</td>  <td> : 
          <select name='url'>
            <option value=0 selected>- Pilih Link Berita -</option>";
            $tampil=mysql_query("SELECT * FROM berita ORDER BY id_berita DESC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_berita]-$r[judul_seo]>$r[judul]</option>";
            }
    echo "</select></td></tr>
	<tr><td>Isi Berita</td>  <td> : 
          <select name='judulberita'>
            <option value=0 selected>- Pilih Judul Berita -</option>";
            $tampil=mysql_query("SELECT * FROM berita ORDER BY id_berita DESC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[id_berita]'>$r[judul]</option>";
            }
    echo "</select></td></tr>
          <tr><td>Gambar</td><td> : <input type=file name='fupload' size=40></td></tr>
		  <tr><td colspan=2>*) File gambar (harus jpg) ukuran 940px x 291px.</td></tr>
          <tr><td colspan=2><input type=submit class=tombol value=Simpan>
                            <input type=button class=tombol value=Batal onclick=self.history.back()></td></tr>
          </table></form><br><br><br>";
     break;
    
  case "editheader":
    $edit = mysql_query("SELECT * FROM header WHERE id_header='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Header</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=header&act=update>
          <input type=hidden name=id value=$r[id_header]>
          <table>
          <tr><td>Judul</td><td>     : <input type=text name='judul' size=30 value='$r[judul]'></td></tr>
		  <tr><td>Link Berita</td>  <td> : 
          <select name='url'>
            <option value=0 selected>- Pilih Link Berita -</option>";
            $tampil=mysql_query("SELECT * FROM berita ORDER BY id_berita DESC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_berita]-$r[judul_seo]>$r[judul]</option>";
            }
    echo "</select></td></tr>
	<tr><td>Isi Berita</td>  <td> : 
          <select name='judulberita'>
            <option value=0 selected>- Pilih Judul Berita -</option>";
            $tampil=mysql_query("SELECT * FROM berita ORDER BY id_berita DESC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[id_berita]'>$r[judul]</option>";
            }
    echo "</select></td></tr>
          <tr><td>Gambar</td><td>    : <img width=500 src='../header/$r[gambar]'></td></tr>
          <tr><td>Ganti Gambar</td><td> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) File gambar (harus jpg) ukuran 940px x 291px. Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit class=tombol value=Update>
                            <input type=button class=tombol value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
