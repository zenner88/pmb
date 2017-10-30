<?php    
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{


$aksi="modul/mod_gelombang/aksi_gelombang.php";
switch($_GET[act]){
  // Tampil Gelombang
  default:
    echo "<h2>Kelola Gelombang</h2>
          <table>
          <tr><th>No</th><th>Kode Gelombang</th><th>Nama Gelombang</th><th>Keterangan</th><th>Status</th><th>Aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);


      $tampil = mysql_query("SELECT * FROM t_gel ORDER BY Id DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      echo "<tr class=menucell onMouseDown=pviiClassNew(this,'mousedown') onMouseOut=pviiClassNew(this,'menucell') onMouseOver=pviiClassNew(this,'mouseover')>
	  			<td>$no</td>
                <td>$r[KodeGel]</td>
				<td>$r[NamaGel]</td>
				<td>$r[Ket]</td>
				<td>$r[status]</td>
				<td><a href=?module=gelombang&act=editgelombang&id=$r[Id]>Edit</a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM t_gel"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<p>Hal: $linkHalaman</p><br>";
 
    break;

  //Edit Gelombang
  case "editgelombang":
    $edit = mysql_query("SELECT * FROM t_gel WHERE Id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Ubah Gelombang</h2>
          <form method=POST action=$aksi?module=gelombang&act=update>
          <input type=hidden name=id value=$r[Id]>
          <table>
          <tr><td>Kode Gelombang</td>     <td> : $r[KodeGel]</td></tr>
		  <tr><td>Nama Gelombang</td>     <td> : $r[NamaGel]</td></tr>
		  <tr><td>Keterangan</td>     <td> : $r[Ket]</td></tr>
		  <tr><td>Status</td>  <td> : 
		  <select name='status'>
		      <option value=0 selected>- Pilih Status Gelombang -</option>
			  <option value=on>On</option>
			  <option value=off>Off</option>
			  </select>
		  </td></tr>
		  <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}
}
?>