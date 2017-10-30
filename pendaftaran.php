<?php
include "config/koneksi.php";
?>
<script src="daftar/assets/js/jquery.validate.min.js"></script>
<form action="validasi" id="contact-form" class="form-horizontal" method="post">
<fieldse/t class="form-group">
	<h5>Form Pendaftaran Calon Mahasiswa</h5>
	<hr>
	<div class="row">
	<div class="col-12 col-lg-5">			
		<div class="list-group-item">
	      	<div class="row">
			<div class="col-12 col-lg-4">			
	      		<label class="control-label" for="name">Nama Lengkap</label>
	      	</div>
			<div class="col-12 col-lg-8">			
	       		<input type="text" class="form-control" name="nama" id="nama" required="true">
	       	</div>
	    	</div>
	    </div>
		<div class="list-group-item">
	      <div class="row">
			<div class="col-12 col-lg-4">			
	      		 <label class="control-label" for="nis">NISN</label>
	        </div>
			<div class="col-12 col-lg-8">			
	        	<input maxlength="10" type="text" class="form-control" name="nis" id="nis" required="true">
	        	<span style="color: grey;"> <I>10 Digit Nomor Induk Siswa Nasional</I></span>
	        </div>
	      </div>
	    </div>
		<div class="list-group-item">
	      <div class="row">
			<div class="col-12 col-lg-4">			
	   		    <label class="control-label" for="email">Email</label>
	        </div>
			<div class="col-12 col-lg-8">			
	        	<input type="text" class="form-control" name="email" id="email" required="true">
	        </div>
	      </div>
	    </div>
	    <div class="list-group-item">
	      <div class="row">
			<div class="col-12 col-lg-4">			
	      		<label class="control-label" for="subject">No Tlp / HP</label>
	      	</div>
			<div class="col-12 col-lg-8">			
		        <input type="tel" class="form-control" name="no_tlp" id="no_tlp" maxlength="50" required="true">
		    </div>
	      </div>
	    </div>
	    <div class="list-group-item">
	        <div class="row">
	        <div class="col-sm-12 col-lg-4">
		        <label class="control-label" for="email">Perguruan Tinggi</label>
			</div>
	        <div class="col-sm-6 col-lg-4">
		      	<input type="radio" class="form-radio" id="pilihan" name="pilihan" value="1" checked/>
				<label for="input_9_0"> POLTEKPOS </label>
			</div>
			<div class="col-sm-6 col-lg-4">
				<input type="radio" class="form-radio" id="pilihan" name="pilihan" value="2" />
				<label for="input_9_1"> STIMLOG </label>
			</div>
			</div>
	    </div>                          
	    <div class="list-group-item">
	        <div class="row">
	        <div class="col-sm-12 col-lg-4">
	        	<label class="control-label" for="email">Jalur Pendaftaran</label>
			</div>
	        <div class="col-sm-6 col-lg-4">
		     	<input type="radio" class="form-radio" id="jalur_pendaftaran" name="jalur_pendaftaran" value="1" checked/>
				<label for="input_9_1"> Regular I</label>
			</div>
	        <div class="col-sm-6 col-lg-4">
		       	<input type="radio" class="form-radio" id="jalur_pendaftaran" name="jalur_pendaftaran" value="2"/>
				<label for="input_9_0"> UNDANGAN </label>
			</div>
			</div>
	    </div>  
	     <div class="list-group-item text-right bg-light">
	     	<div class="btn-group" role="group" aria-label="Basic example">
