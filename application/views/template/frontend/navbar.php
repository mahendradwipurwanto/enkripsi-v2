<nav class="navbar navbar-expand-lg main-navbar">
	<a href="<?= base_url();?>" class="navbar-brand sidebar-gone-hide"><?= $web_title;?></a>
	<div class="navbar-nav">
		<a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
	</div>
	<div class="nav-collapse">
		<a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
			<i class="fas fa-ellipsis-v"></i>
		</a>
		<ul class="navbar-nav">
			<li class="nav-item active"><a href="<?= site_url('home');?>" class="nav-link">Beranda</a></li>
		</ul>
	</div>
	<ul class="navbar-nav navbar-right ml-auto">
		<?php if($this->session->userdata('logged_in') || $this->session->userdata('logged_in') == true):?>
		<?php if($this->session->userdata('role') == 2):?>
		<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
				class="nav-link notification-toggle nav-link-lg <?= $this->session->userdata('keranjang') ? 'beep' : '';?>"><i
					class="dripicons-cart"></i></a>
			<div class="dropdown-menu dropdown-list dropdown-menu-right">
				<div class="dropdown-header">Keranjang anda</div>
				<div class="dropdown-list-content dropdown-list-icons">
					<?php if($this->session->userdata('keranjang')):?>
					<?php foreach($this->session->userdata('keranjang') as $val):?>
					<a href="javascript:void(0);" class="dropdown-item">
						<div class="dropdown-item-icon bg-info text-white">
							<i class="dripicons-cart" style="margin-right: 3px;"></i>
							<img src="<?= $val['gambar'];?>" class="img-cart" alt="">
						</div>
						<div class="dropdown-item-desc">
							<b><?= $val['produk'];?></b> Menambahkan <?= $val['jumlah'];?> <?= $val['produk'];?> ke
							keranjang anda</small>
							<div class="time"><?= $val['time'];?></div>
						</div>
					</a>
					<?php endforeach;?>
					<?php else:?>
					<a class="dropdown-item">
						<div class="dropdown-item-desc text-center w-100 ml-0">
							Keranjang anda kosong
						</div>
					</a>
					<?php endif;?>
				</div>
				<?php if($this->session->userdata('keranjang')):?>
				<div class="dropdown-footer text-center">
					<div class="row">
						<div class="col-9">
							<a href="javascript:void(0);" class="dropdown-item" style="padding: 10px !important;"
								data-toggle="modal" data-target="#simpan-checkout">Checkout keranjang <i
									class="dripicons-cart"></i></a>
						</div>
						<div class="col-3">
							<a href="javascript:void(0);" class="dropdown-item" style="padding: 10px !important;"
								data-toggle="modal" data-target="#delete-checkout"><i class="dripicons-trash"></i></a>
						</div>
					</div>
				</div>
				<?php endif;?>
			</div>
		</li>
		<?php endif;?>
		<?php endif;?>
		<?php if(!$this->session->userdata('logged_in') || $this->session->userdata('logged_in') == false):?>
		<li class="ml-2"><a href="<?= site_url('login');?>" class="btn btn-outline-light btn-sm">Masuk ke akun anda</a>
		</li>
		<li class="ml-3"><a href="<?= site_url('register');?>" class="btn btn-light btn-sm">Daftar akun baru</a></li>
		<?php else:?>
		<li class="dropdown">
			<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
				<img alt="image" src="<?= base_url();?>assets/img/avatar/avatar-<?= $avatar;?>.png"
					class="rounded-circle mr-1">
				<div class="d-sm-none d-lg-inline-block">Hi, <?= $this->session->userdata('nama');?></div>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<div class="dropdown-title">Login pada <?= $this->session->userdata('login_time');?> WIB</div>
				<?php if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 3):?>
				<a href="<?= site_url('admin');?>" class="dropdown-item has-icon">
					<i class="dripicons-device-desktop"></i> Dashboard
				</a>
				<?php else:?>
				<a href="<?= site_url('pengguna');?>" class="dropdown-item has-icon">
					<i class="dripicons-user"></i> Profil
				</a>
				<?php endif;?>
				<div class="dropdown-divider"></div>
				<a href="<?= site_url('logout');?>" class="dropdown-item has-icon text-danger">
					<i class="fas fa-sign-out-alt"></i> Logout
				</a>
			</div>
		</li>
		<?php endif;?>
	</ul>
