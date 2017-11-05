<?php
error_reporting(0);
// session_start();
include "../config/koneksi.php";
include "config/recaptchalib.php";
$publickey = "6Le8Tr4SAAAAAOwlk7qk8eZJ7i2gzWRXfK7r420n";
$privatekey = "6Le8Tr4SAAAAAEpek74I8a--2ZC5j09NPQfCk1Ux";
 if (empty($_SESSION['kode_briva']) AND empty($_SESSION['password'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_registrasi/aksi_registrasi.php";
switch(isset($_GET['act'])){
  // Tampil Komentar
  default:
    echo "<h2>Registrasi PMB Online Politeknik Pos Indonesia</h2>";
	echo "<div style=color:red;><B>SEGERA ISI BIODATA!</B></div>";
  $sql_thnakademik="select * from t_tahun_akademik where status='on'";
  $query_thnakademik=mysql_query($sql_thnakademik,$koneksi);
  $row_thnakademik=mysql_fetch_array($query_thnakademik);
  if (isset($_SESSION['jalur_pendaftaran'])=="Reguler"){
   $sqlCek = mysql_query("select t_calon_mahasiswa.*,t_gel.namagel as nama_gel,t_tempat_ujian.namatmp as temp_ujian from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel inner join t_tempat_ujian on t_calon_mahasiswa.i_temp_ujian=t_tempat_ujian.kodetmp where t_calon_mahasiswa.i_registrasi='$_SESSION[kode_briva]'");
 if(mysql_num_rows($sqlCek)==0){
  ?>
  
	<form method=POST name="form_pmb" enctype='multipart/form-data' action=<?php echo "$aksi?module=registrasi&act=addreguler"; ?> id="test">
<font color="#666666" face="ARIAL" size="2">	<table width="741" cellpadding="4">
<input type=hidden name=pin value=<?php echo $_SESSION['kode_briva']; ?>>
	 <!-- GELOMBANG -->
<div class="col-lg-3 col-md-6">
                        
                    </div>
						
						
	<table class="table table-bordered " width="550" cellpadding="4">
	 
	  </table>
<!-- FORM REGULAR -->
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
  
    <div class="panel panel-primary">
        <div class="panel-heading">
                              
			<b>
	                  <?php
  $sql_gel="select * from t_gel where status='on'";
  $query_gel=mysql_query($sql_gel,$koneksi);
  $row_gel=mysql_fetch_array($query_gel);
  echo"$row_gel[3]";
  ?>	</b>		  
        </div>
                          
    <div class="panel-footer">
                                  
    
	   
	         
	          <input class="form-control"name="c_gel" value="<?PHP echo"$row_gel[1]"; ?>" type="HIDDEN">


	    <!-- DATA PRIBADI -->
	 
	  </tbody>
	</table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style"><b>Data Pribadi Peserta</b><br>
            Isilah data pribadi Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
     
        <tr>
          <td width="140" class="bg-warning">
            Nama Lengkap * 	  </td>
	              <td width="386" class="bg-warning">
          <input class="form-control required" name="n_lengkap" type="TEXT"  value="<?php echo $_SESSION['nama']; ?>" size="40" maxlength="80"></td>
        </tr>

        <tr>
          <td width="140" class="bg-warning">
            Jenis Kelamin *	  </td>
	              <td class="bg-warning">
	                <input  name="n_jns_kelamin" value="L" selected="" type="RADIO" class="validate-one-required">&nbsp Laki-laki <br>
	                <input  name="n_jns_kelamin" value="P" type="RADIO" class="validate-one-required">&nbsp Perempuan	  </td>
        </tr>

        <tr>
          <td width="140" class="bg-warning">
            Tempat, Tanggal Lahir *	  </td>
	              <td class="bg-warning">
	                <input class="required"name="n_temp_lahir" type="TEXT"  value="<?php echo $_SESSION['tmptlahir']; ?>" size="15" maxlength="40">
	               

	                <input class="required"name="d_lahir" type="text"  value="<?php echo $_SESSION['tgllahir']; ?>" readonly>
				<input  type="button" value="cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">	  </td>
        </tr>

        <tr>
          <td width="140" class="bg-warning" valign="top">
            Alamat yang dapat Dihubungi *	  </td>
	              <td class="bg-warning">
	                <textarea class="form-control required" name="n_alamat" rows="2" cols="30" ><?php echo $_SESSION['alamat']; ?></textarea>
	                *Keterangan : Mohon isi kolom alamat dengan lengkap dengan format Jalan, No.rumah, RT/RW, Kelurahan/Kecamatan, dan lain-lain sesuai dengan format KTP
		  </td>
        </tr>
                 <tr>
          <td width="140" class="bg-warning" valign="top">
            Agama	  </td>
	              <td class="bg-warning">
				  <?php
  $sql_agm="select * from t_agama";
  $query_agm=mysql_query($query);
  ?>
				  <select class="form-control validate-selection" name="i_agama" size="1" id="i_agama" >
				   <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_agm=mysql_fetch_array($query_agm))
   {;?>
                            <option value ="<?php echo $row_agm['kd_agama'];?>"><?php echo $row_agm['n_agama'];?></option>
                            <?php }?>
                        </select>
				   </td>
	             </tr>

        <tr>
          <td width="140" class="bg-warning">
            Propinsi<br>
          Kabupaten / Kota *	  </td>
	              <td class="bg-warning">
	                 <select class="validate-selection" name="n_propinsi" onChange="showKab()">
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
                    </select> </td>
        </tr>
        <tr>
          <td width="140" class="bg-warning">
            Kode Pos *	  </td>
	              <td class="bg-warning">
	                <input class="form-control validate-number required"name="c_pos" type="TEXT"  value="<?php echo $_SESSION['kdpos']; ?>" size="5" maxlength="5" >	  </td>
        </tr>

        <tr>
                        <td width="140" class="bg-warning"> Nomor Telepon * </td>
	                    <td class="bg-warning"> <input class="form-control validate-number required"name="i_telp" type="TEXT"  value="<?php echo $_SESSION['telp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
          <td width="140" class="bg-warning">
            Nomor Handphone/Selular *	  </td>
	              <td class="bg-warning">
	                <input class="form-control validate-number required"name="i_hp" type="TEXT"  value="<?php echo $_SESSION['no_tlp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
                        <td width="140" class="bg-warning"> Email * </td>
	              <td class="bg-warning">
	                <input class="form-control required validate-email"name="n_email" type="TEXT"  value="<?php echo $_SESSION['email']; ?>" size="25" maxlength="40"></td>
        </tr>

        <!-- DATA ORANGTUA -->
        
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1" ><b>Data Orang Tua Peserta</b><br>
            Isilah data orang tua Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      
        <tr>
          <td width="140" class="bg-warning">
            Nama Orang Ayah / Wali *	  </td>
	                    <td width="386" class="bg-warning">
          <input class="form-control required"name="n_ortu" type="TEXT"  value="<?php echo $_SESSION['nm_ortu']; ?>" size="40" maxlength="60">	  </td>
        </tr>
		<tr>
          <td width="140" class="bg-warning">
            Nama Ibu Kandung *	  </td>
	                    <td width="386" class="bg-warning">
          <input class="form-control required"name="n_ibu" type="TEXT"  value="<?php echo $_SESSION['nm_ibu']; ?>" size="40" maxlength="60">	  </td>
        </tr>
        <tr>
          <td width="140" class="bg-warning">
            Jenis Pekerjaan<br>
          Orang Tua * </td>
	                    <td class="bg-warning">
	                     <?php
  $sql_kerja="select * from t_kerja_ortu";
  $query_kerja=mysql_query($sql_kerja,$koneksi);
  ?>
				  <select class="form-control validate-selection" name="n_jabatan" size="1" id="n_jabatan" >
				   <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_kerja=mysql_fetch_array($query_kerja))
   {;?>
                            <option value ="<?php echo $row_kerja['id_kerja'];?>"><?php echo $row_kerja['n_kerja'];?></option>
                            <?php }?>
                        </select>
  </td>
        </tr>

        <!-- DATA SMA -->
        
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1"><b>Data SMA/MA/SMK Peserta</b><br>
            Isilah data SMA/MA/SMK asal Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
		<tr>
          <td width="140" class="bg-warning">
            Nomor Induk Siswa Nasional (NISN) *	  </td>
                        <td width="386" class="bg-warning">
          <input class="form-control required"name="nis" type="TEXT"  value="<?php echo $_SESSION['nis']; ?>" size="30" maxlength="60">	  </td>
        </tr>
        <tr>
          <td width="140" class="bg-warning">
            Nama SMA/MA/SMK Asal *	  </td>
                        <td width="386" class="bg-warning">
          <input class="form-control required"name="n_sma" type="TEXT"  value="<?php echo $_SESSION['asalsma']; ?>" size="30" maxlength="60">	  </td>
        </tr>
        <tr>
          <?php
  $sql_smu="select * from t_jurusan_sma";
  $query_smu=mysql_query($sql_smu,$koneksi);
  ?>
          <td width="140" class="bg-warning">
            Jurusan SMA/MA/SMK *  </td>
                        <td class="bg-warning">
                          <select class="form-control validate-selection" name="i_jur_sma" size="1" id="i_jur_sma" >
						    <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_smu=mysql_fetch_array($query_smu))
   {;?>
                            <option value ="<?php echo $row_smu['KodeSMU'];?>"><?php echo $row_smu['Keterangan'];?></option>
                            <?php }?>
                        </select>	  </td>
        </tr>
           <tr>
             <td width="140" class="bg-warning">
               Alamat SMA/MA/SMK *	  </td>
                        <td class="bg-warning">
                        <textarea class="form-control required" name="n_alamat_sma" rows="2" cols="30" ><?php echo $_SESSION['alamatsma']; ?></textarea>	  </td>
        </tr>



           <tr>
             <td width="140" class="bg-warning">
               Propinsi<br>
             Kabupaten / Kota *	  </td>
                        <td class="bg-warning">
<select class="validate-selection" name="n_prop_sma" onChange="showKab2()">
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
       

           <!-- PILIHAN PRODI -->
           
      </tbody>
    </table>
  
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1"><b>Pilihan Program Studi</b><br>
            Pilihlah program studi yang Saudara/i minati. Jumlah pilihan boleh
            satu, dua atau tiga program studi yang ada di Politeknik
              Pos Indonesia.	  </span></td>
        </tr>
     
<script language="JavaScript1.2">
function validate_pil(data) {
		var n_pil1=data.n_pil1;
		var n_pil2=data.n_pil2;
		
		if (n_pil1.value==n_pil2.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 2");
		   n_pil2.value=0;   }
		   }
		
}
</script>
           <tr>
<?php
function combo($var, $data) {
	echo "<select class='form-control validate-selection'  name='$var' onChange='validate_pil(this.form)'>";
	echo "<option value=0 selected>- Pilih Jurusan -</option>";
	$sql=mysql_query("select distinct t_jurusan.* from t_jurusan
left join t_daftar on t_daftar.pilihan=t_jurusan.jenjang 
where t_daftar.kode_briva='$_SESSION[kode_briva]'");
	while ($data=mysql_fetch_array($sql)){
		echo "<option value=$data[KodeJrsn]>$data[NamaJrsn]</option>";
	}
	echo "</select>";
}
?>
             <td width="140" class="bg-warning">
               Pilihan 1 *	  </td>
                        <td width="386" class="bg-warning"><?PHP combo("n_pil1",isset($data1)); ?></td>
        </tr>
           <tr>
             <td width="140" class="bg-warning">
               Pilihan 2 *	  </td>
                        <td class="bg-warning"><?PHP combo("n_pil2",$data2); ?></td>
        </tr>
           <tr>
             <td width="140" class="bg-warning">
               Pilihan 3 *	  </td>
                        <td class="bg-warning"><?PHP combo("n_pil3",$data3); ?></td>
        </tr>
       

               <!-- LOKASI UJIAN  -->
               
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1"><b>Lokasi Ujian</b><br>
            Pilihlah lokasi ujian tempat Saudara/i akan melakukan Ujian Saringan Masuk.
            Informasi wilayah lokasi ujian dapat Anda lihat pada halaman Lokasi
            Ujian. </span></td>
        
               <tr>
                 <?php
  $sql_tmpujian="select * from t_tempat_ujian";
  $query_tmpujian=mysql_query($sql_tmpujian,$koneksi);
?>
                 <td width="140" class="bg-warning">
                   Lokasi Ujian *	  </td>
                        <td width="386" class="bg-warning">
                          <select class="form-control validate-selection" name="i_temp_ujian" size="1" id="i_temp_ujian" >
						    <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_tmpujian=mysql_fetch_array($query_tmpujian))
   {;?>
                            <option value =<?php echo $row_tmpujian[KodeTmp];?>><?php echo $row_tmpujian[NamaTmp];?></option>
                            <?php }?>
                 </select>	  </td>
        </tr>

        <tr>
                 <?php
				 $data=$_GET['data'];
  $sql_info="select * from t_informasi";
  $query_info=mysql_query($sql_info,$koneksi);
?>
                        <td width="140" class="bg-warning"> Tahu Infromasi Dari * </td>
                        <td class="bg-warning">
                          <select class="form-control validate-selection" name="c_inf" size="1" id="c_inf" >
						    <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_info=mysql_fetch_array($query_info))
   {;?>
                            <option value =<?php echo $row_info[KodeInf];?>><?php echo $row_info[NamaInf];?></option>

                            <?php

							 }?>
							 	<?PHP
						if ($row_info[NamaInf]=='LAINNYA')
							{
						echo"<input name='nama_info' type='text' id='nama_info' size='30' maxlength='60'>";					  	                         }
						else
						{
							echo"<input name='nama_info' type='hidden' id='nama_info' size='30' maxlength='60'>";
						}
						?>
                        </select>


                        </td
                      ></tr>
              

               <!-- SDP2 -->
               
      </tbody>
    </table>
     <table class="table table-bordered" width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1"><b>Photo Peserta</b><br>
            Upload photo Closeup terbaru Saudara/i ( Photo Resmi ) Ukuran 3x4</span></td>
        </tr>
      
        <tr>
          <td width="140" class="bg-warning">
            Photo ( 3x4 ) 	  </td>
	                    <td width="386" class="bg-warning">
          <input name="photo" size="40" maxlength="60" type="file" class="required">	  </td>
        </tr>



     

        <!-- End Photo-->
        
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
		
}
</script>
                  <table class="table table-bordered" width="550" cellpadding="4">
                    <tbody>
                      <tr>
                        <td colspan="2" class="alert-danger"><strong>Note
                          : <font color="#666666" size="2" face="ARIAL">Tanda
                          * ( Wajib Diisi Dengan Benar )</font></strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="bg-warning"><span class="style1">Saya
                          menyatakan bahwa seluruh data yang saya isikan adalah
                          benar, dapat dipertanggungjawabkan dan telah melalui
                          persetujuan orang tua / wali. </span></td>
                      </tr>
                    
        <tr>
          <td colspan="2"class="alert-info" align="center"><input class="form-control btn btn-primary" name="submit" value="KIRIM" type="SUBMIT">	  </td>
        </tr>
      </tbody>
    </table>
