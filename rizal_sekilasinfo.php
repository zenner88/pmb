<?php
$sekilas=mysql_query("SELECT * FROM sekilasinfo ORDER BY id_sekilas DESC LIMIT 3");

if ($sekilas > 0){
echo "<div class='category'>";
  echo "<div class='small_heading'>

        </div><ul id='listticker'>";
  while($s=mysql_fetch_array($sekilas)){
   echo "<li><span class='news-text'>$s[info]</span></li>";
  }
  echo "</ul><div class='clear'></div><div class='left_botm2'>&nbsp;</div></div>";
}
?>
