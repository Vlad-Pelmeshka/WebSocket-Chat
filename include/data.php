<?php

	$currentDir = './';
	$NameSite = 'testwebsocketchat';

	$config = array(
	    'server' => 'localhost',
	    'username' => 'root',
	    'password' => 'root',
	    'name' => 'websocket_chat'
	);


	$connection = mysqli_connect(
	    $config['server'],
	    $config['username'],
	    $config['password'],
	    $config['name']
	);

	if( $connection == false )
	{
	    echo 'Не вдалося підключитися до бази даних';
	    echo mysqli_connect_error(); //вывод ошибки почему не подключилось
	    exit();
	}


 ?>