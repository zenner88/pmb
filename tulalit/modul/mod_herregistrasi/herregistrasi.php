<!--
Coding untuk parsing data dari table berdasarkan combobox yang dipilih
Coding by : Syaifullah (http://carikosan.info | http://carikosan.info/portfolio)
-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="js/jquery.js" type="text/javascript" language="javascript"></script>
<script language="javascript">
    $(document).ready(function() {
	$('#pil1').change(function() {
	    // get province's value
	    var pil_1 = $(this).val();
	    // request to server with ajax
	    if ($(this).val() != 0) {
		$.get('modul/mod_herregistrasi/ambil_data.php', {pil_1: pil_1},
		function(data) {
		    console.log(data);
		    $.each(data, function(idx, val) {
			$('#nominal').val(val.nominal);
		    });
		}, 'json'
			);
	    } else {
		$('#nominal').val('0');
	    }
	    ;
	});
    });
</script>

<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    function GetCheckboxes($table, $key, $Label, $Nilai = '') {
	$s = "select * from $table order by nama_tag";
	$r = mysql_query($s);
	$_arrNilai = explode(',', $Nilai);
	$str = '';
	while ($w = mysql_fetch_array($r)) {
	    $_ck = (array_search($w[$key], $_arrNilai) === false) ? '' : 'checked';
	    $str .= "<input type=checkbox name='" . $key . "[]' value='$w[$key]' $_ck>$w[$Label] ";
	}
	return $str;
    }

//include "config/fungsi_indotgl.php"; 
    $aksi = "modul/mod_herregistrasi/aksi_herregistrasi.php";
    switch ($_GET[act]) {

	// Tampil Berita
	default:
	    include "menu_atas.php";

	    echo "<h2>Data Calon Mahasiswa Baru</h2><br>
	      <!-- <a href='modul/mod_cetak/preview_posreguler.php' target='_blank'>Print Preview</a> || <a href='modul/mod_cetak/excel_posreguler.php'>Ekspor ke Excel</a>-->
          <form method=get action='$_SERVER[PHP_SELF]'>
          <input type=hidden name=module value=herregistrasi>
          <div id=paging>Masukkan Nama : <input type=text name='kata'> <input type=submit class='tombol' value=Cari></div>
          </form>
		  <hr>
		  <div style='background:#FCF886'>
		  <B>CETAK LAPORAN</B> </br>

<form method='POST' action='modul/mod_cetak/lap_herregistrasi.php' target='_blank'>
          <input type=hidden name=module value=daftar>
          <div id=paging>
		  <B> &nbsp &nbsp PEMBAYARAN HERREGISTRASI MABA:</B> <input type=radio name='jenis' value='semua' checked> SEMUA <input type=radio name='jenis' value='poltek'> POLTEKPOS  <input type=radio name='jenis' value='stimlog'> STIMLOG 
		  
				
		  <input type=submit class='tombol' value=Cetak></div>
</form>

		  <form method='POST' action='modul/mod_cetak/preview_posreguler.php' target='_blank'>
          <input type=hidden name=module value=daftar>
          <div id=paging>
		  <B> &nbsp &nbsp PT :</B> <input type=radio name='pt' value='1' checked> POLTEKPOS  <input type=radio name='pt' value='2'> STIMLOG  | 
		  <B>Jalur :</B> <input type=radio name='jalur' value='0' checked> PMDK  <input type=radio name='jalur' value='1'> REGULER | 
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
	    $query_lks = mysql_query("select * from admins where blokir='N' order by nama_lengkap");
	    ?>
	    <select name="validator" size="1" >
	        <option selected="selected" value="semua">Cetak Semua</option>
		<?php
		while ($row_lks = mysql_fetch_array($query_lks)) {
		    ;
		    ?>
		    <option value ="<?php echo $row_lks['username']; ?>"><?php echo $row_lks['nama_lengkap']; ?></option>
		    <?php
		}
		echo"
                        </select>		  
				
		  <input type=submit class='tombol' value=Cetak></div>
          </form>
</div><hr>
		  ";

		if (empty($_GET['kata'])) {
		    echo "<table>  
          <tr><th>No</th><th>No.Registrasi</th>
<th>Nama</th>
<th>Nama SMA</th>
<th>Jalur</th>
<th>Perguruan Tinggi</th>
<th>Diterima</th>
<th>Status</th>
<th>Bukti Pembayaran</th></tr>";

		    $p = new Paging;
		    $batas = 10;
		    $posisi = $p->cariPosisi($batas);

		    if ($_SESSION['leveluser'] == 'admin') {
			$tampil = mysql_query("SELECT t_calon_mahasiswa.*,t_daftar.pilihan from t_calon_mahasiswa
              inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi 
		where t_calon_mahasiswa.i_registrasi in (select i_registrasi from t_kelulusan)order
              by t_calon_mahasiswa.n_lengkap ASC LIMIT $posisi,$batas");
		    } else {
			$tampil = mysql_query("SELECT t_calon_mahasiswa.*,t_daftar.pilihan from t_calon_mahasiswa
              inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi 
		where t_calon_mahasiswa.i_registrasi in (select i_registrasi from t_kelulusan) order
              by t_calon_mahasiswa.n_lengkap ASC LIMIT $posisi,$batas");
		    }

		    $no = $posisi + 1;
		    while ($r = mysql_fetch_array($tampil)) {
			?>
		        <tr class="menucell" onMouseDown="pviiClassNew(this, 'mousedown')" onMouseOut="pviiClassNew(this, 'menucell')" onMouseOver="pviiClassNew(this, 'mouseover')">
		    	<td><?= $no ?></td>


			    <?
			    if ($r['status'] == "Registrasi") {
				echo "<td><a href='?module=herregistrasi&act=update&id=$r[i_registrasi]'>$r[i_registrasi]</a></td>";
			    } elseif ($r['status'] == "belum") {
				echo "<td><a href='?module=herregistrasi&act=update&id=$r[i_registrasi]'>$r[i_registrasi]</a></td>";
			    }
			      elseif ($r['status'] == "lunas") {
				echo "<td>$r[i_registrasi]</td>";
			    } else {
				echo "<td>-</td>";
			    }
			    ?>

		    	<td><?= $r[n_lengkap] ?></td>

		    	<td><?= $r[n_sma] ?></td>

			    <?php
			    if ($r['c_gel'] == "PMDK") {
				echo "<td>PMDK</td>";
			    } elseif ($r['c_gel'] == "I") {
				echo "<td>REGULER I</td>";
			    } elseif ($r['c_gel'] == "II") {
				echo "<td>REGULER II</td>";
			    } elseif ($r['c_gel'] == "III") {
				echo "<td>REGULER III</td>";
			    } elseif ($r['c_gel'] == "UDG") {
				echo "<td>UNDANGAN</td>";
			    } else {
				echo "<td>-</td>";
			    }
			    ?>

			    <?php
			    if ($r['pilihan'] == "1") {
				echo "<td>POLTEKPOS</td>";
			    } elseif ($r['pilihan'] == "2") {
				echo "<td>STIMLOG</td>";
			    } else {
				echo "<td>-</td>";
			    }
			    ?>
			    <?
			    //D3
			    //pil 1
			    if ($r[n_pil1] == '01') {
				$pil1 = "D3 - Logistik Bisnis";
			    }

			    if ($r[n_pil1] == '02') {
				$pil1 = "D3 - Manajemen Bisnis";
			    }
			    if ($r[n_pil1] == '03') {
				$pil1 = "D3 - Manajemen Informatika";
			    }

			    if ($r[n_pil1] == '04') {
				$pil1 = "D3 - Teknik Informatika";
			    }
			    if ($r[n_pil1] == '05') {
				$pil1 = "D3 - Akuntansi";
			    }
			    if ($r[n_pil1] == '21') {
				$pil1 = "S1 - Manajemen Logistik";
			    }
			    if ($r[n_pil1] == '22') {
				$pil1 = "S1 - Manajemen Transportasi";
			    }

			    if ($r[n_pil1] == '31') {
				$pil1 = "D3 - Akselerasi Teknik Informatika";
			    }
			    if ($r[n_pil1] == '32') {
				$pil1 = "D3 - Akselerasi Akuntansi";
			    }

			    if ($r[n_pil1] == '34') {
				$pil1 = "D4 - CLC (Akselerasi Logistik Bisnis)";
			    }
			    if ($r[n_pil1] == '35') {
				$pil1 = "D4 - CAC (Akselerasi Akuntansi)";
			    }


			    //D4
			    //pil 1
			    if ($r[n_pil1] == '11') {
				$pil1 = "D4 - Logistik Bisnis";
			    }

			    if ($r[n_pil1] == '12') {
				$pil1 = "D4 - Manajemen Perusahaan / Bisnis";
			    }
			    if ($r[n_pil1] == '13') {
				$pil1 = "D4 - Teknik Informatika";
			    }

			    if ($r[n_pil1] == '14') {
				$pil1 = "D4 - Akuntansi Keuangan";
			    }
			    ?>

		    	<td><?= $pil1 ?></td>
			    <?php
			    if ($r['status'] == "Registrasi") {
				echo "<td><font color='orange'>$r[status]</font></td>";
			    } elseif ($r['status'] == "belum") {
				echo "<td><font color='orange'>$r[status]</font></td>";
			    } 
			      elseif ($r['status'] == "lunas") {
				echo "<td><font color='green'>$r[status]</font></td>";
			    }else {
				echo "<td><font color='red'>$r[status]</font></td>";
			    }


			    if ($r['status'] == "lunas" or $r['status'] == "belum") {
				
				echo"<td><a href='?module=herregistrasi&act=kelengkapan&id=$r[i_registrasi]'>Cek Kelengkapan</a></td>";
				
			    }  else {
				echo "<td>-</td>";
			    }

			    echo "</tr>";
			    $no++;
			}
			echo "</table>";

			if ($_SESSION['leveluser'] == 'admin') {
			    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM t_calon_mahasiswa where i_registrasi in (select i_registrasi from t_kelulusan)"));
			} else {
			    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM t_calon_mahasiswa where i_registrasi in (select i_registrasi from t_kelulusan)"));
			}
			$jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
			$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

			echo "<div id=paging>$linkHalaman</div><br>";

$tampil_belum = mysql_query("SELECT count(t_herregistrasi.id) as jum
FROM t_herregistrasi
inner join t_calon_mahasiswa on t_calon_mahasiswa.i_registrasi=t_herregistrasi.i_registrasi
inner join t_jurusan on t_jurusan.KodeJrsn=t_herregistrasi.id_jur
WHERE t_calon_mahasiswa.status <> 'Registrasi' and t_jurusan.Jenjang='1'");
$r_belum    = mysql_fetch_array($tampil_belum);

$p = new Paging;
$batas = 10;
$posisi = $p->cariPosisi($batas);
$tampil_lap = mysql_query("SELECT count(t_herregistrasi.id) as jum,t_jurusan.NamaJrsn as jur,t_jurusan.KodeJrsn as kode
FROM t_herregistrasi
inner join t_calon_mahasiswa on t_calon_mahasiswa.i_registrasi=t_herregistrasi.i_registrasi
inner join t_jurusan on t_jurusan.KodeJrsn=t_herregistrasi.id_jur
WHERE t_calon_mahasiswa.status <> 'Registrasi' and t_jurusan.Jenjang='1'
group by t_jurusan.NamaJrsn
order by t_jurusan.NamaJrsn");
$no = $posisi + 1;

echo"
<table>  
<tr colspan='3'><b>Statistika Poltekpos</b></th> 
<tr><th>No</th><th>Program Studi</th>
<th>Jumlah Pendaftar</th>
<th>Cetak Laporan (excel)</th>
</tr>";

while ($r_lap = mysql_fetch_array($tampil_lap))
{   
echo"
<tr>
<td>$no</td>
<td><a href='?module=herregistrasi&act=detail&id=$r_lap[kode]'>$r_lap[jur]</a></td>
<td>$r_lap[jum] </td>
<td><a href='excel/laporan_hereg.php?id=$r_lap[kode]'>Cetak</a></td>
</tr>";
$no++;
$jumlah += $r_lap[jum];
}
echo"
<tr>
<td colspan='2'><b>Total Pendaftar </b></td>
<td><b>$jumlah</b></td>
<td><a href='excel/laporan_hereg_semua.php'>Cetak Semua</a></td>
</tr></table>";

$tampil_belum_s = mysql_query("SELECT count(t_herregistrasi_stimlog.id) as jum
FROM t_herregistrasi_stimlog
inner join t_calon_mahasiswa on t_calon_mahasiswa.i_registrasi=t_herregistrasi_stimlog.i_registrasi
inner join t_jurusan on t_jurusan.KodeJrsn=t_herregistrasi_stimlog.id_jur
WHERE t_calon_mahasiswa.status <> 'Registrasi' and t_jurusan.Jenjang='2'");
$r_belum_s    = mysql_fetch_array($tampil_belum_s);

$p = new Paging;
$batas = 10;
$posisi = $p->cariPosisi($batas);
$tampil_lap_s = mysql_query("SELECT count(t_herregistrasi_stimlog.id) as jum,t_jurusan.NamaJrsn as jur,t_jurusan.KodeJrsn as kode
FROM t_herregistrasi_stimlog
inner join t_calon_mahasiswa on t_calon_mahasiswa.i_registrasi=t_herregistrasi_stimlog.i_registrasi
inner join t_jurusan on t_jurusan.KodeJrsn=t_herregistrasi_stimlog.id_jur
WHERE t_calon_mahasiswa.status <> 'Registrasi' and t_jurusan.Jenjang='2'
group by t_jurusan.NamaJrsn
order by t_jurusan.NamaJrsn");
$no = $posisi + 1;

echo"
<table>  
<tr colspan='3'><b>Statistika Stimlog</b></th> 
<tr><th>No</th><th>Program Studi</th>
<th>Jumlah Pendaftar</th>
<th>Cetak Laporan (excel)</th>
</tr>";

while ($r_lap_s = mysql_fetch_array($tampil_lap_s))
{   
echo"
<tr>
<td>$no</td>
<td><a href='?module=herregistrasi&act=detail&id=$r_lap_s[kode]'>$r_lap_s[jur]</a></td>
<td>$r_lap_s[jum] </td>
<td><a href='excel/laporan_hereg.php?id=$r_lap_s[kode]'>Cetak</a></td>
</tr>";
$no++;
$jumlah_s += $r_lap_s[jum];
}
echo"
<tr>
<td colspan='2'><b>Total Pendaftar</b></td>
<td><b>$jumlah_s</b></td>
<td><a href='excel/laporan_hereg_semua_stimlog.php'>Cetak Semua</a></td>
</tr>
</table>";
			break;
		    } else {
			echo "<table>  
          <tr><th>No</th><th>No.Registrasi</th>
<th>Nama</th>
<th>Nama SMA</th>
<th>Jalur</th>
<th>Perguruan Tinggi</th>
<th>Diterima</th>
<th>Status</th>
<th>Bukti Pembayaran</th></tr>";


			$p = new Paging9;
			$batas = 10;
			$posisi = $p->cariPosisi($batas);

			if ($_SESSION['leveluser'] == 'admin') {
			    $tampil = mysql_query("SELECT t_calon_mahasiswa.*,t_daftar.pilihan from t_calon_mahasiswa
              inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi WHERE t_calon_mahasiswa.n_lengkap LIKE '%$_GET[kata]%' 
		and t_calon_mahasiswa.i_registrasi in (select i_registrasi from t_kelulusan) ORDER BY t_calon_mahasiswa.n_lengkap DESC LIMIT $posisi,$batas");
			} else {
			    $tampil = mysql_query("SELECT t_calon_mahasiswa.*,t_daftar.pilihan from t_calon_mahasiswa
              inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi WHERE t_calon_mahasiswa.n_lengkap LIKE '%$_GET[kata]%' 
		and t_calon_mahasiswa.i_registrasi in (select i_registrasi from t_kelulusan) ORDER BY t_calon_mahasiswa.n_lengkap DESC LIMIT $posisi,$batas");
			}

			$no = $posisi + 1;
			while ($r = mysql_fetch_array($tampil)) {
			    ?>
		        <tr class="menucell" onMouseDown="pviiClassNew(this, 'mousedown')" onMouseOut="pviiClassNew(this, 'menucell')" onMouseOver="pviiClassNew(this, 'mouseover')">
		    	<td><?= $no ?></td>
			    <?
			    if ($r['status'] == "Registrasi") {
				echo "<td><a href='?module=herregistrasi&act=update&id=$r[i_registrasi]'>$r[i_registrasi]</a></td>";
			    } elseif ($r['status'] == "belum") {
				echo "<td><a href='?module=herregistrasi&act=update&id=$r[i_registrasi]'>$r[i_registrasi]</a></td>";
			    }
			      elseif ($r['status'] == "lunas") {
				echo "<td>$r[i_registrasi]</td>";
			    } else {
				echo "<td>-</td>";
			    }
			    ?>
		    	<td><?= $r[n_lengkap] ?></td>

		    	<td><?= $r[n_sma] ?></td>

			    <?php
			    if ($r['c_gel'] == "PMDK") {
				echo "<td>PMDK</td>";
			    } elseif ($r['c_gel'] == "I") {
				echo "<td>REGULER I</td>";
			    } elseif ($r['c_gel'] == "II") {
				echo "<td>REGULER II</td>";
			    } elseif ($r['c_gel'] == "III") {
				echo "<td>REGULER III</td>";
			    } elseif ($r['c_gel'] == "UDG") {
				echo "<td>UNDANGAN</td>";
			    } else {
				echo "<td>-</td>";
			    }
			    ?>

			    <?php
			    if ($r['pilihan'] == "1") {
				echo "<td>POLTEKPOS</td>";
			    } elseif ($r['pilihan'] == "2") {
				echo "<td>STIMLOG</td>";
			    } else {
				echo "<td>-</td>";
			    }
			    ?>
			    <?
			    //D3
			    //pil 1
			    if ($r[n_pil1] == '01') {
				$pil1 = "D3 - Logistik Bisnis";
			    }

			    if ($r[n_pil1] == '02') {
				$pil1 = "D3 - Manajemen Bisnis";
			    }
			    if ($r[n_pil1] == '03') {
				$pil1 = "D3 - Manajemen Informatika";
			    }

			    if ($r[n_pil1] == '04') {
				$pil1 = "D3 - Teknik Informatika";
			    }
			    if ($r[n_pil1] == '05') {
				$pil1 = "D3 - Akuntansi";
			    }
			    if ($r[n_pil1] == '21') {
				$pil1 = "S1 - Manajemen Logistik";
			    }
			    if ($r[n_pil1] == '22') {
				$pil1 = "S1 - Manajemen Transportasi";
			    }

			    if ($r[n_pil1] == '31') {
				$pil1 = "D3 - Akselerasi Teknik Informatika";
			    }
			    if ($r[n_pil1] == '32') {
				$pil1 = "D3 - Akselerasi Akuntansi";
			    }

			    if ($r[n_pil1] == '34') {
				$pil1 = "D4 - CLC (Akselerasi Logistik Bisnis)";
			    }
			    if ($r[n_pil1] == '35') {
				$pil1 = "D4 - CAC (Akselerasi Akuntansi)";
			    }


			    //D4
			    //pil 1
			    if ($r[n_pil1] == '11') {
				$pil1 = "D4 - Logistik Bisnis";
			    }

			    if ($r[n_pil1] == '12') {
				$pil1 = "D4 - Manajemen Perusahaan / Bisnis";
			    }
			    if ($r[n_pil1] == '13') {
				$pil1 = "D4 - Teknik Informatika";
			    }

			    if ($r[n_pil1] == '14') {
				$pil1 = "D4 - Akuntansi Keuangan";
			    }
			    ?>

		    	<td><?= $pil1 ?></td>
			    <?php
			    if ($r['status'] == "bayar") {
				echo "<td><font color='green'>$r[status]</font></td>";
			    } elseif ($r['status'] == "belum") {
				echo "<td><font color='red'>$r[status]</font></td>";
			    } else {
				echo "<td><font color='orange'>$r[status]</font></td>";
			    }


			    if ($r['status'] == "lunas" or $r['status'] == "belum") {
				
				echo"<td><a href='?module=herregistrasi&act=kelengkapan&id=$r[i_registrasi]'>Cek Kelengkapan</a></td>";
				
			    }  else {
				echo "<td>-</td>";
			    }
			    echo "</tr>";
			    $no++;
			}
			echo "</table>";

			if ($_SESSION['leveluser'] == 'admin') {
			    $jmldata = mysql_num_rows(mysql_query("SELECT t_calon_mahasiswa.*,t_daftar.pilihan from t_calon_mahasiswa
              inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi WHERE t_calon_mahasiswa.n_lengkap LIKE '%$_GET[kata]%' and t_calon_mahasiswa.i_registrasi in (select i_registrasi from t_kelulusan)"));
			} else {
			    $jmldata = mysql_num_rows(mysql_query("SELECT t_calon_mahasiswa.*,t_daftar.pilihan from t_calon_mahasiswa
              inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi WHERE t_calon_mahasiswa.n_lengkap LIKE '%$_GET[kata]%' and t_calon_mahasiswa.i_registrasi in (select i_registrasi from t_kelulusan) ORDER BY t_calon_mahasiswa.n_lengkap"));
			}
			$jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
			$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

			echo "<div id=paging>$linkHalaman</div><br>";
$tampil_belum = mysql_query("SELECT count(t_herregistrasi.id) as jum
FROM t_herregistrasi
inner join t_calon_mahasiswa on t_calon_mahasiswa.i_registrasi=t_herregistrasi.i_registrasi
inner join t_jurusan on t_jurusan.KodeJrsn=t_herregistrasi.id_jur
WHERE t_calon_mahasiswa.status <> 'Registrasi' and t_jurusan.Jenjang='1'");
$r_belum    = mysql_fetch_array($tampil_belum);

$p = new Paging;
$batas = 10;
$posisi = $p->cariPosisi($batas);
$tampil_lap = mysql_query("SELECT count(t_herregistrasi.id) as jum,t_jurusan.NamaJrsn as jur,t_jurusan.KodeJrsn as kode
FROM t_herregistrasi
inner join t_calon_mahasiswa on t_calon_mahasiswa.i_registrasi=t_herregistrasi.i_registrasi
inner join t_jurusan on t_jurusan.KodeJrsn=t_herregistrasi.id_jur
WHERE t_calon_mahasiswa.status <> 'Registrasi' and t_jurusan.Jenjang='1'
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
<td><a href='?module=herregistrasi&act=detail&id=$r_lap[kode]'>$r_lap[jur]</a></td>
<td>$r_lap[jum] </td>
</tr>";
$no++;
$jumlah += $r_lap[jum];
}
echo"
<tr>
<td colspan='2'><b>Total Pendaftar </b></td>
<td><b>$jumlah</b></td>
</tr></table>";

$tampil_belum_s = mysql_query("SELECT count(t_herregistrasi_stimlog.id) as jum
FROM t_herregistrasi_stimlog
inner join t_calon_mahasiswa on t_calon_mahasiswa.i_registrasi=t_herregistrasi_stimlog.i_registrasi
inner join t_jurusan on t_jurusan.KodeJrsn=t_herregistrasi_stimlog.id_jur
WHERE t_calon_mahasiswa.status <> 'Registrasi' and t_jurusan.Jenjang='2'");
$r_belum_s    = mysql_fetch_array($tampil_belum_s);

$p = new Paging;
$batas = 10;
$posisi = $p->cariPosisi($batas);
$tampil_lap_s = mysql_query("SELECT count(t_herregistrasi_stimlog.id) as jum,t_jurusan.NamaJrsn as jur,t_jurusan.KodeJrsn as kode
FROM t_herregistrasi_stimlog
inner join t_calon_mahasiswa on t_calon_mahasiswa.i_registrasi=t_herregistrasi_stimlog.i_registrasi
inner join t_jurusan on t_jurusan.KodeJrsn=t_herregistrasi_stimlog.id_jur
WHERE t_calon_mahasiswa.status <> 'Registrasi' and t_jurusan.Jenjang='2'
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
<td><a href='?module=herregistrasi&act=detail&id=$r_lap_s[kode]'>$r_lap_s[jur]</a></td>
<td>$r_lap_s[jum] </td>
</tr>";
$no++;
$jumlah_s += $r_lap_s[jum];
}
echo"
<tr>
<td colspan='2'><b>Total Pendaftar</b></td>
<td><b>$jumlah_s</b></td>
</tr>
</table>
";
		    }
		    break;



		case"update":
		    ?>
	        <script language="javascript">
	    function validasi(form) {
	    if (form.bukti_pembayaran.value == "") {
	    alert("Bukti Pembayaran masih kosong ");
	    form.bukti_pembayaran.focus();
	    return (false);

	    }

	    return (true);
	    }
	        </script>

		<?
		$tampil = mysql_query("SELECT t_calon_mahasiswa.*,t_daftar.* from t_calon_mahasiswa
              inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi
					WHERE t_calon_mahasiswa.i_registrasi='$_GET[id]'");
		$r = mysql_fetch_array($tampil);
$cekbayar=mysql_fetch_array(mysql_query("SELECT t_herregistrasi.*, t_jurusan.NamaJrsn FROM t_herregistrasi 
inner join t_jurusan on t_jurusan.KodeJrsn =t_herregistrasi.id_jur where t_herregistrasi.i_registrasi='$_GET[id]'
union
SELECT t_herregistrasi_stimlog.*, t_jurusan.NamaJrsn FROM t_herregistrasi_stimlog 
inner join t_jurusan on t_jurusan.KodeJrsn =t_herregistrasi_stimlog.id_jur where
t_herregistrasi_stimlog.i_registrasi='$_GET[id]'"));

$cekbiaya=mysql_fetch_array(mysql_query("SELECT t_jurusan.biaya FROM t_calon_mahasiswa
inner join t_jurusan on t_jurusan.KodeJrsn=t_calon_mahasiswa.n_pil1
where t_calon_mahasiswa.i_registrasi='$r[i_registrasi]'"));

		?>
	        <h2>Konfirmasi Pembayaran Her-Registrasi Mahasiswa Baru</h2>
		<? echo "
		  <form method=POST enctype='multipart/form-data' action='$aksi?module=herregistrasi&act=edit' onSubmit='return cek(this)'>"; ?>
	        <table>
	    	<tr>
	    	    <td>
	    		<table>
	    		    <h3>Data Pendaftaran</h3>
	    		    <tr><td>Nama</td><td> : <b><?= $r[n_lengkap] ?></td></b></tr>
	    		    <tr><td>No Pendaftaran</td><td> : <b><?= $r[i_registrasi] ?></b></td></tr>
                         <tr><td>NPM</td><td> : <b><?echo"$cekbayar[npm] / $cekbayar[NamaJrsn]"; ?></b></td></tr>
	    		    <tr><td>Email</td><td> : <?= $r[email] ?></td></tr>
	    		    <tr><td>No Telp</td><td> : <?= $r[no_tlp] ?></td></tr>
				<?php
				if ($r['pilihan'] == "1") {
				    echo "<tr><td>Pilihan</td><td> : POLTEKPOS</td></tr>";
				} elseif ($r['pilihan'] == "2") {
				    echo "<tr><td>Pilihan</td><td> : STIMLOG</td></tr>";
				} else {
				    echo "<tr><td>Pilihan</td><td> : -</td></tr>";
				}
				?>

				<?php
				if ($r['jalur_pendaftaran'] == "0") {
				    echo "<tr><td>Jalur</td><td> : PMDK</td></tr>";
				} elseif ($r['jalur_pendaftaran'] == "1") {
				    echo "<tr><td>Jalur</td><td> : REGULER</td></tr>";
				} else {
				    echo "<tr><td>Jalur</td><td> : -</td></tr>";
				}
				?>       				

	    		</table>

	    	    <td>
	    		<table>
	    		    <h3>Konfirmasi Pembayaran</h3>

	    		    <tr><td>Program Studi</td><td> :
<?
if (!$cekbayar['status_bayar'])
{
?>
	    			    <select id="pil1" name="pil1" style="width:167">
					    <?php
					    $qpil1 = mysql_query("
SELECT distinct a.KodeJrsn, a.NamaJrsn FROM t_jurusan a 
left join t_daftar on t_daftar.pilihan=a.jenjang 
where t_daftar.kode_briva='$r[i_registrasi]' ORDER BY a.Id ASC");
					    while ($rpil1 = mysql_fetch_array($qpil1)) {
						?>
						<option value="<?= $rpil1['KodeJrsn'] ?>" <?= ($rpil1['KodeJrsn'] == $r[n_pil1]) ? ' selected' : '' ?>><?= $rpil1['NamaJrsn'] ?></option>
						<?php
					    }
					    ?>
	    			    </select>

	    			    * <font color='red'>Dropdown jika ada yang pindah Program Studi</font></td></tr>
<? 
}
elseif ($cekbayar['status_bayar']=='belum')
{
?>
<select id="pil1" name="pil1" style="width:167" disabled='disabled'>
					    <?php
					    $qpil1 = mysql_query("
SELECT distinct a.KodeJrsn, a.NamaJrsn FROM t_jurusan a 
left join t_daftar on t_daftar.pilihan=a.jenjang 
where t_daftar.kode_briva='$r[i_registrasi]' ORDER BY a.Id ASC");
					    while ($rpil1 = mysql_fetch_array($qpil1)) {
						?>
						<option value="<?= $rpil1['KodeJrsn'] ?>" <?= ($rpil1['KodeJrsn'] == $r[n_pil1]) ? ' selected' : '' ?>><?= $rpil1['NamaJrsn'] ?></option>
						<?php
					    }
					    ?>
	    			    </select> </td></tr>
<?
}
?>

				<?
				if (!$cekbayar['status_bayar']) 
				{
				    echo "<tr><td>Setting Pembayaran *</td>     <td> : <input type=radio name='status' value='lunas' checked > Lunas  
                                           <input type=radio name='status' value='belum'> Belum Lunas</td></tr>";
				} 
				elseif ($cekbayar['status_bayar']=='belum') 
				{
				    echo "<tr><td>Setting Pembayaran *</td>     <td> : <input type=radio name='status' value='lunas' checked> Lunas  
                                          <input type=radio name='status' value='belum' disabled='disabled'> Belum Lunas</td></tr>";
				}
				?>
	    		    <tr><td>Jenis Bukti Pemabayaran * </td><td> : <input type=radio name='jenis' value='Giropos' checked> Giro Pos  
	    			    <input type=radio name='jenis' value='BNI'> BNI </td></tr>
	    		    <tr><td>Upload Bukti Pemabayaran * </td><td> : <input type='file' name='bukti_pembayaran'></td></tr>
<?
if (!$cekbayar['status_bayar'])
{
?>
<tr><td>Jumlah Bayar</td><td> : <input id='nominal' type='text' name='nominal' value='<?php echo"$cekbiaya[biaya]"; ?>' disabled='disabled'/> <input type='text' name='bayar'></td></tr>
<?
}
elseif ($cekbayar['status_bayar']=='belum')
{
?>
<tr><td>Jumlah Bayar</td><td> : <input value='<?php echo"$cekbayar[jumlah_bayar]"; ?>' disabled='disabled'/> Sisa Bayar <input type='text' name='bayar'></td></tr>
<?
}
?>
	    		    <tr><td>Tanggal Bayar</td><td> : <?php combotgl(1,31,'tgl_mulai',$get_tgl);
          combonamabln(1,12,'bln_mulai',$bln_sekarang);
          $get_thn=substr($thn_sekarang-0,0,4);
          combothn($thn_sekarang-0,$thn_sekarang,'thn_mulai',$get_thn); ?> </td></tr>




	    		</table>
	    	    </td>
	    	</tr>


	    	<tr>
	    	<tr>
	    	    <td colspan=2 align=center><input type="button" value="Kembali" onclick='self.history.back()' style="cursor:pointer">
	    		<input type="submit" value="Simpan">
	    		<input type="hidden" name="i_registrasi" value="<?= $r[i_registrasi] ?>">
                     <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
	    	    </td>					
	    	</tr>

	        </table>
	    </form>

	    <?php
	    // header('location:../../media.php?module='.$module);


	    break;

		case"kelengkapan":
		   
		$tampil = mysql_query("SELECT t_calon_mahasiswa.*,t_daftar.* from t_calon_mahasiswa
              inner join t_daftar on t_daftar.kode_briva=t_calon_mahasiswa.i_registrasi
					WHERE t_calon_mahasiswa.i_registrasi='$_GET[id]'");
		$r = mysql_fetch_array($tampil);
$cekbayar=mysql_fetch_array(mysql_query("SELECT t_herregistrasi.*, t_jurusan.NamaJrsn FROM t_herregistrasi 
inner join t_jurusan on t_jurusan.KodeJrsn =t_herregistrasi.id_jur where t_herregistrasi.i_registrasi='$_GET[id]'
union
SELECT t_herregistrasi_stimlog.*, t_jurusan.NamaJrsn FROM t_herregistrasi_stimlog 
inner join t_jurusan on t_jurusan.KodeJrsn =t_herregistrasi_stimlog.id_jur where
t_herregistrasi_stimlog.i_registrasi='$_GET[id]'"));

$tam=mysql_fetch_array(mysql_query("select t_herregistrasi.*, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn FROM t_herregistrasi 
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi.i_registrasi
WHERE t_herregistrasi.i_registrasi = '$_GET[id]'
union
select t_herregistrasi_stimlog.*, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn FROM t_herregistrasi_stimlog 
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi_stimlog.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi_stimlog.i_registrasi
WHERE t_herregistrasi_stimlog.i_registrasi = '$_GET[id]'"));

IF ($tam[ijazah] == NULL) {
 $ijazah = 'X';
}
ELSE{
 $ijazah = 'V';
}

IF ($tam['transkrip'] == NULL) {
 $transkrip = 'X';
}
ELSE{
 $transkrip = 'V';
}

IF ($tam['akte'] == NULL) {
 $akte = 'X';
}
ELSE{
 $akte = 'V';
}

IF ($tam['photo'] == NULL) {
 $photo = 'X';
}
ELSE{
 $photo = 'V';
}

IF ($tam['skck'] == NULL) {
 $skck = 'X';
}
ELSE{
 $skck = 'V';
}

IF ($tam['surat_pernyataan'] == NULL) {
 $surat_pernyataan = 'X';
}
ELSE{
 $surat_pernyataan = 'V';
}


		?>
	        <h2>Kelengkapan Berkas Her-Registrasi Mahasiswa Baru</h2>
		<? echo "
		  <form method=POST enctype='multipart/form-data' action='$aksi?module=herregistrasi&act=edit' onSubmit='return cek(this)'>"; ?>
	        <table>
	    	<tr>
	    	    <td>
	    		<table>
	    		    <h3>Data Pendaftaran</h3>
	    		    <tr><td>Nama</td><td> : <b><?= $r[n_lengkap] ?></td></b></tr>
	    		    <tr><td>No Pendaftaran</td><td> : <b><?= $r[i_registrasi] ?></b></td></tr>
                         <tr><td>NPM</td><td> : <b><?echo"$cekbayar[npm] / $cekbayar[NamaJrsn]"; ?></b></td></tr>
	    		    <tr><td>Email</td><td> : <?= $r[email] ?></td></tr>
	    		    <tr><td>No Telp</td><td> : <?= $r[no_tlp] ?></td></tr>
				<?php
				if ($r['pilihan'] == "1") {
				    echo "<tr><td>Pilihan</td><td> : POLTEKPOS</td></tr>";
				} elseif ($r['pilihan'] == "2") {
				    echo "<tr><td>Pilihan</td><td> : STIMLOG</td></tr>";
				} else {
				    echo "<tr><td>Pilihan</td><td> : -</td></tr>";
				}
				?>

				<?php
				if ($r['jalur_pendaftaran'] == "0") {
				    echo "<tr><td>Jalur</td><td> : PMDK</td></tr>";
				} elseif ($r['jalur_pendaftaran'] == "1") {
				    echo "<tr><td>Jalur</td><td> : REGULER</td></tr>";
				} else {
				    echo "<tr><td>Jalur</td><td> : -</td></tr>";
				}
				?>       				

	    		</table>

	    	    <td>
	    		<table>
	    		    <h3>Berkas Herregistrasi Mahasiswa Baru</h3>

<tr><td>Bukti Pembayaran Herregistrasi</td><td> : V - <?php echo "$tam[status_bayar]"; ?></td> 
<td><a href="bukti_herregistrasi/<?=$tam[file_bayar];?>" onClick="return GB_showCenter('Tentang Web', this.href)"><?=$tam[file_bayar];?></a></td>
<td><a href="bukti_herregistrasi2/<?=$tam[file_bayar1];?>" onClick="return GB_showCenter('Tentang Web', this.href)"><?=$tam[file_bayar1];?></a></td></tr>
<tr><td>Ijazah SMA/SMK Legalisir</td><td> : <?php echo $ijazah; ?></td> <td><a href="../peserta/ijazah/<?=$tam[ijazah];?>" onClick="return GB_showCenter('Tentang Web', this.href)"><?=$tam[ijazah];?></a></td><td>&nbsp</td></tr>
<tr><td>Nilai UN legalisir</td><td> : <?php echo $transkrip ; ?></td><td><a href="../peserta/nem/<?=$tam[transkrip ];?>" onClick="return GB_showCenter('Tentang Web', this.href)"><?=$tam[transkrip ];?></a></td><td>&nbsp</td></tr>
<tr><td>Akte Kelahiran</td><td> : <?php echo $akte ; ?></td><td><a href="../peserta/akte/<?=$tam[akte];?>" onClick="return GB_showCenter('Tentang Web', this.href)"><?=$tam[akte];?></a></td><td>&nbsp</td></tr>
<tr><td>Photo</td><td> : <?php echo $photo ; ?></td><td><a href="../peserta/photo/<?=$tam[photo];?>" onClick="return GB_showCenter('Tentang Web', this.href)"><?=$tam[photo];?></a></td><td>&nbsp</td></tr>
<tr><td>SKCK Kepolisian/Surat Kelakuan Baik dari Sekolah</td><td> : <?php echo $skck; ?></td><td><a href="../peserta/skck/<?=$tam[skck];?>" onClick="return GB_showCenter('Tentang Web', this.href)"><?=$tam[skck];?></a></td><td>&nbsp</td></tr>
<tr><td>Surat Pernyataan</td><td> : <?php echo $surat_pernyataan; ?></td><td><a href="../peserta/sp/<?=$tam[surat_pernyataan];?>" onClick="return GB_showCenter('Tentang Web', this.href)"><?=$tam[surat_pernyataan];?></a></td><td>&nbsp</td></tr>
<tr><td>Ukuran Jasket Almamater</td><td> : <?php echo "$tam[jasket]"; ?></td><td>&nbsp</td> <td>&nbsp</td></tr>
<tr><td>Ukuran Sepatu</td><td> : <?php echo "$tam[sepatu]"; ?></td><td>&nbsp</td> <td>&nbsp</td></tr>

	    	<tr>
	    	    <td colspan=4 align=center><input type="button" value="Kembali" onclick='self.history.back()' style="cursor:pointer"> &nbsp

             		<input type="hidden" name="i_registrasi" value="<?= $r[i_registrasi] ?>">
                     <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
	    	    </td>					
	    	</tr>

	        </table>
	    </form>
<form method='POST' action='modul/mod_cetak/kelengkapan_herreg.php' target='_blank'>
     
				
		  <div><input type=submit class='tombol' value="Cetak Kelengkapan Herregistrasi"> <input type="hidden" name="id" value="<?= $_GET['id'] ?>"></div>
          </form>
	    <?php
	    // header('location:../../media.php?module='.$module);


	    break;

case"detail":
$jur = mysql_fetch_array(mysql_query("select * from t_jurusan where t_jurusan.KodeJrsn = '$_GET[id]'"));
echo"<h2>Daftar Mahasiswa Program Studi $jur[NamaJrsn]</h2>";
		

$p = new Paging;
$batas = 10;
$posisi = $p->cariPosisi($batas);
$tampil_lap = mysql_query("select t_herregistrasi.*, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn FROM t_herregistrasi 
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi.i_registrasi
WHERE t_jurusan.KodeJrsn = '$_GET[id]'
union
select t_herregistrasi_stimlog.*, t_calon_mahasiswa.n_lengkap, t_jurusan.NamaJrsn FROM t_herregistrasi_stimlog
INNER JOIN t_jurusan ON t_jurusan.KodeJrsn = t_herregistrasi_stimlog.id_jur 
INNER JOIN t_calon_mahasiswa ON t_calon_mahasiswa.i_registrasi = t_herregistrasi_stimlog.i_registrasi
WHERE t_jurusan.KodeJrsn = '$_GET[id]'
");
$no = $posisi + 1;

echo"
<table>  
</th> 
<tr><th>No</th><th>No Pendaftaran</th>
<th>Nama</th>
<th>NPM</th>
<th>Program Studi</th>
</tr>";

while ($r_lap = mysql_fetch_array($tampil_lap))
{   
echo"
<tr>
<td>$no</td>
<td>$r_lap[i_registrasi]</td>
<td>$r_lap[n_lengkap] </td>
<td>$r_lap[npm] </td>
<td>$r_lap[NamaJrsn] </td>
</tr>";
$no++;
}

echo"</table>";

	    break;

    }
}
?>
</body>