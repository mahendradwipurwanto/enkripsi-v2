<div class="section-header">
	<h1>Pengguna</h1>
	<div class="section-header-breadcrumb">
		<div class="breadcrumb-item active"><a href="<?= site_url('admin');?>">Dashboard</a></div>
	</div>
</div>
<div class="section-body">
	<div class="row">
		<div class="col-xl-4">
			<div class="card profile-widget">
				<div class="profile-widget-header">
					<img alt="image" src="<?= base_url();?>assets/img/avatar/avatar-1.png"
						class="rounded-circle profile-widget-picture">
					<div class="profile-widget-items">
						<div class="profile-widget-item">
							<div class="profile-widget-item-label">Bergabung</div>
							<div class="profile-widget-item-value">187</div>
						</div>
						<div class="profile-widget-item">
							<div class="profile-widget-item-label">Terakhir login</div>
							<div class="profile-widget-item-value">6,8K</div>
						</div>
						<div class="profile-widget-item">
							<div class="profile-widget-item-label">Total transaksi</div>
							<div class="profile-widget-item-value">2,1K</div>
						</div>
					</div>
				</div>
				<div class="profile-widget-description">
					<div class="profile-widget-name">Ujang Maman <div class="text-muted d-inline font-weight-normal">
							<div class="slash"></div> Web Developer
						</div>
					</div>
					Ujang maman is a superhero name in <b>Indonesia</b>, especially in my family. He is not a fictional
					character but an original hero in my family, a hero for his children and for his wife. So, I use the
					name as a user in this template. Not a tribute, I'm just bored with <b>'John Doe'</b>.
				</div>
			</div>
		</div>
		<div class="col-xl-8">
			<div class="card">
				<div class="card-body">
					<h5 class="header-title pb-3 mt-0">Data produk yang ingin dipesan</h5>
					<div class="table-responsive">
						<table class="table table-hover table-striped dt-responsive nowrap"
							style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable-buttons">
							<thead>
								<tr class="align-self-center">
									<th width="10%" class="text-center">Tanggal</th>
									<th>Jumlah checkout produk</th>
									<th> </th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($checkout)):?>
								<?php foreach($checkout as $val):?>
								<tr>
									<td class="text-center"><?= date("d F Y", $val['created_at']);?></td>
									<td><?= number_format(count($val['keranjang']));?> produk</td>
									<td width="10%" class="text-center"><button class="btn btn-primary btn-sm"
											data-toggle="modal"
											data-target="#detail-checkout-<?= $val['id'];?>">detail</button></td>

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
														<?php foreach($val['keranjang'] as $item):?>
														<dt class="col-sm-3">Produk</dt>
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
