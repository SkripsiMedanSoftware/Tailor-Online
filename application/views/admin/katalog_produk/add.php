<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<form action="<?php echo base_url('admin/katalog_produk/add') ?>" method="post" enctype="multipart/form-data">
		<div class="box-body">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Nama</label>
					<input class="form-control" type="text" name="nama" placeholder="Nama" value="<?php echo set_value('nama') ?>">
					<?php echo form_error('nama', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Deskripsi</label>
					<textarea name="deskripsi" class="form-control" placeholder="Deskripsi"><?php echo set_value('deskripsi') ?></textarea>
					<?php echo form_error('deskripsi', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Tanggal Pemesanan</label>
					<input class="form-control datepicker" type="text" name="tanggal_pemesanan" placeholder="Tanggal Pemesanan" value="<?php echo set_value('tanggal_pemesanan') ?>">
					<?php echo form_error('tanggal_pemesanan', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Tanggal Selesai</label>
					<input class="form-control datepicker" type="text" name="tanggal_selesai" placeholder="Tanggal Selesai" value="<?php echo set_value('tanggal_selesai') ?>">
					<?php echo form_error('tanggal_selesai', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Foto</label>
					<input class="form-control" type="file" name="foto[]" multiple="true">
				</div>
				<div class="form-group">
					<label>Status</label>
					<select class="form-control">
						<option value="publish">Publish</option>
						<option value="draft">Draft</option>
					</select>
					<?php echo form_error('status', '<span class="help-block error">', '</span>'); ?>
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