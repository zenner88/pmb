<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Pendaftaran Online PMB Poltekpos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />
        <meta name="keywords" content="expand, form, css3, jquery, animate, width, height, adapt, unobtrusive javascript"/>
		<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="style/css/style.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
		<script src="style/js/cufon-yui.js" type="text/javascript"></script>
		<script src="style/js/ChunkFive_400.font.js" type="text/javascript"></script>
		<script type="text/javascript">
			Cufon.replace('h1',{ textShadow: '1px 1px #fff'});
			Cufon.replace('h2',{ textShadow: '1px 1px #fff'});
			Cufon.replace('h3',{ textShadow: '1px 1px #000'});
			Cufon.replace('.back');
		</script>
		</script>
<script language="javascript">
function validasi(form){
  if (form.pin.value == ""){
    alert("No Pin masih kosong");
    form.pin.focus();
    return (false);
  }
     
  if (form.password.value == ""){
    alert("Kode Aktivasi masih kosong");
    form.password.focus();
    return (false);
  }
  return (true);
}
</script>

    </head>
    <body>
		<div class="wrapper">
			
			<div class="content">
<div id="form_wrapper" class="form_wrapper">
					<form class="login active"  method="post" action="#" onSubmit="return validasi(this)">
						<h3>Form pendaftaran mahaiswa baru</h3>
						<div>
							<label>Nama</label>
							<input type="text" name="pin" id="pin" />
							<span class="error">This is an error</span>
						</div>
						<div>
							<label>Email</label>
							<input type="password" name="password" id="password" />
							<span class="error">This is an error</span>
						</div>
                        <div>
							<label>No.Tlp / HP</label>
							<input type="password" name="password" id="password" />
							<span class="error">This is an error</span>
						</div>
                        <div>
							<label>Email</label>
							<select name="kampus"></select><input type="password" name="password" id="password" />
							<span class="error">This is an error</span>
						</div>
						<div class="bottom">
							<input type="submit" value="Login"></input>
							<div class="clear"></div>
						</div>
					</form>

				</div>
				<div class="clear"></div>
			</div>
			
		</div>
		


    </body>
</html>