<!-- 			<button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
 -->	        <button type="button" class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Next ></button>
			</div>
		</div>
	</div>	

	<div class="col-12 col-lg-7">
	<div class="col">
	<div class="collapse multi-collapse" id="multiCollapseExample2">
		<!-- <div class="list-group-item text-right list-group-item-info">
		<b>Data Pribadi Peserta</b><BR>
		Isilah data pribadi Saudara/i dengan lengkap dan benar.
		</div>
          	  
		<div class="list-group-item">
			<div class="row">
			<div class="col-12 col-lg-4">			
				<label class="control-label" for="email">Nama Lengkap</label>
			</div>
			<div class="col-12 col-lg-8">			
				<input class="form-control required" name="n_lengkap" type="TEXT"  value="<?php echo $_SESSION['nama']; ?>" size="40" maxlength="80">			
			</div>
			</div>
		</div>
		<div class="list-group-item">
			<div class="row">
			<div class="col-12 col-lg-4">			
				<label class="control-label" for="email">Jenis Kelamin</label>
			</div>
			<div class="col-12 col-lg-8">			
				<input  name="n_jns_kelamin" value="L" selected="" type="RADIO" class="validate-one-required">&nbsp Laki-laki <br>
				<input  name="n_jns_kelamin" value="P" type="RADIO" class="validate-one-required">&nbsp Perempuan
			</div>
			</div>			
		</div>

		<div class="list-group-item">
			<div class="row">
			<div class="col-12 col-lg-4">			
				<label class="control-label" >Tempat, Tanggal Lahir</label>
			</div>
			<div class="col-12 col-lg-8">			
				<input class="required"name="n_temp_lahir" type="TEXT"  value="<?php echo $_SESSION['tmptlahir']; ?>" size="15" maxlength="40">
				<input class="required"name="d_lahir" type="text"  value="<?php echo $_SESSION['tgllahir']; ?>" readonly>
				<input  type="button" value="cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">
			</div>
			</div>			
		</div>

		<div class="list-group-item">
			<div class="row">
			<div class="col-12 col-lg-4">			
				<label class="control-label">Alamat yang dapat Dihubungi</label>
			</div>
			<div class="col-12 col-lg-8">			
				<textarea class="form-control required" name="n_alamat" rows="2" cols="30" ><?php echo $_SESSION['alamat']; ?></textarea>
	            *Keterangan : Mohon isi kolom alamat dengan lengkap dengan format Jalan, No.rumah, RT/RW, Kelurahan/Kecamatan, dan lain-lain sesuai dengan format KTP
			</div>
			</div>			
		</div>
		<div class="list-group-item">
			<div class="row">
			<div class="col-12 col-lg-4">			
				<label class="control-label">Agama</label>
			</div>
			<div class="col-12 col-lg-8">			
				<?php
					$sql_agm="SELECT * FROM t_agama";
					$query_agm=mysql_query($query);
					?>
									<select class="form-control validate-selection" name="i_agama" size="1" id="i_agama" >
									<option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
												<?php while ($xx =mysql_fetch_array($query_agm))
					{;?>
                    <option value ="<?php echo $xx['kd_agama'];?>"><?php echo $xx['n_agama'];?></option>
                    <?php }?>
                    </select>
			</div>
			</div>			
		</div>
		<div class="list-group-item">
			<div class="row">
			<div class="col-12 col-lg-4">			
				<label class="control-label">Propinsi<br>Kabupaten / Kota *	</label>
			</div>
			<div class="col-12 col-lg-8">			
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
				</select> 
			</div>
			</div>			
		</div>
		<div class="list-group-item">
			<div class="row">
			<div class="col-12 col-lg-4">			
				<label class="control-label">Kode Pos</label>
			</div>
			<div class="col-12 col-lg-8">			
				<input class="form-control validate-number required"name="c_pos" type="TEXT"  value="<?php echo $_SESSION['kdpos']; ?>" size="5" maxlength="5" >	  
			</div>
			</div>			
		</div>
		<div class="list-group-item">
			<div class="row">
			<div class="col-12 col-lg-4">			
				<label class="control-label">Nomor Telepon</label>
			</div>
			<div class="col-12 col-lg-8">			
				<input class="form-control validate-number required"name="i_telp" type="TEXT"  value="<?php echo $_SESSION['telp']; ?>" size="15" maxlength="20">
			</div>
			</div>			
		</div>
		<div class="list-group-item">
			<div class="row">
			<div class="col-12 col-lg-4">			
				<label class="control-label">Nomor Handphone/Selular</label>
			</div>
			<div class="col-12 col-lg-8">			
				<input class="form-control validate-number required"name="i_hp" type="TEXT"  value="<?php echo $_SESSION['no_tlp']; ?>" size="15" maxlength="20">
			</div>
			</div>			
		</div>
		<div class="list-group-item">
			<div class="row">
			<div class="col-12 col-lg-4">			
				<label class="control-label">Email</label>
			</div>
			<div class="col-12 col-lg-8">			
				<input class="form-control required validate-email"name="n_email" type="TEXT"  value="<?php echo $_SESSION['email']; ?>" size="25" maxlength="40">
			</div>
			</div>			
		</div>
		<div class="list-group-item">
			<div class="row">
			<div class="col-12 col-lg-4">			
				<label class="control-label">Jsssssss</label>
			</div>
			<div class="col-12 col-lg-8">			
				
			</div>
			</div>			
		</div> -->
		<div class="list-group-item text-right bg-light">		
	     	<div class="btn-group" role="group" aria-label="Basic example">
			<button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
	        <button type="submit" class="btn btn-sm btn-primary btn-large">Submit</button>
			</div>
		</div>
		</div>		
	</div>
	</div>	
	</div>	
	</fieldset>
</form>