<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<form action="<?php echo base_url('admin/web_slider/add/') ?>" method="post" enctype="multipart/form-data">
		<div class="box-body">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Judul</label>
					<input type="text" name="judul" class="form-control" placeholder="Judul" value="<?php echo set_value('judul') ?>">
					<?php echo form_error('judul', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Konten</label>
					<textarea placeholder="Konten" class="form-control" name="konten"><?php echo set_value('konten') ?></textarea>
					<?php echo form_error('konten', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Tombol Teks</label>
					<input type="text" name="tombol_teks" class="form-control" placeholder="Tombol Teks" value="<?php echo set_value('tombol_teks') ?>">
					<?php echo form_error('tombol_teks', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Tombol Link</label>
					<input type="text" name="tombol_link" class="form-control" placeholder="Tombol Link" value="<?php echo set_value('tombol_link') ?>">
					<?php echo form_error('tombol_link', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Gambar</label>
					<input type="file" name="image" class="form-control">
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