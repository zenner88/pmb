<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_chatbox/aksi_chatbox.php";
switch($_GET[act]){
  // Tampil Shoutbox
  default:
    echo "<h2>Kelola Chatbox</h2>
          <table>
          <tr><th>No</th><th>Nama</th><th>Pesan</th><th>Email</th><th>Aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil=mysql_query("SELECT * FROM chatbox ORDER BY ID DESC LIMIT $posisi,$batas");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no</td>
                <td width=80>$r[name]</td>
                <td width=290>$r[comments]</td>
                <td width=50 align=center>$r[email]</td>
                <td><a href=$aksi?module=chatbox&act=hapus&id=$r[ID]><b>Hapus</b></a>
		        </tr>";
      $no++;
    }
    echo "</table>";
    $jmldata=mysql_num_rows(mysql_query("SELECT * FROM chatbox"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
    break;
   
}
}
?>
