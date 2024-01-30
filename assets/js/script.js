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

function openMessageBox(userid) {
    document.querySelector("#search input").value = "";
    document.getElementById("search_result").style.display = "none";
    document.querySelector(".active")?.classList.remove("active");
    var ele = document.getElementById(userid);
    
    if(ele)
        ele.classList.add("active");
    else {
        var unknown_user = document.querySelector(".hidden-user");
        unknown_user.id = userid;
        unknown_user.classList.add("active");
    }
        
    loadData('inc/display_messages.php?uid='+userid, displayMessages);
}

function displayMessages(xhr) {
    if(xhr.readyState == 4 && xhr.status == 200) {
        document.getElementById("no_chat").style.display = "none";
        document.getElementById("chatting_section").innerHTML = xhr.responseText;
        document.getElementById("chatting_section").style.removeProperty("display");
        var messages_container = document.getElementById("messages");
        messages_container.scrollTo(0, messages_container.scrollHeight);
        document.getElementById("message_input").focus();
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
        document.getElementById("message_input").focus();
        document.getElementById("messages").innerHTML = xhr.responseText;
        var messages_container = document.getElementById("messages");
        messages_container.scrollTo(0, messages_container.scrollHeight);
    }
}

function handleKeyPress(e) {
    if(e.key === "Enter" && !e.shiftKey) {
        e.preventDefault();     // Prevent the default behavior (line break)
        loadData('inc/send_message.php?uid='+document.querySelector(".active").id+'&msg='+document.getElementById("message_input").value, sendMessage);
    }        
}

function loadMessages(xhr) {
    if(xhr.readyState == 4 && xhr.status == 200) {
        var messages_container = document.getElementById("messages");
        const prevHeight = messages_container.scrollHeight;
        const prevScrollPosition = messages_container.scrollTop + messages_container.clientHeight;
        messages_container.innerHTML = xhr.responseText;

        // Ensure scroll stays at bottom if it was initially there
        if(Math.abs(prevHeight - prevScrollPosition) < 3)
            messages_container.scrollTo(0, messages_container.scrollHeight);
    }
}

setInterval(function() {
    var activeUser = document.querySelector(".active");
    if(activeUser)
        loadData('inc/load_messages.php?uid='+activeUser.id, loadMessages); 
}, 1000);