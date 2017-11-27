<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Biodata</title>
<link href="css/kartu.css" rel="stylesheet" type="text/css" />
</head>

<body><center>
 <?php
 include "../../../config/koneksi.php";
include "../../config/antisqlinjection.php";

  $sql_thnakademik="select * from t_tahun_akademik";
  $query_thnakademik=mysql_query($sql_thnakademik);
  $row_thnakademik=mysql_fetch_array($query_thnakademik);
  
echo $i_registrasi=$_GET['pin'];

  $sql_tampil="select t_calon_mahasiswa.*,t_gel.namagel as nama_gel,t_tempat_ujian.namatmp as temp_ujian,t_waktu_ujian.* from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel inner join t_tempat_ujian on t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.kodetmp,t_waktu_ujian  where t_calon_mahasiswa.i_registrasi='$_GET[kode_biva]' and t_waktu_ujian.kodegel = t_gel.kodegel";
  $query_tampil=mysql_query($sql_tampil);
  $row_tampil=mysql_fetch_array($query_tampil);
  
  	if ($row_tampil[23] =='MI')
	{
		$pil1 = "Manajemen Informatika";
	}
	
	if($row_tampil[23] =='TI')
	{
			$pil1 = "Teknik Informatika";
	}
	
	if($row_tampil[23] =='AK')
	{
			$pil1 = "Akuntansi";
	}
	
	if($row_tampil[23] =='PM')
	{
			$pil1 = "Pemasaran";
	}
	
	if($row_tampil[23] =='LB')
	{
			$pil1 = "Logistik Bisnis";
	}
	
	if($row_tampil[23] =='MF')
	{
			$pil1 = "Micro Finance";
	}
	
	if($row_tampil[23] =='D4')
	{
			$pil1 = "Logistik Bisnis D4";
	}
	
	
	
	if ($row_tampil[24] =='MI')
	{
		$pil2 = "Manajemen Informatika";
	}
	
	if($row_tampil[24] =='TI')
	{
			$pil2 = "Teknik Informatika";
	}
	
	if($row_tampil[24] =='AK')
	{
			$pil2 = "Akuntansi";
	}
	
	if($row_tampil[24] =='PM')
	{
			$pil2 = "Pemasaran";
	}
	
	if($row_tampil[24] =='LB')
	{
			$pil2 = "Logistik Bisnis";
	}
	
	if($row_tampil[24] =='MF')
	{
			$pil2 = "Micro Finance";
	}
	
	if($row_tampil[24] =='D4')
	{
			$pil2 = "Logistik Bisnis D4";
	}
	
	
	
	if ($row_tampil[25] =='MI')
	{
		$pil3 = "Manajemen Informatika";
	}
	
	if($row_tampil[25] =='TI')
	{
			$pil3 = "Teknik Informatika";
	}
	
	if($row_tampil[25] =='AK')
	{
			$pil3 = "Akuntansi";
	}
	
	if($row_tampil[25] =='PM')
	{
			$pil3 = "Pemasaran";
	}
	
	if($row_tampil[25] =='LB')
	{
			$pil3 = "Logistik Bisnis";
	}
	
	if($row_tampil[25] =='MF')
	{
			$pil3 = "Micro Finance";
	}
	
	if($row_tampil[25] =='D4')
	{
			$pil3 = "Logistik Bisnis D4";
	}

