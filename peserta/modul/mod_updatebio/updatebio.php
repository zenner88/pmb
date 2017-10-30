<?php
session_start();
include "../config/koneksi.php";
 if (empty($_SESSION['briva']) AND empty($_SESSION['password'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_updatebio/aksi_updatebio.php";
switch($_GET[act]){
  // Tampil Komentar
  default:
    echo "<h2>Registrasi PMB Online Politeknik Pos Indonesia</h2>";
  $sql_thnakademik="select * from t_tahun_akademik";
  $query_thnakademik=mysql_query($sql_thnakademik,$koneksi);
  $row_thnakademik=mysql_fetch_array($query_thnakademik);
  if ($_SESSION[jalur_pendaftaran]=="Reguler"){
   $sqlCek = mysql_query("select t_calon_mahasiswa.*,t_gel.namagel as nama_gel,t_tempat_ujian.namatmp as temp_ujian from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel inner join t_tempat_ujian on t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.kodetmp where t_calon_mahasiswa.i_registrasi='$_SESSION[kode_briva]' AND status_update='1'");
 if(mysql_num_rows($sqlCek)==0){
 $sqlMHS = mysql_query("select t_calon_mahasiswa.*,t_gel.namagel as nama_gel,t_tempat_ujian.namatmp as temp_ujian from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel inner join t_tempat_ujian on t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.kodetmp where t_calon_mahasiswa.i_registrasi='$_SESSION[kode_briva]'");
 $r = mysql_fetch_array($sqlMHS);
  ?>
  
	<form method=POST name="form_pmb" enctype='multipart/form-data' action=<?php echo "$aksi?module=updatebio&act=updatereg"; ?> id="test" onsubmit="return confirmSubmit()">
<font color="#666666" face="ARIAL" size="2">	<table width="741" cellpadding="4">
<input type=hidden name=pin value=<?php echo $_SESSION[briva]; ?>>
	 <!-- GELOMBANG -->
	<table width="550" cellpadding="4">
	  <tbody>
	    <tr>
	      <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Gelombang</b><br>
	                  <?php
  $sql_gel="select * from t_gel where status='on'";
  $query_gel=mysql_query($sql_gel,$koneksi);
  $row_gel=mysql_fetch_array($query_gel);
  echo"$row_gel[3]";
  ?>
</span></td>
        </tr>
      </tbody>
	  </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Pribadi Peserta</b><br>
            Isilah data pribadi Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Nama Lengkap * 	  </td>
	              <td width="386" bgcolor="#eeeeee">
          <input name="n_lengkap" type="TEXT" class="form-control required" value="<?php echo $r['n_lengkap']; ?>" size="40" maxlength="80"></td>
        </tr>

<?
    if ($r[n_jns_kelamin]=='L'){
      echo "<tr>
          <td width='221' bgcolor='#dddddd'>
            Jenis Kelamin *	  </td>
	              <td bgcolor='#eeeeee'> <input type=radio name='n_jns_kelamin' value='L' checked class='validate-one-required'>Laki-Laki <br><input type=radio name='n_jns_kelamin' value='P' class='validate-one-required'>Perempuan</td></tr>";
    }
    else{
      echo "<tr>
          <td width='221' bgcolor='#dddddd'>
            Jenis Kelamin *	  </td>
	              <td bgcolor='#eeeeee'> <input type=radio name='n_jns_kelamin' value='L' class='validate-one-required'>&nbsp Laki-Laki <br> <input type=radio name='n_jns_kelamin' value='P' checked class='validate-one-required'>&nbsp Perempuan </td></tr>";
    } 
?>

        <tr>
          <td width="140" bgcolor="#dddddd">
            Tempat, Tanggal Lahir *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_temp_lahir" type="TEXT" class="form-control required" value="<?php echo $r['n_temp_lahir']; ?>" size="15" maxlength="40">
	                ,

	                <input name="d_lahir" type="text" class="form-control required" value="<?php echo $r['d_lahir']; ?>" readonly>
					<input type="button" value="Cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">	  </td>
        </tr>

        <tr>
          <td width="140" bgcolor="#dddddd" valign="top">
            Alamat yang dapat Dihubungi *	  </td>
	              <td bgcolor="#eeeeee">
	                <textarea name="n_alamat" rows="2" cols="30" class="required"><?php echo $r['n_alamat']; ?></textarea>
	                *Keterangan : Mohon isi kolom alamat dengan lengkap dengan format Jalan, No.rumah, RT/RW, Kelurahan/Kecamatan, dan lain-lain sesuai dengan format KTP
		  </td>
        </tr>
                 <tr>
          <td width="140" bgcolor="#dddddd" valign="top">
            Agama	  </td>
	              <td bgcolor="#eeeeee">
		<? echo"<select name='i_agama'>";
 
          $tampil_agama=mysql_query("SELECT * FROM t_agama");
          if ($r[n_agama]==0){
            echo "<option value=0 selected>- Pilih Agama -</option>";
          }   

          while($w=mysql_fetch_array($tampil_agama)){
            if ($r[n_agama]==$w[kd_agama]){
              echo "<option value=$w[kd_agama] selected>$w[n_agama]</option>";
            }
            else{
              echo "<option value=$w[kd_agama]>$w[n_agama]</option>";
            }
          }
    echo "</select>";?>
				   </td>
	             </tr>

        <tr>
          <td width="140" bgcolor="#dddddd">
            Propinsi<br>
          Kabupaten / Kota *	  </td>
	              <td bgcolor="#eeeeee">
<select name="n_propinsi" onChange="showKab()">
          <option>Silakan Pilih</option>
          <option>------------------------</option>
          <?php
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM t_prop";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    echo "<option value='".$data['kd_prop']."'>".$data['nama_prop']."</option>";
                 }
          ?>
          </select>
                          <select name="n_kabupaten" id="n_kabupaten">
                            <option selected="selected"> </option>
                    </select>
          </td>
        </tr>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Kode Pos *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="c_pos" type="TEXT" class="validate-number required" value="<?php echo $r['c_pos']; ?>" size="5" maxlength="5" >	  </td>
        </tr>

        <tr>
                        <td width="140" bgcolor="#dddddd"> Nomor Telepon * </td>
	                    <td bgcolor="#eeeeee"> <input name="i_telp" type="TEXT" class="validate-number required" value="<?php echo $r['i_telp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
          <td width="140" bgcolor="#dddddd">
            Nomor Handphone/Selular *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="i_hp" type="TEXT" class="validate-number required" value="<?php echo $r['i_hp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
                        <td width="140" bgcolor="#dddddd"> Email * </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_email" type="TEXT" class="required validate-email" value="<?php echo $r['n_email']; ?>" size="25" maxlength="40"></td>
        </tr>



        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- DATA ORANGTUA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Orang Tua Peserta</b><br>
            Isilah data orang tua Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Nama Orang Tua *	  </td>
	                    <td width="386" bgcolor="#eeeeee">
          <input name="n_ortu" type="TEXT" class="required" value="<?php echo $r['n_ortu']; ?>" size="40" maxlength="60">	  </td>
        </tr>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Jenis Pekerjaan<br>
          Orang Tua * </td>
	                    <td bgcolor="#eeeeee">
	                     		<? echo"<select name='n_jabatan'>";
 
          $tampil_kerja=mysql_query("SELECT * FROM t_kerja_ortu");
          if ($r[n_jabatan]==0){
            echo "<option value=0 selected>- Pilih -</option>";
          }   

          while($k=mysql_fetch_array($tampil_kerja)){
            if ($r[n_jabatan]==$k[id_kerja]){
              echo "<option value=$k[id_kerja] selected>$k[n_kerja]</option>";
            }
            else{
              echo "<option value=$k[id_kerja]>$k[n_kerja]</option>";
            }
          }
    echo "</select>";?>
  </td>
        </tr>


        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- DATA SMA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data SMA/MA/SMK Peserta</b><br>
            Isilah data SMA/MA/SMK asal Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Nama SMA/MA/SMK Asal *	  </td>
                        <td width="386" bgcolor="#eeeeee">
          <input name="n_sma" type="TEXT" class="required" value="<?php echo $r['n_sma']; ?>" size="30" maxlength="60">	  </td>
        </tr>
        <tr>
          <?php
  $sql_smu="select * from t_jurusan_sma";
  $query_smu=mysql_query($sql_smu,$koneksi);
  ?>
          <td width="140" bgcolor="#dddddd">
            Jurusan SMA/MA/SMK *  </td>
                        <td bgcolor="#eeeeee">
                          <? echo"<select name='i_jur_sma'>";
 
          $tampil_sma=mysql_query("SELECT * FROM t_jurusan_sma");
          if ($r[i_jur_sma]==0){
            echo "<option value=0 selected>- Pilih -</option>";
          }   

          while($s=mysql_fetch_array($tampil_sma)){
            if ($r[i_jur_sma]==$s[KodeSMU]){
              echo "<option value=$s[KodeSMU] selected>$s[Keterangan]</option>";
            }
            else{
              echo "<option value=$s[KodeSMU]>$s[Keterangan]</option>";
            }
          }
    echo "</select>";?>	  </td>
        </tr>
           <tr>
             <td width="140" bgcolor="#dddddd">
               Alamat SMA/MA/SMK *	  </td>
                        <td bgcolor="#eeeeee">
                        <textarea name="n_alamat_sma" rows="2" cols="30" class="required"><?php echo $r['n_alamat_sma']; ?></textarea>	  </td>
        </tr>



           <tr>
             <td width="140" bgcolor="#dddddd">
               Propinsi<br>
             Kabupaten / Kota *	  </td>
                        <td bgcolor="#eeeeee">

<select name="n_prop_sma" onChange="showKab2()">
          <option>Silakan Pilih</option>
          <option>------------------------</option>
          <?php
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM t_prop";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    echo "<option value='".$data['kd_prop']."'>".$data['nama_prop']."</option>";
                 }
          ?>
          </select>
                          <select name="n_kab_sma" id="n_kab_sma">
                            <option selected="selected"></option>
						  </select></td>
        </tr>
           <tr>
             <td colspan="2" height="4"></td>
        </tr>

           <!-- PILIHAN PRODI -->
           <tr>
             <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>          </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Lokasi Ujian</b><br>
            Pilihlah lokasi ujian tempat Saudara/i akan melakukan Ujian Saringan Masuk.
            Informasi wilayah lokasi ujian dapat Anda lihat pada halaman Lokasi
          Ujian. </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
               <tr>
                 <td width="140" bgcolor="#dddddd">
                   Lokasi Ujian *	  </td>
                        <td width="386" bgcolor="#eeeeee">
						<? echo"<select name='i_temp_ujian'>";
 
          $tampil_tempat=mysql_query("SELECT * FROM t_tempat_ujian");
          if ($r[i_temp_ujian]==0){
            echo "<option value=0 selected>- Pilih -</option>";
          }   

          while($t=mysql_fetch_array($tampil_tempat)){
            if ($r[i_temp_ujian]==$t[KodeTmp]){
              echo "<option value=$t[KodeTmp] selected>$t[NamaTmp]</option>";
            }
            else{
              echo "<option value=$t[KodeTmp]>$t[NamaTmp]</option>";
            }
          }
    echo "</select>";?>	  </td>
        </tr>
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- SDP2 -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
     <table width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Photo Peserta</b><br>
            Upload photo Closeup terbaru Saudara/i ( Photo Resmi ) Ukuran 3x4</span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Photo ( 3x4 ) 	  </td>
	                    <td width="386" bgcolor="#eeeeee">
          <input name="photo" size="40" maxlength="60" type="file">	  </td>
        </tr>



        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- End Photo-->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
<script language="JavaScript1.2">
function validate_pil(data) {
		var n_pil1=data.n_pil1;
		var n_pil2=data.n_pil2;
		var n_pil3=data.n_pil3;
		if (n_pil1.value==n_pil2.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 2");
		   n_pil2.value=0;   }
		   }
		if (n_pil1.value==n_pil3.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
		if (n_pil2.value==n_pil3.value) {
		   if (n_pil2.value!=0) {
		   alert ("Pilihan 2 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
}
</script>
                  <table width="550" cellpadding="4">
                    <tbody>
                      <tr>
                        <td colspan="2" bordercolor="#FFFFFF" bgcolor="#FFFF00"><strong>Note
                          : <font color="#666666" size="2" face="ARIAL">Tanda
                          * ( Wajib Diisi Dengan Benar )</font></strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" bgcolor="#A4D87C"><span class="style1">Saya
                          menyatakan bahwa seluruh data yang saya isikan adalah
                          benar, dapat dipertanggungjawabkan dan telah melalui
                          persetujuan orang tua / wali. </span></td>
                      </tr>
                    </tbody>
                  </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C" align="center"><input name="submit" value="Update Data" type="SUBMIT">	  </td>
        </tr>
      </tbody>
    </table>
<!-- NOMOR REGISTRASI -->
<INPUT type="hidden" name="c_jalur" value="reguler" />
<INPUT type="hidden" name="i_thn_akademik" value="<? echo "$row_thnakademik[1]"?>" />
</form>
<script type="text/javascript">
						var valid2 = new Validation('test');
					</script>
					
<script type="text/javascript">
						function formCallback(result, form) {
							window.status = "valiation callback for form '" + form.id + "': result = " + result;
						}
						
						var valid = new Validation('test', {immediate : true, onFormValidate : formCallback});
						Validation.addAllThese([
							['validate-rata', 'Nilai Rata-rata harus 4 digit sesuai dengan contoh!', {
								length : 4			
							}],
							['validate-nilai', 'Nilai harus 2 digit sesuai dengan contoh!', {
								length : 2
							}],
							['validate-rupiah', 'Nilai inputan salah!', {
								minLength : 6
							}],
							['validate-digit', 'Nilai inputan harus kelipatan Rp.100.000,00!', {
								oneOf : [
										'100000','200000','300000','400000','500000','600000','700000','800000','900000','1000000',
										'1100000','1200000','1300000','1400000','1500000','1600000','1700000','1800000','1900000','2000000',
										'2100000','2200000','2300000','2400000','2500000','2600000','2700000','2800000','2900000','3000000',
										'3100000','3200000','3300000','3400000','3500000','3600000','3700000','3800000','3900000','4000000',
										'4100000','4200000','4300000','4400000','4500000','4600000','4700000','4800000','4900000','5000000',
										'5100000','5200000','5300000','5400000','5500000','5600000','5700000','5800000','5900000','6000000',
										'6100000','6200000','6300000','6400000','6500000','6600000','6700000','6800000','6900000','7000000',
										'7100000','7200000','7300000','7400000','7500000','7600000','7700000','7800000','7900000','8000000',
										'8100000','8200000','8300000','8400000','8500000','8600000','8700000','8800000','8900000','9000000',
										'9100000','9200000','9300000','9400000','9500000','9600000','9700000','9800000','9900000','10000000'
										]
							}]
						]);
					</script>
<?php
} else {
echo "Anda Telah Melakukan Update Data. Update Data hanya dapat dilakukan satu kali. Terima Kasih !!!.";
?>
<?
}} 
if($_SESSION[jalur_pendaftaran]=="PMDK") {
$sqlCek = mysql_query("select t_calon_mahasiswa.* from t_calon_mahasiswa where t_calon_mahasiswa.i_registrasi='$_SESSION[briva]' AND status_update='1'");
 if(mysql_num_rows($sqlCek)==0){
 $sqlMHS = mysql_query("select t_calon_mahasiswa.* from t_calon_mahasiswa where t_calon_mahasiswa.i_registrasi='$_SESSION[briva]'");
 $r= mysql_fetch_array($sqlMHS);
  $sql_gel="select * from t_gel where kodegel='PMDK' and status='on'";
  $query_gel=mysql_query($sql_gel,$koneksi);
  $row_gel=mysql_fetch_array($query_gel);
  if (mysql_num_rows($query_gel)>0){
	?>
<form action=<?= $aksi; ?>?module=updatebio&amp;act=updatepmdk method=POST enctype='multipart/form-data' name="form_pmb" id="test2" onsubmit="return confirmSubmit()">
<font color="#666666" face="ARIAL" size="2">	<table width="741" cellpadding="4">
<input type=hidden name=pin value=<?php echo $_SESSION[briva]; ?>>
	 <!-- GELOMBANG -->
	<table width="550" cellpadding="4">
	  <tbody>
	    <tr>
	      <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>PMDK</b><br>
	                  <?php
  echo"$row_gel[3]";
  ?>
</span></td>
        </tr>
      </tbody>
  </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Pribadi Peserta</b><br>
            Isilah data pribadi Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Nama Lengkap * 	  </td>
	              <td width="386" bgcolor="#eeeeee">
          <input name="n_lengkap" type="TEXT" class="required" value="<?php echo $r['n_lengkap']; ?>" size="40" maxlength="80"></td>
        </tr>

<?
    if ($r[n_jns_kelamin]=='L'){
      echo "<tr>
          <td width='221' bgcolor='#dddddd'>
            Jenis Kelamin *	  </td>
	              <td bgcolor='#eeeeee'> <input type=radio name='n_jns_kelamin' value='L' checked class='validate-one-required'>Laki-Laki <br><input type=radio name='n_jns_kelamin' value='P' class='validate-one-required'>Perempuan</td></tr>";
    }
    else{
      echo "<tr>
          <td width='221' bgcolor='#dddddd'>
            Jenis Kelamin *	  </td>
	              <td bgcolor='#eeeeee'> <input type=radio name='n_jns_kelamin' value='L' class='validate-one-required'>Laki-Laki <br> <input type=radio name='n_jns_kelamin' value='P' checked class='validate-one-required'>Perempuan </td></tr>";
    } 
?>

        <tr>
          <td width="140" bgcolor="#dddddd">
            Tempat, Tanggal Lahir *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_temp_lahir" type="TEXT" class="required" value="<?php echo $r['n_temp_lahir']; ?>" size="15" maxlength="40">
	                ,

	                <input name="d_lahir" type="text" class="required" value="<?php echo $r['d_lahir']; ?>" readonly>
					<input type="button" value="Cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">	  </td>
        </tr>

        <tr>
          <td width="140" bgcolor="#dddddd" valign="top">
            Alamat yang dapat Dihubungi *	  </td>
	              <td bgcolor="#eeeeee">
	                <textarea name="n_alamat" rows="2" cols="30" class="required"><?php echo $r['n_alamat']; ?></textarea>	
	                *Keterangan : Mohon isi kolom alamat dengan lengkap dengan format Jalan, No.rumah, RT/RW, Kelurahan/Kecamatan, dan lain-lain sesuai dengan format KTP
		  </td>
        </tr>
                          <tr>
          <td width="140" bgcolor="#dddddd" valign="top">
            Agama	  </td>
	              <td bgcolor="#eeeeee">
		<? echo"<select name='i_agama'>";
 
          $tampil_agama=mysql_query("SELECT * FROM t_agama");
          if ($r[n_agama]==0){
            echo "<option value=0 selected>- Pilih Agama -</option>";
          }   

          while($w=mysql_fetch_array($tampil_agama)){
            if ($r[n_agama]==$w[kd_agama]){
              echo "<option value=$w[kd_agama] selected>$w[n_agama]</option>";
            }
            else{
              echo "<option value=$w[kd_agama]>$w[n_agama]</option>";
            }
          }
    echo "</select>";?>
						</td>
	             </tr>

        <tr>
          <td width="140" bgcolor="#dddddd">
            Propinsi<br>
          Kabupaten / Kota *	  </td>
	              <td bgcolor="#eeeeee">
<select name="n_propinsi" onChange="showKab()">
          <option>Silakan Pilih</option>
          <option>------------------------</option>
          <?php
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM t_prop";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    echo "<option value='".$data['kd_prop']."'>".$data['nama_prop']."</option>";
                 }
          ?>
          </select>
                          <select name="n_kabupaten" id="n_kabupaten">
                            <option selected="selected"> </option>
                    </select>
	            </td>
        </tr>
      <td width="140" bgcolor="#dddddd">
            Kode Pos *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="c_pos" type="TEXT" class="validate-number required" value="<?php echo $r['c_pos']; ?>" size="5" maxlength="5" >	  </td>
        </tr>

        <tr>
                        <td width="140" bgcolor="#dddddd"> Nomor Telepon * </td>
	                    <td bgcolor="#eeeeee"> <input name="i_telp" type="TEXT" class="validate-number required" value="<?php echo $r['i_telp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
          <td width="140" bgcolor="#dddddd">
            Nomor Handphone/Selular *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="i_hp" type="TEXT" class="validate-number required" value="<?php echo $r['i_hp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
                        <td width="140" bgcolor="#dddddd"> Email * </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_email" type="TEXT" class="required validate-email" value="<?php echo $r['n_email']; ?>" size="25" maxlength="40"></td>
        </tr>



        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- DATA ORANGTUA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Orang Tua Peserta</b><br>
            Isilah data orang tua Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Nama Orang Tua *	  </td>
	                    <td width="386" bgcolor="#eeeeee">
          <input name="n_ortu" type="TEXT" class="required" value="<?php echo $r['n_ortu']; ?>" size="40" maxlength="60">	  </td>
        </tr>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Jenis Pekerjaan<br>
          Orang Tua * </td>
	                    <td bgcolor="#eeeeee">
<!--                         <input name="n_jabatan" size="30" maxlength="80" type="TEXT" class="required">
 -->						
 
 		<? echo"<select name='n_jabatan'>";
 
          $tampil_kerja=mysql_query("SELECT * FROM t_kerja_ortu");
          if ($r[n_jabatan]==0){
            echo "<option value=0 selected>- Pilih -</option>";
          }   

          while($k=mysql_fetch_array($tampil_kerja)){
            if ($r[n_jabatan]==$k[id_kerja]){
              echo "<option value=$k[id_kerja] selected>$k[n_kerja]</option>";
            }
            else{
              echo "<option value=$k[id_kerja]>$k[n_kerja]</option>";
            }
          }
    echo "</select>";?>
  </td>
        </tr>


        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- DATA SMA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data SMA/MA/SMK Peserta</b><br>
            Isilah data SMA/MA/SMK asal Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Nama SMA/MA/SMK Asal *	  </td>
                        <td width="386" bgcolor="#eeeeee">
          <input name="n_sma" type="TEXT" class="required" value="<?php echo $r['n_sma']; ?>" size="30" maxlength="60">	  </td>
        </tr>
        <tr>
          <?php
  $sql_smu="select * from t_jurusan_sma";
  $query_smu=mysql_query($sql_smu,$koneksi);
  ?>
          <td width="140" bgcolor="#dddddd">
            Jurusan SMA/MA/SMK *  </td>
                        <td bgcolor="#eeeeee">
						 		<? echo"<select name='i_jur_sma'>";
 
          $tampil_sma=mysql_query("SELECT * FROM t_jurusan_sma");
          if ($r[i_jur_sma]==0){
            echo "<option value=0 selected>- Pilih -</option>";
          }   

          while($s=mysql_fetch_array($tampil_sma)){
            if ($r[i_jur_sma]==$s[KodeSMU]){
              echo "<option value=$s[KodeSMU] selected>$s[Keterangan]</option>";
            }
            else{
              echo "<option value=$s[KodeSMU]>$s[Keterangan]</option>";
            }
          }
    echo "</select>";?>

	  </td>
        </tr>
           <tr>
             <td width="140" bgcolor="#dddddd">
               Alamat SMA/MA/SMK *	  </td>
                        <td bgcolor="#eeeeee">
                        <textarea name="n_alamat_sma" rows="2" cols="30" class="required"><?php echo $r['n_alamat_sma']; ?></textarea>	  </td>
        </tr>



           <tr>
             <td width="140" bgcolor="#dddddd">
               Propinsi<br>
             Kabupaten / Kota *	  </td>
                        <td bgcolor="#eeeeee"><select name="n_prop_sma" onChange="showKab2()">
          <option>Silakan Pilih</option>
          <option>------------------------</option>
          <?php
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM t_prop";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    echo "<option value='".$data['kd_prop']."'>".$data['nama_prop']."</option>";
                 }
          ?>
          </select>
                          <select name="n_kab_sma" id="n_kab_sma">
                            <option selected="selected">             </option>
                        </select></td>
        </tr>
           <tr>
             <td colspan="2" height="4"></td>
        </tr>

           <!-- PILIHAN PRODI -->
           <tr>
             <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>          </tr>
      </tbody>
    </table>
     <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Nilai Calon Mahasiswa</b><br>
            Isilah data nilai Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
                        <td width="140" bgcolor="#dddddd"> Nilai Rata-rata kelas XI semester
                          2 * </td>
	                    <td width="386" bgcolor="#eeeeee">
                        <input name="rata2_XI_2" size="4" maxlength="4" type="TEXT" class="validate-number required required validate-rata" value="<?php echo $r['rata2_XI_2']; ?>" >
          contoh:90,75 ditulis 9075; 4,1 ditulis 0410 </td>
        </tr>

        <tr>
                        <td width="140" bgcolor="#dddddd"> Nilai Matematika kelas XI semester
                          2 *</td>
	                    <td bgcolor="#eeeeee">
                        <input name="mtk_XI_2" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $r['mtk_XI_2']; ?>" >
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
        </tr>

        <tr>
                        <td width="140" bgcolor="#dddddd"> Nilai Bhs.Inggris kelas XI semester
                          2 * </td>
	                    <td bgcolor="#eeeeee">
                        <input name="ing_XI_2" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $r['ing_XI_2']; ?>" >
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
        </tr>
					  <tr>
					  </tr>
					  <tr>
					  </tr>
          <tr>
                        <td width="140" bgcolor="#dddddd"> Nilai Rata-rata kelas XII semester
                          1 * </td>
	                    <td bgcolor="#eeeeee">
                        <input name="rata2_XII_1" size="4" maxlength="4" type="TEXT" class="validate-number required required validate-rata" value="<?php echo $r['rata2_XII_1']; ?>" >
                        contoh:90,75 ditulis 9075; 4,1 ditulis 0410 </td>
        </tr>
					     <tr>
                        <td width="140" bgcolor="#dddddd"> Nilai Matematika kelas XII semester
                          1 * </td>
	                    <td bgcolor="#eeeeee">
                        <input name="mtk_XII_1" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $r['mtk_XII_1']; ?>" >
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
                      </tr>
           <tr>
                        <td width="140" bgcolor="#dddddd"> Nilai Bhs.Inggris kelas XII semester
                          1 * </td>
	                    <td bgcolor="#eeeeee">
                        <input name="ing_XII_1" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $r['ing_XII_1']; ?>" >
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
        </tr>
        <tr>
          <td colspan="2" height="4"></td>
        </tr>

	<!-- CAPTCHA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
     <table width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Photo Peserta</b><br>
            Upload photo Closeup terbaru Saudara/i ( Photo Resmi ) Ukuran 3x4</span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Photo ( 3x4 )	  </td>
	                    <td width="386" bgcolor="#eeeeee">
          <input name="photo" size="40" maxlength="60" type="file">	  </td>
        </tr>



        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- End Photo-->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
<script language="JavaScript1.2">
function validate_pil(data) {
		var n_pil1=data.n_pil1;
		var n_pil2=data.n_pil2;
		var n_pil3=data.n_pil3;
		if (n_pil1.value==n_pil2.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 2");
		   n_pil2.value=0;   }
		   }
		if (n_pil1.value==n_pil3.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
		if (n_pil2.value==n_pil3.value) {
		   if (n_pil2.value!=0) {
		   alert ("Pilihan 2 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
}
</script>
                  <table width="550" cellpadding="4">
                    <tbody>
                      <tr>
                        <td colspan="2" bordercolor="#FFFFFF" bgcolor="#FFFF00"><strong>Note
                          : <font color="#666666" size="2" face="ARIAL">Tanda
                          * ( Wajib Diisi Dengan Benar )</font></strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" bgcolor="#A4D87C"><span class="style1">Saya
                          menyatakan bahwa seluruh data yang saya isikan adalah
                          benar, dapat dipertanggungjawabkan dan telah melalui
                          persetujuan orang tua / wali. </span></td>
                      </tr>
                    </tbody>
                  </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C" align="center"><input name="submit" value="Update Data" type="SUBMIT">	  </td>
        </tr>
      </tbody>
    </table>
<!-- NOMOR REGISTRASI -->
<INPUT type="hidden" name="c_jalur" value="PMDK" />
<INPUT type="hidden" name="i_thn_akademik" value="<? echo "$row_thnakademik[1]"?>" />
</form>
<script type="text/javascript">
						var valid3 = new Validation('test2');
					</script>
					
<script type="text/javascript">
						function formCallback(result, form) {
							window.status = "valiation callback for form '" + form.id + "': result = " + result;
						}
						
						var valid = new Validation('test2', {immediate : true, onFormValidate : formCallback});
						Validation.addAllThese([
							['validate-rata', 'Nilai Rata-rata harus 4 digit sesuai dengan contoh!', {
								length : 4			
							}],
							['validate-nilai', 'Nilai harus 2 digit sesuai dengan contoh!', {
								length : 2
							}],
							['validate-rupiah', 'Nilai inputan salah!', {
								minLength : 6
							}],
							['validate-digit', 'Nilai inputan harus kelipatan Rp.100.000,00!', {
								oneOf : [
										'100000','200000','300000','400000','500000','600000','700000','800000','900000','1000000',
										'1100000','1200000','1300000','1400000','1500000','1600000','1700000','1800000','1900000','2000000',
										'2100000','2200000','2300000','2400000','2500000','2600000','2700000','2800000','2900000','3000000',
										'3100000','3200000','3300000','3400000','3500000','3600000','3700000','3800000','3900000','4000000',
										'4100000','4200000','4300000','4400000','4500000','4600000','4700000','4800000','4900000','5000000',
										'5100000','5200000','5300000','5400000','5500000','5600000','5700000','5800000','5900000','6000000',
										'6100000','6200000','6300000','6400000','6500000','6600000','6700000','6800000','6900000','7000000',
										'7100000','7200000','7300000','7400000','7500000','7600000','7700000','7800000','7900000','8000000',
										'8100000','8200000','8300000','8400000','8500000','8600000','8700000','8800000','8900000','9000000',
										'9100000','9200000','9300000','9400000','9500000','9600000','9700000','9800000','9900000','10000000'
										]
							}]
						]);
					</script>
</td>
 </tr>
</tbody><?php
} else {
	echo "<b>Maaf Jalur Pendaftaran PMDK Telah ditutup !!!</b>";
}
} else {
echo "Anda Telah Melakukan Update Data. Update Data hanya dapat dilakukan satu kali. Terima Kasih !!!.";
}}
    break;
	}	}?>