<?php
session_start();
include "../config/koneksi.php";
include "config/recaptchalib.php";
 if (empty($_SESSION['pin']) AND empty($_SESSION['kodeaktivasi'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{  
echo "<h2>Konfirmasi Pembayaran</h2>";    
    $sqlCek = mysql_query("select * from t_registrasi where pin='$_SESSION[pin]'"); 
	if(mysql_num_rows($sqlCek)==0){
?> 
				  <form name="test" action="modul/mod_konfirmpay/aksi_konfirmpay.php" method="POST" enctype="multipart/form-data" id="test" onsubmit="confirmSubmit();">
                  <font face="ARIAL" size="2" color="#666666">
                      <table width="550" cellpadding="4">
                        <!-- GELOMBANG -->
                        <tbody>
                          <tr> 
                            <td colspan="2" bgcolor="#6ABF28" height="2"></td>
                          </tr>
                          <tr> 
                            <td colspan="2" bgcolor="#A4D87C"><span class="style1"> 
                              <b>Konfirmasi Pembayaran</b><br>
                              Fasilitas Konfirmasi Pembayaran ini hanya digunakan 
                              apabila Saudara/i telah melakukan registrasi online 
                              sebagai peserta PMB Poltekpos 
                              <?  echo"$row_thnakademik[1]";?>
                              , dan telah melakukan pembayaran sesuai biaya seleksi 
                              yang dibebankan. <br>
                              Isilah formulir berikut ini dengan data yang lengkap 
                              dan benar. </span></td>
                          </tr>
                          <tr> 
                            <td width="138" bgcolor="#dddddd"> <font color="#000000" size="2">Nomor <font face="ARIAL">PIN</font></font> 
                              *<br> 
                            <br> <br> </td>
                            <td width="388" bgcolor="#eeeeee"> <input name="i_registrasi" type="TEXT" class="required" value="<?= $_SESSION['pin']; ?>" size="25" maxlength="25" readonly> 
                              <br>
                              . </td>
                          </tr>
                          <tr> 
                            <td width="138" bgcolor="#dddddd"> <font size="2">Tanggal Transfer</font>                              *</td>
                            <td bgcolor="#eeeeee"> <input type="text" readonly  name="d_transfer" class="required">
                              <input type="button" value="Cal" onclick="displayCalendar(document.forms[0].d_transfer,'dd / mm / yyyy',this)" >                            </td>
                          </tr>
						  <?php
						  $sql=mysql_query("select t_calon_mahasiswa.*,t_prop.nama_prop,t_kab.nama_kab,t_jurusan.NamaJrsn
  from t_calon_mahasiswa
  inner join t_prop on t_prop.kd_prop=t_calon_mahasiswa.n_propinsi
  inner join t_jurusan on t_jurusan.KodeJrsn=t_calon_mahasiswa.diterima
  inner join t_kab on t_kab.kd_kab=t_calon_mahasiswa.n_kabupaten where t_calon_mahasiswa.i_registrasi='$_SESSION[pin]' ");
  $row=mysql_fetch_array($sql);
  
  $sqld32=mysql_query("SELECT t_jenispembayaran.jenis_pembayaran, t_settingpembayaran.* FROM t_settingpembayaran INNER JOIN t_jenispembayaran ON t_jenispembayaran.kode = t_settingpembayaran.jenis_pembayaran WHERE kd_jenjang = '4'");
  $rowd32=mysql_fetch_array($sqld32);
  $besar_format2     = number_format($rowd32[besar_pembayaran],0,",",".");
  
  $sumbangan     = number_format($row[q_sdp2],0,",",".");

if(($row['diterima'] == 'TI') || ($row['diterima'] == 'MI') || ($row['diterima'] == 'AK') || ($row['diterima'] == 'PM') || ($row['diterima'] == 'LB') || ($row['diterima'] == 'MF'))
{
  //Jika D3
  $sqld31=mysql_query("SELECT t_jenispembayaran.jenis_pembayaran, t_settingpembayaran.* FROM t_settingpembayaran INNER JOIN t_jenispembayaran ON t_jenispembayaran.kode = t_settingpembayaran.jenis_pembayaran WHERE kd_jenjang = '1'");
  $rowd31=mysql_fetch_array($sqld31);
  
  $sqld3=mysql_query("SELECT besar_pembayaran FROM t_settingpembayaran WHERE kd_jenjang = '1'");
  $rowd3=mysql_fetch_array($sqld3);
  $besar_format1     = number_format($rowd31[besar_pembayaran],0,",",".");
  $total = ($rowd3[besar_pembayaran])+($row[q_sdp2]);
  
}elseif(($row['diterima'] == 'TI4') || ($row['diterima'] == 'MI4') || ($row['diterima'] == 'AK4') || ($row['diterima'] == 'PM4') || ($row['diterima'] == 'LB4')){
  
  //Jika D4
  $sqld41=mysql_query("SELECT t_jenispembayaran.jenis_pembayaran, t_settingpembayaran.* FROM t_settingpembayaran INNER JOIN t_jenispembayaran ON t_jenispembayaran.kode = t_settingpembayaran.jenis_pembayaran WHERE kd_jenjang = '2'");
  $rowd41=mysql_fetch_array($sqld41);
  $besar_format41     = number_format($rowd41[besar_pembayaran],0,",",".");
  $sqld4=mysql_query("SELECT besar_pembayaran FROM t_settingpembayaran WHERE kd_jenjang = '2'");
  $rowd4=mysql_fetch_array($sqld4);
  $total = ($rowd4[besar_pembayaran])+($row[q_sdp2]);
  
}elseif(($row['diterima'] == 'TI4A') || ($row['diterima'] == 'MI4A') || ($row['diterima'] == 'AK4A') || ($row['diterima'] == 'PM4A') || ($row['diterima'] == 'LB4A')){
  
  //Jika D4 Alih Jenjang
  
  //Untuk Biaya Matrikulasi
  $sqld4A=mysql_query("SELECT * FROM t_settingpembayaran WHERE jenis_pembayaran = '5'");
  $rowd4A=mysql_fetch_array($sqld4A);
  $sqld4A2=mysql_query("SELECT * FROM t_jenispembayaran WHERE kode = '5'");
  $rowd4A2=mysql_fetch_array($sqld4A2);
  $matrikulasi = number_format($rowd4A[besar_pembayaran],0,",",".");
  
  //Untuk Biaya Semester 1
  $sqld4B=mysql_query("SELECT * FROM t_settingpembayaran WHERE jenis_pembayaran = '4'");
  $rowd4B=mysql_fetch_array($sqld4B);
  $sqld4B2=mysql_query("SELECT * FROM t_jenispembayaran WHERE kode = '4'");
  $rowd4B2=mysql_fetch_array($sqld4B2);
  $semester = number_format($rowd4B[besar_pembayaran],0,",",".");
  
  $total = ($rowd4A[besar_pembayaran])+($rowd4B[besar_pembayaran]);
  
}
  echo "<input type='hidden' name='formulir' value=$rowd32[jenis_pembayaran]>";
if(($row['diterima'] == 'TI') || ($row['diterima'] == 'MI') || ($row['diterima'] == 'AK') || ($row['diterima'] == 'PM') || ($row['diterima'] == 'LB') || ($row['diterima'] == 'MF'))
{

	echo "<input type='hidden' name='pendidikan' value=$rowd31[jenis_pembayaran]>";
	
}
elseif(($row['diterima'] == 'TI4') || ($row['diterima'] == 'MI4') || ($row['diterima'] == 'AK4') || ($row['diterima'] == 'PM4') || ($row['diterima'] == 'LB4'))
{

	echo "<input type='hidden' name='pendidikan' value=$rowd41[jenis_pembayaran]>";
	
}
elseif(($row['diterima'] == 'TI4A') || ($row['diterima'] == 'MI4A') || ($row['diterima'] == 'AK4A') || ($row['diterima'] == 'PM4A') || ($row['diterima'] == 'LB4A'))
{
  
  //Jika D4 Alih Jenjang
  echo "<input type='hidden' name='matrikulasi' value=$rowd4A[jenis_pembayaran]>";
  echo "<input type='hidden' name='semester1' value=$rowd4B[jenis_pembayaran]>";
  
  
}
	echo "<input type='hidden' name='sumbangan' id='sumbangan' value=$row[q_sdp2]>
		  <input type='hidden' name='total_bayar' id='total_bayar' value='$total'>";
 $total_format     = number_format($total,0,",",".");

	echo "  <tr><td>Yang Harus Di Bayar</td>"; 
            if($row['diterima'] == 'TI') {
				    
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- Biaya $rowd31[0]	=	Rp.$besar_format1<br>
			- Sumbangan Sukarela	=	Rp.$sumbangan<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>			
			           </td>";
			}
			if($row['diterima'] == 'MI') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- Biaya $rowd31[0]	=	Rp.$besar_format1<br>
			- Sumbangan Sukarela	=	Rp.$sumbangan<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>			
			           </td>";
			}
			if($row['diterima'] == 'AK') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- Biaya $rowd31[0]	=	Rp.$besar_format1<br>
			- Sumbangan Sukarela	=	Rp.$sumbangan<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br></td>";
			}
			if($row['diterima'] == 'PM') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- Biaya $rowd31[0]	=	Rp.$besar_format1<br>
			- Sumbangan Sukarela	=	Rp.$sumbangan<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>			
			           </td>";
			}
			if($row['diterima'] == 'LB') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- Biaya $rowd31[0]	=	Rp.$besar_format1<br>
			- Sumbangan Sukarela	=	Rp.$sumbangan<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>			
			           </td>";
			}
			if($row['diterima'] == 'MF') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- Biaya $rowd31[0]	=	Rp.$besar_format1<br>
			- Sumbangan Sukarela	=	Rp.$sumbangan<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>			
			           </td>";
			}
			if($row['diterima'] == 'TI4') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- Biaya $rowd41[0]	=	Rp.$besar_format41<br>
			- Sumbangan Sukarela	=	Rp.$sumbangan<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>	
			";
			}
			if($row['diterima'] == 'MI4') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- Biaya $rowd41[0]	=	Rp.$besar_format41<br>
			- Sumbangan Sukarela	=	Rp.$sumbangan<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>	
			";
			}
			if($row['diterima'] == 'AK4') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- Biaya $rowd41[0]	=	Rp.$besar_format41<br>
			- Sumbangan Sukarela	=	Rp.$sumbangan<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>	
			";
			}
			if($row['diterima'] == 'PM4') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- Biaya $rowd41[0]	=	Rp.$besar_format41<br>
			- Sumbangan Sukarela	=	Rp.$sumbangan<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>	
			";
			}
			if($row['diterima'] == 'LB4') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- Biaya $rowd41[0]	=	Rp.$besar_format41<br>
			- Sumbangan Sukarela	=	Rp.$sumbangan<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>	
			";
			}
			if($row['diterima'] == 'TI4A') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- $rowd4A2[jenis_pembayaran]	=	Rp.$matrikulasi<br>
			- $rowd4B2[jenis_pembayaran]	=	Rp.$semester<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>	
			";
			}
			if($row['diterima'] == 'MI4A') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- $rowd4A2[jenis_pembayaran]	=	Rp.$matrikulasi<br>
			- $rowd4B2[jenis_pembayaran]	=	Rp.$semester<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>	
			";
			}
			if($row['diterima'] == 'AK4A') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- $rowd4A2[jenis_pembayaran]	=	Rp.$matrikulasi<br>
			- $rowd4B2[jenis_pembayaran]	=	Rp.$semester<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>	
			";
			}
			if($row['diterima'] == 'PM4A') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- $rowd4A2[jenis_pembayaran]	=	Rp.$matrikulasi<br>
			- $rowd4B2[jenis_pembayaran]	=	Rp.$semester<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>	
			";
			}
			if($row['diterima'] == 'LB4A') {
			echo "<td>
			- <font color='red'>Biaya $rowd32[0]	=	Rp.$besar_format2 (Sudah Dibayar)</font><br>
			- $rowd4A2[jenis_pembayaran]	=	Rp.$matrikulasi<br>
			- $rowd4B2[jenis_pembayaran]	=	Rp.$semester<br>
			<hr>
			- Total Bayar	=	Rp.$total_format<br>	
			";
			}
    echo "</tr>";?>
                          <tr> 
                            <?php
  $sql_jnspembayaran="select * from t_jns_pembayaran";
  $query_jnspembayaran=mysql_query($sql_jnspembayaran,$koneksi);