</div>

</div>
        <div class="clearfix"></div>
                                </div>
                           
                        </div>
<!-- END FORM REGULAR -->
<!-- NOMOR REGISTRASI -->
<INPUT type="hidden" name="c_jalur" value="reguler" />
<INPUT type="hidden" name="i_thn_akademik" value="<?PHP echo "$row_thnakademik[1]"?>" />
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
echo "Anda Telah Melakukan Registrasi. Registrasi hanya dapat dilakukan satu kali. Terimakasih !!!.";
?>
<center>
</center>
<?PHP
}} 
if($_SESSION['jalur_pendaftaran']=="PMDK") {
$sqlCek = mysql_query("select t_calon_mahasiswa.* from t_calon_mahasiswa where t_calon_mahasiswa.i_registrasi='$_SESSION[kode_briva]'");
 if(mysql_num_rows($sqlCek)==0){
  $sql_gel="select * from t_gel where kodegel='PMDK' and status='on'";
  $query_gel=mysql_query($sql_gel,$koneksi);
  $row_gel=mysql_fetch_array($query_gel);
  if (mysql_num_rows($query_gel)>0){
	?>
     <form action=<?php echo "$aksi?module=registrasi&act=addpmdk"; ?> method=POST enctype='multipart/form-data' name="form_pmb" id="test2">
<font color="#666666" face="ARIAL" size="2">	<table width="741" cellpadding="4">
<input type=hidden name=pin value=<?php echo $_SESSION[kode_briva]; ?>>
	 <!-- GELOMBANG -->

<div class="col-lg-3 col-md-6">
                        
                    </div>
						
						
	<table class="table table-bordered " width="550" cellpadding="4">
	 
	  </table>
<!-- FORM REGULAR -->
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
  
    <div class="panel panel-primary">
        <div class="panel-heading">	 
	 
<input class="form-control"name="c_gel" value="<?PHP echo"$row_gel[1]"; ?>" type="HIDDEN">  Saat ini Saudara/i hanya dapat melakukan registrasi <?PHP echo"$row_gel[2]"; ?>	 
<br>
	                  <?PHP
  echo"$row_gel[3]";
  ?>
</div>
                          
    <div class="panel-footer">
	
	
	
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1"><b>Data Pribadi Peserta</b><br>
            Isilah data pribadi Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
    
        <tr>
          <td width="140" class="bg-warning">
            Nama Lengkap * 	  </td>
	              <td width="386" class="bg-warning">
          <input class="form-control"name="n_lengkap" type="TEXT" class="required" value="<?php echo $_SESSION['nama']; ?>" size="40" maxlength="80"></td>
        </tr>

        <tr>
          <td width="140" class="bg-warning">
            Jenis Kelamin *	  </td>
	              <td class="bg-warning">

    <input name="n_jns_kelamin" value="L" selected="" type="RADIO"> Laki-laki  <br/>
	 <input name="n_jns_kelamin" value="P" type="RADIO" class="validate-one-required"> Perempuan

</td>
        </tr>

        <tr>
          <td width="140" class="bg-warning">
            Tempat, Tanggal Lahir *	  </td>
	              <td class="bg-warning">
	                <input name="n_temp_lahir" type="TEXT" class="required" value="<?php echo $_SESSION['tmptlahir']; ?>" size="15" maxlength="40">
	                ,

	                <input name="d_lahir" type="text" class="required" value="<?php echo $_SESSION['tgllahir']; ?>" readonly>
					<input type="button" value="Cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">	  </td>
        </tr>

        <tr>
          <td width="140" class="bg-warning" valign="top">
            Alamat yang dapat Dihubungi *	  </td>
	              <td class="bg-warning">
	                <textarea name="n_alamat" rows="2" cols="30" class="required form-control"><?php echo $_SESSION['alamat']; ?></textarea>	
	                <br/>*Keterangan : Mohon isi kolom alamat dengan lengkap dengan format Jalan, No.rumah, RT/RW, Kelurahan/Kecamatan, dan lain-lain sesuai dengan format KTP
		  </td>
        </tr>
                          <tr>
          <td width="140" class="bg-warning" valign="top">
            Agama	  </td>
	              <td class="bg-warning">
	                				  <?php
  $sql_agm="select * from t_agama";
  $query_agm=mysql_query($sql_agm,$koneksi);
  ?>
				  <select name="i_agama" size="1" id="i_agama" class="validate-selection form-control">
				   <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_agm=mysql_fetch_array($query_agm))
   {;?>
                            <option value ="<?php echo $row_agm['kd_agama'];?>"><?php echo $row_agm['n_agama'];?></option>
                            <?php }?>
                    </select>

					</td>
	             </tr>

        <tr>
          <td width="140" class="bg-warning">
            Propinsi<br>
          Kabupaten / Kota *	  </td>
	              <td class="bg-warning">

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
                    </select> </td>
        </tr>
      <td width="140" class="bg-warning">
            Kode Pos *	  </td>
	              <td class="bg-warning">
	                <input class="form-control"name="c_pos" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['kdpos']; ?>" size="5" maxlength="5" >	  </td>
        </tr>

        <tr>
                        <td width="140" class="bg-warning"> Nomor Telepon * </td>
	                    <td class="bg-warning"> <input class="form-control"name="i_telp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['telp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
          <td width="140" class="bg-warning">
            Nomor Handphone/Selular *	  </td>
	              <td class="bg-warning">
	                <input class="form-control"name="i_hp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['no_tlp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
                        <td width="140" class="bg-warning"> Email * </td>
	              <td class="bg-warning">
	                <input class="form-control"name="n_email" type="TEXT" class="required validate-email" value="<?php echo $_SESSION['email']; ?>" size="25" maxlength="40"></td>
        </tr>



        

        <!-- DATA ORANGTUA -->
       
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1"><b>Data Orang Tua Peserta</b><br>
            Isilah data orang tua Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
    
        <tr>
          <td width="140" class="bg-warning">
            Nama Ayah / Wali *	  </td>
	                    <td width="386" class="bg-warning">
          <input class="form-control"name="n_ortu" type="TEXT" class="required" value="<?php echo $_SESSION['nm_ortu']; ?>" size="40" maxlength="60">	  </td>
        </tr>
		<tr>
          <td width="140" class="bg-warning">
            Nama Ibu Kandung *	  </td>
	                    <td width="386" class="bg-warning">
          <input class="form-control"name="n_ibu" type="TEXT" class="required" value="<?php echo $_SESSION['nm_ibu']; ?>" size="40" maxlength="60">	  </td>
        </tr>
        <tr>
          <td width="140" class="bg-warning">
            Jenis Pekerjaan<br>
          Orang Tua * </td>
	                    <td class="bg-warning">
<!--                         <input class="form-control"name="n_jabatan" size="30" maxlength="80" type="TEXT" class="required">
 -->						
						
  <?php
  $sql_kerja="select * from t_kerja_ortu";
  $query_kerja=mysql_query($sql_kerja,$koneksi);
  ?>
				  <select name="n_jabatan" size="1" id="n_jabatan" class="validate-selection form-control">
				   <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_kerja=mysql_fetch_array($query_kerja))
   {;?>
                            <option value ="<?php echo $row_kerja['id_kerja'];?>"><?php echo $row_kerja['n_kerja'];?></option>
                            <?php }?>
                        </select>
  </td>
        </tr>


      

        <!-- DATA SMA -->
       
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1"><b>Data SMA/MA/SMK Peserta</b><br>
            Isilah data SMA/MA/SMK asal Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      <tr>
          <td width="140" class="bg-warning">
            Nomor Induk Siswa Nasional (NISN) *	  </td>
                        <td width="386" class="bg-warning">
          <input class="form-control"name="nis" type="TEXT" class="required" value="<?php echo $_SESSION['nis']; ?>" size="30" maxlength="60">	  </td>
        </tr>
        <tr>
          <td width="140" class="bg-warning">
            Nama SMA/MA/SMK Asal *	  </td>
                        <td width="386" class="bg-warning">
          <input class="form-control"name="n_sma" type="TEXT" class="required" value="<?php echo $_SESSION['asalsma']; ?>" size="30" maxlength="60">	  </td>
        </tr>
        <tr>
          <?php
  $sql_smu="select * from t_jurusan_sma";
  $query_smu=mysql_query($sql_smu,$koneksi);
  ?>
          <td width="140" class="bg-warning">
            Jurusan SMA/MA/SMK *  </td>
                        <td class="bg-warning">
                          <select name="i_jur_sma" size="1" id="jrsnsmu" class="validate-selection form-control">
						    <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_smu=mysql_fetch_array($query_smu))
   {;?>
                            <option value ="<?php echo $row_smu['KodeSMU'];?>"><?php echo $row_smu['Keterangan'];?></option>
                            <?php }?>
                        </select>	  </td>
        </tr>
           <tr>
             <td width="140" class="bg-warning">
               Alamat SMA/MA/SMK *	  </td>
                        <td class="bg-warning">
                        <textarea name="n_alamat_sma" rows="2" cols="30" class="required form-control"><?php echo $_SESSION['alamatsma']; ?></textarea>	  </td>
        </tr>



           <tr>
             <td width="140" class="bg-warning">
               Propinsi<br>
             Kabupaten / Kota *	  </td>
                        <td class="bg-warning">
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
                            <option selected="selected">             </option>
                        </select></td>
        </tr>
        

           <!-- PILIHAN PRODI -->
       
      </tbody>
    </table>

    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1"><b>Pilihan Program Studi</b><br>
            Pilihlah program studi yang Saudara/i minati. Jumlah pilihan boleh
            satu, dua atau tiga program studi yang ada di<font size="2" face="ARIAL"> Politeknik
              Pos Indonesia</font>.	  </span></td>
        </tr>
 
  
