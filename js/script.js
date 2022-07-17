const status = document.getElementById('status');
const container = document.querySelector(".container");

const active_personList = document.querySelector("#active_personList > ul");

const ws = new WebSocket('ws://localhost:2346');

function setStatus(value) {
    status.innerHTML = value;

    // if user loginned
    if(typeof(login_f) != "undefined" && login_f !== null){
        login_f();

        sendData ={
            type_message: 'listActiveUser'
        };
        serverSendData(sendData);
    }
}

function serverSendData(value) {
    ws.send(JSON.stringify(value));
}


ws.onopen = () => setStatus('ONLINE');

ws.onclose = () => setStatus('DISCONECTED');

ws.onmessage = response => {
    let return_data = JSON.parse(response.data);
    console.log(return_data);

    switch (return_data['type_message']){
        case "message":
            // send some of message
            let data = return_data['data'];

            UIkit.notification({message: data["message"], status: 'warning'})

            break;

        case "listActiveUser":
            // update users list
            let listActiveUser = return_data['data'];

            active_personList.innerHTML ='';

            for (let name of listActiveUser){

                const li = document.createElement('li');

                li.innerHTML = name;
                active_personList.appendChild(li);
            }


            break;
    }

};



//ws.onmessage = response => printMessage(response);

/*function printMessage(value) {
    console.log(value);

    //const li = document.createElement('li');

    //li.innerHTML = value.data;
    //messages.appendChild(li);
}*/

// form.addEventListener('submit', event => {
//     event.preventDefault();

//     // ws.send(input.value);
//     ws.send(input.value);
//     input.value = '';

// });


/*set_status.addEventListener('click', event => {

    let sendData ={
        type_message: 'register'
    };

    ws.send(JSON.stringify(sendData));
})

get_status.addEventListener('click', event => {

    let sendData ={
        type_message: 'get_type'
    };

    ws.send(JSON.stringify(sendData));
})*/