?>
                            <td width="138" bgcolor="#dddddd"> <font color="#000000" size="2">Metode Pembayaran</font>                              *</td>
                            <td bgcolor="#eeeeee"> <select name="c_jnspembayaran" size="1" id="c_jnspembayaran" class="validate-selection">
                                <option selected="selected" value="">-- Tidak 
                                Ada Pilihan 1 --</option>
                                <?php while ($row_jnspembayaran=mysql_fetch_array($query_jnspembayaran))
   {;?>
                                <option value =<?php echo $row_jnspembayaran[id_jns_pembayaran];?>><?php echo $row_jnspembayaran[n_jns_pembayaran];?></option>
                                <?php }?>
                              </select> </td>
                          </tr>
                          <tr> 
                            <td width="138" bgcolor="#dddddd"><font color="#000000" size="2"> Jumlah Pembayaran 
                              *</font></td>
                            <td bgcolor="#eeeeee"> <input name="q_jmlpembayaran" size="15" maxlength="20" type="TEXT" id="q_jmlpembayaran" class="required validate-number">                            </td>
                          </tr>
						  <tr><td width="138" bgcolor="#dddddd"><font color="#000000" size="2">Sisa Pembayaran</font></td>     <td bgcolor="#eeeeee"> : Rp. <input type='type' name='sisa_bayar' value='<?= $sisa_bayar; ?>' onfocus='javascript:getTotal();' id="sisa_bayar" readonly></td></tr>
                          <tr> 
                            <td width="138" bgcolor="#dddddd"><font color="#000000" size="2"> Disetor melalui<font face="ARIAL">Bank 
                              / Kantor Pos Cabang</font> * </font></td>
                            <td bgcolor="#eeeeee"> <input name="n_bank" size="40" maxlength="50" type="TEXT" class="required">                            </td>
                          </tr>
                          <tr> 
                            <td width="138" bgcolor="#dddddd"><font color="#000000" size="2"> Nomor bukti setoran 
                              *<br> 
                            <br> 
                            <br> 
                            </font></td>
                            <td bgcolor="#eeeeee"> <input name="i_rekening" size="25" maxlength="20" type="TEXT" class="required validate-number"> 
                              <br> <font color="#666666" size="2" face="ARIAL">I</font>si 
                              angka saja tanpa spasi atau tanda lain. </td>
                          </tr>
                          <tr> 
                            <td width="138" bgcolor="#dddddd"> <font color="#000000" size="2" face="ARIAL">Nama 
                              Penyetor </font><font color="#000000" size="2"> *<br> 
                              </font></td>
                            <td bgcolor="#eeeeee"> <input name="n_penyetor" size="40" maxlength="20" type="TEXT" class="required"></td>
                          </tr>
                        
                          <!-- ACCEPTANCE -->
                          <tr> 
                            <td colspan="2" bgcolor="#6ABF28" height="2"></td>
                          </tr>
                          <tr bgcolor="#FFFF00">
                            <td colspan="2"><strong>Note : <font color="#666666" size="2" face="ARIAL">Tanda 
                              * ( Wajib Diisi Dengan Benar )</font></strong></td>
                          </tr>
                          <tr> 
                            <td colspan="2" bgcolor="#A4D87C" align="center"> <span class="style1">Saya 
                              menyatakan bahwa seluruh data yang saya isikan adalah 
                              benar dan dapat dipertanggungjawabkan. </span><br> 
                              <br> <input name="submit" value=" � Kirim Konfirmasi � " type="SUBMIT">                            </td>
                          </tr>
                      </table>
                  </font> 
                </form>
				<script type="text/javascript">
						var valid2 = new Validation('test');
					</script>
					<?
					} else { echo "<p><strong>Anda Telah Melakukan Konfirmasi. Pembayaran anda telah kami Proses. Terima Kasih</strong></p>"; } }
					?>