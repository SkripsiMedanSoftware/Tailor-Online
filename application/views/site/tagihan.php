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
				<th>Metode Pembayaran</th>
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
					<td><?php echo $value['metode_pembayaran'] == 'midtrans'?'Online':'Bayar Ditempat' ?></td>
					<td>
						<?php 
						switch ($value['status']) {
							case 'menunggu-konfirmasi':
								?><button class="btn btn-xs btn-default">Menunggu Konfirmasi</button><?php
							break;

							case 'diterima':
								?><button class="btn btn-xs btn-primary">Diterima</button><?php
							break;

							case 'ditolak':
								?><button class="btn btn-xs btn-danger">Ditolak</button><?php
							break;

							case 'dibatalkan':
								?><button class="btn btn-xs btn-danger">Dibatalkan</button><?php
							break;

							case 'dalam-proses':
								?><button class="btn btn-xs btn-warning">Dalam Proses</button><?php
							break;

							default:
								?><button class="btn btn-xs btn-success">Selesai</button><?php
							break;
						}
						?>
					</td>
					<td>
						<?php 
						switch ($value['status_pembayaran']) {
							case 'belum-dibayar':
								?><button class="btn btn-xs btn-warning">Belum Dibayar</button><?php
							break;

							case 'pending':
								?><button class="btn btn-xs btn-warning">Menunggu Pembayaran</button><?php
							break;

							default:
								?><button class="btn btn-xs btn-success">Selesai</button><?php
							break;
						}
						?>
					</td>
					<td>
						<a href="<?php echo base_url('site/tagihan/'.$value['id']) ?>" class="btn btn-xs btn-info">Detail</a>
						<?php if ($value['status'] == 'diterima'  && $value['status_pembayaran'] == 'belum-dibayar') : ?>
							<a href="<?php echo base_url('site/tagihan/'.$value['id'].'/batalkan') ?>" class="btn btn-xs btn-danger">Batalkan</a>
							<?php if ($value['metode_pembayaran'] == 'midtrans') :?>
								<button class="btn pay btn-xs btn-success" data_id="<?php echo $value['id'] ?>">Bayar</button>
							<?php endif; ?>
							<?php else: ?>
								<?php if (!in_array($value['status'], ['dalam-proses', 'selesai']) and $value['status'] !== 'dibatalkan') : ?>
									<a href="<?php echo base_url('site/tagihan/'.$value['id'].'/batalkan') ?>" class="btn btn-xs btn-danger">Batalkan</a>
								<?php endif; ?>
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

function update_status_pesanan(data) {
	$.ajax({
		url: '<?php echo base_url('payment/update_pesanan') ?>',
		type: 'GET',
		dataType: 'JSON',
		data: data,
		success: function(data) {

		},
		error: function(error) {

		}
	});
}
$(document).on('click', '.pay', function(event) {
	event.preventDefault();
	var data_id = $(this).attr('data_id');
	$.ajax({
		url: '<?php echo base_url('payment/snap_token/') ?>'+data_id,
		type: 'GET',
		dataType: 'JSON',
		success: function(data) {
			if (data.status == 'success') {
				snap.pay(data.data,{
					onSuccess: function(result) {
						console.log('success');
						console.log(result);
					},
					onPending: function(result) {
						console.log('pending');
						update_status_pesanan(result.order_id, {
							status_pembayaran: 'pending',
							snap_response: JSON.stringify(result)
						});
						console.log(result);
					},
					onError: function(result) {
						console.log('error');
						console.log(result);
					},
					onClose: function() {
						console.log('customer closed the popup without finishing the payment');
					}
				});
			} else {
				window.location.reload();
			}
		},
		error: function(error) {

		}
	});
});
</script>