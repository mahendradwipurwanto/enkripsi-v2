<div class="section-header">
	<h1>Pengaturan</h1>
	<div class="section-header-breadcrumb">
		<div class="breadcrumb-item"><a href="<?= site_url('admin');?>">Dashboard</a></div>
		<div class="breadcrumb-item active">Pengaturan</div>
	</div>
</div>

<div class="section-body">
	<h2 class="section-title">Pengaturan website</h2>
	<p class="section-lead">
		Atur semua informasi mengenai website disini
	</p>

	<div id="output-status"></div>
	<div class="row">
		<div class="col-md-8">
			<form id="setting-form" action="<?= site_url('admin/ubah_pengaturanInfo');?>" method="post">
				<input type="hidden" name="key" value="web_title">
				<div class="card" id="settings-card">
					<div class="card-body">
						<p class="text-muted">Atur informasi seperti judul website, metode pembayaran dan lainnya
						</p>
						<div class="form-group row align-items-center">
							<label for="site-title" class="form-control-label col-sm-3 text-md-right">Judul
								website</label>
							<div class="col-sm-6 col-md-9">
								<input type="text" name="judul" class="form-control" id="site-title"
									value="<?= $web_title;?>" required>
							</div>
						</div>
						<div class="form-group row align-items-center">
							<label for="kode" class="form-control-label col-sm-3 text-md-right">Kode dekripsi</label>
							<div class="col-sm-6 col-md-9">
								<input type="text" name="kode" class="form-control" id="kode" minlength="16" maxlength="16"
									value="<?= $kode;?>" required>
							</div>
						</div>
						<div class="form-group row align-items-center">
							<label class="form-control-label col-sm-3 text-md-right">Metode pembayaran</label>
							<div class="col-sm-6 col-md-9">
								<button type="button" class="btn bg-danger text-white btn-sm" data-toggle="modal"
									data-target="#metode-shopeepay">Shopeepay</button>
								<button type="button" class="btn btn-info btn-sm" data-toggle="modal"
									data-target="#metode-dana">Dana</button>
								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
									data-target="#metode-bca">BCA</button>
								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
									data-target="#metode-bri">BRI</button>
								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
									data-target="#metode-mandiri">MANDIRI</button>
							</div>
						</div>
						<div class="form-group row align-items-center">
							<label class="form-control-label col-sm-3 text-md-right">Aktifkan OTP saat pengguna login?</label>
							<div class="col-sm-6 col-md-9">
								<a href="<?= site_url('admin/bypass_otp/false');?>" class="btn <?= $bypass_otp == 'false' ? 'btn-primary' : 'btn_secondary';?> btn-sm">Ya</a>
								<a href="<?= site_url('admin/bypass_otp/true');?>" class="btn <?= $bypass_otp == 'true' ? 'btn-primary' : 'btn_secondary';?> btn-sm">Tidak</a>
								<small class="text-muted ml-2">Pengguna akan diharuskan melakukan proses verifikasi kode OTP melalui email pendaftaran jika OTP diaktifkan</small>
							</div>
						</div>
					</div>
					<div class="card-footer text-md-right">
						<button class="btn btn-primary" id="save-btn">Simpan pengaturan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="metode-shopeepay" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Informasi metode pembayaran Shopeepay</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('admin/ubah_pengaturan');?>" method="post">
					<input type="hidden" name="key" value="metode_shopeepay">
					<div class="form-group">
						<label for="inputNama">Atas nama</label>
						<input type="text" class="form-control" id="inputNama" name="desc"
							value="<?= $shopeepay->desc;?>" required>
					</div>
					<div class="form-group">
						<label for="inputNomor">Nomor</label>
						<input type="text" class="form-control" id="inputNomor" name="value"
							value="<?= $shopeepay->value;?>" required>
					</div>
					<div class="modal-footer px-0 mx-0">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="metode-dana" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Informasi metode pembayaran DANA</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('admin/ubah_pengaturan');?>" method="post">
					<input type="hidden" name="key" value="metode_dana">
					<div class="form-group">
						<label for="inputNama">Atas nama</label>
						<input type="text" class="form-control" id="inputNama" name="desc" value="<?= $dana->desc;?>"
							required>
					</div>
					<div class="form-group">
						<label for="inputNomor">Nomor</label>
						<input type="text" class="form-control" id="inputNomor" name="value" value="<?= $dana->value;?>"
							required>
					</div>
					<div class="modal-footer px-0 mx-0">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="metode-bca" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Informasi metode pembayaran BCA</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('admin/ubah_pengaturan');?>" method="post">
					<input type="hidden" name="key" value="metode_bca">
					<div class="form-group">
						<label for="inputNama">Atas nama</label>
						<input type="text" class="form-control" id="inputNama" name="desc" value="<?= $bca->desc;?>"
							required>
					</div>
					<div class="form-group">
						<label for="inputNomor">Nomor</label>
						<input type="text" class="form-control" id="inputNomor" name="value" value="<?= $bca->value;?>"
							required>
					</div>
					<div class="modal-footer px-0 mx-0">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="metode-bri" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Informasi metode pembayaran BRI</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('admin/ubah_pengaturan');?>" method="post">
					<input type="hidden" name="key" value="bri">
					<div class="form-group">
						<label for="inputNama">Atas nama</label>
						<input type="text" class="form-control" id="inputNama" name="desc" value="<?= $bri->desc;?>"
							required>
					</div>
					<div class="form-group">
						<label for="inputNomor">Nomor</label>
						<input type="text" class="form-control" id="inputNomor" name="value" value="<?= $bri->value;?>"
							required>
					</div>
					<div class="modal-footer px-0 mx-0">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="metode-mandiri" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Informasi metode pembayaran MANDIRI</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('admin/ubah_pengaturan');?>" method="post">
					<input type="hidden" name="key" value="metode_mandiri">
					<div class="form-group">
						<label for="inputNama">Atas nama</label>
						<input type="text" class="form-control" id="inputNama" name="desc" value="<?= $mandiri->desc;?>"
							required>
					</div>
					<div class="form-group">
						<label for="inputNomor">Nomor</label>
						<input type="text" class="form-control" id="inputNomor" name="value"
							value="<?= $mandiri->value;?>" required>
					</div>
					<div class="modal-footer px-0 mx-0">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