<script language="JavaScript1.2">
function validate_pil(data) {
		var n_pil1=data.n_pil1;
		var n_pil2=data.n_pil2;
		//var n_pil3=data.n_pil3;
		if (n_pil1.value==n_pil2.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 2");
		   n_pil2.value=0;   }
		   }
}
</script>
           <tr>
<?php
function combo($var, $data) {
	echo "<select name='$var' onChange='validate_pil(this.form)'  class='validate-selection form-control'>";
	echo "<option value=0 selected>- Pilih Jurusan -</option>";
	$sql=mysql_query("select distinct t_jurusan.* from t_jurusan
left join t_daftar on t_daftar.pilihan=t_jurusan.jenjang 
where t_daftar.kode_briva='$_SESSION[kode_briva]'");
	while ($data=mysql_fetch_array($sql)){
		echo "<option value=$data[KodeJrsn]>$data[NamaJrsn]</option>";
	}
	echo "</select>";
}
?>
             <td width="140" class="bg-warning">
               Pilihan 1 *	  </td>
                        <td width="386" class="bg-warning"><?PHP combo("n_pil1",$data1); ?></td>
        </tr>
           <tr>
             <td width="140" class="bg-warning">
               Pilihan 2 *	  </td>
                        <td class="bg-warning"><?PHP combo("n_pil2",$data2); ?></td>
        </tr>
           <tr>
             <td width="140" class="bg-warning">
               Pilihan 3 *	  </td>
                        <td class="bg-warning"><?PHP combo("n_pil3",$data3); ?></td>
        </tr>
      

               <!-- LOKASI UJIAN  -->
    
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1"><b>Tahu Infromasi Dari</b><br>
            Pilihlah mengetahui Politeknik Pos Indonesia darimana.</span></td>
        </tr>
 
        <tr>
                 <?php
				 $data=$_GET['data'];
  $sql_info="select * from t_informasi";
  $query_info=mysql_query($sql_info,$koneksi);
?>
                        <td width="140" class="bg-warning"> Tahu Infromasi Dari * </td>
                        <td width="386" class="bg-warning">
                          <select name="c_inf" size="1" id="c_inf" class="validate-selection form-control">
						    <option selected="selected" value="<?php echo $_SESSION[sumber];?>">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_info=mysql_fetch_array($query_info))
   {;?>
                            <option value =<?php echo $row_info[KodeInf];?>><?php echo $row_info[NamaInf];?></option>

                            <?php

							 }?>
							 	<?PHP
						if ($row_info[NamaInf]=='LAINNYA')
							{
						echo"<input name='nama_info' type='text' id='nama_info' size='30' maxlength='60'>";					  	                         }
						else
						{
							echo"<input name='nama_info' type='hidden' id='nama_info' size='30' maxlength='60'>";
						}
						?>
                        </select>


          </td
                      ></tr>
        

               <!-- SDP2 -->
       
      </tbody>
    </table>
   
     <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1"><b>Berkas Peserta</b><br>
            Upload semua persyaratan berkas PMDK dalam format gambar (.JPG, .JPEG, .GIF, .PNG)</span></td>
        </tr>

        
 	 
      <tr>
          <td width="140" class="bg-warning">
            Nilai Raport Semester III* 	  </td>
	                    <td width="386" class="bg-warning">
          <input name="smt11" size="40" maxlength="60" type="file" class="required">	  </td>
        </tr>
     <tr>
          <td width="140" class="bg-warning">
            Nilai Raport Semester IV* 	  </td>
	                    <td width="386" class="bg-warning">
          <input name="smt12" size="40" maxlength="60" type="file" class="required">	  </td>
        </tr>
    <tr>
          <td width="140" class="bg-warning">
            Photo ( 3x4 )* 	  </td>
	                    <td width="386" class="bg-warning">
          <input name="photo" size="40" maxlength="60" type="file" class="required">	  </td>
        </tr>
        <!-- End Photo-->
 
      </tbody>
    </table>
