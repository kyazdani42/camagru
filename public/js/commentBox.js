let j;
let form = document.getElementsByClassName("formSend");
const url = document.getElementsByClassName("formSend")[0].getAttribute("action").replace(/Home\/.+/, "");

if (form !== undefined) {

	for (j = 0; form[j]; j++) {
	
		form[j].addEventListener("submit", (e) => {
			let data = new FormData(e.target);
			let url = e.target.getAttribute("action");
			ajax_post(url, data, function(check) {
				let daddy = e.target.nextElementSibling;
				e.target.firstElementChild.value = "";
				add_comment(check, daddy);
			});
		e.preventDefault();
		});
	}
}

let delCom = (e) => {
    let link = e.target.parentNode;
    if (link.getAttribute("id") !== null) {
        let id = link.getAttribute("id").replace("com", "");
        ajax_get(url + "Home/checkComment/" + id, function (ret) {
            if (ret.key === "1") {
                if (confirm("Do you want to delete this comment ?") === true) {
                    ajax_get(url + "Home/delComment/" + id, function (toDel) {
                        if (toDel !== 0) {
                            let el = document.getElementById("com" + toDel).parentNode;
                            el.parentNode.removeChild(el);
                        }
                    });
                }
            }
        });
    }
    e.preventDefault();
}

let add_comment = function (check, daddy) {

    let lk = document.createElement("a");
    let img = document.createElement("img");
    let div = document.createElement("div");
    let span = document.createElement("span");

    div.setAttribute("class", "comRow");
    img.setAttribute("src", "/public/images/crossbox.png");
    lk.setAttribute("id", "com" + check[0].id);
    lk.setAttribute("href", url + "Home/delComment/" + check[0].id);

    span.innerHTML = check[0].data;
    img.style.width = "15px";

    lk.appendChild(img);
    div.appendChild(span);
    div.appendChild(lk);
    div.addEventListener("click", (e) => {
        delCom(e);
    });
    daddy.insertBefore(div, daddy.firstChild);

};

let comments = document.getElementsByClassName("comRow");

if (comments !== undefined) {

    for (j = 0; comments[j]; j++) comments[j].addEventListener("click", (e) => {
            delCom(e);
        });

}