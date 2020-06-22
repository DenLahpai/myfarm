<?php 
require_once "../../functions.php";
if (isset($_SESSION['UsersId'])) {
	$rows_Users = table_Users ('select_one', $_SESSION['UsersId'], NULL);
	foreach ($rows_Users as $row_Users) {
		# code...
	}
}
?>
<!-- update-user-form -->
<div class="update-user-form">
	<form id="update-user-form" method="POST" action="update_user.php">
		<!-- update-user-form-items -->
		<div class="update-user-form-items">
			<div class="update-user-form-item" style="font-weight: bold; text-align: center;">
				<? echo $row_Users->Username; ?>
			</div>
			<div class="update-user-form-item">
				<select name="Title" id="Title">
					<?php 
					switch ($row_Users->Title) {
						case 'Mr':
							echo "<option value=\"Mr\" selected>Mr</option>";
							echo "<option value=\"Mrs\">Mrs</option>";
							echo "<option value=\"Ms\">Ms</option>";			
							break;

						case 'Mrs':
							echo "<option value=\"Mr\" selected>Mr</option>";
							echo "<option value=\"Mrs\">Mrs</option>";
							echo "<option value=\"Ms\">Ms</option>";			
							break;	

						case 'Ms':
							echo "<option value=\"Mr\" selected>Mr</option>";
							echo "<option value=\"Mrs\">Mrs</option>";
							echo "<option value=\"Ms\">Ms</option>";			
							break;	
						
						default:
							# code...
							break;
					}
					?>
				</select>
				<input type="text" name="Name" id="Name" value="<? echo $row_Users->Name; ?>" >
			</div>		
			<div class="update-user-form-item">
				Mobile
				<input type="text" name="Mobile" id="Mobile" value="<? echo $row_Users->Mobile; ?>">
			</div>
			<div class="update-user-form-item">
				Email:
				<input type="text" name="Email" id="Email" onchange="validateEmail(this.value);" value="<? echo $row_Users->Email; ?>">
			</div>
			<div class="update-user-form-item">
				D.O.B: 
				<input type="date" name="DOB" id="DOB" value="<? echo $row_Users->DOB; ?>">
			</div>
			<div class="update-user-form-item" style="text-align: left;">
				Address:<br>
				<textarea name="Address" id="Address">
					<?php echo $row_Users->Address; ?>
				</textarea>
			</div>
			<div class="update-user-form-item">
				Town:	
				<input type="text" name="Town" id="Town" value="<? echo $row_Users->Town; ?>">
			</div>
			<div class="update-user-form-item">
				State:
				<input type="text" name="State" id="State" value="<? echo $row_Users->State; ?>">
			</div>
			<div class="update-user-form-item">
				<select name="CountryCode" id="CountryCode" style="width: 100%;">
					<?php  
					//getting data from the table Countries
					$rows_Countries = table_Countries ('select_all', NULL, NULL);
					foreach ($rows_Countries as $row_Countries) {
						if ($row_Users->CountryCode == $row_Countries->CountryCode) {
							echo "<option value=\"$row_Countries->CountryCode\" selected>".$row_Countries->CountryCode." - 	".$row_Countries->Country."</option>";
						}
						else {
							echo "<option value=\"$row_Countries->CountryCode\">".$row_Countries->Country."</option>";	
						}
					}
					?>					
				</select>
			</div>
			<div class="update-user-form-item" style="text-align: center">
				<button type="button" id="btn-submit" onclick="updateUserData();">Update</button>
			</div>
			<div class="update-user-form-item" id="response"></div>
		</div>
		<!-- end of update-user-form-items -->
	</form>
</div>
<!-- end of update-user form -->