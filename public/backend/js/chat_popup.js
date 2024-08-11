const chatbotToggler = document.querySelector(".chatbot-toggler");
const closeBtn = document.querySelector(".close-btn");
const chatbox = document.querySelector(".chatbox");
const chatInput = document.querySelector(".chat-input textarea");
const sendChatBtn = document.querySelector(".chat-input span");
const userForm = document.querySelector("#userForm");
const disconnectDiv = document.querySelector(".chatbot header .disconnect");
const emailInput = document.getElementById('emailId');
const beginChatForm = document.querySelector('.beginChatForm');


chatInput.disabled = true;
chatInput.placeholder = '';
closeBtn.addEventListener("click", () => document.querySelector(".newBody").classList.remove("show-chatbot"));
chatbotToggler.addEventListener("click", () => document.querySelector(".newBody").classList.toggle("show-chatbot"));

const inputInitHeight = chatInput.scrollHeight;


emailInput.addEventListener("keydown", (e) => {
    // width is greater than 800px, handle the chat
    //  && window.innerWidth > 800
    if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault();

        beginChat();
    }
});


// If Enter key is pressed without Shift key and the window
chatInput.addEventListener("keydown", (e) => {
    // width is greater than 800px, handle the chat
    // && window.innerWidth > 800
    if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault();

        sendMessage();
    }
});


// Adjust the height of the input textarea based on its content
chatInput.addEventListener("input", () => {
    chatInput.style.height = `${inputInitHeight}px`;
    chatInput.style.height = `${chatInput.scrollHeight}px`;
});


// ----- SignalR related things ----
var hubsURL = 'http://chat.icicle.site/hubs/';
// var hubsURL = 'https://localhost:7149/hubs/';
let msgHubConnection = new signalR.HubConnectionBuilder()
    .withUrl(hubsURL + "message")
    //.withAutomaticReconnect()
    .configureLogging(signalR.LogLevel.Information)
    .build();

msgHubConnection.serverTimeoutInMilliseconds = 1000 * 60 * 60 * 12; // 24 hrs
//msgHubConnection.serverTimeoutInMilliseconds = 1000 * 10;

// Enable keep-alive messages (optional but recommended)
// presenceConnection.keepAliveIntervalInMilliseconds = 15000; // Default is 15 seconds

let appUserDTO = {
    id: 0,
    name: null,
    email: null,
    role: 'CUSTOMER',
    companyName: 'ICICLE',
    connectionId: msgHubConnection.connectionId,
    groupName: null,
    agentEmail: null
};

let messageCreateDto = {
    senderEmail: null,
    recipientEmail: null,
    groupName: null,
    content: null
};

let messages = [];
let agentEmail = null;

function getCustomerFromLocalstorage() {
    let userString = localStorage.getItem("appUserDTO");
    let appUserDTO = JSON.parse(userString);
    return appUserDTO;
}

function setCustomerToLocalstorage(appUserDTO) {
    localStorage.setItem("appUserDTO", JSON.stringify(appUserDTO));
}

function renderMessages() {
    let custEmail = getCustomerFromLocalstorage().email;
    let msgClass = '';
    chatbox.innerHTML = '';

    messages.forEach(message => {
        msgClass = message.senderEmail === custEmail ? 'outgoing' : 'incoming';
        let ChatLi = createChatLi(message.content, msgClass);
        chatbox.appendChild(ChatLi);
    });

    chatbox.scrollTo(0, chatbox.scrollHeight);
}


msgHubConnection.on("customerConnectedResponse", (appUserDTO, status, continueConnection) => {
    setCustomerToLocalstorage(appUserDTO);

    let ChatLi = createChatLi(status, 'incoming');
    chatbox.appendChild(ChatLi);
    chatbox.scrollTo(0, chatbox.scrollHeight);

    if (!continueConnection) {
        msgHubConnection.stop();
        // re show form
    }

});

msgHubConnection.on("GrpFormed", (grpName, custCompany) => {
    let appUser = getCustomerFromLocalstorage();
    appUser.groupName = grpName;
    appUser.agentEmail = grpName.split(' ')[0];
    setCustomerToLocalstorage(appUser);

    agentEmail = appUser.agentEmail;

    chatInput.disabled = false;
    chatInput.placeholder = 'Write your message...';
});


function playSoundNewMsg() {
    const audio = new Audio('/sounds/new_msg.mp3');
    audio.play();
}



msgHubConnection.on("NewMessage", (msg) => {

    if (msg.senderEmail === agentEmail) {
        playSoundNewMsg();
    }

    messages.push(msg);
    if (messages.length > 0) {
        renderMessages();
    }
});


