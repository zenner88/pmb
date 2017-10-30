<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Form Registrasi Mahasiswa Baru</title>

	  <meta name="viewport" content="width=device-width">

    <link href="style.css" rel="stylesheet">
	<link href="bootstrap.css" rel="stylesheet">
  	<script src="js/modernizr-2.5.3.min.js"></script>

  </head>
  <body class="list-group-item-bbg">


<nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
	  <img alt="Brand" src="logo_poltekpos1.png" width="30">  <img alt="Brand" src="logo_stimlog1.png" width="30"> PMB (Penerimaan Mahasiswa Baru) 2016 / 2017 
	  </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
       
      </ul>
    
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://pmb.poltekpos.ac.id/">Back to site</a></li>
       
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- /header end -->
  <div class="row list-group-item-bbg">
  <div class="col-md-1"></div>
  <div class="col-md-5">
  <!--register-->
  <div class="list-group">
		  <BR/>

<form action="validasi.php" id="contact-form" class="form-horizontal" method="post">
	<fieldset>

						    <legend class="list-group-item btn-primary">
                            <img src="black-white-metro-add-user-icon.png" width="60" />
                            Form Registrasi Mahasiswa Baru 
							</legend>
							<div class="list-group-item">
						      <label class="control-label" for="name">Nama Lengkap</label>
						      <div class="controls">
						        <input type="text" class="form-control" name="nama" id="nama">
						      </div>
						    </div>
							<div class="list-group-item">
						      <label class="control-label" for="nis">NISN </BR>(10 Digit Nomor Induk Siswa Nasional)</label>
						      <div class="controls">
						        <input maxlength="10" type="text" class="form-control" name="nis" id="nis">
						      </div>
						    </div>
							<div class="list-group-item">
						      
						      
						    </div>
							<div class="list-group-item">
						      <label class="control-label" for="email">Email</label>
						      <div class="controls">
						        <input type="text" class="form-control" name="email" id="email">
						      </div>
						    </div>
							
						    <div class="list-group-item">
						      <label class="control-label" for="subject">No Tlp / HP</label>
						      <div class="controls">
						        <input type="tel" class="form-control" name="no_tlp" id="no_tlp" maxlength="50">
						      </div>
						    </div>
						    <div class="list-group-item">
                                <label class="control-label" for="email">Perguruan Tinggi</label>
                                <div class="controls">
						      	<input type="radio" class="form-radio" id="pilihan" name="pilihan" value="1" checked/>
              						<label for="input_9_0"> POLTEKPOS </label>
            						
           
            						
              						<input type="radio" class="form-radio" id="pilihan" name="pilihan" value="2" />
             						 <label for="input_9_1"> STIMLOG </label>
            						
                                    </div>
            
						    </div>                          
                            <div class="list-group-item">
                                <label class="control-label" for="email">Jalur Pendaftaran</label>
                                <div class="controls">
						     <input type="radio" class="form-radio" id="jalur_pendaftaran" name="jalur_pendaftaran" value="1" checked/>
              						<label for="input_9_1"> Regular Gelombang II</label>
            						
           
            						
              					<!-- <input type="radio" class="form-radio" id="jalur_pendaftaran" name="jalur_pendaftaran" value="0"/>
             						 <label for="input_9_1"> PMDK </label> -->

						       <input type="radio" class="form-radio" id="jalur_pendaftaran" name="jalur_pendaftaran" value="2"/>
             						 <label for="input_9_0"> UNDANGAN </label>
            						
                                    </div>
            
						    </div>
                            
                            
	              <div class="list-group-item text-center list-group-item-info">
			            <button type="submit" class="btn btn-primary btn-large">Submit</button>
	    			      <button type="reset" class="btn btn-danger">Cancel</button>
	        			</div>

	</fieldset>
</form>

</div>
<div class="list-group">
		
						<div class="form-horizontal">
						  <fieldset>
						    <legend class="list-group-item btn-info">
							
                            Verifikasi Pembayaran							 
                            </legend></fieldset>
							<div class="panel-body list-group-item well">
<p><B>Untuk kolektif melalui Guru BK. </B></BR>
Data pendaftar kolektif dan bukti pembayaran kolektif melalui Guru BK dikirim ke email : info@poltekpos.ac.id / pmb@stimlog.ac.id</BR>
<B>Informasi lebih lanjut bisa menghubungi 081 314 550 006, 0815 7218 9015, 0896 9490 9220</B></BR>
</p></br>
<p><B>Biaya Pendaftaran Regular/PMDK Rp.200.000.-</B></p>
							 <p>Setelah melakukan PENDAFTARAN silahkan lakukan PEMBAYARAN.</p>
							<blockquote><footer> Tempat Pembayaran :</br>

							 <strong>Bank BNI :</strong> </br>002 8676 942 a.n Yayasan Pendidikan Bhakti Pos Indonesia (YPBPI)</br> 
							<strong>GIRO POS :</strong> </br>400 0115 179 a.n Yayasan Pendidikan Bhakti Pos Indonesia (YPBPI)</br></br>
</footer></blockquote>							 
<p>Untuk LOGIN ke sistem, kirim BUKTI PEMBAYARAN (scan/foto) melalui: 
<blockquote><footer> Kontak kami :</br>
							 <strong>email : </strong>info@poltekpos.ac.id / pmb@stimlog.ac.id </br>
							
							 <strong>BBM : </strong>5A579F54</p>
							 </div>
						  
						</div>
</div> 
<!--end register-->
  
  
  </div>
  <div class="col-md-5">
  <BR/>
<div class="list-group">
		
						<form action="../peserta/cek_login.php" id="contact-form" class="form-horizontal" method="post">
						  <fieldset>
						    <legend class="list-group-item btn-warning">
                            <img src="User_Group.png" width="60" />
                            <span class="text-left">Form Login</span> 
                            
                           
                            </legend>

						    
						    <div class="list-group-item">
						      <label class="control-label" for="email">NISN</label>
						      <div class="controls">
						        <input type="text" class="form-control" name="briva" id="briva">
						      </div>
						    </div>
						    <div class="list-group-item">
						      <label class="control-label" for="subject">Password</label>
						      <div class="controls">
						        <input type="password" class="form-control" name="password" id="password" maxlength="50">
						      </div>
						    </div>
						    	
                            
                            
	              <div class="list-group-item text-center list-group-item-warning">
			            <button type="submit" class="btn btn-primary btn-large">Submit</button>
	    			      <button type="reset" class="btn btn-danger">Cancel</button>
	        			</div>
						  </fieldset>
						</form>
</div>
<!--end register-->
 
  
  </div>  
  
  </div>
 
</div>
  

<!-- ==============================================
		 JavaScript below! 															-->

<!-- jQuery via Google + local fallback, see h5bp.com -->
	  <script src="assets/js/jquery-1.7.1.min.js"></script>

<!-- Bootstrap JS -->
	  <script src="assets/js/bootstrap.min.js"></script>

<!-- Validate plugin -->
		<script src="assets/js/jquery.validate.min.js"></script>

<!-- Prettify plugin -->
		<script src="assets/js/prettify/prettify.js"></script>

<!-- Scripts specific to this page -->
		<script src="script.js"></script>

  </body>
</html>
