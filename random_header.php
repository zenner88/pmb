<?php
$jumlah_gambar = "4";
$file_type = ".jpg";
$folder_gambar = "header";
$nilai_pertama = "1";
$acak = mt_rand($nilai_pertama, $jumlah_gambar);
$image_name = $acak . $file_type;
echo ("<div align=\"center\">
<img src=\"$folder_gambar/$image_name\" border=\"0\"/>
</a></div>");
?>
