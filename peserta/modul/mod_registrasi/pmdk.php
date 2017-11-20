<form method=POST name="form_pmb" enctype='multipart/form-data' action=<?php echo "$aksi?module=registrasi&act=addpmdk"; ?> id="test">
    <input type=hidden name="pin" value=<?php echo $_SESSION['kode_briva']; ?>>
    <input type="hidden" name="c_jalur" value="<?php echo $rdata['c_jalur'] ?>" />
    <input type="hidden" name="i_thn_akademik" value="<?PHP echo $rdata['i_thn_akademik']?>" />
    <input class="form-control" name="c_gel" value="<?PHP echo $rdata['KodeGel']; ?>" type="HIDDEN">
    <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">

            <b><?php echo $rdata['NamaGel']; ?> - (JALUR <?php echo $rdata['nama_jalur'] ?>) </b>
          </div>
        </div>
        <div class="col-md-12">
          <b>Data Pribadi Peserta</b>
        </div>
        <div class="col-md-12">
          Isilah data pribadi Saudara/i dengan lengkap dan benar.
        </div>
        <div class="col-md-4">
          Nama Lengkap *
        </div>
        <div class="col-md-8">
          <input class="form-control required" name="n_lengkap" type="TEXT"  value="<?php echo $rdata['n_lengkap']; ?>" size="40" maxlength="80">
        </div>
        <div class="col-md-4">
          Jenis Kelamin *
        </div>
        <div class="col-md-4">
          <input name="n_jns_kelamin" value="L" <?php if($rdata['n_jns_kelamin'] == "L") { echo "checked";} ?> type="RADIO" class="validate-one-required"> Laki-laki 
          <input  name="n_jns_kelamin" value="P" <?php if($rdata['n_jns_kelamin'] == "P") { echo "checked";} ?> type="RADIO" class="validate-one-required"> Perempuan
        </div>
        <div class="col-md-4">
          
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
          Tempat, Tanggal Lahir *
        </div>
        <div class="col-md-3">
          <input class="required form-control" name="n_temp_lahir" type="TEXT"  value="<?php echo $rdata['n_temp_lahir']; ?>" size="15" maxlength="40">
        </div>
        <div class="col-md-3">
          <input class="required form-control" name="d_lahir" type="text"  value="<?php echo $rdata['d_lahir']; ?>" readonly>
        </div>
        <div class="col-md-2">
          <input  type="button" value="cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">
        </div>
        <div class="col-md-4">
          Alamat yang dapat Dihubungi *
        </div>
        <div class="col-md-8">
          <textarea class="form-control required" name="n_alamat" rows="2" cols="30" ><?php echo $rdata['n_alamat']; ?></textarea>
          <div class="clearfix"></div>
          <p>*Keterangan : Mohon isi kolom alamat dengan lengkap dengan format Jalan, No.rumah, RT/RW, Kelurahan/Kecamatan, dan lain-lain sesuai dengan format KTP</p>
        </div>
        <div class="col-md-4">
          Agama
        </div>
        <div class="col-md-8">
          <select class="form-control validate-selection" name="n_agama" size="1" id="i_agama">
            <option value=''>--Pilih Agama--</option>
            <?php
                 $query = "SELECT * FROM t_agama";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    if($rdata['n_agama'] == $data['kd_agama']) {
                      echo "<option value='".$data['kd_agama']."' selected>".$data['n_agama']."</option>";  
                    } else {
                      echo "<option value='".$data['kd_agama']."'>".$data['n_agama']."</option>";
                    }
                    
                 }
            ?>
          </select>
        </div>
        <div class="col-md-4">
          Propinsi / Kabupaten Kota *
        </div>
        <div class="col-md-4">
          <select class="form-control validate-selection" name="n_propinsi" onChange="showKab()">
            <option value=''>--Pilih Propinsi--</option>
            <?php
                 $query = "SELECT * FROM t_prop";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    if($rdata['n_propinsi'] == $data['kd_prop']) {
                      echo "<option value='".$data['kd_prop']."' selected>".$data['nama_prop']."</option>";  
                    } else {
                      echo "<option value='".$data['kd_prop']."'>".$data['nama_prop']."</option>";  
                    }
                 }
            ?>
          </select>
        </div>
        <div class="col-md-4">
          <select class="form-control validate-selection" name="n_kabupaten" id="n_kabupaten">
            <option value=''>--Pilih Kota Kabupaten--</option>
            <?php
                 $query = "SELECT * FROM t_kab";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    if($rdata['n_kabupaten'] == $data['kd_kab']) {
                      echo "<option value='".$data['kd_kab']."' selected>".$data['nama_kab']."</option>";  
                    } else {
                      echo "<option value='".$data['kd_kab']."'>".$data['nama_kab']."</option>";  
                    }
                 }
            ?>
          </select>
        </div>
        <div class="col-md-4">
          Kode Pos *
        </div>
        <div class="col-md-8">
          <input class="form-control validate-number required" name="c_pos" type="TEXT"  value="<?php echo $rdata['c_pos']; ?>" size="5" maxlength="5" >
        </div>
        <div class="col-md-4">
          Nomor Telepon *
        </div>
        <div class="col-md-8">
          <input class="form-control validate-number required" name="i_telp" type="TEXT"  value="<?php echo $rdata['i_telp']; ?>" size="15" maxlength="20">
        </div>
        <div class="col-md-4">
          Nomor Handphone/Selular *
        </div>
        <div class="col-md-8">
          <input class="form-control validate-number required" name="i_hp" type="TEXT"  value="<?php echo $rdata['i_hp']; ?>" size="15" maxlength="20">
        </div>
        <div class="col-md-4">
          Email *
        </div>
        <div class="col-md-8">
          <input class="form-control required validate-email" name="n_email" type="TEXT"  value="<?php echo $rdata['n_email']; ?>" size="25" maxlength="40">
        </div>
        <div class="col-md-12">
          <b>Data Orang Tua Peserta</b>
        </div>
        <div class="col-md-12">
          Isilah data orang tua Saudara/i dengan lengkap dan benar.
        </div>
        <div class="col-md-4">
          Nama Orang Ayah / Wali *
        </div>
        <div class="col-md-8">
          <input class="form-control required" name="n_ortu" type="TEXT"  value="<?php echo $rdata['n_ortu']; ?>" size="40" maxlength="60">
        </div>
        <div class="col-md-4">
          Nama Ibu Kandung *
        </div>
        <div class="col-md-8">
          <input class="form-control required" name="n_ibu" type="TEXT"  value="<?php echo $rdata['n_ibu']; ?>" size="40" maxlength="60">
        </div>
        <div class="col-md-4">
          Jenis Pekerjaan Orang Tua
        </div>
        <div class="col-md-8">
          <select class="form-control validate-selection" name="n_jabatan" size="1" id="n_jabatan" >
            <option value=''>--Pilih Jenis Pekerjaan--</option>
            <?php
                 $query = "SELECT * FROM t_kerja_ortu";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    if($rdata['n_jabatan'] == $data['id_kerja']) {
                      echo "<option value='".$data['id_kerja']."' selected>".$data['n_kerja']."</option>";  
                    } else {
                      echo "<option value='".$data['id_kerja']."'>".$data['n_kerja']."</option>";  
                    }
                 }
            ?>
          </select>
        </div>
        <div class="col-md-12">
          <b>Data SMA/MA/SMK Peserta</b><br>
            Isilah data SMA/MA/SMK asal Saudara/i dengan lengkap dan benar.
        </div>
        <div class="col-md-4">
          Nomor Induk Siswa Nasional (NISN) *
        </div>
        <div class="col-md-8">
          <input class="form-control required" name="nis" type="TEXT"  value="<?php echo $rdata['nis']; ?>" size="30" maxlength="60">
        </div>
        <div class="col-md-4">
          Nama SMA/MA/SMK Asal *
        </div>
        <div class="col-md-8">
          <input class="form-control required"name="n_sma" type="TEXT"  value="<?php echo $rdata['n_sma']; ?>" size="30" maxlength="60">
        </div>
        <div class="col-md-4">
          Jurusan SMA/MA/SMK * 
        </div>
        <div class="col-md-8">
          <select class="form-control validate-selection" name="i_jur_sma" size="1" id="i_jur_sma" >
            <option value=''>--Pilih Jurusan SMA/MA/SMK--</option>
              <?php
                 $query = "SELECT * FROM t_jurusan_sma";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    if($rdata['i_jur_sma'] == $data['Id_sma']) {
                      echo "<option value='".$data['Id_sma']."' selected>".$data['KodeSMU']."</option>";  
                    } else {
                      echo "<option value='".$data['Id_sma']."'>".$data['KodeSMU']."</option>";  
                    }
                 }
              ?>
          </select>
        </div>
        <div class="col-md-4">
          Alamat SMA/MA/SMK *
        </div>
        <div class="col-md-8">
          <textarea class="form-control required" name="n_alamat_sma" rows="2" cols="30" ><?php echo $rdata['n_alamat_sma']; ?></textarea>
        </div>
        <div class="col-md-4">
          Propinsi / Kabupaten Kota *
        </div>
        <div class="col-md-4">
          <select class="form-control validate-selection" name="n_prop_sma" onChange="showKab2()">
          <option>Silakan Pilih</option>
          <?php
                 
                 $query = "SELECT * FROM t_prop";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    if($rdata['n_prop_sma'] == $data['kd_prop']) {
                      echo "<option value='".$data['kd_prop']."' selected>".$data['nama_prop']."</option>";  
                    } else {
                      echo "<option value='".$data['kd_prop']."'>".$data['nama_prop']."</option>";  
                    }
                    echo "<option value='".$data['kd_prop']."'>".$data['nama_prop']."</option>";
                 }
          ?>
          </select>
        </div>
        <div class="col-md-4">
          <select class="form-control validate-selection" name="n_kab_sma" id="n_kab_sma">
            <option>Silakan Pilih</option>
            <?php
                 
                 $query = "SELECT * FROM t_kab";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    if($rdata['n_kab_sma'] == $data['kd_kab']) {
                      echo "<option value='".$data['kd_kab']."' selected>".$data['nama_kab']."</option>";  
                    } else {
                      echo "<option value='".$data['kd_kab']."'>".$data['nama_kab']."</option>";  
                    }
                 }
            ?>
          </select>
        </div>
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
        <div class="col-md-12">
          <p><b>Pilihan Program Studi</b><br>
            Pilihlah program studi yang Saudara/i minati. Jumlah pilihan boleh
            satu, dua atau tiga program studi yang ada di Politeknik
              Pos Indonesia.</p>
        </div>
        <div class="col-md-4">
          Pilihan 1 *
        </div>
        <div class="col-md-8">
          <?PHP combo("n_pil1",isset($data1)); ?>
        </div>
        <div class="col-md-4">
          Pilihan 2 *
        </div>
        <div class="col-md-8">
          <?PHP combo("n_pil2",isset($data2)); ?>
        </div>
        <div class="col-md-4">
          Pilihan 3 *
        </div>
        <div class="col-md-8">
          <?PHP combo("n_pil3",isset($data3)); ?>
        </div>
        <script type="text/javascript">
          function showInput(event) {
            if (event.value == "11") {
              document.getElementById("inputLain").style.display = "block";
            } else {
              document.getElementById("inputLain").style.display = "none";
            }
          }
        </script>
        <div class="col-md-12">
          <p><b>Lokasi Ujian</b><br>
              Pilihlah lokasi ujian tempat Saudara/i akan melakukan Ujian Saringan Masuk.
              Informasi wilayah lokasi ujian dapat Anda lihat pada halaman Lokasi
              Ujian.</p>
        </div>
        <div class="col-md-4">Lokasi Ujian *</div>
        <div class="col-md-8">
          <select class="form-control validate-selection" name="i_temp_ujian" size="1" id="i_temp_ujian">
            <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
            <?php
                   
                   $query = "SELECT * FROM t_tempat_ujian";
                   $hasil = mysql_query($query);
                   while ($data = mysql_fetch_array($hasil))
                   {
                    echo "<option value='".$data['KodeTmp']."'>".$data['NamaTmp']."</option>";
                   }
            ?>
          </select>
        </div>
        <div class="col-md-4">
          Tahu Infromasi Dari *
        </div>
        <div class="col-md-8">
          <select class="form-control validate-selection" name="c_inf" size="1" id="c_inf" onChange="showInput(this)">
            <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
            <?php
                   $query = "SELECT * FROM t_informasi";
                   $hasil = mysql_query($query);
                   while ($data = mysql_fetch_array($hasil))
                   {
                      echo "<option value='".$data['KodeInf']."'>".$data['NamaInf']."</option>";
                   }
                   
            ?>
          </select>
          <div id="inputLain" style="display: none; margin: 10px 0px;">
            <input class="form-control" name='nama_info' type='text' id='nama_info' size='30' maxlength='60'>
          </div>
        </div>
        <div class="col-md-4">
          Nilai Matematika Semester 3
        </div>
        <div class="col-md-8">
          <input class="form-control validate-number required" name="c_nilai_mtk_3" type="TEXT">
        </div>
        <div class="col-md-4">
          Nilai Matematika Semester 4
        </div>
        <div class="col-md-8">
          <input class="form-control validate-number required" name="c_nilai_mtk_4" type="TEXT">
        </div>
        <div class="col-md-4">
          Nilai Bahasa Inggris Semester 3
        </div>
        <div class="col-md-8">
          <input class="form-control validate-number required" name="c_nilai_inggris_3" type="TEXT">
        </div>
        <div class="col-md-4">
          Nilai Bahasa Inggris Semester 4
        </div>
        <div class="col-md-8">
          <input class="form-control validate-number required" name="c_nilai_inggris_4" type="TEXT">
        </div>
        <div class="col-md-4">
          Photo ( 3x4 )
        </div>
        <div class="col-md-8">
          <input name="photo" size="40" maxlength="60" type="file" class="required">
        </div>
        <div class="col-md-4">
          Upload Scan Raport Semester 3
        </div>
        <div class="col-md-8">
          <input name="smt11" size="40" maxlength="60" type="file" class="required">
        </div>
        <div class="col-md-4">
          Upload Scan Raport Semester 4
        </div>
        <div class="col-md-8">
          <input name="smt12" size="40" maxlength="60" type="file" class="required">
        </div>
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
        <div class="col-md-12">
          <strong>Note : <font color="#666666" size="2" face="ARIAL">Tanda * ( Wajib Diisi Dengan Benar )</font></strong>
        </div>
        <div class="col-md-12">
          <p>Saya menyatakan bahwa seluruh data yang saya isikan adalah benar, dapat dipertanggungjawabkan dan telah melalui persetujuan orang tua / wali.</p> 
        </div>
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
        <div class="col-md-12">
          <input class="form-control btn btn-primary" name="submit" value="KIRIM" type="SUBMIT"> 
        </div>
  </div>

  </form>