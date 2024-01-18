function loadData(url, callbackFunction) {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        callbackFunction(this);
    }

    xhr.open("GET", url, true);
    xhr.send();
}

function findUser(xhr) {
    if(xhr.readyState == 4 && xhr.status == 200)
        document.getElementById("search_result").innerHTML = xhr.responseText;
}