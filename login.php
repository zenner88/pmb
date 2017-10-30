<script src="daftar/assets/js/jquery.validate.min.js"></script>

<div class="row">
<div class="col-12 col-lg-4"></div>
<div class="col-12 col-lg-4">
	<form action="ceklogin" id="contact-form" class="form-horizontal" method="post">
		<legend class="list-group-item bg-light text-center">
			Login
		</legend>
		<div class="list-group-item text-center">
			<label class="control-label" for="email">NISN</label>
			<div class="controls">
				<input type="text" class="form-control" name="briva" id="briva" required="true">
			</div>
		</div>
		<div class="list-group-item text-center">
			<label class="control-label" for="subject">Password</label>
			<div class="controls">
				<input type="password" class="form-control" name="password" id="password" maxlength="50" required="true">
			</div>
		</div>
		<div class="list-group-item text-center bg-light">
			<div class="btn-group" role="group" aria-label="Basic example">
	        <button type="submit" class="btn btn-sm btn-primary btn-large">Submit</button>
			<button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
			</div>
		</div>
	</form>
</div>