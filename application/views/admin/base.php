<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo (isset($page_title))?APP_INFO['name'].' - '.$page_title:APP_INFO['name']; ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte-2.4.8/')?>dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte-2.4.8/')?>dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/morris.js/morris.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/jvectormap/jquery-jvectormap.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte-2.4.8/')?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/jquery/dist/jquery.min.js"></script>
</head>
<style type="text/css">
	.help-block.error {
		color: red;
	}
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<header class="main-header">
		<a href="<?php echo base_url() ?>" class="logo">
			<span class="logo-mini"><b>A</b>LT</span>
			<span class="logo-lg"><b><?php echo APP_INFO['name'] ?></b></span>
		</a>
		<nav class="navbar navbar-static-top">
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?php echo (!empty(aktif_sesi()['foto']))?base_url(aktif_sesi()['foto']):base_url('assets/adminlte-2.4.8/dist/img/user2-160x160.jpg') ?> ?>" class="user-image" alt="User Image">
							<span class="hidden-xs"><?php echo aktif_sesi()['nama_lengkap'] ?></span>
						</a>
						<ul class="dropdown-menu">
							<li class="user-header">
								<img src="<?php echo (!empty(aktif_sesi()['foto']))?base_url(aktif_sesi()['foto']):base_url('assets/adminlte-2.4.8/dist/img/user2-160x160.jpg') ?> ?>" class="img-circle" alt="User Image">
								<p><?php echo aktif_sesi()['nama_lengkap'] ?></p>
							</li>
							<li class="user-footer">
								<div class="pull-left">
									<a href="<?php echo base_url('admin/profil') ?>" class="btn btn-default btn-flat">Profil</a>
								</div>
								<div class="pull-right">
									<a href="<?php echo base_url('admin/keluar') ?>" class="btn btn-default btn-flat">Keluar</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<aside class="main-sidebar">
		<section class="sidebar">
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?php echo (!empty(aktif_sesi()['foto']))?base_url(aktif_sesi()['foto']):base_url('assets/adminlte-2.4.8/dist/img/user2-160x160.jpg') ?> ?>" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					<p><?php echo aktif_sesi()['nama_lengkap'] ?></p>
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>
			<ul class="sidebar-menu" data-widget="tree">
				<li class="header">MAIN NAVIGATION</li>
				<li class="<?php echo $this->router->fetch_method() == 'index'?'active':'' ?>"><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
				<li class="treeview <?php echo in_array($this->router->fetch_method(), ['bahan_baju', 'ukuran_baju', 'harga_bahan'])?'active':'' ?>">
					<a href="#">
						<i class="fa fa-cubes"></i> <span>Data Refrensi</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="<?php echo in_array($this->router->fetch_method(), ['bahan_baju', 'harga_bahan'])?'active':'' ?>"><a href="<?php echo base_url('admin/bahan_baju') ?>"><i class="fa fa-circle<?php echo in_array($this->router->fetch_method(), ['bahan_baju', 'harga_bahan'])?'':'-o' ?>"></i> Bahan Baju</a></li>
						<li class="<?php echo $this->router->fetch_method() == 'ukuran_baju'?'active':'' ?>"><a href="<?php echo base_url('admin/ukuran_baju') ?>"><i class="fa fa-circle<?php echo $this->router->fetch_method() == 'ukuran_baju'?'':'-o' ?>"></i> Ukuran Baju</a></li>
					</ul>
				</li>
				<li class="<?php echo $this->router->fetch_method() == 'pesanan'?'active':'' ?>"><a href="<?php echo base_url('admin/pesanan') ?>"><i class="fa fa-shopping-cart"></i> <span>Pesanan</span></a></li>
				<li class="<?php echo $this->router->fetch_method() == 'katalog_produk'?'active':'' ?>"><a href="<?php echo base_url('admin/katalog_produk') ?>"><i class="fa fa-list-ul"></i> <span>Katalog</span></a></li>
				<li class="<?php echo $this->router->fetch_method() == 'chat'?'active':'' ?>"><a href="<?php echo base_url('admin/chat') ?>"><i class="fa fa-comments"></i> <span>Chat</span></a></li>
				<li class="<?php echo $this->router->fetch_method() == 'pengguna'?'active':'' ?>"><a href="<?php echo base_url('admin/pengguna') ?>"><i class="fa fa-users"></i> <span>Pengguna</span></a></li>
				<li class="treeview <?php echo in_array($this->router->fetch_method(), ['bahan_baju', 'ukuran_baju'])?'active':'' ?>">
					<a href="#">
						<i class="fa fa-cogs"></i> <span>Pengaturan</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="<?php echo $this->router->fetch_method() == 'slider'?'active':'' ?>"><a href="<?php echo base_url('admin/slider') ?>"><i class="fa fa-circle<?php echo $this->router->fetch_method() == 'slider'?'':'-o' ?>"></i> Web Slider</a></li>
						<li class="<?php echo $this->router->fetch_method() == 'nomor_rekening'?'active':'' ?>"><a href="<?php echo base_url('admin/nomor_rekening') ?>"><i class="fa fa-circle<?php echo $this->router->fetch_method() == 'nomor_rekening'?'':'-o' ?>"></i> Nomor Rekening</a></li>
					</ul>
				</li>
			</ul>
		</section>
	</aside>

	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Dashboard
				<small>Control panel</small>
			</h1>
		</section>

		<section class="content">
			<?php echo $page ?>
		</section>
	</div>
	<footer class="main-footer">
		<div class="pull-right hidden-xs">
			<b>Version</b> <?php echo APP_INFO['version'] ?>
		</div>
		<strong>Copyright &copy; <?php echo date('Y') ?> <a href="<?php echo base_url() ?>"><?php echo APP_INFO['name'] ?></a>.</strong> All rights reserved.
	</footer>
</div>

<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/morris.js/morris.min.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo base_url('assets/adminlte-2.4.8/')?>dist/js/adminlte.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.datepicker').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	});
	$('.datatable').DataTable({
		dom:"<'row'<'col-sm-4 dt_length'l>>"+
		"<'row'<'col-sm-8'B> <'col-sm-4'f>>"+
		"<'row'<'col-sm-12'tr>>"+
		"<'row'<'col-sm-6 col-md-6 col-lg-4'i><'col-sm-6 col-md-6 col-lg-8'>>"+
		"<'row'<'col-sm-12 col-lg-7'<'pull-right'p>>>"
	});
});
</script>
</body>
</html>