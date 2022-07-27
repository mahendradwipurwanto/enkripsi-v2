<div class="row">
	<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
		<div class="login-brand mb-3">
			<img src="<?= base_url();?>assets/images/logo.png" alt="logo" width="100" class="shadow-light logo-brand">
		</div>

		<div class="card card-primary">
			<div class="card-header">
				<h4>Daftarkan akun anda</h4>
			</div>

			<div class="card-body">
				<form action="<?= site_url('register/proses_daftar');?>" method="POST">
					<div class="form-group">
						<label for="first_name">Nama lengkap</label>
						<input id="first_name" type="text" class="form-control" name="nama" autofocus required>
						<div class="invalid-feedback">
							Masukkan nama anda dengan benar
						</div>
					</div>
					<div class="form-group">
						<label for="inputJk">Jenis kelamin</label>
						<select name="jk" id="inputJk" class="form-control" autofocus required>
							<option value="L">Laki-Laki</option>
							<option value="P">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="inputNomor">Nomor telepon pengguna</label>
						<input type="text" class="form-control" id="inputNomor" name="no_telp" autofocus required>
						<div class="invalid-feedback">
							Masukkan Nomor telepon anda dengan benar
						</div>
					</div>
					<div class="form-group">
						<label for="inputPekerjaan">Pekerjaan</label>
						<input type="text" class="form-control" id="inputPekerjaan" name="pekerjaan" autofocus required>
						<div class="invalid-feedback">
							Masukkan Pekerjaan anda dengan benar
						</div>
					</div>
					<div class="form-group">
						<label for="inputGaji">Gaji</label>
						<select name="gaji" id="inputGaji" class="form-control" autofocus required>
							<option value="Dibawah < Rp 1.000.000">Dibawah < Rp 1.000.000</option> <option
									value="Rp. 1.000.000 s/d 3.000.000">Rp. 1.000.000 s/d Rp. 3.000.000</option>
							<option value="Rp. 3.000.000 s/d Rp 6.000.000">Rp. 3.000.000 s/d Rp 5.000.000</option>
							<option value="Rp. 6.000.000 s/d Rp 10.000.000">Rp. 5.000.000 s/d Rp 10.000.000</option>
							<option value="Diatas Rp 10.000.000">Diatas Rp 10.000.000</option>
						</select>
						<div class="invalid-feedback">
							Masukkan Gaji anda dengan benar
						</div>
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<textarea id="alamat" type="text" class="form-control" style="height: 150px;" name="alamat"
							autofocus required></textarea>
						<div class="invalid-feedback">
							Masukkan alamat anda
						</div>
					</div>

					<div class="form-group">
						<label for="email">Email</label>
						<input id="email" type="email" class="form-control" name="email" required>
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
						<button type="submit" class="btn btn-primary btn-lg btn-block" id="submit-button">
							Daftar
						</button>
					</div>

					<div class="form-group m-t-10 mb-0 row">
						<div class="col-12 m-t-20 text-center">
							Sudah punya akun? <a href="<?= site_url('login');?>" class="text-muted">Masuk sekarang</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="simple-footer">
			Copyright &copy; <?= $web_title;?>
		</div>
	</div>
</div>
