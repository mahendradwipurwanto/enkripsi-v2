<div class="row">
	<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
		<div class="login-brand mb-3">
			<img src="<?= base_url();?>assets/images/logo.png" alt="logo" width="100" class="shadow-light logo-brand">
		</div>

		<div class="card card-primary">
			<div class="card-header">
				<h4>Ubah password akun anda</h4>
			</div>

			<div class="card-body">
				<form method="POST" action="<?= site_url('authentication/proses_ubahPassword');?>"
					class="needs-validation" novalidate="">
					<input type="hidden" name="user_id" value="<?= $user_id;?>">
					<div class="form-group">
						<label for="email">Email</label>
						<input id="email" type="email" class="form-control" name="email" value="<?= $email;?>"
							tabindex="1" required readonly>
						<div class="invalid-feedback">
							Harap masukkan email dengan benar
						</div>
					</div>

					<div class="form-group">
						<label for="password" class="d-block">Password</label>
						<input id="password" type="password" class="form-control pwstrength"
							data-indicator="pwindicator" name="password" required>
						<div id="pwindicator" class="pwindicator">
							<div class="bar"></div>
							<div class="label"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="password2" class="d-block">Konfirmasi password</label>
						<input id="password2" type="password" class="form-control" name="password_conf" required>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" id="submit-button">
							Ubah password
						</button>
					</div>
				</form>
			</div>
		</div>
		<div class="mt-5 text-muted text-center">
			Sudah punya akun? <a href="<?= site_url('login');?>" class="text-muted">Masuk sekarang</a>
		</div>
		<div class="simple-footer">
			Copyright &copy; <?= $web_title;?>
		</div>
	</div>
</div>
