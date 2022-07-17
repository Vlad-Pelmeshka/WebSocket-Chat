<?php

	function getUser($connectionMYSQL,$userID){
		// $connectionMYSQL = $_SESSION["connectionMYSQL"];
		$sql = "SELECT p_id as id, p_login as login FROM person where p_id='" . $userID . "'";
		$result = mysqli_fetch_assoc(mysqli_query($connectionMYSQL, $sql));

		return $result;
	}

	function getlistActiveUser($wsWorker,$unsetUser = false){

		$listActiveUser = [];

		var_dump($unsetUser);

		foreach($wsWorker as $clientConnection) {
			if($unsetUser != $clientConnection->personData['userLogin']) // If user closed connection unset him from list
			$listActiveUser[] = $clientConnection->personData['userLogin'];
		}

		return $listActiveUser;
	}

	function updateListActiveUser($wsWorker,$unsetUser = false){

		// $listActive = getlistActiveUser($wsWorker->connections,$unsetUser);

		$user_data = [
            'type_message' => 'listActiveUser',
            'data' => getlistActiveUser($wsWorker->connections,$unsetUser)
        ];

        foreach($wsWorker->connections as $clientConnection)
            $clientConnection->send(json_encode($user_data));
	}
?>