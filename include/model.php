<?php

	function getUser($connectionMYSQL,$userID){
		var_dump($connectionMYSQL);
		$sql = "SELECT p_id as id, p_login as login FROM person where p_id='" . $userID . "'";
		$result = mysqli_query($connectionMYSQL, $sql);
		// $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));

		return $result;
	}

	function setSession($data){
		$_SESSION['login'] = $data;
		//var_dump($data);
		echo "<script>location = '/';</script>";
	}
 ?>