<script language="JavaScript1.2">
function validate_pil(data) {
		var n_pil1=data.n_pil1;
		var n_pil2=data.n_pil2;
		//var n_pil3=data.n_pil3;
		if (n_pil1.value==n_pil2.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 2");
		   n_pil2.value=0;   }
		   }
		
}
</script>
                  <table class="table table-bordered" width="550" cellpadding="4">
                    <tbody>
                      <tr>
                        <td colspan="2" class="alert-danger"><strong>Note
                          : <font color="#666666" size="2" face="ARIAL">Tanda
                          * ( Wajib Diisi Dengan Benar )</font></strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="bg-warning">Saya
                          menyatakan bahwa seluruh data yang saya isikan adalah
                          benar, dapat dipertanggungjawabkan dan telah melalui
                          persetujuan orang tua / wali. </td>
                      </tr>
                    </tbody>
                  </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="panel-yellow" align="center"><input class="form-control btn btn-primary" name="submit" value="KIRIM" type="SUBMIT">	  </td>
        </tr>
      </tbody>
    </table>
	
</div>

</div>
        <div class="clearfix"></div>
                                </div>
                           
                        </div>
<!-- NOMOR REGISTRASI -->
<INPUT type="hidden" name="c_jalur" value="PMDK" />
<INPUT type="hidden" name="i_thn_akademik" value="<?PHP echo "$row_thnakademik[1]"?>" />
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
echo "Anda Telah Melakukan Registrasi. Registrasi hanya dapat dilakukan satu kali. Terimakasih !!!.";
?>
<center>
  
</center>
<?PHP
}}

  if ($_SESSION['jalur_pendaftaran']=="Undangan"){
   $sqlCek = mysql_query("select t_calon_mahasiswa.*,t_gel.namagel as nama_gel from t_calon_mahasiswa inner join t_gel on t_calon_mahasiswa.c_gel=t_gel.kodegel where t_calon_mahasiswa.i_registrasi='$_SESSION[kode_briva]'");
 if(mysql_num_rows($sqlCek)==0){
  ?>
  
	<form method=POST name="form_pmb" enctype='multipart/form-data' action=<?php echo "$aksi?module=registrasi&act=addundangan"; ?> id="test">
<font color="#666666" face="ARIAL" size="2">	<table width="741" cellpadding="4">
<input type=hidden name=pin value=<?php echo $_SESSION[kode_briva]; ?>>
	 <!-- GELOMBANG -->
<div class="col-lg-3 col-md-6">
                        
                    </div>
						
						
	<table class="table table-bordered " width="550" cellpadding="4">
	 
	  </table>
<!-- FORM Undangan -->
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
  
    <div class="panel panel-primary">
        <div class="panel-heading">
                              
			<b>
	                  <?php
  $sql_gel="select * from t_gel where status='on' and jalur='Undangan'";
  $query_gel=mysql_query($sql_gel,$koneksi);
  $row_gel=mysql_fetch_array($query_gel);
  echo"$row_gel[3]";
  ?>	</b>		  
        </div>
                          
    <div class="panel-footer">
                                  
    
	   
	         
	          <input class="form-control"name="c_gel" value="<?PHP echo"$row_gel[1]"; ?>" type="HIDDEN">


	    <!-- DATA PRIBADI -->
	 
	  </tbody>
	</table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style"><b>Data Pribadi Peserta</b><br>
            Isilah data pribadi Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
     
        <tr>
          <td width="140" class="bg-warning">
            Nama Lengkap * 	  </td>
	              <td width="386" class="bg-warning">
          <input class="form-control required" name="n_lengkap" type="TEXT"  value="<?php echo $_SESSION['nama']; ?>" size="40" maxlength="80"></td>
        </tr>

        <tr>
          <td width="140" class="bg-warning">
            Jenis Kelamin *	  </td>
	              <td class="bg-warning">
	                <input  name="n_jns_kelamin" value="L" selected="" type="RADIO" class="validate-one-required">&nbsp Laki-laki <br>
	                <input  name="n_jns_kelamin" value="P" type="RADIO" class="validate-one-required">&nbsp Perempuan	  </td>
        </tr>

        <tr>
          <td width="140" class="bg-warning">
            Tempat, Tanggal Lahir *	  </td>
	              <td class="bg-warning">
	                <input class="required"name="n_temp_lahir" type="TEXT"  value="<?php echo $_SESSION['tmptlahir']; ?>" size="15" maxlength="40">
	               

	                <input class="required"name="d_lahir" type="text"  value="<?php echo $_SESSION['tgllahir']; ?>" readonly>
				<input  type="button" value="cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">	  </td>
        </tr>

        <tr>
          <td width="140" class="bg-warning" valign="top">
            Alamat yang dapat Dihubungi *	  </td>
	              <td class="bg-warning">
	                <textarea class="form-control required" name="n_alamat" rows="2" cols="30" ><?php echo $_SESSION['alamat']; ?></textarea>
	                *Keterangan : Mohon isi kolom alamat dengan lengkap dengan format Jalan, No.rumah, RT/RW, Kelurahan/Kecamatan, dan lain-lain sesuai dengan format KTP
		  </td>
        </tr>
                 <tr>
          <td width="140" class="bg-warning" valign="top">
            Agama	  </td>
	              <td class="bg-warning">
				  <?php
  $sql_agm="select * from t_agama";
  $query_agm=mysql_query($sql_agm,$koneksi);
  ?>
				  <select class="form-control validate-selection" name="i_agama" size="1" id="i_agama" >
				   <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_agm=mysql_fetch_array($query_agm))
   {;?>
                            <option value ="<?php echo $row_agm['kd_agama'];?>"><?php echo $row_agm['n_agama'];?></option>
                            <?php }?>
                        </select>
				   </td>
	             </tr>

        <tr>
          <td width="140" class="bg-warning">
            Propinsiw<br>
          Kabupaten / Kota *	  </td>
	              <td class="bg-warning">
	                 <select class="validate-selection" name="n_propinsi" onChange="showKab()">
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
                    </select> </td>
        </tr>
        <tr>
          <td width="140" class="bg-warning">
            Kode Pos *	  </td>
	              <td class="bg-warning">
	                <input class="form-control validate-number required"name="c_pos" type="TEXT"  value="<?php echo $_SESSION['kdpos']; ?>" size="5" maxlength="5" >	  </td>
        </tr>

        <tr>
                        <td width="140" class="bg-warning"> Nomor Telepon * </td>
	                    <td class="bg-warning"> <input class="form-control validate-number required"name="i_telp" type="TEXT"  value="<?php echo $_SESSION['telp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
          <td width="140" class="bg-warning">
            Nomor Handphone/Selular *	  </td>
	              <td class="bg-warning">
	                <input class="form-control validate-number required"name="i_hp" type="TEXT"  value="<?php echo $_SESSION['no_tlp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
                        <td width="140" class="bg-warning"> Email * </td>
	              <td class="bg-warning">
	                <input class="form-control required validate-email"name="n_email" type="TEXT"  value="<?php echo $_SESSION['email']; ?>" size="25" maxlength="40"></td>
        </tr>

        <!-- DATA ORANGTUA -->
        
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1" ><b>Data Orang Tua Peserta</b><br>
            Isilah data orang tua Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      
        <tr>
          <td width="140" class="bg-warning">
            Nama Ayah / Wali *	  </td>
	                    <td width="386" class="bg-warning">
          <input class="form-control required"name="n_ortu" type="TEXT"  value="<?php echo $_SESSION['nm_ortu']; ?>" size="40" maxlength="60">	  </td>
        </tr>
		<tr>
          <td width="140" class="bg-warning">
            Nama Ibu Kandung *	  </td>
	                    <td width="386" class="bg-warning">
          <input class="form-control required"name="n_ibu" type="TEXT"  value="<?php echo $_SESSION['nm_ibu']; ?>" size="40" maxlength="60">	  </td>
        </tr>
        <tr>
          <td width="140" class="bg-warning">
            Jenis Pekerjaan<br>
          Orang Tua * </td>
	                    <td class="bg-warning">
	                     <?php
  $sql_kerja="select * from t_kerja_ortu";
  $query_kerja=mysql_query($sql_kerja,$koneksi);
  ?>
				  <select class="form-control validate-selection" name="n_jabatan" size="1" id="n_jabatan" >
				   <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_kerja=mysql_fetch_array($query_kerja))
   {;?>
                            <option value ="<?php echo $row_kerja['id_kerja'];?>"><?php echo $row_kerja['n_kerja'];?></option>
                            <?php }?>
                        </select>
  </td>
        </tr>

        <!-- DATA SMA -->
        
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1"><b>Data SMA/MA/SMK Peserta</b><br>
            Isilah data SMA/MA/SMK asal Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      <tr>
          <td width="140" class="bg-warning">
            Nomor Induk Siswa Nasional (NISN) *	  </td>
                        <td width="386" class="bg-warning">
          <input class="form-control"name="nis" type="TEXT" class="required" value="<?php echo $_SESSION['nis']; ?>" size="30" maxlength="60">	  </td>
        </tr>
        <tr>
          <td width="140" class="bg-warning">
            Nama SMA/MA/SMK Asal *	  </td>
                        <td width="386" class="bg-warning">
          <input class="form-control required"name="n_sma" type="TEXT"  value="<?php echo $_SESSION['asalsma']; ?>" size="30" maxlength="60">	  </td>
        </tr>
        <tr>
          <?php
  $sql_smu="select * from t_jurusan_sma";
  $query_smu=mysql_query($sql_smu,$koneksi);
  ?>
          <td width="140" class="bg-warning">
            Jurusan SMA/MA/SMK *  </td>
                        <td class="bg-warning">
                          <select class="form-control validate-selection" name="i_jur_sma" size="1" id="i_jur_sma" >
						    <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_smu=mysql_fetch_array($query_smu))
   {;?>
                            <option value ="<?php echo $row_smu['KodeSMU'];?>"><?php echo $row_smu['Keterangan'];?></option>
                            <?php }?>
                        </select>	  </td>
        </tr>
           <tr>
             <td width="140" class="bg-warning">
               Alamat SMA/MA/SMK *	  </td>
                        <td class="bg-warning">
                        <textarea class="form-control required" name="n_alamat_sma" rows="2" cols="30" ><?php echo $_SESSION['alamatsma']; ?></textarea>	  </td>
        </tr>



           <tr>
             <td width="140" class="bg-warning">
               Propinsiw<br>
             Kabupaten / Kota *	  </td>
                        <td class="bg-warning">
