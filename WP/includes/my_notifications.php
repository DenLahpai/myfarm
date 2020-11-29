<?php  
require_once "../../functions.php";

if (empty($_POST['sorting'])) {
	$sorting = 'ORDER BY Created DESC';
}
else {
	$sorting = $_POST['sorting'];
}

if (empty($_POST['search'])) {
	$job = 'select_my_notifications';
}
else {
	$job = 'search_my_notifications';
}

if (empty($_POST['limit'])) {
	$limit = 999;
}

else {
	$limit = $_POST['limit'];
}

if ($job == 'search_my_notifications') {
	$rowCount = table_Users_Notifications ('rowCount_search_my_notifications', $_SESSION['UsersLink'], NULL, NULL, NULL);
}

else {
	$rowCount = table_Users_Notifications ('rowCount_my_notifications', $_SESSION['UsersLink'], NULL, NULL, NULL);
}

//getting data from the table Users_Notifications
$rows_Notifications = table_Users_Notifications ($job, $_SESSION['UsersLink'], NULL, $sorting, $limit);
?>
<div class="my-notifications">
	<?php foreach ($rows_Notifications as $row_Notifications): ?>
		<div class="notifications-items">				
			<div class="notifications-item" onclick="markNotificationAsRead('<? echo $row_Notifications->Link; ?>');">
				<?php if ($row_Notifications->Unread == 1): ?>
					<div class="notifications-text-unread">
				<?php endif ?>
				<?php if ($row_Notifications->Unread == 0): ?>
					<div class="notifications-text-read">
				<?php endif ?>
					<a href="view_post.html?PostsLink=<? echo $row_Notifications->PostsLink ?>" >
						<div>
							<?php  
							//getting data from the table 
							$rows_Users = table_Users ('select_one_by_link',  $row_Notifications->UsersLink, NULL);
							foreach ($rows_Users as $row_Users) {
								# code...
							}
							echo "<span style=\"color: var(--wood-color); font-weight: bold;\">".$row_Users->Username."</span> ".$row_Notifications->Message;
							?>
						</div>
						<div class="notifications-item-time">
							On <? echo date("d-M-Y H:i", strtotime($row_Notifications->Created)); ?>
						</div>
					</a>
				<!-- end of notifications-text -->	
				</div>
				<div class="notifications-command" onclick="deleteNotification('<? echo $row_Notifications->Link; ?>');">
					<span class="symbols" style="color: red;">&#10007;</span>
				</div>
			<!-- notifications-items -->
			</div>									
		</div>
	<?php endforeach ?>
</div>


