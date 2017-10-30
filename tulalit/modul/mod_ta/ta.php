<?php    
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

function GetCheckboxes($table, $key, $Label, $Nilai='') {
  $s = "select * from $table order by nama_tag";
  $r = mysql_query($s);
  $_arrNilai = explode(',', $Nilai);
  $str = '';
  while ($w = mysql_fetch_array($r)) {
    $_ck = (array_search($w[$key], $_arrNilai) === false)? '' : 'checked';
    $str .= "<input type=checkbox name='".$key."[]' value='$w[$key]' $_ck>$w[$Label] ";
  }
  return $str;
}

$aksi="modul/mod_ta/aksi_ta.php";
switch($_GET[act]){
  // Tampil Berita
  default:
    echo "<h2>Tahun Akademik</h2>
          <input type=button value='Tambah Tahun Akademik' onclick=\"window.location.href='?module=tahun&act=tambahta';\">
          <table>
          <tr><th>No</th><th>Tahun Akademik</th><th>Nama Tahun Akademik</th><th>Status</th><th>Aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

   // if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM t_tahun_akademik ORDER BY id_thn_akademik DESC LIMIT $posisi,$batas");
    //}
    //else{
     // $tampil=mysql_query("SELECT * FROM berita 
     //                      WHERE username='$_SESSION[namauser]'       
      //                     ORDER BY id_berita DESC LIMIT $posisi,$batas");
   // }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tgl_posting=tgl_indo($r[tanggal]);
      echo "<tr class=menucell onMouseDown=pviiClassNew(this,'mousedown') onMouseOut=pviiClassNew(this,'menucell') onMouseOver=pviiClassNew(this,'mouseover')>
	  			<td>$no</td>
                <td>$r[d_akademik]</td>
				<td>$r[n_akademik]</td>
				<td>$r[status]</td>
		        <td><a href=?module=tahun&act=editta&id=$r[id_thn_akademik]>Edit</a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";

    //if ($_SESSION[leveluser]=='admin'){
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM t_tahun_akademik"));
   // }
   // else{
   //   $jmldata = mysql_num_rows(mysql_query("SELECT * FROM berita WHERE username='$_SESSION[namauser]'"));
   // }  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<p>Hal: $linkHalaman</p><br>";
 
    break;
  
  case "tambahta":
    echo "<h2>Tambah Tahun Akademik</h2>
          <form method=POST action='$aksi?module=tahun&act=input' enctype='multipart/form-data'>
          <table>
		  <tr><td>Tahun Akademik</td>     <td> : <input type=text name='d_akademik' size=20></td></tr>
		  <tr><td>Nama Tahun Akademik</td>     <td> : <input type=text name='n_akademik' size=20></td></tr>
		  <tr><td>Status</td>  <td> : 
		  <select name='status'>
		      <option value=0 selected>- Pilih Status Tahun Akademik -</option>
			  <option value=on>On</option>
			  <option value=off>Off</option>
			  </select>
		  </td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "editta":
    $edit = mysql_query("SELECT * FROM t_tahun_akademik WHERE id_thn_akademik='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Ubah Jenjang Program Studi</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=tahun&act=update>
          <input type=hidden name=id value=$r[id_thn_akademik]>
          <table>
          <tr><td>Tahun Akademik</td>     <td> : <input type=text name='d_akademik' size=20 value='$r[d_akademik]'></td></tr>
		  <tr><td>Nama Tahun Akademik</td>     <td> : <input type=text name='n_akademik' size=20 value='$r[n_akademik]'></td></tr>
		  <tr><td>Status</td>  <td> : 
		  <select name='status'>
		      <option value=0 selected>- Pilih Status Tahun Akademik -</option>
			  <option value=on>On</option>
			  <option value=off>Off</option>
			  </select>
		  </td></tr>
		  <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}
}
?>
