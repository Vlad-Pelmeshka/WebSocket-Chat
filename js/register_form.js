const btnSignin = document.querySelector(".btn-signin");
const btnSignup = document.querySelector(".btn-signup");


let btn_register = document.querySelectorAll(".btn_register");

for (let elem of btn_register){
    elem.onclick = function() {
        document.querySelector(".form-signin").classList.toggle("form-signin-left");
        document.querySelector(".form-signup").classList.toggle("form-signup-left");
        document.querySelector(".frame").classList.toggle("frame-long");
        document.querySelector(".signup-inactive").classList.toggle("signup-active");
        document.querySelector(".signin-active").classList.toggle("signin-inactive");
    };
}


btnSignin.onclick = function() {
    let sendData ={
        username: document.querySelector("input[name='username']").value,
        password: document.querySelector("input[name='password']").value
    };

    $.ajax({
        url: '../include/system.php',
        type: 'POST',
        data: {
            'request'   : 'login_user',
            'data'      : JSON.stringify(sendData)
        }
    }).done(function(data){
        switch(data){
            case '-1':
                UIkit.notification({message: 'Не всі поля заповнені', status: 'warning'});
                break;
            case '-2':
                UIkit.notification({message: 'Дані не співпадають. Перевірте введені дані', status: 'danger'});
                break;
            default:
                UIkit.notification({message: 'Авторизація пройшла успішно', status: 'success'});

                // Create a form. Send PersonID for set Session
                setTimeout( createSendForm, 2000, '/','personID', data);
                break;
        }
    });
}

btnSignup.onclick = function() {
    let sendData ={
        fullname: document.querySelector("input[name='fullname']").value,
        password_new: document.querySelector("input[name='password_new']").value,
        confirmpassword: document.querySelector("input[name='confirmpassword']").value
    };

    $.ajax({
        url: '../include/system.php',
        type: 'POST',
        data: {
            'request'   : 'register_user',
            'data'      : JSON.stringify(sendData)
        }
    }).done(function(data){
        switch(data){
            case '-1':
                UIkit.notification({message: 'Не всі поля заповнені', status: 'warning'})
                break;
            case '-2':
                UIkit.notification({message: 'Паролі не співпадають', status: 'danger'})
                break;
            case '-3':
                UIkit.notification({message: 'Даний логін вже існує, спробуйте інший', status: 'warning'})
                break;
            case '-4':
                UIkit.notification({message: 'Пароль занадто короткий. Мінімум 8 символів', status: 'danger'})
                break;
            case '-5':
                UIkit.notification({message: 'Логін занадто короткий. Мінімум 5 символів', status: 'danger'})
                break;
            default:
                UIkit.notification({message: 'Реєстрація пройшла успішно', status: 'success'})

                // Create a form. Send PersonID for set Session
                setTimeout( createSendForm, 2000, '/','personID', data);
                break;
        }
    });

}

// Create a form. Send PersonID for set Session
function createSendForm(action,name,data){
    var form = document.createElement('form');
    form.style.visibility = 'hidden'; // no user interaction is necessary
    form.method = 'POST';
    form.action = action;

    var input = document.createElement('input');
    input.name = name;
    input.value = data;
    form.appendChild(input);

    document.body.appendChild(form); // add form to body
    form.submit(); // send the payload and navigate
}
