<?php
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'><link href='css/reset.css' rel='stylesheet' type='text/css'>


 <center><br><br><br><br><br><br>Maaf, untuk masuk <b>Halaman Administrator</b><br>
  <center>anda harus <b>Login</b> dahulu!<br><br>";
 echo "<div> <a href='index.php'><img src='images/kunci.png'  height=176 width=143></a>
             </div>";
  echo "<input type=button class=simplebtn value='LOGIN DI SINI' onclick=location.href='index.php'></a></center>";
}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<script>
		!function ($) {
    
    // Le left-menu sign
    /* for older jquery version
    $('#left ul.nav li.parent > a > span.sign').click(function () {
        $(this).find('i:first').toggleClass("icon-minus");
    }); */
    
    $(document).on("click","#left ul.nav li.parent > a > span.sign", function(){          
        $(this).find('i:first').toggleClass("icon-minus");      
    }); 
    
    // Open Le current menu
    $("#left ul.nav li.parent.active > a > span.sign").find('i:first').addClass("icon-minus");
    $("#left ul.nav li.current").parents('ul.children').addClass("in");

}(window.jQuery);
	</script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description"  content=""/>
<meta name="keywords" content=""/>
<meta name="robots" content="ALL,FOLLOW"/>
<meta name="Author" content="Yannri Zenner"/>
<meta http-equiv="imagetoolbar" content="no"/>
<title>Halaman Administrator PMB</title>
<link rel="shortcut icon" type="image/x-icon" href="images/icon.png">
<!-- BOOTSTRAP -->
<link href="../css/bootstrap/css/bootstrap.css" rel="stylesheet">	
<script src="../css/bootstrap/js/jquery-3.2.1.slim.min.js"></script>
<script src="../css/bootstrap/js/popper.min.js"></script>
<script src="../css/bootstrap/js/bootstrap.min.js"></script>
<script src="../css/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- BOOT -->
<link href="../css/simple-sidebar.css" rel="stylesheet">		
<link rel="stylesheet" href="css/reset.css" type="text/css"/>
<link rel="stylesheet" href="css/screen.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.wysiwyg.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.ui.css" type="text/css"/>
<link rel="stylesheet" href="css/visualize.css" type="text/css"/>
<link rel="stylesheet" href="css/visualize-light.css" type="text/css"/>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.visualize.js"></script>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/jquery.idtabs.js"></script>
<script type="text/javascript" src="js/jquery.datatables.js"></script>
<script type="text/javascript" src="js/jquery.jeditable.js"></script>
<script type="text/javascript" src="js/jquery.ui.js"></script>
<script type="text/javascript" src="js/excanvas.js"></script>
<script type="text/javascript" src="js/cufon.js"></script>
<script type="text/javascript" src="js/Geometr231_Hv_BT_400.font.js"></script>
<script type="text/javascript" src="ckeditor.js"></script>

<style type="text/css">
<!--
.style3 {
	color: #62A621;
	font-weight: bold;
}
-->
/* MENU-LEFT
-------------------------- */
/* layout */
#left ul.nav {
    margin-bottom: 2px;
    font-size: 12px; /* to change font-size, please change instead .lbl */
}
#left ul.nav ul,
#left ul.nav ul li {
    list-style: none!important;
    list-style-type: none!important;
    margin-top: 1px;
    margin-bottom: 1px;
}
#left ul.nav ul {
    padding-left: 0;
    width: auto;
}
#left ul.nav ul.children {
    padding-left: 12px;
    width: auto;
}
#left ul.nav ul.children li{
    margin-left: 0px;
}
#left ul.nav li a:hover {
    text-decoration: none;
}

#left ul.nav li a:hover .lbl {
    color: #999!important;
}

#left ul.nav li.current>a .lbl {
    background-color: #999;
    color: #fff!important;
}

/* parent item */
#left ul.nav li.parent a {
    padding: 0px;
    color: #ccc;
}
#left ul.nav>li.parent>a {
    border: solid 1px #999;
    text-transform: uppercase;
}    
#left ul.nav li.parent a:hover {
    background-color: #fff;
    -webkit-box-shadow:inset 0 3px 8px rgba(0,0,0,0.125);
    -moz-box-shadow:inset 0 3px 8px rgba(0,0,0,0.125);
    box-shadow:inset 0 3px 8px rgba(0,0,0,0.125);    
}

/* link tag (a)*/
#left ul.nav li.parent ul li a {
    color: #222;
    border: none;
    display:block;
    padding-left: 5px;    
}

#left ul.nav li.parent ul li a:hover {
    background-color: #fff;
    -webkit-box-shadow:none;
    -moz-box-shadow:none;
    box-shadow:none;  
}

/* sign for parent item */
#left ul.nav li .sign {
    display: inline-block;
    width: 14px;
    padding: 5px 8px;
    background-color: transparent;
    color: #fff;
}
#left ul.nav li.parent>a>.sign{
    margin-left: 0px;
    background-color: #999;
}

