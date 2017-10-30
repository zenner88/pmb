<table class="table table-bordered" width="550" cellpadding="4">
	  <tbody>
	    <tr>
	      <td width="140" bgcolor="#dddddd">
	        Gelombang	  </td>
	        <td width="386" bgcolor="#eeeeee">
	          <!--
	   <INPUT TYPE="HIDDEN" NAME="gelombang" VALUE="1">Gelombang I
	   <BR>
	   -->
	          <input name="c_gel" value="<? echo"$row_gel[1]"; ?>" type="HIDDEN">  <? echo"$row_gel[2]"; ?>
  </td>
        </tr>
	    <tr>
	      <td colspan="2" height="4"></td>
        </tr>

	    <!-- DATA PRIBADI -->
	    <tr>
	      <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
	  </tbody>
	</table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Pribadi Peserta</b><br>
            Isilah data pribadi Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Nama Lengkap * 	  </td>
	              <td width="386" bgcolor="#eeeeee">
          <input name="n_lengkap" type="TEXT" class="required" value="<?php echo $_SESSION['nama']; ?>" size="40" maxlength="80"></td>
        </tr>

        <tr>
          <td width="140" bgcolor="#dddddd">
            Jenis Kelamin *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_jns_kelamin" value="L" selected="" type="RADIO" class="validate-one-required">Laki-laki
	                <br>
	                <input name="n_jns_kelamin" value="P" type="RADIO" class="validate-one-required">Perempuan	  </td>
        </tr>

        <tr>
          <td width="140" bgcolor="#dddddd">
            Tempat, Tanggal Lahir *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_temp_lahir" type="TEXT" class="required" value="<?php echo $_SESSION['tmptlahir']; ?>" size="15" maxlength="40">
	                ,

	                <input name="d_lahir" type="text" class="required" value="<?php echo $_SESSION['tgllahir']; ?>" readonly>
					<input type="button" value="Cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">	  </td>
        </tr>

        <tr>
          <td width="140" bgcolor="#dddddd" valign="top">
            Alamat yang dapat Dihubungi *	  </td>
	              <td bgcolor="#eeeeee">
	                <textarea name="n_alamat" rows="2" cols="30" class="required"><?php echo $_SESSION['alamat']; ?></textarea>
	                *Keterangan : Mohon isi kolom alamat dengan lengkap dengan format Jalan, No.rumah, RT/RW, Kelurahan/Kecamatan, dan lain-lain sesuai dengan format KTP
		  </td>
        </tr>
                 <tr>
          <td width="140" bgcolor="#dddddd" valign="top">
            Agama	  </td>
	              <td bgcolor="#eeeeee">
				  <?php
  $sql_agm="select * from t_agama";
  $query_agm=mysql_query($sql_agm,$koneksi);
  ?>
				  <select name="i_agama" size="1" id="i_agama" class="validate-selection">
				   <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_agm=mysql_fetch_array($query_agm))
   {;?>
                            <option value ="<?php echo $row_agm['kd_agama'];?>"><?php echo $row_agm['n_agama'];?></option>
                            <?php }?>
                        </select>
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
                    </select> </td>
        </tr>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Kode Pos *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="c_pos" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['kdpos']; ?>" size="5" maxlength="5" >	  </td>
        </tr>

        <tr>
                        <td width="140" bgcolor="#dddddd"> Nomor Telepon * </td>
	                    <td bgcolor="#eeeeee"> <input name="i_telp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['telp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
          <td width="140" bgcolor="#dddddd">
            Nomor Handphone/Selular *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="i_hp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['hp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
                        <td width="140" bgcolor="#dddddd"> Email * </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_email" type="TEXT" class="required validate-email" value="<?php echo $_SESSION['email']; ?>" size="25" maxlength="40"></td>
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
    <table class="table table-bordered" width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Orang Tua Peserta</b><br>
            Isilah data orang tua Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Nama Orang Tua *	  </td>
	                    <td width="386" bgcolor="#eeeeee">
          <input name="n_ortu" type="TEXT" class="required" value="<?php echo $_SESSION['nm_ortu']; ?>" size="40" maxlength="60">	  </td>
        </tr>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Jenis Pekerjaan<br>
          Orang Tua * </td>
	                    <td bgcolor="#eeeeee">
	                     <?php
  $sql_kerja="select * from t_kerja_ortu";
  $query_kerja=mysql_query($sql_kerja,$koneksi);
  ?>
				  <select name="n_jabatan" size="1" id="n_jabatan" class="validate-selection">
				   <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_kerja=mysql_fetch_array($query_kerja))
   {;?>
                            <option value ="<?php echo $row_kerja['id_kerja'];?>"><?php echo $row_kerja['n_kerja'];?></option>
                            <?php }?>
                        </select>
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
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data SMA/MA/SMK Peserta</b><br>
            Isilah data SMA/MA/SMK asal Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="140" bgcolor="#dddddd">
            Nama SMA/MA/SMK Asal *	  </td>
                        <td width="386" bgcolor="#eeeeee">
          <input name="n_sma" type="TEXT" class="required" value="<?php echo $_SESSION['asalsma']; ?>" size="30" maxlength="60">	  </td>
        </tr>
        <tr>
          <?php
  $sql_smu="select * from t_jurusan_sma";
  $query_smu=mysql_query($sql_smu,$koneksi);
  ?>
          <td width="140" bgcolor="#dddddd">
            Jurusan SMA/MA/SMK *  </td>
                        <td bgcolor="#eeeeee">
                          <select name="i_jur_sma" size="1" id="i_jur_sma" class="validate-selection">
						    <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_smu=mysql_fetch_array($query_smu))
   {;?>
                            <option value ="<?php echo $row_smu['KodeSMU'];?>"><?php echo $row_smu['Keterangan'];?></option>
                            <?php }?>
                        </select>	  </td>
        </tr>
           <tr>
             <td width="140" bgcolor="#dddddd">
               Alamat SMA/MA/SMK *	  </td>
                        <td bgcolor="#eeeeee">
                        <textarea name="n_alamat_sma" rows="2" cols="30" class="required"><?php echo $_SESSION['alamatsma']; ?></textarea>	  </td>
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
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>          </tr>
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Pilihan Program Studi</b><br>
            Pilihlah program studi yang Saudara/i minati. Jumlah pilihan boleh
            satu, dua atau tiga program studi yang ada di<font size="2" face="ARIAL"> Politeknik
              Pos Indonesia</font>.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
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
           <tr>
