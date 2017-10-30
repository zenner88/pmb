<script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Kartu Ujian</title>
<link href="css/kartu.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style3 {font-family: Arial, Helvetica, sans-serif}
.style4 {font-size: medium; font-weight: bold; }
.style5 {font-family: Arial, Helvetica, sans-serif; font-size: small; }
.style6 {color: #FFFFFF}
.style7 {
	font-size: x-large;
	font-weight: bold;
}
.style8 {font-size: medium}
.style9 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</head>

<body><center>
 <?php
 include "../../../config/koneksi.php";

  $sql_thnakademik="select * from t_tahun_akademik";
  $query_thnakademik=mysql_query($sql_thnakademik,$koneksi);
  $row_thnakademik=mysql_fetch_array($query_thnakademik);
  
echo $i_registrasi=isset($_POST['id']);
$pin = $_REQUEST['pin'];
// echo $pin;
  $sql_tampil="select t_calon_mahasiswa.*,t_gel.namagel as nama_gel,t_tempat_ujian.namatmp as temp_ujian,t_waktu_ujian.* from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel inner join t_tempat_ujian on t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.kodetmp,t_waktu_ujian  where t_calon_mahasiswa.i_registrasi='$pin' and t_waktu_ujian.kodegel = t_gel.kodegel";
  $query_tampil=mysql_query($sql_tampil,$koneksi);
  $row_tampil=mysql_fetch_array($query_tampil);
  
  	if ($row_tampil['23'] =='MI')
	{
		$pil1 = "Manajemen Informatika";
	}
	
	if($row_tampil['23'] =='TI')
	{
			$pil1 = "Teknik Informatika";
	}
	
	if($row_tampil['23'] =='AK')
	{
			$pil1 = "Akuntansi";
	}
	
	if($row_tampil['23'] =='PM')
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


<table width="844" height="434" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="834" height="428"><table width="834" height="422" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="824" height="97"><table width="834" height="91" border="0">
          <tr>
            <td width="137" height="85"><img  align="center" width="120" height="105px" src="../../images/Logo.Poltek.Bulat.Transp.png" /></td>
            <td width="463">
					<span class="style7"><B>PENERIMAAN MAHASISWA BARU POLTEKPOS & STIMLOG</B></span><br />
					Jl. Sariasih No.54 Bandung 40151 <br />
					Telp. (022) 2009562 Fax. (022) 2011089 <br />
					pmb.poltekpos.ac.id | 
					email : info@poltekpos.ac.id </span><br/>
			</td>
            <td width="220"><p class="style3" align="right">Nomor Ujian :</p>
              <table width="200" border="1" align="right">
                <tr>
                  <td height="37" class="style3">
                    <div align="center" class="style4"><?PHP echo"$row_tampil[0]"?></div></td>
                </tr>
              </table>              <p class="style3">&nbsp; </p></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="23" align="center">
			<table height="23" border="0">
				<tr>
					<td>
					  <div align="center" class="style4">KARTU TANDA PESERTA UJIAN </div>
					</td>
				</tr>
			</table>
			
		</td>
      </tr>
      <tr>
        <td height="292"><table width="824" height="279" border="0">
          <tr>
            <td width="199" height="273" align="center">
				<table width="151" height="195" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="147"><img  align="center" width="147" height="200px" src="../../foto/<?php echo $row_tampil['photo'];?>"/></td>
  </tr>
</table>

			</td>
            <td width="609"><table width="608" border="0">
              <tr>
                <td width="598" height="85"><table width="419" border="0">
                  <tr>
                    <td width="158"><span class="style3">Nama Lengkap </span></td>
                    <td width="9"><span class="style3">:</span></td>
                    <td width="230"><span class="style3"><?="$row_tampil[3]"?></span></td>
                  </tr>
                  <tr>
                    <td><span class="style3">Gelombang</span></td>
                    <td><span class="style3">:</span></td>
                    <td><span class="style3"><?="$row_tampil[c_gel]"?></span></td>
                  </tr>
                  <tr>
                    <td><span class="style3"></span></td>
                    <td><span class="style3"></span></td>
                    <td><span class="style3"></span></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="23"><span class="style3">Jadwal Ujian Masuk </span></td>
              </tr>
              <tr>
                <td height="151"><table width="565" height="135" border="1">
                  <tr>
                    <td width="102" align="center">
                      <div align="center" class="style9">Tanggal/Ujian</div>                    </td>
                    <td width="100"><div align="center" class="style9">Materi</div></td>
                    <td width="100"><div align="center" class="style9">Lokasi Ujian </div></td>
                    <td width="118"><div align="center" class="style9">Tanda Tangan </div></td>
                  </tr>
                  <tr>
                    <td  align="center" valign="middle">
                      <p class="style3">
					  <?PHP
					  $tgl = $row_tampil['Tgl_ujian'];
					  $y=substr($tgl,0,4);
					  $m=substr($tgl,5,2);
					  $d=substr($tgl,8,2);
					  echo "$d"."-"."$m"."-"."$y";
					  
					  ?> <br />
					  08.00 - 09.30
					  </p></td>
					  
                    <td><div align="center" class="style3">Matematika</div></td>
                    <td rowspan="2"><div align="center"><span class="style3"><?="$row_tampil[temp_ujian]"?></span></div></td>
                    <td><span class="style3"></span></td>
                  </tr>
                  <tr>
				  	<td>
					<center>
					<p class="style3">
					  <?PHP
					  $tgl = $row_tampil['Tgl_ujian'];
					  $y=substr($tgl,0,4);
					  $m=substr($tgl,5,2);
					  $d=substr($tgl,8,2);
					  echo "$d"."-"."$m"."-"."$y";
					  
					  ?> <br />
					  10.00 - 11.30
					  </p>
					  </center>
					</td>
                    <td><div align="center" class="style3">Bahasa Inggris </div></td>
                    <td><span class="style3"></span></td>
                  </tr>
                </table>
                  <p class="style5">Peserta harap hadir 30 menit sebelum ujian dimulai untuk pengisian data peserta ujian </p></td>
              </tr>
            </table></td>
          </tr>
        </table>
			<table width="841" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="840" bgcolor="#999999">		
          <p class="style5 style6">Cetaklah kartu ujian ini menggunakan printer berwarna , jika foto anda belum di upload atau tidak ada anda harus menempelkan foto<br />
dengan ukruan 3x4 di kotak yang telah disediakan.
		  Ketika Ujian, Anda perlu membawa kartu tanda peserta ujian, tanda bukti pembayaran PMB dan perlengkapan alat tulis. </p>          </td>
				</tr>
			</table>		  
		  </td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<form>
	<center><input id="printpagebutton" type="button" value="Print Kartu Ujian" onclick="printpage()"/></center>
</form>
</body>
</html>