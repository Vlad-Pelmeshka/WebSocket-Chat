<?php

	function getUser($connectionMYSQL,$userID){
		// $connectionMYSQL = $_SESSION["connectionMYSQL"];
		$sql = "SELECT p_id as id, p_login as login FROM person where p_id='" . $userID . "'";
		$result = mysqli_fetch_assoc(mysqli_query($connectionMYSQL, $sql));

		return $result;
	}

	function getlistActiveUser(){

		$listActiveUser = [];

		foreach($wsWorker->connections as $clientConnection) {
			$listActiveUser[] = $clientConnection->personData;
		}

		return json_encode($listActiveUser);
	}
?>