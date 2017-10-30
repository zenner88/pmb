<?php
// Halaman utama (Home)
if ($_GET['module']=='beranda'){
  // Data selamat datang mengacu pada id_modul=56
  include "slide.php";

	$profil = mysql_query("SELECT * FROM modul WHERE id_modul='56'");
	$r      = mysql_fetch_array($profil);

  echo "<tr><td class=isi>";
  if ($r['gambar']!=''){
		
	}            
}

if ($_GET['module']=='login'){
  include "login.php";
}

if ($_GET['module']=='pendaftaran'){
  include "pendaftaran.php";
}

if ($_GET['module']=='ceklogin'){
  include "peserta/cek_login.php";
}

if ($_GET['module']=='validasi'){
  include "daftar/validasi.php";
}

if ($_GET['module']=='kartu'){
  include "daftar/kartu.php";
}
// Modul detail berita
elseif ($_GET['module']=='detailberita'){
	$detail=mysql_query("SELECT * FROM berita,admins,kategori    
                      WHERE admins.username=berita.username 
                      AND kategori.id_kategori=berita.id_kategori 
                      AND id_berita='$_GET[id]'");
	$d   = mysql_fetch_array($detail);
	$tgl = tgl_indo($d['tanggal']);
	$baca = $d['dibaca']+1;
	echo "<br><br><span class=tanggal><img src=images/clock.gif> $d[hari], $tgl - $d[jam] WIB</span><br />";
	echo "<span class=judul><h4 class='heading colr'>$d[judul]</h4></span><br />";
	echo "<span class=posting>Diposting oleh : <b>$d[nama_lengkap]</b><br /> 
        Kategori: <a href=kategori-$d[id_kategori]-$d[kategori_seo].html><b>$d[nama_kategori]</b></a> 
        - Dibaca: <b>$baca</b> kali</span><br />";
  // Apabila ada gambar dalam berita, tampilkan   
 	if ($d['gambar']!=''){
		echo "<p><span class=image><img src='foto_berita/$d[gambar]' border=0></span></p>";
	}
 	//$isi_berita=nl2br($d[isi_berita]); // membuat paragraf pada isi berita
	echo "$d[isi_berita] <br />";
	
	
	
  
  
  
}

// Modul berita per kategori
elseif ($_GET['module']=='detailkategori'){
  // Tampilkan nama kategori
  
  $p      = new Paging3;
  $batas  = 8;
  $posisi = $p->cariPosisi($batas);
  
  // Tampilkan daftar berita sesuai dengan kategori yang dipilih
 	$sql   = "SELECT * FROM berita WHERE id_kategori='$_GET[id]' 
            ORDER BY id_berita DESC LIMIT $posisi,$batas";		 

	$hasil = mysql_query($sql);
	$jumlah = mysql_num_rows($hasil);
	
	$detail	=mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
	$d		= mysql_fetch_array($detail);
	echo "<span class=judul><h4 class='heading colr'>Berita $d[nama_kategori]</h4></span><br />";
	
	// Apabila ditemukan berita dalam kategori
	if ($jumlah > 0){
   while($r=mysql_fetch_array($hasil)){
		$tgl = tgl_indo($r['tanggal']);
		echo "<table>";
		echo "<tr><td><span class=date><img src=images/clock.gif> $r[hari], $tgl - $r[jam] WIB</span><br />";
		echo "<span class=judul><b><a href=berita-$r[id_berita]-$r[judul_seo].html>$r[judul]</a></b></span><br />";
 		// Apabila ada gambar dalam berita, tampilkan
    if ($r['gambar']!=''){
			echo "<span class=image><img src='foto_berita/small_$r[gambar]' width=110 border=0></span>";
		}
    // Tampilkan hanya sebagian isi berita
    $isi_berita = htmlentities(strip_tags($r['isi_berita'])); // membuat paragraf pada isi berita dan mengabaikan tag html
    $isi = substr($isi_berita,0,5000); // ambil sebanyak 220 karakter
    $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat
    echo "$isi ... <a href=berita-$r[id_berita]-$r[judul_seo].html>(<b>Selengkapnya</b>)</a>
          <br /></td></tr></table><hr color=#CCC noshade=noshade /><br>";
	 }
	
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM berita WHERE id_kategori='$_GET[id]'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET['halkategori'], $jmlhalaman);

  echo "<div class='halaman'>Halaman : $linkHalaman</div>";
  }
  else{
    echo "Belum ada berita pada kategori ini.";
  }
}

// Modul form pmdk
elseif ($_GET['module']=='formpmdk')
			{ 
$jalur = mysql_query("select * from tr_group where id=1");
$r_jalur = mysql_fetch_array($jalur);
			
			
			?>
		
			<center><h2>Pendaftaran Online Mahasiswa Baru Jalur PMDK Tahun <? echo"$r_tahun[n_tahun]";?></h2></center><br><br>
			<?PHP
			echo"
<table width='100%'>			
<b>DATA CALON MAHASISWA</b>
<form name='demo'  action=simpan-aksi-pmdk.html method=POST onSubmit=\"return validasi_pmdk(this)\">
<tr>			
<td>Nama </td> <td width='2%'>:</td> <td width=''><input type='text' size='40' name='nama'></td></tr>
			
<tr><td>Tempat Tanggal Lahir </td> <td>:</td> <td><input type='text' name='tempat_lahir'> ";    
          combotgl(1,31,'tgl_mulai',$get_tgl);
          combonamabln(1,12,'bln_mulai',$get_bln);
          $get_thn=substr($thn_sekarang-18,0,4);
          combothn($thn_sekarang-33,$thn_sekarang,'thn_mulai',$get_thn);

    echo "</td></tr>
			
<tr><td> Jenis Kelamin</td> <td>:</td> <td><input type='radio' value='L' name='jk' checked> Laki-laki  <br> <input type='radio' name='jk' value='P'> Perempuan</td></tr>
			
<tr><td>Agama</td> <td>:</td> <td>";
?>
<select name="agama">
          <?php
                 // query untuk menampilkan propinsi
                 $agama = mysql_query("SELECT * FROM tr_agama");
                 while ($r_agama = mysql_fetch_array($agama))
                 {
                    echo "<option value='".$r_agama['id']."'>".$r_agama['n_agama']."</option>";
                 }
          ?>
          </select>
<?PHP		  
echo"</td></tr>			
<tr><td> Alamat Rumah</td> <td>:</td> <td><input type='text' size='60' name='alamat_asal'></td></tr>

<tr><td> Propins</td> <td>:</td> <td><select name='propinsi' onchange='showKab()'>
          <option>Propinsi</option>";
		  
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM tr_prop";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    echo "<option value='".$data['id_prop']."'>".$data['n_prop']."</option>";
                 }
         echo"</select></td></tr> <tr><td>Kabupaten</td> <td>:</td> <td><select name='kab' id='kabupaten'></select></td></tr>
		 
