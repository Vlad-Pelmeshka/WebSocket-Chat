<?php

    session_start();
    use Workerman\Worker;
    require_once __DIR__ . '/../vendor/autoload.php';

    $wsWorker = new Worker('websocket://0.0.0.0:2346');

    $wsWorker->count = 4; // количество процесов которое будет обрабатывать подключение от клиентов

    include "server_config.php";

$wsWorker->onConnect = function ($connection) {
    echo "New connection \n";
};

$wsWorker->onClose = function ($connection) {
    echo "Connection closed \n";
};

$wsWorker->onMessage = function ($connection, $data) use ($wsWorker) {
    $new_data = json_decode($data, true);
    // var_dump($data);
    switch ($new_data['type_message']){
        case 'login_user':

            if($connection->personData['userID']) // User already register
                return;
            $userData = getUser($new_data['data']['userID']);

            $connection->personData['userID'] = $new_data['data']['userID'];
            $connection->personData['userLogin'] = $userData['login'];
            var_dump($connection->personData);
            break;
        case 'listActiveUser':
            /*$data = $new_data['data'];
            $connection->personData['userID'] = $data['userID'];
            var_dump($connection->personData);*/
            break;

        /*case 'register':
            $connection->person_type = 'person';
            var_dump("Person status changed to " . $connection->person_type);
            break;
        case 'get_type':
            var_dump("Person status: " . $connection->person_type);
            //$clientConnection->send($connection->person_type);
            break;*/
    }
    //var_dump($connection);
    /*foreach($wsWorker->connections as $clientConnection) {
        // $clientConnection->send($data);
        $clientConnection->send($data);
    }*/
};

Worker::runAll();

