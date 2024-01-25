function loadData(url, callbackFunction) {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        callbackFunction(this);
    }

    xhr.open("GET", url, true);
    xhr.send();
}

function findUser(xhr) {
    if(xhr.readyState == 4 && xhr.status == 200) {
        document.getElementById("search_result").innerHTML = xhr.responseText;
        document.getElementById("search_result").style.removeProperty("display");
    }
}

function addToChatList(xhr) {
    if(xhr.readyState == 4 && xhr.status == 200) {
        var html = xhr.responseText;
        document.getElementById("chat_profiles").insertAdjacentHTML("afterbegin", html);
        document.querySelector("#search input").value = "";
        document.getElementById("search_result").style.display = "none";
    }
}

function displayMessages(xhr) {
    if(xhr.readyState == 4 && xhr.status == 200) {
        document.getElementById("no_chat").style.display = "none";
        document.getElementById("chatting_section").innerHTML = xhr.responseText;
        document.getElementById("chatting_section").style.removeProperty("display");
        var messages_container = document.getElementById("messages");
        messages_container.scrollTo(0, messages_container.scrollHeight);
    }
}

function activeUser(ele) {
    document.querySelector(".active")?.classList.remove("active");
    ele.classList.add("active");
}

function sendMessage(xhr) {
    if(xhr.readyState == 4 && xhr.status == 200) {
        var message = document.getElementById("message_input").value;
        document.getElementById("message_input").value = "";
        document.getElementById("messages").innerHTML = xhr.responseText;
        var messages_container = document.getElementById("messages");
        messages_container.scrollTo(0, messages_container.scrollHeight);
    }
}