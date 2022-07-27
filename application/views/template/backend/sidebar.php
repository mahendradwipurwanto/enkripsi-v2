<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<img src="<?= base_url();?>assets/images/logo.png" class="nav-logo" alt="">
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="index.html">St</a>
		</div>
		<ul class="sidebar-menu">
			<li class="menu-header">Dashboard</li>
			<li><a class="nav-link" href="<?= base_url('admin') ?>"><i class="dripicons-device-desktop"></i>
					<span>Dashboard</span></a></li>
			<li class="menu-header">Kelola data</li>
			<?php if($this->session->userdata('role') == 1):?>
			<li><a class="nav-link" href="<?= base_url('admin/data-operator') ?>"><i class="dripicons-user"></i>
					<span>Data Operator</span></a></li>
			<li><a class="nav-link" href="<?= base_url('admin/data-pengguna') ?>"><i class="dripicons-user-group"></i>
					<span>Data Pengguna</span></a></li>
			<?php endif;?>
			<li><a class="nav-link" href="<?= base_url('admin/kelola-produk') ?>"><i class="dripicons-to-do"></i>
					<span>Kelola Produk</span></a></li>
			<?php if($this->session->userdata('role') == 1):?>
			<li class="menu-header">Pengaturan</li>
			<li><a class="nav-link" href="<?= base_url('admin/pengaturan') ?>"><i class="dripicons-brush"></i>
					<span>Pengaturan</span></a></li>
			<?php endif;?>
		</ul>
	</aside>
</div>
<!-- Main Content -->
<div class="main-content"
	<?php if(empty($this->uri->segment(1)) || $this->uri->segment(1) == 'home'):?>style="padding-top:125px !important"
	<?php endif;?>>
	<section class="section">
