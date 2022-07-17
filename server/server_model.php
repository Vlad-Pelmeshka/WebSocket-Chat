<?php

	function getUser($userID){
		$connectionMYSQL = $_SESSION["connectionMYSQL"];
		$sql = "SELECT p_id as id, p_login as login FROM person where p_id='" . $userID . "'";
		$result = mysqli_fetch_assoc(mysqli_query($connectionMYSQL, $sql));

		return $result;
	}
?>