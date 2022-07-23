<div class="row">
	<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
		<div class="login-brand mb-3">
			<img src="<?= base_url();?>assets/images/logo.png" alt="logo" width="100" class="shadow-light logo-brand">
		</div>

		<div class="card card-primary">
			<div class="card-header">
				<h4>Verifikasi OTP</h4>
			</div>

			<div class="card-body">
				<form action="<?= site_url('authentication/proses_verifikasiOtp');?>" method="POST">
					<h6 class="font-weight-light">Harap masukkan kode OTP yang telah Anda terima melalui email.</h6>
					<div class="form-group">
						<input id="text" type="number" class="form-control" name="kode_otp" tabindex="1" required
							autofocus>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" id="submit-button">
							Verifikasi OTP
						</button>
					</div>
				</form>
			</div>
		</div>
		<div class="mt-5 text-muted text-center">
                    Belum menerima kode OTP? <a href="<?= site_url('otp');?>" class="text-primary">Kirim ulang</a>
		</div>
		<div class="simple-footer">
			Copyright &copy; <?= $web_title;?>
		</div>
	</div>
</div>