<tr><td>Kode Pos</td> <td>:</td> <td><input type='text' size='6' name='pos_asal'></td></tr>
			
<tr><td>No Telepon</td> <td>:</td> <td>  <input type='text' name='telp_rumah'></td></tr> 
<tr><td>No HP</td> <td>:</td> <td><input type='text' name='hp'></td></tr> 
			
<tr><td>Asal Sekolah</td> <td>:</td> <td><input type='text' size='40' name='sma'></td></tr>

<tr><td>Jurusan SMA/SMK</td> <td>:</td> <td>";
?>
<select name="jur_sma">
          <?php
                 // query untuk menampilkan propinsi
                 $sma = mysql_query("SELECT * FROM tr_jursma");
                 while ($r_sma = mysql_fetch_array($sma))
                 {
                    echo "<option value='".$r_sma['id']."'>".$r_sma['n_jurusan']."</option>";
                 }
          ?>
          </select>
<?PHP		  
echo"			
<tr><td>Alamat Sekolah</td> <td>:</td> <td><input type='text' size='60' name='alamat_sma'></td></tr>
			
<tr><td>Propinsi</td> <td>:</td> <td><select name='propinsi1' onchange='showKab1()'>
          <option>Propinsi</option>";
		  
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM tr_prop";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    echo "<option value='".$data['id_prop']."'>".$data['n_prop']."</option>";
                 }
         echo"</select> </td></tr> <tr><td>Kabupaten</td> <td>:</td> <td><select name='kab1' id='kabupaten1'></select></td></tr>
		 
<tr><td>Kode Pos</td> <td>:</td> <td><input type='text' size='6' name='pos_sma'>		 
</table>	
<br>			
<div class='header_02b'><b>DATA RAPORT CALON MAHASISWA</b></div>
<table width='100%'>			

<div class='content_section_01b'>	
		
<tr><td width='25%'>Nilai Matematika SMT IV</td> <td width='2%'>:</td> <td><input type='text' size='4' name='mat_4'></td></tr>
			
<tr><td>Nilai Matematika SMT V</td> <td>:</td> <td><input type='text' size='4' name='mat_5'></td></tr>
			
<tr><td>Nilai Bhs. Inggris SMT IV</td> <td>:</td> <td><input type='text' size='4' name='ing_4'></td></tr>
			
<tr><td>Nilai Bhs. Inggris SMT V</td> <td>:</td> <td><input type='text' size='4' name='ing_5'></td></tr>

</div>			
</table>	
<br>			
			
<b>PILIHAN PROGRAM STUDI</b>	
<table width='100%'>			
			
";

function combo($var, $data) {
	echo "<select name='$var' onChange='validate_pil(this.form)'  class='validate-selection'>";
	echo "<option value=0 selected>- Pilih Program Studi -</option>";
	$sql=mysql_query("SELECT * FROM tm_prodi");
	while ($data=mysql_fetch_array($sql)){
		echo "<option value=$data[id]>$data[n_prodi]</option>";
	}	
	echo "</select>";
}

echo"			
<tr><td width='25%'>Pilihan Pertama</td> <td width='2%'>:</td> <td>"; combo("n_pil1",$data1);  echo"</td></tr>";

echo"	
	
<tr><td>Pilihan Kedua</td> <td>:</td> <td>"; combo("n_pil2",$data2); echo"</td></tr>
<tr><td>Pilihan Ketiga</td> <td>:</td> <td>"; combo("n_pil3",$data3); echo"</td></tr>";

//-- NOMOR REGISTRASI

global $str;
function rand_alphanumeric() {
   $subsets[0] = array('min' => 48, 'max' => 57); // ascii digits
   $subsets[1] = array('min' => 65, 'max' => 90); // ascii lowercase English letters
   $subsets[2] = array('min' => 97, 'max' => 122); // ascii uppercase English letters
   // random choice between lowercase, uppercase, and digits
   $s = rand(0, 2);
   $ascii_code = rand($subsets[$s]['min'], $subsets[$s]['max']);
   return chr( $ascii_code );
}  
function make_token() {
global $str;
  $str = "";
  for ($i=0; $i<5; $i++) 
  $str .= rand_alphanumeric();
  $pos = rand(0, 24);
  $str .= chr(65 + $pos);
  return $str . substr(md5($str . SECRET), $pos, 7);
}
make_token();
$str2="$str";
srand((double)microtime()*1000000);
$rand=substr(str_shuffle($str2),0,7);
$tokencode=$rand;

