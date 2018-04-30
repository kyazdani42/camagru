let heart = document.getElementsByClassName("Boxheart");
let i;

if (heart !== undefined) {
    for (i = 0; heart[i]; i++) {
        heart[i].firstElementChild.addEventListener("click", function (e) {
            let svg = e.target.parentNode;
            ajax_get("http://192.168.99.100:8080/Home/sendLike/" + svg.getAttribute("id").split("like")[1], function (cheese) {
                if (cheese !== undefined) {
                    if (cheese[0] === 1) {
                        svg.firstElementChild.setAttribute("class", "clickHeart");
                    }
                    else
                        svg.firstElementChild.setAttribute("class", "heart");
                    svg.nextElementSibling.innerHTML = cheese[1] + " Likes";
                }
            });
        });
    }
}
