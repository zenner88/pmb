<?php 
$root = "localhost:88/pmb/";
  // error_reporting(0);
  session_start();	
  include "config/koneksi.php";
  include "config/fungsi_indotgl.php";
  include "config/class_paging.php";
  include "config/fungsi_combobox.php";
  include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
  include "hapus_orderfiktif.php";

  include "config/fungsi_badword.php";
  include "config/fungsi_kalender.php";
?>
<!--header-->
<!DOCTYPE html>

<!--[if IE 7]>                  <html class="ie7 no-js" lang="en">     <![endif]-->
<!--[if lte IE 8]>              <html class="ie8 no-js" lang="en">     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" lang="en">  <!--<![endif]-->

<!-- Mirrored from demo.samuli.me/smartstart/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Jun 2014 08:52:39 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<title>PMB POLTEKPOS & STIMLOG</title>
	
	<meta name="description" content="">
	<meta name="author" content="">
	
	<!--[if !lte IE 6]><!-->
	<link rel="stylesheet" href="css/style.css" media="screen" />

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,800,700,400italic|PT+Serif:400,400italic" />
	
	<link rel="stylesheet" href="css/fancybox.min.css" media="screen" />

	<link rel="stylesheet" href="css/video-js.min.css" media="screen" />

	<link rel="stylesheet" href="css/audioplayerv1.min.css" media="screen" />
	<link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">	
	<script src="css/bootstrap/js/jquery-3.2.1.slim.min.js"></script>
	<script src="css/bootstrap/js/popper.min.js"></script>
	<script src="css/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.backstretch.min.js"></script>
	<script src="assets/js/retina-1.1.0.min.js"></script>
	<script src="assets/js/scripts.js"></script>
	<script src="assets/js/bootstrap-datepicker.min.js"></script>
	<script src="js/modernizr.custom.js"></script>
	<script src="peserta/validation.js"></script>

	<!-- HTML5 video player -->
	<script src="js/video.min.js"></script>
	<script>_V_.options.flash.swf = 'js/video-js.swf';</script>

	<script language="JavaScript" type="text/JavaScript">
 function showKab()
 {
 <?php
 
 // membaca semua propinsi
 $query = "SELECT * FROM t_prop";
 $hasil = mysql_query($query);
 
 // membuat if untuk masing-masing pilihan propinsi beserta isi option untuk combobox kedua
 while ($data = mysql_fetch_array($hasil))
 {
   $idProp = $data['kd_prop'];

   // membuat IF untuk masing-masing propinsi
   echo "if (document.form_pmb.n_propinsi.value == \"".$idProp."\")";
   echo "{";

   // membuat option kabupaten untuk masing-masing propinsi
   $query2 = "SELECT * FROM t_kab WHERE kd_prop = $idProp";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('n_kabupaten').innerHTML = \"";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['kd_kab']."'>".$data2['nama_kab']."</option>";   
   }
   $content .= "\"";
   echo $content;
   echo "}\n";   
 }

 ?> 
 }
</script>
<!-- -->
<script language="JavaScript" type="text/JavaScript">
 function showKab2()
 {
 <?php
 
 // membaca semua propinsi
 $query = "SELECT * FROM t_prop";
 $hasil = mysql_query($query);
 
 // membuat if untuk masing-masing pilihan propinsi beserta isi option untuk combobox kedua
 while ($data = mysql_fetch_array($hasil))
 {
   $idProp = $data['kd_prop'];

   // membuat IF untuk masing-masing propinsi
   echo "if (document.form_pmb.n_prop_sma.value == \"".$idProp."\")";
   echo "{";

   // membuat option kabupaten untuk masing-masing propinsi
   $query2 = "SELECT * FROM t_kab WHERE kd_prop = $idProp";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('n_kab_sma').innerHTML = \"";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['kd_kab']."'>".$data2['nama_kab']."</option>";   
   }
   $content .= "\"";
   echo $content;
   echo "}\n";   
 }

 ?> 
 }
