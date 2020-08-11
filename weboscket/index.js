const io = require('socket.io')();

io.on('connect', socket => {
	socket.on('join_room', id => {
		socket.join('chat_room_'+id);
		socket.emit('chat_room_'+id, {
			status: 'success',
			action: 'join_room'
		});
	});

	socket.on('admin_chat', data => {
		io.of('/').emit('admin_notification', data);
	});

	socket.on('send_to_room', data => {
		console.log(data);
		io.of('/').emit('message_on_room_'+data.room_id, {
			by: data.by,
			text: data.text
		});
	});
});

io.listen(8081);