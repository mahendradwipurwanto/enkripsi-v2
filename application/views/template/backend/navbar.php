<nav class="navbar navbar-expand-lg main-navbar">
<ul class="navbar-nav navbar-right ml-auto">
	<?php if($this->session->userdata('logged_in') || $this->session->userdata('logged_in') == true):?>
	<?php if($this->session->userdata('role') == 2):?>
	<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
			class="nav-link notification-toggle nav-link-lg beep"><i class="dripicons-cart"></i></a>
		<div class="dropdown-menu dropdown-list dropdown-menu-right">
			<div class="dropdown-header">Keranjang anda</div>
			<div class="dropdown-list-content dropdown-list-icons">
				<?php if($this->session->userdata('keranjang')):?>
				<?php foreach($this->session->userdata('keranjang') as $val):?>
				<a href="javascript:void(0);" class="dropdown-item">
					<div class="dropdown-item-icon bg-info text-white">
						<i class="fas fa-bell"></i>
					</div>
					<div class="dropdown-item-desc">
						<b><?= $val['produk'];?></b> Menambahkan <?= $val['jumlah'];?> <?= $val['produk'];?>
						ke
						keranjang anda</small>
						<div class="time">Yesterday</div>
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
				<a href="javascript:void(0);" class="dropdown-item" data-toggle="modal"
					data-target="#simpan-checkout">Checkout keranjang <i class="dripicons-cart"></i></a>
			</div>
			<?php endif;?>
		</div>
	</li>
	<?php endif;?>
	<?php endif;?>
	<?php if(!$this->session->userdata('logged_in') || $this->session->userdata('logged_in') == false):?>
	<li class="ml-2"><a href="<?= site_url('login');?>" class="btn btn-outline-light btn-sm">Masuk ke akun
			anda</a></li>
	<li class="ml-3"><a href="<?= site_url('register');?>" class="btn btn-light btn-sm">Daftar akun baru</a>
	</li>
	<?php else:?>
	<li class="dropdown">
		<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
			<img alt="image" src="<?= base_url();?>assets/img/avatar/avatar-<?= $avatar;?>.png"
				class="rounded-circle mr-1">
			<div class="d-sm-none d-lg-inline-block">Hi, <?= $this->session->userdata('nama');?></div>
		</a>
		<div class="dropdown-menu dropdown-menu-right">
			<div class="dropdown-title">Login pada <?= $this->session->userdata('login_time');?> WIB</div>
			<?php if($this->session->userdata('role') == 1):?>
			<a href="<?= site_url('admin');?>" class="dropdown-item has-icon">
				<i class="dripicons-device-desktop"></i> Dashboard
			</a>
			<?php else:?>
			<a href="<?= site_url('pengguna');?>" class="dropdown-item has-icon">
				<i class="dripicons-user"></i> Profil
			</a>
			<a href="<?= site_url('pengguna');?>" class="dropdown-item has-icon">
				<i class="dripicons-ticket"></i> Riwayat transaksi
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
