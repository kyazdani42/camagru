let j;
let form = document.getElementsByClassName("formSend");

if (form !== undefined) {

	for (j = 0; form[j]; j++) {
	
		form[j].addEventListener("submit", function(e) {
			let data = new FormData(e.target);
			let url = e.target.getAttribute("action");
			ajax_post(url, data, function(check) {
				let span = document.createElement("span");
				span.innerHTML = check[0];
				let daddy = e.target.nextElementSibling;
				daddy.insertBefore(span, daddy.firstChild);
				e.target.firstElementChild.value = "";
			});
		e.preventDefault();
		});
	}
}

let comments = document.getElementsByClassName("comRow");

if (comments !== undefined) {

	for (j = 0; comments[j]; j++) {

        comments[j].addEventListener("click", function (e) {

        	let link = e.target.parentNode;
        	if (link.getAttribute("id") !== null) {
                let id = link.getAttribute("id").replace("com", "");
                let url = link.getAttribute("href").replace("Home/delComment/" + id, "");
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
        });
    }
}