<select class="validate-selection" name="n_prop_sma" onChange="showKab2()">
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
       

           <!-- PILIHAN PRODI -->
           
      </tbody>
    </table>
  
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1"><b>Pilihan Program Studi</b><br>
            Pilihlah program studi yang Saudara/i minati. Jumlah pilihan boleh
            satu, dua atau tiga program studi yang ada di Politeknik
              Pos Indonesia.	  </span></td>
        </tr>
     
<script language="JavaScript1.2">
function validate_pil(data) {
		var n_pil1=data.n_pil1;
		var n_pil2=data.n_pil2;
		
		if (n_pil1.value==n_pil2.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 2");
		   n_pil2.value=0;   }
		   }
		
}
</script>
           <tr>
<?php
function combo($var, $data) {
	echo "<select class='form-control validate-selection'  name='$var' onChange='validate_pil(this.form)'>";
	echo "<option value=0 selected>- Pilih Jurusan -</option>";
	$sql=mysql_query("select distinct t_jurusan.* from t_jurusan
left join t_daftar on t_daftar.pilihan=t_jurusan.jenjang 
where t_daftar.kode_briva='$_SESSION[kode_briva]'");
	while ($data=mysql_fetch_array($sql)){

		echo "<option value=$data[KodeJrsn]>$data[NamaJrsn]</option>";
	}
	echo "</select>";
}
?>
             <td width="140" class="bg-warning">
               Pilihan 1 *	  </td>
                        <td width="386" class="bg-warning"><?PHP combo("n_pil1",$data1); ?></td>
        </tr>
           <tr>
             <td width="140" class="bg-warning">
               Pilihan 2 *	  </td>
                        <td class="bg-warning"><?PHP combo("n_pil2",$data2); ?></td>
        </tr>
           <tr>
             <td width="140" class="bg-warning">
               Pilihan 3 *	  </td>
                        <td class="bg-warning"><?PHP combo("n_pil3",$data3); ?></td>
        </tr>
       

               <!-- LOKASI UJIAN  -->
               
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
<tr>
          <td colspan="2" class="alert-info"><span class="style1"><b>Informasi Poltekpos atau Stimlog</b><br>
            Pilih darimana informasi mengenai Poltekpos atau Stimlog diperoleh</span></td>
        </tr>
        <tr>
                 <?php
				 $data=$_GET['data'];
  $sql_info="select * from t_informasi";
  $query_info=mysql_query($sql_info,$koneksi);
?>
                        <td width="140" class="bg-warning"> Tahu Infromasi Dari * </td>
                        <td class="bg-warning" width="386">
                          <select class="form-control validate-selection" name="c_inf" size="1" id="c_inf" >
						    <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_info=mysql_fetch_array($query_info))
   {;?>
                            <option value =<?php echo $row_info[KodeInf];?>><?php echo $row_info[NamaInf];?></option>

                            <?php

							 }?>
							 	<?PHP
						if ($row_info[NamaInf]=='LAINNYA')
							{
						echo"<input name='nama_info' type='text' id='nama_info' size='30' maxlength='60'>";					  	                         }
						else
						{
							echo"<input name='nama_info' type='hidden' id='nama_info' size='30' maxlength='60'>";
						}
						?>
                        </select>


                        </td
                      ></tr>
              

               <!-- SDP2 -->
               
      </tbody>
    </table>
     <table class="table table-bordered" width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" class="alert-info"><span class="style1"><b>Photo Peserta</b><br>
            Upload photo Closeup terbaru Saudara/i ( Photo Resmi ) Ukuran 3x4</span></td>
        </tr>
      
        <tr>
          <td width="140" class="bg-warning">
            Photo ( 3x4 ) 	  </td>
	                    <td width="386" class="bg-warning">
          <input name="photo" size="40" maxlength="60" type="file" class="required">	  </td>
        </tr>

        

        <tr>
          <td width="140" class="bg-warning">
            Surat Undangan 	  </td>
	                    <td width="386" class="bg-warning">
          <input name="surat" size="40" maxlength="60" type="file" class="required">	  </td>
        </tr>

        <!-- End Photo-->
        
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
		
}
</script>
                  <table class="table table-bordered" width="550" cellpadding="4">
                    <tbody>
                      <tr>
                        <td colspan="2" class="alert-danger"><strong>Note
                          : <font color="#666666" size="2" face="ARIAL">Tanda
                          * ( Wajib Diisi Dengan Benar )</font></strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="bg-warning"><span class="style1">Saya
                          menyatakan bahwa seluruh data yang saya isikan adalah
                          benar, dapat dipertanggungjawabkan dan telah melalui
                          persetujuan orang tua / wali. </span></td>
                      </tr>
                    
        <tr>
          <td colspan="2"class="alert-info" align="center"><input class="form-control btn btn-primary" name="submit" value="KIRIM" type="SUBMIT">	  </td>
        </tr>
      </tbody>
    </table>
</div>

</div>
        <div class="clearfix"></div>
                                </div>
                           
                        </div>
<!-- END FORM undangan -->
<!-- NOMOR REGISTRASI -->
<INPUT type="hidden" name="c_jalur" value="Undangan" />
<INPUT type="hidden" name="i_thn_akademik" value="<?PHP echo "$row_thnakademik[1]"?>" />
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
echo "Anda Telah Melakukan Registrasi. Registrasi hanya dapat dilakukan satu kali. Terimakasih !!!.";
?>
<center>
</center>
<?PHP
}} 

    break;
    case "checkreg" :
 $lokasi_file    = $_FILES['photo']['tmp_name'];
  $tipe_file      = $_FILES['photo']['type'];
  $nama_file      = $_FILES['photo']['name'];
  $dir = "../foto/";
  $nama_baru = $_POST['pin'];
  if ($tipe_file =="image/png"){
  $tipe= ".png";
  } elseif ($tipe_file =="image/jpeg"){
  $tipe= ".jpg";
  } elseif ($tipe_file =="image/gif"){
  $tipe= ".gif";
  } 
  $foto_baru = $dir.$nama_baru.$tipe;
  move_uploaded_file($lokasi_file , $foto_baru);

    session_register('nama');
    session_register('jk');
    session_register('tmptlahir');
    session_register('tgllahir');
    session_register('alamat');
    session_register('agama');
    session_register('propinsi');
    session_register('kabupaten');
    session_register('kdpos');
    session_register('telp');
    session_register('hp');
    session_register('email');
    session_register('nm_ortu');
	session_register('nm_ibu');
    session_register('jbt_ortu');
	session_register('nis');
    session_register('asalsma');
    session_register('jurasal');
    session_register('alamatsma');
    session_register('propsma');
    session_register('kabsma');
    session_register('pil1');
    session_register('pil2');
    session_register('pil3');
    session_register('lokuji');
    session_register('asalinfo');
    session_register('sk');
    session_register('foto');
	session_register('akad');
    $_SESSION['nama'] = $_POST['n_lengkap'];
    $_SESSION['jk'] = $_POST['n_jns_kelamin'];
    $_SESSION['tmptlahir'] = $_POST['n_temp_lahir'];
    $_SESSION['tgllahir'] = $_POST['d_lahir'];
    $_SESSION['alamat'] = $_POST['n_alamat'];
    $_SESSION['agama'] = $_POST['i_agama'];
    $_SESSION['propinsi'] = $_POST['n_propinsi'];
    $_SESSION['kabupaten'] = $_POST['n_kabupaten'];
    $_SESSION['kdpos'] = $_POST['c_pos'];
    $_SESSION['telp'] = $_POST['i_telp'];
    $_SESSION['hp'] = $_POST['i_hp'];
    $_SESSION['email'] = $_POST['n_email'];
    $_SESSION['nm_ortu'] = $_POST['n_ortu'];
	$_SESSION['nm_ibu'] = $_POST['n_ibu'];
    $_SESSION['jbt_ortu'] = $_POST['n_jabatan'];
	$_SESSION['nis'] = $_POST['nis'];
    $_SESSION['asalsma'] = $_POST['n_sma'];
    $_SESSION['jurasal'] = $_POST['i_jur_sma'];
    $_SESSION['alamatsma'] = $_POST['n_alamat_sma'];
    $_SESSION['propsma'] = $_POST['n_prop_sma'];
    $_SESSION['kabsma'] = $_POST['n_kab_sma'];
    $_SESSION['pil1'] = $_POST['n_pil1'];
    $_SESSION['pil2'] = $_POST['n_pil2'];
    $_SESSION['pil3'] = $_POST['n_pil3'];
    $_SESSION['lokuji'] = $_POST['i_temp_ujian'];
    $_SESSION['asalinfo'] = $_POST['c_inf'];
    $_SESSION['sk'] = $_POST['q_sdp2'];
     $_SESSION['foto'] = $foto_baru;
	 $_SESSION['akad'] = $_POST['i_thn_akademik'];
