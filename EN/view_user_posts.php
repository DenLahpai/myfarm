<?php  
require_once "../functions.php";
if (!isset($_GET['UsersLink'])) {
	echo "Please go back and try again!";
	die();
}

$rows_Users = table_Users ('select_one_by_link', $_GET['UsersLink'], NULL);
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
	$job = "select_all";
}
else {
	$job = 'search';
}

if (!isset($_POST['page'])) {
	$page = 1;
}

else {
	$page = $_POST['page'];
}

if (empty($_POST['limit'])) {
	$rows_per_page = 6;
	$start_point = ($page - 1) * $rows_per_page;
	$limit = $start_point. ", ". $rows_per_page;
}

$rows_Posts = table_Posts ('select_one_user_posts', $row_Users->Id, NULL, $sorting, $limit);
$rowCount = table_Posts ('rowCount_for_one_user', $row_Users->Id, NULL, NULL, NULL);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<title>
		Post by <? echo $row_Users->Username; ?>
	</title>
</head>
<body>
	<header></header>
	<!-- main-content -->
	<div class="main-content">
		<!-- wrapper -->
		<div class="wrapper">
			<div class="title">
				<h4>Posts by <? echo $row_Users->Username; ?></h4>
			</div>
			<section id="search-bar"></section>    
			<section id="posts-data">
				<!-- grid-container -->
				<div class="grid-container">
					<input type="hidden" name="page" id="page" value="<? echo $page;?>">
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
											<span onclick="Toggle('<? echo 'post-user-menu'.$row_Posts->Id; ?>');"><?php echo $row_Users->Username; ?></span>
											<div id="<? echo 'post-user-menu'.$row_Posts->Id; ?>" class="post-user-menu">
												<div class="post-user-menu-items">
													<div>
														Send <span class="symbols">&#9993;</span>
													</div>
													<div onclick="window.location.href = 'view_user.php?UsersLink=<? echo $row_Users->UsersLink; ?>'">
														View User Info																				
													</div>
													<div onclick="view_user_posts('<? echo $row_Users->UsersLink;?>');">
														View User's Posts
													</div>
												</div>								
											</div>							
										</div>
										<div class="btn-post-menu" onclick="Toggle('<? echo "post-menu-items".$row_Posts->Id; ?>')">&#9776;</div>
									</div>										
								</div>
								<div id="<? echo 'post-menu-items'.$row_Posts->Id; ?>" class="post-menu-items">
									<div class="post-menu-item">						
										<div>
											Report<span class="symbols">&#10071;</span>
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
				</div>
				<!-- end of grid-container -->
				<div class="pagination-nav">
				    <div class="page-numbers">
				    	<?php 
					    $total_pages = ceil ($rowCount / $rows_per_page);
					    $page_limit = $page + 4;
					    
					    if ($page == 1) {
					    	$prev_page = $page;
					    } 	
					    else {
					    	$prev_page = $page - 1;
					    }
					    
					    if ($page == $total_pages) {
					    	$next_page = $page;
					    }
					    else {
					    	$next_page = $page + 1;
					    }

					    $current_page = $page;
					    
					    echo "<div class=\"page-number\" onclick=\"reloadPosts('".$prev_page."')\">Prev</div>";
					   	
					    while ($page <= $total_pages) {
					        if ($page == $current_page) {
					        	
					        	echo "<div class='current-page-number' onclick=\"reloadPosts('".$page."')\">".$page."</div>";
					        }
					        else {
					        	echo "<div class='page-number' onclick=\"reloadPosts('".$page."')\">".$page."</div>";
					        }
					        if ($page == $page_limit) {
					        	break;
					        }
					        $page++;
					    }

					     echo "<div class='page-number' onclick=\"reloadPosts('".$next_page."')\">Next</div>";
					  
						?>
				    </div>
				</div>
			</section>
		</div>
		<!-- end of wrapper -->
	</div>
	<!-- end of main-content -->
<footer></footer>
</body>
<script type="text/javascript" src="../scripts/jQuery.js"></script>
<script type="text/javascript" src="../scripts/main.js"></script>
<script type="text/javascript" src="scripts/scripts.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.get("includes/head.html", function (data) {
            $('head').prepend(data);
        });

        $("header").load("includes/header.html");

        $.get("includes/setting-menu.html", function(data) {
            $('.main-content').before(data);
        });

        $.get("includes/search_bar.html", function(data) {
            $("#search-bar").html(data);
        });

        $("footer").load("includes/footer.php");

        getTags(0);

        checkSession();

        setInterval(function() {
            checkSession();
        }, 1800000);
    });
</script>
</html>