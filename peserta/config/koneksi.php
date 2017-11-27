<?php
$host="localhost";
$user="root";
$password="";
$db="pmb3";

$koneksi=mysql_connect($host,$user,$password) or die("Tidak dapat terhubung ke server !!!");
mysql_select_db($db);
?>