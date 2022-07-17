<?php

	$config = array(
	    'server' => 'localhost',
	    'username' => 'root',
	    'password' => 'root',
	    'name' => 'websocket_chat'
	);

	// global $connectionMYSQL;

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

	$_SESSION['connectionMYSQL'] = $connectionMYSQL;
	// var_dump($connectionMYSQL);

	require_once "server_model.php";

?>