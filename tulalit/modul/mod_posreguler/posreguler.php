<script language="JavaScript" type="text/JavaScript">

function showKab()
{
<?php
// membaca semua propinsi
$query = "SELECT * FROM t_prop";
$hasil = mysql_query($query);
// membuat if untuk masing-masing pilihan propinsi beserta isi option untuk combobox kedua
while ($data = mysql_fetch_array($hasil))
{
$idProp = $data['kd_prop'];

// membuat IF untuk masing-masing propinsi
echo "if (document.demo.prop.value == \"".$idProp."\")";
echo "{";

// membuat option kabupaten untuk masing-masing propinsi
$query2 = "SELECT * FROM t_kab WHERE kd_prop = $idProp";
$hasil2 = mysql_query($query2);
$content = "document.getElementById('kabupaten').innerHTML = \"";
while ($data2 = mysql_fetch_array($hasil2))
{
$content .= "<option value='".$data2['kd_kab']."' >".$data2['nama_kab']."</option>";
}
$content .= "\"";
echo $content;
echo "}\n";
}
?>
}

function showKabSma()
{
<?php
// membaca semua propinsi
$query = "SELECT * FROM t_prop";
$hasil = mysql_query($query);
// membuat if untuk masing-masing pilihan propinsi beserta isi option untuk combobox kedua
while ($data = mysql_fetch_array($hasil))
{
$idProp = $data['kd_prop'];

// membuat IF untuk masing-masing propinsi
echo "if (document.demo.n_prop_sma.value == \"".$idProp."\")";
echo "{";

// membuat option kabupaten untuk masing-masing propinsi
$query2 = "SELECT * FROM t_kab WHERE kd_prop = $idProp";
$hasil2 = mysql_query($query2);
$content = "document.getElementById('kabupaten_sma').innerHTML = \"";
while ($data2 = mysql_fetch_array($hasil2))
{
$content .= "<option value='".$data2['kd_kab']."' >".$data2['nama_kab']."</option>";
}
$content .= "\"";
echo $content;
echo "}\n";
}
?>
}

</script> 

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

