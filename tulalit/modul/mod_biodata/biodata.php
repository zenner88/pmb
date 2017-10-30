<?php 
session_start();
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
$aksi="modul/mod_biodata/aksi_biodata.php";
switch($_GET[act]){

  // Tampil Berita
  default:
    include "menu_atas.php";

    echo "<h2>Data Pendaftaran Belum Mengisi Biodata</h2><br>
	      <!-- <a href='modul/mod_cetak/preview_posreguler.php' target='_blank'>Print Preview</a> || <a href='modul/mod_cetak/excel_posreguler.php'>Ekspor ke Excel</a>-->
          <form method=get action='$_SERVER[PHP_SELF]'>
          <input type=hidden name=module value=biodata>
          <div id=paging>Masukkan Nama : <input type=text name='kata'> <input type=submit class='tombol' value=Cari></div>
          </form>
		  <hr>
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
      $tampil = mysql_query("SELECT *
FROM t_daftar
WHERE kode_briva not in (select t_calon_mahasiswa.i_registrasi from t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi) 
and status='bayar' order by id_daftar DESC
						LIMIT $posisi,$batas");
    }
    else{
      $tampil=mysql_query("SELECT *
FROM t_daftar
WHERE kode_briva not in (select t_calon_mahasiswa.i_registrasi from t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi) 
and status='bayar' order by id_daftar DESC
						LIMIT $posisi,$batas");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      ?>
    <tr class="menucell" onMouseDown="pviiClassNew(this,'mousedown')" onMouseOut="pviiClassNew(this,'menucell')" onMouseOver="pviiClassNew(this,'mouseover')">
	<td><?=$no?></td>
       <?
       if ($r['status'] == "belum")
	{
		echo "<td><a href='?module=daftar&act=update&id=$r[kode_briva]'>$r[kode_briva]</a></td>";
	}
	elseif ($r['status'] == "bayar")
	{
		echo "<td>$r[kode_briva]</td>";
	}
      else
	{
		echo "<td>-</td>";
	}
	?>
	<td><?=$r[nis]?></td>
	<td><?=$r[password]?></td>
	<td><?=$r[nama]?></td>
	
       <td><?=$r[no_tlp]?></td>
	<td><?=$r[email]?></td>
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
	else
	{
		echo "<td>-</td>";
	}
	?>

       <td><?=$r[tgl_daftar]?></td>
<?php
	if ($r['status'] == "bayar")
	{
		echo "<td><font color='green'>$r[status]</font></td>";
	}
	elseif ($r['status'] == "belum")
	{
		echo "<td><font color='red'>$r[status]</font></td>";
	}
	else
	{
		echo "<td><font color='orange'>$r[status]</font></td>";
	}


	if ($r['status'] == "bayar")
	{?>
		<td><a href="bukti_pembayaran/<?=$r[bukti_pembayaran];?>" onClick="return GB_showCenter('Tentang Web', this.href)"><?=$r[bukti_pembayaran];?></a></td>
	<?
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
      $jmldata = mysql_num_rows(mysql_query("SELECT *
FROM t_daftar
WHERE kode_briva not in (select t_calon_mahasiswa.i_registrasi from t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi) 
and status='bayar'"));
    }
    else{
      $jmldata = mysql_num_rows(mysql_query("SELECT *
FROM t_daftar
WHERE kode_briva not in (select t_calon_mahasiswa.i_registrasi from t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi) 
and status='bayar'"));
    }  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>$linkHalaman</div><br>";


    break;    
    }
    else{
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

    $p      = new Paging9;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    if ($_SESSION['leveluser']=='admin'){
      $tampil = mysql_query("SELECT *
FROM t_daftar
WHERE kode_briva not in (select t_calon_mahasiswa.i_registrasi from t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi) 
and status='bayar' and nama LIKE '%$_GET[kata]%' ORDER BY id_daftar DESC LIMIT $posisi,$batas");
    }
    else{
      $tampil=mysql_query("SELECT *
FROM t_daftar
WHERE kode_briva not in (select t_calon_mahasiswa.i_registrasi from t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi) 
and status='bayar' and nama LIKE '%$_GET[kata]%'       
                           ORDER BY id_daftar DESC LIMIT $posisi,$batas");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      ?>
    <tr class="menucell" onMouseDown="pviiClassNew(this,'mousedown')" onMouseOut="pviiClassNew(this,'menucell')" onMouseOver="pviiClassNew(this,'mouseover')">
	<td><?=$no?></td>
       <?
       if ($r['status'] == "belum")
	{
		echo "<td><a href='?module=daftar&act=update&id=$r[kode_briva]'>$r[kode_briva]</a></td>";
	}
	elseif ($r['status'] == "bayar")
	{
		echo "<td>$r[kode_briva]</td>";
	}
      else
	{
		echo "<td>-</td>";
	}
	?>
	<td><?=$r[nis]?></td>
	<td><?=$r[password]?></td>
	<td><?=$r[nama]?></td>
	
       <td><?=$r[no_tlp]?></td>
	<td><?=$r[email]?></td>
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
	else
	{
		echo "<td>-</td>";
	}
	?>

       <td><?=$r[tgl_daftar]?></td>
<?php
	if ($r['status'] == "bayar")
	{
		echo "<td><font color='green'>$r[status]</font></td>";
	}
	elseif ($r['status'] == "belum")
	{
		echo "<td><font color='red'>$r[status]</font></td>";
	}
	else
	{
		echo "<td><font color='orange'>$r[status]</font></td>";
	}
      if ($r['status'] == "bayar")
	{
	?>
		<td><a href="bukti_pembayaran/<?=$r[bukti_pembayaran];?>" onClick="return GB_showCenter('Tentang Web', this.href)"><?=$r[bukti_pembayaran];?></a></td>
	<?
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
      $jmldata = mysql_num_rows(mysql_query("select t_calon_mahasiswa.i_registrasi from t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi) 
and status='bayar' and  nama LIKE '%$_GET[kata]%'"));
    }
    else{
      $jmldata = mysql_num_rows(mysql_query("select t_calon_mahasiswa.i_registrasi from t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi) 
and status='bayar' and  nama LIKE '%$_GET[kata]%'"));
    }  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>$linkHalaman</div><br>";
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

<?
	$edit = mysql_query("SELECT * from t_daftar
					WHERE kode_briva='$_GET[id]'");
	$r = mysql_fetch_array($edit);

?>
	<h2>Konfirmasi Pembayaran Pendaftaran</h2>
	<? echo "
		  <form method=POST enctype='multipart/form-data' action='$aksi?module=daftar&act=edit' onSubmit='return validasi(this)'>";?>
		<table>
 			<tr>
    			<td>
					<table>
						<h3>Data Pendaftaran</h3>
						<tr><td>Nama</td><td> : <?=$r[nama]?></td></tr>
						<tr><td>No Pendaftaran</td><td> : <?=$r[kode_briva]?></td></tr>
						<tr><td>Email</td><td> : <?=$r[email]?></td></tr>
						<tr><td>No Telp</td><td> : <?=$r[no_tlp]?></td></tr>
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
	else
	{
		echo "<tr><td>Jalur</td><td> : -</td></tr>";
	}
	?>
						
						<tr><td>Tanggal Daftar</td><td> : <?=$r[tgl_daftar]?></td></tr>
        				
						<tr><td>Status</td><td> : <?=$r[status]?></td></tr>
					</table>
				
    			<td>
					<table>
						<h3>Konfirmasi Pembayaran</h3>
						
<? 
if ($r[status]=='belum'){
      echo "<tr><td>Setting Pembayaran *</td>     <td> : <input type=radio name='status' value='bayar'> Sudah Bayar   
                                           <input type=radio name='status' value='belum' checked> Belum Bayar</td></tr>";
    }
    else{
      echo "<tr><td>Setting Pembayaran *</td>     <td> : <input type=radio name='status' value='bayar' checked> Sudah Bayar  
                                          <input type=radio name='status' value='belum'> Belum Bayar</td></tr>";
}
?>
<tr><td>Jenis Bukti Pemabayaran * </td><td> : <input type=radio name='jenis' value='Giropos' checked> Giro Pos  
                                          <input type=radio name='jenis' value='BNI'> BNI 
                                          <input type=radio name='jenis' value='Kwitansi'> Kwitansi PMB</td></tr>
<tr><td>Upload Bukti Pemabayaran * </td><td> : <input type='file' name='bukti_pembayaran'></td></tr>
						
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