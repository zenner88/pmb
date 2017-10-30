<?php
session_start();
 if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_pin/aksi_pin.php";
switch($_GET[act]){
  // Tampil Data Pin PMB
  default:
    echo "<h2>PIN PMB</h2>";
	if($_SESSION['level']<>7){
    echo"<input type=button value='Tambah PIN' onclick=\"window.location.href='?module=pin&act=tambahpin';\">";
	}
    echo"<table>";
	if($_SESSION['level']<>7){
	echo"<a href=modul/mod_cetak/preview_pin.php target=_blank>Print Preview</a> || <a href=modul/mod_cetak/excel_pin.php>Ekspor ke Excel</a>";
	}
    	echo"<tr><th>No</th><th>No Pin</th><th>Kode Aktivasi</th><th>Status</th>";
	if($_SESSION['level']<>7){	  
	echo"<th>Is Online</th>";
	}	
	echo"</tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

   
      $tampil = mysql_query("SELECT * FROM t_pin ORDER BY id DESC LIMIT $posisi,$batas");

    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      echo "<tr class=menucell onMouseDown=pviiClassNew(this,'mousedown') onMouseOut=pviiClassNew(this,'menucell') onMouseOver=pviiClassNew(this,'mouseover')>
	  			<td>$no</td>
                <td>$r[pin]</td>
				<td>$r[kd_aktivasi]</td>";
	if($_SESSION['level']==7){
		if($r[status_jual]=="baru") {
				echo"<td align=center><a href='$aksi?module=pin&act=terjual&id=$r[id]'>Baru</a></td>";
		} elseif($r[status_jual]=="terjual") {
				echo"<td align=center><font color=red>Terjual</font></td>";
		}
	}else{
		if($r[status]=="aktif") {
				echo"<td align=center>Aktif</td>";
		} elseif($r[status]=="nonaktif") {
				echo"<td align=center>Non-Aktif</td>";
		}
	}
		
	if($_SESSION['level']<>7){
		if($r[is_online]==0) {
				echo"<td align=center><img src='icon/off1.png' height=16 weight=16></td>";
		} elseif($r[is_online]==1) {
				echo"<td align=center><img src='icon/on1.png' height=16 weight=16></td>";
		}
	}
	  echo"</tr>";
      $no++;
    }
    echo "</table>";

      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM t_pin"));

    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<p>Hal: $linkHalaman</p><br>";

    break;

  case "tambahpin":
    echo "<h2>Tambah PIN PMB</h2>
          <form method=POST action='$aksi?module=pin&act=input' enctype='multipart/form-data'>
          <table>
		  <tr><td>Jumlah Pin Yang Akan Dicetak</td>     <td> : <input type=text name='pin_pmb' size=20></td></tr>
		  <tr><td>Jalur</td>     <td> :
		  <select name='jalur'>
            <option value='0' selected>- Pilih Status PIN -</option>
			<option value=reguler>Reguler</option>
			<option value=pmdk>PMDK</option>
		  </select>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;

  case "editpin":
    $edit = mysql_query("SELECT * FROM t_pin WHERE id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Ubah Pin PMB</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=pin&act=update>
          <input type=hidden name=id value=$r[id]>
          <table>
          <tr><td>Nomer PIN PMB</td>     <td> : <input type=text name='pin_pmb' size=20 value='$r[pin]'></td></tr>
		  <tr><td>Kode Aktivasi</td>     <td> : <input type=text name='kd_aktivasi' size=20 value='$r[kd_aktivasi]'></td></tr>";
	echo "  <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;
}
}
?>