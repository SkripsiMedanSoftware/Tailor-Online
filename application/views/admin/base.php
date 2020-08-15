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
	<link rel="stylesheet" href="<?php echo base_url('assets/adminlte-2.4.8/')?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
					<li class="dropdown notifications-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i>
							<span class="label bg-purple"><b class="notifications_count">0</b></span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">You have <b class="notifications_count_text">0</b> notifications</li>
							<li>
								<ul class="menu menu-notification"></ul>
							</li>
							<li class="footer"><a href="#">View all</a></li>
						</ul>
					</li>
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
									<a href="<?php echo base_url('admin/pengguna/view/'.aktif_sesi()['id']) ?>" class="btn btn-default btn-flat">Profil</a>
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
				<li class="treeview <?php echo in_array($this->router->fetch_method(), ['web_slider'])?'active':'' ?>">
					<a href="#">
						<i class="fa fa-cogs"></i> <span>Pengaturan</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="<?php echo $this->router->fetch_method() == 'web_slider'?'active':'' ?>"><a href="<?php echo base_url('admin/web_slider') ?>"><i class="fa fa-circle<?php echo $this->router->fetch_method() == 'web_slider'?'':'-o' ?>"></i> Web Slider</a></li>
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
<script type="text/javascript" src="<?php echo $this->config->item('socketio_host').':'.$this->config->item('socketio_port'); ?>/socket.io/socket.io.js"></script>
<script type="text/javascript">
function arrayobject_find_value(arrayName, searchKey, searchValue) {
	let find = arrayName.findIndex(i => i[searchKey] == searchValue);
	return (find !== -1)?find:false;
}

function update_chat_room(room_id, data) {
	$.ajax({
		url: '<?php echo base_url('chat/update_chat_room/') ?>'+room_id,
		type: 'POST',
		dataType: 'JSON',
		data: data,
		success: function(data) {
			console.log(data)
		},
		error: function(error) {
			console.log(error)
		}
	});
}

function user_info(user_id) {
	return new Promise((resolve, reject) => {
		$.ajax({
			url: '<?php echo base_url('site/user_info/'); ?>'+user_id,
			type: 'GET',
			dataType: 'JSON',
			success: function(data) {
				resolve(data)
			},
			error: function(error) {
				reject(error)
			}
		});
	})
}

function chat_room_messages(room_id, limit = 10, offset = 0, desc = false) {
	$.ajax({
		url: '<?php echo base_url('chat/messages/'); ?>'+room_id+'/'+limit+'/'+offset+'/'+desc,
		type: 'GET',
		dataType: 'JSON',
		success: async function(data) {
			if (data.status == 'success') {
				var customer_info = new Promise((resolve, reject) => {
					if (data.data.chat_room.customer !== null) {
						user_info(data.data.chat_room.customer).then(data => {
							resolve(data.data)
						}, error => {
							console.log(error)
						})
					} else {
						resolve('Unknow');
					}
				});

				var admin_info = new Promise((resolve, reject) => {
					if (data.data.chat_room.admin !== null) {
						user_info(data.data.chat_room.admin).then(data => {
							resolve(data.data)
						}, error => {
							console.log(error)
						})
					} else {
						resolve('Unknow');
					}
				});

				var messages = data.data.messages;

				var user = {
					customer: await customer_info,
					admin: await admin_info
				}

				$.each(data.data.messages, function(index, el) {
					if (el.by == 'customer') {
						$('.direct-chat-messages[room_id="'+el.chat_room+'"]').append(
							'<div class="direct-chat-msg">'+
								'<div class="direct-chat-info clearfix">'+
									'<span class="direct-chat-name pull-left">'+user.customer.nama_lengkap+'</span>'+
								'</div>'+
								'<img class="direct-chat-img" src="<?php echo base_url('assets/adminlte-2.4.8/dist/img/') ?>/user8-128x128.jpg" alt="Message User Image">'+
								'<div class="direct-chat-text">'+el.text+'</div>'+
							'</div>'
						)
					} else {
						$('.direct-chat-messages[room_id="'+el.chat_room+'"]').append(
							'<div class="direct-chat-msg right">'+
								'<div class="direct-chat-info clearfix">'+
									'<span class="direct-chat-name pull-right">'+user.admin.nama_lengkap+'</span>'+
								'</div>'+
								'<img class="direct-chat-img" src="<?php echo base_url('assets/adminlte-2.4.8/dist/img/') ?>/user1-128x128.jpg" alt="Message User Image">'+
								'<div class="direct-chat-text">'+
									el.text+
								'</div>'+
							'</div>'
						)
					}
				});

				var direct_chat_message = $('.direct-chat-messages[room_id="'+room_id+'"]');
				direct_chat_message[0].scrollTop = direct_chat_message[0].scrollHeight;
			} else {

			}
		},
		error: function(error) {

		}
	});
}

