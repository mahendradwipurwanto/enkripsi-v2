<!-- Hero -->
<div class="section-header">
	<h1>Temukan produk pilihan yang kamu inginkan</h1>
</div>
<!-- Pencarian -->
<div class="row justify-content-center mb-5">
	<div class="col-6">
		<form action="<?= base_url();?>" method="get" id="form-search">
			<div class="input-group input-group-lg input-group-rounded">
				<input type="text" class="form-control form-control-rounded" aria-label="Large" name="cari"
					aria-describedby="inputGroup-sizing-sm"
					placeholder="<?= $this->input->get('cari') ? $this->input->get('cari') : 'Masukkan kata kunci';?>">
				<?php if($this->input->get('cari')):?>
				<div class="input-group-append input-group-append-rounded">
					<span class="input-group-text input-group-text-rounded cursor" id="inputGroup-sizing-lg"
						onclick="resetSearch()"><i class="dripicons-trash"></i></span>
				</div>
				<?php else:?>
				<div class="input-group-append input-group-append-rounded">
					<span class="input-group-text input-group-text-rounded cursor" id="inputGroup-sizing-lg"
						onclick="submitSearch()"><i class="dripicons-search"></i></span>
				</div>
				<?php endif;?>
			</div>
		</form>
		<?php if($this->input->get('cari')):?>
		<span class="mt-5">Menemukan <?= count($produk);?> produk dari pencarian</span>
		<?php endif;?>
	</div>
</div>

<!-- Content -->
<div class="row justify-content-center">
	<?php if(empty($produk)):?>
	<?php if($this->input->get('cari')):?>
	<h5 class="text-cente font-weight-normal">Tidak dapat menemukan produk dengan kata kunci
		<b class="text-primary"><?= $this->input->get('cari');?></b></h5>
	<?php else:?>
	<h3 class="text-center">Belum ada produk</h3>
	<?php endif;?>
	<?php else:?>
	<?php foreach($produk as $val):?>

	<div class="col-12 col-sm-6 col-md-6 col-lg-3">
		<article class="article article-style-b">
			<div class="article-header">
				<div class="article-image" data-background="<?= base_url();?><?= $val->gambar;?>">
				</div>
				<?php if($val->stok > 0):?>
				<div class="article-title">
					<h2 class="text-white mb-0"><span>Rp. <?= number_format($val->harga);?></span><span
							class="float-right">stok: <?= number_format($val->stok);?></span></h2>
				</div>
				<?php else:?>
				<div class="article-badge">
					<div class="article-badge-item bg-danger"><i class="fas fa-fire"></i> Habis terjual</div>
				</div>
				<?php endif;?>
			</div>
			<div class="article-details p-3">
				<div class="article-title">
					<h2><a><?= $val->produk;?></a></h2>
				</div>
				<p><?= $val->keterangan;?></p>
				<div class="article-cta text-center">
					<?php if($val->stok > 0):?>
					<?php if($this->session->userdata('logged_in') == false || !$this->session->userdata('logged_in')):?>
					<a href="<?= site_url('login');?>" class="btn btn-primary btn-sm">Tambahkan ke keranjang</a>
					<?php else:?>
					<?php if($this->session->userdata('role') == 2):?>
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
						data-target="#tambah-checkout-<?= $val->id;?>">Tambahkan ke keranjang</button>
					<?php else:?>
					<a href="<?= site_url('logout');?>" class="btn btn-primary btn-sm">Login ke akun pengguna</a>
					<?php endif;?>
					<?php endif;?>
					<?php endif;?>
				</div>
			</div>
		</article>
	</div>

	<div id="tambah-checkout-<?= $val->id;?>" class="modal fade" tabindex="-1" role="dialog"
		aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah checkout</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body p-4">
					<form action="<?= site_url('home/add_cartWish');?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?= $val->id;?>" required>
						<input type="hidden" name="produk" value="<?= $val->produk;?>" required>
						<input type="hidden" name="gambar" value="<?= base_url();?><?= $val->gambar;?>" required>
						<p>Tambahkan <b><?= $val->produk;?></b> kedalam checkout anda, lengkapi data dibawah ini untuk
							melanjutkan</p>
						<div class="form-group">
							<label for="inputNamaProduk" class="input-label">Jumlah yang diinginkan <small
									class="text-danger">*</small></label>
							<div class="input-group">
								<input type="number" class="form-control" placeholder="Masukkan jumlah produk"
									name="jumlah" required>
								<div class="input-group-append">
									<span class="input-group-text" id="inputGroup-sizing-lg">buah</span>
								</div>
							</div>
						</div>
						<div class="modal-footer px-0 mx-0">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Tambahkan keranjang</button>
						</div>
					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<?php endforeach;?>
	<?php endif;?>
</div>

<script>
	function submitSearch() {
		var form = document.getElementById("form-search");

		form.submit();
	}

	function resetSearch() {
		window.location.href = '<?= base_url();?>';
	}

</script>