echo"
<tr><td colspan='2'></td><td> <img src='captcha.php'> <br><br><input type=text name=kode size=6 maxlength=6>* Masukkan 6 kode diatas </td></tr>
<input type='hidden' name='no_pendaftaran' value='PMDK-$r_tahun[n_tahun]-$tokencode'></td></tr>
<input type='hidden' value='$r_tahun[id]' name='tahun'>
<input type='hidden' value='$r_jalur[id]' name='jalur'>  
<tr><td colspan='2'></td><td><input type='submit' value='Simpan'> <input type='reset' value='Batal'></td></tr>
</form>	
</table>	
			";
			?>
<b>CATATAN</b>. : 
<ul>
<li>Setelah berhasil melakukan pendaftaran, segera lakukan pembayaran uang pendaftaran sebesar Rp.200.000,00 (Duaratus Ribu Rupiah)</li>
<li>Pembayaran dapat dilakukan di <br />
    Giropos online di no. rek 400 011517 9 a.n Yayasan PBPI<br />
    Bank BNI di no. 0028676942 a.n YPBPI<br />
	*Harap tuliskan No Pendaftaran, setelah menuliskan nama pengirim
</li>
<li>Copy bukti pembayaran harap dikirim ke alamat berikut (*lewat pos, email atau fax)<br />
Sekretariat PMB Poltekpos-Stimlog<br />
Jl. Sariasih No.54 Bandung 40151<br />
Tlp: 022-2009562, 022-61693672, 022-93250092, Fax : 022-2011089<br />
E-mail : smb-poltekpos@poltekpos.ac.id, smb-stimlog@poltekpos.ac.id<br />
http//: www.smbpoltekpos-stimlog.ac.id</li>
<li>Kartu Ujian akan dikirim melalui email Saudara, setelah dilakukan verifikasi pembayaran oleh panitia</li>
</ul>			
			<?PHP
			}


// Modul form reguler
elseif ($_GET['module']=='formreguler')
			{ 
			?>
		
			<center><h2>Pendaftaran Online Mahasiswa Baru Jalur Reguler <? echo"$r_gel[NamaGel]";?> Tahun <? echo"$r_tahun[n_tahun]";?></h2></center><br><br>
			<?PHP 
			echo"
<table width='100%'>			
<b>DATA CALON MAHASISWA</b>
<form name='demo'  action=simpan-aksi-reguler.html method=POST onSubmit=\"return validasi_reguler(this)\">
<tr>			
<td>Nama </td> <td width='2%'>:</td> <td width=''><input type='text' size='40' name='nama'></td></tr>
			
<tr><td>Tempat Tanggal Lahir </td> <td>:</td> <td><input type='text' name='tempat_lahir'> ";    
          combotgl(1,31,'tgl_mulai',$get_tgl);
          combonamabln(1,12,'bln_mulai',$get_bln);
          $get_thn=substr($thn_sekarang-18,0,4);
          combothn($thn_sekarang-33,$thn_sekarang,'thn_mulai',$get_thn);

    echo "</td></tr>
			
<tr><td> Jenis Kelamin</td> <td>:</td> <td><input type='radio' value='L' name='jk' checked> Laki-laki  <br> <input type='radio' name='jk' value='P'> Perempuan</td></tr>
			
<tr><td>Agama</td> <td>:</td> <td>";
?>
<select name="agama">
          <?php
                 // query untuk menampilkan propinsi
                 $agama = mysql_query("SELECT * FROM tr_agama");
                 while ($r_agama = mysql_fetch_array($agama))
                 {
                    echo "<option value='".$r_agama['id']."'>".$r_agama['n_agama']."</option>";
                 }
          ?>
          </select>
<?PHP		  
echo"</td></tr>			
<tr><td> Alamat Rumah</td> <td>:</td> <td><input type='text' size='60' name='alamat_asal'></td></tr>

<tr><td> Propins</td> <td>:</td> <td><select name='propinsi' onchange='showKab()'>
          <option>Propinsi</option>";
		  
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM tr_prop";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    echo "<option value='".$data['id_prop']."'>".$data['n_prop']."</option>";
                 }
         echo"</select></td></tr> <tr><td>Kabupaten</td> <td>:</td> <td><select name='kab' id='kabupaten'></select></td></tr>
		 
<tr><td>Kode Pos</td> <td>:</td> <td><input type='text' size='6' name='pos_asal'></td></tr>
			
<tr><td>No Telepon</td> <td>:</td> <td>  <input type='text' name='telp_rumah'></td></tr> 
<tr><td>No HP</td> <td>:</td> <td><input type='text' name='hp'></td></tr> 
			
<tr><td>Asal Sekolah</td> <td>:</td> <td><input type='text' size='40' name='sma'></td></tr>

<tr><td>Jurusan SMA/SMK</td> <td>:</td> <td>";
?>
<select name="jur_sma">
          <?php
                 // query untuk menampilkan propinsi
                 $sma = mysql_query("SELECT * FROM tr_jursma");
                 while ($r_sma = mysql_fetch_array($sma))
                 {
                    echo "<option value='".$r_sma['id']."'>".$r_sma['n_jurusan']."</option>";
                 }
          ?>
          </select>
<?PHP		  
echo"			
<tr><td>Alamat Sekolah</td> <td>:</td> <td><input type='text' size='60' name='alamat_sma'></td></tr>
			
<tr><td>Propinsi</td> <td>:</td> <td><select name='propinsi1' onchange='showKab1()'>
          <option>Propinsi</option>";
		  
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM tr_prop";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    echo "<option value='".$data['id_prop']."'>".$data['n_prop']."</option>";
                 }
         echo"</select> </td></tr> <tr><td>Kabupaten</td> <td>:</td> <td><select name='kab1' id='kabupaten1'></select></td></tr>
		 
