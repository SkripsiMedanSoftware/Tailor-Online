<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<div class="box-body">
		<div class="col-lg-6">
			<table class="table table-hover table-striped">
				<tbody>
					<tr>
						<td>Role</td><td><?php echo $pengguna['role'] ?></td>
					</tr>
					<tr>
						<td>Nama Lengkap</td><td><?php echo $pengguna['nama_lengkap'] ?></td>
					</tr>
					<tr>
						<td>Email</td><td><?php echo $pengguna['email'] ?></td>
					</tr>
					<tr>
						<td>Seluler</td><td><?php echo $pengguna['seluler'] ?></td>
					</tr>
					<tr>
						<td>Username</td><td><?php echo $pengguna['username'] ?></td>
					</tr>
					<tr>
						<td>Alamat</td><td><?php echo $pengguna['alamat'] ?></td>
					</tr>
					<tr>
						<td>Status</td><td><?php echo $pengguna['status'] ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-lg-6">
			<?php if (!empty($pengguna['foto'])) : ?>
			<img src="<?php echo base_url($pengguna['foto']) ?>" class="img-responsive" style="max-height: 400px;">
			<?php endif; ?>
		</div>
	</div>
	<div class="box-footer">
		<a  class="btn btn-default btn-flat" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Kembali</a>
	</div>
</div>