//include "config/fungsi_indotgl.php"; 
$aksi="modul/mod_posreguler/aksi_posreguler.php";
switch($_GET[act]){

  // Tampil Berita
  default:
    include "menu_atas.php";
?>
	<h2>Data Pendaftaran Reguler</h2>
	<table>
	<a href="modul/mod_cetak/preview_posreguler.php" target="_blank">Print Preview</a> || <a href="modul/mod_cetak/excel_posreguler.php">Ekspor ke Excel</a>
		<tr>
		<th>No</th><th>No.Registrasi</th><th>Nama Lengkap</th><th>Tempat Ujian</th><th>Status</th></th></tr>
<?php
	$p = new Paging;
	$batas = 10;
	$posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT t_calon_mahasiswa.*, t_tempat_ujian.*
						FROM t_calon_mahasiswa
						INNER JOIN t_tempat_ujian ON t_calon_mahasiswa.i_temp_ujian = t_tempat_ujian.KodeTmp
						WHERE t_calon_mahasiswa.c_jalur = 'reguler'
						LIMIT $posisi,$batas");
	$no = $posisi + 1;
	while ($r = mysql_fetch_array($tampil))
	{
?>
	<tr class="menucell" onMouseDown="pviiClassNew(this,'mousedown')" onMouseOut="pviiClassNew(this,'menucell')" onMouseOver="pviiClassNew(this,'mouseover')">
	<td><?=$no?></td>
	<td><a href='?module=posreguler&act=lihat_reguler&id=<?=$r[i_registrasi]?>'><?=$r[i_registrasi]?></a></td>
	<td><?=$r[n_lengkap]?></td>
	<td><?=$r[NamaTmp]?></td>
<?php
	if ($r['status'] == "Transfer Anda Sedang Dikonfirmasi Ke Bank")
	{
		echo "<td><font color='orange'>$r[status]</font></td>";
	}
	elseif ($r['status'] == "Belum Melakukan Konfirmasi Pembayaran")
	{
		echo "<td><font color='red'>$r[status]</font></td>";
	}
	else
	{
		echo "<td><font color='green'>$r[status]</font></td>";
	}
	echo "</tr>";
	$no++;
}
	echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM t_calon_mahasiswa WHERE c_jalur='reguler'"));
	$jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
	$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
	echo "<p>$linkHalaman</p>";
    break;
  
    
  case "lihat_reguler":
   $edit = mysql_query("SELECT t_calon_mahasiswa.*,t_tempat_ujian.*,t_prop.*,t_kab.* FROM t_calon_mahasiswa INNER JOIN t_tempat_ujian ON t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.KodeTmp INNER JOIN t_prop ON t_prop.kd_prop = t_calon_mahasiswa.n_propinsi INNER JOIN t_kab ON t_kab.kd_kab = t_calon_mahasiswa.n_kabupaten WHERE t_calon_mahasiswa.i_registrasi='$_GET[id]'");
	$r = mysql_fetch_array($edit);
	if ($r[4] == 'L')
	{
		$jk = "Laki-laki";
	}
	if ($r[4] == 'P')
	{
		$jk = "Perempuan";
	}
	if ($r[23] == 'MI')
	{
		$pil1 = "Manajemen Informatika";
	}
	if ($r[23] == 'TI')
	{
		$pil1 = "Teknik Informatika";
	}
	if ($r[23] == 'AK')
	{
		$pil1 = "Akuntansi";
	}
	if ($r[23] == 'PM')
	{
		$pil1 = "Pemasaran";
	}
	if ($r[23] == 'LB')
	{
		$pil1 = "Logistik Bisnis";
	}
	if ($r[23] == 'MF')
	{
		$pil1 = "Micro Finance";
	}
	if ($r[23] == 'LB4')
	{
		$pil1 = "Logistik Bisnis D4";
	}
	if ($r[23] == 'TI4')
	{
		$pil1 = "Teknik Informatika D4";
	}
	if ($r[23] == 'MI4')
	{
		$pil1 = "Manajemen Informatika D4";
	}
	if ($r[23] == 'AK4')
	{
		$pil1 = "Akuntansi D4";
	}
	if ($r[23] == 'PM4')
	{
		$pil1 = "Pemasaran D4";
	}
	if ($r[23] == 'LB4A')
	{
		$pil1 = "Ekstensi Logistik Bisnis D4";
	}
	if ($r[23] == 'TI4A')
	{
		$pil1 = "Ekstensi Teknik Informatika D4";
	}
	if ($r[23] == 'MI4A')
	{
		$pil1 = "Ekstensi Manajemen Informatika D4";
	}
	if ($r[23] == 'AK4A')
	{
		$pil1 = "Ekstensi Akuntansi D4";
	}
	if ($r[23] == 'PM4A')
	{
		$pil1 = "Ekstensi Pemasaran D4";
	}
	if ($r[24] == 'MI')
	{
		$pil2 = "Manajemen Informatika";
	}
	if ($r[24] == 'TI')
	{
		$pil2 = "Teknik Informatika";
	}
	if ($r[24] == 'AK')
	{
		$pil2 = "Akuntansi";
	}
	if ($r[24] == 'PM')
	{
		$pil2 = "Pemasaran";
	}
	if ($r[24] == 'LB')
	{
		$pil2 = "Logistik Bisnis";
	}
	if ($r[24] == 'MF')
	{
		$pil2 = "Micro Finance";
	}
	if ($r[24] == 'LB4')
	{
		$pil2 = "Logistik Bisnis D4";
	}
	if ($r[24] == 'TI4')
	{
		$pil2 = "Teknik Informatika D4";
	}
	if ($r[24] == 'MI4')
	{
		$pil2 = "Manajemen Informatika D4";
	}
	if ($r[24] == 'AK4')
	{
		$pil2 = "Akuntansi D4";
	}
	if ($r[24] == 'PM4')
	{
		$pil2 = "Pemasaran D4";
	}
	if ($r[24] == 'LB4A')
	{
		$pil2 = "Ekstensi Logistik Bisnis D4";
	}
	if ($r[24] == 'TI4A')
	{
		$pil2 = "Ekstensi Teknik Informatika D4";
	}
	if ($r[24] == 'MI4A')
	{
		$pil2 = "Ekstensi Manajemen Informatika D4";
	}
	if ($r[24] == 'AK4A')
	{
		$pil2 = "Ekstensi Akuntansi D4";
	}
	if ($r[24] == 'PM4A')
	{
		$pil2 = "Ekstensi Pemasaran D4";
	}
	if ($r[25] =='MI')
	{
		$pil3 = "Manajemen Informatika";
	}
	if ($r[25] =='TI')
	{
		$pil3 = "Teknik Informatika";
	}
	if ($r[25] =='AK')
	{
		$pil3 = "Akuntansi";
	}
	if ($r[25] =='PM')
	{
		$pil3 = "Pemasaran";
	}
	if ($r[25] =='LB')
	{
		$pil3 = "Logistik Bisnis";
	}
	if ($r[25] =='MF')
	{
		$pil3 = "Micro Finance";
	}
	if ($r[25] == 'LB4')
	{
		$pil3 = "Logistik Bisnis D4";
	}
	if ($r[25] == 'TI4')
	{
		$pil3 = "Teknik Informatika D4";
	}
	if ($r[25] == 'MI4')
	{
		$pil3 = "Manajemen Informatika D4";
	}
	if ($r[25] == 'AK4')
	{
		$pil3 = "Akuntansi D4";
	}
	if ($r[25] == 'PM4')
	{
		$pil3 = "Pemasaran D4";
	}
	if ($r[25] == 'LB4A')
	{
		$pil3 = "Ekstensi Logistik Bisnis D4";
	}
	if ($r[25] == 'TI4A')
	{
		$pil3 = "Ekstensi Teknik Informatika D4";
	}
	if ($r[25] == 'MI4A')
	{
		$pil3 = "Ekstensi Manajemen Informatika D4";
	}
	if ($r[25] == 'AK4A')
	{
		$pil3 = "Ekstensi Akuntansi D4";
	}
	if ($r[25] == 'PM4A')
	{
		$pil3 = "Ekstensi Pemasaran D4";
	}
?>

	<?php 
			
		  $tampil2 = mysql_query("SELECT nama_prop FROM t_prop WHERE kd_prop = ".$r['n_prop_sma']);
			while ($r2 = mysql_fetch_array($tampil2))
			{
				$nama_prop_sma=$r2['nama_prop'];
			} 
		  $tampil3 = mysql_query("SELECT nama_kab FROM t_kab WHERE kd_kab = ".$r['n_kab_sma']);
			while ($r3 = mysql_fetch_array($tampil3))
			{
				$nama_kab_sma=$r3['nama_kab'];
			} 
	?>
	<h2>Detail Data Pendaftaran Reguler</h2>
	<form method=POST enctype='multipart/form-data' action='#'>
		<table>
 			<tr>
    			<td>
					<table>
						<h3>Data Ujian Peserta</h3>
						<tr><td>Jalur Registrasi</td><td> : <?=$r[c_jalur]?></td></tr>
        				<tr><td>No.Registrasi</td><td> : <b><?=$r[i_registrasi]?></b></td></tr>
						<tr><td>Pilihan 1</td><td> : <?=$pil1?></td></tr>
						<tr><td>Pilihan 2</td><td> : <?=$pil2?></td></tr>
						<tr><td>Pilihan 3</td><td> : <?=$pil3?></td></tr>
						<tr><td>Tempat Ujian</td><td> : <?=$r[NamaTmp]?></td></tr>
						<tr><td>Tahu Informasi dari</td><td> : <?=$r[c_inf]?></td></tr>
						<tr><td>Sumbangan Pendidikan</td><td> : <?=$r[q_sdp2]?></td></tr>
						<tr><td>Status</td><td> : <?=$r[status]?></td></tr>
					</table>
				</td>
    			<td>
					<table>
						<h3>Data Orang Tua</h3>
						<tr><td>Nama Orang Tua</td><td> : <?=$r[n_ortu]?></td></tr>
						<tr><td>Pekerjaan</td><td> : <?=$r[n_instansi]?></td></tr>
						<tr><td>Jabatan</td><td> : <?=$r[n_jabatan]?></td></tr>
					</table>
				</td>
  			</tr>
  			<tr>
    			<td>
					<table>
						<h3>Data Calon Mahasiswa</h3>
						<tr><td>Nama Lengkap</td><td> : <?=$r[n_lengkap]?></td></tr>
        				<tr><td>Jenis Kelamin</td><td> : <?=$jk?></td></tr>
        				<tr><td>Tempat / Tanggal Lahir</td><td> : <?=$r[n_temp_lahir]?> / <?=$r[d_lahir]?></td></tr>
        				<tr><td>Alamat</td><td> : <?=$r[n_alamat]?></td></tr>
						<tr><td>Kabupaten, Provinsi</td><td> : <?=$r[nama_kab]?>, <?=$r[nama_prop]?></td></tr>
						<tr><td>*Kota Lain</td><td> : <?=$r[n_kota_lain]?></td></tr>
						<tr><td colspan=2>*) Apabila Kota Calon Mahasiswa tidak terdapat pada pilihan!</td></tr>
						<tr><td>Kodepos</td><td> : <?=$r[c_pos]?></td></tr>
						<tr><td>No.Telepon / HP</td><td> : <?=$r[i_telp]?> / <?=$r[i_hp]?></td></tr>
						<tr><td>Email</td><td> : <?=$r[n_email]?></td></tr>
					</table>
				</td>
    			<td>
					<table><h3>Data SMA Calon Mahasiswa</h3>
						<tr><td>Nama SMA</td><td> : <?=$r[n_sma]?></td></tr>
						<tr><td>Jurusan SMA</td><td> : <?=$r[i_jur_sma]?></td></tr>
						<tr><td>Alamat SMA</td><td> : <?=$r[n_alamat_sma]?></td></tr>
						<tr><td>Kabupaten, Provinsi</td><td> : <?=$nama_kab_sma?>, <?=$nama_prop_sma?></td></tr>
						<tr><td>Prestasi yang pernah diraih</td><td> : <?=$r[e_prestasi]?></td></tr>
					</table>
				</td>
 	 		</tr>
  			<tr>
    			<tr><td colspan=2 align=center><input type="button" value="Kembali" onclick='self.history.back()' style="cursor:pointer">
						<a href="?module=posreguler&act=update&id=<?=$r[i_registrasi]?>" style="text-decoration:none"><input type="button" value="Edit" style="cursor:pointer"></a></td></tr>
  			
		</table>
	</form>
