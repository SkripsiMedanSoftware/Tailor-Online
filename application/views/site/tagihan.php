<div class="row">
	<div class="col-lg-12">
		<table class="table table-hover">
			<thead>
				<th>No</th>
				<th>ID Tagihan</th>
				<th>Tanggal Pemesanan</th>
				<th>Estimasi Pengerjaan</th>
				<th>catatan</th>
				<th>Harga</th>
				<th>Status Pemesanan</th>
				<th>Status Pembayaran</th>
				<th>Opsi</th>
			</thead>
			<tbody>
				<?php 
					$i = 1;
					foreach ($pesanan as $value) : 
				?>
				<tr>
					<td><?php echo $i ?></td>
					<td><?php echo $value['uid'] ?></td>
					<td><?php echo nice_date($value['tanggal_pemesanan'], 'l, d F Y') ?></td>
					<td><?php echo (!empty($value['estimasi_pengerjaan']))?$value['estimasi_pengerjaan'].' Hari':'-' ?></td>
					<td><?php echo (!empty($value['catatan']))?$value['catatan']:'-' ?></td>
					<td>Rp.<?php echo number_format($value['harga'], 0, ',', '.') ?></td>
					<td><?php echo $value['status'] ?></td>
					<td><?php echo $value['status_pembayaran'] ?></td>
					<td>
						<?php if ($value['status'] == 'diterima'  && $value['status_pembayaran'] == 'belum-lunas') : ?>
							<button class="btn btn-sm btn-danger">Batalkan</button>
							<button class="btn pay btn-sm btn-success" data_id="<?php echo $value['id'] ?>">Bayar</button>
						<?php endif ?>
					</td>
				</tr>
				<?php $i++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
$(document).on('click', '.pay', function(event) {
	event.preventDefault();
	var data_id = $(this).attr('data_id');
	$.ajax({
		url: '<?php echo base_url('payment/snap_token/') ?>'+data_id,
		type: 'GET',
		dataType: 'JSON',
		success: function(data) {
			if (data.status == 'success') {
				snap.pay(data.data);
			}
		},
		error: function(error) {

		}
	});
});
</script>