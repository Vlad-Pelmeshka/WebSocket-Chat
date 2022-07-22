
<div class="uk-flex uk-flex-wrap">
	<div class="uk-width-1-1 uk-width-medium@s uk-padding-small " id="active_personList">
		<h3>Online: <span id="kol"></span> user(s)</h3>
		<ul>
		</ul>
	</div>
	<div class="uk-width-1-1 uk-width-*@s uk-padding-small ">
		<div class="uk-align-center" id="chat">
			<div id="send_input" class="uk-flex">
				<input class="uk-input" type="text" placeholder="Enter message">
				<button class="uk-button uk-button-primary">Send</button>
			</div>
			<div id="message_block">
				<?php
				// var_dump($_SESSION);
				$messageList = MessageList($connection);

				foreach ($messageList as $value) {
					// var_dump($value['user_id']);
					if($_SESSION['login'] == $value['user_id']){
						echo '<p class="send"><span class="data_message"><span class="time">' . $value['time'] . '</span></span>' . $value['content'] . '</p>';
					}else{
						echo '<p class="receive"><span class="data_message"><span class="sender">' . $value['login'] . '</span> <span class="time">' . $value['time'] . '</span></span>' . $value['content'] . '</p>';
					}
				}

				//var_dump($messageList); die();
				?>
			</div>
		</div>
	</div>
	<!-- <button id="getWS"></button> -->
</div>