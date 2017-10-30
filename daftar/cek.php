<?php
include('../config/koneksi.php');
if(isset($_POST['email']))
{
	$email = mysql_real_escape_string($_POST['email']);
	$cek = mysql_query("SELECT * FROM t_daftar WHERE email='$email'");
	if(mysql_num_rows($cek))
	{
		echo 'no';
	}
	else
	{
		echo 'yes';
	}
}
?>
