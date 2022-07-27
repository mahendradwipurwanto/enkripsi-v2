<div class="section-header">
	<h1>Operator</h1>
	<div class="section-header-breadcrumb">
		<div class="breadcrumb-item"><a href="<?= site_url('admin');?>">Dashboard</a></div>
		<div class="breadcrumb-item">Kelola data</div>
		<div class="breadcrumb-item active">Data Operator</div>
	</div>
</div>
<div class="section-body">
	<h2 class="section-title">Data operator</h2>
	<p class="section-lead">
		Kelola data operator yang ada pada website di halaman ini
	</p>

	<div id="output-status"></div>
	<div class="row">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<h5 class="header-title pb-3 mt-0">Data Operator
						<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
							data-target="#tambah-pengguna">Tambah operator</button>
					</h5>
					<div class="table-responsive">
						<table class="table table-hover table-striped dt-responsive nowrap"
							style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable-buttons">
							<thead>
								<tr class="align-self-center">
									<th width="5%" class="text-center">No</th>
									<th>Operator</th>
									<th>Email</th>
									<th width="10%" class="text-center"> </th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($pengguna)):?>
								<?php $no = 1; foreach($pengguna as $val):?>
								<tr>
									<td class="text-center"><?= $no++;?></td>
									<td>
										<img src="<?= base_url();?><?= $val->profil;?>" alt=""
											class="thumb-sm rounded-circle mr-2">
										<?= $val->nama;?>
									</td>
									<td><?= $val->email;?></td>
									<td class="text-center">
										<button class="btn btn-primary btn-sm" data-toggle="modal"
											data-target="#edit-pengguna-<?= $val->user_id;?>"><i
												class="dripicons-document-edit"></i></button>
										<button class="btn btn-danger btn-sm" data-toggle="modal"
											data-target="#hapus-pengguna-<?= $val->user_id;?>">hapus</button>
									</td>

									<div id="edit-pengguna-<?= $val->user_id;?>" class="modal fade" tabindex="-1"
										role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Ubah Operator</h5>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="<?= site_url('admin/ubah_operator');?>" method="post">
														<input type="hidden" name="user_id"
															value="<?= $val->user_id;?>">
														<div class="form-group">
															<label for="inputNama">Nama operator</label>
															<input type="text" class="form-control" id="inputNama"
																name="nama" value="<?= $val->nama;?>" required>
														</div>
														<div class="form-group">
															<label for="inputEmail">Email operator</label>
															<input type="text" class="form-control" id="inputEmail"
																name="email" value="<?= $val->email;?>" required>
														</div>
														<div class="form-group">
															<label for="inputPassword">Password</label>
															<input type="password" class="form-control" id="inputPassword"
																name="password" placeholder="" >
														</div>
														<div class="modal-footer px-0 mx-0">
															<button type="button" class="btn btn-secondary"
																data-dismiss="modal">Batal</button>
															<button type="submit"
																class="btn btn-primary">Simpan</button>
														</div>
													</form>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->

									<div id="hapus-pengguna-<?= $val->user_id;?>" class="modal fade" tabindex="-1"
										role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Hapus Operator</h5>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="<?= site_url('admin/hapus_operator');?>"
														method="post">
														<input type="hidden" name="user_id"
															value="<?= $val->user_id;?>">
														<p>Apakah anda yakin ingin menghapus operator ini?</p>
														<div class="modal-footer px-0 mx-0">
															<button type="button" class="btn btn-secondary"
																data-dismiss="modal">Batal</button>
															<button type="submit" class="btn btn-danger">Ya</button>
														</div>
													</form>
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


<div id="tambah-pengguna" class="modal fade" tabindex="-1" role="dialog"
	aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Operator</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('admin/tambah_operator');?>" method="post">
					<div class="form-group">
						<label for="inputNama">Nama operator</label>
						<input type="text" class="form-control" id="inputNama" name="nama" placeholder="Masukkan data"
							required>
					</div>
					<div class="form-group">
						<label for="inputEmail">Email operator</label>
						<input type="text" class="form-control" id="inputEmail" name="email" placeholder="Masukkan data"
							required>
					</div>
					<div class="form-group">
						<label for="inputPassword">Password</label>
						<input type="password" class="form-control" id="inputPassword" name="password"
							placeholder="Masukkan data" required>
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