</nav>



<div id="simpan-checkout" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Checkout keranjang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body p-4">
				<form action="<?= site_url('home/tambah_checkout');?>" method="post" enctype="multipart/form-data">
					<p>Checkout sebanyak <b><?= count($this->session->userdata('keranjang'));?></b> produk?</p>
					<h6>Produk anda:</h6>
					<ul>
						<?php foreach ($this->session->userdata('keranjang') as $val):?>
						<li><?= $val['produk'];?> + <?= $val['jumlah'];?> produk</li>
						<?php endforeach;?>
					</ul>
					<hr>
					<h6>Metode pembayaran</h6>
					<div class="form-group">
						<select class="form-control select2" name="metode" required>
							<option value="Shopeepay">Shopeepay</option>
							<option value="DANA">DANA</option>
							<option value="BCA">BCA</option>
							<option value="BRI">BRI</option>
							<option value="MANDIRI">MANDIRI</option>
						</select>
					</div>
					<div id="accordion">
						<div class="accordion">
							<div class="accordion-header" role="button" data-toggle="collapse"
								data-target="#metode-shopeepay">
								<h4>Shopeepay</h4>
							</div>
							<div class="accordion-body collapse" id="metode-shopeepay" data-parent="#accordion">
								<div class="row mb-2">
									<div class="col-5">
										<span class="text-muted font-weight-normal">Atas Nama</span>
									</div>
									<div class="col-7">
										<span class="text-dark font-weight-medium"><?= $shopeepay->value;?></span>
									</div>
								</div>
								<div class="row mb-2">
									<div class="col-5">
										<span class="text-muted font-weight-normal">Nomor E-Wallet</span>
									</div>
									<div class="col-7">
										<span class="text-dark font-weight-medium"><?= $shopeepay->desc;?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="accordion">
							<div class="accordion-header" role="button" data-toggle="collapse"
								data-target="#metode-dana">
								<h4>DANA</h4>
							</div>
							<div class="accordion-body collapse" id="metode-dana" data-parent="#accordion">
								<div class="row mb-2">
									<div class="col-5">
										<span class="text-muted font-weight-normal">Atas Nama</span>
									</div>
									<div class="col-7">
										<span class="text-dark font-weight-medium"><?= $dana->value;?></span>
									</div>
								</div>
								<div class="row mb-2">
									<div class="col-5">
										<span class="text-muted font-weight-normal">Nomor E-Wallet</span>
									</div>
									<div class="col-7">
										<span class="text-dark font-weight-medium"><?= $dana->desc;?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="accordion">
							<div class="accordion-header" role="button" data-toggle="collapse"
								data-target="#metode-bca">
								<h4>BCA</h4>
							</div>
							<div class="accordion-body collapse" id="metode-bca" data-parent="#accordion">
								<div class="row mb-2">
									<div class="col-5">
										<span class="text-muted font-weight-normal">Atas Nama</span>
									</div>
									<div class="col-7">
										<span class="text-dark font-weight-medium"><?= $bca->value;?></span>
									</div>
								</div>
								<div class="row mb-2">
									<div class="col-5">
										<span class="text-muted font-weight-normal">Nomor E-Wallet</span>
									</div>
									<div class="col-7">
										<span class="text-dark font-weight-medium"><?= $bca->desc;?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="accordion">
							<div class="accordion-header" role="button" data-toggle="collapse"
								data-target="#metode-bri">
								<h4>BRI</h4>
							</div>
							<div class="accordion-body collapse" id="metode-bri" data-parent="#accordion">
								<div class="row mb-2">
									<div class="col-5">
										<span class="text-muted font-weight-normal">Atas Nama</span>
									</div>
									<div class="col-7">
										<span class="text-dark font-weight-medium"><?= $bri->value;?></span>
									</div>
								</div>
								<div class="row mb-2">
									<div class="col-5">
										<span class="text-muted font-weight-normal">Nomor E-Wallet</span>
									</div>
									<div class="col-7">
										<span class="text-dark font-weight-medium"><?= $bri->desc;?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="accordion">
							<div class="accordion-header" role="button" data-toggle="collapse"
								data-target="#metode-mandiri">
								<h4>MANDIRI</h4>
							</div>
							<div class="accordion-body collapse" id="metode-mandiri" data-parent="#accordion">
								<div class="row mb-2">
									<div class="col-5">
										<span class="text-muted font-weight-normal">Atas Nama</span>
									</div>
									<div class="col-7">
										<span class="text-dark font-weight-medium"><?= $mandiri->value;?></span>
									</div>
								</div>
								<div class="row mb-2">
									<div class="col-5">
										<span class="text-muted font-weight-normal">Nomor E-Wallet</span>
									</div>
									<div class="col-7">
										<span class="text-dark font-weight-medium"><?= $mandiri->desc;?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<h6>Upload bukti pembayaran</h6>
					<div class="form-group">
						<label for="GETP_BUKTI" class="upload-card mx-auto">
							<img id="P_BUKTI" class="upload-img w-100 P_BUKTI cursor"
								src="<?= base_url() . 'assets/images/Pickanimage.png' ?>"
								alt="Placeholder">
						</label>
						<input type="file" id="GETP_BUKTI" class="form-control-file d-none" name="image"
							onchange="previewP_BUKTI(this);" accept="image/*">
						<small class="text-muted">Max 2Mb size, and use 1:1 ratio.</small>
					</div>
					<div class="form-group mt-3">
						<h6 for="inputKeteranganSayur" class="input-label h6">Tambahkan catatan <small
								class="text-secondary">(optional)</small></h6>
						<textarea class="form-control" name="catatan" id="inputKeteranganSayur" name="catatan" rows="5"
							style="height: 100px"></textarea>
					</div>
					<div class="modal-footer px-0 mx-0 mb-0 pb-0">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Checkout produk</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	$('form').submit(function (event) {
		$('#send-button').prop("disabled", true);
		// add spinner to button
		$('#send-button').html(
			`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> memuat...`
		);
		return;
	});

	function previewP_BUKTI(input) {
		$(".P_BUKTI").removeClass('hidden');
		var file = $("#GETP_BUKTI").get(0).files[0];

		if (file) {
			var reader = new FileReader();

			reader.onload = function () {
				$("#P_BUKTI").attr("src", reader.result);
			}

			reader.readAsDataURL(file);
		}
	}

</script>

<div id="delete-checkout" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Kosongkan keranjang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body p-4">
				<form action="<?= site_url('home/delete_checkout');?>" method="post" enctype="multipart/form-data">
					<p>Kosongkan sebanyak <b><?= count($this->session->userdata('keranjang'));?></b> produk dari
						keranjang anda?</p>
					<h6>Produk anda:</h6>
					<ul>
						<?php foreach ($this->session->userdata('keranjang') as $val):?>
						<li><?= $val['produk'];?> + <?= $val['jumlah'];?> produk</li>
						<?php endforeach;?>
					</ul>
					<div class="modal-footer px-0 mx-0 mb-0 pb-0">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Kosongkan keranjang</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Main Content -->
<div class="main-content"
	<?php if(empty($this->uri->segment(1)) || $this->uri->segment(1) == 'home' || $this->uri->segment(1) == 'pengguna'):?>
	style="padding-top:125px !important" <?php endif;?>>
	<section class="section">
