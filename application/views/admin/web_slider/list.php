<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($page_title)?$page_title:''; ?></h3>
	</div>
	<div class="box-body">
		<?php 
		if ($this->session->flashdata('flash_message'))
		{
			?>
				<div class="alert alert-<?php echo $this->session->flashdata('flash_message')['status'] ?> alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo $this->session->flashdata('flash_message')['message'] ?>
				</div>
			<?php
		}
		?>
		<table class="table table-hover table-striped datatable">
			<thead>
				<th>No</th>
				<th>Judul</th>
				<th>Tombol Teks</th>
				<th>Tombol Link</th>
				<th>Gambar</th>
				<th>Opsi</th>
			</thead>
			<tbody>
				<?php
				if (!empty($web_slider)) {
					foreach ($web_slider as $key => $value) {
				?>
				<tr>
					<td><?php echo $key+=1; ?></td>
					<td><?php echo $value['judul']; ?></td>
					<td><?php echo $value['tombol_teks']; ?></td>
					<td><?php echo $value['tombol_link']; ?></td>
					<td><a target="_blank" href="<?php echo base_url($value['image']) ?>">Lihat</a></td>
					<td>
						<a class="btn btn-sm btn-flat btn-primary" href="<?php echo base_url('admin/web_slider/update/'.$value['id']) ?>">Edit</a>
						<a class="btn btn-sm btn-flat btn-danger" href="<?php echo base_url('admin/web_slider/delete/'.$value['id']) ?>" onclick="return confirm('Konfirmasi penghapusan')">Hapus</a>
					</td>
				</tr>
			<?php 
				}
			}
			?>
			</tbody>
		</table>
	</div>
	<div class="box-footer">
		<a class="btn btn-primary btn-flat" href="<?php echo base_url('admin/web_slider/add/') ?>"><i class="fa fa-plus"></i> Tambah</a>
	</div>
</div>