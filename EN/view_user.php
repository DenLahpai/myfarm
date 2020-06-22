<?php  
require_once "../functions.php";
if (!isset($_GET['UsersLink']) || empty($_GET['UsersLink']) || $_GET['UsersLink'] == "") {
	echo "Please go back and try agian!";
	die();
}
//getting data from the table Users
$rows_Users = table_Users ('select_one_by_link', $_GET['UsersLink'], NULL);
foreach ($rows_Users as $row_Users) {
	# code...
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<title><?php echo $row_Users->Username; ?></title>	
</head>
<body>
	<header></header>
	<!-- main-content -->
	<div class="main-content">
		<!-- wrapper -->
		<div class="wrapper">
			<div class="title">
				<h4>Users: <? echo $row_Users->Username; ?></h4>
			</div>
			<!-- sub-menu -->
			<div class="sub-menu">
				<!-- sub-menu-items -->
				<div class="sub-menu-items">
					<div class="sub-menu-item">
						<a href="<? echo 'view_user_posts.php?UsersLink='.$row_Users->UsersLink; ?>">Posts</a>
					</div>
				</div>
				<!-- end of sub-menu-items -->
			</div>	
			<!-- end of sub-menu -->
			<section id="view-user">
				<!-- view-user -->
				<div class="view-user">
					<!-- view-user-items -->
					<div class="view-user-items">
						<div class="view-user-item">
							<?php echo $row_Users->Title.". ".$row_Users->Name; ?>
						</div>
						<div class="view-user-item">
							Tel:
							<?php echo $row_Users->Mobile; ?>
						</div>
						<div class="view-user-item">
							Email: 
							<?php 
							if (isset($row_Users->Email)) {
								echo "<a href=\"mailto: $row_Users->Email\">".$row_Users->Email."</a>";
							}
							?>
						</div>
						<div class="view-user-item">
							Address: 
							<?php echo $row_Users->Address; ?>
						</div>
						<div class="view-user-item">
							Town:
							<?php echo $row_Users->Town; ?>
						</div>
						<div class="view-user-item">
							State:
							<?php echo $row_Users->State; ?>
						</div>
					</div>
					<!-- end of view-user-items -->
				</div>
				<!-- end of view-user -->
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

              
        $("footer").load("includes/footer.php");

        getTags(0);

        checkSession();

        setInterval(function() {
            checkSession();
        }, 1800000);
    });
</script>
</html>