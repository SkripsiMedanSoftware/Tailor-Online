<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<form action="<?php echo base_url('admin/harga_bahan/add/'.$this->uri->segment(4)) ?>" method="post">
		<div class="box-body">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Ukuran</label>
					<select class="form-control" name="ukuran">
						<option value="">Pilih Ukuran</option>
						<?php foreach ($this->ukuran_baju_model->list() as $value) : ?>
							<option value="<?php echo $value['id'] ?>" <?php echo $value['id'] == set_value('ukuran')?'selected':'' ?>><?php echo $value['nama'] ?></option>
						<?php endforeach; ?>
					</select>
					<?php echo form_error('ukuran', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Harga</label>
					<input type="text" name="harga" class="form-control" placeholder="Harga" value="<?php echo set_value('harga') ?>">
					<?php echo form_error('harga', '<span class="help-block error">', '</span>'); ?>
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