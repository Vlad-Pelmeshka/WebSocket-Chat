<?php

	/*function getUser($connectionMYSQL,$userID){
		var_dump($connectionMYSQL);
		$sql = "SELECT p_id as id, p_login as login FROM person where p_id='" . $userID . "'";
		$result = mysqli_query($connectionMYSQL, $sql);
		// $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));

		return $result;
	}*/

	function setSession($data){
		$_SESSION['login'] = $data;
		//var_dump($data);
		echo "<script>location = '/';</script>";
	}

	function MessageList($connection){
		$sql = "SELECT message.*, person.p_login as login FROM `message`, person where user_id=p_id";
		$result = mysqli_query($connection, $sql);

		$return = [];

		foreach ($result as $key => $value) {
			$return[] = $value;
		}

		return array_reverse($return);
	}
 ?>