?>
<form method=POST enctype='multipart/form-data' action=<?php echo "$aksi?module=registrasi&act=addreguler"; ?>>
<h2>Silahkan cek kembali data Pribadi anda sebelum melakukan submit data. Pastikan semua data telah terisi dengan benar.</h2>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="panel-yellow"><span class="style1"><b>Data Pribadi Peserta</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="221" class="bg-warning">
            Nama Lengkap * 	  </td>

	              <td width="496" class="bg-warning">
	                <input class="form-control"name="n_lengkap" type="TEXT" class="required" value="<?php echo $_SESSION['nama']; ?>" size="40" maxlength="80" readonly></td>
        </tr>

        <tr>
          <td width="221" class="bg-warning">
            Jenis Kelamin *	  </td>
          <td class="bg-warning"><input name="n_jns_kelamin" type="text" id="n_jns_kelamin" value="<?php echo $_SESSION['jk']; ?>" readonly/></td>
        </tr>

        <tr>
          <td width="221" class="bg-warning">
            Tempat, Tanggal Lahir *	  </td>
	              <td class="bg-warning">
	                <input class="form-control"name="n_temp_lahir" type="TEXT" class="required" value="<?php echo $_SESSION['tmptlahir']; ?>" size="15" maxlength="40" readonly>
	                ,

	                <input class="form-control"name="d_lahir" type="text" class="required" value="<?php echo $_SESSION['tmptlahir']; ?>" readonly>

					<input type="button" value="Cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">	  </td>
        </tr>

        <tr>
          <td width="221" class="bg-warning" valign="top">
            Alamat yang dapat Dihubungi *	  </td>
          <td class="bg-warning">
          <textarea name="n_alamat" rows="2" cols="30" class="required" readonly><?php echo $_SESSION['alamat']; ?></textarea></td>

        </tr>
                 <tr>
          <td width="221" class="bg-warning" valign="top">
            Agama	  </td>
	              <td class="bg-warning"><input name="i_agama" type="text" id="i_agama" value="<?php echo $_SESSION['agama']; ?>" readonly/></td>
	             </tr>

        <tr>

          <td width="221" class="bg-warning">
            Propinsi<br>
            Kabupaten / Kota *	  </td>
          <td class="bg-warning">

	                <input class="form-control"name="n_propinsi" type="text" id="n_propinsi" value="<?php echo $_SESSION['propinsi']; ?>" readonly/>
	                /
	                <input class="form-control"name="n_kabupaten" type="text" id="n_kabupaten" value="<?php echo $_SESSION['kabupaten']; ?>" readonly/></td>
        </tr>
        <tr>

          <td width="221" class="bg-warning">
            Kode Pos *	  </td>
	              <td class="bg-warning">
	                <input class="form-control"name="c_pos" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['kdpos']; ?>" size="5" maxlength="5" readonly>	  </td>
        </tr>

        <tr>
                        <td width="221" class="bg-warning"> Nomor Telepon * </td>

	                    <td class="bg-warning"> <input class="form-control"name="i_telp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['telp']; ?>" size="15" maxlength="20" readonly></td>
        </tr>

        <tr>
          <td width="221" class="bg-warning">
            Nomor Handphone/Selular *	  </td>
	              <td class="bg-warning">
	                <input class="form-control"name="i_hp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['no_tlp']; ?>" size="15" maxlength="20" readonly></td>

        </tr>

        <tr>
                        <td width="221" class="bg-warning"> Email * </td>
	              <td class="bg-warning">
	                <input class="form-control"name="n_email" type="TEXT" class="required validate-email" value="<?php echo $_SESSION['email']; ?>" size="25" maxlength="40" readonly></td>
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
          <td colspan="2" class="panel-yellow"><span class="style1"><b>Data Orang Tua Peserta</b>.	  </span></td>
        </tr>
      </tbody>

    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" class="bg-warning">
            Nama Ayah / Wali *	  </td>
	                    <td class="bg-warning">
                        <input class="form-control"name="n_ortu" type="TEXT" class="required" readonly value="<?php echo $_SESSION['nm_ortu']; ?>" size="40" maxlength="60">	  </td>

        </tr>
		<tr>
          <td width="210" class="bg-warning">
            Nama Ibu Kandung *	  </td>
	                    <td class="bg-warning">
                        <input class="form-control"name="n_ibu" type="TEXT" class="required" readonly value="<?php echo $_SESSION['nm_ibu']; ?>" size="40" maxlength="60">	  </td>

        </tr>
        <tr>
          <td width="210" class="bg-warning">
            Jenis Pekerjaan<br>
                          Orang Tua * </td>
	                    <td class="bg-warning"><input name="n_jabatan" type="text" id="n_jabatan" readonly value="<?php echo $_SESSION['jbt_ortu']; ?>" /></td>

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
          <td colspan="2" class="panel-yellow"><span class="style1"><b>Data SMA/MA/SMK Peserta</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
	  <tr>
          <td width="210" class="bg-warning">
            Nomor Induk Siswa Nasional (NISN) *	  </td>
	                    <td class="bg-warning">
                        <input class="form-control"name="nis" type="TEXT" class="required" readonly value="<?php echo $_SESSION['nis']; ?>" size="40" maxlength="60">	  </td>

        </tr>
        <tr>
          <td width="210" class="bg-warning">
            Nama SMA/MA/SMK Asal *	  </td>

                        <td class="bg-warning">
                        <input class="form-control"name="n_sma" type="TEXT" class="required" value="<?php echo $_SESSION['asalsma']; ?>" size="30" maxlength="60" readonly>	  </td>
        </tr>
        <tr>
                    <td width="210" class="bg-warning">
            Jurusan SMA/MA/SMK *  </td>
                        <td class="bg-warning"><input name="i_agama5" type="text" id="i_agama5" value="<?php echo $_SESSION['jurasal']; ?>" readonly/></td>

        </tr>
           <tr>
             <td width="210" class="bg-warning">
               Alamat SMA/MA/SMK *	  </td>
                        <td class="bg-warning">
                        <textarea name="n_alamat_sma" rows="2" cols="30" class="required" readonly><?php echo $_SESSION['alamatsma']; ?></textarea>	  </td>
        </tr>



           <tr>
             <td width="210" class="bg-warning">
               Propinsi<br>
               Kabupaten / Kota *	  </td>
             <td class="bg-warning"><input name="n_prop_sma" type="text" id="n_prop_sma" value="<?php echo $_SESSION['propsma']; ?>" readonly/>
               /
                        <input class="form-control"name="n_kab_sma" type="text" id="n_kab_sma" value="<?php echo $_SESSION['kabsma']; ?>" readonly/></td>
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
          <td colspan="2" class="panel-yellow"><span class="style1"><b>Pilihan Program Studi</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
           <tr>
             <td width="210" class="bg-warning">
               Pilihan 1 *	  </td>
                        <td class="bg-warning"><input name="n_pil1" type="text" id="n_pil1" value="<?php echo $_SESSION['pil1']; ?>" readonly/></td>

        </tr>
           <tr>
             <td width="210" class="bg-warning">
               Pilihan 2 *	  </td>
                        <td class="bg-warning"><input name="n_pil2" type="text" id="n_pil2" value="<?php echo $_SESSION['pil2']; ?>" readonly/></td>

        </tr>
           <tr>
             <td width="210" class="bg-warning">
               Pilihan 3 *	  </td>
                        <td class="bg-warning"><input name="n_pil3" type="text" id="n_pil3" value="<?php echo $_SESSION['pil3']; ?>" readonly/></td>

        </tr>
        <tr>
          <td colspan="2" height="4"></td>
        </tr>

               <!-- LOKASI UJIAN  -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>

      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="panel-yellow"><span class="style1"><b>Lokasi Ujian</b></span></td>
        </tr>

      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
               <tr>
                                  <td width="210" class="bg-warning">
                   Lokasi Ujian *	  </td>
                        <td class="bg-warning"><input name="i_temp_ujian" type="text" id="i_temp_ujian" value="<?php echo $_SESSION['lokuji']; ?>" readonly/></td>
        </tr>

        <tr>
                                         <td width="210" class="bg-warning"> Tahu Infromasi Dari * </td>
                        <td class="bg-warning"><input name="c_inf" type="text" id="c_inf" value="<?php echo $_SESSION['asalinfo']; ?>" readonly/></td
                      ></tr>
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- SDP2 -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>

        <tr>
          <td colspan="2" class="panel-yellow"><span class="style1"><b>Jumlah SK</b>.</span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>

               <tr>
                 <td width="210" class="bg-warning">
                   Sumbangan Sukarela Sebesar
                   *<br>
                   <br>	  </td>
                        <td class="bg-warning">
                   			<div id="advice-validate-currency-dollar-field5" class="custom-advice" style="display:none">Cukup isikan besaran SDP2 dalam angka bernominal rupiah, tanpa tanda baca.</div>
							<input name="q_sdp2" class="validate-currency-dollar required validate-rupiah validate-digit" id="q_sdp2" value="<?php echo $_SESSION['sk']; ?>" maxlength="8" readonly/>

                			</div>
       <!--
	   Rp.
	   <input class="form-control"TYPE="TEXT" NAME"sdp2j" SIZE="3" MAXLENGTH="3" onclick="validateInt()">.
	   -->	  </td>
        </tr>
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- NILAI PRESTASI LAIN -->
               <tr>

                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
	<table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="panel-yellow"><span class="style1"><b>Photo Peserta PMB</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" class="bg-warning">
            Photo	  </td>

                        <td class="bg-warning">
                        <img src="<?php echo $_SESSION['foto'];?>" width="150" height="175"/>	  </td>
        </tr>

           <!-- PILIHAN PRODI -->
           <tr>

             <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="panel-yellow" align="center"><a href="?module=registrasi"><input name="button" value=" Ubah Data " type="SUBMIT"></a></td>
		  <td colspan="2" class="panel-yellow" align="center"><input name="submit" value=" Register PMB " type="SUBMIT">	  </td>
        </tr>

      </tbody>
    </table>
