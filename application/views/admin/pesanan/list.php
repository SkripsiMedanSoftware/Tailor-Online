<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<div class="box-body">
		<?php 
		if ($this->session->flashdata('flash_message'))
		{
			?>
				<div class="alert alert-<?php echo $this->session->flashdata('flash_message')['status'] ?> alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo $this->session->flashdata('flash_message')['message'] ?>
				</div>
			<?php
		}
		?>
		<table class="table table-hover table-striped datatable">
			<thead>
				<th>No</th>
				<th>ID</th>
				<th>Tanggal Pemesanan</th>
				<th>Estimasi Pengerjaan</th>
				<th>catatan</th>
				<th>Bayaran</th>
				<th>Status Pemesanan</th>
				<th>Status Pembayaran</th>
				<th>Opsi</th>
			</thead>
			<tbody>
				<?php
				if (!empty($pesanan)) {
					foreach ($pesanan as $key => $value) {
				?>
				<tr>
					<td><?php echo $key+=1; ?></td>
					<td><?php echo $value['uid']; ?></td>
					<td><?php echo nice_date($value['tanggal_pemesanan'], 'l, d F Y') ?></td>
					<td><?php echo (!empty($value['estimasi_pengerjaan']))?$value['estimasi_pengerjaan']:'-'; ?></td>
					<td><?php echo (!empty($value['catatan']))?$value['catatan']:'-'; ?></td>
					<td>Rp.<?php echo number_format($value['harga'], 0, ',', '.') ?></td>
					<td>
						<?php if ($value['status'] == 'menunggu-konfirmasi') : ?>
							<a href="<?php echo base_url('admin/update_status_pesanan/'.$value['id'].'/diterima') ?>" class="btn btn-xs btn-success">Terima Pesanan</a>
							<a href="<?php echo base_url('admin/update_status_pesanan/'.$value['id'].'/ditolak') ?>" class="btn btn-xs btn-danger">Tolak Pesanan</a>
						<?php else : ?>
							<?php
							switch ($value['status']) {
								case 'diterima': 
									?><a class="btn btn-xs btn-info"><?php echo ucfirst($value['status']) ?></a><?php
								break;

								case 'ditolak': 
									?><a class="btn btn-xs btn-danger"><?php echo ucfirst($value['status']) ?></a><?php
								break;

								case 'dibatalkan': 
									?><a class="btn btn-xs btn-danger"><?php echo ucfirst($value['status']) ?></a><?php
								break;

								case 'dalam-proses': 
									?><a class="btn btn-xs btn-primary"><?php echo ucfirst($value['status']) ?></a><?php
								break;
								
								default:
									?><a class="btn btn-xs btn-success"><?php echo ucfirst($value['status']) ?></a><?php
								break;
							}
							?>
						<?php endif; ?>
					</td>
					<td>
						<?php 
						switch ($value['status_pembayaran']) {
							case 'belum-lunas':
								?><button class="btn btn-xs btn-danger">Belum Dibayar</button><?php
							break;

							case 'pending':
								?><button class="btn btn-xs btn-warning">Pending</button><?php
							break;

							default:
								echo $value['status_pembayaran'];
							break;
						}
						?>
					</td>
					<td>
						<a class="btn btn-sm btn-flat btn-info" href="<?php echo base_url('admin/pesanan/detail/'.$value['id']) ?>">Detail</a>
						<a class="btn btn-sm btn-flat btn-primary" href="<?php echo base_url('admin/pesanan/update/'.$value['id']) ?>">Edit</a>
						<a class="btn btn-sm btn-flat btn-danger" href="<?php echo base_url('admin/pesanan/delete/'.$value['id']) ?>" onclick="return confirm('Konfirmasi penghapusan')">Hapus</a>
					</td>
				</tr>
			<?php 
				}
			}
			?>
			</tbody>
		</table>
	</div>
	<div class="box-footer">
	</div>
</div>