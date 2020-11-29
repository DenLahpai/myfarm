<?php  
require_once "../../functions.php";
if (isset($_REQUEST['MessagesLink'])) {
	//getting data from Messages 
	$rows_Messages = table_Messages ('select_one_by_link', $_REQUEST['MessagesLink'], NULL, NULL, NULL);
	foreach ($rows_Messages as $row_Messages) {
		$current_message_time = $row_Messages->Created;
	}

	//gettting current UsersLink
	$rows_current_user = table_Users ('select_one', $_SESSION['UsersId'], NULL);
	foreach ($rows_current_user as $row_current_user) {
		$current_usersLink = $row_current_user->Link;
	}

	if ($current_usersLink == $row_Messages->SendersLink) {
		$receiver = $row_Messages->ReceiversLink;
	}
	else {
		$receiver = $row_Messages->SendersLink;
	}
}
else {
	echo "Connection hten mat ai! Bai chyam ya rit!";
	die();
}
?>
<div class="read-message">
	<div class="message-menu">
		<div class="message-menu-items">
			<div class="message-menu-item">
				<div onclick="Toggle('message-reply-form');">Htai na</div>
			</div>
			<div class="message-menu-item">
				<div onclick="deleteMessage('<? echo $row_Messages->Link; ?>');">Hpyet na</div>
			</div>
		</div>
		<div class="message-reply-form" id="message-reply-form">
			<div style="text-align: left;">
				Htai na masha:
				<?php  
				// getting senders name;
				$rows_Users = table_Users ('select_one_by_link', $receiver, NULL);
				foreach ($rows_Users as $row_Users) {
					# code...
				}
				echo $row_Users->Username; 
				?>
			</div>
			<div>
				<span class="textarea" id="Message" role="textbox" contenteditable=""></span>
			</div>
			<div>
				<button type="button" class="btn-submit" id="btn-Send" onclick="replyMessage('<? echo $receiver; ?>');">Sa na</button>
			</div>
		</div>	
	</div>
	<div class="message-container">
		<!-- current-message -->
		<div class="current-message">
			<div class="message-sender">
				<?php
				$rows_Users = table_Users ('select_one_by_link', $row_Messages->SendersLink, NULL);
				foreach ($rows_Users as $row_Users) {
					# code...
				}				
				echo "De na: <a href=\"view_user.php?UsersLink=$row_Users->Link\" target='_blank' style='cursor: pointer;'>".$row_Users->Username."</a></br>";
				?>
			</div>
			<div class="message-subject">
				<h4>
					<span id="Subject">
					<?php echo  $row_Messages->Subject; ?>
					</span>
				</h4>
				<input type="hidden" name="ConversationId" id="ConversationId" value="<? echo $row_Messages->ConversationId; ?>">		
			</div>
			<div class="message-time">
				<div style="text-align: right; font-style: italic; color: var(--leaf-color);">
					<?php echo date("d-M-Y H:i", strtotime($row_Messages->Created)); ?>
				</div>
			</div>
			<div class="message-body">
				<?php echo nl2br($row_Messages->Message); ?>
			</div>
		</div>
		<!-- end of current-message -->
		<?php  
		// getting all the conversation
		$rows_all_conversation = table_Messages ('get_one_conversation', $row_Messages->ConversationId, $row_Messages->Link, NULL, NULL, NULL);
		?>
		<?php foreach ($rows_all_conversation as $row_all_conversation): ?>
			<?php if ($row_all_conversation->Created < $current_message_time): ?>
				<div class="previous-message">
				<?php  
				// getting data from the table Users
				$rows_Users_conversation = table_Users ('select_one_by_link', $row_all_conversation->SendersLink, NULL);
				foreach ($rows_Users_conversation as $row_Users_conversation) {
					# code...
				}

				echo "------------ Sa da ai laika ------------<br>";
				echo "De na: <a href=\"view_user.php?UsersLink=$row_Users->Link\" target='_blank' style='cursor: pointer;'>".$row_Users_conversation->Username."</a></br>";
				echo "Ga baw: ".$row_all_conversation->Subject."<br>";
				echo "Aten: ".date('d-M-Y H:i', strtotime($row_all_conversation->Created))."<br><br>";
				?>
				<?php echo nl2br($row_all_conversation->Message); ?>
				</div>
			<?php endif ?>
		
		<?php endforeach ?>
	</div>
</div>
