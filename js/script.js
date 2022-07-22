const status = document.getElementById('status');
const container = document.querySelector(".container");

const active_personList = document.querySelector("#active_personList");
const message_box = document.querySelector("#message_block");

const ws = new WebSocket('ws://192.168.50.222:2346');
// const ws = new WebSocket('ws://localhost:2346');

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

document.querySelector("#send_input > button").onclick = function() {
    let message_data = document.querySelector("#send_input > input").value;
    document.querySelector("#send_input > input").value = '';
    if(message_data){
        sendData ={
            type_message: 'newMessage',
            data : message_data
        };
        serverSendData(sendData);
    }
}



ws.onopen = () => setStatus('ONLINE');

ws.onclose = () => setStatus('DISCONECTED');

ws.onmessage = response => {
    let return_data = JSON.parse(response.data);
    let data = '';
    // console.log(return_data);

    switch (return_data['type_message']){
        case "message":
            // send some of message
            data = return_data['data'];

            UIkit.notification({message: data["message"], status: 'warning'})

            break;

        case "newMessage":
            // send some of message
            data = return_data['data'];

            const p_newMessage = document.createElement('p');

            p_newMessage.innerHTML = data['data'];

            const span_newMessage = document.createElement('span');
            span_newMessage.className = "data_message";

            const spanTime_newMessage = document.createElement('span');
            spanTime_newMessage.className = "time";
            spanTime_newMessage.innerHTML = data['date'];

            span_newMessage.prepend(spanTime_newMessage);

            if(return_data['sender']){

                p_newMessage.className = "send";
            }else{

                p_newMessage.className = "receive";

                const spanUser_newMessage = document.createElement('span');
                spanUser_newMessage.className = "sender";
                spanUser_newMessage.innerHTML = data['user'] + ' ';
                span_newMessage.prepend(spanUser_newMessage);
            }

            p_newMessage.prepend(span_newMessage);

            message_box.prepend(p_newMessage);

            // console.log(p_newMessage);
            // console.log(return_data);

            // UIkit.notification({message: data["message"], status: 'warning'})

            break;

        case "listActiveUser":
            // update users list
            let listActiveUser = return_data['data'];

            active_personList_ul = active_personList.querySelector("ul");
            active_personList_ul.innerHTML ='';

            for (let name of listActiveUser){

                // for(let i = 0; i<5;i++){

                    const li = document.createElement('li');

                    li.innerHTML = name;
                    active_personList_ul.appendChild(li);
                // }
            }

            active_personList.querySelector('span[id="kol"]').innerHTML =listActiveUser.length;


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


