<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>

</style>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
</head>
<body>
<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Form Pendaftaran Mahasiswa Baru</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="nama">Nama</label>
  <div class="controls">
    <input id="nama" name="nama" placeholder="Nama Lengkap Siswa" class="input-xlarge" required="" type="text">
    <p class="help-block">Isi dengan nama lengkap calon mahasiswa</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="email">Email</label>
  <div class="controls">
    <input id="email" name="email" placeholder="Email Valid" class="input-xlarge" required="" type="text">
    <p class="help-block">Isi dengan email yang valid atau benar digunakan untuk login</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="notlp">No. Tlp / HP</label>
  <div class="controls">
    <input id="notlp" name="notlp" placeholder="No. Tlp / HP" class="input-xlarge" required="" type="text">
    <p class="help-block">No telepon atau hp yang bisa dihubungi</p>
  </div>
</div>

<!-- Multiple Radios -->
<div class="control-group">
  <label class="control-label" for="Pilihan Perguruan Tinggi">Pilihan Perguruan Tinggi</label>
  <div class="controls">
    <label class="radio" for="Pilihan Perguruan Tinggi-0">
      <input name="Pilihan Perguruan Tinggi" id="Pilihan Perguruan Tinggi-0" value="POLTEKPOS" checked="checked" type="radio">
      POLTEKPOS
    </label>
    <label class="radio" for="Pilihan Perguruan Tinggi-1">
      <input name="Pilihan Perguruan Tinggi" id="Pilihan Perguruan Tinggi-1" value="STIMLOG" type="radio">
      STIMLOG
    </label>
  </div>
</div>

<!-- Button (Double) -->
<div class="control-group">
  <label class="control-label" for="daftar"></label>
  <div class="controls">
    <button id="daftar" name="daftar" class="btn btn-success">Daftar</button>
    <button id="clear" name="clear" class="btn btn-danger">Clear</button>
  </div>
</div>

</fieldset>
</form>

</body>
</html>