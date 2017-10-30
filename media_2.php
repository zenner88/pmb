<?php 
  error_reporting(0);
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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title><?php include "dina_titel.php"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow">
<meta name="description" content="<?php include "dina_meta1.php"; ?>">
<meta name="keywords" content="<?php include "dina_meta2.php"; ?>">
<meta http-equiv="Copyright" content="ZStudio">
<meta name="author" content="Rizal Faizal">
<meta http-equiv="imagetoolbar" content="no">
<meta name="language" content="Indonesia">
<meta name="revisit-after" content="7">
<meta name="webcrawlers" content="all">
<meta name="rating" content="general">
<meta name="spiders" content="all">


<link rel="shortcut icon" type="image/x-icon" href="icon.png">
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.xml" />

<!--// Stylesheet //-->
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="css/contentslider.css" rel="stylesheet" type="text/css" />
<link href="css/default.advanced.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.ad-gallery.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<link href="css/footer.css" rel="stylesheet" type="text/css" />
<!--// Javascript //-->
<script type="text/javascript" src="config/jquery.js"></script>
<script type="text/javascript" src="js/clearbox.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.min14.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/anythingslider.js"></script>
<script type="text/javascript" src="js/jquery.anythingslider.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.2.js"></script>
<script type="text/javascript" src="js/jquery.fancybox-1.3.1.js"></script>
<script type="text/javascript" src="js/contentslider.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/jquery.ad-gallery.js"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<script type="text/javascript" src="js/thumbgallery.js"></script>
<script type="text/javascript" src="js/eurofurence_500-eurofurence_700.font_9bc22cbd.js"></script>
<script type="text/javascript" src="js/cufon.js"></script>

<script type="text/javascript" src="js/newsticker.js"></script>

<script type="text/javascript" src="js/scrolltopcontrol.js"></script>

<!--[if lte IE 7]>
<script type="text/javascript" src="js/jquery.dropdown.js"></script>
<![endif]-->


<script type="text/javascript" src="js/easy.js"></script>
<script type="text/javascript">
	$(document).ready(function(){		
		$.easy.tooltip();	
});
</script>

<meta charset="UTF-8">

