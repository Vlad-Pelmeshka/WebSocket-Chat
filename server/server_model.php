<?php

	function getUser($connectionMYSQL, $userID){
		// $connectionMYSQL = $_SESSION["connectionMYSQL"];
		$sql = "SELECT p_id as id, p_login as login FROM person where p_id='" . $userID . "'";
		$result = mysqli_fetch_assoc(mysqli_query($connectionMYSQL, $sql));

		return $result;
	}

	function getlistActiveUser($wsUsers){

		$listActiveUser = [];

		foreach($wsUsers as $clientConnection) {
			$listActiveUser[] = $clientConnection['login'];
		}

		return $listActiveUser;
	}

	function  closeConnection(&$wsUsers, $connection){

		// pointer to the user in the list
		$user = &$wsUsers[$connection->personData['userID']];

		// enumerate user connections and delete the specified
		foreach ($user['connections'] as $key => $value) {
			if($value == $connection){
				unset($user['connections'][$key]);
				break;
			}
		}

		// delete user if he has no more connections
		if(count($user['connections']) == 0)
			unset($wsUsers[$connection->personData['userID']]);
	}

	function updateListActiveUser($wsUsers, $wsWorker){

		$user_data = [
            'type_message' => 'listActiveUser',
            'data' => getlistActiveUser($wsUsers)
        ];

        foreach($wsWorker->connections as $clientConnection)
            $clientConnection->send(json_encode($user_data));
	}

	function sendUserNewMessage($wsWorker, $data, $connection){

		$user_data = [
            'type_message' => 'newMessage',
            'data' => $data
        ];

        foreach($wsWorker->connections as $clientConnection){
        	/*var_dump($clientConnection->personData['userID']);
        	var_dump($connection->personData['userID']);*/
        	$user_data['sender'] = ($clientConnection->personData['userID'] == $connection->personData['userID']) ? true : false;
        		// $user_data['sender'] = 'true';
            $clientConnection->send(json_encode($user_data));
        }
	}

	function addMessageBD($connectionMYSQL, $data, $personData){
		// var_dump($data);

		$sql = "INSERT INTO `message` (`id`, `room_id`, `user_id`, `content`, `time`) VALUES (NULL, '1', '" . $personData . "', '" . $data['data'] . "', '" . $data['date'] . "')";
		mysqli_query($connectionMYSQL, $sql);
	}
?>