<?php
// error_reporting(0);
session_start();
include "../config/koneksi.php";
//error_reporting(0);
if (empty($_SESSION['kode_briva']) AND empty($_SESSION['password'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
?>

<html>
<head>
<title>:: Penerimaan Mahasiswa Baru POLTEKPOS & STIMLOG ::</title>
	<!-- Awal Kalender -->
<style type="text/css">
	#ad{
		padding-top:220px;
		padding-left:10px;
	}
.textmenu{
color: blue;
}
	

	</style>
	<link type="text/css" rel="stylesheet" href="js/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	<SCRIPT type="text/javascript" src="js/dhtmlgoodies_calendar.js?random=20060118"></script>
<!-- Akhir Kalender -->
<link href="style.css" rel="stylesheet" type="text/css" />
<script LANGUAGE="JavaScript">
<!--
// Nannette Thacker http://www.shiningstar.net
function confirmSubmit()
{
var agree=confirm("Anda Yakin Semua Data telah diisi dengan benar ?");
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>
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
<script type="text/javascript">
function getTotal()
{
	var total_bayar = new Number(document.forms[0].total_bayar.value);
	var besar_bayar = new Number(document.forms[0].q_jmlpembayaran.value);
	document.forms[0].sisa_bayar.value = total_bayar - besar_bayar;
}
function sisa_bayar()
{
	setInterval("getTotal()", 1000);
}
</script>
<!-- Chat -->
<link type="text/css" rel="stylesheet" media="all" href="../daftar/bootstrap.css" />
  <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
<!-- Akhir Chat -->
  <script src="scriptaculous/lib/prototype.js" type="text/javascript"></script>
		<script src="scriptaculous/src/effects.js" type="text/javascript"></script>
		<script type="text/javascript" src="fabtabulous.js"></script>
		<script type="text/javascript" src="validation.js"></script>
</head>
<body onLoad="sisa_bayar();">

<nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand label-hh" href="#">
	  <?php 

	  if ($_SESSION['pilihan']=="POLTEKPOS"){
		  
		 echo "<img src=\"logo_poltekpos1.png\" width=\"30\"/> Politeknik Pos Indonesia";
		  
	  }
	  else{
		   echo "<img src=\"logo_stimlog1.png\" width=\"30\"/> Sekolah Tinggi Manajemen Logistik";
		  }
	  ?>
        
      </a>
	  
	  <ul class="nav navbar-nav">
       <li><a href="?module=home"><i class="icon-chevron-right"></i> <B>Home</B></a></li>
				<li><?php include "menu.php"; ?><i class="icon-chevron-right"></i></a></li>
        
      </ul>
    </div>
	
	<ul class="nav navbar-nav navbar-right">
        <li class=""><a href="logout.php"><B>Logout</B></a></li>
    </ul>
	
  </div>
  
  
  
</nav>
	

		<?php include "content.php"; ?>





	
</div>
</body>
</html>
<?php
}
?>
