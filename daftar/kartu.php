<?php
// session_start();
error_reporting(0);
?>
<link type="text/css" rel="stylesheet" href="stail.css"/>
<script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
</script>

<div class="row">
<div class="col-12 col-lg-2"></div>
<div class="col-12 col-lg-8">
<div class="list-group-item text-center">
<h2><B>Bukti Pendaftaran Mahasiswa Baru</B></h2>
</div>
<div class="list-group-item">
  <div class="row">
    <div class="col-12 col-lg-5 text-right">Nama</div>
    <div class="col-12 col-lg-2 text-center">:</div>
    <div class="col-12 col-lg-5 text-left"><B><?php echo $_SESSION['nami']; ?></B></div>
    <div class="col-12 col-lg-5 text-right">NISN</div>
    <div class="col-12 col-lg-2 text-center">:</div>
    <div class="col-12 col-lg-5 text-left"><B><?php echo $_SESSION['nis']; ?></B></div>
    <div class="col-12 col-lg-5 text-right">Password</div>
    <div class="col-12 col-lg-2 text-center">:</div>
    <div class="col-12 col-lg-5 text-left"><B><?php echo $_SESSION['paswod']; ?></B></div>
    <div class="col-12 col-lg-5 text-right">Jalur Pendaftaran</div>
    <div class="col-12 col-lg-2 text-center">:</div>
    <div class="col-12 col-lg-5 text-left"><B>
<?php if ($_SESSION['jalu']==1){echo "Regular";}elseif ($_SESSION['jalu']==2){echo "Undangan";}elseif ($_SESSION['jalu']==3){echo "Jalur Prestasi/ PMDK";}elseif ($_SESSION['jalu']==4){echo "Jalur Mandiri";}else{echo "-";}?>
    </B></div>
    <div class="col-12 col-lg-5 text-right">Uang Pendaftaran</div>
    <div class="col-12 col-lg-2 text-center">:</div>
    <div class="col-12 col-lg-5 text-left"><B>Rp. 200.000</B></div>
  </div>
</div>
<div class="list-group-item">
  <B>Keterangan :</B><BR />
  Cetak Bukti pendaftaran ini dan jangan sampai hilang.<BR />
 
   NISN dan Password dapat langsung digunakan untuk login dan mengisi biodata serta persyaratan lainnya, segera lakukan pembayaran dan kirim bukti pembayaran kepada panitia pmb, untuk mengaktifkan menu Print Kartu Ujian (REGULER)

 <B>Jika tidak melakukan pembayaran dan konfirmasi kepada panitia PMB, data akan hilang dalam 1 Minggu dan Harus melakukan pendaftaran ulang.</B>
</div>
  <div class="list-group-item">

<div class="row">
<div class="col-12 col-lg-5">
     <B>Tempat Pembayaran :</B><br/>
    <B>GIRO POS :</B> 4000115179 </br>a.n Yayasan Pendidikan Bhakti Pos Indonesia (YPBPI)</br>
    <B>BNI :</B> 0028676942 </br>a.n Yayasan Pendidikan Bhakti Pos Indonesia (YPBPI)</br></br>
    <B>Kirim bukti pembayaran (foto/scan) ke :</B></br>
    email : info@poltekpos.ac.id / pmb@stimlog.ac.id  </br>
    whatsapp : 089 694 909 220</br>
    BBM : 5A579F54</br>
</div>
<div class="col-12 col-lg-7">
    <b>Untuk Pendaftar jalur PMDK waktu mengisi bioadata siapkan : </b>
    <li>Hasil scan / Softfile Pas Photo terbaru</li>
    <li>Hasil scan nilai raport semester III dan IV (legalisir)</li>
    <b>Untuk Pendaftar jalur UNDANGAN waktu mengisi bioadata siapkan : </b>
    <li>Hasil scan / Softfile Pas Photo terbaru</li>
    <li>Hasil scan Surat Undangan</li>
    <b>Untuk Pendaftar jalur REGULER waktu mengisi bioadata siapkan : </b>
    <li>Hasil scan / Softfile Pas Photo terbaru</li>
  </div>
</div>
</div>

<input id="printpagebutton" type="button" value="Print Bukti Pendaftaran" onclick="printpage()"/>
</div>
<div class="col-12 col-lg-2"></div>
</div>