</font>

<!-- NOMOR REGISTRASI -->
<INPUT type="hidden" name="pin" value="<?php echo $_SESSION['pin']; ?>" />
<INPUT type="hidden" name="c_gel" value="<?php echo $_POST['c_gel']; ?>" />
<INPUT type="hidden" name="photo" value="<?php echo $_SESSION['foto']; ?>" />
<INPUT type="hidden" name="c_jalur" value="reguler" />
<INPUT type="hidden" name="i_thn_akademik" value="<?php echo $_SESSION['akad']; ?>" />
</form>
</td>
 </tr>
</tbody></table>


</form>
<?php
    break;
	    case "checkpmdk" :
 $lokasi_file    = $_FILES['photo']['tmp_name'];
  $tipe_file      = $_FILES['photo']['type'];
  $nama_file      = $_FILES['photo']['name'];
  $dir = "../foto/";
  $nama_baru = $_POST['pin'];
  if ($tipe_file =="image/png"){
  $tipe= ".png";
  } elseif ($tipe_file =="image/jpeg"){
  $tipe= ".jpg";
  } elseif ($tipe_file =="image/gif"){
  $tipe= ".gif";
  } 
  $foto_baru = $dir.$nama_baru.$tipe;
  copy($lokasi_file , $foto_baru);
    session_register('nama');
    session_register('jk');
    session_register('tmptlahir');
    session_register('tgllahir');
    session_register('alamat');
    session_register('agama');
    session_register('propinsi');
    session_register('kabupaten');
    session_register('kdpos');
    session_register('telp');
    session_register('hp');
    session_register('email');
    session_register('nm_ortu');
	session_register('nm_ibu');
    session_register('jbt_ortu');
	session_register('nis');
    session_register('asalsma');
    session_register('jurasal');
    session_register('alamatsma');
    session_register('propsma');
    session_register('kabsma');
    session_register('pil1');
    session_register('pil2');
    session_register('pil3');
    session_register('lokuji');
    session_register('asalinfo');
    session_register('sk');
    session_register('foto');
	session_register('akad');
	session_register('rata2_XI_2');
	session_register('mtk_XI_2');
	session_register('ing_XI_2');
	session_register('rata2_XII_1');
	session_register('mtk_XII_1');
	session_register('ing_XII_1');
    $_SESSION['nama'] = $_POST['n_lengkap'];
    $_SESSION['jk'] = $_POST['n_jns_kelamin'];
    $_SESSION['tmptlahir'] = $_POST['n_temp_lahir'];
    $_SESSION['tgllahir'] = $_POST['d_lahir'];
    $_SESSION['alamat'] = $_POST['n_alamat'];
    $_SESSION['agama'] = $_POST['i_agama'];
    $_SESSION['propinsi'] = $_POST['n_propinsi'];
    $_SESSION['kabupaten'] = $_POST['n_kabupaten'];
    $_SESSION['kdpos'] = $_POST['c_pos'];
    $_SESSION['telp'] = $_POST['i_telp'];
    $_SESSION['hp'] = $_POST['i_hp'];
    $_SESSION['email'] = $_POST['n_email'];
    $_SESSION['nm_ortu'] = $_POST['n_ortu'];
	$_SESSION['nm_ibu'] = $_POST['n_ibu'];
    $_SESSION['jbt_ortu'] = $_POST['n_jabatan'];
	$_SESSION['nis'] = $_POST['nis'];
    $_SESSION['asalsma'] = $_POST['n_sma'];
    $_SESSION['jurasal'] = $_POST['i_jur_sma'];
    $_SESSION['alamatsma'] = $_POST['n_alamat_sma'];
    $_SESSION['propsma'] = $_POST['n_prop_sma'];
    $_SESSION['kabsma'] = $_POST['n_kab_sma'];
    $_SESSION['pil1'] = $_POST['n_pil1'];
    $_SESSION['pil2'] = $_POST['n_pil2'];
    $_SESSION['pil3'] = $_POST['n_pil3'];
    $_SESSION['lokuji'] = $_POST['i_temp_ujian'];
    $_SESSION['asalinfo'] = $_POST['c_inf'];
    $_SESSION['sk'] = $_POST['q_sdp2'];
     $_SESSION['foto'] = $foto_baru;
	 $_SESSION['akad'] = $_POST['i_thn_akademik'];
	 $_SESSION['rata2_XI_2'] = $_POST['rata2_XI_2'];
	 $_SESSION['mtk_XI_2'] = $_POST['mtk_XI_2'];
	 $_SESSION['ing_XI_2'] = $_POST['ing_XI_2'];
	 $_SESSION['rata2_XII_1'] = $_POST['rata2_XII_1'];
	 $_SESSION['mtk_XII_1'] = $_POST['mtk_XII_1'];
	 $_SESSION['ing_XII_1'] = $_POST['ing_XII_1'];
