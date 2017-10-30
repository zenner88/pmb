<?
session_start();
include '../../config/koneksi.php';
include '../../../config/fungsi_indotgl.php';
$sql=mysql_query("SELECT t_calon_mahasiswa.*,t_jurusan.NamaJrsn,t_settingpembayaran.*,t_registrasi.* 
FROM t_calon_mahasiswa INNER JOIN t_jurusan ON t_jurusan.KodeJrsn=t_calon_mahasiswa.diterima 
INNER JOIN t_registrasi ON t_registrasi.pin=t_calon_mahasiswa.i_registrasi
INNER JOIN t_settingpembayaran ON t_settingpembayaran.jenis_pembayaran=t_registrasi.pendidikan
WHERE i_registrasi= '$_GET[id]'");
$row=mysql_fetch_array($sql);

$sqlta=mysql_query("SELECT * FROM t_tahun_akademik WHERE status = 'on'");
$rowta=mysql_fetch_array($sqlta);

$sqlregis=mysql_query("SELECT * FROM t_registrasi.*, WHERE i_registrasi= '$_GET[id]'");
$rowregis=mysql_fetch_array($sqlta);
?>
<style type="text/css">
<!--
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; }
.style8 {font-size: x-small}
.style10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; }
.style12 {font-size: 24px}
-->
</style>
<table width="827" bordercolorlight="#FF9933" cellpadding="-1" cellspacing="-1" bordercolor="#FF9933" border="0">
  <tr>
    <td colspan="1" align="center" valign="top"><div align="center" class="style7"><img src="../../images/pos.png"width="80" height="75"></div></td>
	<td colspan="4"><div align="center" class="style7"><strong><span class="style12">KWITANSI</span><br>
	  PANITIA PENERIMAAN MAHASISWA BARU TA <?=$rowta[n_akademik] ?>
	  </strong><br>
    Sekretariat: Jl. Sariasih No. 54 Bandung 40151, Telp. (022) 2009562, Fax. (022)2011089</div></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><span class="style7"></span><span class="style7"></span><span class="style7">&nbsp;</span></td>
  </tr>
  <tr>
    <td width="155"><span class="style7">Telah Terima dari </span></td>
    <td width="14"><span class="style7">:</span></td>
    <td width="249"><span class="style7">Nomor PIN </span></td>
    <td width="13"><span class="style7">:</span></td>
    <td width="396"><span class="style7"><?=$row[i_registrasi]?></span></td>
  </tr>
  <tr>
    <td><span class="style8"></span></td>
    <td><span class="style8"></span></td>
    <td><span class="style7">Nama</span></td>
    <td><span class="style7">:</span></td>
    <td><span class="style7"><?=$row[n_lengkap]?></span></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style8"></span></td>
    <td><span class="style8"></span></td>
    <td><span class="style7">Jurusan</span></td>
    <td><span class="style7">:</span></td>
    <td><span class="style7"><?=$row[NamaJrsn]?></span></td>
  </tr>
  <tr>
    <td><span class="style7">Perincian Pembayaran </span></td>
    <td><span class="style7">:</span></td>
    <td><span class="style7">Biaya Pengembangan Pendidikan </span></td>
    <td><span class="style7">:</span></td>
    <td><span class="style7">Rp. <?=number_format($row[besar_pembayaran],0,",",".")?></span></td>
  </tr>
  <tr>
    <td><span class="style8"></span></td>
    <td><span class="style8"></span></td>
    <td><span class="style7">Biaya Matrikulasi Alih Jenjang </span></td>
    <td><span class="style7">:</span></td>
    <td><span class="style7">Rp. <?=number_format($row[matrikulasi],0,",",".")?></span></td>
  </tr>
  <tr>
    <td><span class="style8"></span></td>
    <td><span class="style8"></span></td>
    <td><span class="style7">Biaya Semester 1 Alih Jenjang </span></td>
    <td><span class="style7">:</span></td>
    <td><span class="style7">Rp. <?=number_format($row[semester1],0,",",".")?></span></td>
  </tr>
  <tr>
    <td><span class="style8"></span></td>
    <td><span class="style8"></span></td>
    <td><span class="style7">Sumbangan Sukarela </span></td>
    <td><span class="style7">:</span></td>
    <td><span class="style7">Rp. <?=number_format($row[sumbangan],0,",",".")?></span></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style7">Uang Sejumlah </span></td>
    <td><span class="style7">:</span></td>
    <td colspan="3"><span class="style7"></span><span class="style7"></span><span class="style7">
	<?
	$angka = isset($row[terbilang]) ? $row[terbilang] : "0";
	if ($angka)
	{
		echo"<i>=============== ";
        echo ucwords(Terbilang($angka));
		echo ucwords(Rupiah);
		echo" ===============</i>";
	}
	
function Terbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}
?>
</span></td>
  </tr>
   <tr>
    <td><span class="style7">Sisa Pembayaran </span></td>
    <td><span class="style7">:</span></td>
    <td colspan="3"><span class="style7">Rp. <?=number_format($row[sisa_bayar],0,",",".")?>
	<?
	$sisa = isset($row[sisa_bayar]) ? $row[sisa_bayar] : "0";
	if ($sisa)
	{
		echo"( <i>";
        echo ucwords(bilang($sisa));
		echo ucwords(Rupiah);
		echo" </i> )";
	}
	
function bilang($y)
{
  $bil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($y < 12)
    return " " . $bil[$y];
  elseif ($y < 20)
    return bilang($y - 10) . "belas";
  elseif ($y < 100)
    return bilang($y / 10) . " puluh" . bilang($y % 10);
  elseif ($y < 200)
    return " seratus" . bilang($y - 100);
  elseif ($y < 1000)
    return bilang($y / 100) . " ratus" . bilang($y % 100);
  elseif ($y < 2000)
    return " seribu" . bilang($y - 1000);
  elseif ($y < 1000000)
    return bilang($y / 1000) . " ribu" . bilang($y % 1000);
  elseif ($y < 1000000000)
    return bilang($y / 1000000) . " juta" . bilang($y % 1000000);
}
?>
</span></td>
  </tr>
   <tr>
    <td><span class="style7">Untuk Pembayaran </span></td>
    <td><span class="style7">:</span></td>
    <td colspan="3"><span class="style10">Her Registrasi PMB Politeknik Pos Indonesia Tahun Ajaran <?=$rowta[n_akademik] ?></span></td>
  </tr>
   <tr>
    <td colspan="5"><span class="style8">&nbsp;</span></td>
  </tr>
   
   <tr>
    <td colspan="3"><p class="style12"><hr align="left" width="200" size="3">
    <b>Rp. <?=number_format($row[terbilang],0,",",".")?></b><br><hr align="left" width="200" size="3">
    </p>     </td>
    <td colspan="2"><span class="style7">Bandung,
	<? $tanggal=date('Y-m-d')?>
	<? $tgl_sekarang = tgl_indo($tanggal); 
	echo $tgl_sekarang;?>
     </span>
     <p class="style7">&nbsp;</p>
     <p class="style7">&nbsp;</p>
     <p class="style7" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<? echo $_SESSION['username'];?>)</p></td>
  </tr>
</table>
<br />
<br />
NB : 
<li>Bagian atas untuk : Calon Mahasiswa</li>
<li>Harap disimpan sebagai tanda bukti pembayaran</li>
<li>Valid jika ada tanda tanggan petugas dan cap instansi</li>

<br /><br />
<hr>
<br /><br />
<table width="827" bordercolorlight="#FF9933" cellpadding="-1" cellspacing="-1" bordercolor="#FF9933" border="0">
  <tr>
    <td colspan="1" align="center" valign="top"><div align="center" class="style7"><img src="../../images/pos.png"width="80" height="75"></div></td>
	<td colspan="4"><div align="center" class="style7"><strong><span class="style12">KWITANSI</span><br>
	  PANITIA PENERIMAAN MAHASISWA BARU TA <?=$rowta[n_akademik] ?>
	  </strong><br>
    Sekretariat: Jl. Sariasih No. 54 Bandung 40151, Telp. (022) 2009562, Fax. (022)2011089</div></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><span class="style7"></span><span class="style7"></span><span class="style7">&nbsp;</span></td>
  </tr>
  <tr>
    <td width="155"><span class="style7">Telah Terima dari </span></td>
    <td width="14"><span class="style7">:</span></td>
    <td width="249"><span class="style7">Nomor PIN </span></td>
    <td width="13"><span class="style7">:</span></td>
    <td width="396"><span class="style7"><?=$row[i_registrasi]?></span></td>
  </tr>
  <tr>
    <td><span class="style8"></span></td>
    <td><span class="style8"></span></td>
    <td><span class="style7">Nama</span></td>
    <td><span class="style7">:</span></td>
    <td><span class="style7"><?=$row[n_lengkap]?></span></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style8"></span></td>
    <td><span class="style8"></span></td>
    <td><span class="style7">Jurusan</span></td>
    <td><span class="style7">:</span></td>
    <td><span class="style7"><?=$row[NamaJrsn]?></span></td>
  </tr>
  <tr>
    <td><span class="style7">Perincian Pembayaran </span></td>
    <td><span class="style7">:</span></td>
    <td><span class="style7">Biaya Pengembangan Pendidikan </span></td>
    <td><span class="style7">:</span></td>
    <td><span class="style7">Rp. <?=number_format($row[besar_pembayaran],0,",",".")?></span></td>
  </tr>
  <tr>
    <td><span class="style8"></span></td>
    <td><span class="style8"></span></td>
    <td><span class="style7">Biaya Matrikulasi Alih Jenjang </span></td>
    <td><span class="style7">:</span></td>
    <td><span class="style7">Rp. <?=number_format($row[matrikulasi],0,",",".")?></span></td>
  </tr>
  <tr>
    <td><span class="style8"></span></td>
    <td><span class="style8"></span></td>
    <td><span class="style7">Biaya Semester 1 Alih Jenjang </span></td>
    <td><span class="style7">:</span></td>
    <td><span class="style7">Rp. <?=number_format($row[semester1],0,",",".")?></span></td>
  </tr>
  <tr>
    <td><span class="style8"></span></td>
    <td><span class="style8"></span></td>
    <td><span class="style7">Sumbangan Sukarela </span></td>
    <td><span class="style7">:</span></td>
    <td><span class="style7">Rp. <?=number_format($row[sumbangan],0,",",".")?></span></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style7">Uang Sejumlah </span></td>
    <td><span class="style7">:</span></td>
    <td colspan="3"><span class="style7"></span><span class="style7"></span><span class="style7">
	<?
	$uang = isset($row[terbilang]) ? $row[terbilang] : "0";
	if ($uang)
	{
		echo"<i>=============== ";
        echo ucwords(cetak($uang));
		echo ucwords(Rupiah);
		echo" ===============</i>";
	}
	
