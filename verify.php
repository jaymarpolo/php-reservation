<?php 
	if (isset($_GET['vkey'])) {
		$vkey = $_GET['vkey'];

		$mysqli = new mysqli('localhost', 'u704970076_ers', 'tarroza', 'u704970076_ers');

		$resuletSet = $mysqli->query("SELECT verified, vkey FROM tbl_user WHERE verified = 0 AND vkey = '$vkey' LIMIT 1");

		if($resuletSet->num_rows == 1) {
			$update = $mysqli->query("UPDATE tbl_user SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");

			if ($update) {
				echo "Your account has been verified. You may now log in";
			}
			else{
				echo $mysqli->error;
			}
		}
		else{
			echo "This account is invalid or already verified";
		}
	}
	else{
		die("Something is wrong");
	}
 ?>