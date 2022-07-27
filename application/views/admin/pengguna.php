<div class="section-header">
	<h1>Pengguna</h1>
	<div class="section-header-breadcrumb">
		<div class="breadcrumb-item"><a href="<?= site_url('admin');?>">Dashboard</a></div>
		<div class="breadcrumb-item">Kelola data</div>
		<div class="breadcrumb-item active">Data Pengguna</div>
	</div>
</div>
<div class="section-body">
	<h2 class="section-title">Data pengguna</h2>
	<p class="section-lead">
		Kelola data pengguna yang telah mendaftar pada website di halaman ini
	</p>

	<div id="output-status"></div>
	<div class="row">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<h5 class="header-title pb-3 mt-0">Data Pengguna
						<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
							data-target="#decrypt"><?= $this->session->userdata('decrypt') == true ? 'encrypt' : 'decrypt' ;?></button>
					</h5>
					<div class="table-responsive">
						<table class="table table-hover table-striped dt-responsive nowrap"
							style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable-buttons">
							<thead>
								<tr class="align-self-center">
									<th width="5%" class="text-center">No</th>
									<th>Pengguna</th>
									<th>Email</th>
									<th>No Telepon</th>
									<th width="10%" class="text-center">Status</th>
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
										<?php if($this->session->userdata('decrypt') == false):?>
										<?= substr($val->nama, 0, 25);?>...
										<?php else:;?>
										<?= $val->nama;?>
										<?php endif;?>
									</td>
									<td>
										<?php if ($this->session->userdata('decrypt') == false):?>
										<?= substr($val->email, 0, 25);?>...
										<?php else:;?>
										<?= $val->email;?>
										<?php endif;?>
									</td>
									<td>

										<?php if ($this->session->userdata('decrypt') == false):?>
										<?= substr($val->no_telp, 0, 25);?>...
										<?php else:;?>
										<?= $val->no_telp;?>
										<?php endif;?>
									</td>
									<td class="text-center">
										<?php if($val->status == 0):?>
										<span class="badge badge-boxed badge-soft-secondary">belum aktivasi</span>
										<?php elseif($val->status == 1):?>
										<span class="badge badge-boxed badge-soft-success">active</span>
										<?php else:?>
										<span class="badge badge-boxed badge-soft-danger">tidak diketahui</span>
										<?php endif;?>
									</td>
									<td class="text-center">
										<button class="btn btn-primary btn-sm" data-toggle="modal"
											data-target="#edit-pengguna-<?= $val->user_id;?>"><i
												class="dripicons-document-edit"></i></button>
										<button class="btn btn-primary btn-sm" data-toggle="modal"
											data-target="#detail-pengguna-<?= $val->user_id;?>">detail</button>
									</td>

									<div id="detail-pengguna-<?= $val->user_id;?>" class="modal fade" tabindex="-1"
										role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Detail Pengguna</h5>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body p-4">
													<div class="media mb-4">
														<img class="d-flex mr-3 rounded-circle"
															src="<?= base_url();?><?= $val->profil;?>"
															alt="Generic placeholder image" height="64">
														<div class="media-body">
															<h5 class="mb-0 font-18"><?= $val->nama;?></h5>
															<p>Bergabung pada
																<?= date("d F Y - H:i", $val->created_at);?>
																WIB</p>
														</div>
													</div>

													<dl class="row mb-0">
														<dt class="col-sm-4">Email</dt>
														<dd class="col-sm-8"><a
																href="mailto:<?= $val->email;?>"><?= $val->email;?></a>
														</dd>

														<dt class="col-sm-4">Status Akun</dt>
														<dd class="col-sm-8">
															<?php if ($val->status == 0):?>
															<span class="badge badge-boxed badge-soft-secondary">belum
																aktivasi</span>
															<?php elseif ($val->status == 1):?>
															<span
																class="badge badge-boxed badge-soft-success">active</span>
															<?php else:?>
															<span class="badge badge-boxed badge-soft-danger">tidak
																diketahui</span>
															<?php endif;?>
														</dd>

														<dt class="col-sm-4">Jenis Kelamin</dt>
														<dd class="col-sm-8">
															<?= $val->jk == 'L' ? 'Laki-laki' : 'Perempuan';?></dd>

														<dt class="col-sm-4">No. Telepon</dt>
														<dd class="col-sm-8"><?= $val->no_telp;?></dd>

														<dt class="col-sm-4">Pekerjaan</dt>
														<dd class="col-sm-8"><?= $val->pekerjaan;?></dd>

														<dt class="col-sm-4">Gaji</dt>
														<dd class="col-sm-8"><?= $val->gaji;?></dd>

														<dt class="col-sm-4">Alamat</dt>
														<dd class="col-sm-8">
															<?= $val->alamat == null ? 'Belum melengkapi' : $val->alamat;?>
														</dd>
													</dl>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->

									<div id="edit-pengguna-<?= $val->user_id;?>" class="modal fade" tabindex="-1"
										role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Ubah Pengguna</h5>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="<?= site_url('admin/ubah_pengguna');?>" method="post">
														<input type="hidden" name="user_id"
															value="<?= $val->user_id;?>">
														<div class="form-group">
															<label for="inputNama">Nama pengguna</label>
															<input type="text" class="form-control" id="inputNama"
																name="nama" value="<?= $val->nama;?>" required>
														</div>
														<div class="form-group">
															<label for="inputEmail">Email pengguna</label>
															<input type="text" class="form-control" id="inputEmail"
																name="email" value="<?= $val->email;?>" required>
														</div>
														<div class="form-group">
															<label for="inputJk">Jenis kelamin</label>
															<select name="jk" id="inputJk" class="form-control"
																required>
																<optgroup label="current">
																	<option value="<?= $val->jk;?>">
																		<?= $val->jk == 'L' ? 'Laki-laki' : 'Perempuan';?>
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
															<input type="text" class="form-control" id="inputNomor"
																name="no_telp" value="<?= $val->no_telp;?>" required>
														</div>
														<div class="form-group">
															<label for="inputPekerjaan">Pekerjaan</label>
															<input type="text" class="form-control" id="inputPekerjaan"
																name="pekerjaan" value="<?= $val->pekerjaan;?>"
																required>
														</div>
														<div class="form-group">
															<label for="inputGaji">Gaji</label>
															<select name="gaji" id="inputGaji" class="form-control"
																required>
																<optgroup label="current">
																	<option value="<?= $val->gaji;?>"><?= $val->gaji;?>
																	</option>
																</optgroup>
																<optgroup label="change">
																	<option value="Dibawah < Rp 1.000.000">Dibawah < Rp
																			1.000.000</option> <option
																			value="Rp. 1.000.000 s/d 3.000.000">Rp.
																			1.000.000 s/d Rp. 3.000.000</option>
																	<option value="Rp. 3.000.000 s/d Rp 6.000.000">Rp.
																		3.000.000 s/d Rp 5.000.000</option>
																	<option value="Rp. 6.000.000 s/d Rp 10.000.000">Rp.
																		5.000.000 s/d Rp 10.000.000</option>
																	<option value="Diatas Rp 10.000.000">Diatas Rp
																		10.000.000</option>
																</optgroup>
															</select>
														</div>
														<div class="form-group">
															<label for="inputAlamat">Alamat</label>
															<textarea type="text" class="form-control" id="inputAlamat"
																name="alamat" style="height: 150px;"
																required><?= $val->alamat;?></textarea>
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


<div id="decrypt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					<?= $this->session->userdata('decrypt') == true ? 'Encrypt' : 'Decrypt' ;?> data pengguna</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('admin/decrypt');?>" method="post">
					<p>Apakah anda yakin ingin
						men-<i><?= $this->session->userdata('decrypt') == true ? 'encrypt' : 'decrypt' ;?></i> data
						pengguna?</p>
					<div class="form-group">
						<input type="text" class="form-control" maxlength="16" minlength="16" name="kode"
							placeholder="Masukkan kode untuk melanjutkan" required>
					</div>
					<div class="modal-footer px-0 mx-0">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit"
							class="btn btn-primary"><?= $this->session->userdata('decrypt') == true ? 'Encrypt' : 'Decrypt' ;?>
							data</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
