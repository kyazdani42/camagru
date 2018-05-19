'use strict';

const errorFun = (error) => {

    let ob = document.createElement("div");
    let span = document.createElement("span");
    let doc = document.getElementsByTagName("body")[0];
    ob.className = "errorPopup";
    span.innerHTML = error;
    ob.appendChild(span);
    doc.insertBefore(ob, doc.firstElementChild);
    setTimeout(function () {
        ob.remove();
    }, 4000);
};

const validFun = (valid) => {

    let ob = document.createElement("div");
    let span = document.createElement("span");
    let doc = document.getElementsByTagName("body")[0];
    ob.className = "validPopup";
    span.innerHTML = valid;
    ob.appendChild(span);
    doc.insertBefore(ob, doc.firstElementChild);
    setTimeout(function () {
        ob.remove();
    }, 4000);
};