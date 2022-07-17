<?php

	function getUser($connectionMYSQL,$userID){
		var_dump($connectionMYSQL);
		$sql = "SELECT p_id as id, p_login as login FROM person where p_id='" . $userID . "'";
		$result = mysqli_query($connectionMYSQL, $sql);
		// $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));

		return $result;
	}
	//var_dump(mysqli_fetch_assoc(getUser($connection,"76f35e6403289a021834f7af8d741dce")));
	// var_dump($connection);
 ?>