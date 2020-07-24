<?php  
require_once "../../functions.php";

//getting data from the table Users
$rows_Users = table_Users ('select_one', $_SESSION['UsersId'], NULL, NULL, NULL);
foreach ($rows_Users as $row_Users) {
	# code...
}

if (empty($_POST['sorting'])) {
	$sorting = 'ORDER BY Created DESC';
}
else {
	$sorting = $_POST['sorting'];
}

if (empty($_POST['search'])) {
	$job = 'select_my_messages';
}
else {
	$job = 'search_my_messages';
}

if (empty($_POST['limit'])) {
	$limit = 6;
}

else {
	$limit = $_POST['limit'];
}

if ($job == 'search_my_messages') {
	$rowCount = table_Messages ('rowCount_search_my_messages', $row_Users->Link, NULL, NULL, NULL);
}
else {
	$rowCount = table_Messages ('rowCount_my_messages', $row_Users->Link, NULL, NULL, NULL);
}

//getting data from the table Messages 
$rows_Messages = table_Messages ($job, $row_Users->Link, NULL, $sorting, $limit);

?>

<div class="inbox-messages">
	<?php foreach ($rows_Messages as $row_Messages): ?>
		<?php if ($row_Messages->Unread == 0): ?>
			<div class="inbox-message-read" onclick="markMailAsRead('<? echo $row_Messages->Link; ?>');" >
		<?php endif ?>

		<?php if ($row_Messages->Unread == 1): ?>
			<div class="inbox-message-unread" onclick="markMailAsRead('<? echo $row_Messages->Link; ?>');" >
		<?php endif ?>		
		<div>
			From:
			<?php  
			//getting data from the table Users
			$rows_Users = table_Users ('select_one_by_link', $row_Messages->SendersLink, NULL);
			foreach ($rows_Users as $row_Users) {
				# code...
			}
			echo $row_Users->Username;
			?>
		</div>
		<div>
			<?php 
			echo "Subject: ".$row_Messages->Subject;
			?>
		</div>
		<div>
			On: <? echo date('d-M-Y H:i', strtotime($row_Messages->Created));?>
		</div>
	</div>
	<?php endforeach ?>
	<div id="remaining-data" style="display: none;" ><?php echo $rowCount - $limit; ?></div>
</div>
