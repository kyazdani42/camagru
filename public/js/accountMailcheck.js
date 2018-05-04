'use strict';

let mail = document.querySelector("#mailChecker");
let action = mail.getAttribute("href");

mail.addEventListener("click", (e) => {

    ajax_get(action, (id) => {

        if (id.ok === "0") {
            e.target.innerHTML = e.target.innerHTML.replace("disable", "enable");
        } else {
            e.target.innerHTML = e.target.innerHTML.replace("enable", "disable");
        }

    });
    e.preventDefault();

});