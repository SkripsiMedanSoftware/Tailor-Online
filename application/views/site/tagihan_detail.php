<div class="row">
	<div class="col-lg-12">
		<h1>Detail Pesanan #<?php echo $pesanan['uid'] ?></h1>
	</div>
	<div class="col-lg-6">
		<h3>Desain</h3>
		<?php foreach ($this->desain_pesanan_model->get_where(array('pesanan' => $pesanan['id'])) as $value) : ?>
		<div class="col-lg-4 col-md-4 col-xs-6 thumb">
			<img class="img-thumbnail" src="<?php echo base_url($value['foto']) ?>" alt="Another alt text">
		</div>
		<?php endforeach; ?>
	</div>
	<div class="col-lg-6">
		<h3>Detail</h3>
		<table class="table table-hover table-striped table-bordered">
			<thead>
				<th>No</th>
				<th>Bahan</th>
				<th>Warna</th>
				<th>Ukuran</th>
				<th>Jumlah</th>
				<th>Subtotal</th>
			</thead>
			<tbody>
				<?php 
				$i = 1;
				foreach ($this->detail_pesanan_model->get_where(array('pesanan' => $pesanan['id'])) as $value) :
					$bahan = $this->bahan_baju_model->view($value['bahan']);
					$ukuran = $this->ukuran_baju_model->view($value['ukuran']);
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $bahan['jenis'] ?></td>
					<td><?php echo $bahan['warna'] ?></td>
					<td><?php echo $ukuran['nama'] ?></td>
					<td><?php echo $value['jumlah'] ?></td>
					<td><?php echo $value['subtotal'] ?></td>
				</tr>
				<?php $i++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>