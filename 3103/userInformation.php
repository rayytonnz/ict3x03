<?php

function setRoleOptions() {
	if (isset($_SESSION['role'])) {
		include_once "../constant.php";
		include_once "../configuration/config.php";
	} else {
		include_once "/constant.php";
		include_once "/configuration/config.php";
	}

	$get_roles = "select * from users";
	$roles_result = mysqli_query($db, $get_roles);

	//populate the roles from database
	while ($row = mysqli_fetch_assoc($roles_result)) {
	    echo '<option value="' . $row['userRole'] . '">' . $row['role'] . '</option>';
	}

}

?>