//msgHubConnection.onclose(function () {
//    localStorage.removeItem("appUserDTO");
//});


//function showOnlineOfflineMsg() {
//        alert("online");

//        const chatLi = document.createElement("li");
//        chatLi.classList.add("chat" );
//        let chatContent = `<p class="online">you are back online.</p>`;
//        chatLi.innerHTML = chatContent;

//        chatbox.appendChild(chatLi);
//        chatbox.scrollTo(0, chatbox.scrollHeight);
//}

function isHubOnline() {
    if (msgHubConnection?.state === signalR.HubConnectionState.Connected) {
        return true;
    } else {
        return false;
    }
}

//function DisconnectCustomer() {
//    this.msgHubConnection.stop();
//}

//function CreateDisconnectBtn() {
//    let btn = document.createElement("button");
//    btn.innerText = "Disconnect";
//    btn.classList.add('btn', 'btn-danger');

//    disconnetDiv = document.querySelector(".chatbot header .disconnect");
//    disconnetDiv.appendChild(btn);

//    btn.addEventListener('click', Disconnect);

//}


// li.className> p > msg
function createChatLi(message, className) {
    const chatLi = document.createElement("li");
    chatLi.classList.add("chat", `${className}`);

    let chatContent = className === "outgoing" ? `<p></p>` :
        `<span class="material-symbols-outlined" style="margin-bottom: 1rem;">account_circle</span><p></p>`;
    chatLi.innerHTML = chatContent;
    chatLi.querySelector("p").textContent = message;

    return chatLi;
}


function connect() {

    msgHubConnection.start()
        .then(() => {
            appUserDTO.name = emailInput.value.trim();
            appUserDTO.email = appUserDTO.name;
            appUserDTO.connectionId = msgHubConnection.connectionId;

            msgHubConnection.invoke("CustomerConnected", appUserDTO)
                .then(r => {
                    custPastMessages(appUserDTO.email, appUserDTO.companyName);
                })
                .catch(err => console.error(err.toString()));

        })
        .catch(err => console.error(err.toString()));
}


async function custPastMessages(email, custCompany) {
    const url = `https://localhost:7149/api/Message/CustPastMessages/${encodeURIComponent(email)}/${encodeURIComponent(custCompany)}`;

    try {
        const response = await fetch(url);
        messages = await response.json();
        if (messages.length > 0) {
            renderMessages();
        }
    } catch (error) {
        console.error('Error fetching data: ', error);
    }
}



function beginChat() {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (beginChatForm) {
        if (emailPattern.test(emailInput.value) == true) {
            beginChatForm.remove();
            //chatInput.disabled = false;
            //chatInput.placeholder = 'Write your message...';

            connect();
        }
        else {
            alert('Please enter a valid email address.');
        }
    }
}

function sendMessageFinal(appUserDTO, companyName) {
    let msgContent = document.getElementById("message").value.trim(); // Get user entered message and remove extra whitespace

    if (!msgContent) {
        return;
    }
    else {
        messageCreateDto.senderEmail = appUserDTO.email;
        messageCreateDto.content = msgContent;
        messageCreateDto.recipientEmail = appUserDTO.agentEmail;
        messageCreateDto.groupName = appUserDTO.groupName;

        msgHubConnection.invoke("SendMessage", messageCreateDto, companyName)
            .catch(function (err) {
                return console.error(err.toString());
            });
        // reset form
        chatInput.style.height = `${inputInitHeight+5}px`;
        chatInput.value = '';
        chatInput.focus();
    }
}


function playSoundUserOffline() {
    const audio = new Audio('/sounds/user_offline.mp3');
    audio.play();
}

function actIfHubOffline(){
    if (isHubOnline() === false) {

        //showOfflineMsg();
        var chatli = createChatLi('You are offline. Reloading.', 'error');
        chatbox.appendChild(chatli);
        chatbox.scrollTo(0, chatbox.scrollHeight);

        chatInput.disabled = true;
        playSoundUserOffline();


        setTimeout(() => {
            location.reload();
        }, 3000);
    }
}



function sendMessage() {
    //document.event.preventDefault(); // Prevent form from submitting normally

    let appUserDTO = getCustomerFromLocalstorage();

    if (isHubOnline() === false) {
        //if (appUserDTO != null) {
        //    connect();
        //}
        //sendMessageFinal(appUserDTO);

        //actIfHubOffline();
    }
    else {
        sendMessageFinal(appUserDTO, appUserDTO.companyName);
    }
}



let c = getCustomerFromLocalstorage();
if (c != null) {
    emailInput.value = c.email;

    beginChat();
}



// --- AUTO TESTING --

//emailInput.value = "c@gmail.com";
//beginChat();

/// test end----

