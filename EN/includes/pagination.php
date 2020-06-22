<?php  
require_once "../../functions.php";
 
if (!isset($_GET['page'])) {
 	$page = 1;
 }
 else {
 	$page = $_GET['page'];
}

echo $_POST['rowCount'];

?>
<!-- pagination-nav -->
<div class="pagination-nav">

</div>
<!-- end of pagination-nav -->
