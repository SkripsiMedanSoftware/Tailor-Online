<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<div class="box-body">
		<div class="col-lg-4">
			<h3>Informasi Pesana</h3>
			<table class="table table-hover table-striped">
				<tbody>
					<tr>
						<td>ID Pesanan</td><td><?php echo $pesanan['uid'] ?></td>
					</tr>
					<tr>
						<td>Pelanggan</td><td><a href="<?php echo base_url('admin/pengguna/view/'.$pesanan['id_customer']) ?>"><?php echo view_user($pesanan['id_customer'])['nama_lengkap'] ?></a></td>
					</tr>
					<tr>
						<td>Estimasi Pengerjaan</td><td><?php echo $pesanan['estimasi_pengerjaan'] ?></td>
					</tr>
					<tr>
						<td>Harga</td><td><?php echo $pesanan['harga'] ?></td>
					</tr>
					<tr>
						<td>Status Pemesanan</td><td><?php echo ucfirst($pesanan['status']) ?></td>
					</tr>
					<tr>
						<td>Status Pembayaran</td><td><?php echo $pesanan['status_pembayaran'] ?></td>
					</tr>
					<tr>
						<td>Metode Pembayaran</td><td><?php echo ($pesanan['metode_pembayaran'] == 'midtrans')?'Online':'Bayar Ditempat' ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-lg-4">
			<h3>Detail Pesann</h3>
			<table class="table table-hover table-striped">
				<thead>
					<th>No</th>
					<th>Bahan</th>
					<th>Ukuran</th>
					<th>Jumlah</th>
					<th>Subtotal</th>
				</thead>
				<tbody>
					<?php foreach ($this->detail_pesanan_model->get_where(array('pesanan' => $pesanan['id'])) as $key => $value) :?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $value['bahan'] ?></td>
						<td><?php echo $value['ukuran'] ?></td>
						<td><?php echo $value['jumlah'] ?></td>
						<td>Rp.<?php echo number_format($value['subtotal'], 0, ',', '.') ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="col-lg-4">
			<h3>Desain Pesanan</h3>
			<?php foreach ($this->desain_pesanan_model->get_where(array('pesanan' => $pesanan['id'])) as $key => $value) :?>
				<img src="<?php echo base_url($value['foto']) ?>" class="img-responsive img-thumbnail" style="max-height: 228px;">
			<?php endforeach; ?>
		</div>
	</div>
	<div class="box-footer">
		<a  class="btn btn-default btn-flat" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Kembali</a>
	</div>
</div>