/* label */
#left ul.nav li .lbl {
    padding: 5px 12px;
    display: inline-block;
}
#left ul.nav li.current>a>.lbl {
    color: #fff;
}
#left ul.nav  li a .lbl{
    font-size: 12px;
}

/* THEMATIQUE
------------------------- */
/* theme 1 */
#left ul.nav>li.item-1.parent>a {
    border: solid 1px #ff6307;
}
#left ul.nav>li.item-1.parent>a>.sign,
#left ul.nav>li.item-1 li.parent>a>.sign{
    margin-left: 0px;
    background-color: #ff6307;
}
#left ul.nav>li.item-1 .lbl {
    color: #ff6307;
}
#left ul.nav>li.item-1 li.current>a .lbl {
    background-color: #ff6307;
    color: #fff!important;
}

/* theme 2 */
#left ul.nav>li.item-8.parent>a {
    border: solid 1px #51c3eb;
}
#left ul.nav>li.item-8.parent>a>.sign,
#left ul.nav>li.item-8 li.parent>a>.sign{
    margin-left: 0px;
    background-color: #51c3eb;
}
#left ul.nav>li.item-8 .lbl {
    color: #51c3eb;
}
#left ul.nav>li.item-8 li.current>a .lbl {
    background-color: #51c3eb;
    color: #fff!important;
}

/* theme 3 */
#left ul.nav>li.item-15.parent>a {
    border: solid 1px #94cf00;
}
#left ul.nav>li.item-15.parent>a>.sign,
#left ul.nav>li.item-15 li.parent>a>.sign{
    margin-left: 0px;
    background-color: #94cf00;
}
#left ul.nav>li.item-15 .lbl {
    color: #94cf00;
}
#left ul.nav>li.item-15 li.current>a .lbl {
    background-color: #94cf00;
    color: #fff!important;
}

/* theme 4 */
#left ul.nav>li.item-22.parent>a {
    border: solid 1px #ef409c;
}
#left ul.nav>li.item-22.parent>a>.sign,
#left ul.nav>li.item-22 li.parent>a>.sign{
    margin-left: 0px;
    background-color: #ef409c;
}
#left ul.nav>li.item-22 .lbl {
    color: #ef409c;
}
#left ul.nav>li.item-22 li.current>a .lbl {
    background-color: #ef409c;
    color: #fff!important;
}
</style>
</head>

<!-- BATAS AWAL GreyBox -->
<script type="text/javascript">
var GB_ROOT_DIR = "greybox/";
</script>
<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
<!-- BATAS AKHIR GreyBox -->

<body>	
<div id="wrapper">         
<div id="sidebar-wrapper">
    <ul id="menu-group-1" class="sidebar-nav">
		<li class="sidebar-brand">			
			<img src="../img/logo.png" width="200" />	
		</li>
		<? if ($_SESSION['leveluser']=='admin'){ ?>
		<li class="item-8 deeper parent bg-dark">
		<a class="" href="#">
			<span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-1" class="">MENU PMB</span>
		</a>
			<ul class="children nav-child unstyled small collapse bg-light px-lg-2" id="sub-item-1">
				<?php include "menu2.php"; ?>
			</ul>
		</li>
		<? } ?>
		<li class="item-8 deeper parent bg-dark">
		<a class="" href="#">
			<span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-2" class="">MENU WEB</span>
		</a>
			<ul class="children nav-child unstyled small collapse bg-light px-lg-2" id="sub-item-2">
				<?php include "menu.php"; ?>
			</ul>
		</li>
		<? if ($_SESSION['leveluser']=='admin'){ ?>
			<li class="item-8 deeper parent bg-dark">
			<a class="" href="#">
				<span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-3" class="">MANAJEMEN ADMIN</span>
			</a>
				<ul class="children nav-child unstyled small collapse bg-light px-lg-2" id="sub-item-3">
					<?php include "menu3.php"; ?>
				</ul>
			</li>
		<? } ?>
    </ul>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <a class="navbar-brand" id="menu-toggle" href="#"><span class="navbar-toggler-icon"></span></a>
  <a class="navbar-brand" href="#">
    <img src="../img/logo-kecil.png" height="40" class="d-inline-block align-top my-2 my-sm-0" alt="">
</a>
  <div class="collapse navbar-collapse mr-sm-2" id="navbarNavAltMarkup">
	  <a class="nav-link" href="#"><B>Selamat Datang &nbsp;<?=$_SESSION['namalengkap']?></B></a>    
  </div>
<div class="navbar-nav">
	<a href="?module=home" class="nav-link">Beranda</a>
	<a href="?module=password" class="nav-link">Ganti Password</a>
	<a href="../?module=beranda" class="nav-link">Lihat Website</a>
	<a href="about.php" onClick="return GB_showCenter('Tentang Web', this.href)" class="nav-link">Tentang Web</a>
	<a href="logout.php" class="nav-link">Logout</a>	
</div>
</nav>
<div id="page-content-wrapper">
<div class="container-fluid">
	<div class="page clear">			
		<div class="jumbotron p-lg-3">
			<?php include "content.php"; ?>
		</div>
	</div>
</div>
</div>
</div>
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
</body>
</html>
<?php
}
?>