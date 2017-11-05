<?php
include "../config/koneksi.php";
session_start();
mysql_query("UPDATE `t_pin` SET `is_online` = '0' WHERE `t_pin`.`pin` ='$_SESSION[pin]' LIMIT 1 ;");
  session_destroy();
  echo "<center>Anda telah sukses keluar sistem <b>[LOGOUT]<b>";
?>
<script type="text/javascript">
window.location = "/pmb-poltekpos/login"
</script>