?>
<form method=POST enctype='multipart/form-data' action=<?php echo "$aksi?module=registrasi&act=addpmdk"; ?>>
<h2>Silahkan cek kembali data Pribadi anda sebelum melakukan submit data. Pastikan semua data telah terisi dengan benar.</h2>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="panel-yellow"><span class="style1"><b>Data Pribadi Peserta</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="221" class="bg-warning">
            Nama Lengkap * 	  </td>

	              <td width="496" class="bg-warning">
	                <input class="form-control"name="n_lengkap" type="TEXT" class="required" value="<?php echo $_SESSION['nama']; ?>" size="40" maxlength="80" readonly></td>
        </tr>

        <tr>
          <td width="221" class="bg-warning">
            Jenis Kelamin *	  </td>
          <td class="bg-warning">
		  <input class="form-control"name="n_jns_kelamin" type="text" id="n_jns_kelamin" value="<?php echo $_SESSION['jk']; ?>" readonly/></td>
        </tr>

        <tr>
          <td width="221" class="bg-warning">
            Tempat, Tanggal Lahir *	  </td>
	              <td class="bg-warning">
	                <input class="form-control"name="n_temp_lahir" type="TEXT" class="required" value="<?php echo $_SESSION['tmptlahir']; ?>" size="15" maxlength="40" readonly>
	                ,

	                <input class="form-control"name="d_lahir" type="text" class="required" value="<?php echo $_SESSION['tgllahir']; ?>" readonly>

					<input type="button" value="Cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">	  </td>
        </tr>

        <tr>
          <td width="221" class="bg-warning" valign="top">
            Alamat yang dapat Dihubungi *	  </td>
          <td class="bg-warning">
          <textarea name="n_alamat" rows="2" cols="30" class="required" readonly><?php echo $_SESSION['alamat']; ?></textarea></td>

        </tr>
                 <tr>
          <td width="221" class="bg-warning" valign="top">
            Agama	  </td>
	              <td class="bg-warning"><input name="i_agama" type="text" id="i_agama" value="<?php echo $_SESSION['agama']; ?>" readonly/></td>
	             </tr>

        <tr>

          <td width="221" class="bg-warning">
            Propinsi<br>
            Kabupaten / Kota *	  </td>
          <td class="bg-warning">

	                <input class="form-control"name="n_propinsi" type="text" id="n_propinsi" value="<?php echo $_SESSION['propinsi']; ?>" readonly/>
	                /
	                <input class="form-control"name="n_kabupaten" type="text" id="n_kabupaten" value="<?php echo $_SESSION['kabupaten']; ?>" readonly/></td>
        </tr>
        <tr>

          <td width="221" class="bg-warning">
            Kode Pos *	  </td>
	              <td class="bg-warning">
	                <input class="form-control"name="c_pos" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['kdpos']; ?>" size="5" maxlength="5" readonly>	  </td>
        </tr>

        <tr>
                        <td width="221" class="bg-warning"> Nomor Telepon * </td>

	                    <td class="bg-warning"> <input class="form-control"name="i_telp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['telp']; ?>" size="15" maxlength="20" readonly></td>
        </tr>

        <tr>
          <td width="221" class="bg-warning">
            Nomor Handphone/Selular *	  </td>
	              <td class="bg-warning">
	                <input class="form-control"name="i_hp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['no_tlp']; ?>" size="15" maxlength="20" readonly></td>

        </tr>

        <tr>
                        <td width="221" class="bg-warning"> Email * </td>
	              <td class="bg-warning">
	                <input class="form-control"name="n_email" type="TEXT" class="required validate-email" value="<?php echo $_SESSION['email']; ?>" size="25" maxlength="40" readonly></td>
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
          <td colspan="2" class="panel-yellow"><span class="style1"><b>Data Orang Tua Peserta</b></span></td>
        </tr>
      </tbody>

    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" class="bg-warning">
            Nama Ayah / Wali *	  </td>
	                    <td class="bg-warning">
                        <input class="form-control"name="n_ortu" type="TEXT" class="required" readonly value="<?php echo $_SESSION['nm_ortu']; ?>" size="40" maxlength="60">	  </td>

        </tr>
		<tr>
          <td width="210" class="bg-warning">
            Nama Ibu Kandung *	  </td>
	                    <td class="bg-warning">
                        <input class="form-control"name="n_ibu" type="TEXT" class="required" readonly value="<?php echo $_SESSION['nm_ibu']; ?>" size="40" maxlength="60">	  </td>

        </tr>
        <tr>
          <td width="210" class="bg-warning">
            Jenis Pekerjaan<br>
                          Orang Tua * </td>
	                    <td class="bg-warning"><input name="n_jabatan" type="text" id="n_jabatan" readonly value="<?php echo $_SESSION['jbt_ortu']; ?>" /></td>

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
          <td height="46" colspan="2" class="panel-yellow"><span class="style1"><b>Data SMA/MA/SMK Peserta</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
	  <tr>
          <td width="210" class="bg-warning">
            Nomor Induk Siswa Nasional (NISN) *	  </td>
	                    <td class="bg-warning">
                        <input class="form-control"name="nis" type="TEXT" class="required" readonly value="<?php echo $_SESSION['nis']; ?>" size="40" maxlength="60">	  </td>

        </tr>
        <tr>
          <td width="210" class="bg-warning">
            Nama SMA/MA/SMK Asal *	  </td>

                        <td class="bg-warning">
                        <input class="form-control"name="n_sma" type="TEXT" class="required" value="<?php echo $_SESSION['asalsma']; ?>" size="30" maxlength="60" readonly>	  </td>
        </tr>
        <tr>
                    <td width="210" class="bg-warning">
            Jurusan SMA/MA/SMK *  </td>
                        <td class="bg-warning"><input name="i_agama5" type="text" id="i_agama5" value="<?php echo $_SESSION['jurasal']; ?>" readonly/></td>

        </tr>
           <tr>
             <td width="210" class="bg-warning">
               Alamat SMA/MA/SMK *	  </td>
                        <td class="bg-warning">
                        <textarea name="n_alamat_sma" rows="2" cols="30" class="required" readonly><?php echo $_SESSION['alamatsma']; ?></textarea>	  </td>
        </tr>



           <tr>
             <td width="210" class="bg-warning">
               Propinsi<br>
               Kabupaten / Kota *	  </td>
             <td class="bg-warning"><input name="n_prop_sma" type="text" id="n_prop_sma" value="<?php echo $_SESSION['propsma']; ?>" readonly/>
               /
                        <input class="form-control"name="n_kab_sma" type="text" id="n_kab_sma" value="<?php echo $_SESSION['kabsma']; ?>" readonly/></td>
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
          <td colspan="2" class="panel-yellow"><span class="style1"><b>Pilihan Program Studi</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
           <tr>
             <td width="210" class="bg-warning">
               Pilihan 1 *	  </td>
                        <td class="bg-warning"><input name="n_pil1" type="text" id="n_pil1" value="<?php echo $_SESSION['pil1']; ?>" readonly/></td>

        </tr>
           <tr>
             <td width="210" class="bg-warning">
               Pilihan 2 *	  </td>
                        <td class="bg-warning"><input name="n_pil2" type="text" id="n_pil2" value="<?php echo $_SESSION['pil2']; ?>" readonly/></td>

        </tr>
           <tr>
             <td width="210" class="bg-warning">
               Pilihan 3 *	  </td>
                        <td class="bg-warning"><input name="n_pil3" type="text" id="n_pil3" value="<?php echo $_SESSION['pil3']; ?>" readonly/></td>

        </tr>
        <tr>
          <td colspan="2" height="4"></td>
        </tr>

               <!-- LOKASI UJIAN  -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>

      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="panel-yellow"><span class="style1"><b>Lokasi Ujian</b></span></td>
        </tr>

      </tbody>
    </table>
	 <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="panel-yellow"><span class="style1"><b>Data Nilai Calon Mahasiswa</b></span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
                        <td width="210" class="bg-warning"> Nilai Rata-rata kelas XI semester
                          2 * </td>
	                    <td class="bg-warning">
                        <input class="form-control"name="rata2_XI_2" size="4" maxlength="4" type="TEXT" class="validate-number required required validate-rata" value="<?php echo $_SESSION['rata2_XI_2']; ?>" readonly>
                       contoh:90,75 ditulis 9075; 4,1 ditulis 0410 </td>
        </tr>

        <tr>
                        <td width="210" class="bg-warning"> Nilai Matematika kelas XI semester
                          2 *</td>
	                    <td class="bg-warning">
                        <input class="form-control"name="mtk_XI_2" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $_SESSION['mtk_XI_2']; ?>" readonly>
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
        </tr>

        <tr>
                        <td width="210" class="bg-warning"> Nilai Bhs.Inggris kelas XI semester
                          2 * </td>
	                    <td class="bg-warning">
                        <input class="form-control"name="ing_XI_2" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $_SESSION['ing_XI_2']; ?>" readonly>
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
        </tr>
					  <tr>
					  </tr>
					  <tr>
					  </tr>
          <tr>
                        <td width="210" class="bg-warning"> Nilai Rata-rata kelas XII semester
                          1 * </td>
	                    <td class="bg-warning">
                        <input class="form-control"name="rata2_XII_1" size="4" maxlength="4" type="TEXT" class="validate-number required required validate-rata" value="<?php echo $_SESSION['rata2_XII_1']; ?>" readonly>
                        contoh:90,75 ditulis 9075; 4,1 ditulis 0410 </td>
        </tr>
					     <tr>
                        <td width="210" class="bg-warning"> Nilai Matematika kelas XII semester
                          1 * </td>
	                    <td class="bg-warning">
                        <input class="form-control"name="mtk_XII_1" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $_SESSION['mtk_XII_1']; ?>" readonly>
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
                      </tr>
           <tr>
                        <td width="210" class="bg-warning"> Nilai Bhs.Inggris kelas XII semester
                          1 * </td>
	                    <td class="bg-warning">
                        <input class="form-control"name="ing_XII_1" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $_SESSION['ing_XII_1']; ?>" readonly>
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
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
                                         <td width="210" class="bg-warning"> Tahu Infromasi Dari * </td>
                        <td class="bg-warning"><input name="c_inf" type="text" id="c_inf" value="<?php echo $_SESSION['asalinfo']; ?>" readonly/></td
                      ></tr>
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- SDP2 -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
	<table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" class="panel-yellow"><span class="style1"><b>Photo Peserta PMB</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" class="bg-warning">
            Photo	  </td>

                        <td class="bg-warning">
                        <img src="<?php echo $_SESSION['foto'];?>" width="150" height="175"/>	  </td>
        </tr>

           <!-- PILIHAN PRODI -->
           <tr>

             <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
		  <td colspan="2" class="panel-yellow" align="center"><input name="submit" value=" KIRIM " type="SUBMIT">	  </td>
        </tr>

      </tbody>
    </table>
</font>

<!-- NOMOR REGISTRASI -->
<INPUT type="hidden" name="pin" value="<?php echo $_SESSION['pin']; ?>" />
<INPUT type="hidden" name="c_gel" value="<?php echo $_POST['c_gel']; ?>" />
<INPUT type="hidden" name="photo" value="<?php echo $_SESSION['foto']; ?>" />
<INPUT type="hidden" name="c_jalur" value="PMDK" />
<INPUT type="hidden" name="i_thn_akademik" value="<?php echo $_SESSION['akad']; ?>" />
</form>
</td>
 </tr>
</tbody></table>


</form>
<?php
    break;
}
}
?>
