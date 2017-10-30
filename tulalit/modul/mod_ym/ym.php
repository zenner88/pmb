<?php
$aksi="modul/mod_ym/aksi_ym.php";
switch($_GET[act]){
  // Tampil YM
  default:
    echo "<h2>Yahoo Messenger Status</h2>
          <input type=button class=tombol value='Tambahkan User' 
          onclick=\"window.location.href='?module=ym&act=tambahym';\">
          <table>
          <tr><th>No</th><th>Nama</th><th>Username</th><th>Aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM mod_ym ORDER BY id DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama]</td>
			 <td>$r[username]</td>
             <td><a href=?module=ym&act=editym&id=$r[id]><b>Edit</b></a> | 
	               <a href=$aksi?module=ym&act=hapus&id=$r[id]><b>Hapus</b></a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
	echo "";
    break;
  
  // Form Tambah YM
  case "tambahym":
    echo "<h2>Tambah User Yahoo Messenger</h2>
          <form method=POST action='$aksi?module=ym&act=input'>
          <table>
          <tr><td>Nama</td><td> : <input type=text name='nama'></td></tr>
		  <tr><td>Username</td><td> : <input type=text name='username'></td></tr>
          <tr><td colspan=2><input type=submit name=submit class=tombol value=Simpan>
                            <input type=button class=tombol value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit YM  
  case "editym":
    $edit=mysql_query("SELECT * FROM mod_ym WHERE id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Yahoo Messenger</h2>
          <form method=POST action=$aksi?module=ym&act=update>
          <input type=hidden name=id value='$r[id]'>
          <table>
          <tr><td>Nama</td><td> : <input type=text name='nama' value='$r[nama]'></td></tr>
		  <tr><td>Username</td><td> : <input type=text name='username' value='$r[username]'></td></tr>
          <tr><td colspan=2><input type=submit class=tombol value=Update>
                            <input type=button class=tombol value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
