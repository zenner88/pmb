<?php
session_start();
include "../config/koneksi.php";
include "config/recaptchalib.php";
$publickey = "6Le8Tr4SAAAAAOwlk7qk8eZJ7i2gzWRXfK7r420n";
$privatekey = "6Le8Tr4SAAAAAEpek74I8a--2ZC5j09NPQfCk1Ux";
 if (empty($_SESSION['pin']) AND empty($_SESSION['kodeaktivasi'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_registrasi/aksi_registrasi.php";
switch($_GET[act]){
  // Tampil Komentar
  default:
    echo "<h2>Registrasi PMB Online Politeknik Pos Indonesia</h2>";
   ?>
<?php
  $sql_thnakademik="select * from t_tahun_akademik";
  $query_thnakademik=mysql_query($sql_thnakademik,$koneksi);
  $row_thnakademik=mysql_fetch_array($query_thnakademik);
  if ($_SESSION[jalur]=="Reguler"){
  ?>
	<form method=POST enctype='multipart/form-data' action=<?php echo "?module=registrasi&act=checkreg"; ?>>
<font color="#666666" face="ARIAL" size="2">	<table width="741" cellpadding="4">
<input type=hidden name=pin value=<?php echo $_SESSION[pin]; ?>>
	 <!-- GELOMBANG -->
	<table width="550" cellpadding="4">
	  <tbody>
	    <tr>
	      <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Gelombang</b><br>
	                  <?php
  $sql_gel="select * from t_gel where status='on'";
  $query_gel=mysql_query($sql_gel,$koneksi);
  $row_gel=mysql_fetch_array($query_gel);
  echo"$row_gel[3]";
  ?>
</span></td>
        </tr>
      </tbody>
	  </table>
	<table width="550" cellpadding="4">
	  <tbody>
	    <tr>
	      <td width="210" bgcolor="#dddddd">
	        Gelombang	  </td>
	        <td width="507" bgcolor="#eeeeee">
	          <!--
	   <INPUT TYPE="HIDDEN" NAME="gelombang" VALUE="1">Gelombang I
	   <BR>
	   -->
	          <input name="c_gel" value="<? echo"$row_gel[1]"; ?>" type="HIDDEN">  <? echo"$row_gel[2]"; ?>
  </td>
        </tr>
		   <tr>
	      <td width="210" bgcolor="#dddddd">
	        Biaya Pendaftaran	  </td>
	        <td width="507" bgcolor="#eeeeee">
	          <!--
	   <INPUT TYPE="HIDDEN" NAME="gelombang" VALUE="1">Gelombang I
	   <BR>
	   --><input type="text" value="150.000,-" readonly></td>
	       </tr>

	    <tr>
	      <td colspan="2" height="4"></td>
        </tr>

	    <!-- DATA PRIBADI -->
	    <tr>
	      <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
	  </tbody>
	</table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Pribadi Peserta</b><br>
            Isilah data pribadi Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="548" height="453" cellpadding="4">
      <tbody>
        <tr>
          <td width="133" bgcolor="#dddddd">
            Nama Lengkap * 	  </td>
	              <td width="391" bgcolor="#eeeeee">
          <input name="n_lengkap" type="TEXT" class="required" value="<?php echo $_SESSION['nama']; ?>" size="40" maxlength="80"></td>
        </tr>

        <tr>
          <td width="133" bgcolor="#dddddd">
            Jenis Kelamin *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_jns_kelamin" value="L" selected="" type="RADIO">Laki-laki
	                <br>
	                <input name="n_jns_kelamin" value="P" type="RADIO" class="validate-one-required">Perempuan	  </td>
        </tr>

        <tr>
          <td width="133" bgcolor="#dddddd">
            Tempat, Tanggal Lahir *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_temp_lahir" type="TEXT" class="required" value="<?php echo $_SESSION['tmptlahir']; ?>" size="15" maxlength="40">
	                ,

	                <input name="d_lahir" type="text" class="required" value="<?php echo $_SESSION['tgllahir']; ?>" readonly>
					<input type="button" value="Cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">	  </td>
        </tr>

        <tr>
          <td width="133" bgcolor="#dddddd" valign="top">
            Alamat yang dapat Dihubungi *	  </td>
	              <td bgcolor="#eeeeee">
	                <textarea name="n_alamat" rows="2" cols="30" class="required"><?php echo $_SESSION['alamat']; ?></textarea>
	                *Keterangan : Mohon isi kolom alamat dengan lengkap dengan format Jalan, No.rumah, RT/RW, Kelurahan/Kecamatan, dan lain-lain sesuai dengan format KTP
		  </td>
        </tr>
                 <tr>
          <td width="133" bgcolor="#dddddd" valign="top">
            Agama	  </td>
	              <td bgcolor="#eeeeee">
	                <select size='1' name='i_agama' value="<?php echo $_SESSION[agama];?>">
	                <option value='islam'>Islam</option>
	                <option value='kristen'>Kristen Protestan</option>
	                <option value='katolik'>Katolik</option>
	                <option value='hindu'>Hindu</option>
	                <option value='budha'>Budha</option>
	                </select>
				   </td>
	             </tr>

        <tr>
          <td width="133" bgcolor="#dddddd">
            Propinsi<br>
          Kabupaten / Kota *	  </td>
	              <td bgcolor="#eeeeee">
	                <!--
	   <INPUT TYPE="TEXT" NAME="kota" SIZE="25" MAXLENGTH="60">
	   -->

	                <script language="javascript">

kabupaten = new Array(

// Nangroe Aceh Darussalam
new Array(
new Array("Kab. Aceh Barat", "Kab. Aceh Barat"),
new Array("Kab. Aceh Barat Daya", "Kab. Aceh Barat Daya"),
new Array("Kab. Aceh Besar", "Kab. Aceh Besar"),
new Array("Kab. Aceh Jaya", "Aceh Jaya"),
new Array("Kab. Aceh Selatan", "Kab. Aceh Selatan"),
new Array("Kab. Aceh Singkil", "Kab. Aceh Singkil"),
new Array("Kab. Aceh Tamiang", "Kab. Aceh Tamiang"),
new Array("Kab. Aceh Tengah", "Kab. Aceh Tengah"),
new Array("Kab. Aceh Tenggara", "Kab. Aceh Tenggara"),
new Array("Kab. Aceh Timur", "Kab. Aceh Timur"),
new Array("Kab. Aceh Utara", "Kab. Aceh Utara"),
new Array("Kab. Bener Meriah", "Kab. Bener Meriah"),
new Array("Kab. Bireuen", "Kab. Bireuen"),
new Array("Kab. Gayo Lues", "Kab. Gayo Lues"),
new Array("Kab. Nagan Raya", "Kab. Nagan Raya"),
new Array("Kab. Pidie", "Kab. Pidie"),
new Array("Kab. Pidie Jaya", "Kab. Pidie Jaya"),
new Array("Kab. Simeulue", "Kab. Simeulue"),
new Array("Kota Banda Aceh", "Kota Banda Aceh"),
new Array("Kota Langsa", "Kota Langsa"),
new Array("Kota Lhokseumawe", "Kota Lhokseumawe"),
new Array("Kota Sabang", "Kota Sabang"),
new Array("Kota Subulussalam", "Kota Subulussalam"),
new Array("Lain-lain", "Lain-lain")
),

// Sumatera Utara
new Array(
new Array("Kab. Asahan", "Kab. Asahan"),
new Array("Kab. Batu Bara", "Kab. Batu Bara"),
new Array("Kab. Dairi", "Kab. Dairi"),
new Array("Kab. Deli Serdang", "Kab. Deli Serdang"),
new Array("Kab. Humbang Hasundutan", "Kab. Humbang Hasundutan"),
new Array("Kab. Karo", "Kab. Karo"),
new Array("Kab. Labuhanbatu", "Kab. Labuhanbatu"),
new Array("Kab. Labuhanbatu Selatan", "Kab. Labuhanbatu Selatan"),
new Array("Kab. Labuhanbatu Utara", "Kab. Labuhanbatu Utara"),
new Array("Kab. Langkat", "Kab. Langkat"),
new Array("Kab. Mandailing Natal", "Kab. Mandailing Natal"),
new Array("Kab. Nias", "Kab. Nias"),
new Array("Kab. Nias Barat", "Kab. Nias Barat"),
new Array("Kab. Nias Selatan", "Kab. Nias Selatan"),
new Array("Kab. Nias Utara", "Kab. Nias Utara"),
new Array("Kab. Padang Lawas", "Kab. Padang Lawas"),
new Array("Kab. Padang Lawas Utara", "Kab. Padang Lawas Utara"),
new Array("Kab. Pakpak Bharat", "Kab. Pakpak Bharat"),
new Array("Kab. Samosir", "Kab. Samosir"),
new Array("Kab. Serdang Bedagai", "Kab. Serdang Bedagai"),
new Array("Kab. Simalungun", "Kab. Simalungun"),
new Array("Kab. Tapanuli Selatan", "Kab. Tapanuli Selatan"),
new Array("Kab. Tapanuli Tengah", "Kab. Tapanuli Tengah"),
new Array("Kab. Tapanuli Utara", "Kab. Tapanuli Utara"),
new Array("Kab. Toba Samosir", "Kab. Toba Samosir"),
new Array("Kota Binjai", "Kota Binjai"),
new Array("Kota Gunung Sitoli", "Kota Gunung Sitoli"),
new Array("Kota Medan", "Kota Medan"),
new Array("Kota Padang Sidempuan", "Kota Padang Sidempuan"),
new Array("Kota Pematang Siantar", "Kota Pematang Siantar"),
new Array("Kota Sibolga", "Kota Sibolga"),
new Array("Kota Tanjung Balai", "Kota Tanjung Balai"),
new Array("Kota Tebing Tinggi", "Kota Tebing Tinggi"),
new Array("Lain-lain", "Lain-lain")
),

// Sumatera Barat
new Array(
new Array("Kab. Agam", "Kab. Agam"),
new Array("Kab. Dharmasraya", "Kab. Dharmasraya"),
new Array("Kab. Kepulauan Mentawai", "Kab. Kepulauan Mentawai"),
new Array("Kab. Lima Puluh Kota", "Kab. Lima Puluh Kota"),
new Array("Kab. Padang Pariaman", "Kab. Padang Pariaman"),
new Array("Kab. Pasaman", "Kab. Pasaman"),
new Array("Kab. Pasaman Barat", "Kab. Pasaman Barat"),
new Array("Kab. Pesisir Selatan", "Kab. Pesisir Selatan"),
new Array("Kab. Sijunjung", "Kab. Sijunjung"),
new Array("Kab. Solok", "Kab. Solok"),
new Array("Kab. Solok Selatan", "Kab. Solok Selatan"),
new Array("Kab. Tanah Datar", "Kab. Tanah Datar"),
new Array("Kota Bukittinggi", "Kota Bukittinggi"),
new Array("Kota Padang", "Kota Padang"),
new Array("Kota Padang Panjang", "Kota Padang Panjang"),
new Array("Kota Payakumbuh", "Kota Payakumbuh"),
new Array("Kota Sawahlunto", "Kota Sawahlunto"),
new Array("Kota Solok", "Kota Solok"),
new Array("Lain-lain", "Lain-lain")
),

// Riau
new Array(
new Array("Kab. Bengkalis", "Kab. Bengkalis"),
new Array("Kab. Indragiri Hilir", "Kab. Indragiri Hilir"),
new Array("Kab. Indragiri Hulu", "Kab. Indragiri Hulu"),
new Array("Kab. Kampar", "Kab. Kampar"),
new Array("Kab. Kuantan Singingi", "Kab. Kuantan Singingi"),
new Array("Kab. Pelalawan", "Kab. Pelalawan"),
new Array("Kab. Rokan Hilir", "Kab. Rokan Hilir"),
new Array("Kab. Rokan Hulu", "Kab. Rokan Hulu"),
new Array("Kab. Siak", "Kab. Siak"),
new Array("Kota Pekanbaru", "Kota Pekanbaru"),
new Array("Kota Dumai", "Kota Dumai"),
new Array("Lain-lain", "Lain-lain")
),

// Jambi
new Array(
new Array("Kab. Batang Hari", "Kab. Batang Hari"),
new Array("Kab. Bungo", "Kab. Bungo"),
new Array("Kab. Kerinci", "Kab. Kerinci"),
new Array("Kab. Merangin", "Kab. Merangin"),
new Array("Kab. Muaro Jambi", "Kab. Muaro Jambi"),
new Array("Kab. Sorolangun", "Kab. Sorolangun"),
new Array("Kab. Tanjung Jabung Barat", "Kab. Tanjung Jabung Barat"),
new Array("Kab. Tanjung Jabung Timur", "Kab. Tanjung Jabung Timur"),
new Array("Kab. Tebo", "Kab. Tebo"),
new Array("Kota Jambi", "Kota Jambi"),
new Array("Kota Sungai Penuh", "Kota Sungai Penuh"),
new Array("Lain-lain", "Lain-lain")
),

// Sumatera Selatan
new Array(
new Array("Kab. Banyuasin", "Kab. Banyuasin"),
new Array("Kab. Empat Lawang", "Kab. Empat Lawang"),
new Array("Kab. Lahat", "Kab. Lahat"),
new Array("Kab. Muara Enim", "Kab. Muara Enim"),
new Array("Kab. Musi Banyuasin", "Kab. Musi Banyuasin"),
new Array("Kab. Musi Rawas", "Kab. Musi Rawas"),
new Array("Kab. Ogan Ilir", "Kab. Ogan Ilir"),
new Array("Kab. Ogan Komering Ilir", "Kab. Ogan Komering Ilir"),
new Array("Kab. Ogan Komering Ulu", "Kab. Ogan Komering Ulu"),
new Array("Kab. Ogan Komering Ulu Selatan", "Kab. Ogan Komering Ulu Selatan"),
new Array("Kab. Ogan Komering Ulu Timur", "Kab. Ogan Komering Ulu Timur"),
new Array("Kota Lubuklinggau", "Kota Lubuklinggau"),
new Array("Kota Pagar Alam", "Kota Pagar Alam"),
new Array("Kota Palembang", "Kota Palembang"),
new Array("Kota Prabumulih", "Kota Prabumulih"),
new Array("Lain-lain", "Lain-lain")
),

// Bengkulu
new Array(
new Array("Kab. Bengkulu Selatan", "Kab. Bengkulu Selatan"),
new Array("Kab. Bengkulu Tengah", "Kab. Bengkulu Tengah"),
new Array("Kab. Bengkulu Utara", "Kab. Bengkulu Utara"),
new Array("Kab. Kaur", "Kab. Kaur"),
new Array("Kab. Kepahiang", "Kab. Kepahiang"),
new Array("Kab. Lebong", "Kab. Lebong"),
new Array("Kab. Mukomuko", "Kab. Mukomuko"),
new Array("Kab. Rejang Lebong", "Kab. Rejang Lebong"),
new Array("Kab. Seluma", "Kab. Seluma"),
new Array("Kota Bengkulu", "Kota Bengkulu"),
new Array("Lain-lain", "Lain-lain")
),

// Lampung
new Array(
new Array("Kab. Lampung Barat", "Kab. Lampung Barat"),
new Array("Kab. Lampung Selatan", "Kab. Lampung Selatan"),
new Array("Kab. Lampung Tengah", "Kab. Lampung Tengah"),
new Array("Kab. Lampung Timur", "Kab. Lampung Timur"),
new Array("Kab. Lampung Utara", "Kab. Lampung Utara"),
new Array("Kab. Mesuji", "Kab. Mesuji"),
new Array("Kab. Pesawaran", "Kab. Pesawaran"),
new Array("Kab. Pringsewu", "Kab. Pringsewu"),
new Array("Kab. Tanggamus", "Kab. Tanggamus"),
new Array("Kab. Tulang Bawang", "Kab. Tulang Bawang"),
new Array("Kab. Tulang Bawang Barat", "Kab. Tulang Bawang Barat"),
new Array("Kab. Way Kanan", "Kab. Way Kanan"),
new Array("Kota Bandar Lampung", "Kota Bandar Lampung"),
new Array("Kota Metro", "Kota Metro"),
new Array("Lain-lain", "Lain-lain")
),

// Bangka Belitung
new Array(
new Array("Kab. Bangka", "Kab. Bangka"),
new Array("Kab. Bangka Barat", "Kab. Bangka Barat"),
new Array("Kab. Bangka Selatan", "Kab. Bangka Selatan"),
new Array("Kab. Bangka Tengah", "Kab. Bangka Tengah"),
new Array("Kab. Belitung", "Kab. Belitung"),
new Array("Kab. Belitung Timur", "Kab. Belitung Timur"),
new Array("Kota Pangkal Pinang", "Kota Pangkal Pinang"),
new Array("Lain-lain", "Lain-lain")
),

// Kepulauan Riau
new Array(
new Array("Kab. Bintan", "Kab. Bintan"),
new Array("Kab. Karimun", "Kab. Karimun"),
new Array("Kab. Kepulauan Anambas", "Kab. Kepulauan Anambas"),
new Array("Kab. Lingga", "Kab. Lingga"),
new Array("Kab. Natuna", "Kab. Natuna"),
new Array("Kota Batam", "Kota Batam"),
new Array("Kota Tanjung Pinang", "Kota Tanjung Pinang"),
new Array("Lain-lain", "Lain-lain")
),

// DKI Jakarta
new Array(
new Array("Kab. Adm. Kepulauan Seribu", "Kab. Adm. Kepulauan Seribu"),
new Array("Kota Jakarta Barat", "Kota Jakarta Barat"),
new Array("Kota Jakarta Pusat", "Kota Jakarta Pusat"),
new Array("Kota Jakarta Selatan", "Kota Jakarta Selatan"),
new Array("Kota Jakarta Timur", "Kota Jakarta Timur"),
new Array("Kota Jakarta Utara", "Kota Jakarta Utara")
),

// Jawa Barat
new Array(
new Array("Kab. Bandung", "Kab. Bandung"),
new Array("Kab. Bandung Barat", "Kab. Bandung Barat"),
new Array("Kab. Bekasi", "Kab. Bekasi"),
new Array("Kab. Bogor", "Kab. Bogor"),
new Array("Kab. Ciamis", "Kab. Ciamis"),
new Array("Kab. Cianjur", "Kab. Cianjur"),
new Array("Kab. Cirebon", "Kab. Cirebon"),
new Array("Kab. Garut", "Kab. Garut"),
new Array("Kab. Indramayu", "Kab. Indramayu"),
new Array("Kab. Karawang", "Kab. Karawang"),
new Array("Kab. Kuningan", "Kab. Kuningan"),
new Array("Kab. Majalengka", "Kab. Majalengka"),
new Array("Kab. Purwakarta", "Kab. Purwakarta"),
new Array("Kab. Subang", "Kab. Subang"),
new Array("Kab. Sukabumi", "Kab. Sukabumi"),
new Array("Kab. Sumedang", "Kab. Sumedang"),
new Array("Kab. Tasikmalaya", "Kab. Tasikmalaya"),
new Array("Kota Bandung", "Kota Bandung"),
new Array("Kota Banjar", "Kota Banjar"),
new Array("Kota Bekasi", "Kota Bekasi"),
new Array("Kota Bogor", "Kota Bogor"),
new Array("Kota Cimahi", "Kota Cimahi"),
new Array("Kota Cirebon", "Kota Cirebon"),
new Array("Kota Depok", "Kota Depok"),
new Array("Kota Sukabumi", "Kota Sukabumi"),
new Array("Kota Tasikmalaya", "Kota Tasikmalaya"),
new Array("Lain-lain", "Lain-lain")
),

// Jawa Tengah
new Array(
new Array("Kab. Banjarnegara", "Kab. Banjarnegara"),
new Array("Kab. Banyumas", "Kab. Banyumas"),
new Array("Kab. Batang", "Kab. Batang"),
new Array("Kab. Blora", "Kab. Blora"),
new Array("Kab. Boyolali", "Kab. Boyolali"),
new Array("Kab. Brebes", "Kab. Brebes"),
new Array("Kab. Cilacap", "Kab. Cilacap"),
new Array("Kab. Demak", "Kab. Demak"),
new Array("Kab. Grobogan", "Kab. Grobogan"),
new Array("Kab. Jepara", "Kab. Jepara"),
new Array("Kab. Karanganyar", "Kab. Karanganyar"),
new Array("Kab. Kebumen", "Kab. Kebumen"),
new Array("Kab. Kendal", "Kab. Kendal"),
new Array("Kab. Klaten", "Kab. Klaten"),
new Array("Kab. Kudus", "Kab. Kudus"),
new Array("Kab. Magelang", "Kab. Magelang"),
new Array("Kab. Pati", "Kab. Pati"),
new Array("Kab. Pekalongan", "Kab. Pekalongan"),
new Array("Kab. Pemalang", "Kab. Pemalang"),
new Array("Kab. Purbalingga", "Kab. Purbalingga"),
new Array("Kab. Purworejo", "Kab. Purworejo"),
new Array("Kab. Rembang", "Kab. Rembang"),
new Array("Kab. Semarang", "Kab. Semarang"),
new Array("Kab. Sragen", "Kab. Sragen"),
new Array("Kab. Sukoharjo", "Kab. Sukoharjo"),
new Array("Kab. Tegal", "Kab. Tegal"),
new Array("Kab. Temanggung", "Kab. Temanggung"),
new Array("Kab. Wonogiri", "Kab. Wonogiri"),
new Array("Kab. Wonosobo", "Kab. Wonosobo"),
new Array("Kota Magelang", "Kota Magelang"),
new Array("Kota Pekalongan", "Kota Pekalongan"),
new Array("Kota Salatiga", "Kota Salatiga"),
new Array("Kota Semarang", "Kota Semarang"),
new Array("Kota Surakarta / Solo", "Kota Surakarta / Solo"),
new Array("Kota Tegal", "Kota Tegal"),
new Array("Lain-lain", "Lain-lain")
),

// DI Yogyakarta
new Array(
new Array("Kab. Bantul", "Kab. Bantul"),
new Array("Kab. Gunung Kidul", "Kab. Gunung Kidul"),
new Array("Kab. Kulon Progo", "Kab. Kulon Progo"),
new Array("Kab. Sleman", "Kab. Sleman"),
new Array("Kota Yogyakarta", "Kota Yogyakarta"),
new Array("Lain-lain", "Lain-lain")
),

// Jawa Timur
new Array(
new Array("Kab. Bangkalan", "Kab. Bangkalan"),
new Array("Kab. Banyuwangi", "Kab. Banyuwangi"),
new Array("Kab. Blitar", "Kab. Blitar"),
new Array("Kab. Bojonegoro", "Kab. Bojonegoro"),
new Array("Kab. Bondowoso", "Kab. Bondowoso"),
new Array("Kab. Gresik", "Kab. Gresik"),
new Array("Kab. Jember", "Kab. Jember"),
new Array("Kab. Jombang", "Kab. Jombang"),
new Array("Kab. Kediri", "Kab. Kediri"),
new Array("Kab. Lamongan", "Kab. Lamongan"),
new Array("Kab. Lumajang", "Kab. Lumajang"),
new Array("Kab. Madiun", "Kab. Madiun"),
new Array("Kab. Magetan", "Kab. Magetan"),
new Array("Kab. Malang", "Kab. Malang"),
new Array("Kab. Mojokerto", "Kab. Mojokerto"),
new Array("Kab. Nganjuk", "Kab. Nganjuk"),
new Array("Kab. Ngawi", "Kab. Ngawi"),
new Array("Kab. Pacitan", "Kab. Pacitan"),
new Array("Kab. Pamekasan", "Kab. Pamekasan"),
new Array("Kab. Pasuruan", "Kab. Pasuruan"),
new Array("Kab. Ponorogo", "Kab. Ponorogo"),
new Array("Kab. Probolinggo", "Kab. Probolinggo"),
new Array("Kab. Sampang", "Kab. Sampang"),
new Array("Kab. Sidoarjo", "Kab. Sidoarjo"),
new Array("Kab. Situbondo", "Kab. Situbondo"),
new Array("Kab. Sumenep", "Kab. Sumenep"),
new Array("Kab. Trenggalek", "Kab. Trenggalek"),
new Array("Kab. Tuban", "Kab. Tuban"),
new Array("Kab. Tulungagung", "Kab. Tulungagung"),
new Array("Kota Batu", "Kota Batu"),
new Array("Kota Blitar", "Kota Blitar"),
new Array("Kota Kediri", "Kota Kediri"),
new Array("Kota Madiun", "Kota Madiun"),
new Array("Kota Malang", "Kota Malang"),
new Array("Kota Mojokerto", "Kota Mojokerto"),
new Array("Kota Pasuruan", "Kota Pasuruan"),
new Array("Kota Probolinggo", "Kota Probolinggo"),
new Array("Kota Surabaya", "Kota Surabaya"),
new Array("Lain-lain", "Lain-lain")
),

// Banten
new Array(
new Array("Kab. Lebak", "Kab. Lebak"),
new Array("Kab. Pandeglang", "Kab. Pandeglang"),
new Array("Kab. Serang", "Kab. Serang"),
new Array("Kab. Tangerang", "Kab. Tangerang"),
new Array("Kota Cilegon", "Kota Cilegon"),
new Array("Kata Serang", "Kata Serang"),
new Array("Kota Tangerang", "Kota Tangerang"),
new Array("Kota Tangerang Selatan", "Kota Tangerang Selatan"),
new Array("Lain-lain", "Lain-lain")
),

// Bali
new Array(
new Array("Kab. Badung", "Kab. Badung"),
new Array("Kab. Bangli", "Kab. Bangli"),
new Array("Kab. Buleleng", "Kab. Buleleng"),
new Array("Kab. Gianyar", "Kab. Gianyar"),
new Array("Kab. Jembrana", "Kab. Jembrana"),
new Array("Kab. Karangasem", "Kab. Karangasem"),
new Array("Kab. Klungkung", "Kab. Klungkung"),
new Array("Kab. Tabanan", "Kab. Tabanan"),
new Array("Kota Denpasar", "Kota Denpasar"),
new Array("Lain-lain", "Lain-lain")
),

// NTB
new Array(
new Array("Kab. Bima", "Kab. Bima"),
new Array("Kab. Dompu", "Kab. Dompu"),
new Array("Kab. Lombok Barat", "Kab. Lombok Barat"),
new Array("Kab. Lombok Tengah", "Kab. Lombok Tengah"),
new Array("Kab. Lombok Timur", "Kab. Lombok Timur"),
new Array("Kab. Lombok Utara", "Kab. Lombok Utara"),
new Array("Kab. Sumbawa", "Kab. Sumbawa"),
new Array("Kab. Sumbawa Barat", "Kab. Sumbawa Barat"),
new Array("Kota Bima", "Kota Bima"),
new Array("Kota Mataram", "Kota Mataram"),
new Array("Lain-lain", 999)
),

// NTT
new Array(
new Array("Kab. Alor", "Kab. Alor"),
new Array("Kab. Belu", "Kab. Belu"),
new Array("Kab. Ende", "Kab. Ende"),
new Array("Kab. Flores Timur", "Kab. Flores Timur"),
new Array("Kab. Kupang", "Kab. Kupang"),
new Array("Kab. Lembata", "Kab. Lembata"),
new Array("Kab. Manggarai", "Kab. Manggarai"),
new Array("Kab. Manggarai Barat", "Kab. Manggarai Barat"),
new Array("Kab. Manggarai Timur", "Kab. Manggarai Timur"),
new Array("Kab. Nagekeo", "Kab. Nagekeo"),
new Array("Kab. Ngada", "Kab. Ngada"),
new Array("Kab. Rote Ndao", "Kab. Rote Ndao"),
new Array("Kab. Sabu Raijua", "Kab. Sabu Raijua"),
new Array("Kab. Sikka", "Kab. Sikka"),
new Array("Kab. Sumba Barat", "Kab. Sumba Barat"),
new Array("Kab. Sumba Barat Daya", "Kab. Sumba Barat Daya"),
new Array("Kab. Sumba Tengah", "Kab. Sumba Tengah"),
new Array("Kab. Sumba Timur", "Kab. Sumba Timur"),
new Array("Kab. Timor Tengah Selatan", "Kab. Timor Tengah Selatan"),
new Array("Kab. Timor Tengah Utara", "Kab. Timor Tengah Utara"),
new Array("Kota Kupang", "Kota Kupang"),
new Array("Lain-lain", "Lain-lain")
),

// Kalimantan Barat
new Array(
new Array("Kab. Bengkayang", "Kab. Bengkayang"),
new Array("Kab. Kapuas Hulu", "Kab. Kapuas Hulu"),
new Array("Kab. Kayong Utara", "Kab. Kayong Utara"),
new Array("Kab. Ketapang", "Kab. Ketapang"),
new Array("Kab. Kubu Raya", "Kab. Kubu Raya"),
new Array("Kab. Landak", "Kab. Landak"),
new Array("Kab. Melawi", "Kab. Melawi"),
new Array("Kab. Pontianak", "Kab. Pontianak"),
new Array("Kab. Sambas", "Kab. Sambas"),
new Array("Kab. Sanggau", "Kab. Sanggau"),
new Array("Kab. Sekadau", "Kab. Sekadau"),
new Array("Kab. Sintang", "Kab. Sintang"),
new Array("Kota Pontianak", "Kota Pontianak"),
new Array("Kota Singkawang", "Kota Singkawang"),
new Array("Lain-lain", "Lain-lain")
),

// Kalimantan Tengah
new Array(
new Array("Kab. Barito Selatan", "Kab. Barito Selatan"),
new Array("Kab. Barito Timur", "Kab. Barito Timur"),
new Array("Kab. Barito Utara", "Kab. Barito Utara"),
new Array("Kab. Gunung Mas", "Kab. Gunung Mas"),
new Array("Kab. Kapuas", "Kab. Kapuas"),
new Array("Kab. Katingan", "Kab. Katingan"),
new Array("Kab. Kotawaringin Barat", "Kab. Kotawaringin Barat"),
new Array("Kab. Kotawaringin Timur", "Kab. Kotawaringin Timur"),
new Array("Kab. Lamandau", "Kab. Lamandau"),
new Array("Kab. Murung Raya", "Kab. Murung Raya"),
new Array("Kab. Pulau Pisang", "Kab. Pulau Pisang"),
new Array("Kab. Sukamara", "Kab. Sukamara"),
new Array("Kab. Seruyan", "Kab. Seruyan"),
new Array("Kota Palangka Raya", "Kota Palangka Raya"),
new Array("Lain-lain", "Lain-lain")
),

// Kalimantan Selatan
new Array(
new Array("Kab. Balangan", "Kab. Balangan"),
new Array("Kab. Banjar", "Kab. Banjar"),
new Array("Kab. Barito Kuala", "Kab. Barito Kuala"),
new Array("Kab. Hulu Sungai Selatan", "Kab. Hulu Sungai Selatan"),
new Array("Kab. Hulu Sungai Tengah", "Kab. Hulu Sungai Tengah"),
new Array("Kab. Hulu Sungai Utara", "Kab. Hulu Sungai Utara"),
new Array("Kab. Kotabaru", "Kab. Kotabaru"),
new Array("Kab. Tabalong", "Kab. Tabalong"),
new Array("Kab. Tanah Bumbu", "Kab. Tanah Bumbu"),
new Array("Kab. Tanah Laut", "Kab. Tanah Laut"),
new Array("Kab. Tapin", "Kab. Tapin"),
new Array("Kota Banjarbaru", "Kota Banjarbaru"),
new Array("Kota Banjarmasin", "Kota Banjarmasin"),
new Array("Lain-lain", "Lain-lain")
),

// Kalimantan Timur
new Array(
new Array("Kab. Berau", "Kab. Berau"),
new Array("Kab. Bulungan", "Kab. Bulungan"),
new Array("Kab. Kutai Barat", "Kab. Kutai Barat"),
new Array("Kab. Kutai Kartanegara", "Kab. Kutai Kartanegara"),
new Array("Kab. Kutai Timur", "Kab. Kutai Timur"),
new Array("Kab. Malinau", "Kab. Malinau"),
new Array("Kab. Nunukan", "Kab. Nunukan"),
new Array("Kab. Paser", "Kab. Paser"),
new Array("Kab. Penajam Paser Utara", "Kab. Penajam Paser Utara"),
new Array("Kab. Tana Tidung", "Kab. Tana Tidung"),
new Array("Kota Balikpapan", "Kota Balikpapan"),
new Array("Kota Bontang", "Kota Bontang"),
new Array("Kota Samarinda", "Kota Samarinda"),
new Array("Kota Tarakan", "Kota Tarakan"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Utara
new Array(
new Array("Kab. Bolaang Mongondow", "Kab. Bolaang Mongondow"),
new Array("Kab. Bolaang Mongondow Selatan", "Kab. Bolaang Mongondow Selatan"),
new Array("Kab. Bolaang Mongondow Timur", "Kab. Bolaang Mongondow Timur"),
new Array("Kab. Bolaang Mongondow Utara", "Kab. Bolaang Mongondow Utara"),
new Array("Kab. Kepulauan Sangihe", "Kab. Kepulauan Sangihe"),
new Array("Kab. Kepulauan Siau Tagalandang Biaro", "Kab. Kepulauan Siau Tagalandang Biaro"),
new Array("Kab. Kepulauan Talaud", "Kab. Kepulauan Talaud"),
new Array("Kab. Minahasa", "Kab. Minahasa"),
new Array("Kab. Minahasa Selatan", "Kab. Minahasa Selatan"),
new Array("Kab. Minahasa Tenggara", "Kab. Minahasa Tenggara"),
new Array("Kab. Minahasa Utara", "Kab. Minahasa Utara"),
new Array("Kota Bitung", "Kota Bitung"),
new Array("Kota Kotamobagu", "Kota Kotamobagu"),
new Array("Kota Manado", "Kota Manado"),
new Array("Kota Tomohon", "Kota Tomohon"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Tengah
new Array(
new Array("Kab. Banggai", "Kab. Banggai"),
new Array("Kab. Banggai Kepulauan", "Kab. Banggai Kepulauan"),
new Array("Kab. Buol", "Kab. Buol"),
new Array("Kab. Donggala", "Kab. Donggala"),
new Array("Kab. Morowali", "Kab. Morowali"),
new Array("Kab. Parigi Moutong", "Kab. Parigi Moutong"),
new Array("Kab. Poso", "Kab. Poso"),
new Array("Kab. Tojo Una-Una", "Kab. Tojo Una-Una"),
new Array("Kab. Toli-Toli", "Kab. Toli-Toli"),
new Array("Kab. Sigi", "Kab. Sigi"),
new Array("Kota Palu", "Kota Palu"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Selatan
new Array(
new Array("Kab. Bantaeng", "Kab. Bantaeng"),
new Array("Kab. Barru", "Kab. Barru"),
new Array("Kab. Bone", "Kab. Bone"),
new Array("Kab. Bulukumba", "Kab. Bulukumba"),
new Array("Kab. Enrekang", "Kab. Enrekang"),
new Array("Kab. Gowa", "Kab. Gowa"),
new Array("Kab. Jeneponto", "Kab. Jeneponto"),
new Array("Kab. Kepulauan Selayar", "Kab. Kepulauan Selayar"),
new Array("Kab. Luwu", "Kab. Luwu"),
new Array("Kab. Luwu Timur", "Kab. Luwu Timur"),
new Array("Kab. Luwu Utara", "Kab. Luwu Utara"),
new Array("Kab. Maros", "Kab. Maros"),
new Array("Kab. Pangkajene & Kepulauan", "Kab. Pangkajene & Kepulauan"),
new Array("Kab. Pinrang", "Kab. Pinrang"),
new Array("Kab. Sidenreng Rappang", "Kab. Sidenreng Rappang"),
new Array("Kab. Sinjai", "Kab. Sinjai"),
new Array("Kab. Soppeng", "Kab. Soppeng"),
new Array("Kab. Takalar", "Kab. Takalar"),
new Array("Kab. Tana Toraja", "Kab. Tana Toraja"),
new Array("Kab. Toraja Utara", "Kab. Toraja Utara"),
new Array("Kab. Wajo", "Kab. Wajo"),
new Array("Kota Makassar", "Kota Makassar"),
new Array("Kota Palopo", "Kota Palopo"),
new Array("Kota Pare-Pare", "Kota Pare-Pare"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Tenggara
new Array(
new Array("Kab. Bombana", "Kab. Bombana"),
new Array("Kab. Buton", "Kab. Buton"),
new Array("Kab. Buton Utara", "Kab. Buton Utara"),
new Array("Kab. Kolaka", "Kab. Kolaka"),
new Array("Kab. Kolaka Utara", "Kab. Kolaka Utara"),
new Array("Kab. Konawe", "Kab. Konawe"),
new Array("Kab. Konawe Selatan", "Kab. Konawe Selatan"),
new Array("Kab. Konawe Utara", "Kab. Konawe Utara"),
new Array("Kab. Muna", "Kab. Muna"),
new Array("Kab. Wakatobi", "Kab. Wakatobi"),
new Array("Kota Bau-Bau", "Kota Bau-Bau"),
new Array("Kota Kendari", "Kota Kendari"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Barat
new Array(
new Array("Kab. Majene", "Kab. Majene"),
new Array("Kab. Mamasa", "Kab. Mamasa"),
new Array("Kab. Mamuju", "Kab. Mamuju"),
new Array("Kab. Mamuju Utara", "Kab. Mamuju Utara"),
new Array("Kab. Polewali Mandar", "Kab. Polewali Mandar"),
new Array("Lain-lain", "Lain-lain")
),

// Gorontalo
new Array(
new Array("Kab. Boalemo", "Kab. Boalemo"),
new Array("Kab. Bone Bolango", "Kab. Bone Bolango"),
new Array("Kab. Gorontalo", "Kab. Gorontalo"),
new Array("Kab. Gorontalo Utara", "Kab. Gorontalo Utara"),
new Array("Kab. Pohuwato", "Kab. Pohuwato"),
new Array("Kota Gorontalo", "Kota Gorontalo"),
new Array("Lain-lain", "Lain-lain")
),

// Maluku
new Array(
new Array("Kab. Buru", "Kab. Buru"),
new Array("Kab. Buru Selatan", "Kab. Buru Selatan"),
new Array("Kab. Kepulauan Aru", "Kab. Kepulauan Aru"),
new Array("Kab. Maluku Barat Daya", "Kab. Maluku Barat Daya"),
new Array("Kab. Maluku Tengah", "Kab. Maluku Tengah"),
new Array("Kab. Maluku Tenggara", "Kab. Maluku Tenggara"),
new Array("Kab. Maluku Tenggara Barat", "Kab. Maluku Tenggara Barat"),
new Array("Kab. Seram Bagian Barat", "Kab. Seram Bagian Barat"),
new Array("Kab. Seram Bagian Timur", "Kab. Seram Bagian Timur"),
new Array("Kota Ambon", "Kota Ambon"),
new Array("Kota Tual", "Kota Tual"),
new Array("Lain-lain", "Lain-lain")
),

// Maluku Utara
new Array(
new Array("Kab. Halmahera Barat", "Kab. Halmahera Barat"),
new Array("Kab. Halmahera Selatan", "Kab. Halmahera Selatan"),
new Array("Kab. Halmahera Tengah", "Kab. Halmahera Tengah"),
new Array("Kab. Halmahera Timur", "Kab. Halmahera Timur"),
new Array("Kab. Halmahera Utara", "Kab. Halmahera Utara"),
new Array("Kab. Kepulauan Sula", "Kab. Kepulauan Sula"),
new Array("Kab. Pulau Marotai", "Kab. Pulau Marotai"),
new Array("Kota Ternate", "Kota Ternate"),
new Array("Kota Tidore Kepulauan", "Kota Tidore Kepulauan"),
new Array("Lain-lain", "Lain-lain")
),

// Papua Barat
new Array(
new Array("Kab. Fakfak", "Kab. Fakfak"),
new Array("Kab. Kaimana", "Kab. Kaimana"),
new Array("Kab. Manokwari", "Kab. Manokwari"),
new Array("Kab. Raja Ampat", "Kab. Raja Ampat"),
new Array("Kob. Sorong", "Kab. Sorong"),
new Array("Kab. Tambrauw", "Kab. Tambrauw"),
new Array("Kab. Teluk Bintuni", "Kab. Teluk Bintuni"),
new Array("Kab. Teluk Wondama", "Kab. Teluk Wondama"),
new Array("Kota Sorong", "Kota Sorong"),
new Array("Lain-lain", "Lain-lain")
),

// Papua
new Array(
new Array("Kab. Asmat", "Kab. Asmat"),
new Array("Kab. Biak Numfor", "Kab. Biak Numfor"),
new Array("Kab. Boven Digoel", "Kab. Boven Digoel"),
new Array("Kab. Deiyai", "Kab. Deiyai"),
new Array("Kab. Dogiyai", "Kab. Dogiyai"),
new Array("Kab. Intan Jaya", "Kab. Intan Jaya"),
new Array("Kab. Jayapura", "Kab. Jayapura"),
new Array("Kab. Jayawijaya", "Kab. Jayawijaya"),
new Array("Kab. Keerom", "Kab. Keerom"),
new Array("Kab. Kepulauan Yapen", "Kab. Kepulauan Yapen"),
new Array("Kab. Lanny Jaya", "Kab. Lanny Jaya"),
new Array("Kab. Mamberamo Raya", "Kab. Mamberamo Raya"),
new Array("Kab. Mamberamo Tengah", "Kab. Mamberamo Tengah"),
new Array("Kab. Mappi", "Kab. Mappi"),
new Array("Kab. Merauke", "Kab. Merauke"),
new Array("Kab. Mimika", "Kab. Mimika"),
new Array("Kab. Nabire", "Kab. Nabire"),
new Array("Kab. Nduga", "Kab. Nduga"),
new Array("Kab. Paniai", "Kab. Paniai"),
new Array("Kab. Pegunungan Bintang", "Kab. Pegunungan Bintang"),
new Array("Kab. Puncak", "Kab. Puncak"),
new Array("Kab. Puncak Jaya", "Kab. Puncak Jaya"),
new Array("Kab. Sarmi", "Kab. Sarmi"),
new Array("Kab. Supiori", "Kab. Supiori"),
new Array("Kab. Tolikara", "Kab. Tolikara"),
new Array("Kab. Waropen", "Kab. Waropen"),
new Array("Kab. Yahukimo", "Kab. Yahukimo"),
new Array("Kab. Yalimo", "Kab. Yalimo"),
new Array("Kota Jayapura", "Kota Jayapura"),
new Array("Lain-lain", "Lain-lain")
),

// Luar Negri
new Array(
new Array("Malaysia", "Malaysia"),
new Array("Singapore", "Singapore"),
new Array("Others", "Others")
)
);

function fillSelectFromArray(selectCtrl, itemArray, goodPrompt, badPrompt, defaultItem) {
var i, j;
var prompt;
for (i = selectCtrl.options.length; i >= 0; i--) {
selectCtrl.options[i] = null;
}
prompt = (itemArray != null) ? goodPrompt : badPrompt;
if (prompt == null) {
j = 0;
}
else {
selectCtrl.options[0] = new Option(prompt);
j = 1;
}
if (itemArray != null) {
for (i = 0; i < itemArray.length; i++) {
selectCtrl.options[j] = new Option(itemArray[i][0]);
if (itemArray[i][1] != null) {
selectCtrl.options[j].value = itemArray[i][1];
}
j++;
}
selectCtrl.options[0].selected = true;
   }
}

</script>
	                <select name="n_propinsi" onChange="fillSelectFromArray(this.form.n_kabupaten, ((this.selectedIndex == -1) ? null :
	kabupaten[this.selectedIndex-1]));" class="validate-selection">
	                  <option selected="selected" value="">-- Pilih Propinsi --</option>
	                  <option value="Nanggroe Aceh Darussalam">Nanggroe Aceh Darussalam</option>
	                  <option value="Sumatera Utara">Sumatera Utara</option>
	                  <option value="Sumatera Barat">Sumatera Barat</option>
	                  <option value="Riau">Riau</option>
	                  <option value="Jambi">Jambi</option>
	                  <option value="Sumatera Selatan">Sumatera Selatan</option>
	                  <option value="Bengkulu">Bengkulu</option>
	                  <option value="Lampung">Lampung</option>
	                  <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
	                  <option value="Kepulauan Riau">Kepulauan Riau</option>
	                  <option value="DKI Jakarta">DKI Jakarta</option>
	                  <option value="Jawa Barat">Jawa Barat</option>
	                  <option value="Jawa Tengah">Jawa Tengah</option>
	                  <option value="DI Yogyakarta">DI Yogyakarta</option>
	                  <option value="Jawa Timur">Jawa Timur</option>
	                  <option value="Banten">Banten</option>
	                  <option value="Bali">Bali</option>
	                  <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
	                  <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
	                  <option value="Kalimantan Barat">Kalimantan Barat</option>
	                  <option value="Kalimantan Tengah">Kalimantan Tengah</option>
	                  <option value="Kalimantan Selatan">Kalimantan Selatan</option>
	                  <option value="Kalimantan Timur">Kalimantan Timur</option>
	                  <option value="Sulawesi Utara">Sulawesi Utara</option>
	                  <option value="Sulawesi Tengah">Sulawesi Tengah</option>
	                  <option value="Sulawesi Selatan">Sulawesi Selatan</option>
	                  <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
	                  <option value="Sulawesi Barat">Sulawesi Barat</option>
	                  <option value="Gorontalo">Gorontalo</option>
	                  <option value="Maluku">Maluku</option>
	                  <option value="Maluku Utara">Maluku Utara</option>
	                  <option value="Papua Barat">Papua Barat</option>
	                  <option value="Papua">Papua</option>
	                  <option value="Others (outside Indonesia)">Others Countries (outside Indonesia)</option>
                    </select>
                          <select name="n_kabupaten">
                            <option selected="selected"> </option>
                    </select> </td>
        </tr>
        <tr>
          <td width="133" bgcolor="#dddddd">
            Kode Pos *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="c_pos" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['kdpos']; ?>" size="5" maxlength="5" >	  </td>
        </tr>

        <tr>
                        <td width="133" bgcolor="#dddddd"> Nomor Telepon * </td>
	                    <td bgcolor="#eeeeee"> <input name="i_telp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['telp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
          <td width="133" bgcolor="#dddddd">
            Nomor Handphone/Selular *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="i_hp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['hp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
                        <td width="133" bgcolor="#dddddd"> Email * </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_email" type="TEXT" class="required validate-email" value="<?php echo $_SESSION['email']; ?>" size="25" maxlength="40"></td>
        </tr>



        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- DATA ORANGTUA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="548" cellpadding="4">
      <tbody>
        <tr>
          <td width="534" colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data SMA/MA/SMK Peserta</b><br />
          Isilah data SMA/MA/SMK asal Saudara/i dengan lengkap dan benar. </span></td>
        </tr>
      </tbody>
    </table>
    <table width="547" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" bgcolor="#dddddd"> Nama SMA/MA/SMK Asal * </td>
          <td width="313" bgcolor="#eeeeee"><input name="n_sma2" type="text" class="required" value="<?php echo $_SESSION['asalsma']; ?>" size="30" maxlength="60" />
          </td>
        </tr>
        <tr>
          <?php
  $sql_smu="select * from t_jurusan_sma";
  $query_smu=mysql_query($sql_smu,$koneksi);
  ?>
          <td width="210" bgcolor="#dddddd"> Jurusan SMA/MA/SMK * </td>
          <td bgcolor="#eeeeee"><select name="select" size="1" id="select" class="validate-selection">
              <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
              <?php while ($row_smu=mysql_fetch_array($query_smu))
   {;?>
              <option value ="<?php echo $row_smu['KodeSMU'];?>"><?php echo $row_smu['Keterangan'];?></option>
              <?php }?>
            </select>
          </td>
        </tr>
        <tr>
          <td width="210" bgcolor="#dddddd"> Alamat SMA/MA/SMK * </td>
          <td bgcolor="#eeeeee"><textarea name="textarea" rows="2" cols="30" class="required"><?php echo $_SESSION['alamatsma']; ?></textarea>
          </td>
        </tr>
        <tr>
          <td width="210" bgcolor="#dddddd"> Propinsi<br />
            Kabupaten / Kota * </td>
          <td bgcolor="#eeeeee"><select name="select" onchange="fillSelectFromArray(this.form.n_kab_sma, ((this.selectedIndex == -1) ? null :
	kabupaten[this.selectedIndex-1]));" class="validate-selection">
              <option selected="selected" value="">-- Pilih Propinsi
                --</option>
              <option value="Nanggroe Aceh Darussalam">Nanggroe Aceh
                Darussalam</option>
              <option value="Sumatera Utara">Sumatera Utara</option>
              <option value="Sumatera Barat">Sumatera Barat</option>
              <option value="Riau">Riau</option>
              <option value="Jambi">Jambi</option>
              <option value="Sumatera Selatan">Sumatera Selatan</option>
              <option value="Bengkulu">Bengkulu</option>
              <option value="Lampung">Lampung</option>
              <option value="Kepulauan Bangka Belitung">Kepulauan
                Bangka Belitung</option>
              <option value="Kepulauan Riau">Kepulauan Riau</option>
              <option value="DKI Jakarta">DKI Jakarta</option>
              <option value="Jawa Barat">Jawa Barat</option>
              <option value="Jawa Tengah">Jawa Tengah</option>
              <option value="DI Yogyakarta">DI Yogyakarta</option>
              <option value="Jawa Timur">Jawa Timur</option>
              <option value="Banten">Banten</option>
              <option value="Bali">Bali</option>
              <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
              <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
              <option value="Kalimantan Barat">Kalimantan Barat</option>
              <option value="Kalimantan Tengah">Kalimantan Tengah</option>
              <option value="Kalimantan Selatan">Kalimantan Selatan</option>
              <option value="Kalimantan Timur">Kalimantan Timur</option>
              <option value="Sulawesi Utara">Sulawesi Utara</option>
              <option value="Sulawesi Tengah">Sulawesi Tengah</option>
              <option value="Sulawesi Selatan">Sulawesi Selatan</option>
              <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
              <option value="Sulawesi Barat">Sulawesi Barat</option>
              <option value="Gorontalo">Gorontalo</option>
              <option value="Maluku">Maluku</option>
              <option value="Maluku Utara">Maluku Utara</option>
              <option value="Papua Barat">Papua Barat</option>
              <option value="Papua">Papua</option>
              <option value="Others (outside Indonesia)">Others Countries
                (outside Indonesia)</option>
            </select>
              <select name="select">
                <option selected="selected"> </option>
            </select></td>
        </tr>
        <tr>
          <td colspan="2" height="4"></td>
        </tr>
        <!-- PILIHAN PRODI -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="548" cellpadding="4" >
      <tbody>
        <tr>
          <td width="524" colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Orang Tua Peserta</b><br>
          Isilah data orang tua Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Nama Orang Tua *	  </td>
	                    <td bgcolor="#eeeeee">
                        <input name="n_ortu" type="TEXT" class="required" value="<?php echo $_SESSION['nm_ortu']; ?>" size="40" maxlength="60">	  </td>
        </tr>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Jenis Pekerjaan<br>
                          Orang Tua * </td>
	                    <td bgcolor="#eeeeee">
	                    <select name="n_jabatan" size="1" id="n_jabatan">
						<option selected="selected" value="">-- Pilih Pekerjaan Orang Tua --</option>
						<option value="TNI_POLRI">TNI/POLRI</option>
						<option value="PNS">PNS</option>
						<option value="Swasta">Swasta</option>
						<option value="BUMN">BUMN</option>
						<option value="Pesiunan">Pensiunan</option>
                        </select>  </td>
        </tr>


        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- DATA SMA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>          </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Pilihan Program Studi</b><br>
            Pilihlah program studi yang Saudara/i minati. Jumlah pilihan boleh
            satu, dua atau tiga program studi yang ada di<font size="2" face="ARIAL"> Politeknik
              Pos Indonesia</font>.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
<script language="JavaScript1.2">
function validate_pil(data) {
		var n_pil1=data.n_pil1;
		var n_pil2=data.n_pil2;
		var n_pil3=data.n_pil3;
		if (n_pil1.value==n_pil2.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 2");
		   n_pil2.value=0;   }
		   }
		if (n_pil1.value==n_pil3.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
		if (n_pil2.value==n_pil3.value) {
		   if (n_pil2.value!=0) {
		   alert ("Pilihan 2 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
}
</script>
           <tr>
<?php
function combo($var, $data) {
	echo "<select name='$var' onChange='validate_pil(this.form)'  class='validate-selection'>";
	echo "<option value=0 selected>- Pilih Jurusan -</option>";
	$sql=mysql_query("select * from t_jurusan");
	while ($data=mysql_fetch_array($sql)){
		echo "<option value=$data[KodeJrsn]>$data[NamaJrsn]</option>";
	}
	echo "</select>";
}
?>
             <td width="210" bgcolor="#dddddd">
               Pilihan 1 *	  </td>
                        <td bgcolor="#eeeeee"><? combo("n_pil1",$data1); ?></td>
        </tr>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Pilihan 2 *	  </td>
                        <td bgcolor="#eeeeee"><? combo("n_pil2",$data2); ?></td>
        </tr>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Pilihan 3 *	  </td>
                        <td bgcolor="#eeeeee"><? combo("n_pil3",$data3); ?></td>
        </tr>
        <tr>
          <td colspan="2" height="4"></td>
        </tr>

               <!-- LOKASI UJIAN  -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Lokasi Ujian</b><br>
            Pilihlah lokasi ujian tempat Saudara/i akan melakukan Ujian Saringan Masuk.
            Informasi wilayah lokasi ujian dapat Anda lihat pada halaman Lokasi
            Ujian. </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
               <tr>
                 <?php
  $sql_tmpujian="select * from t_tempat_ujian";
  $query_tmpujian=mysql_query($sql_tmpujian,$koneksi);
?>
                 <td width="210" bgcolor="#dddddd">
                   Lokasi Ujian *	  </td>
                        <td bgcolor="#eeeeee">
                          <select name="i_temp_ujian" size="1" id="i_temp_ujian" class="validate-selection">
						    <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_tmpujian=mysql_fetch_array($query_tmpujian))
   {;?>
                            <option value =<?php echo $row_tmpujian[KodeTmp];?>><?php echo $row_tmpujian[NamaTmp];?></option>
                            <?php }?>
                        </select>	  </td>
        </tr>

        <tr>
                 <?php
				 $data=$_GET['data'];
  $sql_info="select * from t_informasi";
  $query_info=mysql_query($sql_info,$koneksi);
?>
                        <td width="210" bgcolor="#dddddd"> Tahu Infromasi Dari * </td>
                        <td bgcolor="#eeeeee">
                          <select name="c_inf" size="1" id="c_inf" class="validate-selection">
						    <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_info=mysql_fetch_array($query_info))
   {;?>
                            <option value =<?php echo $row_info[KodeInf];?>><?php echo $row_info[NamaInf];?></option>

                            <?php

							 }?>
							 	<?
						if ($row_info[NamaInf]=='LAINNYA')
							{
						echo"<input name='nama_info' type='text' id='nama_info' size='30' maxlength='60'>";					  	                         }
						else
						{
							echo"<input name='nama_info' type='hidden' id='nama_info' size='30' maxlength='60'>";
						}
						?>
                        </select>


                        </td
                      ></tr>
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- SDP2 -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Jumlah SK</b><br>
            Isilah jumlah Sumbangan Sukarela (SK) Saudara/i,
            dengan minimal sebesar Rp 100.000,- (seratus ribu rupiah)dan kelipatannya. </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
               <tr>
                 <td width="210" bgcolor="#dddddd">
                   Sumbangan Sukarela Sebesar
                   *<br>
                   <br>	  </td>
                        <td bgcolor="#eeeeee">
                   			<div id="advice-validate-currency-dollar-field5" class="custom-advice" style="display:none">Cukup isikan besaran SDP2 dalam angka bernominal rupiah, tanpa tanda baca.</div>
							<input name="q_sdp2" class="validate-currency-dollar required validate-rupiah validate-digit" id="q_sdp2" value="<?php echo $_SESSION['sk']; ?>" maxlength="8" />
                			</div>
       <!--
	   Rp.
	   <INPUT TYPE="TEXT" NAME"sdp2j" SIZE="3" MAXLENGTH="3" onclick="validateInt()">.
	   -->	  </td>
        </tr>
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- NILAI PRESTASI LAIN -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
     <table width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Photo Peserta</b><br>
            Upload photo Closeup terbaru Saudara/i ( Photo Resmi ) Ukuran 3x4</span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Photo ( 3x4 ) *	  </td>
	                    <td bgcolor="#eeeeee">
                        <input name="photo" size="40" maxlength="60" type="file" class="required">	  </td>
        </tr>



        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- End Photo-->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
<script language="JavaScript1.2">
function validate_pil(data) {
		var n_pil1=data.n_pil1;
		var n_pil2=data.n_pil2;
		var n_pil3=data.n_pil3;
		if (n_pil1.value==n_pil2.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 2");
		   n_pil2.value=0;   }
		   }
		if (n_pil1.value==n_pil3.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
		if (n_pil2.value==n_pil3.value) {
		   if (n_pil2.value!=0) {
		   alert ("Pilihan 2 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
}
</script>
                  <table width="550" cellpadding="4">
                    <tbody>
                      <tr>
                        <td colspan="2" bordercolor="#FFFFFF" bgcolor="#FFFF00"><strong>Note
                          : <font color="#666666" size="2" face="ARIAL">Tanda
                          * ( Wajib Diisi Dengan Benar )</font></strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" bgcolor="#A4D87C"><span class="style1">Saya
                          menyatakan bahwa seluruh data yang saya isikan adalah
                          benar, dapat dipertanggungjawabkan dan telah melalui
                          persetujuan orang tua / wali. </span></td>
                      </tr>
                    </tbody>
                  </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C" align="center"><input name="submit" value=" Register PMB " type="SUBMIT">	  </td>
        </tr>
      </tbody>
    </table>
</font>

<!-- NOMOR REGISTRASI -->

<?php
/* global $str;
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
$str2="$no_rekening$no_token$str";
srand((double)microtime()*1000000);
$rand=substr(str_shuffle($str2),0,7);
$tokencode=$rand;   */

?>
<INPUT type="hidden" name="c_jalur" value="reguler" />
<INPUT type="hidden" name="i_thn_akademik" value="<? echo "$row_thnakademik[1]"?>" />
</form>
</td>
 </tr>
</tbody></table>
<?php
} else if($_SESSION[jalur]=="PMDK") {
  $sql_gel="select * from t_gel where kodegel='PMDK' and status='on'";
  $query_gel=mysql_query($sql_gel,$koneksi);
  $row_gel=mysql_fetch_array($query_gel);
  if (mysql_num_rows($query_gel)>0){
	?>
     <form method=POST enctype='multipart/form-data' action=?module=registrasi&act=checkpmdk>
<font color="#666666" face="ARIAL" size="2">	<table width="741" cellpadding="4">
<input type=hidden name=pin value=<?php echo $_SESSION[pin]; ?>>
	 <!-- GELOMBANG -->
	<table width="550" cellpadding="4">
	  <tbody>
	    <tr>
	      <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>PMDK</b><br>
	                  <?php
  echo"$row_gel[3]";
  ?>
</span></td>
        </tr>
      </tbody>
	  </table>
	<table width="550" cellpadding="4">
	  <tbody>
	    <tr>
	      <td width="210" bgcolor="#dddddd">
	        Gelombang	  </td>
	        <td width="507" bgcolor="#eeeeee">
	          <!--
	   <INPUT TYPE="HIDDEN" NAME="gelombang" VALUE="1">Gelombang I
	   <BR>
	   -->
	          <input name="c_gel" value="<? echo"$row_gel[1]"; ?>" type="HIDDEN">  <? echo"$row_gel[2]"; ?>
  </td>
        </tr>
		   <tr>
	      <td width="210" bgcolor="#dddddd">
	        Biaya Pendaftaran	  </td>
	        <td width="507" bgcolor="#eeeeee">
	          <!--
	   <INPUT TYPE="HIDDEN" NAME="gelombang" VALUE="1">Gelombang I
	   <BR>
	   --><input type="text" value="150.000,-" readonly></td>
	       </tr>

	    <tr>
	      <td colspan="2" height="4"></td>
        </tr>

	    <!-- DATA PRIBADI -->
	    <tr>
	      <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
	  </tbody>
	</table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Pribadi Peserta</b><br>
            Isilah data pribadi Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="221" bgcolor="#dddddd">
            Nama Lengkap * 	  </td>
	              <td width="496" bgcolor="#eeeeee">
	                <input name="n_lengkap" type="TEXT" class="required" value="<?php echo $_SESSION['nama']; ?>" size="40" maxlength="80"></td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd">
            Jenis Kelamin *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_jns_kelamin" value="L" selected="" type="RADIO">Laki-laki
	                <br>
	                <input name="n_jns_kelamin" value="P" type="RADIO" class="validate-one-required">Perempuan	  </td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd">
            Tempat, Tanggal Lahir *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_temp_lahir" type="TEXT" class="required" value="<?php echo $_SESSION['tmptlahir']; ?>" size="15" maxlength="40">
	                ,

	                <input name="d_lahir" type="text" class="required" value="<?php echo $_SESSION['tgllahir']; ?>" readonly>
					<input type="button" value="Cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">	  </td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd" valign="top">
            Alamat yang dapat Dihubungi *	  </td>
	              <td bgcolor="#eeeeee">
	                <textarea name="n_alamat" rows="2" cols="30" class="required"><?php echo $_SESSION['alamat']; ?></textarea>	
	                *Keterangan : Mohon isi kolom alamat dengan lengkap dengan format Jalan, No.rumah, RT/RW, Kelurahan/Kecamatan, dan lain-lain sesuai dengan format KTP
		  </td>
        </tr>
                          <tr>
          <td width="221" bgcolor="#dddddd" valign="top">
            Agama	  </td>
	              <td bgcolor="#eeeeee">
	                <select size='1' name='i_agama' value="<?php echo $_SESSION[agama];?>">
	                <option value='islam'>Islam</option>
	                <option value='kristen'>Kristen Protestan</option>
	                <option value='katolik'>Katolik</option>
	                <option value='hindu'>Hindu</option>
	                <option value='budha'>Budha</option>
	                </select>
					</td>
	             </tr>

        <tr>
          <td width="221" bgcolor="#dddddd">
            Propinsi<br>
            Kabupaten / Kota *	  </td>
	              <td bgcolor="#eeeeee">
	                <!--
	   <INPUT TYPE="TEXT" NAME="kota" SIZE="25" MAXLENGTH="60">
	   -->

	                <script language="javascript">

kabupaten = new Array(

// Nangroe Aceh Darussalam
new Array(
new Array("Kab. Aceh Barat", "Kab. Aceh Barat"),
new Array("Kab. Aceh Barat Daya", "Kab. Aceh Barat Daya"),
new Array("Kab. Aceh Besar", "Kab. Aceh Besar"),
new Array("Kab. Aceh Jaya", "Aceh Jaya"),
new Array("Kab. Aceh Selatan", "Kab. Aceh Selatan"),
new Array("Kab. Aceh Singkil", "Kab. Aceh Singkil"),
new Array("Kab. Aceh Tamiang", "Kab. Aceh Tamiang"),
new Array("Kab. Aceh Tengah", "Kab. Aceh Tengah"),
new Array("Kab. Aceh Tenggara", "Kab. Aceh Tenggara"),
new Array("Kab. Aceh Timur", "Kab. Aceh Timur"),
new Array("Kab. Aceh Utara", "Kab. Aceh Utara"),
new Array("Kab. Bener Meriah", "Kab. Bener Meriah"),
new Array("Kab. Bireuen", "Kab. Bireuen"),
new Array("Kab. Gayo Lues", "Kab. Gayo Lues"),
new Array("Kab. Nagan Raya", "Kab. Nagan Raya"),
new Array("Kab. Pidie", "Kab. Pidie"),
new Array("Kab. Pidie Jaya", "Kab. Pidie Jaya"),
new Array("Kab. Simeulue", "Kab. Simeulue"),
new Array("Kota Banda Aceh", "Kota Banda Aceh"),
new Array("Kota Langsa", "Kota Langsa"),
new Array("Kota Lhokseumawe", "Kota Lhokseumawe"),
new Array("Kota Sabang", "Kota Sabang"),
new Array("Kota Subulussalam", "Kota Subulussalam"),
new Array("Lain-lain", "Lain-lain")
),

// Sumatera Utara
new Array(
new Array("Kab. Asahan", "Kab. Asahan"),
new Array("Kab. Batu Bara", "Kab. Batu Bara"),
new Array("Kab. Dairi", "Kab. Dairi"),
new Array("Kab. Deli Serdang", "Kab. Deli Serdang"),
new Array("Kab. Humbang Hasundutan", "Kab. Humbang Hasundutan"),
new Array("Kab. Karo", "Kab. Karo"),
new Array("Kab. Labuhanbatu", "Kab. Labuhanbatu"),
new Array("Kab. Labuhanbatu Selatan", "Kab. Labuhanbatu Selatan"),
new Array("Kab. Labuhanbatu Utara", "Kab. Labuhanbatu Utara"),
new Array("Kab. Langkat", "Kab. Langkat"),
new Array("Kab. Mandailing Natal", "Kab. Mandailing Natal"),
new Array("Kab. Nias", "Kab. Nias"),
new Array("Kab. Nias Barat", "Kab. Nias Barat"),
new Array("Kab. Nias Selatan", "Kab. Nias Selatan"),
new Array("Kab. Nias Utara", "Kab. Nias Utara"),
new Array("Kab. Padang Lawas", "Kab. Padang Lawas"),
new Array("Kab. Padang Lawas Utara", "Kab. Padang Lawas Utara"),
new Array("Kab. Pakpak Bharat", "Kab. Pakpak Bharat"),
new Array("Kab. Samosir", "Kab. Samosir"),
new Array("Kab. Serdang Bedagai", "Kab. Serdang Bedagai"),
new Array("Kab. Simalungun", "Kab. Simalungun"),
new Array("Kab. Tapanuli Selatan", "Kab. Tapanuli Selatan"),
new Array("Kab. Tapanuli Tengah", "Kab. Tapanuli Tengah"),
new Array("Kab. Tapanuli Utara", "Kab. Tapanuli Utara"),
new Array("Kab. Toba Samosir", "Kab. Toba Samosir"),
new Array("Kota Binjai", "Kota Binjai"),
new Array("Kota Gunung Sitoli", "Kota Gunung Sitoli"),
new Array("Kota Medan", "Kota Medan"),
new Array("Kota Padang Sidempuan", "Kota Padang Sidempuan"),
new Array("Kota Pematang Siantar", "Kota Pematang Siantar"),
new Array("Kota Sibolga", "Kota Sibolga"),
new Array("Kota Tanjung Balai", "Kota Tanjung Balai"),
new Array("Kota Tebing Tinggi", "Kota Tebing Tinggi"),
new Array("Lain-lain", "Lain-lain")
),

// Sumatera Barat
new Array(
new Array("Kab. Agam", "Kab. Agam"),
new Array("Kab. Dharmasraya", "Kab. Dharmasraya"),
new Array("Kab. Kepulauan Mentawai", "Kab. Kepulauan Mentawai"),
new Array("Kab. Lima Puluh Kota", "Kab. Lima Puluh Kota"),
new Array("Kab. Padang Pariaman", "Kab. Padang Pariaman"),
new Array("Kab. Pasaman", "Kab. Pasaman"),
new Array("Kab. Pasaman Barat", "Kab. Pasaman Barat"),
new Array("Kab. Pesisir Selatan", "Kab. Pesisir Selatan"),
new Array("Kab. Sijunjung", "Kab. Sijunjung"),
new Array("Kab. Solok", "Kab. Solok"),
new Array("Kab. Solok Selatan", "Kab. Solok Selatan"),
new Array("Kab. Tanah Datar", "Kab. Tanah Datar"),
new Array("Kota Bukittinggi", "Kota Bukittinggi"),
new Array("Kota Padang", "Kota Padang"),
new Array("Kota Padang Panjang", "Kota Padang Panjang"),
new Array("Kota Payakumbuh", "Kota Payakumbuh"),
new Array("Kota Sawahlunto", "Kota Sawahlunto"),
new Array("Kota Solok", "Kota Solok"),
new Array("Lain-lain", "Lain-lain")
),

// Riau
new Array(
new Array("Kab. Bengkalis", "Kab. Bengkalis"),
new Array("Kab. Indragiri Hilir", "Kab. Indragiri Hilir"),
new Array("Kab. Indragiri Hulu", "Kab. Indragiri Hulu"),
new Array("Kab. Kampar", "Kab. Kampar"),
new Array("Kab. Kuantan Singingi", "Kab. Kuantan Singingi"),
new Array("Kab. Pelalawan", "Kab. Pelalawan"),
new Array("Kab. Rokan Hilir", "Kab. Rokan Hilir"),
new Array("Kab. Rokan Hulu", "Kab. Rokan Hulu"),
new Array("Kab. Siak", "Kab. Siak"),
new Array("Kota Pekanbaru", "Kota Pekanbaru"),
new Array("Kota Dumai", "Kota Dumai"),
new Array("Lain-lain", "Lain-lain")
),

// Jambi
new Array(
new Array("Kab. Batang Hari", "Kab. Batang Hari"),
new Array("Kab. Bungo", "Kab. Bungo"),
new Array("Kab. Kerinci", "Kab. Kerinci"),
new Array("Kab. Merangin", "Kab. Merangin"),
new Array("Kab. Muaro Jambi", "Kab. Muaro Jambi"),
new Array("Kab. Sorolangun", "Kab. Sorolangun"),
new Array("Kab. Tanjung Jabung Barat", "Kab. Tanjung Jabung Barat"),
new Array("Kab. Tanjung Jabung Timur", "Kab. Tanjung Jabung Timur"),
new Array("Kab. Tebo", "Kab. Tebo"),
new Array("Kota Jambi", "Kota Jambi"),
new Array("Kota Sungai Penuh", "Kota Sungai Penuh"),
new Array("Lain-lain", "Lain-lain")
),

// Sumatera Selatan
new Array(
new Array("Kab. Banyuasin", "Kab. Banyuasin"),
new Array("Kab. Empat Lawang", "Kab. Empat Lawang"),
new Array("Kab. Lahat", "Kab. Lahat"),
new Array("Kab. Muara Enim", "Kab. Muara Enim"),
new Array("Kab. Musi Banyuasin", "Kab. Musi Banyuasin"),
new Array("Kab. Musi Rawas", "Kab. Musi Rawas"),
new Array("Kab. Ogan Ilir", "Kab. Ogan Ilir"),
new Array("Kab. Ogan Komering Ilir", "Kab. Ogan Komering Ilir"),
new Array("Kab. Ogan Komering Ulu", "Kab. Ogan Komering Ulu"),
new Array("Kab. Ogan Komering Ulu Selatan", "Kab. Ogan Komering Ulu Selatan"),
new Array("Kab. Ogan Komering Ulu Timur", "Kab. Ogan Komering Ulu Timur"),
new Array("Kota Lubuklinggau", "Kota Lubuklinggau"),
new Array("Kota Pagar Alam", "Kota Pagar Alam"),
new Array("Kota Palembang", "Kota Palembang"),
new Array("Kota Prabumulih", "Kota Prabumulih"),
new Array("Lain-lain", "Lain-lain")
),

// Bengkulu
new Array(
new Array("Kab. Bengkulu Selatan", "Kab. Bengkulu Selatan"),
new Array("Kab. Bengkulu Tengah", "Kab. Bengkulu Tengah"),
new Array("Kab. Bengkulu Utara", "Kab. Bengkulu Utara"),
new Array("Kab. Kaur", "Kab. Kaur"),
new Array("Kab. Kepahiang", "Kab. Kepahiang"),
new Array("Kab. Lebong", "Kab. Lebong"),
new Array("Kab. Mukomuko", "Kab. Mukomuko"),
new Array("Kab. Rejang Lebong", "Kab. Rejang Lebong"),
new Array("Kab. Seluma", "Kab. Seluma"),
new Array("Kota Bengkulu", "Kota Bengkulu"),
new Array("Lain-lain", "Lain-lain")
),

// Lampung
new Array(
new Array("Kab. Lampung Barat", "Kab. Lampung Barat"),
new Array("Kab. Lampung Selatan", "Kab. Lampung Selatan"),
new Array("Kab. Lampung Tengah", "Kab. Lampung Tengah"),
new Array("Kab. Lampung Timur", "Kab. Lampung Timur"),
new Array("Kab. Lampung Utara", "Kab. Lampung Utara"),
new Array("Kab. Mesuji", "Kab. Mesuji"),
new Array("Kab. Pesawaran", "Kab. Pesawaran"),
new Array("Kab. Pringsewu", "Kab. Pringsewu"),
new Array("Kab. Tanggamus", "Kab. Tanggamus"),
new Array("Kab. Tulang Bawang", "Kab. Tulang Bawang"),
new Array("Kab. Tulang Bawang Barat", "Kab. Tulang Bawang Barat"),
new Array("Kab. Way Kanan", "Kab. Way Kanan"),
new Array("Kota Bandar Lampung", "Kota Bandar Lampung"),
new Array("Kota Metro", "Kota Metro"),
new Array("Lain-lain", "Lain-lain")
),

// Bangka Belitung
new Array(
new Array("Kab. Bangka", "Kab. Bangka"),
new Array("Kab. Bangka Barat", "Kab. Bangka Barat"),
new Array("Kab. Bangka Selatan", "Kab. Bangka Selatan"),
new Array("Kab. Bangka Tengah", "Kab. Bangka Tengah"),
new Array("Kab. Belitung", "Kab. Belitung"),
new Array("Kab. Belitung Timur", "Kab. Belitung Timur"),
new Array("Kota Pangkal Pinang", "Kota Pangkal Pinang"),
new Array("Lain-lain", "Lain-lain")
),

// Kepulauan Riau
new Array(
new Array("Kab. Bintan", "Kab. Bintan"),
new Array("Kab. Karimun", "Kab. Karimun"),
new Array("Kab. Kepulauan Anambas", "Kab. Kepulauan Anambas"),
new Array("Kab. Lingga", "Kab. Lingga"),
new Array("Kab. Natuna", "Kab. Natuna"),
new Array("Kota Batam", "Kota Batam"),
new Array("Kota Tanjung Pinang", "Kota Tanjung Pinang"),
new Array("Lain-lain", "Lain-lain")
),

// DKI Jakarta
new Array(
new Array("Kab. Adm. Kepulauan Seribu", "Kab. Adm. Kepulauan Seribu"),
new Array("Kota Jakarta Barat", "Kota Jakarta Barat"),
new Array("Kota Jakarta Pusat", "Kota Jakarta Pusat"),
new Array("Kota Jakarta Selatan", "Kota Jakarta Selatan"),
new Array("Kota Jakarta Timur", "Kota Jakarta Timur"),
new Array("Kota Jakarta Utara", "Kota Jakarta Utara")
),

// Jawa Barat
new Array(
new Array("Kab. Bandung", "Kab. Bandung"),
new Array("Kab. Bandung Barat", "Kab. Bandung Barat"),
new Array("Kab. Bekasi", "Kab. Bekasi"),
new Array("Kab. Bogor", "Kab. Bogor"),
new Array("Kab. Ciamis", "Kab. Ciamis"),
new Array("Kab. Cianjur", "Kab. Cianjur"),
new Array("Kab. Cirebon", "Kab. Cirebon"),
new Array("Kab. Garut", "Kab. Garut"),
new Array("Kab. Indramayu", "Kab. Indramayu"),
new Array("Kab. Karawang", "Kab. Karawang"),
new Array("Kab. Kuningan", "Kab. Kuningan"),
new Array("Kab. Majalengka", "Kab. Majalengka"),
new Array("Kab. Purwakarta", "Kab. Purwakarta"),
new Array("Kab. Subang", "Kab. Subang"),
new Array("Kab. Sukabumi", "Kab. Sukabumi"),
new Array("Kab. Sumedang", "Kab. Sumedang"),
new Array("Kab. Tasikmalaya", "Kab. Tasikmalaya"),
new Array("Kota Bandung", "Kota Bandung"),
new Array("Kota Banjar", "Kota Banjar"),
new Array("Kota Bekasi", "Kota Bekasi"),
new Array("Kota Bogor", "Kota Bogor"),
new Array("Kota Cimahi", "Kota Cimahi"),
new Array("Kota Cirebon", "Kota Cirebon"),
new Array("Kota Depok", "Kota Depok"),
new Array("Kota Sukabumi", "Kota Sukabumi"),
new Array("Kota Tasikmalaya", "Kota Tasikmalaya"),
new Array("Lain-lain", "Lain-lain")
),

// Jawa Tengah
new Array(
new Array("Kab. Banjarnegara", "Kab. Banjarnegara"),
new Array("Kab. Banyumas", "Kab. Banyumas"),
new Array("Kab. Batang", "Kab. Batang"),
new Array("Kab. Blora", "Kab. Blora"),
new Array("Kab. Boyolali", "Kab. Boyolali"),
new Array("Kab. Brebes", "Kab. Brebes"),
new Array("Kab. Cilacap", "Kab. Cilacap"),
new Array("Kab. Demak", "Kab. Demak"),
new Array("Kab. Grobogan", "Kab. Grobogan"),
new Array("Kab. Jepara", "Kab. Jepara"),
new Array("Kab. Karanganyar", "Kab. Karanganyar"),
new Array("Kab. Kebumen", "Kab. Kebumen"),
new Array("Kab. Kendal", "Kab. Kendal"),
new Array("Kab. Klaten", "Kab. Klaten"),
new Array("Kab. Kudus", "Kab. Kudus"),
new Array("Kab. Magelang", "Kab. Magelang"),
new Array("Kab. Pati", "Kab. Pati"),
new Array("Kab. Pekalongan", "Kab. Pekalongan"),
new Array("Kab. Pemalang", "Kab. Pemalang"),
new Array("Kab. Purbalingga", "Kab. Purbalingga"),
new Array("Kab. Purworejo", "Kab. Purworejo"),
new Array("Kab. Rembang", "Kab. Rembang"),
new Array("Kab. Semarang", "Kab. Semarang"),
new Array("Kab. Sragen", "Kab. Sragen"),
new Array("Kab. Sukoharjo", "Kab. Sukoharjo"),
new Array("Kab. Tegal", "Kab. Tegal"),
new Array("Kab. Temanggung", "Kab. Temanggung"),
new Array("Kab. Wonogiri", "Kab. Wonogiri"),
new Array("Kab. Wonosobo", "Kab. Wonosobo"),
new Array("Kota Magelang", "Kota Magelang"),
new Array("Kota Pekalongan", "Kota Pekalongan"),
new Array("Kota Salatiga", "Kota Salatiga"),
new Array("Kota Semarang", "Kota Semarang"),
new Array("Kota Surakarta / Solo", "Kota Surakarta / Solo"),
new Array("Kota Tegal", "Kota Tegal"),
new Array("Lain-lain", "Lain-lain")
),

// DI Yogyakarta
new Array(
new Array("Kab. Bantul", "Kab. Bantul"),
new Array("Kab. Gunung Kidul", "Kab. Gunung Kidul"),
new Array("Kab. Kulon Progo", "Kab. Kulon Progo"),
new Array("Kab. Sleman", "Kab. Sleman"),
new Array("Kota Yogyakarta", "Kota Yogyakarta"),
new Array("Lain-lain", "Lain-lain")
),

// Jawa Timur
new Array(
new Array("Kab. Bangkalan", "Kab. Bangkalan"),
new Array("Kab. Banyuwangi", "Kab. Banyuwangi"),
new Array("Kab. Blitar", "Kab. Blitar"),
new Array("Kab. Bojonegoro", "Kab. Bojonegoro"),
new Array("Kab. Bondowoso", "Kab. Bondowoso"),
new Array("Kab. Gresik", "Kab. Gresik"),
new Array("Kab. Jember", "Kab. Jember"),
new Array("Kab. Jombang", "Kab. Jombang"),
new Array("Kab. Kediri", "Kab. Kediri"),
new Array("Kab. Lamongan", "Kab. Lamongan"),
new Array("Kab. Lumajang", "Kab. Lumajang"),
new Array("Kab. Madiun", "Kab. Madiun"),
new Array("Kab. Magetan", "Kab. Magetan"),
new Array("Kab. Malang", "Kab. Malang"),
new Array("Kab. Mojokerto", "Kab. Mojokerto"),
new Array("Kab. Nganjuk", "Kab. Nganjuk"),
new Array("Kab. Ngawi", "Kab. Ngawi"),
new Array("Kab. Pacitan", "Kab. Pacitan"),
new Array("Kab. Pamekasan", "Kab. Pamekasan"),
new Array("Kab. Pasuruan", "Kab. Pasuruan"),
new Array("Kab. Ponorogo", "Kab. Ponorogo"),
new Array("Kab. Probolinggo", "Kab. Probolinggo"),
new Array("Kab. Sampang", "Kab. Sampang"),
new Array("Kab. Sidoarjo", "Kab. Sidoarjo"),
new Array("Kab. Situbondo", "Kab. Situbondo"),
new Array("Kab. Sumenep", "Kab. Sumenep"),
new Array("Kab. Trenggalek", "Kab. Trenggalek"),
new Array("Kab. Tuban", "Kab. Tuban"),
new Array("Kab. Tulungagung", "Kab. Tulungagung"),
new Array("Kota Batu", "Kota Batu"),
new Array("Kota Blitar", "Kota Blitar"),
new Array("Kota Kediri", "Kota Kediri"),
new Array("Kota Madiun", "Kota Madiun"),
new Array("Kota Malang", "Kota Malang"),
new Array("Kota Mojokerto", "Kota Mojokerto"),
new Array("Kota Pasuruan", "Kota Pasuruan"),
new Array("Kota Probolinggo", "Kota Probolinggo"),
new Array("Kota Surabaya", "Kota Surabaya"),
new Array("Lain-lain", "Lain-lain")
),

// Banten
new Array(
new Array("Kab. Lebak", "Kab. Lebak"),
new Array("Kab. Pandeglang", "Kab. Pandeglang"),
new Array("Kab. Serang", "Kab. Serang"),
new Array("Kab. Tangerang", "Kab. Tangerang"),
new Array("Kota Cilegon", "Kota Cilegon"),
new Array("Kata Serang", "Kata Serang"),
new Array("Kota Tangerang", "Kota Tangerang"),
new Array("Kota Tangerang Selatan", "Kota Tangerang Selatan"),
new Array("Lain-lain", "Lain-lain")
),

// Bali
new Array(
new Array("Kab. Badung", "Kab. Badung"),
new Array("Kab. Bangli", "Kab. Bangli"),
new Array("Kab. Buleleng", "Kab. Buleleng"),
new Array("Kab. Gianyar", "Kab. Gianyar"),
new Array("Kab. Jembrana", "Kab. Jembrana"),
new Array("Kab. Karangasem", "Kab. Karangasem"),
new Array("Kab. Klungkung", "Kab. Klungkung"),
new Array("Kab. Tabanan", "Kab. Tabanan"),
new Array("Kota Denpasar", "Kota Denpasar"),
new Array("Lain-lain", "Lain-lain")
),

// NTB
new Array(
new Array("Kab. Bima", "Kab. Bima"),
new Array("Kab. Dompu", "Kab. Dompu"),
new Array("Kab. Lombok Barat", "Kab. Lombok Barat"),
new Array("Kab. Lombok Tengah", "Kab. Lombok Tengah"),
new Array("Kab. Lombok Timur", "Kab. Lombok Timur"),
new Array("Kab. Lombok Utara", "Kab. Lombok Utara"),
new Array("Kab. Sumbawa", "Kab. Sumbawa"),
new Array("Kab. Sumbawa Barat", "Kab. Sumbawa Barat"),
new Array("Kota Bima", "Kota Bima"),
new Array("Kota Mataram", "Kota Mataram"),
new Array("Lain-lain", 999)
),

// NTT
new Array(
new Array("Kab. Alor", "Kab. Alor"),
new Array("Kab. Belu", "Kab. Belu"),
new Array("Kab. Ende", "Kab. Ende"),
new Array("Kab. Flores Timur", "Kab. Flores Timur"),
new Array("Kab. Kupang", "Kab. Kupang"),
new Array("Kab. Lembata", "Kab. Lembata"),
new Array("Kab. Manggarai", "Kab. Manggarai"),
new Array("Kab. Manggarai Barat", "Kab. Manggarai Barat"),
new Array("Kab. Manggarai Timur", "Kab. Manggarai Timur"),
new Array("Kab. Nagekeo", "Kab. Nagekeo"),
new Array("Kab. Ngada", "Kab. Ngada"),
new Array("Kab. Rote Ndao", "Kab. Rote Ndao"),
new Array("Kab. Sabu Raijua", "Kab. Sabu Raijua"),
new Array("Kab. Sikka", "Kab. Sikka"),
new Array("Kab. Sumba Barat", "Kab. Sumba Barat"),
new Array("Kab. Sumba Barat Daya", "Kab. Sumba Barat Daya"),
new Array("Kab. Sumba Tengah", "Kab. Sumba Tengah"),
new Array("Kab. Sumba Timur", "Kab. Sumba Timur"),
new Array("Kab. Timor Tengah Selatan", "Kab. Timor Tengah Selatan"),
new Array("Kab. Timor Tengah Utara", "Kab. Timor Tengah Utara"),
new Array("Kota Kupang", "Kota Kupang"),
new Array("Lain-lain", "Lain-lain")
),

// Kalimantan Barat
new Array(
new Array("Kab. Bengkayang", "Kab. Bengkayang"),
new Array("Kab. Kapuas Hulu", "Kab. Kapuas Hulu"),
new Array("Kab. Kayong Utara", "Kab. Kayong Utara"),
new Array("Kab. Ketapang", "Kab. Ketapang"),
new Array("Kab. Kubu Raya", "Kab. Kubu Raya"),
new Array("Kab. Landak", "Kab. Landak"),
new Array("Kab. Melawi", "Kab. Melawi"),
new Array("Kab. Pontianak", "Kab. Pontianak"),
new Array("Kab. Sambas", "Kab. Sambas"),
new Array("Kab. Sanggau", "Kab. Sanggau"),
new Array("Kab. Sekadau", "Kab. Sekadau"),
new Array("Kab. Sintang", "Kab. Sintang"),
new Array("Kota Pontianak", "Kota Pontianak"),
new Array("Kota Singkawang", "Kota Singkawang"),
new Array("Lain-lain", "Lain-lain")
),

// Kalimantan Tengah
new Array(
new Array("Kab. Barito Selatan", "Kab. Barito Selatan"),
new Array("Kab. Barito Timur", "Kab. Barito Timur"),
new Array("Kab. Barito Utara", "Kab. Barito Utara"),
new Array("Kab. Gunung Mas", "Kab. Gunung Mas"),
new Array("Kab. Kapuas", "Kab. Kapuas"),
new Array("Kab. Katingan", "Kab. Katingan"),
new Array("Kab. Kotawaringin Barat", "Kab. Kotawaringin Barat"),
new Array("Kab. Kotawaringin Timur", "Kab. Kotawaringin Timur"),
new Array("Kab. Lamandau", "Kab. Lamandau"),
new Array("Kab. Murung Raya", "Kab. Murung Raya"),
new Array("Kab. Pulau Pisang", "Kab. Pulau Pisang"),
new Array("Kab. Sukamara", "Kab. Sukamara"),
new Array("Kab. Seruyan", "Kab. Seruyan"),
new Array("Kota Palangka Raya", "Kota Palangka Raya"),
new Array("Lain-lain", "Lain-lain")
),

// Kalimantan Selatan
new Array(
new Array("Kab. Balangan", "Kab. Balangan"),
new Array("Kab. Banjar", "Kab. Banjar"),
new Array("Kab. Barito Kuala", "Kab. Barito Kuala"),
new Array("Kab. Hulu Sungai Selatan", "Kab. Hulu Sungai Selatan"),
new Array("Kab. Hulu Sungai Tengah", "Kab. Hulu Sungai Tengah"),
new Array("Kab. Hulu Sungai Utara", "Kab. Hulu Sungai Utara"),
new Array("Kab. Kotabaru", "Kab. Kotabaru"),
new Array("Kab. Tabalong", "Kab. Tabalong"),
new Array("Kab. Tanah Bumbu", "Kab. Tanah Bumbu"),
new Array("Kab. Tanah Laut", "Kab. Tanah Laut"),
new Array("Kab. Tapin", "Kab. Tapin"),
new Array("Kota Banjarbaru", "Kota Banjarbaru"),
new Array("Kota Banjarmasin", "Kota Banjarmasin"),
new Array("Lain-lain", "Lain-lain")
),

// Kalimantan Timur
new Array(
new Array("Kab. Berau", "Kab. Berau"),
new Array("Kab. Bulungan", "Kab. Bulungan"),
new Array("Kab. Kutai Barat", "Kab. Kutai Barat"),
new Array("Kab. Kutai Kartanegara", "Kab. Kutai Kartanegara"),
new Array("Kab. Kutai Timur", "Kab. Kutai Timur"),
new Array("Kab. Malinau", "Kab. Malinau"),
new Array("Kab. Nunukan", "Kab. Nunukan"),
new Array("Kab. Paser", "Kab. Paser"),
new Array("Kab. Penajam Paser Utara", "Kab. Penajam Paser Utara"),
new Array("Kab. Tana Tidung", "Kab. Tana Tidung"),
new Array("Kota Balikpapan", "Kota Balikpapan"),
new Array("Kota Bontang", "Kota Bontang"),
new Array("Kota Samarinda", "Kota Samarinda"),
new Array("Kota Tarakan", "Kota Tarakan"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Utara
new Array(
new Array("Kab. Bolaang Mongondow", "Kab. Bolaang Mongondow"),
new Array("Kab. Bolaang Mongondow Selatan", "Kab. Bolaang Mongondow Selatan"),
new Array("Kab. Bolaang Mongondow Timur", "Kab. Bolaang Mongondow Timur"),
new Array("Kab. Bolaang Mongondow Utara", "Kab. Bolaang Mongondow Utara"),
new Array("Kab. Kepulauan Sangihe", "Kab. Kepulauan Sangihe"),
new Array("Kab. Kepulauan Siau Tagalandang Biaro", "Kab. Kepulauan Siau Tagalandang Biaro"),
new Array("Kab. Kepulauan Talaud", "Kab. Kepulauan Talaud"),
new Array("Kab. Minahasa", "Kab. Minahasa"),
new Array("Kab. Minahasa Selatan", "Kab. Minahasa Selatan"),
new Array("Kab. Minahasa Tenggara", "Kab. Minahasa Tenggara"),
new Array("Kab. Minahasa Utara", "Kab. Minahasa Utara"),
new Array("Kota Bitung", "Kota Bitung"),
new Array("Kota Kotamobagu", "Kota Kotamobagu"),
new Array("Kota Manado", "Kota Manado"),
new Array("Kota Tomohon", "Kota Tomohon"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Tengah
new Array(
new Array("Kab. Banggai", "Kab. Banggai"),
new Array("Kab. Banggai Kepulauan", "Kab. Banggai Kepulauan"),
new Array("Kab. Buol", "Kab. Buol"),
new Array("Kab. Donggala", "Kab. Donggala"),
new Array("Kab. Morowali", "Kab. Morowali"),
new Array("Kab. Parigi Moutong", "Kab. Parigi Moutong"),
new Array("Kab. Poso", "Kab. Poso"),
new Array("Kab. Tojo Una-Una", "Kab. Tojo Una-Una"),
new Array("Kab. Toli-Toli", "Kab. Toli-Toli"),
new Array("Kab. Sigi", "Kab. Sigi"),
new Array("Kota Palu", "Kota Palu"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Selatan
new Array(
new Array("Kab. Bantaeng", "Kab. Bantaeng"),
new Array("Kab. Barru", "Kab. Barru"),
new Array("Kab. Bone", "Kab. Bone"),
new Array("Kab. Bulukumba", "Kab. Bulukumba"),
new Array("Kab. Enrekang", "Kab. Enrekang"),
new Array("Kab. Gowa", "Kab. Gowa"),
new Array("Kab. Jeneponto", "Kab. Jeneponto"),
new Array("Kab. Kepulauan Selayar", "Kab. Kepulauan Selayar"),
new Array("Kab. Luwu", "Kab. Luwu"),
new Array("Kab. Luwu Timur", "Kab. Luwu Timur"),
new Array("Kab. Luwu Utara", "Kab. Luwu Utara"),
new Array("Kab. Maros", "Kab. Maros"),
new Array("Kab. Pangkajene & Kepulauan", "Kab. Pangkajene & Kepulauan"),
new Array("Kab. Pinrang", "Kab. Pinrang"),
new Array("Kab. Sidenreng Rappang", "Kab. Sidenreng Rappang"),
new Array("Kab. Sinjai", "Kab. Sinjai"),
new Array("Kab. Soppeng", "Kab. Soppeng"),
new Array("Kab. Takalar", "Kab. Takalar"),
new Array("Kab. Tana Toraja", "Kab. Tana Toraja"),
new Array("Kab. Toraja Utara", "Kab. Toraja Utara"),
new Array("Kab. Wajo", "Kab. Wajo"),
new Array("Kota Makassar", "Kota Makassar"),
new Array("Kota Palopo", "Kota Palopo"),
new Array("Kota Pare-Pare", "Kota Pare-Pare"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Tenggara
new Array(
new Array("Kab. Bombana", "Kab. Bombana"),
new Array("Kab. Buton", "Kab. Buton"),
new Array("Kab. Buton Utara", "Kab. Buton Utara"),
new Array("Kab. Kolaka", "Kab. Kolaka"),
new Array("Kab. Kolaka Utara", "Kab. Kolaka Utara"),
new Array("Kab. Konawe", "Kab. Konawe"),
new Array("Kab. Konawe Selatan", "Kab. Konawe Selatan"),
new Array("Kab. Konawe Utara", "Kab. Konawe Utara"),
new Array("Kab. Muna", "Kab. Muna"),
new Array("Kab. Wakatobi", "Kab. Wakatobi"),
new Array("Kota Bau-Bau", "Kota Bau-Bau"),
new Array("Kota Kendari", "Kota Kendari"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Barat
new Array(
new Array("Kab. Majene", "Kab. Majene"),
new Array("Kab. Mamasa", "Kab. Mamasa"),
new Array("Kab. Mamuju", "Kab. Mamuju"),
new Array("Kab. Mamuju Utara", "Kab. Mamuju Utara"),
new Array("Kab. Polewali Mandar", "Kab. Polewali Mandar"),
new Array("Lain-lain", "Lain-lain")
),

// Gorontalo
new Array(
new Array("Kab. Boalemo", "Kab. Boalemo"),
new Array("Kab. Bone Bolango", "Kab. Bone Bolango"),
new Array("Kab. Gorontalo", "Kab. Gorontalo"),
new Array("Kab. Gorontalo Utara", "Kab. Gorontalo Utara"),
new Array("Kab. Pohuwato", "Kab. Pohuwato"),
new Array("Kota Gorontalo", "Kota Gorontalo"),
new Array("Lain-lain", "Lain-lain")
),

// Maluku
new Array(
new Array("Kab. Buru", "Kab. Buru"),
new Array("Kab. Buru Selatan", "Kab. Buru Selatan"),
new Array("Kab. Kepulauan Aru", "Kab. Kepulauan Aru"),
new Array("Kab. Maluku Barat Daya", "Kab. Maluku Barat Daya"),
new Array("Kab. Maluku Tengah", "Kab. Maluku Tengah"),
new Array("Kab. Maluku Tenggara", "Kab. Maluku Tenggara"),
new Array("Kab. Maluku Tenggara Barat", "Kab. Maluku Tenggara Barat"),
new Array("Kab. Seram Bagian Barat", "Kab. Seram Bagian Barat"),
new Array("Kab. Seram Bagian Timur", "Kab. Seram Bagian Timur"),
new Array("Kota Ambon", "Kota Ambon"),
new Array("Kota Tual", "Kota Tual"),
new Array("Lain-lain", "Lain-lain")
),

// Maluku Utara
new Array(
new Array("Kab. Halmahera Barat", "Kab. Halmahera Barat"),
new Array("Kab. Halmahera Selatan", "Kab. Halmahera Selatan"),
new Array("Kab. Halmahera Tengah", "Kab. Halmahera Tengah"),
new Array("Kab. Halmahera Timur", "Kab. Halmahera Timur"),
new Array("Kab. Halmahera Utara", "Kab. Halmahera Utara"),
new Array("Kab. Kepulauan Sula", "Kab. Kepulauan Sula"),
new Array("Kab. Pulau Marotai", "Kab. Pulau Marotai"),
new Array("Kota Ternate", "Kota Ternate"),
new Array("Kota Tidore Kepulauan", "Kota Tidore Kepulauan"),
new Array("Lain-lain", "Lain-lain")
),

// Papua Barat
new Array(
new Array("Kab. Fakfak", "Kab. Fakfak"),
new Array("Kab. Kaimana", "Kab. Kaimana"),
new Array("Kab. Manokwari", "Kab. Manokwari"),
new Array("Kab. Raja Ampat", "Kab. Raja Ampat"),
new Array("Kob. Sorong", "Kab. Sorong"),
new Array("Kab. Tambrauw", "Kab. Tambrauw"),
new Array("Kab. Teluk Bintuni", "Kab. Teluk Bintuni"),
new Array("Kab. Teluk Wondama", "Kab. Teluk Wondama"),
new Array("Kota Sorong", "Kota Sorong"),
new Array("Lain-lain", "Lain-lain")
),

// Papua
new Array(
new Array("Kab. Asmat", "Kab. Asmat"),
new Array("Kab. Biak Numfor", "Kab. Biak Numfor"),
new Array("Kab. Boven Digoel", "Kab. Boven Digoel"),
new Array("Kab. Deiyai", "Kab. Deiyai"),
new Array("Kab. Dogiyai", "Kab. Dogiyai"),
new Array("Kab. Intan Jaya", "Kab. Intan Jaya"),
new Array("Kab. Jayapura", "Kab. Jayapura"),
new Array("Kab. Jayawijaya", "Kab. Jayawijaya"),
new Array("Kab. Keerom", "Kab. Keerom"),
new Array("Kab. Kepulauan Yapen", "Kab. Kepulauan Yapen"),
new Array("Kab. Lanny Jaya", "Kab. Lanny Jaya"),
new Array("Kab. Mamberamo Raya", "Kab. Mamberamo Raya"),
new Array("Kab. Mamberamo Tengah", "Kab. Mamberamo Tengah"),
new Array("Kab. Mappi", "Kab. Mappi"),
new Array("Kab. Merauke", "Kab. Merauke"),
new Array("Kab. Mimika", "Kab. Mimika"),
new Array("Kab. Nabire", "Kab. Nabire"),
new Array("Kab. Nduga", "Kab. Nduga"),
new Array("Kab. Paniai", "Kab. Paniai"),
new Array("Kab. Pegunungan Bintang", "Kab. Pegunungan Bintang"),
new Array("Kab. Puncak", "Kab. Puncak"),
new Array("Kab. Puncak Jaya", "Kab. Puncak Jaya"),
new Array("Kab. Sarmi", "Kab. Sarmi"),
new Array("Kab. Supiori", "Kab. Supiori"),
new Array("Kab. Tolikara", "Kab. Tolikara"),
new Array("Kab. Waropen", "Kab. Waropen"),
new Array("Kab. Yahukimo", "Kab. Yahukimo"),
new Array("Kab. Yalimo", "Kab. Yalimo"),
new Array("Kota Jayapura", "Kota Jayapura"),
new Array("Lain-lain", "Lain-lain")
),

// Luar Negri
new Array(
new Array("Malaysia", "Malaysia"),
new Array("Singapore", "Singapore"),
new Array("Others", "Others")
)
);

function fillSelectFromArray(selectCtrl, itemArray, goodPrompt, badPrompt, defaultItem) {
var i, j;
var prompt;
for (i = selectCtrl.options.length; i >= 0; i--) {
selectCtrl.options[i] = null;
}
prompt = (itemArray != null) ? goodPrompt : badPrompt;
if (prompt == null) {
j = 0;
}
else {
selectCtrl.options[0] = new Option(prompt);
j = 1;
}
if (itemArray != null) {
for (i = 0; i < itemArray.length; i++) {
selectCtrl.options[j] = new Option(itemArray[i][0]);
if (itemArray[i][1] != null) {
selectCtrl.options[j].value = itemArray[i][1];
}
j++;
}
selectCtrl.options[0].selected = true;
   }
}

</script>
	                <select name="n_propinsi" onChange="fillSelectFromArray(this.form.n_kabupaten, ((this.selectedIndex == -1) ? null :
	kabupaten[this.selectedIndex-1]));" class="validate-selection">
	                  <option selected="selected" value="">-- Pilih Propinsi --</option>
	                  <option value="Nanggroe Aceh Darussalam">Nanggroe Aceh Darussalam</option>
	                  <option value="Sumatera Utara">Sumatera Utara</option>
	                  <option value="Sumatera Barat">Sumatera Barat</option>
	                  <option value="Riau">Riau</option>
	                  <option value="Jambi">Jambi</option>
	                  <option value="Sumatera Selatan">Sumatera Selatan</option>
	                  <option value="Bengkulu">Bengkulu</option>
	                  <option value="Lampung">Lampung</option>
	                  <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
	                  <option value="Kepulauan Riau">Kepulauan Riau</option>
	                  <option value="DKI Jakarta">DKI Jakarta</option>
	                  <option value="Jawa Barat">Jawa Barat</option>
	                  <option value="Jawa Tengah">Jawa Tengah</option>
	                  <option value="DI Yogyakarta">DI Yogyakarta</option>
	                  <option value="Jawa Timur">Jawa Timur</option>
	                  <option value="Banten">Banten</option>
	                  <option value="Bali">Bali</option>
	                  <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
	                  <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
	                  <option value="Kalimantan Barat">Kalimantan Barat</option>
	                  <option value="Kalimantan Tengah">Kalimantan Tengah</option>
	                  <option value="Kalimantan Selatan">Kalimantan Selatan</option>
	                  <option value="Kalimantan Timur">Kalimantan Timur</option>
	                  <option value="Sulawesi Utara">Sulawesi Utara</option>
	                  <option value="Sulawesi Tengah">Sulawesi Tengah</option>
	                  <option value="Sulawesi Selatan">Sulawesi Selatan</option>
	                  <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
	                  <option value="Sulawesi Barat">Sulawesi Barat</option>
	                  <option value="Gorontalo">Gorontalo</option>
	                  <option value="Maluku">Maluku</option>
	                  <option value="Maluku Utara">Maluku Utara</option>
	                  <option value="Papua Barat">Papua Barat</option>
	                  <option value="Papua">Papua</option>
	                  <option value="Others (outside Indonesia)">Others Countries (outside Indonesia)</option>
                    </select>
                          <select name="n_kabupaten">
                            <option selected="selected"> </option>
                    </select> </td>
        </tr>
      <td width="221" bgcolor="#dddddd">
            Kode Pos *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="c_pos" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['kdpos']; ?>" size="5" maxlength="5" >	  </td>
        </tr>

        <tr>
                        <td width="221" bgcolor="#dddddd"> Nomor Telepon * </td>
	                    <td bgcolor="#eeeeee"> <input name="i_telp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['telp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd">
            Nomor Handphone/Selular *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="i_hp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['hp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
                        <td width="221" bgcolor="#dddddd"> Email * </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_email" type="TEXT" class="required validate-email" value="<?php echo $_SESSION['email']; ?>" size="25" maxlength="40"></td>
        </tr>



        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- DATA ORANGTUA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Orang Tua Peserta</b><br>
            Isilah data orang tua Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Nama Orang Tua *	  </td>
	                    <td bgcolor="#eeeeee">
                        <input name="n_ortu" type="TEXT" class="required" value="<?php echo $_SESSION['nm_ortu']; ?>" size="40" maxlength="60">	  </td>
        </tr>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Jenis Pekerjaan<br>
                          Orang Tua * </td>
	                    <td bgcolor="#eeeeee">
<!--                         <input name="n_jabatan" size="30" maxlength="80" type="TEXT" class="required">
 -->						<select name="n_jabatan" size="1" id="n_jabatan">
						<option selected="selected" value="">-- Pilih Pekerjaan Orang Tua --</option>
						<option value="TNI_POLRI">TNI/POLRI</option>
						<option value="PNS">PNS</option>
						<option value="Swasta">Swasta</option>
						<option value="BUMN">BUMN</option>
						<option value="Pesiunan">Pensiunan</option>
                        </select>  </td>
        </tr>


        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- DATA SMA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data SMA/MA/SMK Peserta</b><br>
            Isilah data SMA/MA/SMK asal Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Nama SMA/MA/SMK Asal *	  </td>
                        <td bgcolor="#eeeeee">
                        <input name="n_sma" type="TEXT" class="required" value="<?php echo $_SESSION['asalsma']; ?>" size="30" maxlength="60">	  </td>
        </tr>
        <tr>
          <?php
  $sql_smu="select * from t_jurusan_sma";
  $query_smu=mysql_query($sql_smu,$koneksi);
  ?>
          <td width="210" bgcolor="#dddddd">
            Jurusan SMA/MA/SMK *  </td>
                        <td bgcolor="#eeeeee">
                          <select name="i_jur_sma" size="1" id="jrsnsmu" class="validate-selection">
						    <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_smu=mysql_fetch_array($query_smu))
   {;?>
                            <option value ="<?php echo $row_smu['KodeSMU'];?>"><?php echo $row_smu['Keterangan'];?></option>
                            <?php }?>
                        </select>	  </td>
        </tr>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Alamat SMA/MA/SMK *	  </td>
                        <td bgcolor="#eeeeee">
                        <textarea name="n_alamat_sma" rows="2" cols="30" class="required"><?php echo $_SESSION['alamatsma']; ?></textarea>	  </td>
        </tr>



           <tr>
             <td width="210" bgcolor="#dddddd">
               Propinsi<br>
               Kabupaten / Kota *	  </td>
                        <td bgcolor="#eeeeee"><select name="n_prop_sma" onChange="fillSelectFromArray(this.form.n_kab_sma, ((this.selectedIndex == -1) ? null :
	kabupaten[this.selectedIndex-1]));" class="validate-selection">
                          <option selected="selected" value="">-- Pilih Propinsi
                          --</option>
                          <option value="Nanggroe Aceh Darussalam">Nanggroe Aceh
                          Darussalam</option>
                          <option value="Sumatera Utara">Sumatera Utara</option>
                          <option value="Sumatera Barat">Sumatera Barat</option>
                          <option value="Riau">Riau</option>
                          <option value="Jambi">Jambi</option>
                          <option value="Sumatera Selatan">Sumatera Selatan</option>
                          <option value="Bengkulu">Bengkulu</option>
                          <option value="Lampung">Lampung</option>
                          <option value="Kepulauan Bangka Belitung">Kepulauan
                          Bangka Belitung</option>
                          <option value="Kepulauan Riau">Kepulauan Riau</option>
                          <option value="DKI Jakarta">DKI Jakarta</option>
                          <option value="Jawa Barat">Jawa Barat</option>
                          <option value="Jawa Tengah">Jawa Tengah</option>
                          <option value="DI Yogyakarta">DI Yogyakarta</option>
                          <option value="Jawa Timur">Jawa Timur</option>
                          <option value="Banten">Banten</option>
                          <option value="Bali">Bali</option>
                          <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                          <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                          <option value="Kalimantan Barat">Kalimantan Barat</option>
                          <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                          <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                          <option value="Kalimantan Timur">Kalimantan Timur</option>
                          <option value="Sulawesi Utara">Sulawesi Utara</option>
                          <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                          <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                          <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                          <option value="Sulawesi Barat">Sulawesi Barat</option>
                          <option value="Gorontalo">Gorontalo</option>
                          <option value="Maluku">Maluku</option>
                          <option value="Maluku Utara">Maluku Utara</option>
                          <option value="Papua Barat">Papua Barat</option>
                          <option value="Papua">Papua</option>
                          <option value="Others (outside Indonesia)">Others Countries
                          (outside Indonesia)</option>
                        </select>

                          <select name="n_kab_sma">
                            <option selected="selected">             </option>
                        </select></td>
        </tr>
           <tr>
             <td colspan="2" height="4"></td>
        </tr>

           <!-- PILIHAN PRODI -->
           <tr>
             <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>          </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Pilihan Program Studi</b><br>
            Pilihlah program studi yang Saudara/i minati. Jumlah pilihan boleh
            satu, dua atau tiga program studi yang ada di<font size="2" face="ARIAL"> Politeknik
              Pos Indonesia</font>.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
<script language="JavaScript1.2">
function validate_pil(data) {
		var n_pil1=data.n_pil1;
		var n_pil2=data.n_pil2;
		var n_pil3=data.n_pil3;
		if (n_pil1.value==n_pil2.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 2");
		   n_pil2.value=0;   }
		   }
		if (n_pil1.value==n_pil3.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
		if (n_pil2.value==n_pil3.value) {
		   if (n_pil2.value!=0) {
		   alert ("Pilihan 2 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
}
</script>
           <tr>
<?php
function combo($var, $data) {
	echo "<select name='$var' onChange='validate_pil(this.form)'  class='validate-selection'>";
	echo "<option value=0 selected>- Pilih Jurusan -</option>";
	$sql=mysql_query("select * from t_jurusan");
	while ($data=mysql_fetch_array($sql)){
		echo "<option value=$data[KodeJrsn]>$data[NamaJrsn]</option>";
	}
	echo "</select>";
}
?>
             <td width="210" bgcolor="#dddddd">
               Pilihan 1 *	  </td>
                        <td bgcolor="#eeeeee"><? combo("n_pil1",$data1); ?></td>
        </tr>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Pilihan 2 *	  </td>
                        <td bgcolor="#eeeeee"><? combo("n_pil2",$data2); ?></td>
        </tr>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Pilihan 3 *	  </td>
                        <td bgcolor="#eeeeee"><? combo("n_pil3",$data3); ?></td>
        </tr>
        <tr>
          <td colspan="2" height="4"></td>
        </tr>

               <!-- LOKASI UJIAN  -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Lokasi Ujian</b><br>
            Pilihlah lokasi ujian tempat Saudara/i akan melakukan Ujian Saringan Masuk.
            Informasi wilayah lokasi ujian dapat Anda lihat pada halaman Lokasi
            Ujian. </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
                 <?php
				 $data=$_GET['data'];
  $sql_info="select * from t_informasi";
  $query_info=mysql_query($sql_info,$koneksi);
?>
                        <td width="210" bgcolor="#dddddd"> Tahu Infromasi Dari * </td>
                        <td bgcolor="#eeeeee">
                          <select name="c_inf" size="1" id="c_inf" class="validate-selection">
						    <option selected="selected" value="<?php echo $_SESSION[sumber];?>">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_info=mysql_fetch_array($query_info))
   {;?>
                            <option value =<?php echo $row_info[KodeInf];?>><?php echo $row_info[NamaInf];?></option>

                            <?php

							 }?>
							 	<?
						if ($row_info[NamaInf]=='LAINNYA')
							{
						echo"<input name='nama_info' type='text' id='nama_info' size='30' maxlength='60'>";					  	                         }
						else
						{
							echo"<input name='nama_info' type='hidden' id='nama_info' size='30' maxlength='60'>";
						}
						?>
                        </select>


                        </td
                      ></tr>
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- SDP2 -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Jumlah SK</b><br>
            Isilah jumlah Sumbangan Sukarela (SK) Saudara/i,
            dengan minimal sebesar Rp 100.000,- (seratus ribu rupiah)dan kelipatannya. </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
               <tr>
                 <td width="210" bgcolor="#dddddd">
                   Sumbangan Sukarela Sebesar
                   *<br>
                   <br>	  </td>
                        <td bgcolor="#eeeeee">
                   			<div id="advice-validate-currency-dollar-field5" class="custom-advice" style="display:none">Cukup isikan besaran SDP2 dalam angka bernominal rupiah, tanpa tanda baca.</div>
							<input name="q_sdp2" class="validate-currency-dollar required validate-rupiah validate-digit" id="q_sdp2" value="<?php echo $_SESSION['sk']; ?>" maxlength="8" />
                			</div>
       <!--
	   Rp.
	   <INPUT TYPE="TEXT" NAME"sdp2j" SIZE="3" MAXLENGTH="3" onclick="validateInt()">.
	   -->	  </td>
        </tr>
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- NILAI PRESTASI LAIN -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Catatan Prestasi</b> (jika tersedia)<br>
            Isilah prestasi lain dalam bidang olahraga, seni maupun olimpiade minimal tingkat propinsi yang pernah Saudara/i raih.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
               <tr>
                 <td width="210" bgcolor="#dddddd">
                   Prestasi yang Pernah Diraih	  </td>
                        <td bgcolor="#eeeeee">
                        <textarea name="e_prestasi" rows="4" cols="35" >-</textarea >	  </td>
        </tr>


               <tr>
                 <td colspan="2" height="4"></td>
        </tr>
                <!-- CAPTCHA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
     <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Nilai Calon Mahasiswa</b><br>
            Isilah data nilai Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
                        <td width="210" bgcolor="#dddddd"> Nilai Rata-rata kelas XI semester
                          2 * </td>
	                    <td bgcolor="#eeeeee">
                        <input name="rata2_XI_2" size="4" maxlength="4" type="TEXT" class="validate-number required required validate-rata" value="<?php echo $_SESSION['rata2_XI_2']; ?>" >
                       contoh:90,75 ditulis 9075; 4,1 ditulis 0410 </td>
        </tr>

        <tr>
                        <td width="210" bgcolor="#dddddd"> Nilai Matematika kelas XI semester
                          2 *</td>
	                    <td bgcolor="#eeeeee">
                        <input name="mtk_XI_2" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $_SESSION['mtk_XI_2']; ?>" >
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
        </tr>

        <tr>
                        <td width="210" bgcolor="#dddddd"> Nilai Bhs.Inggris kelas XI semester
                          2 * </td>
	                    <td bgcolor="#eeeeee">
                        <input name="ing_XI_2" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $_SESSION['ing_XI_2']; ?>" >
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
        </tr>
					  <tr>
					  </tr>
					  <tr>
					  </tr>
          <tr>
                        <td width="210" bgcolor="#dddddd"> Nilai Rata-rata kelas XII semester
                          1 * </td>
	                    <td bgcolor="#eeeeee">
                        <input name="rata2_XII_1" size="4" maxlength="4" type="TEXT" class="validate-number required required validate-rata" value="<?php echo $_SESSION['rata2_XII_1']; ?>" >
                        contoh:90,75 ditulis 9075; 4,1 ditulis 0410 </td>
        </tr>
					     <tr>
                        <td width="210" bgcolor="#dddddd"> Nilai Matematika kelas XII semester
                          1 * </td>
	                    <td bgcolor="#eeeeee">
                        <input name="mtk_XII_1" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $_SESSION['mtk_XII_1']; ?>" >
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
                      </tr>
           <tr>
                        <td width="210" bgcolor="#dddddd"> Nilai Bhs.Inggris kelas XII semester
                          1 * </td>
	                    <td bgcolor="#eeeeee">
                        <input name="ing_XII_1" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $_SESSION['ing_XII_1']; ?>" >
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
        </tr>
        <tr>
          <td colspan="2" height="4"></td>
        </tr>

	<!-- CAPTCHA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
     <table width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Photo Peserta</b><br>
            Upload photo Closeup terbaru Saudara/i ( Photo Resmi ) Ukuran 3x4</span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Photo ( 3x4 ) *	  </td>
	                    <td bgcolor="#eeeeee">
                        <input name="photo" size="40" maxlength="60" type="file" class="required">	  </td>
        </tr>



        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- End Photo-->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
<script language="JavaScript1.2">
function validate_pil(data) {
		var n_pil1=data.n_pil1;
		var n_pil2=data.n_pil2;
		var n_pil3=data.n_pil3;
		if (n_pil1.value==n_pil2.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 2");
		   n_pil2.value=0;   }
		   }
		if (n_pil1.value==n_pil3.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
		if (n_pil2.value==n_pil3.value) {
		   if (n_pil2.value!=0) {
		   alert ("Pilihan 2 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
}
</script>
                  <table width="550" cellpadding="4">
                    <tbody>
                      <tr>
                        <td colspan="2" bordercolor="#FFFFFF" bgcolor="#FFFF00"><strong>Note
                          : <font color="#666666" size="2" face="ARIAL">Tanda
                          * ( Wajib Diisi Dengan Benar )</font></strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" bgcolor="#A4D87C"><span class="style1">Saya
                          menyatakan bahwa seluruh data yang saya isikan adalah
                          benar, dapat dipertanggungjawabkan dan telah melalui
                          persetujuan orang tua / wali. </span></td>
                      </tr>
                    </tbody>
                  </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C" align="center"><input name="submit" value=" Register PMB " type="SUBMIT">	  </td>
        </tr>
      </tbody>
    </table>
</font>

<!-- NOMOR REGISTRASI -->
<INPUT type="hidden" name="c_jalur" value="PMDK" />
<INPUT type="hidden" name="i_thn_akademik" value="<? echo "$row_thnakademik[1]"?>" />
</form>
</td>
 </tr>
</tbody></table>
<?php
} 

else {
	echo "<b>Maaf Jalur Pendaftaran PMDK Telah ditutup !!!</b>";
}
}

////////////////////////////////PROGRAM EKSTENSI////////////////////////////// 
else if($_SESSION[jalur]=="EKS") {
  $sql_gel="select * from t_gel where KodeGel='EKS' and status='on'";
  $query_gel=mysql_query($sql_gel,$koneksi);
  $row_gel=mysql_fetch_array($query_gel);
  if (mysql_num_rows($query_gel)>0){
	?>
     <form method=POST enctype='multipart/form-data' action=?module=registrasi&act=checkpmdk>
<font color="#666666" face="ARIAL" size="2">	<table width="741" cellpadding="4">
<input type=hidden name=pin value=<?php echo $_SESSION[pin]; ?>>
	 <!-- GELOMBANG -->
	<table width="550" cellpadding="4">
	  <tbody>
	    <tr>
	      <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Program Ekstensi / Alih Jenjang</b><br>
	                  <?php
  echo"$row_gel[3]";
  ?>
</span></td>
        </tr>
      </tbody>
	  </table>
	<table width="550" cellpadding="4">
	  <tbody>
	    <tr>
	      <td width="210" bgcolor="#dddddd">
	        Gelombang	  </td>
	        <td width="507" bgcolor="#eeeeee">
	          <!--
	   <INPUT TYPE="HIDDEN" NAME="gelombang" VALUE="1">Gelombang I
	   <BR>
	   -->
	          <input name="c_gel" value="<? echo"$row_gel[1]"; ?>" type="HIDDEN">  <? echo"$row_gel[2]"; ?>
  </td>
        </tr>
		   <tr>
	      <td width="210" bgcolor="#dddddd">
	        Biaya Pendaftaran	  </td>
	        <td width="507" bgcolor="#eeeeee">
	          <!--
	   <INPUT TYPE="HIDDEN" NAME="gelombang" VALUE="1">Gelombang I
	   <BR>
	   --><input type="text" value="150.000,-" readonly></td>
	       </tr>

	    <tr>
	      <td colspan="2" height="4"></td>
        </tr>

	    <!-- DATA PRIBADI -->
	    <tr>
	      <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
	  </tbody>
	</table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Pribadi Peserta</b><br>
            Isilah data pribadi Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="221" bgcolor="#dddddd">
            Nama Lengkap * 	  </td>
	              <td width="496" bgcolor="#eeeeee">
	                <input name="n_lengkap" type="TEXT" class="required" value="<?php echo $_SESSION['nama']; ?>" size="40" maxlength="80"></td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd">
            Jenis Kelamin *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_jns_kelamin" value="L" selected="" type="RADIO">Laki-laki
	                <br>
	                <input name="n_jns_kelamin" value="P" type="RADIO" class="validate-one-required">Perempuan	  </td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd">
            Tempat, Tanggal Lahir *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_temp_lahir" type="TEXT" class="required" value="<?php echo $_SESSION['tmptlahir']; ?>" size="15" maxlength="40">
	                ,

	                <input name="d_lahir" type="text" class="required" value="<?php echo $_SESSION['tgllahir']; ?>" readonly>
					<input type="button" value="Cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">	  </td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd" valign="top">
            Alamat yang dapat Dihubungi *	  </td>
	              <td bgcolor="#eeeeee">
	                <textarea name="n_alamat" rows="2" cols="30" class="required"><?php echo $_SESSION['alamat']; ?></textarea>
	                *Keterangan : Mohon isi kolom alamat dengan lengkap dengan format Jalan, No.rumah, RT/RW, Kelurahan/Kecamatan, dan lain-lain sesuai dengan format KTP
		  </td>
        </tr>
                          <tr>
          <td width="221" bgcolor="#dddddd" valign="top">
            Agama	  </td>
	              <td bgcolor="#eeeeee">
	                <select size='1' name='i_agama' value="<?php echo $_SESSION[agama];?>">
	                <option value='islam'>Islam</option>
	                <option value='kristen'>Kristen Protestan</option>
	                <option value='katolik'>Katolik</option>
	                <option value='hindu'>Hindu</option>
	                <option value='budha'>Budha</option>
	                </select>
					</td>
	             </tr>

        <tr>
          <td width="221" bgcolor="#dddddd">
            Propinsi<br>
            Kabupaten / Kota *	  </td>
	              <td bgcolor="#eeeeee">
	                <!--
	   <INPUT TYPE="TEXT" NAME="kota" SIZE="25" MAXLENGTH="60">
	   -->

	                <script language="javascript">

kabupaten = new Array(

// Nangroe Aceh Darussalam
new Array(
new Array("Kab. Aceh Barat", "Kab. Aceh Barat"),
new Array("Kab. Aceh Barat Daya", "Kab. Aceh Barat Daya"),
new Array("Kab. Aceh Besar", "Kab. Aceh Besar"),
new Array("Kab. Aceh Jaya", "Aceh Jaya"),
new Array("Kab. Aceh Selatan", "Kab. Aceh Selatan"),
new Array("Kab. Aceh Singkil", "Kab. Aceh Singkil"),
new Array("Kab. Aceh Tamiang", "Kab. Aceh Tamiang"),
new Array("Kab. Aceh Tengah", "Kab. Aceh Tengah"),
new Array("Kab. Aceh Tenggara", "Kab. Aceh Tenggara"),
new Array("Kab. Aceh Timur", "Kab. Aceh Timur"),
new Array("Kab. Aceh Utara", "Kab. Aceh Utara"),
new Array("Kab. Bener Meriah", "Kab. Bener Meriah"),
new Array("Kab. Bireuen", "Kab. Bireuen"),
new Array("Kab. Gayo Lues", "Kab. Gayo Lues"),
new Array("Kab. Nagan Raya", "Kab. Nagan Raya"),
new Array("Kab. Pidie", "Kab. Pidie"),
new Array("Kab. Pidie Jaya", "Kab. Pidie Jaya"),
new Array("Kab. Simeulue", "Kab. Simeulue"),
new Array("Kota Banda Aceh", "Kota Banda Aceh"),
new Array("Kota Langsa", "Kota Langsa"),
new Array("Kota Lhokseumawe", "Kota Lhokseumawe"),
new Array("Kota Sabang", "Kota Sabang"),
new Array("Kota Subulussalam", "Kota Subulussalam"),
new Array("Lain-lain", "Lain-lain")
),

// Sumatera Utara
new Array(
new Array("Kab. Asahan", "Kab. Asahan"),
new Array("Kab. Batu Bara", "Kab. Batu Bara"),
new Array("Kab. Dairi", "Kab. Dairi"),
new Array("Kab. Deli Serdang", "Kab. Deli Serdang"),
new Array("Kab. Humbang Hasundutan", "Kab. Humbang Hasundutan"),
new Array("Kab. Karo", "Kab. Karo"),
new Array("Kab. Labuhanbatu", "Kab. Labuhanbatu"),
new Array("Kab. Labuhanbatu Selatan", "Kab. Labuhanbatu Selatan"),
new Array("Kab. Labuhanbatu Utara", "Kab. Labuhanbatu Utara"),
new Array("Kab. Langkat", "Kab. Langkat"),
new Array("Kab. Mandailing Natal", "Kab. Mandailing Natal"),
new Array("Kab. Nias", "Kab. Nias"),
new Array("Kab. Nias Barat", "Kab. Nias Barat"),
new Array("Kab. Nias Selatan", "Kab. Nias Selatan"),
new Array("Kab. Nias Utara", "Kab. Nias Utara"),
new Array("Kab. Padang Lawas", "Kab. Padang Lawas"),
new Array("Kab. Padang Lawas Utara", "Kab. Padang Lawas Utara"),
new Array("Kab. Pakpak Bharat", "Kab. Pakpak Bharat"),
new Array("Kab. Samosir", "Kab. Samosir"),
new Array("Kab. Serdang Bedagai", "Kab. Serdang Bedagai"),
new Array("Kab. Simalungun", "Kab. Simalungun"),
new Array("Kab. Tapanuli Selatan", "Kab. Tapanuli Selatan"),
new Array("Kab. Tapanuli Tengah", "Kab. Tapanuli Tengah"),
new Array("Kab. Tapanuli Utara", "Kab. Tapanuli Utara"),
new Array("Kab. Toba Samosir", "Kab. Toba Samosir"),
new Array("Kota Binjai", "Kota Binjai"),
new Array("Kota Gunung Sitoli", "Kota Gunung Sitoli"),
new Array("Kota Medan", "Kota Medan"),
new Array("Kota Padang Sidempuan", "Kota Padang Sidempuan"),
new Array("Kota Pematang Siantar", "Kota Pematang Siantar"),
new Array("Kota Sibolga", "Kota Sibolga"),
new Array("Kota Tanjung Balai", "Kota Tanjung Balai"),
new Array("Kota Tebing Tinggi", "Kota Tebing Tinggi"),
new Array("Lain-lain", "Lain-lain")
),

// Sumatera Barat
new Array(
new Array("Kab. Agam", "Kab. Agam"),
new Array("Kab. Dharmasraya", "Kab. Dharmasraya"),
new Array("Kab. Kepulauan Mentawai", "Kab. Kepulauan Mentawai"),
new Array("Kab. Lima Puluh Kota", "Kab. Lima Puluh Kota"),
new Array("Kab. Padang Pariaman", "Kab. Padang Pariaman"),
new Array("Kab. Pasaman", "Kab. Pasaman"),
new Array("Kab. Pasaman Barat", "Kab. Pasaman Barat"),

new Array("Kab. Pesisir Selatan", "Kab. Pesisir Selatan"),
new Array("Kab. Sijunjung", "Kab. Sijunjung"),
new Array("Kab. Solok", "Kab. Solok"),
new Array("Kab. Solok Selatan", "Kab. Solok Selatan"),
new Array("Kab. Tanah Datar", "Kab. Tanah Datar"),
new Array("Kota Bukittinggi", "Kota Bukittinggi"),
new Array("Kota Padang", "Kota Padang"),
new Array("Kota Padang Panjang", "Kota Padang Panjang"),
new Array("Kota Payakumbuh", "Kota Payakumbuh"),
new Array("Kota Sawahlunto", "Kota Sawahlunto"),
new Array("Kota Solok", "Kota Solok"),
new Array("Lain-lain", "Lain-lain")
),

// Riau
new Array(
new Array("Kab. Bengkalis", "Kab. Bengkalis"),
new Array("Kab. Indragiri Hilir", "Kab. Indragiri Hilir"),
new Array("Kab. Indragiri Hulu", "Kab. Indragiri Hulu"),
new Array("Kab. Kampar", "Kab. Kampar"),
new Array("Kab. Kuantan Singingi", "Kab. Kuantan Singingi"),
new Array("Kab. Pelalawan", "Kab. Pelalawan"),
new Array("Kab. Rokan Hilir", "Kab. Rokan Hilir"),
new Array("Kab. Rokan Hulu", "Kab. Rokan Hulu"),
new Array("Kab. Siak", "Kab. Siak"),
new Array("Kota Pekanbaru", "Kota Pekanbaru"),
new Array("Kota Dumai", "Kota Dumai"),
new Array("Lain-lain", "Lain-lain")
),

// Jambi
new Array(
new Array("Kab. Batang Hari", "Kab. Batang Hari"),
new Array("Kab. Bungo", "Kab. Bungo"),
new Array("Kab. Kerinci", "Kab. Kerinci"),
new Array("Kab. Merangin", "Kab. Merangin"),
new Array("Kab. Muaro Jambi", "Kab. Muaro Jambi"),
new Array("Kab. Sorolangun", "Kab. Sorolangun"),
new Array("Kab. Tanjung Jabung Barat", "Kab. Tanjung Jabung Barat"),
new Array("Kab. Tanjung Jabung Timur", "Kab. Tanjung Jabung Timur"),
new Array("Kab. Tebo", "Kab. Tebo"),
new Array("Kota Jambi", "Kota Jambi"),
new Array("Kota Sungai Penuh", "Kota Sungai Penuh"),
new Array("Lain-lain", "Lain-lain")
),

// Sumatera Selatan
new Array(
new Array("Kab. Banyuasin", "Kab. Banyuasin"),
new Array("Kab. Empat Lawang", "Kab. Empat Lawang"),
new Array("Kab. Lahat", "Kab. Lahat"),
new Array("Kab. Muara Enim", "Kab. Muara Enim"),
new Array("Kab. Musi Banyuasin", "Kab. Musi Banyuasin"),
new Array("Kab. Musi Rawas", "Kab. Musi Rawas"),
new Array("Kab. Ogan Ilir", "Kab. Ogan Ilir"),
new Array("Kab. Ogan Komering Ilir", "Kab. Ogan Komering Ilir"),
new Array("Kab. Ogan Komering Ulu", "Kab. Ogan Komering Ulu"),
new Array("Kab. Ogan Komering Ulu Selatan", "Kab. Ogan Komering Ulu Selatan"),
new Array("Kab. Ogan Komering Ulu Timur", "Kab. Ogan Komering Ulu Timur"),
new Array("Kota Lubuklinggau", "Kota Lubuklinggau"),
new Array("Kota Pagar Alam", "Kota Pagar Alam"),
new Array("Kota Palembang", "Kota Palembang"),
new Array("Kota Prabumulih", "Kota Prabumulih"),
new Array("Lain-lain", "Lain-lain")
),

// Bengkulu
new Array(
new Array("Kab. Bengkulu Selatan", "Kab. Bengkulu Selatan"),
new Array("Kab. Bengkulu Tengah", "Kab. Bengkulu Tengah"),
new Array("Kab. Bengkulu Utara", "Kab. Bengkulu Utara"),
new Array("Kab. Kaur", "Kab. Kaur"),
new Array("Kab. Kepahiang", "Kab. Kepahiang"),
new Array("Kab. Lebong", "Kab. Lebong"),
new Array("Kab. Mukomuko", "Kab. Mukomuko"),
new Array("Kab. Rejang Lebong", "Kab. Rejang Lebong"),
new Array("Kab. Seluma", "Kab. Seluma"),
new Array("Kota Bengkulu", "Kota Bengkulu"),
new Array("Lain-lain", "Lain-lain")
),

// Lampung
new Array(
new Array("Kab. Lampung Barat", "Kab. Lampung Barat"),
new Array("Kab. Lampung Selatan", "Kab. Lampung Selatan"),
new Array("Kab. Lampung Tengah", "Kab. Lampung Tengah"),
new Array("Kab. Lampung Timur", "Kab. Lampung Timur"),
new Array("Kab. Lampung Utara", "Kab. Lampung Utara"),
new Array("Kab. Mesuji", "Kab. Mesuji"),
new Array("Kab. Pesawaran", "Kab. Pesawaran"),
new Array("Kab. Pringsewu", "Kab. Pringsewu"),
new Array("Kab. Tanggamus", "Kab. Tanggamus"),
new Array("Kab. Tulang Bawang", "Kab. Tulang Bawang"),
new Array("Kab. Tulang Bawang Barat", "Kab. Tulang Bawang Barat"),
new Array("Kab. Way Kanan", "Kab. Way Kanan"),
new Array("Kota Bandar Lampung", "Kota Bandar Lampung"),
new Array("Kota Metro", "Kota Metro"),
new Array("Lain-lain", "Lain-lain")
),

// Bangka Belitung
new Array(
new Array("Kab. Bangka", "Kab. Bangka"),
new Array("Kab. Bangka Barat", "Kab. Bangka Barat"),
new Array("Kab. Bangka Selatan", "Kab. Bangka Selatan"),
new Array("Kab. Bangka Tengah", "Kab. Bangka Tengah"),
new Array("Kab. Belitung", "Kab. Belitung"),
new Array("Kab. Belitung Timur", "Kab. Belitung Timur"),
new Array("Kota Pangkal Pinang", "Kota Pangkal Pinang"),
new Array("Lain-lain", "Lain-lain")
),

// Kepulauan Riau
new Array(
new Array("Kab. Bintan", "Kab. Bintan"),
new Array("Kab. Karimun", "Kab. Karimun"),
new Array("Kab. Kepulauan Anambas", "Kab. Kepulauan Anambas"),
new Array("Kab. Lingga", "Kab. Lingga"),
new Array("Kab. Natuna", "Kab. Natuna"),
new Array("Kota Batam", "Kota Batam"),
new Array("Kota Tanjung Pinang", "Kota Tanjung Pinang"),
new Array("Lain-lain", "Lain-lain")
),

// DKI Jakarta
new Array(
new Array("Kab. Adm. Kepulauan Seribu", "Kab. Adm. Kepulauan Seribu"),
new Array("Kota Jakarta Barat", "Kota Jakarta Barat"),
new Array("Kota Jakarta Pusat", "Kota Jakarta Pusat"),
new Array("Kota Jakarta Selatan", "Kota Jakarta Selatan"),
new Array("Kota Jakarta Timur", "Kota Jakarta Timur"),
new Array("Kota Jakarta Utara", "Kota Jakarta Utara")
),

// Jawa Barat
new Array(
new Array("Kab. Bandung", "Kab. Bandung"),
new Array("Kab. Bandung Barat", "Kab. Bandung Barat"),
new Array("Kab. Bekasi", "Kab. Bekasi"),
new Array("Kab. Bogor", "Kab. Bogor"),
new Array("Kab. Ciamis", "Kab. Ciamis"),
new Array("Kab. Cianjur", "Kab. Cianjur"),
new Array("Kab. Cirebon", "Kab. Cirebon"),
new Array("Kab. Garut", "Kab. Garut"),
new Array("Kab. Indramayu", "Kab. Indramayu"),
new Array("Kab. Karawang", "Kab. Karawang"),
new Array("Kab. Kuningan", "Kab. Kuningan"),
new Array("Kab. Majalengka", "Kab. Majalengka"),
new Array("Kab. Purwakarta", "Kab. Purwakarta"),
new Array("Kab. Subang", "Kab. Subang"),
new Array("Kab. Sukabumi", "Kab. Sukabumi"),
new Array("Kab. Sumedang", "Kab. Sumedang"),
new Array("Kab. Tasikmalaya", "Kab. Tasikmalaya"),
new Array("Kota Bandung", "Kota Bandung"),
new Array("Kota Banjar", "Kota Banjar"),
new Array("Kota Bekasi", "Kota Bekasi"),
new Array("Kota Bogor", "Kota Bogor"),
new Array("Kota Cimahi", "Kota Cimahi"),
new Array("Kota Cirebon", "Kota Cirebon"),
new Array("Kota Depok", "Kota Depok"),
new Array("Kota Sukabumi", "Kota Sukabumi"),
new Array("Kota Tasikmalaya", "Kota Tasikmalaya"),
new Array("Lain-lain", "Lain-lain")
),

// Jawa Tengah
new Array(
new Array("Kab. Banjarnegara", "Kab. Banjarnegara"),
new Array("Kab. Banyumas", "Kab. Banyumas"),
new Array("Kab. Batang", "Kab. Batang"),
new Array("Kab. Blora", "Kab. Blora"),
new Array("Kab. Boyolali", "Kab. Boyolali"),
new Array("Kab. Brebes", "Kab. Brebes"),
new Array("Kab. Cilacap", "Kab. Cilacap"),
new Array("Kab. Demak", "Kab. Demak"),
new Array("Kab. Grobogan", "Kab. Grobogan"),
new Array("Kab. Jepara", "Kab. Jepara"),
new Array("Kab. Karanganyar", "Kab. Karanganyar"),
new Array("Kab. Kebumen", "Kab. Kebumen"),
new Array("Kab. Kendal", "Kab. Kendal"),
new Array("Kab. Klaten", "Kab. Klaten"),
new Array("Kab. Kudus", "Kab. Kudus"),
new Array("Kab. Magelang", "Kab. Magelang"),
new Array("Kab. Pati", "Kab. Pati"),
new Array("Kab. Pekalongan", "Kab. Pekalongan"),
new Array("Kab. Pemalang", "Kab. Pemalang"),
new Array("Kab. Purbalingga", "Kab. Purbalingga"),
new Array("Kab. Purworejo", "Kab. Purworejo"),
new Array("Kab. Rembang", "Kab. Rembang"),
new Array("Kab. Semarang", "Kab. Semarang"),
new Array("Kab. Sragen", "Kab. Sragen"),
new Array("Kab. Sukoharjo", "Kab. Sukoharjo"),
new Array("Kab. Tegal", "Kab. Tegal"),
new Array("Kab. Temanggung", "Kab. Temanggung"),
new Array("Kab. Wonogiri", "Kab. Wonogiri"),
new Array("Kab. Wonosobo", "Kab. Wonosobo"),
new Array("Kota Magelang", "Kota Magelang"),
new Array("Kota Pekalongan", "Kota Pekalongan"),
new Array("Kota Salatiga", "Kota Salatiga"),
new Array("Kota Semarang", "Kota Semarang"),
new Array("Kota Surakarta / Solo", "Kota Surakarta / Solo"),
new Array("Kota Tegal", "Kota Tegal"),
new Array("Lain-lain", "Lain-lain")
),

// DI Yogyakarta
new Array(
new Array("Kab. Bantul", "Kab. Bantul"),
new Array("Kab. Gunung Kidul", "Kab. Gunung Kidul"),
new Array("Kab. Kulon Progo", "Kab. Kulon Progo"),
new Array("Kab. Sleman", "Kab. Sleman"),
new Array("Kota Yogyakarta", "Kota Yogyakarta"),
new Array("Lain-lain", "Lain-lain")
),

// Jawa Timur
new Array(
new Array("Kab. Bangkalan", "Kab. Bangkalan"),
new Array("Kab. Banyuwangi", "Kab. Banyuwangi"),
new Array("Kab. Blitar", "Kab. Blitar"),
new Array("Kab. Bojonegoro", "Kab. Bojonegoro"),
new Array("Kab. Bondowoso", "Kab. Bondowoso"),
new Array("Kab. Gresik", "Kab. Gresik"),
new Array("Kab. Jember", "Kab. Jember"),
new Array("Kab. Jombang", "Kab. Jombang"),
new Array("Kab. Kediri", "Kab. Kediri"),
new Array("Kab. Lamongan", "Kab. Lamongan"),
new Array("Kab. Lumajang", "Kab. Lumajang"),
new Array("Kab. Madiun", "Kab. Madiun"),
new Array("Kab. Magetan", "Kab. Magetan"),
new Array("Kab. Malang", "Kab. Malang"),
new Array("Kab. Mojokerto", "Kab. Mojokerto"),
new Array("Kab. Nganjuk", "Kab. Nganjuk"),
new Array("Kab. Ngawi", "Kab. Ngawi"),
new Array("Kab. Pacitan", "Kab. Pacitan"),
new Array("Kab. Pamekasan", "Kab. Pamekasan"),
new Array("Kab. Pasuruan", "Kab. Pasuruan"),
new Array("Kab. Ponorogo", "Kab. Ponorogo"),
new Array("Kab. Probolinggo", "Kab. Probolinggo"),
new Array("Kab. Sampang", "Kab. Sampang"),
new Array("Kab. Sidoarjo", "Kab. Sidoarjo"),
new Array("Kab. Situbondo", "Kab. Situbondo"),
new Array("Kab. Sumenep", "Kab. Sumenep"),
new Array("Kab. Trenggalek", "Kab. Trenggalek"),
new Array("Kab. Tuban", "Kab. Tuban"),
new Array("Kab. Tulungagung", "Kab. Tulungagung"),
new Array("Kota Batu", "Kota Batu"),
new Array("Kota Blitar", "Kota Blitar"),
new Array("Kota Kediri", "Kota Kediri"),
new Array("Kota Madiun", "Kota Madiun"),
new Array("Kota Malang", "Kota Malang"),
new Array("Kota Mojokerto", "Kota Mojokerto"),
new Array("Kota Pasuruan", "Kota Pasuruan"),
new Array("Kota Probolinggo", "Kota Probolinggo"),
new Array("Kota Surabaya", "Kota Surabaya"),
new Array("Lain-lain", "Lain-lain")
),

// Banten
new Array(
new Array("Kab. Lebak", "Kab. Lebak"),
new Array("Kab. Pandeglang", "Kab. Pandeglang"),
new Array("Kab. Serang", "Kab. Serang"),
new Array("Kab. Tangerang", "Kab. Tangerang"),
new Array("Kota Cilegon", "Kota Cilegon"),
new Array("Kata Serang", "Kata Serang"),
new Array("Kota Tangerang", "Kota Tangerang"),
new Array("Kota Tangerang Selatan", "Kota Tangerang Selatan"),
new Array("Lain-lain", "Lain-lain")
),

// Bali
new Array(
new Array("Kab. Badung", "Kab. Badung"),
new Array("Kab. Bangli", "Kab. Bangli"),
new Array("Kab. Buleleng", "Kab. Buleleng"),
new Array("Kab. Gianyar", "Kab. Gianyar"),
new Array("Kab. Jembrana", "Kab. Jembrana"),
new Array("Kab. Karangasem", "Kab. Karangasem"),
new Array("Kab. Klungkung", "Kab. Klungkung"),
new Array("Kab. Tabanan", "Kab. Tabanan"),
new Array("Kota Denpasar", "Kota Denpasar"),
new Array("Lain-lain", "Lain-lain")
),

// NTB
new Array(
new Array("Kab. Bima", "Kab. Bima"),
new Array("Kab. Dompu", "Kab. Dompu"),
new Array("Kab. Lombok Barat", "Kab. Lombok Barat"),
new Array("Kab. Lombok Tengah", "Kab. Lombok Tengah"),
new Array("Kab. Lombok Timur", "Kab. Lombok Timur"),
new Array("Kab. Lombok Utara", "Kab. Lombok Utara"),
new Array("Kab. Sumbawa", "Kab. Sumbawa"),
new Array("Kab. Sumbawa Barat", "Kab. Sumbawa Barat"),
new Array("Kota Bima", "Kota Bima"),
new Array("Kota Mataram", "Kota Mataram"),
new Array("Lain-lain", 999)
),

// NTT
new Array(
new Array("Kab. Alor", "Kab. Alor"),
new Array("Kab. Belu", "Kab. Belu"),
new Array("Kab. Ende", "Kab. Ende"),
new Array("Kab. Flores Timur", "Kab. Flores Timur"),
new Array("Kab. Kupang", "Kab. Kupang"),
new Array("Kab. Lembata", "Kab. Lembata"),
new Array("Kab. Manggarai", "Kab. Manggarai"),
new Array("Kab. Manggarai Barat", "Kab. Manggarai Barat"),
new Array("Kab. Manggarai Timur", "Kab. Manggarai Timur"),
new Array("Kab. Nagekeo", "Kab. Nagekeo"),
new Array("Kab. Ngada", "Kab. Ngada"),
new Array("Kab. Rote Ndao", "Kab. Rote Ndao"),
new Array("Kab. Sabu Raijua", "Kab. Sabu Raijua"),
new Array("Kab. Sikka", "Kab. Sikka"),
new Array("Kab. Sumba Barat", "Kab. Sumba Barat"),
new Array("Kab. Sumba Barat Daya", "Kab. Sumba Barat Daya"),
new Array("Kab. Sumba Tengah", "Kab. Sumba Tengah"),
new Array("Kab. Sumba Timur", "Kab. Sumba Timur"),
new Array("Kab. Timor Tengah Selatan", "Kab. Timor Tengah Selatan"),
new Array("Kab. Timor Tengah Utara", "Kab. Timor Tengah Utara"),
new Array("Kota Kupang", "Kota Kupang"),
new Array("Lain-lain", "Lain-lain")
),

// Kalimantan Barat
new Array(
new Array("Kab. Bengkayang", "Kab. Bengkayang"),
new Array("Kab. Kapuas Hulu", "Kab. Kapuas Hulu"),
new Array("Kab. Kayong Utara", "Kab. Kayong Utara"),
new Array("Kab. Ketapang", "Kab. Ketapang"),
new Array("Kab. Kubu Raya", "Kab. Kubu Raya"),
new Array("Kab. Landak", "Kab. Landak"),
new Array("Kab. Melawi", "Kab. Melawi"),
new Array("Kab. Pontianak", "Kab. Pontianak"),
new Array("Kab. Sambas", "Kab. Sambas"),
new Array("Kab. Sanggau", "Kab. Sanggau"),
new Array("Kab. Sekadau", "Kab. Sekadau"),
new Array("Kab. Sintang", "Kab. Sintang"),
new Array("Kota Pontianak", "Kota Pontianak"),
new Array("Kota Singkawang", "Kota Singkawang"),
new Array("Lain-lain", "Lain-lain")
),

// Kalimantan Tengah
new Array(
new Array("Kab. Barito Selatan", "Kab. Barito Selatan"),
new Array("Kab. Barito Timur", "Kab. Barito Timur"),
new Array("Kab. Barito Utara", "Kab. Barito Utara"),
new Array("Kab. Gunung Mas", "Kab. Gunung Mas"),
new Array("Kab. Kapuas", "Kab. Kapuas"),
new Array("Kab. Katingan", "Kab. Katingan"),
new Array("Kab. Kotawaringin Barat", "Kab. Kotawaringin Barat"),
new Array("Kab. Kotawaringin Timur", "Kab. Kotawaringin Timur"),
new Array("Kab. Lamandau", "Kab. Lamandau"),
new Array("Kab. Murung Raya", "Kab. Murung Raya"),
new Array("Kab. Pulau Pisang", "Kab. Pulau Pisang"),
new Array("Kab. Sukamara", "Kab. Sukamara"),
new Array("Kab. Seruyan", "Kab. Seruyan"),
new Array("Kota Palangka Raya", "Kota Palangka Raya"),
new Array("Lain-lain", "Lain-lain")
),

// Kalimantan Selatan
new Array(
new Array("Kab. Balangan", "Kab. Balangan"),
new Array("Kab. Banjar", "Kab. Banjar"),
new Array("Kab. Barito Kuala", "Kab. Barito Kuala"),
new Array("Kab. Hulu Sungai Selatan", "Kab. Hulu Sungai Selatan"),
new Array("Kab. Hulu Sungai Tengah", "Kab. Hulu Sungai Tengah"),
new Array("Kab. Hulu Sungai Utara", "Kab. Hulu Sungai Utara"),
new Array("Kab. Kotabaru", "Kab. Kotabaru"),
new Array("Kab. Tabalong", "Kab. Tabalong"),
new Array("Kab. Tanah Bumbu", "Kab. Tanah Bumbu"),
new Array("Kab. Tanah Laut", "Kab. Tanah Laut"),
new Array("Kab. Tapin", "Kab. Tapin"),
new Array("Kota Banjarbaru", "Kota Banjarbaru"),
new Array("Kota Banjarmasin", "Kota Banjarmasin"),
new Array("Lain-lain", "Lain-lain")
),

// Kalimantan Timur
new Array(
new Array("Kab. Berau", "Kab. Berau"),
new Array("Kab. Bulungan", "Kab. Bulungan"),
new Array("Kab. Kutai Barat", "Kab. Kutai Barat"),
new Array("Kab. Kutai Kartanegara", "Kab. Kutai Kartanegara"),
new Array("Kab. Kutai Timur", "Kab. Kutai Timur"),
new Array("Kab. Malinau", "Kab. Malinau"),
new Array("Kab. Nunukan", "Kab. Nunukan"),
new Array("Kab. Paser", "Kab. Paser"),
new Array("Kab. Penajam Paser Utara", "Kab. Penajam Paser Utara"),
new Array("Kab. Tana Tidung", "Kab. Tana Tidung"),
new Array("Kota Balikpapan", "Kota Balikpapan"),
new Array("Kota Bontang", "Kota Bontang"),
new Array("Kota Samarinda", "Kota Samarinda"),
new Array("Kota Tarakan", "Kota Tarakan"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Utara
new Array(
new Array("Kab. Bolaang Mongondow", "Kab. Bolaang Mongondow"),
new Array("Kab. Bolaang Mongondow Selatan", "Kab. Bolaang Mongondow Selatan"),
new Array("Kab. Bolaang Mongondow Timur", "Kab. Bolaang Mongondow Timur"),
new Array("Kab. Bolaang Mongondow Utara", "Kab. Bolaang Mongondow Utara"),
new Array("Kab. Kepulauan Sangihe", "Kab. Kepulauan Sangihe"),
new Array("Kab. Kepulauan Siau Tagalandang Biaro", "Kab. Kepulauan Siau Tagalandang Biaro"),
new Array("Kab. Kepulauan Talaud", "Kab. Kepulauan Talaud"),
new Array("Kab. Minahasa", "Kab. Minahasa"),
new Array("Kab. Minahasa Selatan", "Kab. Minahasa Selatan"),
new Array("Kab. Minahasa Tenggara", "Kab. Minahasa Tenggara"),
new Array("Kab. Minahasa Utara", "Kab. Minahasa Utara"),
new Array("Kota Bitung", "Kota Bitung"),
new Array("Kota Kotamobagu", "Kota Kotamobagu"),
new Array("Kota Manado", "Kota Manado"),
new Array("Kota Tomohon", "Kota Tomohon"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Tengah
new Array(
new Array("Kab. Banggai", "Kab. Banggai"),
new Array("Kab. Banggai Kepulauan", "Kab. Banggai Kepulauan"),
new Array("Kab. Buol", "Kab. Buol"),
new Array("Kab. Donggala", "Kab. Donggala"),
new Array("Kab. Morowali", "Kab. Morowali"),
new Array("Kab. Parigi Moutong", "Kab. Parigi Moutong"),
new Array("Kab. Poso", "Kab. Poso"),
new Array("Kab. Tojo Una-Una", "Kab. Tojo Una-Una"),
new Array("Kab. Toli-Toli", "Kab. Toli-Toli"),
new Array("Kab. Sigi", "Kab. Sigi"),
new Array("Kota Palu", "Kota Palu"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Selatan
new Array(
new Array("Kab. Bantaeng", "Kab. Bantaeng"),
new Array("Kab. Barru", "Kab. Barru"),
new Array("Kab. Bone", "Kab. Bone"),
new Array("Kab. Bulukumba", "Kab. Bulukumba"),
new Array("Kab. Enrekang", "Kab. Enrekang"),
new Array("Kab. Gowa", "Kab. Gowa"),
new Array("Kab. Jeneponto", "Kab. Jeneponto"),
new Array("Kab. Kepulauan Selayar", "Kab. Kepulauan Selayar"),
new Array("Kab. Luwu", "Kab. Luwu"),
new Array("Kab. Luwu Timur", "Kab. Luwu Timur"),
new Array("Kab. Luwu Utara", "Kab. Luwu Utara"),
new Array("Kab. Maros", "Kab. Maros"),
new Array("Kab. Pangkajene & Kepulauan", "Kab. Pangkajene & Kepulauan"),
new Array("Kab. Pinrang", "Kab. Pinrang"),
new Array("Kab. Sidenreng Rappang", "Kab. Sidenreng Rappang"),
new Array("Kab. Sinjai", "Kab. Sinjai"),
new Array("Kab. Soppeng", "Kab. Soppeng"),
new Array("Kab. Takalar", "Kab. Takalar"),
new Array("Kab. Tana Toraja", "Kab. Tana Toraja"),
new Array("Kab. Toraja Utara", "Kab. Toraja Utara"),
new Array("Kab. Wajo", "Kab. Wajo"),
new Array("Kota Makassar", "Kota Makassar"),
new Array("Kota Palopo", "Kota Palopo"),
new Array("Kota Pare-Pare", "Kota Pare-Pare"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Tenggara
new Array(
new Array("Kab. Bombana", "Kab. Bombana"),
new Array("Kab. Buton", "Kab. Buton"),
new Array("Kab. Buton Utara", "Kab. Buton Utara"),
new Array("Kab. Kolaka", "Kab. Kolaka"),
new Array("Kab. Kolaka Utara", "Kab. Kolaka Utara"),
new Array("Kab. Konawe", "Kab. Konawe"),
new Array("Kab. Konawe Selatan", "Kab. Konawe Selatan"),
new Array("Kab. Konawe Utara", "Kab. Konawe Utara"),
new Array("Kab. Muna", "Kab. Muna"),
new Array("Kab. Wakatobi", "Kab. Wakatobi"),
new Array("Kota Bau-Bau", "Kota Bau-Bau"),
new Array("Kota Kendari", "Kota Kendari"),
new Array("Lain-lain", "Lain-lain")
),

// Sulawesi Barat
new Array(
new Array("Kab. Majene", "Kab. Majene"),
new Array("Kab. Mamasa", "Kab. Mamasa"),
new Array("Kab. Mamuju", "Kab. Mamuju"),
new Array("Kab. Mamuju Utara", "Kab. Mamuju Utara"),
new Array("Kab. Polewali Mandar", "Kab. Polewali Mandar"),
new Array("Lain-lain", "Lain-lain")
),

// Gorontalo
new Array(
new Array("Kab. Boalemo", "Kab. Boalemo"),
new Array("Kab. Bone Bolango", "Kab. Bone Bolango"),
new Array("Kab. Gorontalo", "Kab. Gorontalo"),
new Array("Kab. Gorontalo Utara", "Kab. Gorontalo Utara"),
new Array("Kab. Pohuwato", "Kab. Pohuwato"),
new Array("Kota Gorontalo", "Kota Gorontalo"),
new Array("Lain-lain", "Lain-lain")
),

// Maluku
new Array(
new Array("Kab. Buru", "Kab. Buru"),
new Array("Kab. Buru Selatan", "Kab. Buru Selatan"),
new Array("Kab. Kepulauan Aru", "Kab. Kepulauan Aru"),
new Array("Kab. Maluku Barat Daya", "Kab. Maluku Barat Daya"),
new Array("Kab. Maluku Tengah", "Kab. Maluku Tengah"),
new Array("Kab. Maluku Tenggara", "Kab. Maluku Tenggara"),
new Array("Kab. Maluku Tenggara Barat", "Kab. Maluku Tenggara Barat"),
new Array("Kab. Seram Bagian Barat", "Kab. Seram Bagian Barat"),
new Array("Kab. Seram Bagian Timur", "Kab. Seram Bagian Timur"),
new Array("Kota Ambon", "Kota Ambon"),
new Array("Kota Tual", "Kota Tual"),
new Array("Lain-lain", "Lain-lain")
),

// Maluku Utara
new Array(
new Array("Kab. Halmahera Barat", "Kab. Halmahera Barat"),
new Array("Kab. Halmahera Selatan", "Kab. Halmahera Selatan"),
new Array("Kab. Halmahera Tengah", "Kab. Halmahera Tengah"),
new Array("Kab. Halmahera Timur", "Kab. Halmahera Timur"),
new Array("Kab. Halmahera Utara", "Kab. Halmahera Utara"),
new Array("Kab. Kepulauan Sula", "Kab. Kepulauan Sula"),
new Array("Kab. Pulau Marotai", "Kab. Pulau Marotai"),
new Array("Kota Ternate", "Kota Ternate"),
new Array("Kota Tidore Kepulauan", "Kota Tidore Kepulauan"),
new Array("Lain-lain", "Lain-lain")
),

// Papua Barat
new Array(
new Array("Kab. Fakfak", "Kab. Fakfak"),
new Array("Kab. Kaimana", "Kab. Kaimana"),
new Array("Kab. Manokwari", "Kab. Manokwari"),
new Array("Kab. Raja Ampat", "Kab. Raja Ampat"),
new Array("Kob. Sorong", "Kab. Sorong"),
new Array("Kab. Tambrauw", "Kab. Tambrauw"),
new Array("Kab. Teluk Bintuni", "Kab. Teluk Bintuni"),
new Array("Kab. Teluk Wondama", "Kab. Teluk Wondama"),
new Array("Kota Sorong", "Kota Sorong"),
new Array("Lain-lain", "Lain-lain")
),

// Papua
new Array(
new Array("Kab. Asmat", "Kab. Asmat"),
new Array("Kab. Biak Numfor", "Kab. Biak Numfor"),
new Array("Kab. Boven Digoel", "Kab. Boven Digoel"),
new Array("Kab. Deiyai", "Kab. Deiyai"),
new Array("Kab. Dogiyai", "Kab. Dogiyai"),
new Array("Kab. Intan Jaya", "Kab. Intan Jaya"),
new Array("Kab. Jayapura", "Kab. Jayapura"),
new Array("Kab. Jayawijaya", "Kab. Jayawijaya"),
new Array("Kab. Keerom", "Kab. Keerom"),
new Array("Kab. Kepulauan Yapen", "Kab. Kepulauan Yapen"),
new Array("Kab. Lanny Jaya", "Kab. Lanny Jaya"),
new Array("Kab. Mamberamo Raya", "Kab. Mamberamo Raya"),
new Array("Kab. Mamberamo Tengah", "Kab. Mamberamo Tengah"),
new Array("Kab. Mappi", "Kab. Mappi"),
new Array("Kab. Merauke", "Kab. Merauke"),
new Array("Kab. Mimika", "Kab. Mimika"),
new Array("Kab. Nabire", "Kab. Nabire"),
new Array("Kab. Nduga", "Kab. Nduga"),
new Array("Kab. Paniai", "Kab. Paniai"),
new Array("Kab. Pegunungan Bintang", "Kab. Pegunungan Bintang"),
new Array("Kab. Puncak", "Kab. Puncak"),
new Array("Kab. Puncak Jaya", "Kab. Puncak Jaya"),
new Array("Kab. Sarmi", "Kab. Sarmi"),
new Array("Kab. Supiori", "Kab. Supiori"),
new Array("Kab. Tolikara", "Kab. Tolikara"),
new Array("Kab. Waropen", "Kab. Waropen"),
new Array("Kab. Yahukimo", "Kab. Yahukimo"),
new Array("Kab. Yalimo", "Kab. Yalimo"),
new Array("Kota Jayapura", "Kota Jayapura"),
new Array("Lain-lain", "Lain-lain")
),

// Luar Negri
new Array(
new Array("Malaysia", "Malaysia"),
new Array("Singapore", "Singapore"),
new Array("Others", "Others")
)
);

function fillSelectFromArray(selectCtrl, itemArray, goodPrompt, badPrompt, defaultItem) {
var i, j;
var prompt;
for (i = selectCtrl.options.length; i >= 0; i--) {
selectCtrl.options[i] = null;
}
prompt = (itemArray != null) ? goodPrompt : badPrompt;
if (prompt == null) {
j = 0;
}
else {
selectCtrl.options[0] = new Option(prompt);
j = 1;
}
if (itemArray != null) {
for (i = 0; i < itemArray.length; i++) {
selectCtrl.options[j] = new Option(itemArray[i][0]);
if (itemArray[i][1] != null) {
selectCtrl.options[j].value = itemArray[i][1];
}
j++;
}
selectCtrl.options[0].selected = true;
   }
}

</script>
	                <select name="n_propinsi" onChange="fillSelectFromArray(this.form.n_kabupaten, ((this.selectedIndex == -1) ? null :
	kabupaten[this.selectedIndex-1]));" class="validate-selection">
	                  <option selected="selected" value="">-- Pilih Propinsi --</option>
	                  <option value="Nanggroe Aceh Darussalam">Nanggroe Aceh Darussalam</option>
	                  <option value="Sumatera Utara">Sumatera Utara</option>
	                  <option value="Sumatera Barat">Sumatera Barat</option>
	                  <option value="Riau">Riau</option>
	                  <option value="Jambi">Jambi</option>
	                  <option value="Sumatera Selatan">Sumatera Selatan</option>
	                  <option value="Bengkulu">Bengkulu</option>
	                  <option value="Lampung">Lampung</option>
	                  <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
	                  <option value="Kepulauan Riau">Kepulauan Riau</option>
	                  <option value="DKI Jakarta">DKI Jakarta</option>
	                  <option value="Jawa Barat">Jawa Barat</option>
	                  <option value="Jawa Tengah">Jawa Tengah</option>
	                  <option value="DI Yogyakarta">DI Yogyakarta</option>
	                  <option value="Jawa Timur">Jawa Timur</option>
	                  <option value="Banten">Banten</option>
	                  <option value="Bali">Bali</option>
	                  <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
	                  <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
	                  <option value="Kalimantan Barat">Kalimantan Barat</option>
	                  <option value="Kalimantan Tengah">Kalimantan Tengah</option>
	                  <option value="Kalimantan Selatan">Kalimantan Selatan</option>
	                  <option value="Kalimantan Timur">Kalimantan Timur</option>
	                  <option value="Sulawesi Utara">Sulawesi Utara</option>
	                  <option value="Sulawesi Tengah">Sulawesi Tengah</option>
	                  <option value="Sulawesi Selatan">Sulawesi Selatan</option>
	                  <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
	                  <option value="Sulawesi Barat">Sulawesi Barat</option>
	                  <option value="Gorontalo">Gorontalo</option>
	                  <option value="Maluku">Maluku</option>
	                  <option value="Maluku Utara">Maluku Utara</option>
	                  <option value="Papua Barat">Papua Barat</option>
	                  <option value="Papua">Papua</option>
	                  <option value="Others (outside Indonesia)">Others Countries (outside Indonesia)</option>
                    </select>
                          <select name="n_kabupaten">
                            <option selected="selected"> </option>
                    </select> </td>
        </tr>
      <td width="221" bgcolor="#dddddd">
            Kode Pos *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="c_pos" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['kdpos']; ?>" size="5" maxlength="5" >	  </td>
        </tr>

        <tr>
                        <td width="221" bgcolor="#dddddd"> Nomor Telepon * </td>
	                    <td bgcolor="#eeeeee"> <input name="i_telp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['telp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd">
            Nomor Handphone/Selular *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="i_hp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['hp']; ?>" size="15" maxlength="20"></td>
        </tr>

        <tr>
                        <td width="221" bgcolor="#dddddd"> Email * </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_email" type="TEXT" class="required validate-email" value="<?php echo $_SESSION['email']; ?>" size="25" maxlength="40"></td>
        </tr>



        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- DATA ORANGTUA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Orang Tua Peserta</b><br>
            Isilah data orang tua Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Nama Orang Tua *	  </td>
	                    <td bgcolor="#eeeeee">
                        <input name="n_ortu" type="TEXT" class="required" value="<?php echo $_SESSION['nm_ortu']; ?>" size="40" maxlength="60">	  </td>
        </tr>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Jenis Pekerjaan<br>
                          Orang Tua * </td>
	                    <td bgcolor="#eeeeee">
<!--                         <input name="n_jabatan" size="30" maxlength="80" type="TEXT" class="required">
 -->						<select name="n_jabatan" size="1" id="n_jabatan">
						<option selected="selected" value="">-- Pilih Pekerjaan Orang Tua --</option>
						<option value="TNI_POLRI">TNI/POLRI</option>
						<option value="PNS">PNS</option>
						<option value="Swasta">Swasta</option>
						<option value="BUMN">BUMN</option>
						<option value="Pesiunan">Pensiunan</option>
                        </select>  </td>
        </tr>


        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- DATA SMA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Perguruan Tinggi</b><br>
            Isilah data Perguruan Tinggi asal Saudara/i dengan lengkap dan benar.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="197" bgcolor="#dddddd">
            Nama Perguruan Tinggi Asal *	  </td>
                        <td width="329" bgcolor="#eeeeee">
          <input name="n_sma" type="TEXT" class="required" value="<?php echo $_SESSION['asalpt']; ?>" size="30" maxlength="60">	  </td>
        </tr>
        <tr>
          <?php
  $sql_eks="select * from t_jurusanpt";
  $query_eks=mysql_query($sql_eks,$koneksi);
  ?>
          <td width="197" bgcolor="#dddddd">
            Jurusan Perguruan Tinggi Asal *  </td>
                        <td bgcolor="#eeeeee">
                          <select name="i_jur_pt" size="1" id="jrsnpt" class="validate-selection">
						    <option selected="selected" value="">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_eks=mysql_fetch_array($query_eks))
   {;?>
                            <option value ="<?php echo $row_eks['kd_jurusanpt'];?>"><?php echo $row_eks['nama_jurusanpt'];?></option>
                            <?php }?>
                        </select>	  </td>
        </tr>
		<tr>
          <td width="197" bgcolor="#dddddd">
            IPK *	  </td>
                        <td bgcolor="#eeeeee">
                        <input name="ipk" type="TEXT" class="required" value="<?php echo $_SESSION['ipk']; ?>" size="30" maxlength="60">	  </td>
        </tr>
		<tr>
          <td width="197" bgcolor="#dddddd">
            Tahun Lulus *	  </td>
                        <td bgcolor="#eeeeee">
                        <input name="thn_lulus" type="TEXT" class="required" value="<?php echo $_SESSION['thn_lulus']; ?>" size="30" maxlength="60">	  </td>
        </tr>
           <tr>
             <td width="197" bgcolor="#dddddd">
               Alamat Perguruan Tinggi Asal *	  </td>
                        <td bgcolor="#eeeeee">
                        <textarea name="n_alamat_pt" rows="2" cols="30" class="required"><?php echo $_SESSION['alamatpt']; ?></textarea>	  </td>
        </tr>



           <tr>
             <td width="197" bgcolor="#dddddd">
               Propinsi<br>
             Kabupaten / Kota *	  </td>
                        <td bgcolor="#eeeeee"><select name="n_prop_pt" onChange="fillSelectFromArray(this.form.n_kab_pt, ((this.selectedIndex == -1) ? null :
	kabupaten[this.selectedIndex-1]));" class="validate-selection">
                          <option selected="selected" value="">-- Pilih Propinsi
                          --</option>
                          <option value="Nanggroe Aceh Darussalam">Nanggroe Aceh
                          Darussalam</option>
                          <option value="Sumatera Utara">Sumatera Utara</option>
                          <option value="Sumatera Barat">Sumatera Barat</option>
                          <option value="Riau">Riau</option>
                          <option value="Jambi">Jambi</option>
                          <option value="Sumatera Selatan">Sumatera Selatan</option>
                          <option value="Bengkulu">Bengkulu</option>
                          <option value="Lampung">Lampung</option>
                          <option value="Kepulauan Bangka Belitung">Kepulauan
                          Bangka Belitung</option>
                          <option value="Kepulauan Riau">Kepulauan Riau</option>
                          <option value="DKI Jakarta">DKI Jakarta</option>
                          <option value="Jawa Barat">Jawa Barat</option>
                          <option value="Jawa Tengah">Jawa Tengah</option>
                          <option value="DI Yogyakarta">DI Yogyakarta</option>
                          <option value="Jawa Timur">Jawa Timur</option>
                          <option value="Banten">Banten</option>
                          <option value="Bali">Bali</option>
                          <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                          <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                          <option value="Kalimantan Barat">Kalimantan Barat</option>
                          <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                          <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                          <option value="Kalimantan Timur">Kalimantan Timur</option>
                          <option value="Sulawesi Utara">Sulawesi Utara</option>
                          <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                          <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                          <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                          <option value="Sulawesi Barat">Sulawesi Barat</option>
                          <option value="Gorontalo">Gorontalo</option>
                          <option value="Maluku">Maluku</option>
                          <option value="Maluku Utara">Maluku Utara</option>
                          <option value="Papua Barat">Papua Barat</option>
                          <option value="Papua">Papua</option>
                          <option value="Others (outside Indonesia)">Others Countries
                          (outside Indonesia)</option>
                        </select>

                          <select name="n_kab_pt">
                            <option selected="selected">             </option>
                        </select></td>
        </tr>
		<tr>
          <td width="197" bgcolor="#dddddd">
            Upload Ijazah *	  </td>
                        <td bgcolor="#eeeeee">
                        <input name="ijazah" size="40" maxlength="60" type="file" class="required"></td>
        </tr>
		<tr>
          <td width="197" bgcolor="#dddddd">
            Upload Transkip Nilai *	  </td>
                        <td bgcolor="#eeeeee">
                        <input name="transkip" size="40" maxlength="60" type="file" class="required">  </td>
        </tr>
           <tr>
             <td colspan="2" height="4"></td>
        </tr>

           <!-- PILIHAN PRODI -->
           <tr>
             <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Pilihan Program Studi</b><br>
            Pilihlah program studi yang Saudara/i minati. Jumlah pilihan boleh
            satu, dua atau tiga program studi yang ada di<font size="2" face="ARIAL"> Politeknik
              Pos Indonesia</font>.	  </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
<script language="JavaScript1.2">
function validate_pil(data) {
		var n_pil1=data.n_pil1;
		var n_pil2=data.n_pil2;
		var n_pil3=data.n_pil3;
		if (n_pil1.value==n_pil2.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 2");
		   n_pil2.value=0;   }
		   }
		if (n_pil1.value==n_pil3.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
		if (n_pil2.value==n_pil3.value) {
		   if (n_pil2.value!=0) {
		   alert ("Pilihan 2 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
}
</script>
           <tr>
<?php
function combo($var, $data) {
	echo "<select name='$var' onChange='validate_pil(this.form)'  class='validate-selection'>";
	echo "<option value=0 selected>- Pilih Jurusan -</option>";
	$sql=mysql_query("select * from t_jurusan where jenjang='4'");
	while ($data=mysql_fetch_array($sql)){
		echo "<option value=$data[KodeJrsn]>$data[NamaJrsn]</option>";
	}
	echo "</select>";
}
?>
             <td width="210" bgcolor="#dddddd">
               Pilihan 1 *	  </td>
                        <td bgcolor="#eeeeee"><? combo("n_pil1",$data1); ?></td>
        </tr>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Pilihan 2 *	  </td>
                        <td bgcolor="#eeeeee"><? combo("n_pil2",$data2); ?></td>
        </tr>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Pilihan 3 *	  </td>
                        <td bgcolor="#eeeeee"><? combo("n_pil3",$data3); ?></td>
        </tr>
        <tr>
          <td colspan="2" height="4"></td>
        </tr>

               <!-- LOKASI UJIAN  -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
                 <?php
				 $data=$_GET['data'];
  $sql_info="select * from t_informasi";
  $query_info=mysql_query($sql_info,$koneksi);
?>
                        <td width="210" bgcolor="#dddddd"> Tahu Infromasi Dari * </td>
                        <td bgcolor="#eeeeee">
                          <select name="c_inf" size="1" id="c_inf" class="validate-selection">
						    <option selected="selected" value="<?php echo $_SESSION[sumber];?>">-- Tidak Ada Pilihan  --</option>
                            <?php while ($row_info=mysql_fetch_array($query_info))
   {;?>
                            <option value =<?php echo $row_info[KodeInf];?>><?php echo $row_info[NamaInf];?></option>

                            <?php

							 }?>
							 	<?
						if ($row_info[NamaInf]=='LAINNYA')
							{
						echo"<input name='nama_info' type='text' id='nama_info' size='30' maxlength='60'>";					  	                         }
						else
						{
							echo"<input name='nama_info' type='hidden' id='nama_info' size='30' maxlength='60'>";
						}
						?>
                        </select>


                        </td
                      ></tr>
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- SDP2 -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Jumlah SK</b><br>
            Isilah jumlah Sumbangan Sukarela (SK) Saudara/i,
            dengan minimal sebesar Rp 100.000,- (seratus ribu rupiah)dan kelipatannya. </span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
               <tr>
                 <td width="210" bgcolor="#dddddd">
                   Sumbangan Sukarela Sebesar
                   *<br>
                   <br>	  </td>
                        <td bgcolor="#eeeeee">
                   			<div id="advice-validate-currency-dollar-field5" class="custom-advice" style="display:none">Cukup isikan besaran SDP2 dalam angka bernominal rupiah, tanpa tanda baca.</div>
							<input name="q_sdp2" class="validate-currency-dollar required validate-rupiah validate-digit" id="q_sdp2" value="<?php echo $_SESSION['sk']; ?>" maxlength="8" />
                			</div>
       <!--
	   Rp.
	   <INPUT TYPE="TEXT" NAME"sdp2j" SIZE="3" MAXLENGTH="3" onclick="validateInt()">.
	   -->	  </td>
        </tr>
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- NILAI PRESTASI LAIN -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Photo Peserta</b><br>
            Upload photo Closeup terbaru Saudara/i ( Photo Resmi ) Ukuran 3x4</span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Photo ( 3x4 ) *	  </td>
	                    <td bgcolor="#eeeeee">
                        <input name="photo" size="40" maxlength="60" type="file" class="required">	  </td>
        </tr>



        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- End Photo-->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
<script language="JavaScript1.2">
function validate_pil(data) {
		var n_pil1=data.n_pil1;
		var n_pil2=data.n_pil2;
		var n_pil3=data.n_pil3;
		if (n_pil1.value==n_pil2.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 2");
		   n_pil2.value=0;   }
		   }
		if (n_pil1.value==n_pil3.value) {
		   if (n_pil1.value!=0) {
		   alert ("Pilihan 1 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
		if (n_pil2.value==n_pil3.value) {
		   if (n_pil2.value!=0) {
		   alert ("Pilihan 2 tidak boleh sama dengan Pilihan 3");
		   n_pil3.value=0;   }
		   }
}
</script>
                  <table width="550" cellpadding="4">
                    <tbody>
                      <tr>
                        <td colspan="2" bordercolor="#FFFFFF" bgcolor="#FFFF00"><strong>Note
                          : <font color="#666666" size="2" face="ARIAL">Tanda
                          * ( Wajib Diisi Dengan Benar )</font></strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" bgcolor="#A4D87C"><span class="style1">Saya
                          menyatakan bahwa seluruh data yang saya isikan adalah
                          benar, dapat dipertanggungjawabkan dan telah melalui
                          persetujuan orang tua / wali. </span></td>
                      </tr>
                    </tbody>
                  </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C" align="center"><input name="submit" value=" Register PMB " type="SUBMIT">	  </td>
        </tr>
      </tbody>
    </table>
</font>

<!-- NOMOR REGISTRASI -->
<INPUT type="hidden" name="c_jalur" value="EKS" />
<INPUT type="hidden" name="i_thn_akademik" value="<? echo "$row_thnakademik[1]"?>" />
</form>
</td>
 </tr>
</tbody></table>


<? } }


    break;
    case "checkreg" :
 $lokasi_file    = $_FILES['photo']['tmp_name'];
  $tipe_file      = $_FILES['photo']['type'];
  $nama_file      = $_FILES['photo']['name'];
  $dir = "../foto/";
  $nama_baru = $_POST['pin'];
  if ($tipe_file =="image/png"){
  $tipe= ".png";
  } elseif ($tipe_file =="image/jpeg"){
  $tipe= ".jpg";
  } elseif ($tipe_file =="image/gif"){
  $tipe= ".gif";
  } 
  $foto_baru = $dir.$nama_baru.$tipe;
  copy($lokasi_file , $foto_baru);
    session_register('nama');
    session_register('jk');
    session_register('tmptlahir');
    session_register('tgllahir');
    session_register('alamat');
    session_register('agama');
    session_register('propinsi');
    session_register('kabupaten');
    session_register('kdpos');
    session_register('telp');
    session_register('hp');
    session_register('email');
    session_register('nm_ortu');
    session_register('jbt_ortu');
    session_register('asalsma');
    session_register('jurasal');
    session_register('alamatsma');
    session_register('propsma');
    session_register('kabsma');
    session_register('pil1');
    session_register('pil2');
    session_register('pil3');
    session_register('lokuji');
    session_register('asalinfo');
    session_register('sk');
    session_register('foto');
	session_register('akad');
    $_SESSION['nama'] = $_POST['n_lengkap'];
    $_SESSION['jk'] = $_POST['n_jns_kelamin'];
    $_SESSION['tmptlahir'] = $_POST['n_temp_lahir'];
    $_SESSION['tgllahir'] = $_POST['d_lahir'];
    $_SESSION['alamat'] = $_POST['n_alamat'];
    $_SESSION['agama'] = $_POST['i_agama'];
    $_SESSION['propinsi'] = $_POST['n_propinsi'];
    $_SESSION['kabupaten'] = $_POST['n_kabupaten'];
    $_SESSION['kdpos'] = $_POST['c_pos'];
    $_SESSION['telp'] = $_POST['i_telp'];
    $_SESSION['hp'] = $_POST['i_hp'];
    $_SESSION['email'] = $_POST['n_email'];
    $_SESSION['nm_ortu'] = $_POST['n_ortu'];
    $_SESSION['jbt_ortu'] = $_POST['n_jabatan'];
    $_SESSION['asalsma'] = $_POST['n_sma'];
    $_SESSION['jurasal'] = $_POST['i_jur_sma'];
    $_SESSION['alamatsma'] = $_POST['n_alamat_sma'];
    $_SESSION['propsma'] = $_POST['n_prop_sma'];
    $_SESSION['kabsma'] = $_POST['n_kab_sma'];
    $_SESSION['pil1'] = $_POST['n_pil1'];
    $_SESSION['pil2'] = $_POST['n_pil2'];
    $_SESSION['pil3'] = $_POST['n_pil3'];
    $_SESSION['lokuji'] = $_POST['i_temp_ujian'];
    $_SESSION['asalinfo'] = $_POST['c_inf'];
    $_SESSION['sk'] = $_POST['q_sdp2'];
     $_SESSION['foto'] = $foto_baru;
	 $_SESSION['akad'] = $_POST['i_thn_akademik'];
?>
<form method=POST enctype='multipart/form-data' action=<?php echo "$aksi?module=registrasi&act=addreguler"; ?>>
<h2>Silahkan cek kembali data Pribadi anda sebelum melakukan submit data. Pastikan semua data telah terisi dengan benar.</h2>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Pribadi Peserta</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="221" bgcolor="#dddddd">
            Nama Lengkap * 	  </td>

	              <td width="496" bgcolor="#eeeeee">
	                <input name="n_lengkap" type="TEXT" class="required" value="<?php echo $_SESSION['nama']; ?>" size="40" maxlength="80" readonly></td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd">
            Jenis Kelamin *	  </td>
          <td bgcolor="#eeeeee"><input name="n_jns_kelamin" type="text" id="n_jns_kelamin" value="<?php echo $_SESSION['jk']; ?>" readonly/></td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd">
            Tempat, Tanggal Lahir *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_temp_lahir" type="TEXT" class="required" value="<?php echo $_SESSION['tmptlahir']; ?>" size="15" maxlength="40" readonly>
	                ,

	                <input name="d_lahir" type="text" class="required" value="<?php echo $_SESSION['tmptlahir']; ?>" readonly>

					<input type="button" value="Cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">	  </td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd" valign="top">
            Alamat yang dapat Dihubungi *	  </td>
          <td bgcolor="#eeeeee">
          <textarea name="n_alamat" rows="2" cols="30" class="required" readonly><?php echo $_SESSION['alamat']; ?></textarea></td>

        </tr>
                 <tr>
          <td width="221" bgcolor="#dddddd" valign="top">
            Agama	  </td>
	              <td bgcolor="#eeeeee"><input name="i_agama" type="text" id="i_agama" value="<?php echo $_SESSION['agama']; ?>" readonly/></td>
	             </tr>

        <tr>

          <td width="221" bgcolor="#dddddd">
            Propinsi<br>
            Kabupaten / Kota *	  </td>
          <td bgcolor="#eeeeee">

	                <input name="n_propinsi" type="text" id="n_propinsi" value="<?php echo $_SESSION['propinsi']; ?>" readonly/>
	                /
	                <input name="n_kabupaten" type="text" id="n_kabupaten" value="<?php echo $_SESSION['kabupaten']; ?>" readonly/></td>
        </tr>
        <tr>

          <td width="221" bgcolor="#dddddd">
            Kode Pos *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="c_pos" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['kdpos']; ?>" size="5" maxlength="5" readonly>	  </td>
        </tr>

        <tr>
                        <td width="221" bgcolor="#dddddd"> Nomor Telepon * </td>

	                    <td bgcolor="#eeeeee"> <input name="i_telp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['telp']; ?>" size="15" maxlength="20" readonly></td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd">
            Nomor Handphone/Selular *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="i_hp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['hp']; ?>" size="15" maxlength="20" readonly></td>

        </tr>

        <tr>
                        <td width="221" bgcolor="#dddddd"> Email * </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_email" type="TEXT" class="required validate-email" value="<?php echo $_SESSION['email']; ?>" size="25" maxlength="40" readonly></td>
        </tr>


        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- DATA ORANGTUA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>

    </table>
    <table width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Orang Tua Peserta</b>.	  </span></td>
        </tr>
      </tbody>

    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Nama Orang Tua *	  </td>
	                    <td bgcolor="#eeeeee">
                        <input name="n_ortu" type="TEXT" class="required" readonly value="<?php echo $_SESSION['nm_ortu']; ?>" size="40" maxlength="60">	  </td>

        </tr>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Jenis Pekerjaan<br>
                          Orang Tua * </td>
	                    <td bgcolor="#eeeeee"><input name="n_jabatan" type="text" id="n_jabatan" readonly value="<?php echo $_SESSION['jbt_ortu']; ?>" /></td>

        </tr>


        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- DATA SMA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data SMA/MA/SMK Peserta</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Nama SMA/MA/SMK Asal *	  </td>

                        <td bgcolor="#eeeeee">
                        <input name="n_sma" type="TEXT" class="required" value="<?php echo $_SESSION['asalsma']; ?>" size="30" maxlength="60" readonly>	  </td>
        </tr>
        <tr>
                    <td width="210" bgcolor="#dddddd">
            Jurusan SMA/MA/SMK *  </td>
                        <td bgcolor="#eeeeee"><input name="i_agama5" type="text" id="i_agama5" value="<?php echo $_SESSION['jurasal']; ?>" readonly/></td>

        </tr>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Alamat SMA/MA/SMK *	  </td>
                        <td bgcolor="#eeeeee">
                        <textarea name="n_alamat_sma" rows="2" cols="30" class="required" readonly><?php echo $_SESSION['alamatsma']; ?></textarea>	  </td>
        </tr>



           <tr>
             <td width="210" bgcolor="#dddddd">
               Propinsi<br>
               Kabupaten / Kota *	  </td>
             <td bgcolor="#eeeeee"><input name="n_prop_sma" type="text" id="n_prop_sma" value="<?php echo $_SESSION['propsma']; ?>" readonly/>
               /
                        <input name="n_kab_sma" type="text" id="n_kab_sma" value="<?php echo $_SESSION['kabsma']; ?>" readonly/></td>
           </tr>
           <tr>
             <td colspan="2" height="4"></td>
        </tr>

           <!-- PILIHAN PRODI -->
           <tr>

             <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>          </tr>
      </tbody>

    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Pilihan Program Studi</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Pilihan 1 *	  </td>
                        <td bgcolor="#eeeeee"><input name="n_pil1" type="text" id="n_pil1" value="<?php echo $_SESSION['pil1']; ?>" readonly/></td>

        </tr>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Pilihan 2 *	  </td>
                        <td bgcolor="#eeeeee"><input name="n_pil2" type="text" id="n_pil2" value="<?php echo $_SESSION['pil2']; ?>" readonly/></td>

        </tr>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Pilihan 3 *	  </td>
                        <td bgcolor="#eeeeee"><input name="n_pil3" type="text" id="n_pil3" value="<?php echo $_SESSION['pil3']; ?>" readonly/></td>

        </tr>
        <tr>
          <td colspan="2" height="4"></td>
        </tr>

               <!-- LOKASI UJIAN  -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>

      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Lokasi Ujian</b></span></td>
        </tr>

      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
               <tr>
                                  <td width="210" bgcolor="#dddddd">
                   Lokasi Ujian *	  </td>
                        <td bgcolor="#eeeeee"><input name="i_temp_ujian" type="text" id="i_temp_ujian" value="<?php echo $_SESSION['lokuji']; ?>" readonly/></td>
        </tr>

        <tr>
                                         <td width="210" bgcolor="#dddddd"> Tahu Infromasi Dari * </td>
                        <td bgcolor="#eeeeee"><input name="c_inf" type="text" id="c_inf" value="<?php echo $_SESSION['asalinfo']; ?>" readonly/></td
                      ></tr>
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- SDP2 -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>

        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Jumlah SK</b>.</span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>

               <tr>
                 <td width="210" bgcolor="#dddddd">
                   Sumbangan Sukarela Sebesar
                   *<br>
                   <br>	  </td>
                        <td bgcolor="#eeeeee">
                   			<div id="advice-validate-currency-dollar-field5" class="custom-advice" style="display:none">Cukup isikan besaran SDP2 dalam angka bernominal rupiah, tanpa tanda baca.</div>
							<input name="q_sdp2" class="validate-currency-dollar required validate-rupiah validate-digit" id="q_sdp2" value="<?php echo $_SESSION['sk']; ?>" maxlength="8" readonly/>

                			</div>
       <!--
	   Rp.
	   <INPUT TYPE="TEXT" NAME"sdp2j" SIZE="3" MAXLENGTH="3" onclick="validateInt()">.
	   -->	  </td>
        </tr>
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- NILAI PRESTASI LAIN -->
               <tr>

                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
	<table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Photo Peserta PMB</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Photo	  </td>

                        <td bgcolor="#eeeeee">
                        <img src="<?php echo $_SESSION['foto'];?>" width="150" height="175"/>	  </td>
        </tr>

           <!-- PILIHAN PRODI -->
           <tr>

             <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C" align="center"><a href="javascript: history.go(-1)"><input name="button" value=" Ubah Data " type="SUBMIT"></a></td>
		  <td colspan="2" bgcolor="#A4D87C" align="center"><input name="submit" value=" Register PMB " type="SUBMIT">	  </td>
        </tr>

      </tbody>
    </table>
</font>

<!-- NOMOR REGISTRASI -->
<INPUT type="hidden" name="pin" value="<?php echo $_SESSION['pin']; ?>" />
<INPUT type="hidden" name="c_gel" value="<?php echo $_POST['c_gel']; ?>" />
<INPUT type="hidden" name="photo" value="<?php echo $_SESSION['foto']; ?>" />
<INPUT type="hidden" name="c_jalur" value="reguler" />
<INPUT type="hidden" name="i_thn_akademik" value="<?php echo $_SESSION['akad']; ?>" />
</form>
</td>
 </tr>
</tbody></table>


</form>
<?php
    break;
	    case "checkpmdk" :
 $lokasi_file    = $_FILES['photo']['tmp_name'];
  $tipe_file      = $_FILES['photo']['type'];
  $nama_file      = $_FILES['photo']['name'];
  $dir = "../foto/";
  $nama_baru = $_POST['pin'];
  if ($tipe_file =="image/png"){
  $tipe= ".png";
  } elseif ($tipe_file =="image/jpeg"){
  $tipe= ".jpg";
  } elseif ($tipe_file =="image/gif"){
  $tipe= ".gif";
  } 
  $foto_baru = $dir.$nama_baru.$tipe;
  copy($lokasi_file , $foto_baru);
    session_register('nama');
    session_register('jk');
    session_register('tmptlahir');
    session_register('tgllahir');
    session_register('alamat');
    session_register('agama');
    session_register('propinsi');
    session_register('kabupaten');
    session_register('kdpos');
    session_register('telp');
    session_register('hp');
    session_register('email');
    session_register('nm_ortu');
    session_register('jbt_ortu');
    session_register('asalsma');
    session_register('jurasal');
    session_register('alamatsma');
    session_register('propsma');
    session_register('kabsma');
    session_register('pil1');
    session_register('pil2');
    session_register('pil3');
    session_register('lokuji');
    session_register('asalinfo');
    session_register('sk');
    session_register('foto');
	session_register('akad');
	session_register('rata2_XI_2');
	session_register('mtk_XI_2');
	session_register('ing_XI_2');
	session_register('rata2_XII_1');
	session_register('mtk_XII_1');
	session_register('ing_XII_1');
    $_SESSION['nama'] = $_POST['n_lengkap'];
    $_SESSION['jk'] = $_POST['n_jns_kelamin'];
    $_SESSION['tmptlahir'] = $_POST['n_temp_lahir'];
    $_SESSION['tgllahir'] = $_POST['d_lahir'];
    $_SESSION['alamat'] = $_POST['n_alamat'];
    $_SESSION['agama'] = $_POST['i_agama'];
    $_SESSION['propinsi'] = $_POST['n_propinsi'];
    $_SESSION['kabupaten'] = $_POST['n_kabupaten'];
    $_SESSION['kdpos'] = $_POST['c_pos'];
    $_SESSION['telp'] = $_POST['i_telp'];
    $_SESSION['hp'] = $_POST['i_hp'];
    $_SESSION['email'] = $_POST['n_email'];
    $_SESSION['nm_ortu'] = $_POST['n_ortu'];
    $_SESSION['jbt_ortu'] = $_POST['n_jabatan'];
    $_SESSION['asalsma'] = $_POST['n_sma'];
    $_SESSION['jurasal'] = $_POST['i_jur_sma'];
    $_SESSION['alamatsma'] = $_POST['n_alamat_sma'];
    $_SESSION['propsma'] = $_POST['n_prop_sma'];
    $_SESSION['kabsma'] = $_POST['n_kab_sma'];
    $_SESSION['pil1'] = $_POST['n_pil1'];
    $_SESSION['pil2'] = $_POST['n_pil2'];
    $_SESSION['pil3'] = $_POST['n_pil3'];
    $_SESSION['lokuji'] = $_POST['i_temp_ujian'];
    $_SESSION['asalinfo'] = $_POST['c_inf'];
    $_SESSION['sk'] = $_POST['q_sdp2'];
     $_SESSION['foto'] = $foto_baru;
	 $_SESSION['akad'] = $_POST['i_thn_akademik'];
	 $_SESSION['rata2_XI_2'] = $_POST['rata2_XI_2'];
	 $_SESSION['mtk_XI_2'] = $_POST['mtk_XI_2'];
	 $_SESSION['ing_XI_2'] = $_POST['ing_XI_2'];
	 $_SESSION['rata2_XII_1'] = $_POST['rata2_XII_1'];
	 $_SESSION['mtk_XII_1'] = $_POST['mtk_XII_1'];
	 $_SESSION['ing_XII_1'] = $_POST['ing_XII_1'];
?>
<form method=POST enctype='multipart/form-data' action=<?php echo "$aksi?module=registrasi&act=addpmdk"; ?>>
<h2>Silahkan cek kembali data Pribadi anda sebelum melakukan submit data. Pastikan semua data telah terisi dengan benar.</h2>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Pribadi Peserta</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="221" bgcolor="#dddddd">
            Nama Lengkap * 	  </td>

	              <td width="496" bgcolor="#eeeeee">
	                <input name="n_lengkap" type="TEXT" class="required" value="<?php echo $_SESSION['nama']; ?>" size="40" maxlength="80" readonly></td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd">
            Jenis Kelamin *	  </td>
          <td bgcolor="#eeeeee"><input name="n_jns_kelamin" type="text" id="n_jns_kelamin" value="<?php echo $_SESSION['jk']; ?>" readonly/></td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd">
            Tempat, Tanggal Lahir *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_temp_lahir" type="TEXT" class="required" value="<?php echo $_SESSION['tmptlahir']; ?>" size="15" maxlength="40" readonly>
	                ,

	                <input name="d_lahir" type="text" class="required" value="<?php echo $_SESSION['tmptlahir']; ?>" readonly>

					<input type="button" value="Cal" onClick="displayCalendar(document.forms[0].d_lahir,'dd / mm / yyyy',this)">	  </td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd" valign="top">
            Alamat yang dapat Dihubungi *	  </td>
          <td bgcolor="#eeeeee">
          <textarea name="n_alamat" rows="2" cols="30" class="required" readonly><?php echo $_SESSION['alamat']; ?></textarea></td>

        </tr>
                 <tr>
          <td width="221" bgcolor="#dddddd" valign="top">
            Agama	  </td>
	              <td bgcolor="#eeeeee"><input name="i_agama" type="text" id="i_agama" value="<?php echo $_SESSION['agama']; ?>" readonly/></td>
	             </tr>

        <tr>

          <td width="221" bgcolor="#dddddd">
            Propinsi<br>
            Kabupaten / Kota *	  </td>
          <td bgcolor="#eeeeee">

	                <input name="n_propinsi" type="text" id="n_propinsi" value="<?php echo $_SESSION['propinsi']; ?>" readonly/>
	                /
	                <input name="n_kabupaten" type="text" id="n_kabupaten" value="<?php echo $_SESSION['kabupaten']; ?>" readonly/></td>
        </tr>
        <tr>

          <td width="221" bgcolor="#dddddd">
            Kode Pos *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="c_pos" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['kdpos']; ?>" size="5" maxlength="5" readonly>	  </td>
        </tr>

        <tr>
                        <td width="221" bgcolor="#dddddd"> Nomor Telepon * </td>

	                    <td bgcolor="#eeeeee"> <input name="i_telp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['telp']; ?>" size="15" maxlength="20" readonly></td>
        </tr>

        <tr>
          <td width="221" bgcolor="#dddddd">
            Nomor Handphone/Selular *	  </td>
	              <td bgcolor="#eeeeee">
	                <input name="i_hp" type="TEXT" class="validate-number required" value="<?php echo $_SESSION['hp']; ?>" size="15" maxlength="20" readonly></td>

        </tr>

        <tr>
                        <td width="221" bgcolor="#dddddd"> Email * </td>
	              <td bgcolor="#eeeeee">
	                <input name="n_email" type="TEXT" class="required validate-email" value="<?php echo $_SESSION['email']; ?>" size="25" maxlength="40" readonly></td>
        </tr>


        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- DATA ORANGTUA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>

    </table>
    <table width="550" cellpadding="4" >
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Orang Tua Peserta</b></span></td>
        </tr>
      </tbody>

    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Nama Orang Tua *	  </td>
	                    <td bgcolor="#eeeeee">
                        <input name="n_ortu" type="TEXT" class="required" readonly value="<?php echo $_SESSION['nm_ortu']; ?>" size="40" maxlength="60">	  </td>

        </tr>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Jenis Pekerjaan<br>
                          Orang Tua * </td>
	                    <td bgcolor="#eeeeee"><input name="n_jabatan" type="text" id="n_jabatan" readonly value="<?php echo $_SESSION['jbt_ortu']; ?>" /></td>

        </tr>


        <tr>
          <td colspan="2" height="4"></td>
        </tr>

        <!-- DATA SMA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td height="46" colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data SMA/MA/SMK Peserta</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Nama SMA/MA/SMK Asal *	  </td>

                        <td bgcolor="#eeeeee">
                        <input name="n_sma" type="TEXT" class="required" value="<?php echo $_SESSION['asalsma']; ?>" size="30" maxlength="60" readonly>	  </td>
        </tr>
        <tr>
                    <td width="210" bgcolor="#dddddd">
            Jurusan SMA/MA/SMK *  </td>
                        <td bgcolor="#eeeeee"><input name="i_agama5" type="text" id="i_agama5" value="<?php echo $_SESSION['jurasal']; ?>" readonly/></td>

        </tr>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Alamat SMA/MA/SMK *	  </td>
                        <td bgcolor="#eeeeee">
                        <textarea name="n_alamat_sma" rows="2" cols="30" class="required" readonly><?php echo $_SESSION['alamatsma']; ?></textarea>	  </td>
        </tr>



           <tr>
             <td width="210" bgcolor="#dddddd">
               Propinsi<br>
               Kabupaten / Kota *	  </td>
             <td bgcolor="#eeeeee"><input name="n_prop_sma" type="text" id="n_prop_sma" value="<?php echo $_SESSION['propsma']; ?>" readonly/>
               /
                        <input name="n_kab_sma" type="text" id="n_kab_sma" value="<?php echo $_SESSION['kabsma']; ?>" readonly/></td>
           </tr>
           <tr>
             <td colspan="2" height="4"></td>
        </tr>

           <!-- PILIHAN PRODI -->
           <tr>

             <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>          </tr>
      </tbody>

    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Pilihan Program Studi</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Pilihan 1 *	  </td>
                        <td bgcolor="#eeeeee"><input name="n_pil1" type="text" id="n_pil1" value="<?php echo $_SESSION['pil1']; ?>" readonly/></td>

        </tr>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Pilihan 2 *	  </td>
                        <td bgcolor="#eeeeee"><input name="n_pil2" type="text" id="n_pil2" value="<?php echo $_SESSION['pil2']; ?>" readonly/></td>

        </tr>
           <tr>
             <td width="210" bgcolor="#dddddd">
               Pilihan 3 *	  </td>
                        <td bgcolor="#eeeeee"><input name="n_pil3" type="text" id="n_pil3" value="<?php echo $_SESSION['pil3']; ?>" readonly/></td>

        </tr>
        <tr>
          <td colspan="2" height="4"></td>
        </tr>

               <!-- LOKASI UJIAN  -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>

      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Lokasi Ujian</b></span></td>
        </tr>

      </tbody>
    </table>
	 <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Data Nilai Calon Mahasiswa</b></span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
                        <td width="210" bgcolor="#dddddd"> Nilai Rata-rata kelas XI semester
                          2 * </td>
	                    <td bgcolor="#eeeeee">
                        <input name="rata2_XI_2" size="4" maxlength="4" type="TEXT" class="validate-number required required validate-rata" value="<?php echo $_SESSION['rata2_XI_2']; ?>" readonly>
                       contoh:90,75 ditulis 9075; 4,1 ditulis 0410 </td>
        </tr>

        <tr>
                        <td width="210" bgcolor="#dddddd"> Nilai Matematika kelas XI semester
                          2 *</td>
	                    <td bgcolor="#eeeeee">
                        <input name="mtk_XI_2" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $_SESSION['mtk_XI_2']; ?>" readonly>
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
        </tr>

        <tr>
                        <td width="210" bgcolor="#dddddd"> Nilai Bhs.Inggris kelas XI semester
                          2 * </td>
	                    <td bgcolor="#eeeeee">
                        <input name="ing_XI_2" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $_SESSION['ing_XI_2']; ?>" readonly>
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
        </tr>
					  <tr>
					  </tr>
					  <tr>
					  </tr>
          <tr>
                        <td width="210" bgcolor="#dddddd"> Nilai Rata-rata kelas XII semester
                          1 * </td>
	                    <td bgcolor="#eeeeee">
                        <input name="rata2_XII_1" size="4" maxlength="4" type="TEXT" class="validate-number required required validate-rata" value="<?php echo $_SESSION['rata2_XII_1']; ?>" readonly>
                        contoh:90,75 ditulis 9075; 4,1 ditulis 0410 </td>
        </tr>
					     <tr>
                        <td width="210" bgcolor="#dddddd"> Nilai Matematika kelas XII semester
                          1 * </td>
	                    <td bgcolor="#eeeeee">
                        <input name="mtk_XII_1" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $_SESSION['mtk_XII_1']; ?>" readonly>
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
                      </tr>
           <tr>
                        <td width="210" bgcolor="#dddddd"> Nilai Bhs.Inggris kelas XII semester
                          1 * </td>
	                    <td bgcolor="#eeeeee">
                        <input name="ing_XII_1" size="2" maxlength="2" type="TEXT" class="validate-number required required validate-nilai" value="<?php echo $_SESSION['ing_XII_1']; ?>" readonly>
                        Diisi dalam puluhan, tanpa desimal. Contoh: 73 atau 80 </td>
        </tr>
        <tr>
          <td colspan="2" height="4"></td>
        </tr>

	<!-- CAPTCHA -->
        <tr>
          <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
                                         <td width="210" bgcolor="#dddddd"> Tahu Infromasi Dari * </td>
                        <td bgcolor="#eeeeee"><input name="c_inf" type="text" id="c_inf" value="<?php echo $_SESSION['asalinfo']; ?>" readonly/></td
                      ></tr>
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- SDP2 -->
               <tr>
                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>

        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Jumlah SK</b></span></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>

               <tr>
                 <td width="210" bgcolor="#dddddd">
                   Sumbangan Sukarela Sebesar
                   *<br>
                   <br>	  </td>
                        <td bgcolor="#eeeeee">
                   			<div id="advice-validate-currency-dollar-field5" class="custom-advice" style="display:none">Cukup isikan besaran SDP2 dalam angka bernominal rupiah, tanpa tanda baca.</div>
							<input name="q_sdp2" class="validate-currency-dollar required validate-rupiah validate-digit" id="q_sdp2" value="<?php echo $_SESSION['sk']; ?>" maxlength="8" readonly/>

                			</div>
       <!--
	   Rp.
	   <INPUT TYPE="TEXT" NAME"sdp2j" SIZE="3" MAXLENGTH="3" onclick="validateInt()">.
	   -->	  </td>
        </tr>
               <tr>
                 <td colspan="2" height="4"></td>
        </tr>

               <!-- NILAI PRESTASI LAIN -->
               <tr>

                 <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
	<table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C"><span class="style1"><b>Photo Peserta PMB</b></span></td>

        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td width="210" bgcolor="#dddddd">
            Photo	  </td>

                        <td bgcolor="#eeeeee">
                        <img src="<?php echo $_SESSION['foto'];?>" width="150" height="175"/>	  </td>
        </tr>

           <!-- PILIHAN PRODI -->
           <tr>

             <td colspan="2" bgcolor="#6ABF28" height="2"></td>
        </tr>
      </tbody>
    </table>
    <table width="550" cellpadding="4">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#A4D87C" align="center"><a href="javascript: history.go(-1)"><input name="button" value=" Ubah Data " type="SUBMIT"></a></td>
		  <td colspan="2" bgcolor="#A4D87C" align="center"><input name="submit" value=" Register PMB " type="SUBMIT">	  </td>
        </tr>

      </tbody>
    </table>
</font>

<!-- NOMOR REGISTRASI -->
<INPUT type="hidden" name="pin" value="<?php echo $_SESSION['pin']; ?>" />
<INPUT type="hidden" name="c_gel" value="<?php echo $_POST['c_gel']; ?>" />
<INPUT type="hidden" name="photo" value="<?php echo $_SESSION['foto']; ?>" />
<INPUT type="hidden" name="c_jalur" value="PMDK" />
<INPUT type="hidden" name="i_thn_akademik" value="<?php echo $_SESSION['akad']; ?>" />
</form>
</td>
 </tr>
</tbody></table>


</form>
<?php
    break;
}
}
?>