<?php
function combo($var, $data) {
	echo "<select name='$var' onChange='validate_pil(this.form)'  class='validate-selection'>";
	echo "<option value=0 selected>- Pilih Jurusan -</option>";
	$sql=mysql_query("select * from t_jurusan");
	while ($data=mysql_fetch_array($sql)){
		echo "<option value=$data[KodeJrsn]>$data[NamaJrsn]</option>";
	}
	echo "</select>";
}
?>
             <td width="140" bgcolor="#dddddd">
               Pilihan 1 *	  </td>
                        <td width="386" bgcolor="#eeeeee"><? combo("n_pil1",$data1); ?></td>
        </tr>
           <tr>
             <td width="140" bgcolor="#dddddd">
               Pilihan 2 *	  </td>
                        <td bgcolor="#eeeeee"><? combo("n_pil2",$data2); ?></td>
        </tr>
           <tr>
             <td width="140" bgcolor="#dddddd">
               Pilihan 3 *	  </td>
                        <td bgcolor="#eeeeee"><? combo("n_pil3",$data3); ?></td>
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
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Lokasi Ujian</b><br>
            Pilihlah lokasi ujian tempat Saudara/i akan melakukan Ujian Saringan Masuk.
            Informasi wilayah lokasi ujian dapat Anda lihat pada halaman Lokasi
            Ujian. </span></td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
               <tr>
                 <?php
  $sql_tmpujian="select * from t_tempat_ujian";
  $query_tmpujian=mysql_query($sql_tmpujian,$koneksi);
?>
                 <td width="140" bgcolor="#dddddd">
                   Lokasi Ujian *	  </td>
                        <td width="386" bgcolor="#eeeeee">
                          <select name="i_temp_ujian" size="1" id="i_temp_ujian" class="validate-selection">
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
                        <td width="140" bgcolor="#dddddd"> Tahu Informasi Dari * </td>
                        <td bgcolor="#eeeeee">
                          <select name="c_inf" size="1" id="c_inf" class="validate-selection">
						    <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_info=mysql_fetch_array($query_info))
   {;?>
                            <option value =<?php echo $row_info[KodeInf];?>><?php echo $row_info[NamaInf];?></option>

                            <?php

							 }?>
							 	<?
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
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- SDP2 -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
     <table class="table table-bordered" width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Photo Peserta</b><br>
            Upload photo Closeup terbaru Saudara/i ( Photo Resmi ) Ukuran 3x4</span></td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered" width="550" cellpadding="4">
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
                  <table class="table table-bordered" width="550" cellpadding="4">
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
    <table class="table table-bordered" width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C" align="center"><input name="submit" value="KIRIM" type="SUBMIT">	  </td>
        </tr>
      </tbody>
    </table>