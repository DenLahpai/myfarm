<?php
require_once "../../functions.php";
if (empty($_POST['sorting'])) {
	$sorting = 'ORDER BY Created DESC';
}
else {
	$sorting = $_POST['sorting'];
}

if (empty($_POST['search'])) {
	$job = "select_one_user_posts";
}
else {
	$job = 'search';
}

if (empty($_POST['limit'])) {
	$limit = 6;
}
else {
	$limit = $_POST['limit'];
}

if ($job == 'search_one_user_posts') {
	$rowCount = table_Posts ('search_one_user_posts_rowCount', $_SESSION['UsersId'], NULL, NULL, NULL);
}
else {
	$rowCount = table_Posts ('rowCount_one_user_posts', $_SESSION['UsersId'], NULL, NULL, NULL);
}

$rows_Posts = table_Posts ($job, $_SESSION['UsersId'], NULL, $sorting, $limit);

?>
<!-- grid-container -->
<div class="grid-container">
	<?php foreach ($rows_Posts as $row_Posts): ?>
		<div class="grid-item">
			<div class="post-items">
				<div class="post-item">
					<div class="post-menu-bar">
						<div class='post-user'>
							<?php  
							//getting data from the table Users
							$rows_Users = table_Users ('select_one', $row_Posts->UsersId, NULL);
							foreach ($rows_Users as $row_Users) {
								# code...
							}
							?>
							<span onclick="Toggle('<? echo 'post-user-menu'.$row_Posts->Id; ?>');" style="color: black; font-weight: bold;" ><?php echo $row_Users->Username; ?></span>
							<div id="<? echo 'post-user-menu'.$row_Posts->Id; ?>" class="post-user-menu">
								<div class="post-user-menu-items">
									
								</div>								
							</div>							
						</div>
						<div class="btn-post-menu" onclick="Toggle('<? echo "post-menu-items".$row_Posts->Id; ?>')">&#9776;</div>
					</div>										
				</div>
				<div id="<? echo 'post-menu-items'.$row_Posts->Id; ?>" class="post-menu-items">
					<div class="post-menu-item">						
						<div onclick="markAsSoldOut(<? echo $row_Posts->Id; ?>);">
							Mark as Sold Out
						</div>
						<div onclick="deletePost(<? echo $row_Posts->Id; ?>)">
							Delete Post <span class="symbols" style="color: red;">&#10007;</span>
						</div>
					</div>
				</div>				
				<div class="post-item">
					<div class="post-created">
						<?php echo date("d-M-Y H:i", strtotime($row_Posts->Created)) ?>
					</div>
				</div>
				<div class="post-item">
					<h3>
						<?php echo $row_Posts->Title; ?>	
					</h3>									
				</div>
				<div class="post-item">
					<?php  
					//getting data from the table Image
					$rows_Images = table_Images ('select_for_one_post', $row_Posts->Link, NULL, NULL, NULL);
					foreach ($rows_Images as $row_Images) {
						# code...
					}
					?>					
					<?php if (isset($row_Images->Name)): ?>
						<a href="<? echo "../uploads/".$row_Images->Name; ?>">
							<img src="<? echo "../uploads/thumb_".$row_Images->Name; ?>">
						</a>
					<?php endif ?>	
				</div>
				<div class="post-item">
					<div class='post-description'>
						<?php echo $row_Posts->Description; ?>
					</div>
				</div>
				<div class="post-item">
					<div class="post-updated">
						Last update:
						<?php echo date("d-m-Y H:i", strtotime($row_Posts->Updated)); ?>						
					</div>
				</div>
				<?php if ($row_Posts->Status == 3): ?>
					<div class="post-item" id="soldout">
						SOLD OUT!!!
					</div>
				<?php endif ?>
			</div>
		</div>
	<?php endforeach ?>
	<div id="remaining-data" style="display:none;"><?php echo $rowCount - $limit; ?></div>
</div>
<!-- end of grid-container -->
