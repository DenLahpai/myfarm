<?php
require_once "../../functions.php";

//getting data from the table Users
$rows_Users = table_Users ('select_one', $_SESSION['UsersId'], NULL);
foreach ($rows_Users as $row_Users) {
	# code...
}

//getting Messages rowCount for current user
$rowCount_Messages = table_Messages ('count_my_messages', $row_Users->Link, NULL, NULL, NULL);

?>
<div title="Notification" onclick="window.location = 'my_notifications.html';">
	N<span class="superscript">32</span>
	
</div>
<div title="Messages" onclick="window.location.href = 'my_inbox.html';">
    <span class="symbols">&#9993;</span><span class="superscript"><? echo $rowCount_Messages;?></span>
</div>
<div class="symbols" onclick="Toggle('setting-menu');">
   <span class="symbols">&#9881;</span>    
</div>