</script>
	<style type="text/css">
		@media print
			{    
			    .no-print, .no-print *
			    {
			        display: none !important;
			    }
			}
	</style>
<body>

<header id="" class="container clearfix no-print">
	<a href="../index.php" id="logo">
		<img src="img/logo.png" alt="SmartStart">
	</a>
	<nav id="main-nav">	
		<ul>
			<li >
				<a href="index.php">Home</a>	
			</li>
			<li >
				<a href="#">Jurusan</a>
				<ul>
					<li><a href="#">POLTEKPOS</a>
					<ul>
						<li><a href="kategori-2-teknik informatika.html">D3 Teknik Informatika</a></li>
						<li><a href="kategori-19-manajemen informatika.html">D3 Sistem Informasi Bisnis</a></li>
						<li><a href="kategori-21-akuntansi.html">D3 Akuntansi</a></li>
						<li><a href="berita-132-d3--manajemen-bisnis.html">D3 Manajemen Bisnis</a></li>
						<li><a href="kategori-23-logistik bisnis.html">D3 Logistik Bisnis</a></li>
						<li><a href="">D4 Logistik Bisnis</a></li>
						<li><a href="kategori-1000-manajemen bisnis perusahaan.html">D4 Manajemen Bisnis</a></li>
						<li><a href="berita-149-ti--d-iv.html">D4 Teknik Informatika</a></li>
						<li><a href="">D4 Akuntansi Keuangan</a></li>
						<li><a href="berita-159-program-sarjana-terapan-unggulan-logistik-bisnis.html">Program Sarjana Terapan Unggulan Logistik Bisnis</a></li>
						<li><a href="berita-133-program-sarjana-terapan-unggulan-akuntansi-keuangan.html">Program Sarjana Terapan Unggulan Akuntansi Keuangan</a></li>
					</ul>
					</li>                    
					<li><a href="#">STIMLOG</a>
					<ul>
						<li><a href="kategori-1009-manajemen-logistik.html">Manajemen Logistik</a></li>
						<li><a href="kategori-1010-manajemen-transportasi.html">Manajemen Transportasi</a></li>
					</ul>
					</li>
				</ul>
			</li>
			<li >
				<a href="#">Panduan</a>
				<ul>
					<li><a href="pmdk.html">PMDK</a></li>
                    <li><a href="reguler.html">REGULER</a></li>
					<li><a href="biaya.html">BIAYA PERKULIAHAN</a></li>
					<li><a href="#">DOWNLOAD</a>
					<ul>
						<li><a href="download/BROSUR_POLTEKPOS_STIMLOG_2016-2017.pdf">BROSUR POLTEKPOS & STIMLOG</a></li>
						<li><a href="download/BUKU PANDUAN PENDAFTARARAN PMB TA 2016-2017.pdf">BUKU PANDUAN PENDAFTARARAN PMB TA 2016-2017</a></li>
						<li><a href="download/FORMULIR PMB POLTEKPOS-STIMLOG.pdf">FORMULIR PMB POLTEKPOS-STIMLOG</a></li>
						<li><a href="download/Formulir Surat Pernyataan Her-Registrasi (Poltekpos).pdf">Formulir Surat Pernyataan Her-Registrasi (Poltekpos)</a></li>
						<li><a href="download/Formulir Surat Pernyataan Her-Registrasi (STIMLOG).pdf">Formulir Surat Pernyataan Her-Registrasi (STIMLOG)</a></li>
						<li><a href="download/BUKU PANDUAN HER-REGISTRASI PMB TA 2016-2017.pdf">BUKU PANDUAN HER-REGISTRASI PMB TA 2016-2017</a></li>
					</ul>
			</li>
			</ul>
			</li>
			<li >
				<a href="pendaftaran">Pendaftaran</a>
				
			</li>
			<li>
				<button type="button" class="p-0" data-toggle="modal" data-target="#exampleModal">
				<a >Login</a>
				</button>
			</li>
		</ul>
	</nav><!-- end #main-nav -->
</header><!-- end #header -->

<section id="content" class="container clearfix">
 <?php include "tengah.php";?>
