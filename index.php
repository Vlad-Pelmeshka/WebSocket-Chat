<?php
    session_start();
    require_once "include/data.php";
    //var_dump($_SESSION);
    if($_POST['personID']){ setSession($_POST['personID']); /*$_SESSION['login'] = $_POST['personID'];*/ };
?>
<!DOCTYPE html>
<html lang="uk">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1.0, user-scalable=no">
        <title>VladChat</title>

        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.1/dist/css/uikit.min.css" />

        <link rel="stylesheet" href="css/style.css">

        <!-- UIkit JS -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.1/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.1/dist/js/uikit-icons.min.js"></script>

        <?php if(!($_SESSION['login'])){
            echo '<link rel="stylesheet" href="css/register_form.css">';
        } ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>

    <body>

        <header class="uk-margin-top">
            <h1>VladChat</h1>
            <span id="status">OFFLINE</span>
        </header>
        <?php if(!($_SESSION['login'])){
            require "include/register_form.php";

         }else{
            require "include/forum.php";



            //echo "You login))"; // Сюда вывести список подключённых пользователей
            ?>
            <script>
                let login_f = function login() {
                    sendData ={
                            type_message: 'login_user',
                            data : {
                                 userID: '<?php echo $_SESSION['login'] ?>',
                            }
                        };
                    serverSendData(sendData);
                }
            </script>
            <?php
         } ?>













        <!-- <main>
            <ul id="messages"></ul>

            <form id="form">
                <label for="message">&gt;</label>
                <input type="text" id="input" required autofocus autocomplete="off">
            </form>
        </main>

        <button id="set_status">1Задать статус персоны</button>
        <button id="get_status">Вернуть статус</button> -->

        <!-- <script src="js/script.js"></script> -->
        <script src="js/<?php echo $_SESSION['login'] ? 'script' : 'register_form' ?>.js"></script>




    </body>
</html>