?>
<table width="959" border="1">
  <tr>
    <td colspan="4"><img src="../../images/header.gif" width="950" height="230" /></td>
  </tr>
  <tr>
    <td colspan="4" align="center">BIODATA PENERIMAAN MAHASISWA BARU JALUR
      REGULER TAHUN AKADEMIK
    <? echo"$row_thnakademik[1]" ?></h3>    </td>
  </tr>
  <tr>
    <td colspan="4" align="right"><b>NOMOR PIN: &nbsp;<? echo"$row_tampil[0]"?></b></td>
  </tr>
  <tr>
    <td colspan="4"><b>DATA CALON MAHASISWA</b> </td>
  </tr>
  <tr>
    <td width="218">Nama Lengkap </td>
    <td colspan="3"><? echo"$row_tampil[3]"?>&nbsp;</td>
  </tr>
  <tr>
    <td>Jenis Kelamin </td>
    <td colspan="3"><? echo"$row_tampil[4]"?>&nbsp;</td>
  </tr>
  <tr>
    <td>Tempat dan Tanggal Lahir </td>
    <td colspan="3"><? echo"$row_tampil[5]"?> , <? echo"$row_tampil[6]"?>&nbsp;</td>
  </tr>
  <tr>
    <td>Agama</td>
    <td colspan="3"><? echo"$row_tampil[5]"?> , <? echo"$row_tampil[6]"?>&nbsp;</td>
  </tr>
  <tr>
    <td>Alamat yang dapat dihubungi </td>
    <td colspan="3"><? echo"$row_tampil[7]"?>&nbsp;</td>
  </tr>
  <tr>
    <td align="righ">Kabupaten / Kota</td>
    <td colspan="3"><? echo"$row_tampil[8]"?>&nbsp;</td>
  </tr>
  <tr>
    <td align="righ">Propinsi</td>
    <td colspan="3"><? echo"$row_tampil[9]"?>&nbsp;</td>
  </tr>
  <tr>
    <td align="righ">Kode Pos</td>
    <td colspan="3"><? echo"$row_tampil[11]"?>&nbsp;</td>
  </tr>
  <tr>
    <td>Nomor Telepon / HP </td>
    <td colspan="3"><? echo"$row_tampil[12]"?> / <? echo"$row_tampil[13]"?>&nbsp;</td>
  </tr>
  <tr>
    <td>Nama SMA/MA/SMK </td>
    <td colspan="3"><? echo"$row_tampil[18]"?>&nbsp;</td>
  </tr>
  <tr>
    <td>Jurusan SMA/MA/SMK</td>
    <td colspan="3"><? echo"$row_tampil[19]"?>&nbsp;</td>
  </tr>
  <tr>
    <td>Alamat SMA/MA/SMK</td>
    <td colspan="3"><? echo"$row_tampil[20]"?>&nbsp;</td>
  </tr>
  <tr>
    <td align="righ">Kabupaten / Kota </td>
    <td colspan="3"><? echo"$row_tampil[21]"?>&nbsp;</td>
  </tr>
  <tr>
    <td align="righ">Propinsi</td>
    <td colspan="3"><? echo"$row_tampil[22]"?>&nbsp;</td>
  </tr>

  <tr>
    <td>E-mail</td>
    <td colspan="3"><? echo"$row_tampil[14]"?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><b>DATA ORANG TUA</b> </td>
  </tr>
  <tr>
    <td>Nama Orang Tua </td>
    <td colspan="3"><? echo"$row_tampil[15]"?>&nbsp;</td>
  </tr>
  <tr>
    <td>Tempat Pekerjaan Orang Tua </td>
    <td colspan="3"><? echo"$row_tampil[16]"?>&nbsp;</td>
  </tr>
  <tr>
    <td>Jenis Pekerjaan Orang Tua </td>
    <td colspan="3"><? echo"$row_tampil[17]"?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
   
  <tr>
    <td colspan="4"><b>DATA  PROGRAM STUDI</b> </td>
  </tr>
  <tr>
    <td >Pilihan 1 </td>
    <td colspan="3"><? echo"$pil1"?>&nbsp;</td>
  </tr>
  <tr>
    <td>Pilihan 2 </td>
    <td colspan="3"><? echo"$pil2"?>&nbsp;</td>
  </tr>
  <tr>
    <td>Pilihan 3 </td>
    <td colspan="3"><? echo"$pil3"?>&nbsp;</td>
  </tr>
<tr>
    <td colspan="4">&nbsp;</td>
  </tr>
<tr>
    <td colspan="4"><b>DATA LOKASI UJIAN </b></td>
  </tr>
  <tr>
    <td>Tanggal Ujian </td>
    <td colspan="3">
	<?
		
					  $tgl = $row_tampil[Tgl_ujian];
					  $y=substr($tgl,0,4);
					  $m=substr($tgl,5,2);
					  $d=substr($tgl,8,2);
					  echo "$d"."-"."$m"."-"."$y";
					  
					 
	?>
	</td>
  </tr>
  <tr>
    <td>Lokasi Ujian </td>
    <td colspan="3"><? echo"$row_tampil[temp_ujian]"?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><b>DATA TAHU INFORMASI </b></td>
  </tr>
   <tr>
    <td>Tahu Poltekpos Dari </td>
    <td colspan="3"><? echo"$row_tampil[27]"?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr align="center">
    <td>Mengetahui Orang Tua / Wali </td>
    <td width="165">Calon Mahasiswa </td>
    <td width="138">Pas Photo </td>
    <td width="412">Mengetahui Panitia PMB </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td rowspan="2" align="center">3 X 4 </td>
    <td><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
  
  <tr align="center">
    <td>(<? echo"$row_tampil[15]"?>)</td>
    <td>(<? echo"$row_tampil[3]"?>)</td>
    <td>(............................................................)</td>
  </tr>
   <tr>
    <td colspan="4"><form>
	<center><input type=button value='Cetak Kartu Ujian' onClick='print()'></center>
	</form> </td>
  </tr>
</table>

</body>
</html>