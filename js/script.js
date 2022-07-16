const status = document.getElementById('status');
const container = document.querySelector(".container");
// const form = document.getElementById('form');
// const input = document.getElementById('input');


// const set_status = document.getElementById('set_status');
// const get_status = document.getElementById('get_status');

const ws = new WebSocket('ws://localhost:2346');

function setStatus(value) {
    status.innerHTML = value;

    // if user loginned
    if(typeof(login_f) != "undefined" && login_f !== null)
        login_f();
}

function serverSendData(value) {
    ws.send(JSON.stringify(value));
}


ws.onopen = () => setStatus('ONLINE');

ws.onclose = () => setStatus('DISCONECTED');

ws.onmessage = response => {
    let return_data = JSON.parse(response.data);
    // console.log(return_data);

    switch (return_data['type_message']){
        case "message":
            let data = return_data['data'];

            UIkit.notification({message: data["message"], status: 'warning'})

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



