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
				<h5 class="font-weight-light">Demi menjaga keamanan, kami ingin melakukan verifikasi ke email anda. Yuk
					lakukan aktivasi sekarang sebelum melanjutkan ke dashboard.</h5>
				<div class="form-group">
					<input id="text" type="number" class="form-control" name="kode_otp" value="<?= $mail;?>"
						tabindex="1" required readonly>
				</div>

				<div class="form-group">
					<a href="<?= site_url('send-otp/email'); ?>" class="btn btn-primary btn-lg btn-block" tabindex="4"
						id="submit-button"><?= site_url('aktivasi-akun');?></a>
				</div>
			</div>
		</div>
		<div class="simple-footer">
			Copyright &copy; <?= $web_title;?>
		</div>
	</div>
</div>
