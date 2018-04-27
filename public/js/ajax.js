function ajax_post(url, elem = null) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            return (xhr.responseText);
        }
    }
    xhr.send(elem);
}

function ajax_get(url, callback) {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            callback(JSON.parse(xhr.response));
        }
    }
    xhr.send();
}