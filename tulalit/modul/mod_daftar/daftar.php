<?php 
// session_start();
 if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
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

//include "config/fungsi_indotgl.php"; 
$aksi="modul/mod_daftar/aksi_daftar.php";
switch(isset($_GET['act'])){

  // Tampil Berita
  default:
    // include "menu_atas.php";

    echo "<h2>Data Pendaftaran</h2><br>
	      <!-- <a href='modul/mod_cetak/preview_posreguler.php' target='_blank'>Print Preview</a> || <a href='modul/mod_cetak/excel_posreguler.php'>Ekspor ke Excel</a>-->
          <form method=get action='$_SERVER[PHP_SELF]'>
          <input type=hidden name=module value=daftar>
          <div id=paging>Masukkan Nama : <input type=text name='kata'> <input type=submit class='tombol' value=Cari></div>
          </form>
		  <hr>
		  <div style='background:#FCF886'>
		  <B>CETAK LAPORAN</B> </br>
		  <form method='POST' action='modul/mod_cetak/preview_posreguler.php' target='_blank'>
          <input type=hidden name=module value=daftar>
          <div id=paging>
		  <B> &nbsp &nbsp PT :</B> <input type=radio name='pt' value='1' checked> POLTEKPOS  <input type=radio name='pt' value='2'> STIMLOG  | 
		  <B>Jalur :</B> <input type=radio name='jalur' value='0' checked> PMDK  <input type=radio name='jalur' value='2' checked> UNDANGAN <input type=radio name='jalur' value='1'> REGULER | 
		  <B>Bayar :</B> <input type=radio name='status' value='bayar' checked> Sudah <input type=radio name='status' value='belum'> Belum |
		  
				
		  <input type=submit class='tombol' value=Cetak></div>
          </form>
		  <form method='POST' action='modul/mod_cetak/lappembayaran.php' target='_blank'>
          <input type=hidden name=module value=daftar>
          <div id=paging>
		  <B>&nbsp &nbsp PEMBAYARAN MELALUI:</B> <input type=radio name='jenis' value='semua' checked> Semua Pembayaran 
                                	<input type=radio name='jenis' value='giropos'> Giropos 
					<input type=radio name='jenis' value='bni'> BNI
					<input type=radio name='jenis' value='kwitansi pmb'> Kwitansi PMB	  
				  <input type=submit class='tombol' value=Cetak></div>
          </form>

<form method='POST' action='modul/mod_cetak/validator.php' target='_blank'>
          <input type=hidden name=module value=daftar>
          <div id=paging>
		  <B> &nbsp &nbsp VALIDATOR :</B>";
  $query_lks=mysql_query("select * from admins where blokir='N' order by nama_lengkap");
  ?>
				  <select name="validator" size="1" >
				   <option selected="selected" value="semua">Cetak Semua</option>
                            <?php while ($row_lks=mysql_fetch_array($query_lks))
   {;?>
                            <option value ="<?php echo $row_lks['username'];?>"><?php echo $row_lks['nama_lengkap'];?></option>
                            <?php }
echo"
                        </select>		  
				
		  <input type=submit class='tombol' value=Cetak></div>
          </form>
</div><hr>
		  ";

    if (empty($_GET['kata'])){
    echo "<table>  
          <tr><th>No</th><th>No.Registrasi</th>
<th>NISN</th>
		  <th>Password</th>
<th>Nama Lengkap</th>
<th>No Telp</th>
<th>Email</th>
<th>Pilihan</th>
<th>Jalur</th>
<th>Tanggal Daftar</th>
<th>Status</th>
<th>Bukti Pembayaran</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    if ($_SESSION['leveluser']=='admin'){
      $tampil = mysql_query("SELECT * from t_daftar order by id_daftar DESC
						LIMIT $posisi,$batas");
    }
    else{
      $tampil=mysql_query("SELECT * from t_daftar order by id_daftar DESC
						LIMIT $posisi,$batas");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      ?>
    <tr class="menucell" onMouseDown="pviiClassNew(this,'mousedown')" onMouseOut="pviiClassNew(this,'menucell')" onMouseOver="pviiClassNew(this,'mouseover')">
	<td><?=$no?></td>
       <?PHP
       if ($r['status'] == "belum")
	{
		echo "<td><a href='?module=daftar&act=update&id=".$r['kode_briva']."'>".$r['kode_briva']."		</a></td>";
	}
	elseif ($r['status'] == "bayar")
	{
		echo "<td>".$r['kode_briva']."</td>";
	}
      else
	{
		echo "<td>-</td>";
	}
	?>
<td><?=$r['nis']?></td>
	<td><?=$r['password']?></td>
	<td><?=$r['nama']?></td>
	
       <td><?=$r['no_tlp']?></td>
	<td><?=$r['email']?></td>
       <?php
	if ($r['pilihan'] == "1")
	{
		echo "<td>POLTEKPOS</td>";
	}
	elseif ($r['pilihan'] == "2")
	{
		echo "<td>STIMLOG</td>";
	}
	else
	{
		echo "<td>-</td>";
	}
	?>

	<?php
	if ($r['jalur_pendaftaran'] == "0")
	{
		echo "<td>PMDK</td>";
	}
	elseif ($r['jalur_pendaftaran'] == "1")
	{
		echo "<td>REGULER</td>";
	}
	elseif ($r['jalur_pendaftaran'] == "2")
	{
		echo "<td>UNDANGAN</td>";
	}
	else
	{
		echo "<td>-</td>";
	}
	?>

       <td><?=$r['tgl_daftar']?></td>
<?php
	if ($r['status'] == "bayar")
	{
		echo "<td><font color='green'>".$r['status']."</font></td>";
	}
	elseif ($r['status'] == "belum")
	{
		echo "<td><font color='red'>".$r['status']."</font></td>";
	}
	else
	{
		echo "<td><font color='orange'>".$r['status']."</font></td>";
	}


	if ($r['status'] == "bayar")
	{?>
		<td><a href="bukti_pembayaran/<?=$r['bukti_pembayaran'];?>" onClick="return GB_showCenter('Tentang Web', this.href)"><?=$r['bukti_pembayaran'];?></a></td>
	<?PHP
	}
	elseif ($r['status'] == "belum")
	{
		echo "<td>-</td>";
	}
	else
	{
		echo "<td>-</td>";
	}

	echo "</tr>";
      $no++;
    }
    echo "</table>";

    if ($_SESSION['leveluser']=='admin'){
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM t_daftar"));
    }
    else{
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM t_daftar"));
    }  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

    echo "<div id=paging>$linkHalaman</div><br>";
$jum_total = mysql_num_rows(mysql_query("SELECT * FROM t_daftar"));
$jum_reg = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='1'"));
$jum_pmdk = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='0'"));
$jum_undangan = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='2'"));
$jum_bayar= mysql_num_rows(mysql_query("SELECT * FROM t_daftar where status='bayar'"));
$jum_belum = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where status='belum'"));

$jum_total_p = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where pilihan='1'"));
$jum_reg_p = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='1' and pilihan='1'"));
$jum_pmdk_p = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='0' and pilihan='1'"));
$jum_undangan_p = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='0' and pilihan='2'"));
$jum_bayar_p= mysql_num_rows(mysql_query("SELECT * FROM t_daftar where status='bayar' and pilihan='1'"));
$jum_belum_p = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where status='belum' and pilihan='1'"));

$jum_total_s = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where pilihan='2'"));
$jum_reg_s = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='1' and pilihan='2'"));
$jum_pmdk_s = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='0' and pilihan='2'"));
$jum_undangan_s = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='0' and pilihan='2'"));
$jum_bayar_s= mysql_num_rows(mysql_query("SELECT * FROM t_daftar where status='bayar' and pilihan='2'"));
$jum_belum_s = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where status='belum' and pilihan='2'"));
    
echo"
<table>  
<tr colspan='6'><b>Statistika Total</b></th> 
<tr><th>No</th><th>Jumlah Reguler</th>
<th>Jumlah PMDK</th>
<th>Jumlah Undangan</th>
<th>Jumlah Sudah Bayar</th>
<th>Jumlah Belum Bayar</th>
<th>Total Pendaftar</th>
</tr>
<tr>
<td>1. </td>
<td>$jum_reg </td>
<td>$jum_pmdk </td>
<td>$jum_undangan </td>
<td>$jum_bayar</td>
<td>$jum_belum </td>
<td>$jum_total</td>
</tr>
</table>

<table> 
<tr colspan='6'><b>Statistika Poltekpos</b></th> 
<tr><th>No</th><th>Jumlah Reguler</th>
<th>Jumlah PMDK</th>
<th>Jumlah Undangan</th>
<th>Jumlah Sudah Bayar</th>
<th>Jumlah Belum Bayar</th>
<th>Total Pendaftar</th>
</tr>
<tr>
<td>1. </td>
<td>".$jum_reg_p." </td>
<td>".$jum_pmdk_p." </td>
<td>".isset($jum_Undangan_p)." </td>
<td>".$jum_bayar_p."</td>
<td>$jum_belum_p </td>
<td>$jum_total_p</td>
</tr>

<table> 
<tr colspan='6'><b>Statistika Stimlog</b></th> 
<tr><th>No</th><th>Jumlah Reguler</th>
<th>Jumlah PMDK</th>
<th>Jumlah Undangan</th>
<th>Jumlah Sudah Bayar</th>
<th>Jumlah Belum Bayar</th>
<th>Total Pendaftar</th>
</tr>
<tr>
<td>1. </td>
<td>$jum_reg_s </td>
<td>$jum_pmdk_s </td>
<td>".isset($jum_Undangan_s)." </td>
<td>".isset($jum_bayar_s)."</td>
<td>$jum_belum_s </td>
<td>$jum_total_s</td>
</tr>

</table>
";
    break;    
    }
    else{
    echo "<table>  
          <tr><th>No</th><th>No.Registrasi</th>
<th>Password</th>
<th>Nama Lengkap</th>
<th>No Telp</th>
<th>Email</th>
<th>Pilihan</th>
<th>Jalur</th>
<th>Tanggal Daftar</th>
<th>Status</th>
<th>Bukti Pembayaran</th></tr>";

    $p      = new Paging9;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    if ($_SESSION['leveluser']=='admin'){
      $tampil = mysql_query("SELECT * from t_daftar WHERE nama LIKE '%$_GET[kata]%' ORDER BY id_daftar DESC LIMIT $posisi,$batas");
    }
    else{
      $tampil=mysql_query("SELECT * FROM t_daftar 
                           WHERE 
                           nama LIKE '%$_GET[kata]%'       
                           ORDER BY id_daftar DESC LIMIT $posisi,$batas");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      ?>
    <tr class="menucell" onMouseDown="pviiClassNew(this,'mousedown')" onMouseOut="pviiClassNew(this,'menucell')" onMouseOver="pviiClassNew(this,'mouseover')">
	<td><?=$no?></td>
       <?PHP
       if ($r['status'] == "belum")
	{
		echo "<td><a href='?module=daftar&act=update&id=".$r['kode_briva']."'>".$r['kode_briva']."</a></td>";
	}
	elseif ($r['status'] == "bayar")
	{
		echo "<td>".$r['kode_briva']."</td>";
	}
      else
	{
		echo "<td>-</td>";
	}
	?>

	<td><?=$r['password']?></td>
	<td><?=$r['nama']?></td>
	
       <td><?=$r['no_tlp']?></td>
	<td><?=$r['email']?></td>
       <?php
	if ($r['pilihan'] == "1")
	{
		echo "<td>POLTEKPOS</td>";
	}
	elseif ($r['pilihan'] == "2")
	{
		echo "<td>STIMLOG</td>";
	}
	else
	{
		echo "<td>-</td>";
	}
	?>

	<?php
	if ($r['jalur_pendaftaran'] == "0")
	{
		echo "<td>PMDK</td>";
	}
	elseif ($r['jalur_pendaftaran'] == "1")
	{
		echo "<td>REGULER</td>";
	}
	elseif ($r['jalur_pendaftaran'] == "2")
	{
		echo "<td>UNDANGAN</td>";
	}
	else
	{
		echo "<td>-</td>";
	}
	?>

       <td><?=$r['tgl_daftar']?></td>
<?php
	if ($r['status'] == "bayar")
	{
		echo "<td><font color='green'>".$r['status']."</font></td>";
	}
	elseif ($r['status'] == "belum")
	{
		echo "<td><font color='red'>".$r['status']."</font></td>";
	}
	else
	{
		echo "<td><font color='orange'>".$r['status']."</font></td>";
	}
      if ($r['status'] == "bayar")
	{
	?>
		<td><a href="bukti_pembayaran/<?=$r['bukti_pembayaran'];?>" onClick="return GB_showCenter('Tentang Web', this.href)"><?=$r['bukti_pembayaran'];?></a></td>
	<?PHP
	}
	elseif ($r['status'] == "belum")
	{
		echo "<td>-</td>";
	}
	else
	{
		echo "<td>-</td>";
	}
	echo "</tr>";
      $no++;
    }
    echo "</table>";

    if ($_SESSION['leveluser']=='admin'){
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM t_daftar WHERE nama LIKE '%$_GET[kata]%'"));
    }
    else{
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM t_daftar WHERE nama LIKE '%$_GET[kata]%'"));
    }  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

    echo "<div id=paging>$linkHalaman</div><br>";
$jum_total = mysql_num_rows(mysql_query("SELECT * FROM t_daftar"));
$jum_reg = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='1'"));
$jum_pmdk = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='0'"));
$jum_undangan = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='2'"));
$jum_bayar= mysql_num_rows(mysql_query("SELECT * FROM t_daftar where status='bayar'"));
$jum_belum = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where status='belum'"));

$jum_total_p = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where pilihan='1'"));
$jum_reg_p = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='1' and pilihan='1'"));
$jum_pmdk_p = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='0' and pilihan='1'"));
$jum_undangan_p = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='0' and pilihan='2'"));
$jum_bayar_p= mysql_num_rows(mysql_query("SELECT * FROM t_daftar where status='bayar' and pilihan='1'"));
$jum_belum_p = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where status='belum' and pilihan='1'"));

$jum_total_s = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where pilihan='2'"));
$jum_reg_s = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='1' and pilihan='2'"));
$jum_pmdk_s = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='0' and pilihan='2'"));
$jum_undangan_s = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where jalur_pendaftaran='0' and pilihan='2'"));
$jum_bayar_s= mysql_num_rows(mysql_query("SELECT * FROM t_daftar where status='bayar' and pilihan='2'"));
$jum_belum_s = mysql_num_rows(mysql_query("SELECT * FROM t_daftar where status='belum' and pilihan='2'"));
    
echo"
<table>  
<tr colspan='6'><b>Statistika Total</b></th> 
<tr><th>No</th><th>Jumlah Reguler</th>
<th>Jumlah PMDK</th>
<th>Jumlah Undangan</th>
<th>Jumlah Sudah Bayar</th>
<th>Jumlah Belum Bayar</th>
<th>Total Pendaftar</th>
</tr>
<tr>
<td>1. </td>
<td>$jum_reg </td>
<td>$jum_pmdk </td>
<td>$jum_undangan </td>
<td>$jum_bayar</td>
<td>$jum_belum </td>
<td>$jum_total</td>
</tr>
</table>

<table> 
<tr colspan='6'><b>Statistika Poltekpos</b></th> 
<tr><th>No</th><th>Jumlah Reguler</th>
<th>Jumlah PMDK</th>
<th>Jumlah Undangan</th>
<th>Jumlah Sudah Bayar</th>
<th>Jumlah Belum Bayar</th>
<th>Total Pendaftar</th>
</tr>
<tr>
<td>1. </td>
<td>$jum_reg_p </td>
<td>$jum_pmdk_p </td>
<td>$jum_undangan_p </td>
<td>$jum_bayar_p</td>
<td>$jum_belum_p </td>
<td>$jum_total_p</td>
</tr>

<table> 
<tr colspan='6'><b>Statistika Stimlog</b></th> 
<tr><th>No</th><th>Jumlah Reguler</th>
<th>Jumlah PMDK</th>
<th>Jumlah Undangan</th>
<th>Jumlah Sudah Bayar</th>
<th>Jumlah Belum Bayar</th>
<th>Total Pendaftar</th>
</tr>
<tr>
<td>1. </td>
<td>$jum_reg_s </td>
<td>$jum_pmdk_s </td>
<td>$jum_undangan_s </td>
<td>$jum_bayar_s</td>
<td>$jum_belum_s </td>
<td>$jum_total_s</td>
</tr>

</table>
";
}
    break;
  
    
  
	case"update":
?>
<script language="javascript">
function validasi(form){
  if (form.bukti_pembayaran.value == ""){
    alert("Bukti Pembayaran masih kosong ");
    form.bukti_pembayaran.focus();
    return (false);

  }
 
  return (true);
}
</script>

<?PHP
	$edit = mysql_query("SELECT * from t_daftar
					WHERE kode_briva='$_GET[id]'");
	$r = mysql_fetch_array($edit);

?>
	<h2>Konfirmasi Pembayaran Pendaftaran</h2>
	<?PHP echo "
		  <form method=POST enctype='multipart/form-data' action='$aksi?module=daftar&act=edit' onSubmit='return validasi(this)'>";?>
		<table>
 			<tr>
    			<td>
					<table>
						<h3>Data Pendaftaran</h3>
						<tr><td>Nama</td><td> : <?=$r['nama']?></td></tr>
						<tr><td>No Pendaftaran</td><td> : <?=$r['kode_briva']?></td></tr>
						<tr><td>NISN</td><td> : <?=$r['nis']?></td></tr>
						<tr><td>Email</td><td> : <?=$r['email']?></td></tr>
						<tr><td>No Telp</td><td> : <?=$r['no_tlp']?></td></tr>
<?php
	if ($r['pilihan'] == "1")
	{
		echo "<tr><td>Pilihan</td><td> : POLTEKPOS</td></tr>";
	}
	elseif ($r['pilihan'] == "2")
	{
		echo "<tr><td>Pilihan</td><td> : STIMLOG</td></tr>";
	}
	else
	{
		echo "<tr><td>Pilihan</td><td> : -</td></tr>";
	}
	?>

	<?php
	if ($r['jalur_pendaftaran'] == "0")
	{
		echo "<tr><td>Jalur</td><td> : PMDK</td></tr>";
	}
	elseif ($r['jalur_pendaftaran'] == "1")
	{
		echo "<tr><td>Jalur</td><td> : REGULER</td></tr>";
	}
	elseif ($r['jalur_pendaftaran'] == "2")
	{
		echo "<tr><td>Jalur</td><td> : UNDANGAN</td></tr>";
	}
	else
	{
		echo "<tr><td>Jalur</td><td> : -</td></tr>";
	}
	?>
						
						<tr><td>Tanggal Daftar</td><td> : <?=$r['tgl_daftar']?></td></tr>
        				
						<tr><td>Status</td><td> : <?=$r['status']?></td></tr>
					</table>
				
    			<td>
					<table>
						<h3>Konfirmasi Pembayaran</h3>
						
<?PHP 
if ($r['status']=='belum'){
      echo "<tr><td>Setting Pembayaran *</td>     <td> : <input type=radio name='status' value='bayar'> Sudah Bayar   
                                           <input type=radio name='status' value='belum' checked> Belum Bayar</td></tr>";
    }
    else{
      echo "<tr><td>Setting Pembayaran *</td>     <td> : <input type=radio name='status' value='bayar' checked> Sudah Bayar  
                                          <input type=radio name='status' value='belum'> Belum Bayar</td></tr>";
}
?>
<tr><td>Jenis Bukti Pembayaran * </td><td> : <input type=radio name='jenis' value='Giropos' checked> Giro Pos  
                                          <input type=radio name='jenis' value='BNI'> BNI 
                                          <input type=radio name='jenis' value='Kwitansi'> Kwitansi PMB</td></tr>
<tr><td>Upload Bukti Pembayaran * </td><td> : <input type='file' name='bukti_pembayaran'></td></tr>
						
					</table>
				</td>
  			</tr>
  				
 	 		
  			<tr>
    			<tr>
					<td colspan=2 align=center><input type="button" value="Kembali" onclick='self.history.back()' style="cursor:pointer">
						<input type="submit" value="Simpan">
						<input type="hidden" name="id" value="<?=$_GET['id']?>">
					</td>					
				</tr>
  			
		</table>
	</form>
<?php

 // header('location:../../media.php?module='.$module);

	
	break;
}
}

?>
</body>