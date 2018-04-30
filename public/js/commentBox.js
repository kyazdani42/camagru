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