<?php
    break;  
	
	case"update":
	$edit = mysql_query("SELECT t_calon_mahasiswa.*,t_tempat_ujian.*
					FROM t_calon_mahasiswa
					INNER JOIN t_tempat_ujian ON t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.KodeTmp
					WHERE t_calon_mahasiswa.i_registrasi='$_GET[id]'");
	$r = mysql_fetch_array($edit);
	if ($r[4] == 'L')
	{
		$jk = "Laki-laki";
	}
	if ($r[4] == 'P')
	{
		$jk = "Perempuan";
	}
	if ($r[23] == 'MI')
	{
		$pil1 = "Manajemen Informatika";
	}
	if ($r[23] == 'TI')
	{
		$pil1 = "Teknik Informatika";
	}
	if ($r[23] == 'AK')
	{
		$pil1 = "Akuntansi";
	}
	if ($r[23] == 'PM')
	{
		$pil1 = "Pemasaran";
	}
	if ($r[23] == 'LB')
	{
		$pil1 = "Logistik Bisnis";
	}
	if ($r[23] == 'MF')
	{
		$pil1 = "Micro Finance";
	}
	if ($r[23] == 'LB4')
	{
		$pil1 = "Logistik Bisnis D4";
	}
	if ($r[23] == 'TI4')
	{
		$pil1 = "Teknik Informatika D4";
	}
	if ($r[23] == 'MI4')
	{
		$pil1 = "Manajemen Informatika D4";
	}
	if ($r[23] == 'AK4')
	{
		$pil1 = "Akuntansi D4";
	}
	if ($r[23] == 'PM4')
	{
		$pil1 = "Pemasaran D4";
	}
	if ($r[23] == 'LB4A')
	{
		$pil1 = "Ekstensi Logistik Bisnis D4";
	}
	if ($r[23] == 'TI4A')
	{
		$pil1 = "Ekstensi Teknik Informatika D4";
	}
	if ($r[23] == 'MI4A')
	{
		$pil1 = "Ekstensi Manajemen Informatika D4";
	}
	if ($r[23] == 'AK4A')
	{
		$pil1 = "Ekstensi Akuntansi D4";
	}
	if ($r[23] == 'PM4A')
	{
		$pil1 = "Ekstensi Pemasaran D4";
	}
	if ($r[24] == 'MI')
	{
		$pil2 = "Manajemen Informatika";
	}
	if ($r[24] == 'TI')
	{
		$pil2 = "Teknik Informatika";
	}
	if ($r[24] == 'AK')
	{
		$pil2 = "Akuntansi";
	}
	if ($r[24] == 'PM')
	{
		$pil2 = "Pemasaran";
	}
	if ($r[24] == 'LB')
	{
		$pil2 = "Logistik Bisnis";
	}
	if ($r[24] == 'MF')
	{
		$pil2 = "Micro Finance";
	}
	if ($r[24] == 'LB4')
	{
		$pil2 = "Logistik Bisnis D4";
	}
	if ($r[24] == 'TI4')
	{
		$pil2 = "Teknik Informatika D4";
	}
	if ($r[24] == 'MI4')
	{
		$pil2 = "Manajemen Informatika D4";
	}
	if ($r[24] == 'AK4')
	{
		$pil2 = "Akuntansi D4";
	}
	if ($r[24] == 'PM4')
	{
		$pil2 = "Pemasaran D4";
	}
	if ($r[24] == 'LB4A')
	{
		$pil2 = "Ekstensi Logistik Bisnis D4";
	}
	if ($r[24] == 'TI4A')
	{
		$pil2 = "Ekstensi Teknik Informatika D4";
	}
	if ($r[24] == 'MI4A')
	{
		$pil2 = "Ekstensi Manajemen Informatika D4";
	}
	if ($r[24] == 'AK4A')
	{
		$pil2 = "Ekstensi Akuntansi D4";
	}
	if ($r[24] == 'PM4A')
	{
		$pil2 = "Ekstensi Pemasaran D4";
	}
	if ($r[25] =='MI')
	{
		$pil3 = "Manajemen Informatika";
	}
	if ($r[25] =='TI')
	{
		$pil3 = "Teknik Informatika";
	}
	if ($r[25] =='AK')
	{
		$pil3 = "Akuntansi";
	}
	if ($r[25] =='PM')
	{
		$pil3 = "Pemasaran";
	}
	if ($r[25] =='LB')
	{
		$pil3 = "Logistik Bisnis";
	}
	if ($r[25] =='MF')
	{
		$pil3 = "Micro Finance";
	}
	if ($r[25] == 'LB4')
	{
		$pil3 = "Logistik Bisnis D4";
	}
	if ($r[25] == 'TI4')
	{
		$pil3 = "Teknik Informatika D4";
	}
	if ($r[25] == 'MI4')
	{
		$pil3 = "Manajemen Informatika D4";
	}
	if ($r[25] == 'AK4')
	{
		$pil3 = "Akuntansi D4";
	}
	if ($r[25] == 'PM4')
	{
		$pil3 = "Pemasaran D4";
	}
	if ($r[25] == 'LB4A')
	{
		$pil3 = "Ekstensi Logistik Bisnis D4";
	}
	if ($r[25] == 'TI4A')
	{
		$pil3 = "Ekstensi Teknik Informatika D4";
	}
	if ($r[25] == 'MI4A')
	{
		$pil3 = "Ekstensi Manajemen Informatika D4";
	}
	if ($r[25] == 'AK4A')
	{
		$pil3 = "Ekstensi Akuntansi D4";
	}
	if ($r[25] == 'PM4A')
	{
		$pil3 = "Ekstensi Pemasaran D4";
	}
?>
	<h2>Edit Data Pendaftaran Reguler</h2>
	<form method=POST enctype='multipart/form-data' action="$aksi?module=posreguler&act=editreg" name="demo">
		<table>
 			<tr>
    			<td>
					<table>
						<h3>Data Ujian Peserta</h3>
						<tr><td>Jalur Registrasi</td><td> : <?=$r[c_jalur]?></td></tr>
        				<tr><td>No.Registrasi</td><td> : <b><?=$r[i_registrasi]?></b></td></tr>
						<tr><td>Pilihan 1</td><td> : 
						<select name="pil1" id="pil1" style="width:167">
						<?php
						$qpil1 = mysql_query("SELECT a.KodeJrsn, a.NamaJrsn FROM t_jurusan a ORDER BY a.Id ASC");
						while ($rpil1 = mysql_fetch_array($qpil1))
						{
						?>
							<option value="<?=$rpil1['KodeJrsn']?>" <?=($rpil1['KodeJrsn'] == $r[n_pil1]) ? ' selected':''?>><?=$rpil1['NamaJrsn']?></option>
						<?php
						}
						?>
						</select>
						</td>
						</tr>
						<tr><td>Pilihan 2</td><td> :
						<select name="pil2" id="pil2" style="width:167">
						<?php
						$qpil2 = mysql_query("SELECT a.KodeJrsn, a.NamaJrsn FROM t_jurusan a ORDER BY a.Id ASC");
						while ($rpil2 = mysql_fetch_array($qpil2))
						{
						?>
							<option value="<?=$rpil2['KodeJrsn']?>" <?=($rpil2['KodeJrsn'] == $r[n_pil2]) ? ' selected':''?>><?=$rpil2['NamaJrsn']?></option>
						<?php
						}
						?>
						</select>
						</td></tr>
						<tr>
						<td>Pilihan 3</td><td> : 
						<select name="pil3" id="pil3" style="width:167">
						<?php
						$qpil3 = mysql_query("SELECT a.KodeJrsn, a.NamaJrsn FROM t_jurusan a ORDER BY a.Id ASC");
						while ($rpil3 = mysql_fetch_array($qpil3))
						{
						?>
							<option value="<?=$rpil3['KodeJrsn']?>" <?=($rpil3['KodeJrsn'] == $r[n_pil3]) ? ' selected':''?>><?=$rpil3['NamaJrsn']?></option>
						<?php
						}
						?>
						</td>
						</tr>
						<tr>
						<td>Tempat Ujian</td><td> : 
						<select name="KodeTmp" style="width:167">
						<?php
						$qtu = mysql_query("SELECT a.KodeTmp, a.NamaTmp FROM t_tempat_ujian a ORDER BY a.NamaTmp ASC");
						while ($rtu = mysql_fetch_array($qtu))
						{
						?>
							<option value="<?=$rtu['KodeTmp']?>" <?=($rtu['NamaTmp'] == $r['NamaTmp']) ? ' selected':''?>><?=$rtu['NamaTmp']?></option>
						<?php
						}
						?>
						</select>
						</td>					</tr>
						
						<tr><td>Tahu Informasi dari</td><td> :<?=$r[c_inf]?></td></tr>
						<tr><td>Sumbangan Pendidikan</td><td> : Rp. <input type="text" name="q_sdp2" value="<?=$r[q_sdp2]?>"></td></tr>
						<tr><td>Status</td><td> : <?=$r[status]?></td></tr>
					</table>
				
    			<td>
					<table>
						<h3>Data Orang Tua</h3>
						<tr><td>Nama Orang Tua</td><td> : <input type="text" name="n_ortu" value="<?=$r[n_ortu]?>" size="30"></td></tr>
						<tr><td>Pekerjaan</td><td> : <input type="text" name="n_instansi" value="<?=$r[n_instansi]?>"></td></tr>
						<tr><td>Jabatan</td><td> : 
						<input type="text" name="n_jabatan" value="<?=$r[n_jabatan]?>">
						
						</td></tr>
					</table>
				</td>
  			</tr>
  				<table>
						<h3>Data Calon Mahasiswa</h3>
						<tr><td>Nama Lengkap</td><td> : <input type="text" name="n_lengkap" value="<?=$r[n_lengkap]?>" size="30"></td></tr>
        				<tr><td>Jenis Kelamin</td><td> : 
						<input type="radio" value="L" name="n_jns_kelamin" <?=($r['n_jns_kelamin'] == 'L') ? ' checked':''?>>Laki-laki &nbsp;&nbsp;&nbsp;
						<input type="radio" value="P" name="n_jns_kelamin" <?=($r['n_jns_kelamin'] == 'P') ? ' checked':''?>>Perempuan
						</td></tr>
        				<tr><td>Tempat Lahir</td><td> : <input type="text" name="n_temp_lahir" value="<?=$r[n_temp_lahir]?>"></td></tr>
						<tr><td>Tanggal Lahir</td><td> : <input type="text" name="d_lahir" id="d_lahir" value="<?=$r[d_lahir]?>"> <input type="button" value="Cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">
						</td></tr>
        				<tr><td>Alamat</td><td> : <textarea name="n_alamat" rows="3" cols="25"><?=$r[n_alamat]?></textarea></td></tr>
						<tr><td>Provinsi</td><td> : <select name='prop' onchange="showKab()"> <?
						$query6 = "SELECT t_calon_mahasiswa.* FROM t_prop
							inner join t_calon_mahasiswa on t_calon_mahasiswa.n_propinsi=t_prop.kd_prop 
							WHERE t_calon_mahasiswa.i_registrasi='$_GET[id]'";
  						$hasil6 = mysql_query($query6);
   						$f=mysql_fetch_array($hasil6);
							$query4 = "SELECT * FROM t_prop";
    						$hasil4 = mysql_query($query4);

						while ($data4 = mysql_fetch_array($hasil4))
   						{ 
						?>
     					<option value="<?=$data4['kd_prop']?>" <?=($data4['kd_prop'] == $f['n_propinsi']) ? ' selected':''?>><?=$data4['nama_prop']?></option>
   						<? } ?>
		
		 				</select>
						</td></tr>
						<tr><td>Kabupaten</td><td> :  
						<select name="kab" id="kabupaten"> <?
						$query6 = "SELECT t_calon_mahasiswa.* FROM t_kab
							inner join t_calon_mahasiswa on t_calon_mahasiswa.n_kabupaten=t_kab.kd_kab 
							inner join t_prop on t_prop.kd_prop=t_kab.kd_prop 
							WHERE t_calon_mahasiswa.i_registrasi='$_GET[id]'";
  						$hasil6 = mysql_query($query6);
   						$f=mysql_fetch_array($hasil6);
							$query4 = "SELECT * FROM t_kab";
    						$hasil4 = mysql_query($query4);

						while ($data4 = mysql_fetch_array($hasil4))
   						{ 
						?>
     					<option value="<?=$data4['kd_kab']?>" <?=($data4['kd_kab'] == $f['n_kabupaten']) ? ' selected':''?>><?=$data4['nama_kab']?></option>
   						<? } ?>
						
		 				</select> 
						<!--<select name="kab" id="kabupaten"></select>-->
						</td></tr>
						<tr><td>*Kota Lain</td><td> : <input type="text" name="n_kota_lain" value="<?=$r[n_kota_lain]?>"></td></tr>
						<tr><td colspan=2>*) Apabila Kota Calon Mahasiswa tidak terdapat pada pilihan!</td></tr>
						<tr><td>Kodepos</td><td> : <input type="text" name="c_pos" value="<?=$r[c_pos]?>"></td></tr>
						<tr><td>No. Telepon</td><td> : <input type="text" name="i_telp" value="<?=$r[i_telp]?>"></td></tr>
						<tr><td>No. HP</td><td> : <input type="text" name="i_hp" value="<?=$r[i_hp]?>"></td></tr>
						<tr><td>Email</td><td> : <input type="text" name="n_email" value="<?=$r[n_email]?>" size="50"></td></tr>
					</table>
					<table><h3>Data SMA Calon Mahasiswa</h3>
						<tr><td>Nama SMA</td><td> : <input type="text" name="n_sma" value="<?=$r[n_sma]?>" size="50"></td></tr>
						<tr><td>Jurusan SMA</td><td> : <input type="text" name="i_jur_sma" value="<?=$r[i_jur_sma]?>"></td></tr>
						<tr><td>Alamat SMA</td><td> : <textarea name="n_alamat_sma" rows="3" cols="25"><?=$r[n_alamat_sma]?>
						</textarea></td></tr>
						<tr><td>Provinsi</td><td> : 
						<select name='n_prop_sma' onchange="showKabSma()"> <?
						$query6 = "SELECT t_calon_mahasiswa.* FROM t_prop
							inner join t_calon_mahasiswa on t_calon_mahasiswa.n_prop_sma=t_prop.kd_prop 
							WHERE t_calon_mahasiswa.i_registrasi='$_GET[id]'";
  						$hasil6 = mysql_query($query6);
   						$f=mysql_fetch_array($hasil6);
							$query4 = "SELECT * FROM t_prop";
    						$hasil4 = mysql_query($query4);

						while ($data4 = mysql_fetch_array($hasil4))
   						{ 
						?>
     					<option value="<?=$data4['kd_prop']?>" <?=($data4['kd_prop'] == $f['n_prop_sma']) ? ' selected':''?>><?=$data4['nama_prop']?></option>
   						<? } ?>
		
		 				</select>
						</td></tr>
						<tr><td>Kabupaten</td><td> : 
						<select name='n_kab_sma' id="kabupaten_sma"> <?
						$query6 = "SELECT t_calon_mahasiswa.* FROM t_kab
							inner join t_calon_mahasiswa on t_calon_mahasiswa.n_kab_sma=t_kab.kd_kab 
							inner join t_prop on t_prop.kd_prop=t_kab.kd_prop 
							WHERE t_calon_mahasiswa.i_registrasi='$_GET[id]'";
  						$hasil6 = mysql_query($query6);
   						$f=mysql_fetch_array($hasil6);
							$query4 = "SELECT * FROM t_kab";
    						$hasil4 = mysql_query($query4);

						while ($data4 = mysql_fetch_array($hasil4))
   						{ 
						?>
     					<option value="<?=$data4['kd_kab']?>" <?=($data4['kd_kab'] == $f['n_kab_sma']) ? ' selected':''?>><?=$data4['nama_kab']?></option>
   						<? } ?>
		
		 				</select>
						</td></tr>
						<tr><td>Prestasi yang pernah diraih</td><td> : 
						<textarea name="e_prestasi" rows="5" cols="40"><?=$r[e_prestasi]?></textarea>
						</td></tr>
					</table>
				
 	 		
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