<tr><td>Kode Pos</td> <td>:</td> <td><input type='text' size='6' name='pos_sma'>		 
</table>	
<br>
<table width='100%'>			
<div class='header_02b'><b>TEMPAT UJIAN SARINGAN MASUK (USM)</b></div>
<div class='content_section_01b'>
<tr><td  width='25%'>Pilih Tempat USM</td><td width='2%'>:</td><td>"; 
?>
<select name="usm">
          <?php
                 // query untuk menampilkan propinsi
                 $usm = mysql_query("SELECT * FROM tr_tempat");
                 while ($r_usm = mysql_fetch_array($usm))
                 {
                    echo "<option value='".$r_usm['id']."'>".$r_usm['n_tempat']."</option>";
                 }
          ?>
          </select>
<?PHP		  
echo"</td></tr>
</div>			

</table>
<br>			
			
<b>PILIHAN PROGRAM STUDI</b>	
<table width='100%'>			
			
";

function combo($var, $data) {
	echo "<select name='$var' onChange='validate_pil(this.form)'  class='validate-selection'>";
	echo "<option value=0 selected>- Pilih Program Studi -</option>";
	$sql=mysql_query("SELECT * FROM tm_prodi");
	while ($data=mysql_fetch_array($sql)){
		echo "<option value=$data[id]>$data[n_prodi]</option>";
	}	
	echo "</select>";
}

echo"			
<tr><td width='25%'>Pilihan Pertama</td> <td width='2%'>:</td> <td>"; combo("n_pil1",$data1);  echo"</td></tr>";

echo"	
	
<tr><td>Pilihan Kedua</td> <td>:</td> <td>"; combo("n_pil2",$data2); echo"</td></tr>
<tr><td>Pilihan Ketiga</td> <td>:</td> <td>"; combo("n_pil3",$data3); echo"</td></tr>";

//-- NOMOR REGISTRASI

global $str;
function rand_alphanumeric() {
   $subsets[0] = array('min' => 48, 'max' => 57); // ascii digits
   $subsets[1] = array('min' => 65, 'max' => 90); // ascii lowercase English letters
   $subsets[2] = array('min' => 97, 'max' => 122); // ascii uppercase English letters
   // random choice between lowercase, uppercase, and digits
   $s = rand(0, 2);
   $ascii_code = rand($subsets[$s]['min'], $subsets[$s]['max']);
   return chr( $ascii_code );
}  
function make_token() {
global $str;
  $str = "";
  for ($i=0; $i<5; $i++) 
  $str .= rand_alphanumeric();
  $pos = rand(0, 24);
  $str .= chr(65 + $pos);
  return $str . substr(md5($str . SECRET), $pos, 7);
}
make_token();
$str2="$str";
srand((double)microtime()*1000000);
$rand=substr(str_shuffle($str2),0,7);
$tokencode=$rand;

echo"
<tr><td colspan='2'></td><td> <img src='captcha.php'> <br><br><input type=text name=kode size=6 maxlength=6>* Masukkan 6 kode diatas </td></tr>
<input type='hidden' name='no_pendaftaran' value='PMDK-$r_tahun[n_tahun]-$tokencode'></td></tr>
<input type='hidden' value='$r_tahun[id]' name='tahun'>
<input type='hidden' value='$r_jalur[id]' name='jalur'>  
<tr><td colspan='2'></td><td><input type='submit' value='Simpan'> <input type='reset' value='Batal'></td></tr>
</form>	
</table>	
			";
			?>
<b>CATATAN</b>. : 
<ul>
<li>Setelah berhasil melakukan pendaftaran, segera lakukan pembayaran uang pendaftaran sebesar Rp.200.000,00 (Duaratus Ribu Rupiah)</li>
<li>Pembayaran dapat dilakukan di <br />
    Giropos online di no. rek 400 011517 9 a.n Yayasan PBPI<br />
    Bank BNI di no. 0028676942 a.n YPBPI<br />
	*Harap tuliskan No Pendaftaran, setelah menuliskan nama pengirim
</li>
<li>Copy bukti pembayaran harap dikirim ke alamat berikut (*lewat pos, email atau fax)<br />
Sekretariat PMB Poltekpos-Stimlog<br />
Jl. Sariasih No.54 Bandung 40151<br />
Tlp: 022-2009562, 022-61693672, 022-93250092, Fax : 022-2011089<br />
E-mail : smb-poltekpos@poltekpos.ac.id, smb-stimlog@poltekpos.ac.id<br />
http//: www.smbpoltekpos-stimlog.ac.id</li>
<li>Kartu Ujian akan dikirim melalui email Saudara, setelah dilakukan verifikasi pembayaran oleh panitia</li>
</ul>			
			
			<?PHP
			}

// Menu utama di header

// Modul profil
if ($_GET['module']=='profilkami'){
  // Data profil mengacu pada id_modul=43
	$profil = mysql_query("SELECT * FROM modul WHERE id_modul='43'");
	$r      = mysql_fetch_array($profil);

  echo "<h4 class='heading colr'>Profil Kami</h4>
    	  <div class='prod_box_bigx'>
 
            </div>
          <div class='profil'>
              <div>$r[static_content]</div>
			  <div class='bottom_prod_box_big4'></div>
          </div>    
          </div>
          </div>";                             
}

// Modul Cara Pendaftaran
if ($_GET['module']=='carabeli'){
  // Data cara pembelian mengacu pada id_modul=45
	$cara = mysql_query("SELECT * FROM modul WHERE id_modul='45'");
	$r    = mysql_fetch_array($cara);

  echo "<h4 class='heading colr'>Cara Pendaftaran Peserta</h4>

             <div class='carabeli'>
              <div>$r[static_content]</div>
          </div>    
          </div>
        
			  <div class='bottom_prod_box_big7'></div>
          </div>";                             
}

