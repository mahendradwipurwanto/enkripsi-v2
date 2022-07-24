<div class="section-header">
	<h1>Kelola Data Produk</h1>
	<div class="section-header-breadcrumb">
		<div class="breadcrumb-item"><a href="<?= site_url('admin');?>">Dashboard</a></div>
		<div class="breadcrumb-item">Kelola data</div>
		<div class="breadcrumb-item active">Kelola Data Produk</div>
	</div>
</div>
<div class="section-body">
	<h2 class="section-title">Data produk</h2>
	<p class="section-lead">
		Kelola semua data produk diwebsitemu
	</p>

	<div id="output-status"></div>
	<div class="row">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<h5 class="header-title pb-3 mt-0">Data Produk
						<button type="button" class="btn btn-primary float-right" data-toggle="modal"
							data-target="#tambah">Tambah produk</button></h5>
					<div class="table-responsive">
						<table class="table table-hover table-striped dt-responsive nowrap"
							style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable-buttons">
							<thead>
								<tr class="align-self-center">
									<th width="5%" class="text-center">No</th>
									<th width="10%"> </th>
									<th>Produk</th>
									<th>Harga</th>
									<th>Stok</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($produk)):?>
								<?php $no = 1; foreach($produk as $val):?>
								<tr>
									<td class="text-center"><?= $no++;?></td>
									<td>
										<button class="btn btn-primary btn-sm" data-toggle="modal"
											data-target="#edit-<?= $val->id;?>">edit</button>
										<button class="btn btn-danger btn-sm" data-toggle="modal"
											data-target="#hapus-<?= $val->id;?>">hapus</button>
									</td>
									<td>
										<img src="<?= base_url();?><?= $val->gambar;?>" alt=""
											class="thumb-sm rounded-circle mr-2">
										<?= $val->produk;?>
									</td>
									<td>Rp. <?= number_format($val->harga);?></td>
									<td><?= number_format($val->stok);?> buah</td>
									<td><button class="btn btn-primary btn-sm" data-toggle="modal"
											data-target="#keterangan-<?= $val->id;?>">keterangan</button></td>
								</tr>


								<div id="edit-<?= $val->id;?>" class="modal fade" tabindex="-1" role="dialog"
									aria-labelledby="mySmallModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Edit produk</h5>
												<button type="button" class="close" data-dismiss="modal"
													aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form action="<?= site_url('admin/edit_produk');?>" method="post"
													enctype="multipart/form-data">
													<input type="hidden" name="id" value="<?= $val->id;?>" required>

													<div class="form-group">
														<label for="inputNamaProduk" class="input-label">Nama Produk
															<small class="text-danger">*</small></label>
														<input type="text" class="form-control" id="inputNamaProduk"
															name="produk" value="<?= $val->produk;?>" required>
													</div>
													<div class="form-group">
														<label for="inputNamaProduk" class="input-label">Gambar Produk
															<small class="text-secondary">(optional)</small></label>
														<input type="file" name="image" class="form-control">
													</div>
													<div class="form-group">
														<label for="inputNamaProduk" class="input-label">Harga Produk
															<small class="text-danger">*</small></label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text"
																	id="inputGroup-sizing-lg">Rp.</span>
															</div>
															<input type="number" class="form-control"
																value="<?= $val->harga;?>" name="harga" required>
														</div>
													</div>
													<div class="form-group">
														<label for="inputNamaProduk" class="input-label">Stok Produk
															<small class="text-danger">*</small></label>
														<div class="input-group">
															<input type="number" class="form-control" name="stok"
																value="<?= $val->stok;?>" required>
															<div class="input-group-append">
																<span class="input-group-text"
																	id="inputGroup-sizing-lg">buah</span>
															</div>
														</div>
													</div>
													<div class="form-group">
														<label for="inputKeteranganProduk"
															class="input-label">Keterangan <small
																class="text-secondary">(optional)</small></label>
														<textarea class="form-control" name="keterangan"
															id="inputKeteranganProduk"
															rows="5"><?= $val->keterangan;?></textarea>
													</div>
													<div class="modal-footer px-0 mx-0">
														<button type="button" class="btn btn-secondary"
															data-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-primary">Edit</button>
													</div>
												</form>
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->

								<div id="hapus-<?= $val->id;?>" class="modal fade" tabindex="-1" role="dialog"
									aria-labelledby="mySmallModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Hapus produk</h5>
												<button type="button" class="close" data-dismiss="modal"
													aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form action="<?= site_url('admin/hapus_produk');?>" method="post">
													<input type="hidden" name="id" value="<?= $val->id;?>" required>
													<p>Apakah anda yakin ingin menghapus produk, <b>Kentang</b>?</p>
													<div class="modal-footer px-0 mx-0">
														<button type="button" class="btn btn-secondary"
															data-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-danger">Hapus</button>
													</div>
												</form>
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->

								<div id="keterangan-<?= $val->id;?>" class="modal fade" tabindex="-1" role="dialog"
									aria-labelledby="mySmallModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Keterangan produk</h5>
												<button type="button" class="close" data-dismiss="modal"
													aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<p><?= $val->keterangan == null ? 'Tidak ada' : $val->keterangan;?></p>
												<div class="modal-footer px-0 mx-0">
													<button type="button" class="btn btn-secondary"
														data-dismiss="modal">Batal</button>
												</div>
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->

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



<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah produk</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('admin/tambah_produk');?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="inputNamaProduk" class="input-label">Nama Produk <small
								class="text-danger">*</small></label>
						<input type="text" class="form-control" id="inputNamaProduk" name="produk"
							placeholder="Masukkan nama produk" required>
					</div>
					<div class="form-group">
						<label for="inputNamaProduk" class="input-label">Gambar Produk <small
								class="text-secondary">(optional)</small></label>
						<input type="file" id="input-file-now" name="image" class="dropify">
					</div>
					<div class="form-group">
						<label for="inputNamaProduk" class="input-label">Harga Produk <small
								class="text-danger">*</small></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-lg">Rp.</span>
							</div>
							<input type="number" class="form-control" name="harga" placeholder="Masukkan harga produk"
								required>
						</div>
					</div>
					<div class="form-group">
						<label for="inputNamaProduk" class="input-label">Stok Produk <small
								class="text-danger">*</small></label>
						<div class="input-group">
							<input type="number" class="form-control" name="stok" placeholder="Masukkan stok produk"
								required>
							<div class="input-group-append">
								<span class="input-group-text" id="inputGroup-sizing-lg">buah</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="inputKeteranganProduk" class="input-label">Keterangan <small
								class="text-secondary">(optional)</small></label>
						<textarea class="form-control" name="keterangan" id="inputKeteranganProduk" rows="5"></textarea>
					</div>
					<div class="modal-footer px-0 mx-0">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Tambah</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
