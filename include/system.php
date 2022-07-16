<?php

	require "data.php";

	switch ($_POST['request']) {
		case 'login_user':
			$data = json_decode($_POST['data'], true);

			if(!($data['username'] && $data['password'])){
                echo "-1";  // Not all data is complete
				return;
			}

			$sql = "SELECT * FROM person where p_login='" . $data['username'] . "' and p_pass='" .  md5($data['password']) . "'";
			$result = mysqli_fetch_assoc(mysqli_query($connection, $sql));

			if($result)
				echo $result['p_id']; // Success
			else
				echo -2; // Not found data

			break;

		case 'register_user':
			$data = json_decode($_POST['data'], true);

			if(!($data['fullname'] && $data['password_new'] && $data['confirmpassword'])){
                echo "-1";  // Not all data is complete
				return;
			}

			if (strlen($data['password_new']) < 8){
				echo "-4"; // Password so short
				return;
			}

			if ($data['password_new'] != $data['confirmpassword']){
				echo "-2"; // Password and confirmpassword not the same
				return;
			}


			if (strlen($data['fullname']) < 5){
				echo "-5"; // Login so short
				return;
			}

			$sql = "SELECT count(*) as count  FROM person where p_login='" . $data['fullname'] . "'";

			if(mysqli_fetch_assoc(mysqli_query($connection, $sql))['count'] != 0){
				echo "-3"; // Login already exists
				return;
			}

			$flag = 1;
			$person_id;
			do{
				$person_id = md5(($data['password_new'] . time() . rand(0,100)));
				$sql = "SELECT count(*) as count FROM person where p_id='" . $person_id . "'";

				if(mysqli_fetch_assoc(mysqli_query($connection, $sql))['count'] == 0)
					$flag = 0; // Hash is unique
			}while ($flag);

			$sql = "INSERT INTO `person` (`p_id`, `p_login`, `p_pass`) VALUES ('" . $person_id . "', '" . $data['fullname'] . "', '" . md5($data['password_new']) . "')";
			mysqli_query($connection, $sql);

			echo $person_id;

			break;

		default:
			include '404.php';

			break;
	}

?>