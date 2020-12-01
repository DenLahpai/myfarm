<?php  
require_once "../../functions.php";

if (isset($_REQUEST['PostsLink'])) {

	//getting data from the table Posts
	$rows_Posts = table_Posts ('select_one_by_link', $_POST['PostsLink'], NULL, NULL, NULL);
	foreach ($rows_Posts as $row_Posts) {
		# code...
	}	
}
else {
	echo "There was an error! Please go back and try again!";
	die();
}

?>
<div class="post-items">
	<div class="post-item">
		<div class="post-menu-bar">
			<div class="post-user">
				<?php 
				//getting data from the table Users
				$rows_Users = table_Users ('select_one', $row_Posts->UsersId, NULL);
				foreach ($rows_Users as $row_Users) {
					# code...
				}
				?>
				<span onclick="Toggle('post-user-menu');">
					<?php echo $row_Users->Username; ?>
				</span>
				<div id="post-user-menu" class="post-user-menu">
					<div class="post-user-menu-items">
						<div onclick="window.location.href='<? echo "compose_mail.html?UsersLink=$row_Users->Link"; ?>';">
							Contact <span class="symbols">&#9993</span>
						</div>
						<div onclick="window.location.href='view_user.php?UsersLink=<? echo $row_Users->Link; ?>'">
							View User's Info
						</div>
					</div>
				</div>
			</div>
			<div class="btn_post-menu" onclick="Toggle('post-menu-items')">
				&#9776	
			</div>
		</div>
	</div>
	<div class="post-menu-items" id="post-menu-items">
		<div class="post-menu-item">
			<div onclick="bookmarkPost('<? echo $row_Posts->Link; ?>')">
				Bookmark <span class="symbols">&#9873</span>
			</div>
			<div>
				Report <span class="symbols">&#10071</span>
			</div>
		</div>
	</div>
	<div class="post-item">
		<div class="post-created">
			<?php echo date("d-M-Y H:i", strtotime($row_Posts->Created)); ?>
		</div>
	</div>
	<div class="post-item">
		<h3><?php echo $row_Posts->Title; ?></h3>
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
		<div class="post-tag">
			<?php  
			//getting data from the table Tags 
			if ($row_Posts->TagsId < 0) {
				$rows_Tags = table_Tags ('select_one', $row_Posts->TagsId, NULL, NULL);
				foreach ($rows_Tags as $row_Tags) {
					echo "Tag: ".$row_Tags->English;
				}
			}
			else {
				echo "Tag: ";
			}
			?>			
		</div>
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
	<div class="post-item">
		<div class="post-command-bar">
			<div class="post-command-items">
				<div>
					<!-- Talk about it! -->
				</div>								
			</div>
			<div class="post-command-items">
				<div>
					<!-- Send this! -->
				</div>								
			</div>
		</div>
	</div>
	<div class="post-item">
		<div class="comment-input-items">
			<div class="comment-input-item">
				<span class="textarea" id="<? echo "Comment".$row_Posts->Id; ?>" role="textbox" contenteditable onclick="checkComment('<? echo $row_Posts->Id; ?>')"></span>
			</div>
			<div class="comment-input-item">
				<button type="button" class="btn-comment" id="<? echo "btn-comment".$row_Posts->Id;?>" onclick="postComment('<? echo $row_Posts->Id; ?>');">Post Comment!</button>
			</div>	
		</div>
	</div>
	<div class="post-item">
	<?php 
	// getting numbers of row count for comments
	$rowCount_Comments = table_Comments ('rowCount_Comments_for_one_post',$row_Posts->Link, NULL, NULL, NULL);
	?>	
		<div class="view-comments">
			<div id="<? echo "btn-view-comments".$row_Posts->Id; ?>" onclick="Toggle('<? echo "comments".$row_Posts->Id; ?>');"><? echo $rowCount_Comments; ?> Comments
			</div>
		</div>
	</div>
	<div class="post-item">
		<div class="comments" id="<? echo "comments".$row_Posts->Id; ?>">
			<?php
			//getting data from the table Comments for this post
			$rows_Comments = table_Comments ('select_for_one_post', $row_Posts->Link, NULL, NULL, NULL);
			?>
			<?php foreach ($rows_Comments as $row_Comments): ?>
				<div class="comments-items">
					<div class="comments-item">
						<div>
							<span class="comments-item-username" onclick="window.location.href = 'view_user.php?UsersLink=<? echo $row_Users->Link; ?>'">
							<?php  
							//getting Users data
							$rows_Users = table_Users ('select_one_by_link', $row_Comments->UsersLink, NULL);
							foreach ($rows_Users as $row_Users) {
								echo $row_Users->Username;
							}										
							?>
							</span>
							<?php echo $row_Comments->Comment; ?>
						</div>									
					</div>
					<div class="comment-item" style="font-style: italic; font-size: 0.6em; color: var(--leaf-color); text-align: right;">
						<?php echo date('d-M-y H:i', strtotime($row_Comments->Created)); ?>
					</div>
					<div class="comment-item">
						<div class="comment-commands">
							<div onclick="Toggle('<? echo "reply-input".$row_Comments->Id; ?>');">
								Reply
							</div>
							<div onclick="Toggle('<? echo "Replies".$row_Comments->Id; ?>')">
								<?php  
								// getting row count for replies 
								$rowCount_Replies = table_Replies ('rowCount_replies_for_one_comment', $row_Comments->Link, NULL, NULL, NULL);
								?>
								<?
								echo $rowCount_Replies;

								if ($rowCount_Replies <= 1) {
									echo " Reply";
								}
								
								else {
									echo " Replies";
								}
								?>
							</div>
							<div>
								Report <span class="symbols">&#10071;</span>
							</div>
						</div>
						<div class="reply" id="<? echo "reply-input".$row_Comments->Id;?>">
							<div>
								<span class="textarea" id="<? echo "Reply".$row_Comments->Id; ?>" role="textbox" contenteditable onclick="checkReply('<? echo $row_Comments->Id; ?>');"><? echo "@". $row_Users->Username." | "; ?></span>
							</div>
							<div>
								<button class="btn-comment" id="<? echo "btn-reply".$row_Comments->Id; ?>" onclick="insertReply('<? echo $row_Comments->Id ;?>');">Post Reply!</button>
							</div>
						</div>
						<!-- replies -->
						<div class="replies" id="<? echo "Replies".$row_Comments->Id; ?>">
							<?php
							// getting data from the table replies
							$rows_Replies = table_Replies ('select_for_one_comment', $row_Comments->Link, NULL, NULL, NULL);										
							?>
							<?php foreach ($rows_Replies as $row_Replies): ?>
								<div class="replies-items">
									<div class="replies-item">
										<div>
											<span class="comments-item-username" onclick="window.location.href = 'view_user.php?UsersLink=<? echo $row_Users->Link; ?>'">
												<?php  
												//getting data from the table Users
												$rows_Users = table_Users ('select_one_by_link', $row_Replies->UsersLink, NULL);
												foreach ($rows_Users as $row_Users) {
													echo $row_Users->Username;
												}
												?>	
											</span>
											<?php echo $row_Replies->Message; ?>
										</div>
										<div style="font-style: italic; font-size: 0.6em; color: var(--leaf-color); text-align: right;">
											<?php echo date("d-M-y H:i", strtotime($row_Replies->Created)); ?>
										</div>
										<!-- starts here -->
										<div class="comments-item">
											<div class="comment-commands">
												<div onclick="Toggle('<? echo "re-reply-input".$row_Replies->Id; ?>');">
													Reply
												</div>
												<div>
													Report <span class="symbols">&#10071;</span>
												</div>															
											</div>
											<div class="reply" id="<? echo 're-reply-input'.$row_Replies->Id; ?>">
												<div>
													<span class="textarea" id="<? echo 'Re-Reply'.$row_Replies->Id; ?>" role="textbox" contenteditable onclick=""><? echo "@".$row_Users->Username." | "; ?>
													</span>
												</div>
												<div>
													<!-- <button onclick="alert('<? echo $row_Replies->Id; ?>');">Test</button> -->
													<button class="btn-comment" style="display: block;" onclick="insertReReply('<? echo $row_Replies->Id; ?>', '<? echo $row_Comments->Id ;?>');">Post Reply!</button>
												</div>
											</div>														
										</div>
										<!-- ends here -->
									</div>												
								</div>
							<?php endforeach ?>
						</div>
						<!-- end of replies -->
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>