// Modul Pendaftaran PMDK
if ($_GET['module']=='pmdk'){
  // Data cara pembelian mengacu pada id_modul=45
	$cara = mysql_query("SELECT * FROM modul WHERE id_modul='64'");
	$r      = mysql_fetch_array($cara);

  echo "<h4 class='heading colr'>Cara Pendaftaran PMDK - Jalur Prestasi</h4>

             <div class='carabeli'>
              <div>$r[static_content]</div>
          </div>    
          </div>
        
			  <div class='bottom_prod_box_big7'></div>
          </div>";                             
}

// Modul Pendaftaran Reguler

if ($_GET['module']=='reguler'){
  // Data cara pembelian mengacu pada id_modul=45
	$cara = mysql_query("SELECT * FROM modul WHERE id_modul='65'");
	$r      = mysql_fetch_array($cara);

  echo "<h4 class='heading colr'>Cara Pendaftaran Reguler</h4>

             <div class='carabeli'>
              <div>$r[static_content]</div>
          </div>    
          </div>
        
			  <div class='bottom_prod_box_big7'></div>
          </div>";                             
}

// Modul Biaya
if ($_GET['module']=='biaya'){
  // Data biaya mengacu pada id_modul = 68
	$cara = mysql_query("SELECT * FROM modul WHERE id_modul='68'");
	$r      = mysql_fetch_array($cara);

  echo "<h4 class='heading colr'>Biaya</h4>

             <div class='carabeli'>
              <div>$r[static_content]</div>
          </div>    
          </div>
        
			  <div class='bottom_prod_box_big7'></div>
          </div>";                             
}


