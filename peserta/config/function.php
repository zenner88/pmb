<?php
function tampil_modul(){
echo "<h2>Modul</h2>
<form method=post action='?module=modul'>
<input type=submit value='Tambah' name=tambah>
</form>
<table>
<tr><th>no</th><th>nama modul</th><th>link</th><th>publish</th><th>aksi</th></th></tr>";
$tampil=mysql_query("SELECT * FROM modul ORDER BY urutan");
while ($r=mysql_fetch_array($tampil)){
  echo "<tr><td>$r[urutan]</td>
        <td>$r[nama_modul]</td>
        <td><a href=$r[link]>$r[link]</a></td>
        <td align=center>$r[publish]</td>
        <td><a href=?aksi=editmodul&id=$r[id_modul]>Edit</a> | 
	          <a href=?aksi=hapusdata&id=$r[id_modul]>Hapus</a>
        </td></tr>";
}
echo "</table>";
}

function form_modul(){
echo "<h2>Tambah Modul</h2>
<form method=POST action='?aksi=inputmodul'>
<table>
<tr><td>Nama Modul</td> <td> : <input type=text name=nama_modul></td></tr>
<tr><td>Link</td>       <td> : <input type=text name=link size=30></td></tr>
<tr><td>Publish</td>    <td> : <input type=radio name=publish value='Y'>Y 
                               <input type=radio name=publish value='N'>N  </td></tr>
<tr><td>Urutan</td>     <td> : <input type=text name=urutan size=1></td></tr>
<tr><td colspan=2><input type=submit value=Simpan name=simpanmodul>
<input type=button value=Batal onclick=self.history.back()></td></tr>
</table>
</form>";
}

function edit_modul(){
$edit=mysql_query("SELECT * FROM modul WHERE id_modul='$_GET[id]'");
$r=mysql_fetch_array($edit);
echo "<h2>Edit Modul</h2>
<form method=POST action='?aksi=updatemodul'>
<input type=hidden name=id value='$r[id_modul]'>
<table>
<tr><td>Nama Modul</td><td> : <input type=text name=nama_modul value='$r[nama_modul]'></td></tr>
<tr><td>Link</td>      <td> : <input type=text name=link size=30 value='$r[link]'></td></tr>";
if ($r[publish]=='Y'){
echo "<tr><td>Publish</td> <td> : <input type=radio name=publish value=Y checked>Y  
                                  <input type=radio name=publish value=N> N</td></tr>";
}
else{
echo "<tr><td>Publish</td> <td> : <input type=radio name=publish value=Y>Y  
                                  <input type=radio name=publish value=N checked>N</td></tr>";
}
echo "<tr><td>Urutan</td><td> : <input type=text name=urutan size=1 value='$r[urutan]'></td></tr>
<tr><td colspan=2><input type=submit value=Update>
<input type=button value=Batal onclick=self.history.back()></td></tr>
</table>
</form>";
}
?>