<style type="text/css">
<!--
.style1 {color: #FF6600}
-->
</style>

<!-- Start WOWSlider.com HEAD section -->
	<link rel="stylesheet" type="text/css" href="engine1/wowslider.css" media="screen" />
	<style type="text/css">a#vlb{display:none}</style>
	<script type="text/javascript" src="js/jquery_wowslider.js"></script>
<!-- End WOWSlider.com HEAD section -->

<!-- Begin Stylesheets for Coda Slider -->
	<!--	<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />-->
		<link rel="stylesheet" href="css/coda-slider-2.0.css" type="text/css" media="screen" />
	<!-- End Stylesheets -->
	<!-- Begin JavaScript for Coda Slider-->
	<!--	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>-->
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script> 
		<script type="text/javascript" src="js/jquery.coda-slider-2.0.js"></script>
		 <script type="text/javascript">
			$().ready(function() {
    $('#coda-slider-1').codaSlider({
        autoSlide: true,
       	autoSlideInterval: 8000,
        autoSlideStopWhenClicked: false,
		autoHeightEaseDuration: 2500,
        autoHeightEaseFunction: "easeInOutElastic",
        slideEaseDuration: 2500,
        slideEaseFunction: "easeInOutElastic"
    });
});
		 </script>
	<!-- End JavaScript -->

<!-- Awal ChatBox -->
<div class="widget-content">
<!-- Begin Show Hide Floating - http://www.aleezone.co.nr -->
<style type="text/css"> 
#hitsukeFX{ position:fixed; top:50px; z-index:+1000; } * html #hitsukeFX{position:relative;} .hitsukeFXtab{ height:200px; width:35px; float:left; cursor:pointer; background:url('chatbox.png') no-repeat; } 
.hitsukeFXcontent{ float:left; border:2px solid #ffffff; -moz-border-radius-topleft:5px; -moz-border-radius-topright:5px; -moz-border-radius-bottomleft:5px; -moz-border-radius-bottomright:5px; background:#F90; padding:10px; } 
</style> 

<script type="text/javascript"> 
function showHidehitsukeFX(){ var hitsukeFX = document.getElementById("hitsukeFX"); var w = hitsukeFX.offsetWidth; hitsukeFX.opened ? movehitsukeFX(0, 40-w) : movehitsukeFX(40-w, 0); hitsukeFX.opened = !hitsukeFX.opened; } 
function movehitsukeFX(x0, xf){ var hitsukeFX = document.getElementById("hitsukeFX"); var dx = Math.abs(x0-xf) > 10 ? 5 : 1; var dir = xf>x0 ? 1 : -1; var x = x0 + dx * dir; hitsukeFX.style.right = x.toString() + "px"; if(x0!=xf){setTimeout("movehitsukeFX("+x+", "+xf+")", 10);} } 
</script> 
<div style="right: -1px;" id="hitsukeFX"> <div class="hitsukeFXtab" onClick="showHidehitsukeFX()"> </div> <div class="hitsukeFXcontent">  <!-- Kode Chatboxmu Disini -->  
<div><object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" id="obj1" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" border="0" width="445" height="295">
				<param name="movie" value="chatbox/chatbox.swf">
				<param name="quality" value="High">
				<param name="wmode" value="transparent">
				<param name="salign" value="L">
				<embed src="chatbox/chatbox.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="obj1" width="445" height="295" quality="High" wmode="transparent" salign="L"></object>
</div>

<div style="text-align: right;"> <a href="javascript:showHidehitsukeFX()"></a> </div> </div> </div> 
<script type="text/javascript"> var hitsukeFX = document.getElementById("hitsukeFX"); hitsukeFX.style.right = (40-hitsukeFX.offsetWidth).toString() + "px"; </script>
</div>
<!-- Akhir ChatBox -->


<!-- Awal Scroller Link Terkait -->
<style type="text/css">
#marqueecontainer{
position: relative;
width: 198px; /*marquee width */
height: 200px; /*marquee height */
background-color: white;
overflow: hidden;
padding: 2px;
padding-left: 0px;
}

</style>

<script type="text/javascript">

/***********************************************
* Cross browser Marquee II- Â© Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

var delayb4scroll=500 //Specify initial delay before marquee starts to scroll on page (2000=2 seconds)
var marqueespeed=2 //Specify marquee scroll speed (larger is faster 1-10)
var pauseit=1 //Pause marquee onMousever (0=no. 1=yes)?

////NO NEED TO EDIT BELOW THIS LINE////////////

var copyspeed=marqueespeed
var pausespeed=(pauseit==0)? copyspeed: 0
var actualheight=''

function scrollmarquee(){
if (parseInt(cross_marquee.style.top)>(actualheight*(-1)+8))
cross_marquee.style.top=parseInt(cross_marquee.style.top)-copyspeed+"px"
else
cross_marquee.style.top=parseInt(marqueeheight)+8+"px"
}

function initializemarquee(){
cross_marquee=document.getElementById("vmarquee")
cross_marquee.style.top=0
marqueeheight=document.getElementById("marqueecontainer").offsetHeight
actualheight=cross_marquee.offsetHeight
if (window.opera || navigator.userAgent.indexOf("Netscape/7")!=-1){ //if Opera or Netscape 7x, add scrollbars to scroll and exit
cross_marquee.style.height=marqueeheight+"px"
cross_marquee.style.overflow="scroll"
return
}
setTimeout('lefttime=setInterval("scrollmarquee()",30)', delayb4scroll)
}

if (window.addEventListener)
window.addEventListener("load", initializemarquee, false)
else if (window.attachEvent)
window.attachEvent("onload", initializemarquee)
else if (document.getElementById)
window.onload=initializemarquee
</script>
<!-- Akhir Scroller Link Terkait -->

<!-- Awal Lightbox -->
<link rel="stylesheet" href="<?php echo "js/lightbox/themes/default/jquery.lightbox.css" ?>" type="text/css" />
<script src="<?php echo "js/lightbox/jquery.lightbox.min.js" ?>" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('.lightbox').lightbox();		    
		});
</script>
<!-- Akhir Lightbox -->

</head>

<body>
<a name="top"></a>
<div id="wrapper_sec">
	<div id="head">
	  <div class="logo">
        	<a href="beranda"><img src="images/logo.png" alt="" /></a>
      </div>
        <div class="rightnavi">
            <p class="bold right"></p>
          <div class="clear">
          <ul><SCRIPT language=JavaScript src="almanak.js"></SCRIPT></ul>
          </div>
      </div>
        <div class="clear"></div>
        <div class="navigation">
          <ul id="nav" class="dropdown dropdown-linear dropdown-columnar">
            <?php               
        $main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y'");

        while($r=mysql_fetch_array($main)){
	         echo "<li><b><a href='$r[link]'>$r[nama_menu]</a></b>
                    <ul>";
	         $sub=mysql_query("SELECT * FROM submenu, mainmenu  
                            WHERE submenu.id_main=mainmenu.id_main 
                            AND submenu.id_main=$r[id_main]");
	         while($w=mysql_fetch_array($sub)){
              echo " <li class='clear'><b><a href='$w[link_sub]'>$w[nama_sub]</a></b></li>";
	         }
	       echo "</ul>
            </li>";} ?>

          </ul>
  </div></div>
    <div class="clear"></div>
    <div id="crumb">
    	<ul class="left">
        	<li><p>Anda berada di:</p></li>
            </ul>
			<ul class="left2">
              <?php include "breadcrumb.php";?>
      
        </ul>
        <ul class="search right"><form method="POST" action="hasil-pencarian.html">
            	<li><input name="kata" type="text" value="cari berita"  class="bar" /></li>
                <li><input type="submit" class="go" value="cari" /></li></form>
      </ul>
  </div>
    <div class="clear"></div>
    <div class="rotating_banner">
            	<div class="anythingSlider">
                  <div class="wrapper">
				  <ul>
		
<?php
/* $header=mysql_query("SELECT * FROM header ORDER BY id_header DESC LIMIT 4");
while($b=mysql_fetch_array($header)){
  echo "<li><img width=940 src='header/$b[gambar]'></li>";  
} */
?>
<!-- Start WOWSlider.com BODY section -->

<div id="wowslider-container1">
	
    <div class="ws_images">
<?php
$header=mysql_query("SELECT * FROM header ORDER BY id_header ASC");
while($b=mysql_fetch_array($header)){
  echo "<a href=berita-$b[url].html><img src='header/$b[gambar]' alt=$b[id_header] title='$b[judulberita]...<a href=berita-$b[url].html><b>(Baca Selengkapnya)</b></a>'></a>";
}
?>
	</div>
	
		
	
	<div class="ws_bullets"><div>
<?php
$header=mysql_query("SELECT * FROM header ORDER BY id_header ASC");
while($b=mysql_fetch_array($header)){
  echo "<a href=#wows$b[id_header]></a>";
}
?>	
	</div>
</div>

<script type="text/javascript" src="js/wowslider.js"></script>
<!-- End WOWSlider.com BODY section -->
                    
					</ul>
                  </div>
                </div>
  </div>
  
  <div class="coda-slider-wrapper">
	<div class="coda-slider preload" id="coda-slider-1">
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Teknik Informatika</h2>
				<p>Program studi Teknik Informatika dirancang untuk memenuhi tuntutan aplikasi Teknologi Informasi di sektor Industri dan Bisnis. Selama Proses belajar mahasiswa dibekali dengan materi-materi yang mendukung penguasaan Teknologi Informasi seperti jaringan komputer wireless, rekayasa perangkat lunak, database, âmultimedia, sistem keamanan informasi serta teknologi dan aplikasi WAP dan WEB. Seiring dengan perkembangan Teknologi Informasi yang sangat cepat, serta untuk mengantisipasi kebutuhan di masyarakat, lulusan yang dibekali dengan state of the art teknologi informasi, seperti Mobile Content and Apllication serta berbagai aspek hukum dan etika yang berhubungan dengan TI.</p>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Manajemen Informatika</h2>
				<p>Program studi ini dirancang untuk menghasilkan ahli madya yang dibekali kemampuan dalam pembangunan, instalasi, pemeliharaan sistem informasi dengan tools terkini berbasis teknologi yang saat ini dibutuhkan oleh industri. Penguasaan infrastruktur teknologi informasi terkini ini termasuk pengelolaan jaringan komputer dan database, pembangunan web, dan kemampuan interkoneksi beragam sumber informasi melalui jaringan baik fixed line ataupun wireless.</p>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Akuntansi</h2>
				<p>Program studi ini dirancang dengan berdasarkan link and match dengan kebutuhan industri untuk tenaga ahli profesional dalam bidang akuntansi. Dalam rangka membekali lulusan memasuki dunia kerja, mahasiswa diberi kesempatan mengikuti uji kompetensi Brevet Pajak A dan B, Aplikasi Komputer dan Bahasa Inggris serta Work Shop Auditing, dan memperoleh sertifikat dari assosiasi atau lembaga yang berwenang. Kompetensi lulusan, dapat membuat laporan keuangan, menghitung pajak, membuat sistem akuntansi berbasis komputer, dan membantu melakukan audit laporan keuangan sesuai dengan standar pemeriksaan akuntan publik.</p>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Manajemen Pemasaran</h2>
				<p>Program studi ini dirancang untuk membekali mahasiswa memasuki dan mengembangkan karier dibidang pemasaran. Sebagai mitra penyedia tenaga profesional trampil bagi industri untuk tenaga marketing, kurikulum dalam program studi ini dirancang dengan melibatkan industri untuk membekali mahasiswa dengan skill dan kompetensi bidang pemasaran yang sesuai untuk kebutuhan industri sebagai pengguna utama lulusan, seperti kemampuan berkomunikasi, lobi dan negosiasi, teknik penyusunan dan presentasi proposal, perancangan iklan, riset pasar, salesmanship, dan aplikasi-aplikasi untuk Customer Relationship Management.</p>
			</div>
		</div>
        <div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Logistik Bisnis</h2>
				<p>Kurikulum Logistik Bisnis dirancang agar para lulusan mempunyai kompetensi untuk menangani pekerjaan dan permasalahan dalam bidang operasional logistik yang mencakup berbagai aspek seperti Ekspor-Impor, Kepabeanan, Distribusi, Transportasi, Warehousing, Cargo & Shipping, Inventory, Purchasing (Procurement), Good Inspections, Logistic Information Service, Perpajakan, Resiko dan Asuransi.</p>
			</div>
		</div>
	</div><!-- .coda-slider -->
</div><!-- .coda-slider-wrapper -->

    <div class="clearoot"></div>
    
    <div id="content_sec">
    	<div class="col1">
        
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/spacer.gif" width="1" height="20" /></td>
              </tr>
              <tr>
                <td><span class="center_content2"><?php include "tengah.php";?></span></td>
              </tr>
            </table>
            <div class="clear"></div>
      </div>
    	<div class="col2">
		
		<div >
            		<h5>Pendaftaran Online</h5>
					<br />
					<a href="peserta/index.php"><img src=images/online.jpg width="215"></a><li>
       	  </div>
		  
		  
       	  <div class="mycart">
            	<div class="small_heading">
            		<h5>Kontak Kami</h5>
					<ul>
            			<li class="tel"><span class="bold"></span> 022 - 200 - 956 - 2<br>022 - 932 - 500 - 92<br>022 - 616 - 936 - 72</li>
                		<li class="email"><span class="bold">Email:</span> <a href="mailto:info@poltekpos.ac.id">info@poltekpos.ac.id</a></li>
                		<!--<li class="skype"><span class="bold">Skype:</span> pmbpoltekpos</li>-->
						<li class="fb"><span class="bold">Facebook:</span> <a href="http://www.facebook.com/profile.php?id=100000532405799#!/profile.php?id=100000532405799">pmbpoltekpos</a></li>
						<!--<li class="twitter"><span class="bold">Twitter:</span> <a href="http://www.twitter.com/pmbpoltekpos">pmbpoltekpos</a></li>-->
<li class="bb"><span class="bold">PIN.BlackBerry:</span> 25E46602</li>   
            		</ul>
                </div>
       	  </div>

       
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) {return;}
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="myaccount2">
<div class="fb-like-box" data-href="http://www.facebook.com/alumnipoltekposindonesia" data-width="200" data-height="375" data-show-faces="true" data-border-color="#ccc" data-stream="false" data-header="false">
</div>
</div>
          
            <div class="myaccount">
            	<div class="small_heading">
            		<h5>Berita Jurusan </h5>
                </div>
                <ul>
                
                  <?php
            $kategori=mysql_query("select nama_kategori, kategori.id_kategori, kategori_seo,  
                                  count(berita.id_berita) as jml 
                                  from kategori left join berita 
                                  on berita.id_kategori=kategori.id_kategori where kategori.id_kategori!='666' AND kategori.id_kategori!='999' 
                                  group by id_kategori asc");
            $no=1;
            while($k=mysql_fetch_array($kategori)){
              if(($no % 2)==0){
                echo "<li><a href='kategori-$k[id_kategori]-$k[kategori_seo].html'> $k[nama_kategori] ($k[jml])</a></li>";
              }
              else{
                echo "<li><a href='kategori-$k[id_kategori]-$k[kategori_seo].html'> $k[nama_kategori] ($k[jml])</a></li>";              
              }
              $no++;
            }
            ?></li>
              
                </ul>
            </div>
		  
		  <div class="poll">
            	<div class="small_heading">
            		<h5>Chat dengan Panitia PMB</h5>
            </div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><div align="center">
                      <table width="150" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><div align="center">
                            <?php 
      //ym
      $ym=mysql_query("select * from mod_ym order by id desc");
      while($t=mysql_fetch_array($ym)){
        echo "<span class='table2'><b><br /><p>&bull; $t[nama] </b>
              <a href='ymsgr:sendIM?$t[username]'>
              <img src='http://opi.yahoo.com/online?u=$t[username]&amp;m=g&amp;t=1' border='0' height='16' width='64'></a>
              </p><br />";
      }
      ?>
                          </div></td>
                        </tr>
                      </table>
                    </div></td>
                  </tr>
                </table>
          </div>
		  
		  
		  <div class="poll4">
            	<div class="small_heading">
            		<h5>Metode Pendaftaran </h5>
                </div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><div align="center"><span class="border_box">
                      <?php
      $bank=mysql_query("SELECT * FROM mod_bank ORDER BY id_bank ASC");
      while($b=mysql_fetch_array($bank)){
		    echo "<span class='bank'>$a[nama_bank]</a></div>
         <div class='bank'>
             <img src='foto_banner/$b[gambar]' border='0' >
             </a>
         </div>
         
<div class='bank'><span class='bank'>an. $b[pemilik]</span></div>";
      }

        ?>
                    </span></div></td>
                  </tr>
                </table>
          </div>
		  
		  <div class="poll2">
            	<div class="small_heading">
            		<h5>Statistik Pengunjung  </h5>
                </div>
                <table width="111%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="11%">&nbsp;</td>
                    <td width="89%">
                      
                      <div align="left">
                        <?php
  // Statistik user
  $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
  $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
  $waktu   = time(); // 

  // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
  $s = mysql_query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
  // Kalau belum ada, simpan data user tersebut ke database
  if(mysql_num_rows($s) == 0){
    mysql_query("INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
  } 
  else{
    mysql_query("UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
  }

  $pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
  $totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
  $hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal")); 
  $totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
  $tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
  $bataswaktu       = time() - 300;
  $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE online > '$bataswaktu'"));

  $path = "counter/";
  $ext = ".png";

  $tothitsgbr = sprintf("%06d", $tothitsgbr);
  for ( $i = 0; $i <= 9; $i++ ){
	   $tothitsgbr = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $tothitsgbr);
  }

  echo "<p align='center'>
  <span class='pengunjung'><img src=counter/1.png>  Pengunjung Hari Ini : $pengunjung <br />
  <span class='pengunjung'><img src=counter/2.png width=24 height=24> Total pengunjung : $totalpengunjung<br />
        
	  </p>";
?>
                        </div></td></tr>
                </table>
		  </div>
		  <div class="poll3">
            	<div class="small_heading">
            		<h5>Link Terkait  </h5>
                </div>
                <table width="51%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
<div id="marqueecontainer" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">
	<div id="vmarquee" style="position: absolute; width: 98%;">

	<!--YOUR SCROLL CONTENT HERE-->
		<div align="center"><span class="banner_adds">
		<?php
		$banner=mysql_query("SELECT * FROM banner ORDER BY id_banner DESC LIMIT 4");
		while($b=mysql_fetch_array($banner)){
  		echo "<p align='left'><a href='$b[url]'' target='_blank' title='$b[judul]'><img width=200 src='foto_banner/$b[gambar]' border=0></a></p><br><br>";
}
?>
         </span>
        </div>
</div>
</div>
                    
                    
                    </td>
                  </tr>
            </table>
          </div>
		  
		  
		  
		  
		  
		  
    	</div>
    	<div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div id="footer">
        <div class="copyright_network">
		
            	<p><script language="javascript">
document.write("<a href='http://twitter.com/home/?status=" + document.URL + "' target='_blank'><img src='<?php echo "images/twitter_icon.gif" ?>' border='0'/></a> &nbsp; <a href='http://www.facebook.com/share.php?u=" + document.URL + "' target='_blank'><img src='<?php echo "images/facebook_icon.gif" ?>' border='0'/></a>");
</script>
                <a href="rss.xml"><img src="images/rss.gif" alt="" border="0" /></a>
        	Copyright Â©2013 Developed by : SIM Poltekpos </p>

        </div>    
        <div class="clear"></div>
	</div>
</div>

        
        <div title="GO TO TOP" align="center" style="position: fixed; bottom: 0%; right: 5px; opacity: 1; cursor: pointer;" id="topcontrol">
        <!------- FOOTER PAGE -------------------------------------------------------------->
		<div id="divfooterdefault">		<div style="position: relative;">
		<table border="0" cellpadding="0" cellspacing="0" height="100%" width="800px">
		  <tbody>
			<tr style="">
				<td style="width: 500px; height: 140px; background: url(&quot;./images/rightfooter.png&quot;) no-repeat scroll 0% 0% transparent;" valign="top">			
				<div style="z-index: 1000; font-size: 1em; float: left; position: absolute; padding-top: 106px; margin: 0pt; font-size:16px">
				
<script language="JavaScript1.2">

/*
Neon Lights Text
By JavaScript Kit (http://javascriptkit.com)
For this script, TOS, and 100s more DHTML scripts,
Visit http://www.dynamicdrive.com
*/

var message="PENERIMAAN MAHASISWA BARU (PMB) 2013 POLITEKNIK POS INDONESIA"
var neonbasecolor="white"
var neontextcolor="#E77817"
var flashspeed=100  //in milliseconds

///No need to edit below this line/////

var n=0
if (document.all||document.getElementById){
document.write('<font color="'+neonbasecolor+'">')
for (m=0;m<message.length;m++)
document.write('<span style="text-shadow:1px 1px 1px black;" id="neonlight'+m+'">'+message.charAt(m)+'</span>')
document.write('</font>')
}
else
document.write(message)

function crossref(number){
var crossobj=document.all? eval("document.all.neonlight"+number) : document.getElementById("neonlight"+number)
return crossobj
}

function neon(){

//Change all letters to base color
if (n==0){
for (m=0;m<message.length;m++)
//eval("document.all.neonlight"+m).style.color=neonbasecolor
crossref(m).style.color=neonbasecolor
}

//cycle through and change individual letters to neon color
crossref(n).style.color=neontextcolor

if (n<message.length-1)
n++
else{
n=0
clearInterval(flashing)
setTimeout("beginneon()",1500)
return
}
}

function beginneon(){
if (document.all||document.getElementById)
flashing=setInterval("neon()",flashspeed)
}
beginneon()
</script>
				</div>
				<div style="z-index: 1000; position: relative; top: 118px; left: 93px; text-align: left; text-shadow: 1px 1px 1px black; font-size: 9px; color: black;">
				
				</div>

				</td>
			</tr>
		  </tbody>
		</table>
		</div>
		</div>
        </div>
<div class="botnav">
</div>
<div title="GO TO TOP" style="position: fixed; bottom: 20px; right: 0px; opacity: 1; cursor: pointer;" id="topcontrol"><img src="images/bg_sekilasinfo.png" alt="" border="0"></div>
<div title="GO TO TOP" style="position: fixed; bottom: 300px; right: 0px; opacity: 1; cursor: pointer;" id="topcontrol"><img src="images/bg_sekilasinfo.png" alt="" border="0"></div>
</body>
</html>

