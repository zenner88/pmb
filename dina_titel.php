<?php
if (isset($_GET['id'])){
    $sql = mysql_query("select judul from berita where id_berita='$_GET[id]'");
    $j   = mysql_fetch_array($sql);
    if ($j) {
        echo "$j[judul]";
    } else
		echo ".: PMB 2012 - Politeknik Pos Indonesia :.";
}
else{
		echo ".: PMB 2012 - Politeknik Pos Indonesia :.";
}

?>
