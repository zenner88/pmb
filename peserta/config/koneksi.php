<?php
$host="localhost";
$user="root";
$password="";
$db="pmb";

$koneksi=mysql_connect($host,$user,$password) or die("Tidak dapat terhubung ke server !!!");
mysql_select_db($db);
?>