function cetak($m)
{
  $abil1 = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($m < 12)
    return " " . $abil1[$m];
  elseif ($m < 20)
    return cetak($m - 10) . "belas";
  elseif ($m < 100)
    return cetak($m / 10) . " puluh" . cetak($m % 10);
  elseif ($m < 200)
    return " seratus" . cetak($m - 100);
  elseif ($m < 1000)
    return cetak($m / 100) . " ratus" . cetak($m % 100);
  elseif ($m < 2000)
    return " seribu" . cetak($m - 1000);
  elseif ($m < 1000000)
    return cetak($m / 1000) . " ribu" . cetak($m % 1000);
  elseif ($m < 1000000000)
    return cetak($m / 1000000) . " juta" . cetak($m % 1000000);
}
?>
</span></td>
  </tr>
   <tr>
    <td><span class="style7">Sisa Pembayaran </span></td>
    <td><span class="style7">:</span></td>
    <td colspan="3"><span class="style7">Rp. <?=number_format($row[sisa_bayar],0,",",".")?>
	<?
	$sisa2 = isset($row[sisa_bayar]) ? $row[sisa_bayar] : "0";
	if ($sisa2)
	{
		echo"( <i>";
        echo ucwords(bilang2($sisa2));
		echo ucwords(Rupiah);
		echo" </i> )";
	}
	
function bilang2($n)
{
  $bil2 = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($n < 12)
    return " " . $bil2[$n];
  elseif ($n < 20)
    return bilang2($n - 10) . "belas";
  elseif ($n < 100)
    return bilang2($n / 10) . " puluh" . bilang2($n % 10);
  elseif ($n < 200)
    return " seratus" . bilang2($n - 100);
  elseif ($n < 1000)
    return bilang2($n / 100) . " ratus" . bilang2($n % 100);
  elseif ($n < 2000)
    return " seribu" . bilang2($n - 1000);
  elseif ($n < 1000000)
    return bilang2($n / 1000) . " ribu" . bilang2($n % 1000);
  elseif ($n < 1000000000)
    return bilang2($n / 1000000) . " juta" . bilang2($n % 1000000);
}
?>
</span></td>
  </tr>
   <tr>
    <td><span class="style7">Untuk Pembayaran </span></td>
    <td><span class="style7">:</span></td>
    <td colspan="3"><span class="style10">Her Registrasi PMB Politeknik Pos Indonesia Tahun Ajaran <?=$rowta[n_akademik] ?></span></td>
  </tr>
   <tr>
    <td colspan="5"><span class="style8">&nbsp;</span></td>
  </tr>
   
   <tr>
    <td colspan="3"><p class="style12"><hr align="left" width="200" size="3">
    <b>Rp. <?=number_format($row[terbilang],0,",",".")?></b><br><hr align="left" width="200" size="3">
    </p>     </td>
    <td colspan="2"><span class="style7">Bandung, <? $tanggal=date('Y-m-d')?>
	<? $tgl_sekarang = tgl_indo($tanggal); 
	echo $tgl_sekarang;?>
     </span>
     <p class="style7">&nbsp;</p>
     <p class="style7">&nbsp;</p>
     <p class="style7" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<? echo $_SESSION['username'];?>)</p></td>
  </tr>
</table>
<br />
<br />
NB : 
<li>Bagian bawah untuk : Politeknik Pos Indonesia</li>
<li>Valid jika ada tanda tanggan petugas dan cap instansi</li>
