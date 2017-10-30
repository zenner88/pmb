<?php
$tanya=mysql_query("SELECT * FROM poling WHERE aktif='Y' and status='Pertanyaan'");
$t=mysql_fetch_array($tanya);
echo "<div class='category'>";
  echo "<div class='small_heading'>
  
        </div>";

	echo "<p style='padding-left:10px;padding-right:5px;margin-bottom:0px;'><b><span class='idtanggal'>$t[pilihan]</b></p>";
	echo "<form method=POST action='hasil-poling.html'>";
  $poling=mysql_query("SELECT * FROM poling WHERE aktif='Y' and status='Jawaban'");
                while ($p=mysql_fetch_array($poling)){
	  $tgl_agenda = tgl_indo($a['tgl_mulai']);
	echo "<p style='padding-left:5px;padding-right:55px;'><input type=radio name=pilihan value='$p[id_poling]' />&nbsp;<span class='idtanggal'>$p[pilihan]</p>";
  }
  echo "<p style='padding-left:10px;padding-right:5px;padding-top:5px ;'><input type=submit class=simplebtn  value=PILIH />
        </form>
     	<a href=lihat-poling.html><input type=submit class=simplebtn  value=LIHAT HASIL /></a></p>";
  echo "<div class='clear'>";
?>
