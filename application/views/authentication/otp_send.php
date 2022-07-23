<?php
function mask_email($email)
{
    $mail_parts = explode("@", $email);
    $domain_parts = explode('.', $mail_parts[1]);
    $mail_parts[0] = mask($mail_parts[0], 2, 1); // show first 2 letters and last 1 letter
    $domain_parts[0] = mask($domain_parts[0], 2, 1); // same here
    $mail_parts[1] = implode('.', $domain_parts);
    return implode("@", $mail_parts);
}
function mask($str, $first, $last)
{
    $len = strlen($str);
    $toShow = $first + $last;
    return substr($str, 0, $len <= $toShow ? 0 : $first) . str_repeat("*", $len - ($len <= $toShow ? 0 : $toShow)) . substr($str, $len - $last, $len <= $toShow ? 0 : $last);
}
?>

<div class="row">
	<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
		<div class="login-brand mb-3">
			<img src="<?= base_url();?>assets/images/logo.png" alt="logo" width="100" class="shadow-light logo-brand">
		</div>

		<div class="card card-primary">
			<div class="card-header">
				<h4>Verifikasi OTP</h4>
			</div>

			<div class="card-body">
				<h6 class="font-weight-light">Tekan tombol dibawah ini untuk menerima kode OTP sebelum login melalui
					akun email anda.</h6>

				<div class="form-group">
					<a href="<?= site_url('send-otp/email'); ?>" class="btn btn-primary btn-lg btn-block" tabindex="4"
						id="submit-button">
						Kirim kode OTP
						(<?= mask_email($this->session->userdata('email')); ?>)
					</a>
				</div>
			</div>
		</div>
		<div class="mt-5 text-muted text-center">
			Ganti akun? <a href="<?= site_url('logout'); ?>" class="text-primary">Keluar</a>
		</div>
		<div class="simple-footer">
			Copyright &copy; <?= $web_title;?>
		</div>
	</div>
</div>
