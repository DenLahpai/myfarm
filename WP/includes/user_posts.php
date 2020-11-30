<?php
require_once "../../functions.php";

if (empty($_POST['sorting'])) {
	$sorting = 'ORDER BY Created DESC';
}
else {
	$sorting = $_POST['sorting'];
}

if (empty($_POST['search'])) {
	$job = 'select_one_user_posts';
}
else {
	$job = 'search_one_user_posts';
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

if (isset($_REQUEST['UsersLink']) || !empty($_REQUEST['UsersLink']) || $_REQUEST['UsersLink'] != "") {
    // getting UsersId
    $rows_Users = table_Users ('select_one_by_link', $_REQUEST['UsersLink'], NULL);
    foreach ($rows_Users as $row_Users) {
        # code...
    }
    // getting Posts by User
    $rows_Posts = table_Posts ($job, $row_Users->Id, NULL, $sorting, $limit);
}
?>
<!-- grid-container -->
<div class="grid-container">
<input type="hidden" name="page" id="page" value="<? echo $page;?>">
<?php foreach ($rows_Posts as $row_Posts): ?>
    <div class="grid-item">
        <div class="post-items" style="border: 2px solid var(--honey-color);">
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
                                <div onclick="window.location.href = 'view_user.php?UsersLink=<? echo $row_Users->Link; ?>'">
                                    View User Info																				
                                </div>
                            </div>								
                        </div>							
                    </div>
                    <div class="btn-post-menu" onclick="Toggle('<? echo "post-menu-items".$row_Posts->Id; ?>')">&#9776;</div>
                </div>										
            </div>
            <div id="<? echo 'post-menu-items'.$row_Posts->Id; ?>" class="post-menu-items">
                <div class="post-menu-item">
                    <div onclick="bookmarkPost('<? echo $row_Posts->Link; ?>');">
                        Bookmark <span class="symbols">&#9873;</span>
                    </div>							
                    <div>
                        Report <span class="symbols">&#10071;</span>
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