$(function(){
    $('.friends').click(function(){
        if ( !$( this ).hasClass( "active" ) ) {
            $('.friends.active').removeClass('active');
            $(this).addClass('active');
            let friend_id =$(this).data('friend_id');
            $.ajax({
                method: "POST",
                url: base_url+"chat/get_chat",
                data: { friend_id: friend_id, own_id: own_id }
            })
            .done(function( response ) {
                $('.chat-message').html(response);
            });
        }
    });
	var socket = io('http://localhost:5000');
    $('#send_chat').click(function(e){
        e.preventDefault();
        let friend_id = $('.friends.active').data('friend_id');
        let message = $("#message").val();
		if(message!=''){
			socket.emit('chat message', {friend_id:friend_id,message:message,own_id:own_id});
			var markup = '<div class="chat-container darker">';
					markup += '<p>'+message+'</p>';
				markup += '<span class="time-right">11:00</span>';
				markup += '</div>';
			$('.chat-message').append(markup);
			$("#message").val('');
		}
    });
	socket.on('chat message', function(msg){
		let friend_id =$('.friends.active').data('friend_id');
		if(own_id==msg.friend_id && friend_id == msg.own_id){
			var markup = '<div class="chat-container"><p>'+msg.message+'</p></div>';
			$('.chat-message').append(markup);
		}
    });
});