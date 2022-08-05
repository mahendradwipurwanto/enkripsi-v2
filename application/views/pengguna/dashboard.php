<div class="section-header">
	<h1>Pengguna</h1>
	<div class="section-header-breadcrumb">
		<div class="breadcrumb-item active"><a href="<?= site_url('pengguna');?>">Dashboard</a></div>
	</div>
</div>
<div class="section-body">
	<div class="row">
		<div class="col-xl-4">
			<div class="card profile-widget">
				<div class="profile-widget-header">
					<img alt="image" src="<?= base_url();?>assets/img/avatar/avatar-<?= $avatar;?>.png"
						class="rounded-circle profile-widget-picture">
					<div class="profile-widget-items">
						<div class="profile-widget-item">
							<div class="profile-widget-item-label">Bergabung</div>
							<div class="profile-widget-item-value"><?= date('d/m/Y', $user->created_at);?></div>
						</div>
						<div class="profile-widget-item">
							<div class="profile-widget-item-label">Terakhir login</div>
							<div class="profile-widget-item-value"><?= date('H:i', $user->modified_at);?> WIB</div>
						</div>
						<div class="profile-widget-item">
							<div class="profile-widget-item-label">Total transaksi</div>
							<div class="profile-widget-item-value"><?= number_format(count($checkout));?></div>
						</div>
					</div>
				</div>
				<div class="profile-widget-description">
					<div class="profile-widget-name"><?= $user->nama;?></div>
					<div class="list-unstyled list-unstyled-border">
						<div class="media">
							<div class="media-body w-100">
								<h6 class="mb-1">Email</h6>
								<p><?= $user->email;?></p>
							</div>
						</div>
						<div class="media">
							<div class="media-body w-100">
								<h6 class="mb-1">Jenis Kelamin</h6>
								<p><?= $user->jk == 'L' ? 'Laki-laki' : 'Perempuan';?></p>
							</div>
						</div>
						<div class="media">
							<div class="media-body w-100">
								<h6 class="mb-1">Nomor Telepon</h6>
								<p><?= $user->no_telp;?></p>
							</div>
						</div>
						<div class="media">
							<div class="media-body w-100">
								<h6 class="mb-1">Pekerjaan</h6>
								<p><?= $user->pekerjaan;?></p>
							</div>
						</div>
						<div class="media">
							<div class="media-body w-100">
								<h6 class="mb-1">Gaji</h6>
								<p><?= $user->gaji;?></p>
							</div>
						</div>
						<div class="media">
							<div class="media-body w-100">
								<h6 class="mb-1">Alamat</h6>
								<p><?= $user->alamat == null ? 'Belum melengkapi' : $user->alamat;?></p>
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-primary btn-sm float-right mr-2" data-toggle="modal"
						data-target="#ubah-pengguna">ubah data diri</button>
				</div>
			</div>
		</div>
		<div class="col-xl-8">
			<div class="card">
				<div class="card-body">
					<h5 class="header-title pb-3 mt-0">Data transaksi pengguna</h5>
					<div class="table-responsive">
						<table class="table table-hover table-striped dt-responsive nowrap"
							style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable-buttons">
							<thead>
								<tr class="align-self-center">
									<th class="text-center">Tanggal</th>
									<th>Jumlah produk</th>
									<th>Metode Pembayaran</th>
									<th>Bukti Pembayaran</th>
									<th width="5%">Status</th>
									<th> </th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($checkout)):?>
								<?php foreach($checkout as $val):?>
								<tr>
									<td class="text-center"><?= date("d F Y", $val['created_at']);?></td>
									<td><?= number_format(count($val['keranjang']));?> produk</td>
									<td><?= $val['metode'];?></td>
									<td width="10%" class="text-center">
										<?php if(isset($val['bukti_bayar']) && $val['bukti_bayar'] != '-'):?>
										<button class="btn btn-primary btn-sm" data-toggle="modal"
											data-target="#bukti-bayar-<?= $val['id'];?>">lihat</button>
										<?php else:?>
										-
										<?php endif;?>
									</td>
									<td>
										<?php if($val['status'] == 1):?>
										<span class="badge badge-secondary">Menunggu diverifikasi</span>
										<?php else:?>
										<span class="badge badge-success">Sudah diverifikasi</span>
										<?php endif;?>
									</td>
									<td width="10%" class="text-center"><button class="btn btn-primary btn-sm"
											data-toggle="modal"
											data-target="#detail-checkout-<?= $val['id'];?>">detail</button></td>

									<div id="bukti-bayar-<?= $val['id'];?>" class="modal fade" tabindex="-1"
										role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Bukti pembayaran</h5>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body p-4">
													<img src="<?= base_url();?><?= $val['bukti_bayar'];?>"
														class="w-100 h-auto" alt="">
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->

									<div id="detail-checkout-<?= $val['id'];?>" class="modal fade" tabindex="-1"
										role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Detail checkout</h5>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body p-4">
													<dl class="row mb-0">
														<?php $noo = 1;foreach($val['keranjang'] as $item):?>
														<dt class="col-sm-3">Produk
															<?= count($val['keranjang']) > 1 ? $noo++ : '';?></dt>
														<dd class="col-sm-9"><?= $item->produk;?> -
															<?= number_format($item->jumlah);?> buah</dd>
														<?php endforeach;?>
														<hr>
														<dt class="col-sm-3">Catatan</dt>
														<dd class="col-sm-9"><?= $val['catatan'];?></dd>
													</dl>
													<hr>
													<small class="text-secondary">Checkout pada
														<?= date("d F Y - H:i", $val['created_at']);?> WIB</small>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
								</tr>
								<?php endforeach;?>
								<?php endif;?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="dekripsi-dulu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('pengguna/decrypt');?>" method="post">
					<p>Decrypt data terlebih dahulu untuk mengubah data diri</p>
					<div class="modal-footer px-0 mx-0">
						<button type="button" class="btn btn-primary w-100" data-dismiss="modal">Oke</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="decrypt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					<?= $this->session->userdata('decrypt') == true ? 'Encrypt' : 'Decrypt' ;?> data diri</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('pengguna/decrypt');?>" method="post">
					<p>Apakah anda yakin ingin
						men-<i><?= $this->session->userdata('decrypt') == true ? 'encrypt' : 'decrypt' ;?></i> data diri
						anda?</p>
					<div class="modal-footer px-0 mx-0">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit"
							class="btn btn-primary"><?= $this->session->userdata('decrypt') == true ? 'Encrypt' : 'Decrypt' ;?>
							data diri</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="ubah-pengguna" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ubah data diri</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('admin/ubah_pengguna');?>" method="post">
					<input type="hidden" name="user_id" value="<?= $user->user_id;?>">
					<div class="form-group">
						<label for="inputNama">Nama pengguna</label>
						<input type="text" class="form-control" id="inputNama" name="nama" value="<?= $user->nama;?>"
							required>
					</div>
					<div class="form-group">
						<label for="inputEmail">Email pengguna</label>
						<input type="text" class="form-control" id="inputEmail" name="email" value="<?= $user->email;?>"
							required>
					</div>
					<div class="form-group">
						<label for="inputJk">Jenis kelamin</label>
						<select name="jk" id="inputJk" class="form-control" required>
							<optgroup label="current">
								<option value="<?= $user->jk;?>"><?= $user->jk == 'L' ? 'Laki-laki' : 'Perempuan';?>
								</option>
							</optgroup>
							<optgroup label="change">
								<option value="L">Laki-Laki</option>
								<option value="P">Perempuan</option>
							</optgroup>
						</select>
					</div>
					<div class="form-group">
						<label for="inputNomor">Nomor telepon pengguna</label>
						<input type="text" class="form-control" id="inputNomor" name="no_telp"
							value="<?= $user->no_telp;?>" required>
					</div>
					<div class="form-group">
						<label for="inputPekerjaan">Pekerjaan</label>
						<input type="text" class="form-control" id="inputPekerjaan" name="pekerjaan"
							value="<?= $user->pekerjaan;?>" required>
					</div>
					<div class="form-group">
						<label for="inputGaji">Gaji</label>
						<select name="gaji" id="inputGaji" class="form-control" required>
							<optgroup label="current">
								<option value="<?= $user->gaji;?>"><?= $user->gaji;?></option>
							</optgroup>
							<optgroup label="change">
								<option value="Dibawah < Rp 1.000.000">Dibawah < Rp 1.000.000</option> <option
										value="Rp. 1.000.000 s/d 3.000.000">Rp. 1.000.000 s/d Rp. 3.000.000</option>
								<option value="Rp. 3.000.000 s/d Rp 6.000.000">Rp. 3.000.000 s/d Rp 5.000.000</option>
								<option value="Rp. 6.000.000 s/d Rp 10.000.000">Rp. 5.000.000 s/d Rp 10.000.000</option>
								<option value="Diatas Rp 10.000.000">Diatas Rp 10.000.000</option>
							</optgroup>
						</select>
					</div>
					<div class="form-group">
						<label for="inputAlamat">Alamat</label>
						<textarea type="text" class="form-control" id="inputAlamat" name="alamat" style="height: 150px;" required><?= $user->alamat;?></textarea>
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
