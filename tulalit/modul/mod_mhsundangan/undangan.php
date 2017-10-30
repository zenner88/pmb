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
$aksi="modul/mod_mhsundangan/aksi_mhsundangan.php";
switch($_GET[act]){

  // Tampil Berita
  default:
   	include "menu_atas2.php";
echo"
	<h2>Data Pendaftaran Undangan</h2>
	<table>
	
 <form method=get action='$_SERVER[PHP_SELF]'>
          <input type=hidden name=module value=mhsundangan>
          <div id=paging>Masukkan Nama : <input type=text name='kata'> <input type=submit class='tombol' value=Cari></div>
          </form>
		  <hr>

		  <div style='background:#FCF886'>

<form method='POST' action='modul/mod_cetak/calonmahasiswaundangan.php' target='_blank'>
          <input type=hidden name=module value=daftar>
          <div id=paging>
		  <B>PERGURUAN TINGGI : </B> <input name='pt' value='all' checked type='radio' >Cetak Semua 
<input name='pt' value='poltekpos' type='radio' >Poltekpos
<input name='pt' value='stimlog' type='radio' >Stimlog
		  
				
		  <input type=submit class='tombol' value=Cetak></div>
          </form>

<form method='POST' action='../tulalit/excel/pendaftarundangan.php' target='_blank'>
          <input type=hidden name=module value=daftar>
          <div id=paging>
		  <B>PERGURUAN TINGGI : </B> <input name='pt' value='all' checked type='radio' >Cetak Semua 
<input name='pt' value='poltekpos' type='radio' >Poltekpos
<input name='pt' value='stimlog' type='radio' >Stimlog
		  
				
		  <input type=submit class='tombol' value='Print Excel'></div>
          </form>

<form method=POST action='?module=mhsundangan&act=lulus'>
         <B>UPLOAD KELULUSAN UNDANGAN: </B> <input type=submit class='tombol' value='Upload'>
</form>

</div><hr>";

if (empty($_GET['kata'])){
echo "<table> 

	<tr><th>No</th><th>No.Registrasi</th><th>Perguruan Tinggi</th><th>Nama Lengkap</th><th>Asal SMA</th><th>Status</th><th>Pindah Perguruan Tinggi</th></tr>";

$p = new Paging;
$batas = 10;
$posisi = $p->cariPosisi($batas);
$tampil = mysql_query("SELECT t_calon_mahasiswa.*, t_daftar.* FROM t_calon_mahasiswa 
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi
WHERE t_calon_mahasiswa.c_jalur='Undangan' LIMIT $posisi,$batas");
$no = $posisi + 1;
while ($r = mysql_fetch_array($tampil))
{
?>
	<tr class="menucell" onMouseDown="pviiClassNew(this,'mousedown')" onMouseOut="pviiClassNew(this,'menucell')" onMouseOver="pviiClassNew(this,'mouseover')"><td><?=$no?></td>
	<td><a href='?module=mhsundangan&act=lihat_undangan&id=<?=$r[i_registrasi]?>'><?=$r[i_registrasi]?></a></td>
	<?php
	if ($r['pilihan'] == "1")
	{
		echo "<td>POLTEKPOS</td>";
	}
	elseif ($r['pilihan'] == "2")
	{
		echo "<td>STIMLOG</td>";
	}
	?>
	<td><?=$r[n_lengkap]?></td>
	<td><?=$r[n_sma]?></td>
	<td><?=$r[status]?></td>
	<?php
	echo"<td><a href='?module=mhsundangan&act=pindah&id=$r[i_registrasi]'>Pindah</a></td></tr>";
	$no++;
}
echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM t_calon_mahasiswa WHERE c_jalur='Undangan'"));
	$jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
	$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
	echo "<div id=paging>$linkHalaman</div><br>";

$tampil_belum = mysql_query("SELECT count(id_daftar) as jum
FROM t_daftar
WHERE kode_briva not in (select t_calon_mahasiswa.i_registrasi from t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi) 
and jalur_pendaftaran='2' and pilihan='1' and status='bayar'");
$r_belum    = mysql_fetch_array($tampil_belum);

$p = new Paging;
$batas = 10;
$posisi = $p->cariPosisi($batas);
$tampil_lap = mysql_query("SELECT count(t_calon_mahasiswa.n_pil1) as jum,t_jurusan.NamaJrsn as jur
FROM t_calon_mahasiswa
inner join t_jurusan on t_jurusan.KodeJrsn=t_calon_mahasiswa.n_pil1
WHERE t_calon_mahasiswa.c_jalur='Undangan' and t_jurusan.Jenjang='1'
group by t_jurusan.NamaJrsn
order by t_jurusan.NamaJrsn");
$no = $posisi + 1;

echo"
<table>  
<tr colspan='3'><b>Statistika Poltekpos</b></th> 
<tr><th>No</th><th>Program Studi</th>
<th>Jumlah Pendaftar</th>
</tr>";

while ($r_lap = mysql_fetch_array($tampil_lap))
{   
echo"
<tr>
<td>$no</td>
<td>$r_lap[jur]</td>
<td>$r_lap[jum] </td>
</tr>";
$no++;
$jumlah += $r_lap[jum];
}
echo"
<tr>
<td colspan='2'><b>Total Pendaftar Sudah Mengisi Biodata</b></td>
<td><b>$jumlah</b></td>
</tr>
<tr>
<td colspan='2'><b>Total Pendaftar Belum Mengisi Biodata</b></td>
<td><b>$r_belum[jum]</b></td>
</tr></table>";

$tampil_belum_s = mysql_query("SELECT count(id_daftar) as jum
FROM t_daftar
WHERE kode_briva not in (select t_calon_mahasiswa.i_registrasi from t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi) 
and jalur_pendaftaran='2' and pilihan='2' and status='bayar'");
$r_belum_s    = mysql_fetch_array($tampil_belum_s);

$p = new Paging;
$batas = 10;
$posisi = $p->cariPosisi($batas);
$tampil_lap_s = mysql_query("SELECT count(t_calon_mahasiswa.n_pil1) as jum,t_jurusan.NamaJrsn as jur
FROM t_calon_mahasiswa
inner join t_jurusan on t_jurusan.KodeJrsn=t_calon_mahasiswa.n_pil1
WHERE t_calon_mahasiswa.c_jalur='Undangan' and t_jurusan.Jenjang='2'
group by t_jurusan.NamaJrsn
order by t_jurusan.NamaJrsn");
$no = $posisi + 1;

echo"
<table>  
<tr colspan='3'><b>Statistika Stimlog</b></th> 
<tr><th>No</th><th>Program Studi</th>
<th>Jumlah Pendaftar</th>
</tr>";

while ($r_lap_s = mysql_fetch_array($tampil_lap_s))
{   
echo"
<tr>
<td>$no</td>
<td>$r_lap_s[jur]</td>
<td>$r_lap_s[jum] </td>
</tr>";
$no++;
$jumlah_s += $r_lap_s[jum];
}
echo"
<tr>
<td colspan='2'><b>Total Pendaftar Sudah Mengisi Biodata</b></td>
<td><b>$jumlah_s</b></td>
</tr>
<tr>
<td colspan='2'><b>Total Pendaftar Belum Mengisi Biodata</b></td>
<td><b>$r_belum_s[jum]</b></td>
</tr>
</table>";
break;    
    }
    else{

echo "<table> 

	<tr><th>No</th><th>No.Registrasi</th><th>Perguruan Tinggi</th><th>Nama Lengkap</th><th>Asal SMA</th><th>Status</th><th>Pindah Perguruan Tinggi</th></tr>";

$p = new Paging;
$batas = 10;
$posisi = $p->cariPosisi($batas);
$tampil = mysql_query("SELECT t_calon_mahasiswa.*, t_daftar.* FROM t_calon_mahasiswa 
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi
WHERE t_calon_mahasiswa.c_jalur='Undangan' and t_calon_mahasiswa.n_lengkap like '%$_GET[kata]%'LIMIT $posisi,$batas");
$no = $posisi + 1;
while ($r = mysql_fetch_array($tampil))
{
?>
	<tr class="menucell" onMouseDown="pviiClassNew(this,'mousedown')" onMouseOut="pviiClassNew(this,'menucell')" onMouseOver="pviiClassNew(this,'mouseover')"><td><?=$no?></td>
	<td><a href='?module=mhsundangan&act=lihat_undangan&id=<?=$r[i_registrasi]?>'><?=$r[i_registrasi]?></a></td>
	<?php
	if ($r['pilihan'] == "1")
	{
		echo "<td><font color='orange'>POLTEKPOS</font></td>";
	}
	elseif ($r['pilihan'] == "2")
	{
		echo "<td><font color='blue'>STIMLOG</font></td>";
	}
	?>
	<td><?=$r[n_lengkap]?></td>
	<td><?=$r[n_sma]?></td>
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
	echo"<td><a href='?module=mhsundangan&act=pindah&id=$r[i_registrasi]'>Pindah</a></td></tr>";
	$no++;
}
echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM t_calon_mahasiswa WHERE c_jalur='PMDK'"));
	$jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
	$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
	echo "<div id=paging>$linkHalaman</div><br>";

$tampil_belum = mysql_query("SELECT count(id_daftar) as jum
FROM t_daftar
WHERE kode_briva not in (select t_calon_mahasiswa.i_registrasi from t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi) 
and jalur_pendaftaran='2' and pilihan='1' and status='bayar'");
$r_belum    = mysql_fetch_array($tampil_belum);

$p = new Paging;
$batas = 10;
$posisi = $p->cariPosisi($batas);
$tampil_lap = mysql_query("SELECT count(t_calon_mahasiswa.n_pil1) as jum,t_jurusan.NamaJrsn as jur
FROM t_calon_mahasiswa
inner join t_jurusan on t_jurusan.KodeJrsn=t_calon_mahasiswa.n_pil1
WHERE t_calon_mahasiswa.c_jalur='Undangan' and t_jurusan.Jenjang='1'
group by t_jurusan.NamaJrsn
order by t_jurusan.NamaJrsn");
$no = $posisi + 1;

echo"
<table>  
<tr colspan='3'><b>Statistika Poltekpos</b></th> 
<tr><th>No</th><th>Program Studi</th>
<th>Jumlah Pendaftar</th>
</tr>";

while ($r_lap = mysql_fetch_array($tampil_lap))
{   
echo"
<tr>
<td>$no</td>
<td>$r_lap[jur]</td>
<td>$r_lap[jum] </td>
</tr>";
$no++;
$jumlah += $r_lap[jum];
}
echo"
<tr>
<td colspan='2'><b>Total Pendaftar Sudah Mengisi Biodata</b></td>
<td><b>$jumlah</b></td>
</tr>
<tr>
<td colspan='2'><b>Total Pendaftar Belum Mengisi Biodata</b></td>
<td><b>$r_belum[jum]</b></td>
</tr></table>";

$tampil_belum_s = mysql_query("SELECT count(id_daftar) as jum
FROM t_daftar
WHERE kode_briva not in (select t_calon_mahasiswa.i_registrasi from t_calon_mahasiswa
inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi) 
and jalur_pendaftaran='2' and pilihan='2' and status='bayar'");
$r_belum_s    = mysql_fetch_array($tampil_belum_s);

$p = new Paging;
$batas = 10;
$posisi = $p->cariPosisi($batas);
$tampil_lap_s = mysql_query("SELECT count(t_calon_mahasiswa.n_pil1) as jum,t_jurusan.NamaJrsn as jur
FROM t_calon_mahasiswa
inner join t_jurusan on t_jurusan.KodeJrsn=t_calon_mahasiswa.n_pil1
WHERE t_calon_mahasiswa.c_jalur='Undangan' and t_jurusan.Jenjang='2'
group by t_jurusan.NamaJrsn
order by t_jurusan.NamaJrsn");
$no = $posisi + 1;

echo"
<table>  
<tr colspan='3'><b>Statistika Stimlog</b></th> 
<tr><th>No</th><th>Program Studi</th>
<th>Jumlah Pendaftar</th>
</tr>";

while ($r_lap_s = mysql_fetch_array($tampil_lap_s))
{   
echo"
<tr>
<td>$no</td>
<td>$r_lap_s[jur]</td>
<td>$r_lap_s[jum] </td>
</tr>";
$no++;
$jumlah_s += $r_lap_s[jum];
}
echo"
<tr>
<td colspan='2'><b>Total Pendaftar Sudah Mengisi Biodata</b></td>
<td><b>$jumlah_s</b></td>
</tr>
<tr>
<td colspan='2'><b>Total Pendaftar Belum Mengisi Biodata</b></td>
<td><b>$r_belum_s[jum]</b></td>
</tr>
</table>";

}
    break;
  case "lihat_undangan":
    $edit = mysql_query("SELECT t_calon_mahasiswa.*,t_kerja_ortu.n_kerja,t_prop.*,t_kab.* FROM t_calon_mahasiswa
	INNER JOIN t_kab ON t_kab.kd_kab=t_calon_mahasiswa.n_kabupaten
	INNER JOIN t_prop ON t_prop.kd_prop=t_calon_mahasiswa.n_propinsi
	inner join t_kerja_ortu on t_kerja_ortu.id_kerja=t_calon_mahasiswa.n_jabatan 
	WHERE i_registrasi='$_GET[id]'");
  $r    = mysql_fetch_array($edit);
	//D3
	//pil 1
	if ($r[n_pil1] =='01')
	{
		$pil1 = "D3 - Logistik Bisnis";
	}
	
	if($r[n_pil1] =='02')
	{
			$pil1 = "D3 - Manajemen Bisnis";
	}
	if ($r[n_pil1] =='03')
	{
		$pil1 = "D3 - Manajemen Informatika";
	}
	
	if($r[n_pil1] =='04')
	{
			$pil1 = "D3 - Teknik Informatika";
	}
	if($r[n_pil1] =='05')
	{
			$pil1 = "D3 - Akuntansi";
	}
	if($r[n_pil1] =='21')
	{
			$pil1 = "S1 - Manajemen Logistik";
	}
	if($r[n_pil1] =='22')
	{
			$pil1 = "S1 - Manajemen Transportasi";
	}
       
       if($r[n_pil1] =='31')
	{
			$pil1 = "D3 - Akselerasi Teknik Informatika";
	}
	if($r[n_pil1] =='32')
	{
			$pil1 = "D3 - Akselerasi Akuntansi";
	}
	
	if($r[n_pil1] =='34')
	{
			$pil1 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($r[n_pil1] =='35')
	{
			$pil1 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//---pil 2
	if ($r[n_pil2] =='01')
	{
		$pil2 = "D3 - Logistik Bisnis";
	}
	
	if($r[n_pil2] =='02')
	{
			$pil2 = "D3 - Manajemen Bisnis";
	}
	if ($r[n_pil2] =='03')
	{
		$pil2 = "D3 - Manajemen Informatika";
	}
	
	if($r[n_pil2] =='04')
	{
			$pil2 = "D3 - Teknik Informatika";
	}
	if($r[n_pil2] =='05')
	{
			$pil2 = "D3 - Akuntansi";
	}
	if($r[n_pil2] =='21')
	{
			$pil2 = "S1 - Manajemen Logistik";
	}
	if($r[n_pil2] =='22')
	{
			$pil2 = "S1 - Manajemen Transportasi";
	}

      if($r[n_pil2] =='31')
	{
			$pil2 = "D3 - Akselerasi Teknik Informatika";
	}
	if($r[n_pil2] =='32')
	{
			$pil2 = "D3 - Akselerasi Akuntansi";
	}
	
	if($r[n_pil2] =='34')
	{
			$pil2 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($r[n_pil2] =='35')
	{
			$pil2 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//-- pil 3
	if ($r[n_pil3] =='01')
	{
		$pil3 = "D3 - Logistik Bisnis";
	}
	
	if($r[n_pil3] =='02')
	{
			$pil3 = "D3 - Manajemen Bisnis";
	}
	if ($r[n_pil3] =='03')
	{
		$pil3 = "D3 - Manajemen Informatika";
	}
	
	if($r[n_pil3] =='04')
	{
			$pil3 = "D3 - Teknik Informatika";
	}
	if($r[n_pil3] =='05')
	{
			$pil3 = "D3 - Akuntansi";
	}
	if($r[n_pil3] =='21')
	{
			$pil3 = "S1 - Manajemen Logistik";
	}
	if($r[n_pil3] =='22')
	{
			$pil3 = "S1 - Manajemen Transportasi";
	}

	if($r[n_pil3] =='31')
	{
			$pil3 = "D3 - Akselerasi Teknik Informatika";
	}
	if($r[n_pil3] =='32')
	{
			$pil3 = "D3 - Akselerasi Akuntansi";
	}
	
	if($r[n_pil3] =='34')
	{
			$pil3 = "D4 - CLC (Akselerasi Logistik Bisnis)";
	}
	if($r[n_pil3] =='35')
	{
			$pil3 = "D4 - CAC (Akselerasi Akuntansi)";
	}

	//D4
	//pil 1
	if ($r[n_pil1] =='11')
	{
		$pil1 = "D4 - Logistik Bisnis";
	}
	
	if($r[n_pil1] =='12')
	{
			$pil1 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($r[n_pil1] =='13')
	{
		$pil1 = "D4 - Teknik Informatika";
	}
	
	if($r[n_pil1] =='14')
	{
			$pil1 = "D4 - Akuntansi Keuangan";
	}
	//---pil 2
	if ($r[n_pil2] =='11')
	{
		$pil2 = "D4 - Logistik Bisnis";
	}
	
	if($r[n_pil2] =='12')
	{
			$pil2 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($r[n_pil2] =='13')
	{
		$pil2 = "D4 - Teknik Informatika";
	}
	
	if($r[n_pil2] =='14')
	{
			$pil2 = "D4 - Akuntansi Keuangan";
	}
	//-- pil 3
	if ($r[n_pil3] =='11')
	{
		$pil3 = "D4 - Logistik Bisnis";
	}
	
	if($r[n_pil3] =='12')
	{
			$pil3 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($r[n_pil3] =='13')
	{
		$pil3 = "D4 - Teknik Informatika";
	}
	
	if($r[n_pil3] =='14')
	{
			$pil3 = "D4 - Akuntansi Keuangan";
	}

	
	if($r[n_jns_kelamin ] =='L')
	{
			$jk = "Laki-laki";
	} 
	if($r[n_jns_kelamin ] =='P')
	{
			$jk = "Perempuan";
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
	  <h2>Detail Data Pendaftaran Undangan</h2>
        <form method=POST enctype='multipart/form-data' action='#'>
		<table>
 			<tr>
    			<td>
					<table><h3>Data Ujian Peserta</h3>
						<tr><td>Jalur Registrasi</td>		<td> : <?=$r[c_jalur]?></td></tr>
        				<tr><td>No.Registrasi</td> 			<td> : <?=$r[i_registrasi]?></td></tr>
                         <tr><td>N I S N</td> 			<td> : <?=$r[nis]?></td></tr>
						<tr><td>Pilihan 1</td>	    		<td> : <?=$pil1?></td></tr>
						<tr><td>Pilihan 2</td>	    		<td> : <?=$pil2?></td></tr>
						<tr><td>Pilihan 3</td>	    		<td> : <?=$pil3?></td></tr>
						<tr><td>Status</td>	    		<td> : <?=$r[status]?></td></tr>
					</table>
				</td>
    			<td>
					<table><h3>Data Calon Mahasiswa</h3>
						<tr><td>Nama Lengkap</td>  		<td> : <b><?=$r[n_lengkap]?></b></td></tr>
        					<tr><td>Jenis Kelamin</td>		<td> : <?=$jk?></td></tr>
        					<tr><td>Tempat / Tanggal Lahir</td>	<td> : <?=$r[n_temp_lahir]?> / <?=$r[d_lahir]?></td></tr>
        					<tr><td>Alamat</td>    			<td> : <?=$r[n_alamat]?></td></tr>
						<tr><td>Kabupaten, Provinsi</td>    	<td> : <?=$r[nama_kab]?>, <?=$r[nama_prop]?></td></tr>
						<tr><td colspan=2>*) Apabila Kota Calon Mahasiswa tidak terdapat pada pilihan!</td></tr>
						<tr><td>Kodepos</td>    		<td> : <?=$r[c_pos]?></td></tr>
						<tr><td>No.Telepon / HP</td>    	<td> : <?=$r[i_telp]?> / <?=$r[i_hp]?></td></tr>
						<tr><td>Email</td>		    	<td> : <?=$r[n_email]?></td></tr>
					</table>
				</td>
  			</tr>
  			<tr>
    			<td>
					<table><h3>Data Orang Tua</h3>
						<tr><td>Nama Orang Tua</td>    		<td> : <?=$r[n_ortu]?></td></tr>
						<tr><td>Pekerjaan</td>  	  	<td> : <?=$r[n_kerja]?></td></tr>
                                         <tr><td colspan='2'><img src="../peserta/foto/<?=$r[photo];?>" width='200'></td></tr>
					</table>
				</td>
    			<td>
					<table><h3>Data SMA Calon Mahasiswa</h3>
						<tr><td>Nama SMA</td>	    		<td> : <?=$r[n_sma]?></td></tr>
						<tr><td>Jurusan SMA</td>	    	<td> : <?=$r[i_jur_sma]?></td></tr>
						<tr><td>Alamat SMA</td>	    		<td> : <?=$r[n_alamat_sma]?></td></tr>
						<tr><td>Kabupaten, Provinsi</td>	<td> : <?=$nama_kab_sma?>, <?=$nama_prop_sma?></td></tr>
						
<tr><td>Scan Sampul Amplop</td> 	<td> :<a href="../peserta/amplop/<?=$r[rekomendasi];?>" onClick="return GB_showCenter('Tentang Web', this.href)"><?=$r[rekomendasi];?></a></td></tr>
<tr><td>Scan Surat Undangan</td> 	<td> :<a href="../peserta/undangan/<?=$r[smt11];?>" onClick="return GB_showCenter('Tentang Web', this.href)"><?=$r[smt11];?></a></td></tr>

					</table>
				</td>
 	 		</tr>
  			<tr>
    			<tr><td colspan=2 align=center><input type=button value=Kembali onclick=self.history.back() style="cursor:pointer">
						<a href="?module=mhsundangan&act=update&id=<?=$r[i_registrasi]?>" style="text-decoration:none"><input type="button" value="Edit" style="cursor:pointer"></a></td></tr>
  			
		</table>
        </form>
		<?php

	break;  
	
	case"update":
	$edit = mysql_query("SELECT t_calon_mahasiswa.*
					FROM t_calon_mahasiswa
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
	<h2>Edit Data Pendaftaran Undangan</h2>
	<? echo "
		  <form method=POST enctype='multipart/form-data' action='$aksi?module=mhsundangan&act=editreg' name='demo'>";?>
		  
		<table>
 			<tr>
    			<td>
					<table>
						<h3>Data Ujian Peserta</h3>
						<tr><td>Jalur Registrasi</td><td> : <?=$r[c_jalur]?></td></tr>
        				<tr><td>No.Registrasi</td><td> : <b><?=$r[i_registrasi]?></b></td></tr>
				<?php if ($r[status]=='Registrasi')
{  ?>
						<tr><td>Pilihan 1</td><td> : 
						<select name="pil1" id="pil1" style="width:167">
						<?php
						$qpil1 = mysql_query("
SELECT distinct a.KodeJrsn, a.NamaJrsn FROM t_jurusan a 
left join t_daftar on t_daftar.pilihan=a.jenjang 
where t_daftar.kode_briva='$r[i_registrasi]' ORDER BY a.Id ASC");
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
						$qpil2 = mysql_query("
SELECT distinct a.KodeJrsn, a.NamaJrsn FROM t_jurusan a 
left join t_daftar on t_daftar.pilihan=a.jenjang 
where t_daftar.kode_briva='$r[i_registrasi]' ORDER BY a.Id ASC");
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
						$qpil3 = mysql_query("
SELECT distinct a.KodeJrsn, a.NamaJrsn FROM t_jurusan a 
left join t_daftar on t_daftar.pilihan=a.jenjang 
where t_daftar.kode_briva='$r[i_registrasi]' ORDER BY a.Id ASC");
						while ($rpil3 = mysql_fetch_array($qpil3))
						{
						?>
							<option value="<?=$rpil3['KodeJrsn']?>" <?=($rpil3['KodeJrsn'] == $r[n_pil3]) ? ' selected':''?>><?=$rpil3['NamaJrsn']?></option>
						<?php
						}
						?>
						</td>
						</tr>
<?php 
}
else
{
?>
<tr><td>Pilihan 1</td><td> : 
						<select name="pil1" id="pil1" style="width:167" disabled='disabled'>
						<?php
						$qpil1 = mysql_query("
SELECT distinct a.KodeJrsn, a.NamaJrsn FROM t_jurusan a 
left join t_daftar on t_daftar.pilihan=a.jenjang 
where t_daftar.kode_briva='$r[i_registrasi]' ORDER BY a.Id ASC");
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
						<select name="pil2" id="pil2" style="width:167" disabled='disabled'>
						<?php
						$qpil2 = mysql_query("
SELECT distinct a.KodeJrsn, a.NamaJrsn FROM t_jurusan a 
left join t_daftar on t_daftar.pilihan=a.jenjang 
where t_daftar.kode_briva='$r[i_registrasi]' ORDER BY a.Id ASC");
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
						<select name="pil3" id="pil3" style="width:167" disabled='disabled'>
						<?php
						$qpil3 = mysql_query("
SELECT distinct a.KodeJrsn, a.NamaJrsn FROM t_jurusan a 
left join t_daftar on t_daftar.pilihan=a.jenjang 
where t_daftar.kode_briva='$r[i_registrasi]' ORDER BY a.Id ASC");
						while ($rpil3 = mysql_fetch_array($qpil3))
						{
						?>
							<option value="<?=$rpil3['KodeJrsn']?>" <?=($rpil3['KodeJrsn'] == $r[n_pil3]) ? ' selected':''?>><?=$rpil3['NamaJrsn']?></option>
						<?php
						}
						?>
						</td>
						</tr>
<?php
}
?>
						<tr><td>Tahu Informasi dari</td><td> : <select name="informasi" id="informasi" style="width:167">
						<?php
						$info = mysql_query("SELECT * from t_informasi");
						while ($r_info = mysql_fetch_array($info))
						{
						?>
							<option value="<?=$r_info['Id']?>" <?=($r_info['Id'] == $r[c_inf]) ? ' selected':''?>><?=$r_info['NamaInf']?></option>
						<?php
						}
						?>
						</select></td></tr>
						
												
						<tr>
						<td>Status</td><td> : <?=$r[status]?></td></tr>
					</table>
				
    			<td>
					<table>
						<h3>Data Orang Tua</h3>
						<tr><td>Nama Orang Tua</td><td> : <input type="text" name="n_ortu" value="<?=$r[n_ortu]?>" size="30"></td></tr>
						<tr><td>Pekerjaan</td><td> : 
						<select name="n_jabatan" id="n_jabatan" style="width:167">
						<?php
						$kerja = mysql_query("SELECT * from t_kerja_ortu ");
						while ($r_kerja = mysql_fetch_array($kerja))
						{
						?>
							<option value="<?=$r_kerja['id_kerja']?>" <?=($r_kerja['id_kerja'] == $r[n_jabatan]) ? ' selected':''?>><?=$r_kerja['n_kerja']?></option>
						<?php
						}
						?>
						</select>
						
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
						<tr><td>Kabupaten</td><td> :  <select name='kab' id="kabupaten"> <?
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
		
		 				</select></td></tr>
						<tr><td>*Kota Lain</td><td> : <input type="text" name="n_kota_lain" value="<?=$r[n_kota_lain]?>"></td></tr>
						<tr><td colspan=2>*) Apabila Kota Calon Mahasiswa tidak terdapat pada pilihan!</td></tr>
						<tr><td>Kodepos</td><td> : <input type="text" name="c_pos" value="<?=$r[c_pos]?>"></td></tr>
						<tr><td>No. Telepon</td><td> : <input type="text" name="i_telp" value="<?=$r[i_telp]?>"></td></tr>
						<tr><td>No. HP</td><td> : <input type="text" name="i_hp" value="<?=$r[i_hp]?>"></td></tr>
						<tr><td>Email</td><td> : <input type="text" name="n_email" value="<?=$r[n_email]?>" size="50"></td></tr>
					</table>
					<table><h3>Data SMA Calon Mahasiswa</h3>
						<tr><td>Nama SMA</td><td> : <input type="text" name="n_sma" value="<?=$r[n_sma]?>" size="50"></td></tr>
						<tr><td>Jurusan SMA</td><td> : 
                                         <select name="i_jur_sma" id="i_jur_sma" style="width:167">
						<?php
						$sma = mysql_query("SELECT * from t_jurusan_sma ");
						while ($r_sma = mysql_fetch_array($sma))
						{
						?>
							<option value="<?=$r_sma['KodeSMU']?>" <?=($r_sma['KodeSMU'] == $r[i_jur_sma]) ? ' selected':''?>><?=$r_sma['Keterangan']?></option>
						<?php
						}
						?></td></tr>
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
						
						</td></tr>
						<tr><td>Nilai Rata kls XI smstr II</td> <td> : <input type="text" name="rataXI" value='<?=$r[rata2_XI_2]?>'/></td></tr>
						<tr><td>Nilai Matematika kls XI</td> 	<td> : <input type="text" name="mtkXI" value='<?=$r[mtk_XI_2]?>'/></td></tr>
						<tr><td>Nilai Bhs.Inggris kls XI</td> 	<td> : <input type="text" name="ingXI" value='<?=$r[ing_XI_2]?>'/></td></tr>
						<tr><td>Nilai Rata kls XII smstr I</td> <td> : <input type="text" name="rataXII" value='<?=$r[rata2_XII_1]?>'/></td></tr>
						<tr><td>Nilai Matematika kls XII</td> 	<td> : <input type="text" name="mtkXII" value='<?=$r[mtk_XII_1]?>'/></td></tr>
						<tr><td>Nilai Bhs.Inggris kls XII</td> 	<td> : <input type="text" name="ingXII" value='<?=$r[ing_XII_1]?>'/></td></tr>
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

case "lulus":
	   
echo"
    <h2>Input Kelulusan Undangan</h2>
	<form method=POST enctype='multipart/form-data' action='$aksi?module=mhsundangan&act=inputmhsexcel'>

	   <table>
          
          <tr><td width=15%>Silakan Pilih File Excel</td>     <td> : <input type=file name='file' size=40></td></tr>
         
          <tr><td colspan=2><input type='submit' value='Import' name='submit'> <font color='red'>* Format file csv: no pendaftaran, nama lengkap, kode program studi / sebelum diupload headernya dihilangkan terlebih dahulu</td></tr>
          </table>
				
	</form>";

echo"
<table><h3>Daftar Kode Program Studi</h3>
<th>Kode Program Studi</th>
<th>Nama Program Studi</th>";

$tam_jur= mysql_query("SELECT * FROM t_jurusan order by NamaJrsn");
while ($r = mysql_fetch_array($tam_jur))
{ 
echo"
<tr>
<td>$r[KodeJrsn]</td>
<td>$r[NamaJrsn]</td>
</tr>";
} 
echo"</table>";
    break;  

case "pindah":
$edit = mysql_query("SELECT t_calon_mahasiswa.*
					FROM t_calon_mahasiswa
					WHERE t_calon_mahasiswa.i_registrasi='$_GET[id]'");
	$r = mysql_fetch_array($edit);	   
echo"
    <h2>Pindah Perguruan Tinggi</h2>
	<form method='POST' enctype='multipart/form-data' action='$aksi?module=mhsundangan&act=pindah'>

	   <table>"; ?>
<tr><td>Pilihan Perguruan Tinggi</td><td> : <input type="radio"  id="pilihan" name="pilihan" value="1" checked/> POLTEKPOS
<input type="radio" class="form-radio" id="pilihan" name="pilihan" value="2" /> STIMLOG
						</td>
						</tr>
   
          <tr><td>Pilihan 1</td><td> : 
						<select name="pil1" id="pil1" style="width:167">
						<?php
						$qpil1 = mysql_query("
SELECT distinct a.KodeJrsn, a.NamaJrsn FROM t_jurusan a ORDER BY a.NamaJrsn ASC");
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
						$qpil2 = mysql_query("
SELECT distinct a.KodeJrsn, a.NamaJrsn FROM t_jurusan a ORDER BY a.NamaJrsn ASC");
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
						$qpil3 = mysql_query("
SELECT distinct a.KodeJrsn, a.NamaJrsn FROM t_jurusan a ORDER BY a.NamaJrsn ASC");
						while ($rpil3 = mysql_fetch_array($qpil3))
						{
						?>
							<option value="<?=$rpil3['KodeJrsn']?>" <?=($rpil3['KodeJrsn'] == $r[n_pil3]) ? ' selected':''?>><?=$rpil3['NamaJrsn']?></option>
						<?php
						}
						?>
						</td>
						</tr>

<?php
         
          echo"<tr><td colspan=2><input type='hidden' value='$r[i_registrasi]' name='id'> <input type='submit' value='Simpan' name='simpan'></td></tr>
          </table></form>";


    break;  
}
}

?>
</body>