// Modul semua download
elseif ($_GET['module']=='semuadownload'){

  echo "<h4 class='heading colr'>Download</h4>"; 
  $p      = new Paging5;
  $batas  = 10;
  $posisi = $p->cariPosisi($batas);
  // Tampilkan semua download
 	$sql = mysql_query("SELECT * FROM download  
                      ORDER BY id_download DESC LIMIT $posisi,$batas");		  
   while($d=mysql_fetch_array($sql)){
      echo "<p class='download'><a href='downlot.php?file=$d[nama_file]'>&bull; $d[judul]</a> <span class='download2'>(didownload: $d[hits]x)</p>";
	 }

	
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM download"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[haldownload], $jmlhalaman);

 echo "<hr color=#CCC noshade=noshade /><div class='halaman'>Halaman : $linkHalaman </div>";
  echo "</div>
    </div>";            
} 


// Modul hubungi kami
elseif ($_GET['module']=='hubungikami'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<h4 class='heading colr'>Hubungi Kami</h4>"; 
  echo "<h2>Sekretariat PMB POLTEKPOS & STIMLOG</h2></BR>
  
				Jl. Sariasih 54 Sarijadi Bandung 40151<BR/>
				Telepon :022-2009562,2009570<BR/>
				Fax : 022-2011099<BR/>
				Mobile :081314550006,081572189015,089694909220<BR/>
				PIN BB : 5A579F54<BR/>
				E-Mail :<a href='mailto:info@poltekpos.ac.id'>info@poltekpos.ac.id</a> | <a href='mailto:pmb@stimlog.ac.id'>pmb@stimlog.ac.id</a><BR/>
			</BR><!-- end .contact-info -->
  ";
  echo "<b> <div class='table5'>Hubungi kami secara online dengan mengisi form di bawah ini:</b>
        <table width=100% style='border: 0pt dashed #0000CC;padding: 10px;'>
        <form action=hubungi-aksi.html method=POST>
        <tr><td><span class='table4'>Nama:</td><td>  <input type=text class='isikoment3' name=nama size=40></td></tr>
        <tr><td><span class='table4'>Email:</td><td>  <input type=text class='isikoment3' name=email size=40></td></tr>
        <tr><td><span class='table4'>Subjek:</td><td>  <input type=text class='isikoment3' name=subjek size=55></td></tr>
        <tr><td valign=top><span class='table4'>Pesan:</td><td><textarea class='isikoment3' name=pesan  style='width: 315px; height: 100px;'></textarea></td></tr>
        <tr><td>&nbsp;</td><td><img src='captcha.php'></td></tr>
        <tr><td>&nbsp;</td><td><span class=isikomen>(masukkan 6 kode di atas)<br /><input type=text class='isikoment3' name=kode size=10 maxlength=6><br /></td></tr>
        </td><td colspan=2><p style='padding-top:15px ;'><input style=' width: 85px; height: 23px;' type=submit  class=simplebtn value='KIRIM PESAN'></td></tr>
        </form></table><br />";
  echo "</div>
    <div class='bottom_prod_box_big6'></div>
    </div>";            
}


// Modul hubungi aksi
elseif ($_GET['module']=='hubungiaksi'){
  echo "<div id='content'>          
          <div id='content-detail'>";

$nama=trim($_POST[nama]);
$email=trim($_POST[email]);
$subjek=trim($_POST[subjek]);
$pesan=trim($_POST[pesan]);

if (empty($nama)){
  echo "<span class='table8'>Anda belum mengisikan NAMA<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
}
elseif (empty($email)){
  echo "<span class='table8'>Anda belum mengisikan EMAIL<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
}
elseif (empty($subjek)){
  echo "<span class='table8'>Anda belum mengisikan SUBJEK<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
}
elseif (empty($pesan)){
  echo "<span class='table8'>Anda belum mengisikan PESAN<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
}
else{
	if(!empty($_POST['kode'])){
		if($_POST['kode']==$_SESSION['captcha_session']){

  mysql_query("INSERT INTO hubungi(nama,
                                   email,
                                   subjek,
                                   pesan,
                                   tanggal) 
                        VALUES('$_POST[nama]',
                               '$_POST[email]',
                               '$_POST[subjek]',
                               '$_POST[pesan]',
                               '$tgl_sekarang')");
  echo "<h4 class='heading colr'>Hubungi Kami</h4></span><br />"; 
  echo "<span class='table8'><p align=center><div class='table5'><b>Terima kasih telah menghubungi kami. <br /> Kami akan segera meresponnya.</b></p>";
		}else{
			echo "<span class='table8'>Kode yang Anda masukkan tidak cocok<br />
			      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
		}
	}else{
		echo "<span class='table8'>Anda belum memasukkan kode<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}
}
  echo "</div>
<div class='bottom_prod_box_big9'>
    </div>";            
}

// Modul form pmdk aksi
elseif ($_GET['module']=='pmdkaksi'){
  echo "<div id='content'>          
          <div id='content-detail'>";

$no_pendaftaran=trim($_POST['no_pendaftaran']);
$nama=trim($_POST['nama']);
$jalur=trim($_POST['jalur']);
$tahun=trim($_POST['tahun']);
$tempat_lahir=trim($_POST['tempat_lahir']);
$mulai=$_POST[thn_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[tgl_mulai];
$jns_kel=trim($_POST['jk']);
$agama=trim($_POST['agama']);
$alamat_asal=trim($_POST['alamat_asal']);
$prop_asal=trim($_POST['propinsi']);
$kab_asal=trim($_POST['kab']);
$pos_asal=trim($_POST['pos_asal']);
$telp=trim($_POST['telp_rumah']);
$hp=trim($_POST['hp']);
$sma=trim($_POST['sma']);
$jur_sma=trim($_POST['jur_sma']);
$alamat_sma=trim($_POST['alamat_sma']);
$prop_sma=trim($_POST['propinsi1']);
$kab_sma=trim($_POST['kab1']);
$pos_sma=trim($_POST['pos_sma']);
$mat_4=trim($_POST['mat_4']);
$mat_5=trim($_POST['mat_5']);
$ing_4=trim($_POST['ing_4']);
$ing_5=trim($_POST['ing_5']);
$pil1=trim($_POST['n_pil1']);
$pil2=trim($_POST['n_pil2']);
$pil3=trim($_POST['n_pil2']);

function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

$nama = antiinjection($_POST['nama']);
$tempat_lahir = antiinjection($_POST['tempat_lahir']);
$alamat_asal = antiinjection($_POST['alamat_asal']);
$pos_asal = antiinjection($_POST['pos_asal']);
$sma = antiinjection($_POST['sma']);
$alamat_sma = antiinjection($_POST['alamat_sma']);
$pos_sma = antiinjection($_POST['pos_sma']);
$mat_4 = antiinjection($_POST['mat_4']);
$mat_5 = antiinjection($_POST['mat_5']);
$ing_4 = antiinjection($_POST['ing_4']);
$ing_5 = antiinjection($_POST['ing_5']);



	if(!empty($_POST['kode'])){
		if($_POST['kode']==$_SESSION['captcha_session']){

    $sql = mysql_query("INSERT INTO tm_pendaftaran(
	no_pendaftaran,
	n_nama,
	jalur,
	tahun,
	tempat_lahir,
	tgl_lahir,
	jns_kel,
	agama,
	alamat_tinggal,
	prop_tinggal,
	kab_tinggal,
	pos_tinggal,
	telp_rumah,
	hp,n_sma,
	jur_sma,
	alamat_sma,
	prop_sma,
	kab_sma,
	pos_sma,
	mat_4,
	mat_5,
	ing_4,
	ing_5,
	pil_1,
	pil_2,
	pil_3,
	n_gel,
	status) 
    VALUES(	'$no_pendaftaran',
			'$nama',
			'$jalur',
			'$tahun',
			'$tempat_lahir',
			'$mulai',
			'$jns_kel',
			'$agama',
			'$alamat_asal',
			'$prop_asal',
			'$kab_asal',
			'$pos_asal',
			'$telp',
			'$hp',
			'$sma',
			'$jur_sma',
			'$alamat_sma',
			'$prop_sma',
			'$kab_sma',
			'$pos_sma',
			'$mat_4',
			'$mat_5',
			'$ing_4',
			'$ing_5',
			'$pil1',
			'$pil2',
			'$pil3',
			'0',
			'Belum Bayar')");


  $query_tampil=mysql_query("select tm_pendaftaran.*,tr_group.n_group from tm_pendaftaran
  inner join tr_group on tr_group.id=tm_pendaftaran.jalur where tm_pendaftaran.no_pendaftaran='$no_pendaftaran'");
  $row_tampil=mysql_fetch_array($query_tampil);
	//D3
	//pil 1
	if ($row_tampil[pil_1] =='01')
	{
		$pil1 = "D3 - Logistik Bisnis";
	}
	
	if($row_tampil[pil_1] =='02')
	{
			$pil1 = "D3 - Manajemen Pemasaran";
	}
	if ($row_tampil[pil_1] =='03')
	{
		$pil1 = "D3 - Manajemen Informatika";
	}
	
	if($row_tampil[pil_1] =='04')
	{
			$pil1 = "D3 - Teknik Informatika";
	}
	if($row_tampil[pil_1] =='05')
	{
			$pil1 = "D3 - Akuntansi";
	}
	//---pil 2
	if ($row_tampil[pil_2] =='01')
	{
		$pil2 = "D3 - Logistik Bisnis";
	}
	
	if($row_tampil[pil_2] =='02')
	{
			$pil2 = "D3 - Manajemen Pemasaran";
	}
	if ($row_tampil[pil_2] =='03')
	{
		$pil2 = "D3 - Manajemen Informatika";
	}
	
	if($row_tampil[pil_2] =='04')
	{
			$pil2 = "D3 - Teknik Informatika";
	}
	if($row_tampil[pil_2] =='05')
	{
			$pil2 = "D3 - Akuntansi";
	}
	//-- pil 3
	if ($row_tampil[pil_3] =='01')
	{
		$pil3 = "D3 - Logistik Bisnis";
	}
	
	if($row_tampil[pil_3] =='02')
	{
			$pil3 = "D3 - Manajemen Pemasaran";
	}
	if ($row_tampil[pil_3] =='03')
	{
		$pil3 = "D3 - Manajemen Informatika";
	}
	
	if($row_tampil[pil_3] =='04')
	{
			$pil3 = "D3 - Teknik Informatika";
	}
	if($row_tampil[pil_3] =='05')
	{
			$pil3 = "D3 - Akuntansi";
	}
	
	//D4
	//pil 1
	if ($row_tampil[pil_1] =='11')
	{
		$pil1 = "D4 - Logistik Bisnis";
	}
	
	if($row_tampil[pil_1] =='12')
	{
			$pil1 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($row_tampil[pil_1] =='13')
	{
		$pil1 = "D4 - Teknik Informatika";
	}
	
	if($row_tampil[pil_1] =='14')
	{
			$pil1 = "D4 - Akuntansi Keuangan";
	}
	//---pil 2
	if ($row_tampil[pil_2] =='11')
	{
		$pil2 = "D4 - Logistik Bisnis";
	}
	
	if($row_tampil[pil_2] =='12')
	{
			$pil2 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($row_tampil[pil_2] =='13')
	{
		$pil2 = "D4 - Teknik Informatika";
	}
	
	if($row_tampil[pil_2] =='14')
	{
			$pil2 = "D4 - Akuntansi Keuangan";
	}
	//-- pil 3
	if ($row_tampil[pil_3] =='11')
	{
		$pil3 = "D4 - Logistik Bisnis";
	}
	
	if($row_tampil[pil_3] =='12')
	{
			$pil3 = "D4 - Manajemen Perusahaan / Bisnis";
	}
	if ($row_tampil[pil_3] =='13')
	{
		$pil3 = "D4 - Teknik Informatika";
	}
	
	if($row_tampil[pil_3] =='14')
	{
			$pil3 = "D4 - Akuntansi Keuangan";
	}
	
	echo "<table width='100%' border='0'>
<tr>
    <img src='images/logo.png' width='640'>
  </tr>
  <tr>
   &nbsp
  </tr>
  <tr>
   &nbsp
  </tr>
  <tr>
    <center><h1>BUKTI PENDAFTARAN ONLINE MAHASISWA BARU <br>POLITEKNIK POS INDONESIA<h1></center>
  </tr>
  <tr>
   &nbsp
  </tr>
  <tr>
    <td colspan='3'><B>DATA PENDAFTAR</B></td>
  </tr>
  <tr>
    <td width='7%'>No Pendaftaran </td>
    <td width='1%'>:</td>
    <td>$row_tampil[no_pendaftaran]</td>
  </tr>
  <tr>
    <td width='20%'>Nama Peserta </td>
    <td width='1%'>:</td>
    <td width='92%'>$row_tampil[n_nama]</td>
  </tr>
  <tr>
    <td width='20%'>Email</td>
    <td width='1%'>:</td>
    <td width='92%'>$row_tampil[n_nama]</td>
  </tr>
  <tr>
    <td>Jalur</td>
    <td>:</td>
    <td>$row_tampil[n_group]</td>
  </tr>
  <tr>
    <td colspan='3'><B>PILIHAN PROGRAM STUDI</B></td>
  </tr>
  <tr>
    <td>Pilihan 1 </td>
    <td>:</td>
    <td>$pil1</td>
  </tr>
  <tr>
    <td>Pilihan 2 </td>
    <td>:</td>
    <td>$pil2</td>
  </tr>
  <tr>
    <td>Pilihan 3 </td>
    <td>:</td>
    <td>$pil3</td>
  </tr>
  <tr>
    <td colspan='3'><b>CATATAN</b>. : 
<ul>
<li>Setelah berhasil melakukan pendaftaran, segera lakukan pembayaran uang pendaftaran sebesar Rp.200.000,00 (Duaratus Ribu Rupiah)</li>
<li>Pembayaran dapat dilakukan di <br />
    Giropos online di no. rek 400 011517 9 a.n Yayasan PBPI<br />
    Bank BNI di no. 0028676942 a.n YPBPI<br />
	*Harap tuliskan No Pendaftaran, setelah menuliskan nama pengirim
</li>
<li>Copy bukti pembayaran harap dikirim ke alamat berikut (*lewat pos, email atau fax)<br />
Sekretariat PMB Poltekpos-Stimlog<br />
Jl. Sariasih No.54 Bandung 40151<br />
Tlp: 022-2009562, 022-61693672, 022-93250092, Fax : 022-2011089<br />
E-mail : smb-poltekpos@poltekpos.ac.id<br />
http//: www.smbpoltekpos-stimlog.ac.id, smb-stimlog@poltekpos.ac.id</li>
<li>Kartu Ujian akan dikirim melalui email Saudara, setelah dilakukan verifikasi pembayaran oleh panitia</li>
</ul>			
</td>
  </tr>
  <tr>
    <td colspan='3'> <input TYPE='button' onClick='window.print()' value='Cetak Bukti Pendaftaran'></td>
  </tr>
</table>
";
		}else{
			echo "<span class='table8'>Kode yang Anda masukkan tidak cocok<br />
			      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
		}
	}else{
		echo "<span class='table8'>Anda belum memasukkan kode<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}

  echo "</div>
<div class='bottom_prod_box_big9'>
    </div>";            
}

// Modul form reguler aksi
elseif ($_GET['module']=='reguleraksi'){
  echo "<div id='content'>          
          <div id='content-detail'>";

$nama=trim($_POST[nama]);
$email=trim($_POST[email]);
$subjek=trim($_POST[subjek]);
$pesan=trim($_POST[pesan]);


	if(!empty($_POST['kode'])){
		if($_POST['kode']==$_SESSION['captcha_session']){

  mysql_query("INSERT INTO hubungi(nama,
                                   email,
                                   subjek,
                                   pesan,
                                   tanggal) 
                        VALUES('$_POST[nama]',
                               '$_POST[email]',
                               '$_POST[subjek]',
                               '$_POST[pesan]',
                               '$tgl_sekarang')");
  echo "<h4 class='heading colr'>Hubungi Kami</h4></span><br />"; 
  echo "<span class='table8'><p align=center><div class='table5'><b>Terima kasih telah menghubungi kami. <br /> Kami akan segera meresponnya.</b></p>";
		}else{
			echo "<span class='table8'>Kode yang Anda masukkan tidak cocok<br />
			      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
		}
	}else{
		echo "<span class='table8'>Anda belum memasukkan kode<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}

  echo "</div>
<div class='bottom_prod_box_big9'>
    </div>";            
}

// Modul semua album
elseif ($_GET['module']=='semuaalbum'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<h4 class='heading colr'>Album</h4><br />"; 
  // Tentukan kolom
  $col = 3;

  $a = mysql_query("SELECT jdl_album, album.id_album, gbr_album, album_seo,  
                  COUNT(gallery.id_gallery) as jumlah 
                  FROM album LEFT JOIN gallery 
                  ON album.id_album=gallery.id_album 
                  WHERE album.aktif='Y'  
                  GROUP BY jdl_album");
  echo "<table><tr>";
  $cnt = 0;
  while ($w = mysql_fetch_array($a)) {
    if ($cnt >= $col) {
      echo "</tr><tr>";
      $cnt = 0;
  }
  $cnt++;


 echo "<td align=center valign=top><br />
    <a href=album-$w[id_album]-$w[album_seo].html>
    <img class='img2' src='img_album/kecil_$w[gbr_album]' border=0 width=120 height=90><br />
    <h5>$w[jdl_album]</h5></a><br />($w[jumlah] Foto)<br /></td>";
}
echo "</tr></table>";
  echo "</div>
    </div>";            
}


// Modul galeri foto berdasarkan album
elseif ($_GET['module']=='detailalbum'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<h4 class='heading colr'><a href=semua-album.html>Album</a> &#187; Galeri Foto</h4><br />"; 
  $p      = new Paging6;
  $batas  = 10;
  $posisi = $p->cariPosisi($batas);

  // Tentukan kolom
  $col = 5;

  $g = mysql_query("SELECT * FROM gallery WHERE id_album='$_GET[id]' ORDER BY id_gallery DESC LIMIT $posisi,$batas");
  $ada = mysql_num_rows($g);
  
  if ($ada > 0) {
  echo "<table><tr>";
  $cnt = 0;
  while ($w = mysql_fetch_array($g)) {
    if ($cnt >= $col) {
      echo "</tr><tr>";
      $cnt = 0;
    }
    $cnt++;

   echo "<td align=center valign=top><br />
         <a href='img_galeri/$w[gbr_gallery]' title='$w[keterangan]' class='lightbox' rel='group1'>
         <img src='img_galeri/$w[gbr_gallery]' alt='$w[keterangan]' width=120 height=90 /></a><br />
         <b>$w[jdl_gallery]</b></a></td>";
  }
  echo "</tr></table><br />";

  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM gallery WHERE id_album='$_GET[id]'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halgaleri], $jmlhalaman);

  echo "<div class='halaman'>Halaman : $linkHalaman </div><br /><br />";
  }else{
    echo "<p>Belum ada foto.</p>";
  }
  echo "</div>
    </div>";            
}



// Modul hasil pencarian berita 
elseif ($_GET['module']=='hasilcari'){
  echo "<span class=judul_head><h4 class='heading colr'>&#187; Hasil Pencarian</h4></span><br />";
  // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST['kata']);
  // mencegah XSS
  $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);

  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  $cari = "SELECT * FROM berita WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "isi_berita LIKE '%$pisah_kata[$i]%' or judul LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }

  $cari .= " ORDER BY id_berita DESC LIMIT 7";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
    echo "<p>Ditemukan <b>$ketemu</b> berita dengan kata <font style='background-color:orange'><b>$kata</b></font> : </p>"; 
    while($t=mysql_fetch_array($hasil)){
		echo "<table><tr><td><span class=judul><b><a href=berita-$t[id_berita]-$t[judul_seo].html>$t[judul]</a></b></span><br />";
      // Tampilkan hanya sebagian isi berita
      $isi_berita = htmlentities(strip_tags($t['isi_berita'])); // membuat paragraf pada isi berita dan mengabaikan tag html
      $isi = substr($isi_berita,0,250); // ambil sebanyak 150 karakter
      $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

      echo "$isi ... <b><a href=berita-$t[id_berita]-$t[judul_seo].html>Selengkapnya</a></b>
            <br /></td></tr>
            </table><hr color=#CCC noshade=noshade />";
    }                                                          
  }
  else{
    echo "<p>Tidak ditemukan berita dengan kata <b>$kata</b></p>";
  }
}
     
?>
