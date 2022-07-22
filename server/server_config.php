<?php

	$config = array(
	    'server' => 'localhost',
	    'username' => 'root',
	    'password' => 'root',
	    'name' => 'websocket_chat'
	);

	function connectionMYSQL($config){
		$connectionMYSQL = mysqli_connect(
		    $config['server'],
		    $config['username'],
		    $config['password'],
		    $config['name']
		);

		if( $connectionMYSQL == false )
		{
		    echo 'Не вдалося підключитися до бази даних';
		    echo mysqli_connect_error(); //вывод ошибки почему не подключилось
		    exit();
		}

		return $connectionMYSQL;
	}

	require_once "server_model.php";

?>