<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html class="supernova"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="alternate" type="application/json+oembed" href="https://www.jotform.com/oembed/?format=json&amp;url=http%3A%2F%2Fwww.jotform.com%2Fform%2F43361202967454" title="oEmbed Form"><link rel="alternate" type="text/xml+oembed" href="https://www.jotform.com/oembed/?format=xml&amp;url=http%3A%2F%2Fwww.jotform.com%2Fform%2F43361202967454" title="oEmbed Form">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="HandheldFriendly" content="true" />
<title>Form</title>
<link type="text/css" rel="stylesheet" href="css/styles/form.css?v3.2.4470"/>
<link href="css/calendarview.css?v3.2.4470" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="http://max.jotfor.ms/css/styles/nova.css?3.2.4470" />
<link type="text/css" media="print" rel="stylesheet" href="http://max.jotfor.ms/css/printForm.css?3.2.4470" />
<link type="text/css" rel="stylesheet" href="stail.css"/>
<script src="js/prototype.js?v=3.2.4470" type="text/javascript"></script>
<script src="js/vendor/json2.js?v=3.2.4470" type="text/javascript"></script>
<script src="js/protoplus.js?v=3.2.4470" type="text/javascript"></script>
<script src="js/protoplus-ui-form.js?v=3.2.4470" type="text/javascript"></script>
<script src="js/jotform.js?v=3.2.4470" type="text/javascript"></script>
<script src="js/calendarview.js?v=3.2.4470" type="text/javascript"></script>
<script src="../peserta/validation.js" type="text/javascript"></script>
<script type="text/javascript">
   JotForm.init(function(){
      $('input_4').hint('ex: myname@example.com');
      $('input_7').hint('ex: 088888888');
      JotForm.initCaptcha('input_6');
   });
</script>
</head>
<body>
<form class="jotform-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="form_43361202967454" id="43361202967454" accept-charset="utf-8">
  <input type="hidden" name="formID" value="43361202967454" />
  <div class="form-all">
    <ul class="form-section">
      <li id="cid_1" class="form-input-wide" data-type="control_head">
        <div class="form-header-group">
          <div class="header-text httac htvam">
            <h2 id="header_1" class="form-header">
              Form Pendaftaran Mahasiswa Baru
            </h2>
          </div>
        </div>
      </li>
      <li class="form-line" data-type="control_fullname" id="id_8">
        <label class="form-label form-label-left form-label-auto" id="label_8" for="input_8"> Nama Lengkap </label>
        <div id="cid_8" class="form-input">
          <span class="form-sub-label-container">
            <input class="required form-textbox" type="text" size="30" name="nama" id="nama" />
          </span>
          <br><span class="error">* <?php echo $nameErr;?></span>
          </div>
      </li>
      <li class="form-line" data-type="control_email" id="id_4">
        <label class="form-label form-label-left form-label-auto" id="label_4" for="input_4"> E-mail </label>
        <div id="cid_4" class="form-input">
          <input type="email" class=" form-textbox validate[Email]" id="email" name="email" size="30" value="" />
           <br><span class="error">* <?php echo $emailErr;?></span>
        </div>
      </li>
      <li class="form-line" data-type="control_number" id="id_7">
        <label class="form-label form-label-left form-label-auto" id="label_7" for="input_7"> No.Tlp / HP </label>
        <div id="cid_7" class="form-input">
          <input type="number" class="form-number-input  form-textbox" id="no_tlp" name="no_tlp" style="width:140px" size="15" value="" data-type="input-number" />
        </div>
        <br><span class="error">* <?php echo $tlpErr;?></span>
      </li>
       
      <li class="form-line" data-type="control_radio" id="id_9">
        <label class="form-label form-label-left form-label-auto" id="label_9" for="input_9"> Pilihan Perguruan Tinggi </label>
        <div id="cid_9" class="form-input">
          <div class="form-single-column">
            <span class="form-radio-item" style="clear:left;">
              <input type="radio" class="form-radio" id="pilihan" name="pilihan" value="1" checked/>
              <label for="input_9_0"> POLTEKPOS </label>
            </span>
            <span class="clearfix">
            </span>
            <span class="form-radio-item" style="clear:left;">
              <input type="radio" class="form-radio" id="pilihan" name="pilihan" value="2" />
              <label for="input_9_1"> STIMLOG </label>
            </span>
            <span class="clearfix">
            </span>
          </div>
        </div>
      </li>
     
      <li class="form-line" data-type="control_button" id="id_2">
        <div id="cid_2" class="form-input-wide">
          <div style="margin-left:156px" class="form-buttons-wrapper">
            <button id="input_2" type="submit" class="form-submit-button">
              Submit
            </button>
          </div>
        </div>
      </li>
      <li style="display:none">
        Should be Empty:
        <input type="text" name="website" value="" />
      </li>
    </ul>
  </div>
  <input type="hidden" id="simple_spc" name="simple_spc" value="43361202967454" />
  <script type="text/javascript">
  document.getElementById("si" + "mple" + "_spc").value = "43361202967454-43361202967454";
  </script>
</form><img src="//tracking.jotform.com/form/43361202967454" style="display:none" />
</body>
</html>