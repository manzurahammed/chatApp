<div class="chat-box">
    <div class="row">
        <div class="col-4">
            <ul class="list-group">
                <li class="list-group-item own"><?php print $own; ?></li>
                <?php 
                    if(!empty($friends)){
                        foreach($friends as $friend){
                            print '<li data-friend_id="'.$friend->id.'" class="list-group-item friends">'.$friend->user_name.'</li>';
                        }
                    }
                ?>
            </ul>
        </div>
        <div class="col-8">
            <div class="left-chat-box">
                <div class="chat-message">
                    
                </div>
                <div class="chat-input-box">
                    <input id="message" type="text" placeholder="Type your message…">
                    <button id="send_chat">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>