</section>
<footer id="footer" class="clearfix no-print">

	<div class="container">

		<div class="three-fourth">

			<nav id="footer-nav" class="clearfix">

				<ul>
					<li><a href="beranda">Home</a></li>
					<li><a href="/daftar/">pendaftaran</a></li>
				
					
					<li><a href="hubungi-kami.html">Contact</a></li>
				</ul>
				
			</nav><!-- end #footer-nav -->

			<ul class="contact-info">
				<li class="address">Jl. Sariasih 54 Bandung 40151</li>
				<li class="phone">(022) 2009562, 2009570</li>
				<li class="email"><a href='mailto:info@poltekpos.ac.id'>info@poltekpos.ac.id</a> | <a href='mailto:pmb@stimlog.ac.id'>pmb@stimlog.ac.id</a></li>
			</ul><!-- end .contact-info -->
			
		</div><!-- end .three-fourth -->

		<div class="one-fourth last">

				<span class="title">Stay connected STIMLOG</span>
			<ul class="social-links">
				<li class="twitter"><a href="https://mobile.twitter.com/stimlog_ind">Twitter</a></li>
				<li class="facebook"><a href="https://www.facebook.com/pmb.stimlog">Facebook</a></li>
			
			</ul><!-- end .social-links -->
			
			
		</div><!-- end .one-fourth.last -->
		
	</div><!-- end .container -->

</footer><!-- end #footer -->

<footer id="footer-bottom" class="clearfix no-print">

	<div class="container">

		<ul>
			<li>T I K &copy; 2016</li>
			<li><a href="#">Legal Notice</a></li>
			<li><a href="#">Terms</a></li>
		</ul>

	</div><!-- end .container -->

</footer><!-- end #footer-bottom -->

<!--[if !lte IE 6]><!-->
	<script src="../../ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.7.1.min.js"><\/script>')</script>
	<!--[if lt IE 9]> <script src="js/selectivizr-and-extra-selectors.min.js"></script> <![endif]-->
	<script src="js/jquery.ui.widget.min.js"></script>
	<script src="js/respond.min.js"></script>
	<script src="js/jquery.easing-1.3.min.js"></script>
	<script src="js/jquery.fancybox.pack.js"></script>
	<script src="js/jquery.smartStartSlider.min.js"></script>
	<script src="js/jquery.jcarousel.min.js"></script>
	<script src="js/jquery.cycle.all.min.js"></script>
	<script src="js/jquery.isotope.min.js"></script>
	<script src="js/audioplayerv1.min.js"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script src="js/jquery.gmap.min.js"></script>
	<script src="js/jquery.touchSwipe.min.js"></script>
	<script src="js/custom.js"></script>

</body>
</html>
<script src="daftar/assets/js/jquery.validate.min.js"></script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="row">
		<div class="col-lg-12">
      		<form action="ceklogin" id="contact-form" class="form-horizontal" method="post">
	      	
				<img src="img/login.jpg" width="100%"/>
			<div class="list-group-item text-center">
	   		 	<div class="row">
				<div class="col-lg-4">
					<label class="control-label" for="email">NISN</label>
				</div>
				<div class="col-lg-8">
					<input type="text" class="form-control" name="briva" id="briva" required="true">
				</div>
				</div>
			</div>

			<div class="list-group-item text-center">
				<div class="row">
				<div class="col-lg-4">
					<label class="control-label" for="subject">Password</label>
				</div>
				<div class="col-lg-8">
					<input type="password" class="form-control" name="password" id="password" maxlength="50"  required="true">
				</div>
				</div>
			</div>
			<div class="list-group-item text-right bg-light">
				<div class="btn-group" role="group" aria-label="Basic example">
		        <button type="submit" class="btn btn-sm btn-primary btn-large">Submit</button>
				<button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
				</div>
			</div>
			</form>																			
	</div>
	</div>

    </div>
  </div>
</div>
<script type="text/javascript">
	$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Login')
  modal.find('.modal-body input').val(recipient)
})
</script>