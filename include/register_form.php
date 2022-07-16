        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

        <div class="container">
            <div class="frame">
                <div class="nav">
                    <ul class="links">
                        <li class="signin-active"><a class="btn_register">Увійти</a></li>
                        <li class="signup-inactive"><a class="btn_register">Створити аккаунт</a></li>
                    </ul>
                </div>

                <div ng-app ng-init="checked = false">
                    <form class="form-signin" action="" method="post" name="form">
                        <label for="username">Нікнейм</label>
                        <input class="form-styling" maxlength="30" type="text" name="username" placeholder=""/>
                        <label for="password">Пароль</label>
                        <input class="form-styling" maxlength="30" type="password" name="password" placeholder=""/>

                        <div class="btn-animate">
                            <a class="btn-signin">Увійти</a>
                        </div>
                    </form>

                    <form class="form-signup" action="" method="post" name="form">
                        <label for="fullname">Нікнейм</label>
                        <input class="form-styling" maxlength="30" type="text" name="fullname" placeholder=""/>
                        <!-- <label for="email">Email</label>
                        <input class="form-styling" type="text" name="email" placeholder=""/> -->
                        <label for="password_new">Пароль</label>
                        <input class="form-styling" maxlength="30" type="password" name="password_new" placeholder=""/>
                        <label for="confirmpassword">Підтвердити пароль</label>
                        <input class="form-styling" maxlength="30" type="password" name="confirmpassword" placeholder=""/>
                        <a class="btn-signup">Зареєструватися</a>
                        <!-- <a ng-click="checked = !checked" class="btn-signup">Зареєструватися</a> -->
                    </form>
                </div>
            </div>

        </div>
