
let login_f = function login() {
    sendData ={
            type_message: 'login_user',
            data : {
                 userID: '<?php echo $_SESSION['login'] ?>',
            }
        };
    serverSendData(sendData);
}