$(document).ready(function() {
	var socket = io('<?php echo $this->config->item('socketio_host').':'.$this->config->item('socketio_port'); ?>'); // socket.io init
	var admin_notifications = (localStorage.getItem('admin_notification') == null)?[]:JSON.parse(localStorage.getItem('admin_notification')); // saved notification in local storage
	var joined_chat_rooms = (localStorage.getItem('joined_chat_room') == null)?[]:JSON.parse(localStorage.getItem('joined_chat_room')); // saved joined room in local storage

	$('.notifications_count').text(admin_notifications.length)
	$('.notifications_count_text').text(admin_notifications.length)

	// checkup admin notification from local storage
	if (admin_notifications.length > 0) {
		$.each(admin_notifications, function(index, val) {
			 if (val.type == 'new_chat_room') {
			 	$('.menu-notification').prepend('<li class="new_chat_room" data_id="'+val.chat_room+'"><a href="#"><i class="fa fa-users text-aqua"></i> Chat room baru #'+val.chat_room+'</a></li>');
			 }
		});
	}

	if (joined_chat_rooms.length > 0) {
		$.each(joined_chat_rooms, function(index, val) {
			var router_metod = '<?php echo $this->router->fetch_method(); ?>'
			if (router_metod == 'chat') {
				chat_room_info(val);
			}
		});
	}

	if (admin_notifications == null) {
		localStorage.setItem('admin_notification', []);
	}

	function chat_room_info(room_id) {
		$.ajax({
			url: '<?php echo base_url('chat/room_info/') ?>'+room_id,
			type: 'GET',
			dataType: 'JSON',
			success: function(chat_room) {
				if (chat_room.status == 'success') {
					if (chat_room.data.status == 'berlangsung') {
						socket.emit('join_chat_room', room_id); // admin join to room
						$('.chat_boxes').append(
							'<div class="col-md-3" chat_box_id="'+room_id+'">'+
								'<div class="box box-primary direct-chat direct-chat-primary">'+
									'<div class="box-header with-border">'+
										'<h3 class="box-title">'+chat_room.data.customer_name+'</h3>'+
										'<div class="box-tools pull-right">'+
											'<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>'+
											'<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>'+
										'</div>'+
									'</div>'+
									'<div class="box-body">'+
										'<div class="direct-chat-messages" room_id="'+room_id+'"></div>'+
									'</div>'+
									'<div class="box-footer">'+
										'<form action="#" method="post" class="send_message" room_id="'+room_id+'">'+
											'<div class="input-group">'+
												'<input type="text" room_id="'+room_id+'" placeholder="Tulis pesan disini ..." class="text_message form-control">'+
												'<span class="input-group-btn">'+
												'<button type="button" class="btn btn-primary btn-flat">Kirim</button>'+
												'</span>'+
											'</div>'+
										'</form>'+
									'</div>'+
								'</div>'+
							'</div>'
						);

						chat_room_messages(room_id, 1000, 0, false)
					}

					$('.send_message').on('submit',(function(e){
						e.preventDefault();

						var $chatboxMessage = $('.text_message[room_id="'+room_id+'"]');

						if ($chatboxMessage.val() !== '') {
							$.ajax({
								url: '<?php echo base_url('chat/send_message/') ?>'+room_id,
								type: 'POST',
								dataType: 'JSON',
								data: {
									from: 'admin',
									message: $chatboxMessage.val()
								},
								success: function(data) {
									if (data.status == 'success') {
										socket.emit('message_chat_room', {
											chat_room: {
												id: chat_room.data.id,
												status: chat_room.data.status
											},
											from: 'admin',
											message: $chatboxMessage.val()
										});

										$('.direct-chat-messages[room_id="'+room_id+'"]').append(
											'<div class="direct-chat-msg right">'+
												'<div class="direct-chat-info clearfix">'+
													'<span class="direct-chat-name pull-right"><?php echo aktif_sesi()['nama_lengkap'] ?></span>'+
												'</div>'+
												'<img class="direct-chat-img" src="<?php echo base_url('assets/adminlte-2.4.8/dist/img/') ?>/user1-128x128.jpg" alt="Message User Image">'+
												'<div class="direct-chat-text">'+
													$chatboxMessage.val()+
												'</div>'+
											'</div>'
										)

										var direct_chat_message = $('.direct-chat-messages[room_id="'+room_id+'"]');
										direct_chat_message[0].scrollTop = direct_chat_message[0].scrollHeight;

										$chatboxMessage.val('');
									}
								},
								error: function(error) {
									console.log(error)
								}
							});
						}
					}));
				}
			},
			error: function(error) {
				console.log(error)
			}
		});
	}

	socket.on('admin_notification', data => {
		switch (data.type) {
			case 'new_chat_room':
				if ($('li.new_chat_room[data_id="'+data.data_id+'"]').length === 0) {
					admin_notifications.push({
						type: 'new_chat_room',
						chat_room: data.data_id
					});
					localStorage.setItem('admin_notification', JSON.stringify(admin_notifications));
					$('.menu-notification').prepend('<li class="new_chat_room" data_id="'+data.data_id+'"><a href="#"><i class="fa fa-users text-aqua"></i> Chat room baru #'+data.data_id+'</a></li>');
					$('.notifications_count').text(parseInt($('.notifications_count').text())+1);
					$('.notifications_count_text').text($('.notifications_count').text());
				}
			break;

			default:
				console.log(data)
			break;
		}
	});

	$(document).on('click', '.new_chat_room', function(event) {
		event.preventDefault();
		var room_id = $(this).attr('data_id');
		if (joined_chat_rooms.indexOf(room_id) === -1) {
			socket.emit('join_chat_room', room_id); // admin join to room
			socket.emit('admin_joined_room', room_id); // admin joined room
			joined_chat_rooms.push(room_id); // push to joined chat room local storage
			$('li.new_chat_room[data_id="'+room_id+'"]').remove(); // remove from notification
			admin_notifications.splice(arrayobject_find_value(admin_notifications, 'chat_room', room_id), 1); // remove from notification
			update_chat_room(room_id, {
				admin: <?php echo aktif_sesi()['id'] ?>,
				status: 'berlangsung'
			});

			chat_room_info(room_id);
		}

		localStorage.setItem('admin_notification', JSON.stringify(admin_notifications));
		localStorage.setItem('joined_chat_room', JSON.stringify(joined_chat_rooms));

		var router_metod = '<?php echo $this->router->fetch_method(); ?>'
		if (router_metod !== 'chat') {
			window.location.href = '<?php echo base_url('admin/chat'); ?>'
		}
	});

	socket.on('message_chat_room', data => {
		if (data.from == 'customer') {
			$('.direct-chat-messages[room_id="'+data.room+'"]').append(
				'<div class="direct-chat-msg">'+
					'<div class="direct-chat-info clearfix">'+
						'<span class="direct-chat-name pull-left">Alexander Pierce</span>'+
					'</div>'+
					'<img class="direct-chat-img" src="<?php echo base_url('assets/adminlte-2.4.8/dist/img/') ?>/user8-128x128.jpg" alt="Message User Image">'+
					'<div class="direct-chat-text">'+data.message+'</div>'+
				'</div>'
			)
		}

		var direct_chat_message = $('.direct-chat-messages[room_id="'+data.room+'"]');

		if (typeof direct_chat_message[0] !== 'undefined') {
			direct_chat_message[0].scrollTop = direct_chat_message[0].scrollHeight;
		}
	});


	$('.datepicker').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	});

	$('table.datatable').DataTable({
		dom:"<'row'<'col-sm-4 dt_length'l>>"+
		"<'row'<'col-sm-8'B> <'col-sm-4'f>>"+
		"<'row'<'col-sm-12'tr>>"+
		"<'row'<'col-sm-6 col-md-6 col-lg-4'i><'col-sm-6 col-md-6 col-lg-8'>>"+
		"<'row'<'col-sm-12 col-lg-7'<'pull-right'p>>>"
	});
	// $('.datatable').DataTable();
});
</script>
</body>
</html>