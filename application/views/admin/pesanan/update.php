<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<form action="<?php echo base_url('admin/pesanan/update/'.$pesanan['id']) ?>" method="post">
		<div class="box-body">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Estimasi Pengerjaan</label>
					<input class="form-control" type="text" name="estimasi_pengerjaan" placeholder="Estimasi Pengerjaan" value="<?php echo set_value('estimasi_pengerjaan', $pesanan['estimasi_pengerjaan']) ?>">
					<?php echo form_error('estimasi_pengerjaan', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Harga</label>
					<input class="form-control" type="text" name="harga" placeholder="Harga" value="<?php echo set_value('harga', $pesanan['harga']) ?>">
					<?php echo form_error('harga', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Status Pesanan</label>
					<select class="form-control" name="status">
						<option value="dibatalkan" <?php echo $pesanan['status'] == 'dibatalkan'?'selected':''; ?>>Dibatalkan</option>
						<option value="diterima" <?php echo $pesanan['status'] == 'diterima'?'selected':''; ?>>Diterima</option>
						<option value="ditolak" <?php echo $pesanan['status'] == 'ditolak'?'selected':''; ?>>Ditolak</option>
						<option value="dalam-proses" <?php echo $pesanan['status'] == 'dalam-proses'?'selected':'' ?>>Dalam Proses</option>
						<option value="selesai" <?php echo $pesanan['status'] == 'selesai'?'selected':''; ?>>Selesai</option>
					</select>
					<?php echo form_error('status', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Status Pembayaran</label>
					<select class="form-control" name="status_pembayaran">
						<option value="belum-dibayar" <?php echo $pesanan['status_pembayaran'] == 'belum-dibayar'?'selected':''; ?>>Belum Dibayar</option>
						<option value="lunas" <?php echo $pesanan['status_pembayaran'] == 'lunas'?'selected':''; ?>>Lunas</option>
					</select>
					<?php echo form_error('status_pembayaran', '<span class="help-block error">', '</span>'); ?>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<a  class="btn btn-default btn-flat" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Kembali</a>
			&nbsp;&nbsp;
			<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
</div>