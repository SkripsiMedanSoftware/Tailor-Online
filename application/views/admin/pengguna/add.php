<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<form action="<?php echo base_url('admin/pengguna/add') ?>" method="post" enctype="multipart/form-data">
		<div class="box-body">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Role</label>
					<select class="form-control" name="role">
						<option value="admin">Admin</option>
						<option class="customer">Customer</option>
					</select>
					<?php echo form_error('role', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Nama Lengkap</label>
					<input class="form-control" type="text" name="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo set_value('nama_lengkap') ?>">
					<?php echo form_error('nama_lengkap', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo set_value('email') ?>">
					<?php echo form_error('email', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Username</label>
					<input class="form-control" type="text" name="username" placeholder="Username" value="<?php echo set_value('username') ?>">
					<?php echo form_error('username', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Seluler</label>
					<input class="form-control" type="text" name="seluler" placeholder="Seluler" value="<?php echo set_value('seluler') ?>">
					<?php echo form_error('seluler', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" type="text" name="password" placeholder="Password" value="<?php echo set_value('password') ?>">
					<?php echo form_error('password', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Foto</label>
					<input type="file" name="foto" class="form-control">
					<?php echo form_error('warna', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea class="form-control" name="alamat" placeholder="Alamat"><?php echo set_value('alamat') ?></textarea>
					<?php echo form_error('alamat', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group">
					<label>Status</label>
					<select class="form-control" name="status">
						<option value="aktif">Aktif</option>
						<option value="non-aktif">Non-aktif</option>
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