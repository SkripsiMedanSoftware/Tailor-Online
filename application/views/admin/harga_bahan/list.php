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
				<th>Ukuran</th>
				<th>Harga</th>
				<th>Opsi</th>
			</thead>
			<tbody>
				<?php
				if (!empty($harga_bahan)) {
					foreach ($harga_bahan as $key => $value) {
				?>
				<tr>
					<td><?php echo $key+=1; ?></td>
					<td><?php echo $this->ukuran_baju_model->view($value['ukuran'])['nama']; ?></td>
					<td>Rp.<?php echo number_format($value['harga'], 0, ',', '.'); ?></td>
					<td>
						<a class="btn btn-sm btn-flat btn-primary" href="<?php echo base_url('admin/harga_bahan/update/'.$value['id']) ?>">Edit</a>
						<a class="btn btn-sm btn-flat btn-danger" href="<?php echo base_url('admin/harga_bahan/delete/'.$value['id']) ?>" onclick="return confirm('Konfirmasi penghapusan')">Hapus</a>
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
		<a class="btn btn-primary btn-flat" href="<?php echo base_url('admin/harga_bahan/add/'.$this->uri->segment(4)) ?>"><i class="fa fa-plus"></i> Tambah</a>
	</div>
</div>