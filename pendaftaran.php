<?php
include "config/koneksi.php";
?>
<!-- CSS -->
<!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500"> -->
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/form-elements.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
<!-- Top content -->
<div class="container">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 form-box">
			<form role="form" name="form_pmb" enctype='multipart/form-data' action="daftar/validasi.php" method="post" class="f1">

				<h3>Pendaftaran Mahasiswa Baru 2017/2018</h3>
				<div class="f1-steps">
					<div class="f1-progress">
						<div class="f1-progress-line" data-now-value="12.5" data-number-of-steps="4" style="width: 12.5%;"></div>
					</div>
					<div class="f1-step active">
						<div class="f1-step-icon"><i class="fa fa-arrows"></i></div>
						<p>Jalur</p>
					</div>
					<div class="f1-step">
						<div class="f1-step-icon"><i class="fa fa-user"></i></div>
						<p>Data Diri</p>
					</div>
					<div class="f1-step">
						<div class="f1-step-icon"><i class="fa fa-users"></i></div>
						<p>Data Orang Tua</p>
					</div>
					<div class="f1-step">
						<div class="f1-step-icon"><i class="fa fa-bank"></i></div>
						<p>Data Sekolah</p>
					</div>
				</div>
				
				<fieldset>
					<h4>Pilih Jalur Pendaftaran:</h4>
					<div class="form-group">
						<?php
							$sql_jalur="SELECT * FROM jalur_pendaftaran where status=1";
							$query_jalur=mysql_query($sql_jalur);
							while ($xx =mysql_fetch_array($query_jalur))
							{;?>
							<input type="radio" class="form-radio" id="pilihan" name="jalur_pendaftaran" value="<?=$xx['id'];?>" checked/>
							<i class="fa fa-key"></i><label> <?=$xx['nama_jalur'];?> </label>
							<BR>
						<?php }?>
					</div>
					<div class="f1-buttons">
						<button type="button" class="btn btn-next">Next</button>
					</div>
				</fieldset>

				<fieldset>
					<h4>Data Calon Mahasiswa:</h4>
					<div class="form-group">
						<?php
						function combo($var, $data) {
							echo "<select multiple class='form-control validate-selection form-control' name='$var' onChange='validate_pil(this.form)'>";
							$sql=mysql_query("select * from t_jurusan");
							while ($data=mysql_fetch_array($sql)){
								echo "<option value=$data[KodeJrsn]>$data[NamaJrsn]</option>";
							}
							echo "</select>";
						}
						?>
						<label for="1">Pilihan Program Studi 1 *</label>
						<?PHP combo("n_pil1",isset($data1)); ?>
						<label for="1">Pilihan Program Studi 2 *</label>
						<?PHP combo("n_pil2",isset($data2)); ?>
						<label for="1">Pilihan Program Studi 3 *</label>
						<?PHP combo("n_pil3",isset($data3)); ?>
					</div>
					<div class="form-group">
						<label  for="f1-nama">Nama Lengkap</label>
						<input type="text" name="nama" placeholder="Nama Lengkap" class="f1-nama form-control" id="f1-nama">
					</div>
					<div class="form-group">
						<label for="1">Jenis Kelamin *</label><BR>						
						<label class="form-check-label">
						<input class="form-radio" type="radio" name="n_jns_kelamin" id="inlineRadio1" value="L" checked> Laki-laki
						</label>

						<label class="form-check-label">
						<input class="form-radio" type="radio" name="n_jns_kelamin" id="inlineRadio2" value="P"> Perempuan
						</label>
					</div>
					<div class="form-group">
						<label  for="f1-nisn">NISN</label>
						<input type="text" name="nis" placeholder="NISN" class="form-control" id="f1-nisn">
					</div>
					<div class="form-group">
						<label  for="f1-nisn">Tempat Lahir</label>
						<input type="text" name="n_tempat_lahir" placeholder="Tempat Lahir" class="form-control" id="f1-nisn">
					</div>
					<div class="input-group date" data-provide="datepicker">
						<input type="text" name="d_lahir" class="form-control" placeholder="Tanggal Lahir">
						<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
					</div>
					<div class="form-group">
						<label for="1">Agama *</label>						
						<?php
						$sql_agm="select * from t_agama";
						$query_agm=mysql_query($sql_agm);
						?>
						<select multiple name="n_agama"  id="i_agama" class="validate-selection form-control">
						<?php while ($row_agm=mysql_fetch_array($query_agm))
						{;?>
                            <option value ="<?php echo $row_agm['kd_agama'];?>"><?php echo $row_agm['n_agama'];?></option>
                            <?php }?>
						</select>
					</div>	
					<div class="form-group">
						<label for="1">Alamat Lengkap *</label>				
						<textarea class="form-control" name="n_alamat" id="exampleFormControlTextarea1" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label for="1">Propinsi *</label>				
						<select multiple class="form-control" name="n_propinsi" onChange="showKab()">
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
						<label for="1">Kabupaten / Kota *</label>				
						<select multiple class="form-control" name="n_kabupaten" id="n_kabupaten">
							<option selected="selected"> </option>
						</select> 
					</div>					
					<div class="form-group">
						<label  for="f1-nisn">Kode Pos</label>
						<input type="text" name="c_pos" placeholder="Kode Pos" class="form-control" id="f1-nisn">
					</div>
					<div class="form-group">
						<label  for="f1-nisn">No Telephone/HP</label>
						<input type="text" name="no_tlp" placeholder="No Telephone/HP" class="form-control" id="f1-nisn">
					</div>
					<div class="form-group">
						<label  for="f1-nisn">No KTP/NIK</label>
						<input type="text" name="ktp" placeholder="No KTP/NIK" class="form-control" id="f1-nisn">
					</div>
					<div class="form-group">
						<label  for="f1-nisn">Pin BBM/ ID Line</label>
						<input type="text" name="bbm" placeholder="Pin BBM/ ID Line" class="form-control" id="f1-nisn">
					</div>
					<div class="form-group">
						<label  for="f1-nisn">Alamat Email</label>
						<input type="text" name="email" placeholder="Alamat Email" class="form-control" id="f1-nisn">
					</div>
					<BR>
					<div class="f1-buttons">
						<button type="button" class="btn btn-previous">Previous</button>
						<button type="button" class="btn btn-next">Next</button>
					</div>
				</fieldset>
				
				<fieldset>
					<h4>Data Orang Tua:</h4>
					<div class="form-group">
						<label  for="f1-nisn">Nama Ayah Kandung *</label>
						<input type="text" name="n_ortu" placeholder="Nama Ayah Kandung" class="form-control" id="f1-nisn">
						</div>
					<div class="form-group">
						<label  for="f1-nisn">Nama Ibu Kandung *</label>
						<input type="text" name="n_ibu" placeholder="Nama Ibu Kandung" class="form-control" id="f1-nisn">
					</div>
					<div class="form-group">
						<label for="1">Pekerjaan orang Tua/ Wali *</label>						
						<?php
						$sql_agm="select * from t_kerja_ortu";
						$query_agm=mysql_query($sql_agm);
						?>
						<select multiple name="n_jabatan"  id="n_jabatan" class="validate-selection form-control">
						<?php while ($row_agm=mysql_fetch_array($query_agm))
						{;?>
							<option value ="<?php echo $row_agm['id_kerja'];?>"><?php echo $row_agm['n_kerja'];?></option>
							<?php }?>
						</select>
					</div>	
					<div class="f1-buttons">
						<button type="button" class="btn btn-previous">Previous</button>
						<button type="button" class="btn btn-next">Next</button>
					</div>
				</fieldset>

				<fieldset>
					<h4>Data Sekolah:</h4>
					<div class="form-group">
						<label  for="f1-facebook">Nama SMA/MA/SMK Asal *</label>
						<input type="text" name="n_sma" placeholder="Nama SMA/MA/SMK Asal *" class="f1-facebook form-control" id="f1-facebook">
					</div>
					<div class="form-group">
						<label for="1">Jurusan *</label>						
						<?php
						$sql_agm="select * from t_jurusan_sma";
						$query_agm=mysql_query($sql_agm);
						?>
						<select multiple name="i_jur_sma"  id="i_jur_sma" class="validate-selection form-control">
						<?php while ($row_agm=mysql_fetch_array($query_agm))
						{;?>
							<option value ="<?php echo $row_agm['KodeSMU'];?>"><?php echo $row_agm['Keterangan'];?></option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label for="1">Alamat *</label>				
						<textarea class="form-control" name="n_alamat_sma" id="exampleFormControlTextarea1" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label for="1">Propinsi *</label>				
						<select multiple class="form-control" name="n_prop_sma" onChange="showKab2()">
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
						<label for="1">Kabupaten / Kota *</label>				
						<select multiple class="form-control" name="n_kab_sma" id="n_kab_sma">
							<option selected="selected"> </option>
						</select> 
					</div>	
					<div class="f1-buttons">
						<button type="button" class="btn btn-previous">Previous</button>
						<button type="submit" class="btn btn-submit">Submit</button>
					</div>
				</fieldset>
			
			</form>
		</div>
	</div>
		
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
<script>
	$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});
</script>