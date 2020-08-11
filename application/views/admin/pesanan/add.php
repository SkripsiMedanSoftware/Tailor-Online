<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<form action="<?php echo base_url('admin/bahan_baju/add') ?>" method="post">
		<div class="box-body">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Jenis</label>
					<input class="form-control" type="text" name="jenis" placeholder="Jenis" value="<?php echo set_value('jenis') ?>">
					<?php echo form_error('jenis', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Warna</label>
					<input class="form-control" type="text" name="warna" placeholder="Warna" value="<?php echo set_value('warna') ?>">
					<?php echo form_error('warna', '<span class="help-block error">', '</span>'); ?>
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