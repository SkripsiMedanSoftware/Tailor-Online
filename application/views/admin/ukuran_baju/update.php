<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<form action="<?php echo base_url('admin/ukuran_baju/update/'.$ukuran_baju['id']) ?>" method="post">
		<div class="box-body">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Ukuran</label>
					<input class="form-control" type="text" name="nama" placeholder="Ukuran" value="<?php echo set_value('nama', $ukuran_baju['nama']) ?>">
					<?php echo form_error('nama', '<span class="help-block error">', '</span>'); ?>
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