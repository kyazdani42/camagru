'use strict';

let photo = document.querySelector("#staticVideo");
let elem = document.getElementsByClassName("staticImg");
let sendForm = document.querySelector("#cameraForm");
let button = document.querySelector("#startbutton");
let i;

let getImg = (img, check) => {
    let canvas = document.createElement("canvas");
    let data2 = "";

    canvas.width = img.width;
    canvas.height = img.height;
    let ctx = canvas.getContext('2d');
    ctx.drawImage(img, 0, 0);
    if (check === "png")
        data2 = canvas.toDataURL("image/png");
    else if (check === "jpeg")
        data2 = canvas.toDataURL("image/jpeg");
    else
        data2 = canvas.toDataURL("image/gif");
    return (data2);
};

let getData = () => {
    let img = document.querySelector("#staticPhoto");
    let data2 = getImg(img, "png").replace(/^data:image\/(png|jpg);base64,/, "");
    let data = document.querySelector("#photo").getAttribute("src").replace(/^data:image\/(png|jpg|jpeg|gif);base64,/, "");
    document.querySelector("#staticData").setAttribute("value", data2);
    return (data);
};

for (i = 0; i < elem.length; i++) elem[i].addEventListener("click", (e) => {

    if (e.target.getAttribute("src") !== null) {
        let data = getImg(e.target, "png");
        photo.setAttribute("src", data);
    }

});

button.addEventListener("click", () => {

    if (photo.getAttribute("src") !== null) {
        let el = photo.getAttribute("src");
        document.querySelector("#staticPhoto").setAttribute("src", el)
    }

});

document.querySelector("#form").addEventListener("submit", (e) => {

    if (photo.getAttribute("src") !== null) {
        let data = new FormData(e.target);
        ajax_post(e.target.getAttribute("action"), data, (ret) => {
            if (ret[0] === "data") {
                const canvas = document.querySelector("#canvas");
                const img = new Image;
                const ctx = canvas.getContext('2d');

                document.querySelector("#staticPhoto").setAttribute("src", photo.getAttribute("src"));
                document.querySelector("#photo").setAttribute("src", "data:image/png;base64," + ret[1]);
                canvas.setAttribute('width', 300);
                canvas.setAttribute('height', 225);
                img.onload = () => {
                    ctx.drawImage(img, 0, 0, 300, 225);
                };
                img.src = "data:image/png;base64," + ret[1];
            }
            else if (ret[0] === "err")
                errorFun(ret[1]);

        });
    } else {
        errorFun("please select a character before uploading");
    }
    e.preventDefault();
});



sendForm.addEventListener("submit", (e) => {
    let content = getData();
    let sendData = new FormData(e.target);
    sendData.append("myData", content);
    document.querySelector("#myData").setAttribute("value", "upload");

    ajax_post(e.target.getAttribute("action"), sendData, (dataGet) => {

        if (dataGet[0] === "err")
            errorFun(dataGet[1]);
        else if (dataGet[0] === "data") {
            document.querySelector("#staticPhoto").removeAttribute("src");
            document.querySelector("#staticVideo").removeAttribute("src");
            document.querySelector("#photo").setAttribute("src", "");
            let div = document.createElement("div");
            let img = document.createElement("img");
            div.setAttribute("class", "navBox");
            img.setAttribute("src", "data:image/png;base64," + dataGet[1]);
            div.appendChild(img);
            let nav = document.getElementsByClassName("rightNav")[0];
            nav.insertBefore(div, nav.firstElementChild);
            validFun('Your pic has been uploaded correctly');
        }

    });
    e.preventDefault();
});